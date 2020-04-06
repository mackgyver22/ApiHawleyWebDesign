<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiAttribute */

$this->title = 'Update Ri Attribute: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Ri Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ri-attribute-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
