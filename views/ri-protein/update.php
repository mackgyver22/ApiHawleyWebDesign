<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiProtein */

$this->title = 'Update Ri Protein: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Ri Proteins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ri-protein-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
