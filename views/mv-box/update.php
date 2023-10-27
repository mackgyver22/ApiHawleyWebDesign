<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MvBox */

$this->title = 'Update Mv Box: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Mv Boxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mv-box-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'rooms' => $rooms,
        'categories' => $categories,
    ]) ?>

</div>
