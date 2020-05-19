<?php

namespace rabint\stats\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use rabint\stats\models\Dailies;

/**
 * DailiesSearch represents the model behind the search form about `rabint\stats\models\Dailies`.
 */
class DailiesSearch extends Dailies
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['time', 'request', 'agent', 'ip', 'request_type', 'utm'], 'safe'],
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
        $query = Dailies::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'time' => $this->time,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'request', $this->request])
            ->andFilterWhere(['like', 'agent', $this->agent])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'request_type', $this->request_type])
            ->andFilterWhere(['like', 'utm', $this->utm]);

        return $dataProvider;
    }
}
