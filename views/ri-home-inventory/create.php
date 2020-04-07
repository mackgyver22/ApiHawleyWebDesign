<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiHomeInventory */

$this->title = 'Create Home Inventory';
$this->params['breadcrumbs'][] = ['label' => 'Home Inventories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ri-home-inventory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ingredients' => $ingredients
    ]) ?>

</div>
