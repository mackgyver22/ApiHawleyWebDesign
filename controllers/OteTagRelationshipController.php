<?php

namespace app\controllers;

use app\models\OteDish;
use app\models\OteRestaurant;
use app\models\OteTag;
use app\models\RiProtein;
use Yii;
use app\models\OteTagRelationship;
use app\models\search\OteTagRelationshipSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OteTagRelationshipController implements the CRUD actions for OteTagRelationship model.
 */
class OteTagRelationshipController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all OteTagRelationship models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OteTagRelationshipSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OteTagRelationship model.
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
     * Creates a new OteTagRelationship model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OteTagRelationship();

        if ($model->load(Yii::$app->request->post())) {

            $restaurant_id = Yii::$app->request->post("restaurant_id", 0);
            $dish_id = Yii::$app->request->post("dish_id", 0);

            if ($restaurant_id) {
                $model->ref_table = "restaurant";
                $model->ref_table_id = $restaurant_id;
            } else if ($dish_id) {
                $model->ref_table = "dish";
                $model->ref_table_id = $dish_id;
            } else {
                return $this->redirect(['create?error=Did+not+select+tag+item']);
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            "tags" => ArrayHelper::map(OteTag::find()->orderBy(['title' => SORT_ASC])->all(), 'id', 'title'),
            "restaurants" => ArrayHelper::map(OteRestaurant::find()->orderBy(['title' => SORT_ASC])->all(), 'id', 'title'),
            "dishes" => ArrayHelper::map(OteDish::find()->orderBy(['title' => SORT_ASC])->all(), 'id', 'title'),
        ]);
    }

    /**
     * Updates an existing OteTagRelationship model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $restaurant_id = Yii::$app->request->post("restaurant_id", 0);
            $dish_id = Yii::$app->request->post("dish_id", 0);

            if ($restaurant_id) {
                $model->ref_table = "restaurant";
                $model->ref_table_id = $restaurant_id;
            } else if ($dish_id) {
                $model->ref_table = "dish";
                $model->ref_table_id = $dish_id;
            } else {
                return $this->redirect(['update', 'id' => $model->id]);
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            "tags" => ArrayHelper::map(OteTag::find()->orderBy(['title' => SORT_ASC])->all(), 'id', 'title'),
            "restaurants" => ArrayHelper::map(OteRestaurant::find()->orderBy(['title' => SORT_ASC])->all(), 'id', 'title'),
            "dishes" => ArrayHelper::map(OteDish::find()->orderBy(['title' => SORT_ASC])->all(), 'id', 'title'),
        ]);
    }

    /**
     * Deletes an existing OteTagRelationship model.
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
     * Finds the OteTagRelationship model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OteTagRelationship the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OteTagRelationship::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
