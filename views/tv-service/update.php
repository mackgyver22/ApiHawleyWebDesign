<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TvService */

$this->title = 'Update Tv Service: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tv Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tv-service-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
