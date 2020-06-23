<?php

namespace app\modules\matches\models;

use app\components\la\ActiveRecord;
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
 * @property json $bets
 * @property json $gg_matches
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
            [['sport_type_id', 'tournament_id', 'team_home_id', 'team_guest_id', 'start'], 'integer'],
            [['parent_match_id', 'external_match_id'], 'string', 'max' => 32],
            [['external_match_id'], 'unique'],
            [['sport_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => SportTypes::className(), 'targetAttribute' => ['sport_type_id' => 'id']],
            [['tournament_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tournaments::className(), 'targetAttribute' => ['tournament_id' => 'id']],
            [['team_guest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teams::className(), 'targetAttribute' => ['team_guest_id' => 'id']],
            [['team_home_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teams::className(), 'targetAttribute' => ['team_home_id' => 'id']],
            [['bets', 'gg_matches'], 'safe'],
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
            'end'               => 'Дата окончания матча',
            'bets'              => 'Ставки',
            'gg_matches'        => 'ID матчей дублей',
        ];
    }

    public function getEnd()
    {
        $match_duration = 0;
        if ($this->sportType)
        {
            $match_duration = $this->sportType->match_duration;
        }

        return $this->start + $match_duration;
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
    public function matchesDataProvider()
    {
        $query = self::find()->where(['parent_match_id' => $this->external_match_id]);
        return new \yii\data\ActiveDataProvider([
            'query'      => $query,
            'sort'       => ['defaultOrder' => ['id' => SORT_ASC]],
            'pagination' => false
        ]);
    }

    public function getGroupBets()
    {
        $bets_out = [];

        $bets = $this->bets['bets'];

        if ($bets)
        {
            foreach ($bets as $values)
            {
                foreach ($values as $bet)
                {
                    switch ($bet['T'])
                    {
                        case 1:
                        case 2:
                        case 3:
                        case 4:
                        case 5:
                        case 6:
                            $bets_out[1][] = ['S' => $bet['S'], 'C' => $bet['C']];
                            break;
                        case 7:
                        case 8:
                            $keys = ['7' => 1, '8' => 2];
                            $bets_out[7][$keys[$bet['T']]][] = ['S' => $bet['S'], 'C' => $bet['C']];
                            break;
                        case 9:
                        case 10:
                        case 4548:
                            $keys = ['9' => 1, '10' => 2, '4548' => 3];
                            $bets_out[8][$keys[$bet['T']]][] = ['S' => $bet['S'], 'C' => $bet['C']];
                            break;
                        default:
                            $bets_out[9][$bet['S']] = ['S' => $bet['S'], 'C' => $bet['C']];
                            break;
                    }
                }
            }

            ksort($bets_out);
            ksort($bets_out[9]);
        }

        return json_encode([
            'home'  => $this->teamHome->title,
            'guest' => $this->teamGuest->title,
            'start' => Yii::t('app', '{d, date, d MMMM YYYY в HH:m}', ['d' => $this->start], 'ru-RU'),
            'title' => $this->teamHome->title . ' - ' . $this->teamGuest->title . '. Начало в ' . Yii::t('app', '{d, date, d MMMM YYYY в HH:m}', ['d' => $this->start], 'ru-RU'),
            'bets'  => $bets_out,
                ], JSON_UNESCAPED_UNICODE);
    }

}
