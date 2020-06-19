<?php

    use yii\grid\GridView;

    /* @var $this yii\web\View */
    /* @var $searchModel app\modules\config\models\ConfigSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */

    $this->title = 'Настройки системы';
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
        'title',
        'param',
        'value',
        [
            'class' => yii\grid\ActionColumn::className(),
            'template' => '{update} {delete}'
        ],
    ],
]); ?>
