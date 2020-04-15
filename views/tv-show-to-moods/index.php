<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RiRecipeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tv Show Moods';
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
        <label class="control-label" for="recipe_id">TV Show</label>
        <select name="show_id" id="show_id" class="form-control" >
            <?php foreach ($shows as $getShow) : ?>
               <option value="<?= $getShow['id']; ?>" <?= ($getShow['selected']) ? "SELECTED" : ""; ?>><?= $getShow['title']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="item-title">Moods</label>
        <ul class="ingred_checkboxes">
        <?php foreach ($moods as $getMood) : ?>
            <li >
                <input type="checkbox" name="mood_id[]" id="mood_id[]" value="<?= $getMood['id']; ?>" <?= ($getMood['selected'] == "1") ? "CHECKED" : ""; ?>/>&nbsp; <?= $getMood['title']; ?>
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



        $('#show_id').change(function() {

            window.location.href = '/tv-show-to-moods/index?show_id=' + $(this).val();
        })

    }, 750)
</script>
