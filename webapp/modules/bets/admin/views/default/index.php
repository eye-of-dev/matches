<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\bets\models\BetsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ставки';
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
        [
            'attribute' => 'match_id',
            'value' => 'match.external_match_id',
        ],
        [
            'attribute' => 'bet',
            'format' => 'raw',
            'value' => function ($model) {
                $html = '';
                foreach ($model->bet as $key => $value){
                    $html .= $key . ': ' . $value . ';';
                }
                return $html;
            }
        ],
        'created_at:datetime',
        [
            'class' => yii\grid\ActionColumn::className(),
            'template' => '{view} {delete}'
        ],
    ],
]); ?>