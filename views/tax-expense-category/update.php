<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaxExpenseCategory */

$this->title = 'Update Tax Expense Category: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tax Expense Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tax-expense-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
