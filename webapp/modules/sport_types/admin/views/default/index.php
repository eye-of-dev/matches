<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\sport_types\models\SportTypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Виды спорта';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
    <?= Html::a('Создать вид', ['create'], ['class' => 'btn btn-success btn-flat']); ?>
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
        'match_duration',
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


