<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MvRoom */

$this->title = 'Update Mv Room: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Mv Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mv-room-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
