<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\config\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary">

    <?php $form = ActiveForm::begin(); ?>
        <div class="box-body">
            <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'param')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'value')->textInput(['maxlength' => 255]) ?>
        </div>
        
        <div class="box-footer">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Назад', ['index'], ['class' => 'btn btn-white btn-submit btn-submit-cancel']); ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
