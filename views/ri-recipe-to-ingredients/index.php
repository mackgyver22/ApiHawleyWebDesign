<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RiRecipeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recipe Ingredients';
$this->params['breadcrumbs'][] = $this->title;
?>

<style type="text/css">
    ul.ingred_checkboxes {
        list-style-type: none;
        padding-left: 0px;
    }
    ul.ingred_checkboxes li {
        display: inline-block;
        min-width: 75px;
        max-width: 300px;
        padding: 0 7px 10px 0;
    }
</style>

<div class="ri-recipe-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="form-group ">
        <label class="control-label" for="recipe_id">Recipe</label>
        <select name="recipe_id" id="recipe_id" class="form-control" >
            <?php foreach ($recipes as $getRecipe) : ?>
               <option id="<?= $getRecipe->id; ?>" ><?= $getRecipe->title; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="item-title">Ingredients</label>
        <ul class="ingred_checkboxes">
        <?php foreach ($ingredients as $getIngred) : ?>
            <li >
                <input type="checkbox" name="ingred[]" id="ingred[]" value="<?= $getIngred->id; ?>" />&nbsp; <?= $getIngred->title; ?>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</div>
