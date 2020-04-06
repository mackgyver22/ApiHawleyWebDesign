<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiRecipe */

$this->title = 'Update Ri Recipe: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Ri Recipes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ri-recipe-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
