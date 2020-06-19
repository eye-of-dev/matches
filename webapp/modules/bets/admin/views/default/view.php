<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\bets\models\Bets */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ставки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Ставка</h3>
    </div>

    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'match_id',
                    'value' => ($model->match) ? $model->match->external_match_id : ''
                ],
                'bet',
                'created_at:datetime'
            ],
        ]) ?>
    </div>

    <div class="box-footer">
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-white btn-submit btn-submit-cancel']); ?>
    </div>
</div>
