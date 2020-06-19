<?php

/* @var $this yii\web\View */
/* @var $model app\modules\tournaments\models\Tournaments */

$this->title = 'Создать турниры';
$this->params['breadcrumbs'][] = ['label' => 'Турниры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
