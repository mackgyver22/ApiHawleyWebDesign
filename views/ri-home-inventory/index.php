<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RiHomeInventory */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Home Inventories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ri-home-inventory-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Home Inventory', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ingredient_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
