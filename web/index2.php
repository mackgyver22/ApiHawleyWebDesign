<?php
define('MYSQL_SERVER', "localhost");
define('MYSQL_DATABASE', "api_db");
define('MYSQL_USERNAME', "root");
define('MYSQL_PASSWORD', "gortex!22");

$mysqlDatabase = MYSQL_DATABASE;

try {
    $db_conn = new PDO('mysql:host='.MYSQL_SERVER.';dbname='.$mysqlDatabase, MYSQL_USERNAME, MYSQL_PASSWORD);
    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage() . "<br />";
    echo 'Could not establish database connection';
    exit;
}

$sql = "SELECT r.title as recipe 
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
;";

$query = $db_conn->prepare($sql);
$query->execute();

$results1 = $query->fetchAll(2);

$sql = "SELECT i.title as ingredient 
, COUNT(ri.recipe_id) as found_in_recipe_count 
FROM ri_ingredient i 
INNER JOIN ri_recipe_ingredient ri 
	oN i.id = ri.ingredient_id
INNER JOIN ri_recipe r 
	ON ri.recipe_id = r.id 
LEFT JOIN ri_home_inventory hi 
	oN i.id = hi.ingredient_id 
WHERE 1
AND hi.id is null
GROUP BY i.id 
ORDER BY COUNT(ri.recipe_id) DESC
;
;";

$query = $db_conn->prepare($sql);
$query->execute();

$results2 = $query->fetchAll(2);

$sql = "SELECT i.id as ingredient_id
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
;";

$query = $db_conn->prepare($sql);
$query->execute();

$results3 = $query->fetchAll(2);
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="/css/nav.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<body>

<style type="text/css">



</style>

<div class="container" >

    <h1>Recipes You Have</h1>
    <div style="clear: both; height: 0px;" ></div>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Recipe</th>
            <th>Ingredients Count</th>
            <th>Ingredients</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($results1 as $getItem): ?>
            <tr>
                <td><?php echo $getItem['recipe']; ?></td>
                <td><?php echo $getItem['found_ingredients_count']; ?></td>
                <td><?php echo $getItem['ingredients']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div style="clear: both; height: 16px;"></div>

    <h1>Most Frequent Ingredients You Don't Have</h1>
    <div style="clear: both; height: 0px;" ></div>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Ingredient</th>
            <th>Found Count</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($results2 as $getItem): ?>
            <tr>
                <td><?php echo $getItem['ingredient']; ?></td>
                <td><?php echo $getItem['found_in_recipe_count']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div style="clear: both; height: 16px;"></div>

    <h1>Most Frequent Ingredients</h1>
    <div style="clear: both; height: 0px;" ></div>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Ingredient</th>
            <th>Found Count</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($results3 as $getItem): ?>
            <tr>
                <td><?php echo $getItem['ingredient']; ?></td>
                <td><?php echo $getItem['found_in_recipe_count']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div style="clear: both; height: 16px;"></div>
</div>
</body>
</html>
