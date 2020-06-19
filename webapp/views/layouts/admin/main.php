<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use dmstr\web\AdminLteAsset;

AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="<?= \dmstr\helpers\AdminLteHelper::skinClass() ?>">
        <?php $this->beginBody() ?>
        <div class="wrapper">

	<?= $this->render('partials/header.php'); ?>

            <aside class="main-sidebar">
                <?= $this->render('partials/sidebar.php'); ?>
            </aside>
            
            <div class="content-wrapper">
                <section class="content-header">
                    <h1> <?= \yii\helpers\Html::encode($this->title); ?> </h1>
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                </section>
                <section class="content">
                    <?= $content ?>
                </section>
            </div>
            <footer class="main-footer">
                <div class="container-fluid">
                    <p class="pull-left">&copy; My Template <?= date('Y') ?></p>
                </div>
            </footer>
        </div>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
