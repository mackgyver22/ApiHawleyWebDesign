<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiHomeInventory */

$this->title = 'Update Ri Home Inventory: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ri Home Inventories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ri-home-inventory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ingredients' => $ingredients
    ]) ?>

</div>
