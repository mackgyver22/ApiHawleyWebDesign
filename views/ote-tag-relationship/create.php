<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OteTagRelationship */

$this->title = 'Create Ote Tag Relationship';
$this->params['breadcrumbs'][] = ['label' => 'Ote Tag Relationships', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ote-tag-relationship-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        "tags" => $tags,
        "restaurants" => $restaurants,
        "dishes" => $dishes
    ]) ?>

</div>
