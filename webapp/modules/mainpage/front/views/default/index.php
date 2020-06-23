<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'layout'       => "{items}\n{pager}",
    'options'      => [
        'class' => 'box box-primary'
    ],
    'tableOptions' => [
        'class' => 'table table-striped'
    ],
    'rowOptions' => function ($model, $key, $index, $grid) {
        if(!$model->bets) {
            return ['style' => 'background:#fcedd3;'];
        }
    },
    'columns'      => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'external_match_id',
            'format' => 'raw',
            'value' => function ($model){
                return Html::a($model->external_match_id, Url::to(['/matches/default/view/', 'id' => $model->id]), ['target' => '_blank']);
            }
        ],
        [
            'attribute' => 'team_home_id',
            'value' => 'teamHome.title',
        ],
        [
            'attribute' => 'team_guest_id',
            'value' => 'teamGuest.title',
        ],
        'start:datetime',
        'end:datetime'
    ],
]);
?>