<?php

namespace app\modules\bets\models;

use app\components\la\ActiveRecord;
use app\modules\matches\models\Matches;
use Yii;

/**
 * This is the model class for table "bets".
 *
 * @property int $id
 * @property int|null $match_id Матч
 * @property string|null $bet Ставка
 * @property int|null $created_at Дата создания
 * @property int|null $updated_at Дата обновления
 *
 * @property Matches $match
 */
class Bets extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['match_id', 'created_at', 'updated_at'], 'integer'],
            [['bet'], 'safe'],
            [['match_id'], 'exist', 'skipOnError' => true, 'targetClass' => Matches::className(), 'targetAttribute' => ['match_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'match_id'   => 'Матч',
            'bet'        => 'Ставка',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * Gets query for [[Match]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMatch()
    {
        return $this->hasOne(Matches::className(), ['id' => 'match_id']);
    }

}
