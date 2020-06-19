<?php

namespace app\modules\tournaments\models;

use app\components\la\ActiveRecord;
use Yii;

/**
 * This is the model class for table "tournaments".
 *
 * @property integer $id
 * @property string $title
 * @property integer $is_active
 * @property integer $created_at
 * @property integer $updated_at
 */
class Tournaments extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tournaments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['is_active'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'title'      => 'Название',
            'is_active'  => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

}
