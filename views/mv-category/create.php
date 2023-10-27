<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MvCategory */

$this->title = 'Create Mv Category';
$this->params['breadcrumbs'][] = ['label' => 'Mv Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mv-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
