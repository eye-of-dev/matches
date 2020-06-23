<?php

use app\modules\sport_types\models\SportTypes;

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\teams\models\TeamsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Команды';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
    <?= Html::a('Создать команду', ['create'], ['class' => 'btn btn-success btn-flat']); ?>
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
        [
            'attribute' => 'sport_type_id',
            'filter' => SportTypes::getDropdownList(),
            'value' => 'sportType.title',
        ],
        'external_match_id',
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
