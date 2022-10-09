<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = 'Update Item: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
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
<div class="item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="color-area" style="background-color: <?= $model->color ?>;">
        <?= $model->color; ?>
    </div>
    <div style="clear: both; height: 16px;"></div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
