<?php

namespace app\controllers;

use app\models\Item;
use app\models\ItemUsedHistory;
use app\models\RiDifficultyLevel;
use app\models\RiHomeInventory;
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

class HomeInventoryFormController extends Controller
{
    public $enableCsrfValidation = false;
    //*/
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

    public function actionHomeInventory()
    {
        $HomeInventoryItems2 = RiHomeInventory::find()
            ->joinWith(['ingredient'])
            ->orderBy(['ri_ingredient.title' => SORT_ASC])
            ->asArray()
            ->all();

        $HomeInventoryItems = [];
        foreach ($HomeInventoryItems2 as $getItem) {
            $HomeInventoryItems[] = $getItem['ingredient'];
        }

        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
        header("Content-type: application/json");

        echo json_encode([
            "items" => $HomeInventoryItems
        ]);
        die();
    }

    public function actionRemoveIngredient() {

        $request = Yii::$app->request;

        $ingredientId = $request->post("ingredient_id", 0);

        if ($ingredientId) {
            $riRecipeIngred = RiHomeInventory::find()
                ->where([
                    'ingredient_id' => $ingredientId,
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

    public function actionUpdateRecipeIngredients()
    {
        $request = Yii::$app->request;

        $newIngredientsArr2 = $request->post("ingredients", []);

        $newIngredientsArr = [];
        foreach ($newIngredientsArr2 as $key => $value) {
            $newIngredientsArr[] = $value;
        }

        if (count($newIngredientsArr) == 0) {
            throw new \yii\web\NotFoundHttpException('Did not pass ingredient ids to update', true);
        }

        foreach ($newIngredientsArr as $getIngredId) {

            $ingredExists = RiHomeInventory::find()
                ->where([
                    'ingredient_id' => $getIngredId
                ])
                ->asArray()
                ->one();

            if (!$ingredExists) {

                $recipeIngredient = new RiHomeInventory();
                $recipeIngredient->ingredient_id = $getIngredId;
                $recipeIngredient->save();
            }
        }

        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");
        header("Content-type: application/json");

        echo json_encode([
            "success" => true
        ]);
        die();
    }
}
