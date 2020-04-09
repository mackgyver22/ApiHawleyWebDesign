<?php

namespace app\controllers;

use app\models\RiIngredient;
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
        $request = Yii::$app->request;

        $recipe_id = $request->get("recipe_id", 0);

        $recipes = RiRecipe::find()->orderBy(['title' => SORT_ASC])->asArray()->all();

        foreach ($recipes as $index => $getRecipe) {

            $recipes[$index]['selected'] = 0;
            if ($getRecipe['id'] == $recipe_id) {
                $recipes[$index]['selected'] = 1;
            }
        }

        $didSave = false;
        if (Yii::$app->request->isPost) {

            $recipe_id = Yii::$app->request->post("recipe_id",0);
            if ($recipe_id) {

                $RecipeIngredients = RiRecipeIngredient::find()->where(['recipe_id' => $recipe_id])
                    ->all();

                foreach ($RecipeIngredients as $getRecipeIngred) {
                    $getRecipeIngred->delete();
                }

                $ingredientIdsArr = Yii::$app->request->post("ingredient_id", []);

                foreach ($ingredientIdsArr as $getIngredientId) {

                    $NewRecipeIngredient = new RiRecipeIngredient();
                    $NewRecipeIngredient->recipe_id = $recipe_id;
                    $NewRecipeIngredient->ingredient_id = $getIngredientId;
                    $NewRecipeIngredient->save();

                    $didSave = true;
                }
            }
        }

        $ingredients = RiIngredient::find()->orderBy(['title' => SORT_ASC])->asArray()->all();

        foreach ($ingredients as $index => $getIngredient) {

            $getRecipeIngredient = RiRecipeIngredient::find()->where(['recipe_id' => $recipe_id])
                ->andWhere(['ingredient_id' => $getIngredient['id']])
                ->one();

            $ingredients[$index]['selected'] = 0;
            if ($getRecipeIngredient) {
                $ingredients[$index]['selected'] = 1;
            }
        }

        return $this->render('index', [
            "recipe_id" => $recipe_id,
            "recipes" => $recipes,
            "ingredients" => $ingredients,
            "message" => $didSave ? "You have updated the Recipe Ingredients" : ''
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
