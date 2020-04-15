<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TvShowMoodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tv Show Moods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tv-show-mood-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tv Show Mood', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'show_id',
            'mood_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
