<?php

namespace app\modules\sport_types\models;

use app\components\la\ActiveRecord;

/**
 * This is the model class for table "sport_types".
 *
 * @property integer $id
 * @property string $title
 * @property integer $match_duration
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
            [['match_duration', 'is_active'], 'integer'],
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
            'id'             => 'ID',
            'title'          => 'Название',
            'match_duration' => 'Длительность матча',
            'is_active'      => 'Статус',
            'created_at'     => 'Дата создания',
            'updated_at'     => 'Дата обновления',
        ];
    }

}
