<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TvShowMood */

$this->title = 'Create Tv Show Mood';
$this->params['breadcrumbs'][] = ['label' => 'Tv Show Moods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tv-show-mood-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
