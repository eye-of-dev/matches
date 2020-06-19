<?php

    /* @var $this yii\web\View */
    /* @var $model app\modules\config\models\Config */

    $this->title = 'Новый параметр';
    $this->params['breadcrumbs'][] = ['label' => 'Параметры системы', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
