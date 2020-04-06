<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\RiIngredientPriceHistory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ri-ingredient-price-history-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ingredient_id') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'date_purchased') ?>

    <?= $form->field($model, 'grocery_store_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
