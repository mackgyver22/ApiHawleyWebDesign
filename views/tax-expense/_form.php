<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaxExpense */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tax-expense-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expense_category_id')->dropDownList($expenseCategories) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'vendor')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
