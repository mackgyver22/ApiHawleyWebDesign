<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiFlavor */

$this->title = 'Create Flavor';
$this->params['breadcrumbs'][] = ['label' => 'Flavors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ri-flavor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
