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

    public function actionTopRecipes()
    {
        $request = Yii::$app->request;

        $flavors_include = $request->get("flavors_include", []);
        $protein_ids = $request->get("protein_ids", []);

        $proteinId = $request->get("protein_id", 0);
        if ($proteinId) {
            $protein_ids = [$proteinId];
        }

        if ($flavors_include == [0]) {
            $flavors_include = [];
        }
        if ($protein_ids == [0]) {
            $protein_ids = [];
        }

        $contains_salad = $request->get("contains_salad", 0);
        $contains_gluten = $request->get("contains_gluten", 0);
        $is_homechef = $request->get("is_homechef", 0);
        $is_easy = $request->get("is_easy", 0);

        $frugal_mode = $request->get("frugal_mode", 0);

        $whereSql = '';
        if (count($flavors_include) > 0) {
            $whereSql .= "AND f.id IN (" . implode(",", $flavors_include) . ") 
            ";
        }
        if (count($protein_ids) > 0) {
            $whereSql .= "AND r.protein_id IN (" . implode(",", $protein_ids) . ") 
            ";
        }
        if ($contains_gluten) {
            $whereSql .= "AND r.contains_gluten = :contains_gluten 
            ";
        }
        if ($contains_salad) {
            $whereSql .= "AND r.contains_salad = :contains_salad 
            ";
        }
        if ($is_homechef) {
            $whereSql .= "AND r.is_homechef = :is_homechef 
            ";
        } else if ($is_easy) {
            $whereSql .= "AND r.is_easy = :is_easy 
            ";
        }
        $frugal_order = "";
        if ($frugal_mode) {
            $frugal_order = ", COUNT(DISTINCT(hi.ingredient_id)) DESC ";
        }

        $sql = "SELECT r.id
                , r.title as recipe
                , r.last_date_made
                , r.image_path
                , GROUP_CONCAT(DISTINCT(f.title) SEPARATOR ', ') as flavors
                , COUNT(DISTINCT(hi.ingredient_id)) AS ingredients_have_count
                , GROUP_CONCAT(DISTINCT(i.title) SEPARATOR ', ') AS owned_ingredients
                FROM ri_recipe r 
                LEFT  JOIN ri_recipe_flavor rf 
                    oN r.id = rf.recipe_id 
                LEFT JOIN ri_flavor f 
                    oN rf.flavor_id = f.id 
                INNER JOIN ri_recipe_ingredient ri 
                    ON r.id = ri.recipe_id 
                LEFT JOIN ri_home_inventory hi 
                    ON ri.ingredient_id = hi.ingredient_id 
                LEFT JOIN ri_ingredient i 
                    ON hi.ingredient_id = i.id
                WHERE 1 
                $whereSql
                GROUP BY r.id
                ORDER BY 
                r.last_date_made DESC 
                $frugal_order ";

        $query = Yii::$app->db->createCommand($sql);

        if ($contains_gluten != -1 && $contains_gluten != null) {
            $query->bindParam(':contains_gluten', $contains_gluten);
        }
        if ($contains_salad != -1 && $contains_salad != null) {
            $query->bindParam(':contains_salad', $contains_salad);
        }
        if ($is_homechef != -1 && $is_homechef != null) {
            $query->bindParam(':is_homechef', $is_homechef);
        }
        if ($is_easy != -1 && $is_easy != null) {
            $query->bindParam(':is_easy', $is_easy);
        }

        /*/
        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
        header("Content-type: application/json");
        echo json_encode([
            "new_sql" => $sql,
            "params" => [
                ":contains_salad" => $contains_salad,
                ":is_homechef" => $is_homechef,
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

        $flavors = RiFlavor::find()->orderBy(['title' => SORT_ASC])->asArray()->all();
        foreach ($flavors as $index => $getFlavor) {
            $flavors[$index]['selected'] = 0;
            if (in_array($getFlavor['id'], $flavors_include)) {
                $flavors[$index]['selected'] = 1;
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
