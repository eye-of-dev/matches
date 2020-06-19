<?php

namespace app\components\la;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class ActiveRecord extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        if ($this->hasAttribute('created_at') && $this->hasAttribute('updated_at'))
        {
            $behaviors['timestamp'] = [
                'class'      => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
                ],
                'value'      => new Expression('UNIX_TIMESTAMP()'),
            ];
        }

        return $behaviors;
    }

    public static function getDropdownList($title = 'title', $key = 'id')
    {
        return ArrayHelper::map(static::find()->select([$key, $title])->asArray()->all(), $key, $title);
    }

}
