<?php

namespace app\modules\teams\models;

use app\components\la\ActiveRecord;
use app\modules\sport_types\models\SportTypes;
use Yii;

/**
 * This is the model class for table "teams".
 *
 * @property integer $id
 * @property integer $sport_type_id
 * @property string $title
 * @property integer $is_active
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property SportTypes $sportType
 */
class Teams extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teams';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sport_type_id', 'is_active'], 'integer'],
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['sport_type_id', 'title'], 'unique', 'targetAttribute' => ['sport_type_id', 'title'], 'message' => 'The combination of Вид спорта and Название has already been taken.'],
            [['sport_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => SportTypes::className(), 'targetAttribute' => ['sport_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'sport_type_id' => 'Вид спорта',
            'title'         => 'Название',
            'is_active'     => 'Статус',
            'created_at'    => 'Дата создания',
            'updated_at'    => 'Дата обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSportType()
    {
        return $this->hasOne(SportTypes::className(), ['id' => 'sport_type_id']);
    }

}
