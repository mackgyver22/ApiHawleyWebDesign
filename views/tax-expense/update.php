<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaxExpense */

$this->title = 'Update Tax Expense: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tax Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tax-expense-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        "expenseCategories" => $expenseCategories
    ]) ?>

</div>
