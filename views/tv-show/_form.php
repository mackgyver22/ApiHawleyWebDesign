<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TvShow */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tv-show-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'service_id')->dropDownList($services) ?>

    <?= $form->field($model, 'show_type_id')->dropDownList($show_types) ?>

    <?php if ($uploadModel) : ?>
        <?= $form->field($uploadModel, 'imageFile')->fileInput() ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
