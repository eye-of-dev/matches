<?php

namespace app\modules\rest\front\controllers;

use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class CommonController extends ActiveController
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
                    'corsFilter' => [
                        'class' => Cors::className()
                    ]
        ]);
    }

}
