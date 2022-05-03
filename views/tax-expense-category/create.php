<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaxExpenseCategory */

$this->title = 'Create Tax Expense Category';
$this->params['breadcrumbs'][] = ['label' => 'Tax Expense Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tax-expense-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
