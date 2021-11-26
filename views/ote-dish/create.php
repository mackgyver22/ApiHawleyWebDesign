<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OteDish */

$this->title = 'Create Ote Dish';
$this->params['breadcrumbs'][] = ['label' => 'Ote Dishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ote-dish-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
