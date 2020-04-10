<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RiRecipeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recipe Flavors';
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

    <?php if ($message) : ?>
        <div class="alert alert-success"><?= $message; ?></div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group ">
        <label class="control-label" for="recipe_id">Recipe</label>
        <select name="recipe_id" id="recipe_id" class="form-control" >
            <?php foreach ($recipes as $getRecipe) : ?>
               <option value="<?= $getRecipe['id']; ?>" <?= ($getRecipe['selected']) ? "SELECTED" : ""; ?>><?= $getRecipe['title']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="item-title">Flavors</label>
        <ul class="ingred_checkboxes">
        <?php foreach ($flavors as $getFlavor) : ?>
            <li >
                <input type="checkbox" name="flavor_id[]" id="flavor_id[]" value="<?= $getFlavor['id']; ?>" <?= ($getFlavor['selected'] == "1") ? "CHECKED" : ""; ?>/>&nbsp; <?= $getFlavor['title']; ?>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>

    setTimeout(function() {



        $('#recipe_id').change(function() {

            window.location.href = '/ri-recipe-to-flavors/index?recipe_id=' + $(this).val();
        })

    }, 750)
</script>
