<?php

namespace app\controllers;

use app\models\RiFlavor;
use app\models\RiRecipe;
use app\models\RiRecipeFlavor;
use app\models\TvMood;
use app\models\TvShow;
use Yii;
use app\models\TvShowMood;
use app\models\search\TvShowMoodSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TvShowMoodController implements the CRUD actions for TvShowMood model.
 */
class TvShowToMoodsController extends Controller
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
     * Lists all TvShowMood models.
     * @return mixed
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;

        $show_id = $request->get("show_id", 0);

        $shows = TvShow::find()->orderBy(['title' => SORT_ASC])->asArray()->all();

        foreach ($shows as $index => $getShow) {

            $shows[$index]['selected'] = 0;
            if ($getShow['id'] == $show_id) {
                $shows[$index]['selected'] = 1;
            }
        }

        $didSave = false;
        if (Yii::$app->request->isPost) {

            $show_id = Yii::$app->request->post("show_id",0);
            if ($show_id) {

                $ShowMoods = TvShowMood::find()->where(['show_id' => $show_id])
                    ->all();

                foreach ($ShowMoods as $getShowMood) {
                    $getShowMood->delete();
                }

                $moodIdsArr = Yii::$app->request->post("mood_id", []);

                foreach ($moodIdsArr as $getMoodId) {

                    $NewShowMood = new TvShowMood();
                    $NewShowMood->show_id = $show_id;
                    $NewShowMood->mood_id = $getMoodId;
                    $NewShowMood->save();

                    $didSave = true;
                }
            }
        }

        $moods = TvMood::find()->orderBy(['display_order' => SORT_ASC])->asArray()->all();

        foreach ($moods as $index => $getMood) {

            $getShowMood = TvShowMood::find()->where(['show_id' => $show_id])
                ->andWhere(['mood_id' => $getMood['id']])
                ->one();

            $moods[$index]['selected'] = 0;
            if ($getShowMood) {
                $moods[$index]['selected'] = 1;
            }
        }

        return $this->render('index', [
            "show_id" => $show_id,
            "shows" => $shows,
            "moods" => $moods,
            "message" => $didSave ? "You have updated the Tv Show Moods" : ''
        ]);
    }
}
