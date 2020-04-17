<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RiRecipeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tv Moods - Shows Grid';
$this->params['breadcrumbs'][] = $this->title;
?>

<style type="text/css">
    ul.show_cards {
        padding-left: 0px;
    }
    ul.show_cards li {
        text-align: center;
        display: inline-block;
        width: 230px;
        padding: 7px 7px 7px 7px;
        /**/
        margin-bottom: 7px;
    }
    ul.show_cards li .card_text {
        width: 100%;
        text-align: center;
        font-weight: bold;
        font-size:15px;
        margin-top: 7px;
    }
    ul.show_cards li img {
        border: 2px solid black;
        border-radius: 10px 10px 10px 10px;
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
        <ul class="show_cards">
        <?php foreach ($mood_shows as $getMoodShow) : ?>
            <li >
                <?php if ($getMoodShow->show->image_path) : ?>
                    <img src="/image.php?f=<?= urlencode($getMoodShow->show->image_path) ?>&w=200&h=260&effect=crop" />
                <?php else: ?>
                    <img src="https://via.placeholder.com/200x260.png" />
                <?php endif; ?>
                <div class="card_text"><?= $getMoodShow->show->title ?></div>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>

<script>

    setTimeout(function() {

        $('#mood_id').change(function() {

            window.location.href = '/tv-show-mood-items/grid?mood_id=' + $(this).val();
        })

    }, 750)
</script>
