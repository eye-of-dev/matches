<?php

namespace app\components;

use app\assets\AppAsset;
use app\modules\config\models\Config;
use yii\base\View;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;

class LAController extends Controller
{

    protected $meta;
    public $layout = '//front/main';
    public $siteConfig;
    public $actions = [];
    public $routeUrl;

    /**
     * @var array
     */
    public $breadcrumbs;

    public function init()
    {
        parent::init();

        //  \Yii::$app->db->createCommand("SET time_zone='+06:00';'")->execute();

        $this->getView()->on(View::EVENT_BEFORE_RENDER, function () {
            AppAsset::register($this->getView());
        });
    }

    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }

    public function setMeta($title, $description = null, $meta_keywords = null, $image = null, $url = null, $rest = [])
    {
        if (\Yii::$app->request->isAjax)
        {
            return;
        }

        if (empty($title))
        {
            $this->getView()->title = Config::getParamValue('sitename');
        }
        else
        {
            $this->getView()->title = $title . ' &mdash; ' . Config::getParamValue('sitename');
        }

        if ($image && mb_strpos($image, '//') === false)
        {
            $image = Url::host() . $url;
        }
        if ($url && mb_strpos($url, '//') === false)
        {
            $url = Url::host() . $url;
        }
        $properties = ArrayHelper::merge([
                    'og:title'       => $title,
                    'og:description' => $description,
                    'og:image'       => $image,
                        ], $rest);

        if (empty($description))
        {
            $description = Config::getParamValue('meta_description', '');
        }

        if (empty($meta_keywords))
        {
            $meta_keywords = Config::getParamValue('meta_keywords', '');
        }

        $seoMeta = ['description' => $description, 'keywords' => $meta_keywords];

        if ($url !== false && empty($url))
        {
            $url = Url::canonical();
        }
        if ($url)
        {
            $this->getView()->registerLinkTag([
                'href' => $url,
                'rel'  => 'canonical'
                    ], 'canonical');
        }
        foreach ($seoMeta as $seoName => $seoValue)
        {
            if (!$seoValue)
            {
                continue;
            }

            $this->getView()->registerMetaTag([
                'name'    => $seoName,
                'content' => $seoValue
            ]);
        }
        foreach ($properties as $prop => $value)
        {
            if (!$value)
            {
                continue;
            }
            $this->getView()->registerMetaTag([
                'property' => $prop,
                'content'  => $value
            ]);
        }
    }

    public function behaviors()
    {
        return [
            'xssXlean'           => [
                'class' => XssFilter::className()
            ],
            [
                'class'        => 'yii\filters\HttpCache',
                'lastModified' => function ($action, $params) {
                    return time() + 60;
                },
                'cacheControlHeader' => 'public, max-age=1'
            ],
        ];
    }

}
