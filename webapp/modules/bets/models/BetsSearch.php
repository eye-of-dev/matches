<?php

namespace app\modules\bets\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\bets\models\Bets;

/**
 * BetsSearch represents the model behind the search form of `app\modules\bets\models\Bets`.
 */
class BetsSearch extends Bets
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'match_id', 'created_at', 'updated_at'], 'integer'],
            [['bet'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Bets::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'match_id' => $this->match_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'bet', $this->bet]);

        return $dataProvider;
    }
}
