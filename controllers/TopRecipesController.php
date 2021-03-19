<?php

namespace app\controllers;

use app\models\Item;
use app\models\ItemUsedHistory;
use app\models\RiDifficultyLevel;
use app\models\RiFlavor;
use app\models\RiIngredient;
use app\models\RiIngredientType;
use app\models\RiProtein;
use app\models\RiRecipe;
use app\models\RiRecipeIngredient;
use app\services\Utils;
use Bills;
use DateTime;
use Yii;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class TopRecipesController extends Controller
{
    public $enableCsrfValidation = false;
    /*/
    private $allowedOriginDomain = "https://recipes.hawleywebdesign.com";
    /*/
    private $allowedOriginDomain = "http://localhost:4200";
    //*/

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    private function getSortSql($sort1, $sort2, $sort3, $sort_dir1, $sort_dir2, $sort_dir3) {

        $sortSql = "";
        if ($sort1) {
            if ($sort1 == "taste_level") {
                if ($sort_dir1 == "ASC") {
                    $sort_dir1 = "DESC";
                } else {
                    $sort_dir1 = "ASC";
                }
            }
            $sortName = "";
            switch ($sort1) {
                case "cheap_price":
                    $sortName = "recipe_low_price";
                    break;
                case "price":
                    $sortName = "recipe_high_price";
                    break;
                case "taste_level":
                    $sortName = "tl.id";
                    break;
                case "difficulty_level":
                    $sortName = "dl.id";
                    break;
            }
            $sortSql = "ORDER BY $sortName $sort_dir1";
        }
        if ($sort2) {
            if ($sort2 == "taste_level") {
                if ($sort_dir2 == "ASC") {
                    $sort_dir2 = "DESC";
                } else {
                    $sort_dir2 = "ASC";
                }
            }
            $sortName = "";
            switch ($sort2) {
                case "cheap_price":
                    $sortName = "recipe_low_price";
                    break;
                case "price":
                    $sortName = "recipe_high_price";
                    break;
                case "taste_level":
                    $sortName = "tl.id";
                    break;
                case "difficulty_level":
                    $sortName = "dl.id";
                    break;
            }
            if (!$sortSql) {
                $sortSql = "ORDER BY $sortName $sort_dir2";
            } else {
                $sortSql .= ", $sortName $sort_dir2";
            }
        }
        if ($sort3) {
            if ($sort3 == "taste_level") {
                if ($sort_dir3 == "ASC") {
                    $sort_dir3 = "DESC";
                } else {
                    $sort_dir3 = "ASC";
                }
            }
            $sortName = "";
            switch ($sort3) {
                case "cheap_price":
                    $sortName = "recipe_low_price";
                    break;
                case "price":
                    $sortName = "recipe_high_price";
                    break;
                case "taste_level":
                    $sortName = "tl.id";
                    break;
                case "difficulty_level":
                    $sortName = "dl.id";
                    break;
            }
            if (!$sortSql) {
                $sortSql = "ORDER BY $sortName $sort_dir3";
            } else {
                $sortSql .= ", $sortName $sort_dir3";
            }
        }
        if ($sortSql) {
            $sortSql .= ", r.title ASC ";
        }
        return $sortSql;
    }

    public function actionTopRecipes()
    {
        $request = Yii::$app->request;
        $protein_ids = $request->get("protein_ids", []);

        $proteinId = $request->get("protein_id", 0);
        $difficulty_level_id = $request->get("difficulty_level_id", 0);
        $taste_level_id = $request->get("taste_level_id", 0);
        $recipe_style_id = $request->get("recipe_style_id", 0);
        $sort1 = $request->get("sort1", "");
        $sort_dir1 = $request->get("sort_dir1", "ASC");
        $sort2 = $request->get("sort2", "");
        $sort_dir2 = $request->get("sort_dir2", "ASC");
        $sort3 = $request->get("sort3", "");
        $sort_dir3 = $request->get("sort_dir3", "ASC");

        if ($proteinId) {
            $protein_ids = [$proteinId];
        }
        if ($protein_ids == [0]) {
            $protein_ids = [];
        }

        $whereSql = '';
        if (count($protein_ids) > 0) {
            $whereSql .= "AND r.protein_id IN (" . implode(",", $protein_ids) . ") 
            ";
        }
        if ($difficulty_level_id) {
            $whereSql .= "AND dl.id = :difficulty_level_id 
            ";
        }
        if ($recipe_style_id) {
            $whereSql .= "AND rs.id = :recipe_style_id 
            ";
        }
        if ($taste_level_id) {
            $whereSql .= "AND tl.id = :taste_level_id 
            ";
        }

        $sortSql = $this->getSortSql($sort1, $sort2, $sort3, $sort_dir1, $sort_dir2, $sort_dir3);

        $sql = "SELECT r.id
                , r.title as recipe
                , p.title as protein
                , rs.title as style
                , SUM(i.cheap_price) as recipe_low_price
                , SUM(i.price) as recipe_high_price
                , dl.title as difficulty_level
                , tl.title as taste_level
                , r.last_date_made
                , r.image_path
                FROM ri_recipe r 
                INNER JOIN ri_protein p 
                    ON r.protein_id = p.id 
                INNER JOIN ri_recipe_style rs 
                    oN r.recipe_style_id = rs.id 
                INNER JOIN ri_difficulty_level dl 
                    oN r.difficulty_level_id = dl.id 
                INNER JOIN ri_taste_level tl 
                    ON r.taste_level_id = tl.id 
                INNER JOIN ri_recipe_ingredient ri 
                    ON r.id = ri.recipe_id 
                INNER JOIN ri_ingredient i 
                    oN ri.ingredient_id = i.id 
                LEFT JOIN ri_home_inventory hi 
                    oN i.id = hi.ingredient_id
                WHERE 1 
                AND r.is_deleted = 0
                AND hi.id IS NULL

                $whereSql
                
                GROUP BY r.id
                
                $sortSql
                ";

        $query = Yii::$app->db->createCommand($sql);

        if ($difficulty_level_id) {
           $query->bindParam(':difficulty_level_id', $difficulty_level_id);
        }
        if ($recipe_style_id) {
            $query->bindParam(':recipe_style_id', $recipe_style_id);
        }
        if ($taste_level_id) {
            $query->bindParam(':taste_level_id', $taste_level_id);
        }

        /*/
        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
        header("Content-type: application/json");
        echo json_encode([
            "new_sql" => $sql,
            "params" => [
                ":contains_gluten" => $contains_gluten,
                ":contains_salad" => $contains_salad,
                ":is_easy" => $is_easy,
            ]
        ]);
        die();
        //*/

        $recipes = $query->queryAll();

        $proteins = RiProtein::find()->asArray()->all();
        foreach ($proteins as $index => $getProtein) {
            $proteins[$index]['selected'] = 0;
            if (in_array($getProtein['id'], $protein_ids)) {
                $proteins[$index]['selected'] = 1;
            }
        }

        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
        header("Content-type: application/json");

        echo json_encode([
            "items" => $recipes
            /*"proteins" => $proteins,*/
        ]);
        die();
    }
}
