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
                        'actions' => ['logout', 'index', 'view', 'create', 'update', 'delete', 'find-model'], // add all actions to take guest to login page
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

        //*/
        $post = Yii::$app->request->post();

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
