<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\nav\NavX;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    echo NavX::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
             ['label' => 'Moving', 'items' => [
                ['label' => 'Boxes', 'url' => '/mv-box'],
                ['label' => 'Categories', 'url' => '/mv-category'],
                ['label' => 'Rooms', 'url' => '/mv-room']
            ]],
            ['label' => 'Items', 'url' => '/item'],
            ['label' => 'Tax Expenses', 'url' => '/tax-expense'],
            ['label' => 'Tax Expense Categories', 'url' => '/tax-expense-category'],
            ['label' => 'TV Shows', 'items' => [
                ['label' => 'What To Watch', 'url' => '/tv-show-mood-items/grid'],
                ['label' => 'What To Watch List', 'url' => '/tv-show-mood-items/index'],
                ['label' => 'Shows', 'url' => '/tv-show/index'],
                ['label' => 'Moods', 'url' => '/tv-mood/index'],
                ['label' => 'Show Types', 'url' => '/tv-show-type/index'],
                ['label' => 'TV Services', 'url' => '/tv-service/index'],
                ['label' => 'TV Show Moods', 'url' => '/tv-show-to-moods/index'],

            ]],
            ['label' => 'Out To Eat', 'items' => [
                ['label' => 'Restaurants', 'url' => '/ote-restaurant/index'],
                ['label' => 'Dishes', 'url' => '/ote-dish/index'],
                ['label' => 'Tags', 'url' => '/ote-tag/index'],
                ['label' => 'Assign Tags', 'url' => '/ote-tag-relationship/index'],


            ]],
            ['label' => 'Recipe Ingredients', 'items' => [
                ['label' => 'Most Frequently Used Ingredients', 'url' => '/index2.php'],
                ['label' => 'Top Recipes', 'url' => '/ri-recipe/top-recipes'],
                ['label' => 'Recipes', 'url' => '/ri-recipe/index'],
                ['label' => 'Home Inventory', 'url' => '/ri-home-inventory-items/index'],
                ['label' => 'Commonly Used Ingredients', 'url' => '/ri-ingredient/common-ingredients'],
                ['label' => 'Ingredients', 'url' => '/ri-ingredient/index'],
                ['label' => 'Recipe Ingredients', 'url' => '/ri-recipe-to-ingredients/index'],
                ['label' => 'Ingredient Types', 'url' => '/ri-ingredient-type/index'],
                ['label' => 'Ingredient Price History', 'url' => '/ri-ingredient-price-history/index'],
                ['label' => 'Flavors', 'url' => '/ri-flavor/index'],
                ['label' => 'Recipe Flavors', 'url' => '/ri-recipe-to-flavors/index'],
                ['label' => 'Attributes', 'url' => '/ri-attribute/index'],
                ['label' => 'Grocery Store', 'url' => '/ri-grocery-store/index'],
            ]],
            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/item']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
        ],
        'encodeLabels' => false
    ]);

    /*/
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Items', 'url' => ['/item']],
            [
                'label' => 'Recipe Ingredients',
                'items' => [
                    'label' => 'Test 1', 'url' => '/item'
                ]
            ],
//            ['label' => 'Home', 'url' => ['/site/index']],
//            ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/item']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
//            Yii::$app->user->isGuest ? (
//                ['label' => 'Login', 'url' => ['/site/login']]
//            ) : (
//                '<li>'
//                . Html::beginForm(['/site/logout'], 'post')
//                . Html::submitButton(
//                    'Logout (' . Yii::$app->user->identity->username . ')',
//                    ['class' => 'btn btn-link logout']
//                )
//                . Html::endForm()
//                . '</li>'
//            )
        ],
    ]);
//*/
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
