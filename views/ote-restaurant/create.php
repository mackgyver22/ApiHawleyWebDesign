<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OteRestaurant */

$this->title = 'Create Ote Restaurant';
$this->params['breadcrumbs'][] = ['label' => 'Ote Restaurants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ote-restaurant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
