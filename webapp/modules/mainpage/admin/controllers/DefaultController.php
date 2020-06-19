<?php

namespace app\modules\mainpage\admin\controllers;

use app\components\LAAController;
use yii\web\ErrorAction;

class DefaultController extends LAAController
{

    public function actionIndex()
    {
        return $this->redirect(['/users/default/index']);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::className(),
            ],
        ];
    }

}
