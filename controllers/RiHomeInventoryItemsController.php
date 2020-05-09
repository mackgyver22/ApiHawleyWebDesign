<?php

namespace app\controllers;

use app\models\RiFlavor;
use app\models\RiHomeInventory;
use app\models\RiIngredient;
use app\models\RiRecipeFlavor;
use app\models\RiRecipeIngredient;
use app\models\search\RecipeSearch;
use Yii;
use app\models\RiRecipe;
use app\models\search\RiRecipeSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RiRecipeController implements the CRUD actions for RiRecipe model.
 */
class RiHomeInventoryItemsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'], // add all actions to take guest to login page
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RiRecipe models.
     * @return mixed
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;

        $didSave = false;
        if (Yii::$app->request->isPost) {

            $HomeInventoryItems = RiHomeInventory::find()
                ->all();

            foreach ($HomeInventoryItems as $getItem) {
                $getItem->delete();
            }

            $ingredientIdsArr = Yii::$app->request->post("ingredient_id", []);

            foreach ($ingredientIdsArr as $getIngredientId) {

                $NewHomeInventoryItem = new RiHomeInventory();
                $NewHomeInventoryItem->ingredient_id = $getIngredientId;
                $NewHomeInventoryItem->save();

                $didSave = true;
            }

        }

        $Ingredients = RiIngredient::find()->orderBy('title', SORT_ASC)->asArray()->all();

        foreach ($Ingredients as $index => $getIngred) {

            $Ingredients[$index]['title_slug'] = $this->slugify($getIngred['title']);

            $Ingredients[$index]['selected'] = 0;
            $HasIngred = RiHomeInventory::find()->where(['ingredient_id' => $getIngred['id']])->one();
            if ($HasIngred) {
                $Ingredients[$index]['selected'] = 1;
            }
        }

        return $this->render('index', [
            "ingredients" => $Ingredients,
            "message" => $didSave ? "You have updated what's in your Home Inventory" : ''
        ]);
    }


    private function slugify($string){
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', ' ', $string), '-'));
    }


    /*/
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    //*/
}
