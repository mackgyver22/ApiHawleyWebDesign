<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiIngredient */

$this->title = 'Create Ri Ingredient';
$this->params['breadcrumbs'][] = ['label' => 'Ri Ingredients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ri-ingredient-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ingredients' => $ingredientTypes
    ]) ?>

</div>
