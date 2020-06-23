<?php
/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php $this->beginPage() ?>
<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $this->title ?></title>
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="container">
    <?= $content ?>
    </div>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage() ?>

