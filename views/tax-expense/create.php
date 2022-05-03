<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaxExpense */

$this->title = 'Create Tax Expense';
$this->params['breadcrumbs'][] = ['label' => 'Tax Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tax-expense-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        "expenseCategories" => $expenseCategories
    ]) ?>

</div>
