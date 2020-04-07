<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiFlavor */

$this->title = 'Update Flavor: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Flavors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ri-flavor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
