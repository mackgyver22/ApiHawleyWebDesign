<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiProtein */

$this->title = 'Create Ri Protein';
$this->params['breadcrumbs'][] = ['label' => 'Ri Proteins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ri-protein-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
