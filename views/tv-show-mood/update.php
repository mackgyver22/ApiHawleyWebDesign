<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TvShowMood */

$this->title = 'Update Tv Show Mood: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tv Show Moods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tv-show-mood-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
