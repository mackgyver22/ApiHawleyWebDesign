<?php

namespace app\controllers;

use app\models\Item;
use app\models\ItemUsedHistory;
use app\models\RiDifficultyLevel;
use app\models\RiProtein;
use app\models\RiRecipe;
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
    //*/
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
        $protein_id = Yii::$app->request->post("protein_id", 0);
        $difficulty_level_id = Yii::$app->request->post("difficulty_level_id", 0);
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
            "success" => true
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
