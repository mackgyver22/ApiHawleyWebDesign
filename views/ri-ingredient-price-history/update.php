<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiIngredientPriceHistory */

$this->title = 'Update Ri Ingredient Price History: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ri Ingredient Price Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ri-ingredient-price-history-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ingredients' => $ingredients,
        "groceryStores" => $groceryStores
    ]) ?>

</div>
