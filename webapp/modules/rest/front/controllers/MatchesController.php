<?php

namespace app\modules\rest\front\controllers;

class MatchesController extends CommonController
{

    public $modelClass = 'app\modules\rest\models\MatchesData';

    public function actions()
    {
        $actions = parent::actions();

        // отключить действия "delete", "create", "update", "index"
        unset($actions['delete'], $actions['create'], $actions['update'], $actions['index']);

        return $actions;
    }

}
