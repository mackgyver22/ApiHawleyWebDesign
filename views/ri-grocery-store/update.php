<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiGroceryStore */

$this->title = 'Update Ri Grocery Store: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Ri Grocery Stores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ri-grocery-store-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
