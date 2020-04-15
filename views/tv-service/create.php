<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TvService */

$this->title = 'Create Tv Service';
$this->params['breadcrumbs'][] = ['label' => 'Tv Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tv-service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
