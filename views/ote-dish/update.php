<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OteDish */

$this->title = 'Update Ote Dish: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Ote Dishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ote-dish-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
