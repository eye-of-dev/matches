<?php

use app\modules\sport_types\models\SportTypes;
use app\modules\tournaments\models\Tournaments;

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\matches\models\MatchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Матчи';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'layout'       => "{items}\n{pager}",
    'options'      => [
        'class' => 'box box-primary'
    ],
    'tableOptions' => [
        'class' => 'table table-bordered table-hover dataTable'
    ],
    'rowOptions' => function ($model, $key, $index, $grid) {
        if(!$model->bets) {
            return ['style' => 'background:#fcedd3;'];
        }
    },
    'columns'      => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'sport_type_id',
            'filter' => SportTypes::getDropdownList(),
            'value' => 'sportType.title',
        ],
        [
            'attribute' => 'tournament_id',
            'filter' => Tournaments::getDropdownList(),
            'value' => 'tournament.title',
        ],
        [
            'attribute' => 'external_match_id',
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
        'end:datetime',
        [
            'class'    => yii\grid\ActionColumn::className(),
            'template' => '{view} {delete}'
        ],
    ],
]);
?>
