<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RiIngredientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Commonly Used Ingredients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ri-ingredient-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-bordered">
        <thead >
        <tr>
            <th >Ingredient</th>
            <th >Times Used</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($commonIngredients as $getIngred) : ?>
        <tr>
            <td><?= $getIngred['title'] ?></td>
            <td><?= $getIngred['recipe_count'] ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
