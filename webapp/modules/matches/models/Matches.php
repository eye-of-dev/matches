<?php

namespace app\modules\matches\models;

use app\components\la\ActiveRecord;
use app\modules\bets\models\Bets;
use app\modules\sport_types\models\SportTypes;
use app\modules\teams\models\Teams;
use app\modules\tournaments\models\Tournaments;
use Yii;

/**
 * This is the model class for table "matches".
 *
 * @property integer $id
 * @property integer $sport_type_id
 * @property integer $tournament_id
 * @property string $parent_match_id
 * @property string $external_match_id
 * @property integer $team_home_id
 * @property integer $team_guest_id
 * @property integer $start
 * @property integer $is_bet
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Matches $parentMatch
 * @property Matches[] $matches
 * @property SportTypes $sportType
 * @property Teams $teamGuest
 * @property Teams $teamHome
 * @property Tournaments $tournament
 */
class Matches extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matches';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sport_type_id', 'tournament_id', 'team_home_id', 'team_guest_id', 'start', 'is_bet'], 'integer'],
            [['parent_match_id', 'external_match_id'], 'string', 'max' => 32],
            [['external_match_id'], 'unique'],
            [['sport_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => SportTypes::className(), 'targetAttribute' => ['sport_type_id' => 'id']],
            [['tournament_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tournaments::className(), 'targetAttribute' => ['tournament_id' => 'id']],
            [['team_guest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teams::className(), 'targetAttribute' => ['team_guest_id' => 'id']],
            [['team_home_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teams::className(), 'targetAttribute' => ['team_home_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                => 'ID',
            'sport_type_id'     => 'Вид спорта',
            'tournament_id'     => 'Турнир',
            'parent_match_id'   => 'Родительский матч',
            'external_match_id' => 'Внешний ID матча',
            'team_home_id'      => 'Хозяева',
            'team_guest_id'     => 'Гости',
            'start'             => 'Дата начала матча',
            'is_bet'            => 'Флаг наличия ставок',
            'created_at'        => 'Дата создания',
            'updated_at'        => 'Дата обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatches()
    {
        return $this->hasMany(Matches::className(), ['parent_match_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSportType()
    {
        return $this->hasOne(SportTypes::className(), ['id' => 'sport_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeamGuest()
    {
        return $this->hasOne(Teams::className(), ['id' => 'team_guest_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeamHome()
    {
        return $this->hasOne(Teams::className(), ['id' => 'team_home_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTournament()
    {
        return $this->hasOne(Tournaments::className(), ['id' => 'tournament_id']);
    }
    
    /**
     * @return \yii\data\ActiveDataProvider
     */
    public function betsDataProvider()
    {
        $query = Bets::find()->where(['match_id' => $this->id]);
        return new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort'  => ['defaultOrder' => ['id' => SORT_ASC]],
            'pagination' => false
        ]);
    }

    /**
     * @return \yii\data\ActiveDataProvider
     */
    public function matchesDataProvider()
    {
        $query = self::find()->where(['parent_match_id' => $this->external_match_id]);
        return new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort'  => ['defaultOrder' => ['id' => SORT_ASC]],
            'pagination' => false
        ]);
    }

}
