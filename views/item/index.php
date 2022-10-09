<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .color-area {
        width: 125px;
        height: 22px;
        display: inline-block;
        color: white;
        font-weight: bold;
        border-radius: 5px;
        text-align: center;
    }
</style>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'color',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th><a href="/item/index?sort=id" data-sort="id">ID</a></th>
            <th><a href="/item/index?sort=title" data-sort="title">Title</a></th>
            <th><a href="/item/index?sort=color" data-sort="color">Color</a></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dataProvider->getModels() as $getItem): ?>
        <tr >
            <td><?= $getItem->id ?></td>
            <td><?= $getItem->title ?></td>
            <td>
                <div class="color-area" style="background-color: <?= $getItem->color ?>;">
                    <?= $getItem->color; ?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
