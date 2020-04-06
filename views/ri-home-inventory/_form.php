<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RiHomeInventory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ri-home-inventory-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ingredient_id')->dropDownList($ingredients) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
