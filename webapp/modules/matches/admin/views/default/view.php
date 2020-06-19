<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\matches\models\Matches */

$this->title = $model->external_match_id;
$this->params['breadcrumbs'][] = ['label' => 'Матчи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Матч</h3>
    </div>

    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'sport_type_id',
                    'value' => ($model->sportType) ? $model->sportType->title : ''
                ],
                [
                    'attribute' => 'tournament_id',
                    'value' => ($model->tournament) ? $model->tournament->title : ''
                ],
                'external_match_id',
                [
                    'attribute' => 'team_home_id',
                    'value' => ($model->teamHome) ? $model->teamHome->title : ''
                ],
                [
                    'attribute' => 'team_guest_id',
                    'value' => ($model->teamGuest) ? $model->teamGuest->title : ''
                ],
                'start:datetime',
                'is_bet',
                'created_at:datetime'
            ],
        ]) ?>
        
        <h3 class="box-title">Ставки</h3>
        <?= GridView::widget([
            'dataProvider' => $model->betsDataProvider(),
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
            ],
        ]); ?>
        
        <h3 class="box-title">Mатчи дублeй</h3>
        <?= GridView::widget([
            'dataProvider' => $model->matchesDataProvider(),
            'layout'       => "{items}\n{pager}",
            'options'      => [
                'class' => 'box box-primary'
            ],
            'tableOptions' => [
                'class' => 'table table-bordered table-hover dataTable'
            ],
            'columns'      => [
                ['class' => 'yii\grid\SerialColumn'],
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
                'created_at:datetime',
                [
                    'class'     => \app\components\grid\LAToggleColumn::className(),
                    'attribute' => 'is_bet',
                ],
                [
                    'class'    => yii\grid\ActionColumn::className(),
                    'template' => '{view} {delete}'
                ],
            ],
        ]);
        ?>
        
    </div>

    <div class="box-footer">
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-white btn-submit btn-submit-cancel']); ?>
    </div>
</div>
