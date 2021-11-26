<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OteTagRelationship */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ote-tag-relationship-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tag_id')->dropDownList($tags) ?>



    <div class="form-group field-otetagrelationship-ref_table_id">
        <label class="control-label" for="otetagrelationship-ref_table_id">Restaurant</label>
        <select id="otetagrelationship-ref_table_id" class="form-control" name="restaurant_id" aria-required="true" aria-invalid="false">
            <option value=""> - Select One - </option>
            <?php foreach ($restaurants as $restaurantId => $restaurantTitle) : ?>
                <option value="<?= $restaurantId ?>" <?= ($model->ref_table == "restaurant" && $model->ref_table_id == $restaurantId) ? "SELECTED" : ""; ?>><?= $restaurantTitle ?></option>
            <?php endforeach; ?>
        </select>
        <div class="help-block"></div>
    </div>

    <div class="form-group field-otetagrelationship-ref_table_id2">
        <label class="control-label" for="otetagrelationship-ref_table_id">Dish</label>
        <select id="otetagrelationship-ref_table_id2" class="form-control" name="dish_id" aria-required="true" aria-invalid="false">
            <option value=""> - Select One - </option>
            <?php foreach ($dishes as $dishId => $dishTitle) : ?>
                <option value="<?= $dishId ?>" <?= ($model->ref_table == "dish" && $model->ref_table_id == $dishId) ? "SELECTED" : ""; ?>><?= $dishTitle ?></option>
            <?php endforeach; ?>
        </select>
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
