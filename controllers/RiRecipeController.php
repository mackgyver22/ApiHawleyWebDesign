<?php

namespace app\controllers;

use app\models\UploadRecipeImage;
use Yii;
use app\models\RiRecipe;
use app\models\search\RiRecipeSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * RiRecipeController implements the CRUD actions for RiRecipe model.
 */
class RiRecipeController extends Controller
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
                        'actions' => ['logout', 'index', 'view', 'create', 'update', 'delete', 'find-model', 'top-recipes'], // add all actions to take guest to login page
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
        $searchModel = new RiRecipeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTopRecipes()
    {
        $request = Yii::$app->request;

        $flavors_include = $request->get("flavors_include", []);
        $flavors_exclude = $request->get("flavors_exclude", []);
        $protein_ids = $request->get("protein_ids", []);
        $contains_salad = $request->get("contains_salad");
        $contains_gluten = $request->get("contains_gluten");

        $frugal_mode = $request->get("frugal_mode", 0);

        $whereSql = '';
        if (count($flavors_include) > 0) {
            $whereSql .= "AND f.id IN (" . implode(",", $flavors_include) . ") 
            ";
        }
        if (count($flavors_exclude) > 0) {
            $whereSql .= "AND f.id NOT IN (" . implode(",", $flavors_exclude) . ") 
            ";
        }
        if (count($protein_ids) > 0) {
            $whereSql .= "AND r.protein_id IN (" . implode(",", $protein_ids) . ") 
            ";
        }
        if ($contains_gluten != -1 && $contains_gluten != null) {
            $whereSql .= "AND r.contains_gluten = :contains_gluten 
            ";
        }
        if ($contains_salad != -1 && $contains_salad != null) {
            $whereSql .= "AND r.contains_salad = :contains_salad 
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
                , GROUP_CONCAT(f.title SEPARATOR ', ') as flavors
                , COUNT(DISTINCT(hi.ingredient_id)) AS ingredients_have_count
                , GROUP_CONCAT(i.title SEPARATOR ', ') AS owned_ingredients
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

        $recipes = $query->queryAll();

        /*/
        echo "<pre>";
        print_r($recipes);
        die();
        //*/

        return $this->render('top-recipes', [
            'recipes' => $recipes,
        ]);
    }

    /**
     * Displays a single RiRecipe model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RiRecipe model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RiRecipe();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->last_date_made) {
                $model->last_date_made = date("Y-m-d", strtotime($model->last_date_made));
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            "uploadModel" => null
        ]);
    }

    /**
     * Updates an existing RiRecipe model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $uploadModel = new UploadRecipeImage();

        $savedImagePath = '';
        if (Yii::$app->request->isPost) {
            $uploadModel->imageFile = UploadedFile::getInstance($uploadModel, 'imageFile');
            $savedImagePath = $uploadModel->upload($id);
        }

        if ($model->load(Yii::$app->request->post())) {

            if ($model->last_date_made) {
                $model->last_date_made = date("Y-m-d", strtotime($model->last_date_made));
            }
            if ($model->save()) {
                if ($savedImagePath) {
                    $model->image_path = $savedImagePath;
                    $model->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'uploadModel' => $uploadModel
        ]);
    }

    /**
     * Deletes an existing RiRecipe model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RiRecipe model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RiRecipe the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RiRecipe::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
