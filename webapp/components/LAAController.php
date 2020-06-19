<?php

namespace app\components;

use app\assets\AppAsset;
use dosamigos\grid\actions\ToggleAction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\View;

class LAAController extends \yii\web\Controller
{

    public $layout = '//admin/main';
    protected $_modelName = null;
    public $siteConfig;
    public $allowedRoles = [];

    public function init()
    {
        parent::init();

        $this->getView()->on(View::EVENT_BEFORE_RENDER, function () {
            AppAsset::register($this->getView());
        });
    }

    public function behaviors()
    {
        return [
            [
                'class'  => AccessControl::className(),
                'except' => ['login', 'error', 'logout'],
                'rules'  => [
                    [
                        'allow'         => true,
                        'matchCallback' => function () {
                            if (!\Yii::$app->getUser()->getIsGuest())
                            {
                                if (empty(\Yii::$app->controller->allowedRoles) || !is_array(\Yii::$app->controller->allowedRoles))
                                {

                                    return \Yii::$app->user->getIdentity()->checkRole(['admin']);
                                }
                                return \Yii::$app->getUser()->getIdentity()->checkRole(\Yii::$app->controller->allowedRoles);
                            }
                            return false;
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ]
        ];
    }

    public function actions()
    {
        return [
            'toggle' => [
                'class'      => ToggleAction::className(),
                'modelClass' => $this->getModelName(),
                'onValue'    => 1,
                'offValue'   => 0
            ],
        ];
    }

    public function getModelName()
    {
        if ($this->_modelName === null)
        {
            $this->_modelName = ucfirst($this->id);
        }

        return $this->_modelName;
    }

}
