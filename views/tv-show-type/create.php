<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TvShowType */

$this->title = 'Create Tv Show Type';
$this->params['breadcrumbs'][] = ['label' => 'Tv Show Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tv-show-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
