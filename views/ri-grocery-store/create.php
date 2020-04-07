<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiGroceryStore */

$this->title = 'Create Grocery Store';
$this->params['breadcrumbs'][] = ['label' => 'Grocery Stores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ri-grocery-store-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
