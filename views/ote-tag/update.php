<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OteTag */

$this->title = 'Update Ote Tag: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Ote Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ote-tag-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
