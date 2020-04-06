<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiAttribute */

$this->title = 'Create Ri Attribute';
$this->params['breadcrumbs'][] = ['label' => 'Ri Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ri-attribute-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
