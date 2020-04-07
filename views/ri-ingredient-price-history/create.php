<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiIngredientPriceHistory */

$this->title = 'Create Ingredient Price History';
$this->params['breadcrumbs'][] = ['label' => 'Ingredient Price Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ri-ingredient-price-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ingredients' => $ingredients,
        "groceryStores" => $groceryStores
    ]) ?>

</div>
