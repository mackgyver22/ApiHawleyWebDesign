<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RiIngredientPriceHistory */

$this->title = $model->ingredient->title . ' Price on ' . date("m/d/Y", strtotime($model->date_purchased));
$this->params['breadcrumbs'][] = ['label' => 'Ingredient Price Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ri-ingredient-price-history-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ingredient_id',
            'price',
            'date_purchased',
            'grocery_store_id',
        ],
    ]) ?>

</div>
