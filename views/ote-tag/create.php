<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OteTag */

$this->title = 'Create Ote Tag';
$this->params['breadcrumbs'][] = ['label' => 'Ote Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ote-tag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
