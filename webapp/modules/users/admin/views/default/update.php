<?php

    /* @var $this yii\web\View */
    /* @var $model app\modules\users\models\Users */

    $this->title = 'Изменение записи: ' . ' ' . $model->email;
    $this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
