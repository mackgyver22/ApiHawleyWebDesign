<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RiRecipe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ri-recipe-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rating')->textInput() ?>

    <?= $form->field($model, 'last_date_made')->textInput() ?>

    <?= $form->field($model, 'contains_salad')->textInput() ?>

    <?= $form->field($model, 'contains_gluten')->textInput() ?>

    <?= $form->field($uploadModel, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
