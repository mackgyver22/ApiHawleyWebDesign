<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiDifficultyLevel */

$this->title = 'Create Ri Difficulty Level';
$this->params['breadcrumbs'][] = ['label' => 'Ri Difficulty Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ri-difficulty-level-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
