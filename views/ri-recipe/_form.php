<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\RiRecipe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ri-recipe-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rating')->textInput() ?>

    <?= $form->field($model,'last_date_made')->widget(DatePicker::className(),[
            'dateFormat' => 'MM/dd/yyyy',
            'options' => [
                'class' => 'form-control',
            ],
            'clientOptions' => []
    ]) ?>

    <?= $form->field($model, 'protein_id')->dropDownList($proteins) ?>

    <?= $form->field($model, 'difficulty_level_id')->dropDownList($difficulty_levels) ?>

    <?= $form->field($model, 'contains_salad')->checkbox() ?>

    <?= $form->field($model, 'contains_gluten')->checkbox() ?>

    <?php if ($uploadModel) : ?>
        <?= $form->field($uploadModel, 'imageFile')->fileInput() ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
