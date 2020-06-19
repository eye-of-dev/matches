<?php

namespace app\modules\sport_types\models;

use app\components\la\ActiveRecord;

/**
 * This is the model class for table "sport_types".
 *
 * @property integer $id
 * @property string $title
 * @property integer $is_active
 * @property integer $created_at
 * @property integer $updated_at
 */
class SportTypes extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sport_types';
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
