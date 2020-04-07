<?php

namespace app\controllers;

use app\models\RiIngredient;
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
class RiRecipeToIngredientsController extends Controller
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
        $recipes = RiRecipe::find()->orderBy(['title' => SORT_ASC])->all();

        $ingredients = RiIngredient::find()->orderBy(['title' => SORT_ASC])->all();

        return $this->render('index', [
            "recipes" => $recipes,
            "ingredients" => $ingredients
        ]);
    }





    /*/
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    //*/
}
