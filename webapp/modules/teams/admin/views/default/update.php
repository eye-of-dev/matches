<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\teams\models\Teams */

$this->title = 'Обновиить команду: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Команды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
