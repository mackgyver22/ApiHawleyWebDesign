<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiIngredientType */

$this->title = 'Update Ri Ingredient Type: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Ri Ingredient Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ri-ingredient-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
