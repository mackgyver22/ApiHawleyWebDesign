SELECT r.id as recipe_id
     , r.title as recipe
     , SUM(CASE WHEN hi.ingredient_id IS NOT NULL THEN 1 ELSE 0 END) AS found_ingredients_count
     , GROUP_CONCAT(i2.title SEPARATOR ' | ') AS ingredients
FROM ri_ingredient i
         INNER JOIN ri_recipe_ingredient ri
                    oN i.id = ri.ingredient_id
         INNER JOIN ri_recipe r
                    ON ri.recipe_id = r.id
         LEFT JOIN ri_home_inventory hi
                   ON ri.ingredient_id = hi.ingredient_id
         LEFT JOIN ri_ingredient i2
                   ON hi.ingredient_id = i2.id
WHERE 1
GROUP BY r.id
ORDER BY SUM(CASE WHEN hi.ingredient_id IS NOT NULL THEN 1 ELSE 0 END) DESC
;

SELECT i.id as ingredient_id
     , i.title as ingredient
     , COUNT(ri.recipe_id) as found_in_recipe_count
FROM ri_ingredient i
         INNER JOIN ri_recipe_ingredient ri
                    oN i.id = ri.ingredient_id
         INNER JOIN ri_recipe r
                    ON ri.recipe_id = r.id
         LEFT JOIN ri_home_inventory hi
                   oN i.id = hi.ingredient_id
WHERE 1
-- AND hi.id is null
GROUP BY i.id
ORDER BY COUNT(ri.recipe_id) DESC
;