<?php

namespace app\controllers;

use app\models\HomeInventory;
use app\models\Ingredient;
use app\models\IngredientPriceHistory;
use app\models\Item;
use app\models\ItemUsedHistory;
use app\models\Recipe;
use app\models\RecipeIngredient;
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

class RecipeIngredientItemsController extends Controller
{
    public $enableCsrfValidation = false;
    //private $allowedOriginDomain = "https://recipes.hawleywebdesign.com";
    private $allowedOriginDomain = "http://127.0.0.1:4201";

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
    public function actionIndex()
    {
        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");

        header("Content-type: text/json");

        /*/
        $Recipe = Recipe::findOne(1)->toArray();
        echo json_encode($Recipe);

        $Ingredients = Ingredient::find()
            ->select(['ri_ingredient.*', 'ingredient_type_title' => 'ingredient_type.title'])
            ->joinWith('ingredientType')
            ->where(['ri_ingredient.id' => 1])
            ->asArray()
            ->all();

        foreach ($Ingredients as $index => $getIngred) {
            echo json_encode($getIngred);
        }

        $HomeInventory = HomeInventory::find()
                            ->select(['ri_home_inventory.*', 'ri_ingredient.*'])
                            ->joinWith('ingredient')
                            ->where(['ri_home_inventory.id' => 1])
                            ->asArray()
                            ->all();

        $RecipeIngredients = RecipeIngredient::find()
                                ->select(['ri_recipe_ingredient.*', 'ri_ingredient.*', 'ri_recipe.*'])
                                ->joinWith(['ingredient', 'recipe'])
                                ->where(['ri_recipe.id' => 1])
                                ->asArray()
                                ->all();
        echo json_encode([
            'HomeInventory' => $HomeInventory,
            'RecipeIngredients' => $RecipeIngredients
        ]);
        //*/

        $PriceHistory = IngredientPriceHistory::find()
                            ->select(['ri_ingredient_price_history.*', 'ri_ingredient.*', 'ri_grocery_store.*'])
                            ->joinWith(['ingredient', 'groceryStore'])
                            ->where(['ri_ingredient_price_history.id' => 1])
                            ->asArray()
                            ->all();

        echo json_encode([
            "PriceHistory" => $PriceHistory
        ]);

        die();
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
