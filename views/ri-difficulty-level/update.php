<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiDifficultyLevel */

$this->title = 'Update Ri Difficulty Level: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Ri Difficulty Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ri-difficulty-level-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
