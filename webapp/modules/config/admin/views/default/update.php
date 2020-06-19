<?php

    /* @var $this yii\web\View */
    /* @var $model app\modules\config\models\Config */

    $this->title = 'Изменение параметра: ' . ' ' . $model->title;
    $this->params['breadcrumbs'][] = ['label' => 'Параметры системы', 'url' => ['index']];
    $this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
