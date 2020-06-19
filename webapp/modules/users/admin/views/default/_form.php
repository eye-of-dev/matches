<?php

use app\modules\users\models\Users;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\users\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

        <div class="col-md-9">
            <div class="box box-primary">
                
                <div class="box-header with-border">
                    <h3 class="box-title">Главные настройки</h3>
                </div>

                <div class="box-body">

                    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'role')->dropDownList(Users::$roles, ['prompt' => 'Выберите роль пользователя']) ?>

                    <?= $form->field($model, 'is_active')->checkbox() ?>
                </div>

                <div class="box-footer">
                    <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Назад', ['index'], ['class' => 'btn btn-white btn-submit btn-submit-cancel']); ?>
                </div>
                
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Миниатюра</h3>
                </div>
                <div class="box-body" id="avatar-min-block">
                    <?= $form->field($model, 'avatar')->fileInput(['multiple' => false, 'accept' => 'image/*']); ?>
                    <div class="form-group">
                        <p id="avatar-min">
                            <?php if($model->avatar): ?>
                            <img src="<?= $model->getFilePath('avatar'); ?>" width="300">
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
<?php
$js = <<<JS
    $("#users-avatar").change(function () {
        if (this.files) {
            $('#avatar-min img').remove();
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#avatar-min').html('<img src="' + e.target.result + '" width="300">');
            };
            reader.readAsDataURL(this.files[0]);
        }

    });
JS;
$this->registerJs($js);
