<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TvShow */

$this->title = 'Create Tv Show';
$this->params['breadcrumbs'][] = ['label' => 'Tv Shows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tv-show-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'services' => $services,
        'show_types' => $show_types,
        'uploadModel' => $uploadModel
    ]) ?>

</div>
