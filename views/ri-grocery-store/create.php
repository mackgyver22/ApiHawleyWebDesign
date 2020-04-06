<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiGroceryStore */

$this->title = 'Create Ri Grocery Store';
$this->params['breadcrumbs'][] = ['label' => 'Ri Grocery Stores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ri-grocery-store-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
