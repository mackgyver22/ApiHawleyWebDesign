<?php

namespace app\controllers;

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
class TvShowMoodItemsController extends Controller
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
     * Lists all TvShowMood models.
     * @return mixed
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;

        $mood_id = intval($request->get("mood_id", 0));

        $moods = TvMood::find()->orderBy(['display_order' => SORT_ASC])->asArray()->all();

        if (!$mood_id) {
            if (count($moods) > 0) {
                $mood_id = $moods[0]['id'];
            }
        }

        foreach ($moods as $index => $getMood) {

            $moods[$index]['selected'] = 0;
            if ($getMood['id'] == $mood_id) {
                $moods[$index]['selected'] = 1;
            }
        }

        $TvShowMoods = TvShowMood::find()
            ->joinWith('show')
            ->where(['mood_id' => $mood_id])->orderBy(['tv_show.id' => SORT_ASC])->all();

        return $this->render('index', [
            "mood_id" => $mood_id,
            "moods" => $moods,
            "mood_shows" => $TvShowMoods,
        ]);
    }

    /**
     * Lists all TvShowMood models.
     * @return mixed
     */
    public function actionGrid()
    {
        $request = Yii::$app->request;

        $mood_id = intval($request->get("mood_id", 0));

        $moods = TvMood::find()->orderBy(['display_order' => SORT_ASC])->asArray()->all();

        if (!$mood_id) {
            if (count($moods) > 0) {
                $mood_id = $moods[0]['id'];
            }
        }

        foreach ($moods as $index => $getMood) {

            $moods[$index]['selected'] = 0;
            if ($getMood['id'] == $mood_id) {
                $moods[$index]['selected'] = 1;
            }
        }

        $TvShowMoods = TvShowMood::find()
            ->joinWith('show')
            ->where(['mood_id' => $mood_id])->orderBy(['tv_show.id' => SORT_ASC])->all();

        return $this->render('grid', [
            "mood_id" => $mood_id,
            "moods" => $moods,
            "mood_shows" => $TvShowMoods,
        ]);
    }
}
