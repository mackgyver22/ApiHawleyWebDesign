<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TvShow */

$this->title = 'Update Tv Show: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tv Shows', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tv-show-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'services' => $services,
        'show_types' => $show_types,
        'uploadModel' => $uploadModel
    ]) ?>

</div>
