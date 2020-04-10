<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RiIngredientPriceHistory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ri-ingredient-price-history-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'ingredient_id')->dropDownList($ingredients) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model,'date_purchased')->widget(DatePicker::className(),[
        'dateFormat' => 'MM/dd/yyyy',
        'options' => [
            'class' => 'form-control',
        ],
        'clientOptions' => []
    ]) ?>

    <?= $form->field($model, 'grocery_store_id')->dropDownList($groceryStores) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
