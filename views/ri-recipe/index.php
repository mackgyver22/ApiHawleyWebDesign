<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RiRecipeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ri Recipes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ri-recipe-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ri Recipe', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'rating',
            'last_date_made',
            'contains_salad',
            //'contains_gluten',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
