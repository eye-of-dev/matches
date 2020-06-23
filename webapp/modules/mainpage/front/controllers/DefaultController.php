<?php

namespace app\modules\mainpage\front\controllers;

use app\modules\matches\models\Matches;
use app\modules\matches\models\MatchesSearch;
use app\components\LAController;
use Yii;

class DefaultController extends LAController
{

    public function actionIndex()
    {

        $this->setMeta('Главная');
        
        $searchModel = new MatchesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel'  => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionError()
    {
        return $this->render('error');
    }

}
