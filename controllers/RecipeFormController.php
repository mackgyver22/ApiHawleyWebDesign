<?php

namespace app\controllers;

use app\models\Item;
use app\models\ItemUsedHistory;
use app\models\RiDifficultyLevel;
use app\models\RiIngredient;
use app\models\RiIngredientType;
use app\models\RiProtein;
use app\models\RiRecipe;
use app\models\RiRecipeIngredient;
use app\models\RiRecipeStyle;
use app\models\RiTasteLevel;
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

class RecipeFormController extends Controller
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionCreate()
    {
        $title = Yii::$app->request->post("title", "");
        $rating = Yii::$app->request->post("rating", 1);
        $last_date_made2 = Yii::$app->request->post("last_date_made", 0);
        $contains_salad = Yii::$app->request->post("contains_salad", 0);
        $contains_gluten = Yii::$app->request->post("contains_gluten", 0);
        $protein_id = Yii::$app->request->post("protein_id");
        $difficulty_level_id = Yii::$app->request->post("difficulty_level_id");
        $taste_level_id = Yii::$app->request->post("taste_level_id");
        $recipe_style_id = Yii::$app->request->post("recipe_style_id");
        $is_homechef = Yii::$app->request->post("is_homechef", 0);
        $is_easy = Yii::$app->request->post("is_easy", 0);

        $last_date_made = "";
        if ($last_date_made2 > 0) {
            $last_date_made = date("Y-m-d H:i:s", $last_date_made2);
        }

        $RiRecipe = new RiRecipe();
        $RiRecipe->title = $title;
        $RiRecipe->rating = $rating;
        $RiRecipe->last_date_made = $last_date_made;
        $RiRecipe->contains_salad = $contains_salad;
        $RiRecipe->contains_gluten = $contains_gluten;
        $RiRecipe->protein_id = $protein_id;
        $RiRecipe->difficulty_level_id = $difficulty_level_id;
        $RiRecipe->taste_level_id = $taste_level_id;
        $RiRecipe->recipe_style_id = $recipe_style_id;
        $RiRecipe->is_homechef = $is_homechef;
        $RiRecipe->is_easy = $is_easy;

        $valid = $RiRecipe->validate();
        if (!$valid) {
            throw new \yii\web\NotFoundHttpException('Invalid entry: ' . print_r($RiRecipe->getErrors(), true));
        }
        $RiRecipe->save();

        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
        header("Content-type: text/json");

        echo json_encode([
            "item" => $RiRecipe->toArray()
        ]);
        die();
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->get("id", 0);

        $title = Yii::$app->request->post("title", "");
        $rating = Yii::$app->request->post("rating", 1);
        $last_date_made2 = Yii::$app->request->post("last_date_made", 0);
        $contains_salad = Yii::$app->request->post("contains_salad", 0);
        $contains_gluten = Yii::$app->request->post("contains_gluten", 0);
        $protein_id = Yii::$app->request->post("protein_id");
        $difficulty_level_id = Yii::$app->request->post("difficulty_level_id");
        $taste_level_id = Yii::$app->request->post("taste_level_id");
        $recipe_style_id = Yii::$app->request->post("recipe_style_id");
        $is_homechef = Yii::$app->request->post("is_homechef", 0);
        $is_easy = Yii::$app->request->post("is_easy", 0);

        $last_date_made = "";
        if ($last_date_made2 > 0) {
            $last_date_made = date("Y-m-d H:i:s", $last_date_made2);
        }

        $RiRecipe = RiRecipe::findOne($id);
        if (!$RiRecipe) {
            throw new \yii\web\NotFoundHttpException('Recipe not found');
        }
        $RiRecipe->title = $title;
        $RiRecipe->rating = $rating;
        $RiRecipe->last_date_made = $last_date_made;
        $RiRecipe->contains_salad = $contains_salad;
        $RiRecipe->contains_gluten = $contains_gluten;
        $RiRecipe->protein_id = $protein_id;
        $RiRecipe->difficulty_level_id = $difficulty_level_id;
        $RiRecipe->taste_level_id = $taste_level_id;
        $RiRecipe->recipe_style_id = $recipe_style_id;
        $RiRecipe->is_homechef = $is_homechef;
        $RiRecipe->is_easy = $is_easy;

        $valid = $RiRecipe->validate();
        if (!$valid) {
            throw new \yii\web\NotFoundHttpException('Invalid entry: ' . print_r($RiRecipe->getErrors(), true));
        }
        $RiRecipe->save();

        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
        header("Content-type: text/json");

        echo json_encode([
            "item" => $RiRecipe->toArray()
        ]);
        die();
    }

    public function actionProteins()
    {
        $RiProteins = RiProtein::find()->asArray()->all();

        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
        header("Content-type: application/json");

        echo json_encode([
            "items" => $RiProteins
        ]);
        die();
    }

    public function actionRecipeStyles()
    {
        $RiRecipeStyles = RiRecipeStyle::find()->asArray()->all();

        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
        header("Content-type: application/json");

        echo json_encode([
            "items" => $RiRecipeStyles
        ]);
        die();
    }

    public function actionTasteLevels()
    {
        $RiTasteLevels = RiTasteLevel::find()->asArray()->all();

        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
        header("Content-type: application/json");

        echo json_encode([
            "items" => $RiTasteLevels
        ]);
        die();
    }

    public function actionView($id)
    {

        $recipe = RiRecipe::find()->where(['id' => $id])->asArray()->one();
        if ($recipe) {
            $recipe['contains_gluten'] = intval($recipe['contains_gluten']);
            $recipe['contains_salad'] = intval($recipe['contains_salad']);
            $recipe['is_homechef'] = intval($recipe['is_homechef']);
            $recipe['is_easy'] = intval($recipe['is_easy']);
        }

        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
        header("Content-type: application/json");

        echo json_encode([
            "item" => $recipe
        ]);
        die();
    }

    public function actionRecipes()
    {
        $RiRecipes = RiRecipe::find()
            ->with('riRecipeIngredients.ingredient')
            ->orderBy(['title' => SORT_ASC])
            ->asArray()
            ->all();

        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
        header("Content-type: application/json");

        echo json_encode([
            "items" => $RiRecipes
        ]);
        die();
    }

    public function actionIngredients()
    {
        $RiIngredients = RiIngredient::find()
            ->orderBy(['title' => SORT_ASC])
            ->asArray()
            ->all();

        foreach ($RiIngredients as $index => $getIngredient) {
            $RiIngredients[$index]['id'] = intval($getIngredient['id']);
        }

        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
        header("Content-type: application/json");

        echo json_encode([
            "items" => $RiIngredients
        ]);
        die();
    }

    public function actionRemoveIngredientFromRecipe() {

        $request = Yii::$app->request;

        $ingredientId = $request->post("ingredient_id", 0);
        $recipeId = $request->post("recipe_id", 0);

        if ($ingredientId && $recipeId) {
            $riRecipeIngred = RiRecipeIngredient::find()
                ->where([
                    'ingredient_id' => $ingredientId,
                    'recipe_id' => $recipeId
                ])
                ->one();
            $riRecipeIngred->delete();
        }

        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
        header("Content-type: application/json");

        echo json_encode([
            "success" => true
        ]);
        die();
    }

    public function actionAddIngredient()
    {
        $request = Yii::$app->request;

        $title = $request->post("title", "");

        if ($title) {

            $RiIngredientType = RiIngredientType::find()->where(['title' => 'Other'])->one();

            $RiIngredient = new RiIngredient();
            $RiIngredient->title = $title;
            $RiIngredient->price = 0;
            if ($RiIngredientType) {
                $RiIngredient->ingredient_type_id = $RiIngredientType->id;
            }
            $RiIngredient->save();


            header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
            header("Content-type: application/json");

            echo json_encode([
                "item" => $RiIngredient->toArray()
            ]);
            die();
        }
    }

    public function actionUpdateRecipeIngredients()
    {
        $request = Yii::$app->request;

        $recipeId = $request->post("recipe_id", 0);
        $newIngredientsArr2 = $request->post("ingredients", []);

        $newIngredientsArr = [];
        foreach ($newIngredientsArr2 as $key => $value) {
            $newIngredientsArr[] = $value;
        }

        if (!$recipeId || count($newIngredientsArr) == 0) {
            throw new \yii\web\NotFoundHttpException('Did not pass recipe id or ingredient ids to update', true);
        }

        $currentRecipeIngredients = RiRecipeIngredient::find()
            ->where(['recipe_id' => $recipeId])
            ->asArray()
            ->all();

        $currentIngredientsArr = array_column($currentRecipeIngredients, "ingredient_id");

        foreach ($currentIngredientsArr as $getIngredId) {
            if (!in_array($getIngredId, $newIngredientsArr)) {
                $ingredToRemove = RiRecipeIngredient::find()
                    ->where([
                        'recipe_id' => $recipeId,
                        'ingredient_id' => $getIngredId
                    ])
                    ->one();
                $ingredToRemove->delete();
            }
        }

        foreach ($newIngredientsArr as $getIngredId) {

            $ingredExists = RiRecipeIngredient::find()
                ->where([
                    'recipe_id' => $recipeId,
                    'ingredient_id' => $getIngredId
                ])
                ->asArray()
                ->one();

            if (!$ingredExists) {

                $recipeIngredient = new RiRecipeIngredient();
                $recipeIngredient->recipe_id = $recipeId;
                $recipeIngredient->ingredient_id = $getIngredId;
                $recipeIngredient->save();

                /*/
                header("Access-Control-Allow-Origin: *");
                Utils::printArray([
                    "recipeIngred->errors" => $recipeIngredient->getErrors()
                ], true);
                die();
                //*/
            }
        }

        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
        header("Content-type: application/json");

        echo json_encode([
            "success" => true
        ]);
        die();
    }

    public function actionDifficultyLevels()
    {
        $RiDifficultyLevels = RiDifficultyLevel::find()->asArray()->all();

        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
        header("Content-type: application/json");

        echo json_encode([
            "items" => $RiDifficultyLevels
        ]);
        die();
    }
}
