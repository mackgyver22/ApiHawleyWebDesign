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
    span.recipe-title {
        font-weight: bold;
        font-size: 15px;
    }
    .recipe-item {
        /*text-align: center;*/
        /*border: 2px solid #3e8f3e;
        border-radius: 5px;*/

        vertical-align: top;
        display: inline-block;
        width: 190px;
        height: 500px;
        padding: 11px 6px;
        margin-left: -2px !important;
        margin-right: -2px !important;
        margin-bottom: -1px !important;
        border: 1px solid #999
    }
    .recipe-col img {
        border-radius: 3px;
        border: 1px solid #aaa;
    }

    .img_holder {
        width: 100%;
        text-align: center;
    }

    .checkbox-col {
        margin-top: 15px;
    }

    .multi_dropdown {
        height: 180px !important;
    }

    .recipe-col {
        height: 500px;
        border: 1px solid #999;
        padding: 11px 6px;

    }

</style>
<div class="ri-recipe-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <form action="/ri-recipe/top-recipes" name="frmSearch" id="frmSearch" method="get" >
        <div style="clear: both; height: 10px;"></div>
        <div class="row">
            <div class="col-xs-6 col-md-6">
                <select name="protein_ids[]" id="protein_ids" class="form-control multi_dropdown" multiple>
                    <option value="0"> - Select Protein - </option>
                    <?php foreach ($proteins as $getProtein) : ?>
                        <option value="<?= $getProtein['id'] ?>" <?= ($getProtein['selected']) ? "SELECTED" : "" ?> ><?= $getProtein['title'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-xs-6 col-md-6">
                <select name="flavors_include[]" id="flavors_include" class="form-control multi_dropdown" multiple>
                    <option value="0"> - Desired Flavors - </option>
                    <?php foreach ($flavors as $getFlavor) : ?>
                        <option value="<?= $getFlavor['id'] ?>" <?= ($getFlavor['selected']) ? "SELECTED" : "" ?> ><?= $getFlavor['title'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-xs-2 col-sm-2 checkbox-col">
                <input type="checkbox" name="frugal_mode" id="frugal_mode" value="1" <?= ($frugal_mode) ? "CHECKED" : "" ?>>&nbsp; Frugal Mode
            </div>
            <div class="col-xs-2 col-sm-2 checkbox-col">
                <input type="checkbox" name="contains_gluten" id="contains_gluten" value="1" <?= ($contains_gluten) ? "CHECKED" : "" ?>>&nbsp; Has Gluten
            </div>
            <div class="col-xs-2 col-sm-2 checkbox-col">
                <input type="checkbox" name="contains_salad" id="contains_salad" value="1" <?= ($contains_salad) ? "CHECKED" : "" ?>>&nbsp; Has Salad
            </div>

            <div class="col-xs-2 col-sm-2 checkbox-col">
                <input type="checkbox" name="is_homechef" id="is_homechef" value="1" <?= ($is_homechef) ? "CHECKED" : "" ?>>&nbsp; Home Chef
            </div>
            <div class="col-xs-2 col-sm-2 checkbox-col">
                <input type="checkbox" name="is_easy" id="is_easy" value="1" <?= ($is_easy) ? "CHECKED" : "" ?>>&nbsp; Easy
            </div>

            <div class="col-xs-2 col-sm-2 checkbox-col">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </div>
    <div style="clear: both; height: 15px;"></div>

    <div class="recipes-list">
        <?php $i = 0; ?>
        <div class="row" >
        <?php foreach ($recipes as $getRecipe) : ?>
            <div class="col-xs-6 col-sm-4 col-md-3 recipe-col" >
                <div class="img_holder">
                    <?php if ($getRecipe['image_path']) : ?>
                        <img src="/image.php?f=<?= "/" . $getRecipe['image_path'] ?>&w=160&h=230&effect=crop" />
                    <?php else: ?>
                        <img src="https://via.placeholder.com/160x230.png" />
                    <?php endif; ?>
                </div>
                <div style="clear: both; height: 12px;"></div>
                <span class="recipe-title"><?= $getRecipe['recipe'] ?></span>
                <div style="clear: both; height: 7px;"></div>
                <strong>Cooked on:</strong> <?= date("M d, Y", strtotime($getRecipe['last_date_made'])) ?>
                <div style="clear: both; height: 7px;"></div>
                <strong>Flavors:</strong> <?= $getRecipe['flavors'] ?>
                <div style="clear: both; height: 7px;"></div>
                <strong>Owned Ingredients:</strong> <?= $getRecipe['owned_ingredients'] ?>
            </div>
        <?php endforeach; ?>
        </div>
    </div>




</div>
