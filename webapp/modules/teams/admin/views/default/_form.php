<?php

use app\modules\sport_types\models\SportTypes;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\teams\models\Teams */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>
        <div class="box-body">
            <?= $form->field($model, 'sport_type_id')->dropDownList(SportTypes::getDropdownList(), ['prompt' => 'Выберите вид спорта']) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'is_active')->checkbox() ?>
        </div>
        
        <div class="box-footer">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Назад', ['index'], ['class' => 'btn btn-white btn-submit btn-submit-cancel']); ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>

