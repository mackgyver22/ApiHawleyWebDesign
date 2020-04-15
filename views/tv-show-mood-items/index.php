<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RiRecipeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tv Moods - Shows';
$this->params['breadcrumbs'][] = $this->title;
?>

<style type="text/css">
    ul.ingred_checkboxes {
        /*padding-left: 0px;*/
    }
    ul.ingred_checkboxes li {
        /*display: inline-block;
        min-width: 75px;
        max-width: 300px;
        padding: 0 7px 10px 0;*/
    }
</style>

<div class="ri-recipe-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group ">
        <label class="control-label" for="recipe_id">Moods</label>
        <select name="mood_id" id="mood_id" class="form-control" >
            <?php foreach ($moods as $getMood) : ?>
               <option value="<?= $getMood['id']; ?>" <?= ($getMood['selected']) ? "SELECTED" : ""; ?>><?= $getMood['title']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="item-title">Shows</label>
        <ul class="ingred_checkboxes">
        <?php foreach ($mood_shows as $getMoodShow) : ?>
            <li ><?= $getMoodShow->show->title ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>

<script>

    setTimeout(function() {

        $('#mood_id').change(function() {

            window.location.href = '/tv-show-mood-items/index?mood_id=' + $(this).val();
        })

    }, 750)
</script>
