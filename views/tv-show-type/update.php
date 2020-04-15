<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TvShowType */

$this->title = 'Update Tv Show Type: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tv Show Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tv-show-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
