<?php


/* @var $this yii\web\View */
/* @var $model app\modules\sport_types\models\SportTypes */

$this->title = 'Создать вид';
$this->params['breadcrumbs'][] = ['label' => 'Виды спорта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>


