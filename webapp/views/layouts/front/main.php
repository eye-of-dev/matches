<?php
/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php $this->beginPage() ?>
<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title><?= $this->title ?></title>
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage() ?>

