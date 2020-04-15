<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TvMood */

$this->title = 'Create Tv Mood';
$this->params['breadcrumbs'][] = ['label' => 'Tv Moods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tv-mood-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
