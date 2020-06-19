<?php

namespace app\modules\matches\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\matches\models\Matches;

/**
 * MatchesSearch represents the model behind the search form about `app\modules\matches\models\Matches`.
 */
class MatchesSearch extends Matches
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sport_type_id', 'tournament_id', 'parent_match_id', 'team_home_id', 'team_guest_id', 'start', 'is_bet'], 'integer'],
            [['external_match_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Matches::find()->where('`parent_match_id` is NULL');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate())
        {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id'              => $this->id,
            'sport_type_id'   => $this->sport_type_id,
            'tournament_id'   => $this->tournament_id,
            'parent_match_id' => $this->parent_match_id,
            'team_home_id'    => $this->team_home_id,
            'team_guest_id'   => $this->team_guest_id,
            'start'           => $this->start,
            'is_bet'          => $this->is_bet,
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'external_match_id', $this->external_match_id]);

        return $dataProvider;
    }

}
