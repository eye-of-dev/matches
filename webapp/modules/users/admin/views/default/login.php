<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\users\models\LoginForm */

$this->title = 'Вход в панель управления';

$form = ActiveForm::begin(); ?>
<?= $form->field($model, 'username', [
    'options' => ['class' => 'form-group has-feedback'],
    'template' => "{label}\n{input}<span class=\"glyphicon glyphicon-user form-control-feedback\"></span>\n{hint}\n{error}"
])->label(false) ?>
<?= $form->field($model, 'password', [
    'options' => ['class' => 'form-group has-feedback'],
    'template' => "{label}\n{input}<span class=\"glyphicon glyphicon-lock form-control-feedback\"></span>\n{hint}\n{error}",
])->label(false)->passwordInput(); ?>
<div class="row">
    <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Войти</button>
    </div>
</div>
<?php ActiveForm::end(); ?>

