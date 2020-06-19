<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\users\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'layout' => "{items}\n{pager}",
    'options' => [
        'class' => 'box box-primary'
    ],
    'tableOptions' => [
        'class' => 'table table-bordered table-hover dataTable'
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'username',
        'name',
        'email:email',
        'created_at:datetime',
        [
            'class' => \app\components\grid\LAToggleColumn::className(),
            'attribute' => 'is_active',
        ],
        [
            'class' => yii\grid\ActionColumn::className(),
            'template' => '{update} {delete}'
        ],
    ],
]); ?>

