<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\tournaments\models\TournamentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Турниры';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
    <?= Html::a('Создать турнир', ['create'], ['class' => 'btn btn-success btn-flat']); ?>
</p>
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