<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MvRoom */

$this->title = 'Create Mv Room';
$this->params['breadcrumbs'][] = ['label' => 'Mv Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mv-room-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
