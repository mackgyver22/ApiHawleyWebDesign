<?php

use app\models\OteDish;
use app\models\OteRestaurant;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OteTagRelationship */

$this->title = 'Update Ote Tag Relationship: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ote Tag Relationships', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ote-tag-relationship-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        "tags" => $tags,
        "restaurants" => $restaurants,
        "dishes" => $dishes
    ]) ?>

</div>
