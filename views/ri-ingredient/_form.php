<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RiIngredient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ri-ingredient-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ingredient_type_id')->dropDownList($ingredientTypes) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'cheap_price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
