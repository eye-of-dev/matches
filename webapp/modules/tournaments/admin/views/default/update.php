<?php

/* @var $this yii\web\View */
/* @var $model app\modules\tournaments\models\Tournaments */

$this->title = 'Обновить турнир: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Турниры', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
