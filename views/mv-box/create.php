<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MvBox */

$this->title = 'Create Mv Box';
$this->params['breadcrumbs'][] = ['label' => 'Mv Boxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mv-box-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'rooms' => $rooms,
        'categories' => $categories,
    ]) ?>

</div>
