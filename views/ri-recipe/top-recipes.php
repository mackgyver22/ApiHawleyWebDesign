<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RiRecipeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Top Recipes';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">

    .recipes-list {

    }
    h4.recipe-title {

    }
    .recipes-list .recipe-item {
        /*border: 2px solid #3e8f3e;
        border-radius: 5px;*/
        /*text-align: center;*/
        vertical-align: top;
        display: inline-block;
        width: 210px;
        height: 430px;
        padding: 7px 4px;
        margin-right: 4px;
        margin-bottom: 15px;
    }
    .recipe-item img {
        border-radius: 5px;
        border: 2px solid black;
    }

</style>
<div class="ri-recipe-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="recipes-list">
        <?php $i = 0; ?>
        <?php foreach ($recipes as $getRecipe) : ?>
            <div class="recipe-item" >
                <?php if ($getRecipe['image_path']) : ?>
                    <img src="/image.php?f=<?= "/" . $getRecipe['image_path'] ?>&w=180&h=260&effect=crop" />
                <?php else: ?>
                    <img src="https://via.placeholder.com/180x240.png" />
                <?php endif; ?>
                <h4 class="recipe-title"><?= $getRecipe['recipe'] ?></h4>
                <div style="clear: both; height: 7px;"></div>
                <strong>Cooked on:</strong> <?= date("M d, Y", strtotime($getRecipe['last_date_made'])) ?>
                <div style="clear: both; height: 7px;"></div>
                <strong>Owned Ingredients:</strong> <?= $getRecipe['owned_ingredients'] ?>
            </div>
        <?php endforeach; ?>
    </div>




</div>
