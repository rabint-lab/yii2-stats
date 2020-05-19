<?php

namespace rabint\stats\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use rabint\stats\models\Stats;

/**
 * StatsSearch represents the model behind the search form about `rabint\stats\models\Stats`.
 */
class StatsSearch extends Stats {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['id', 'visit', 'visitor', 'post', 'user', 'download', 'comment', 'like', 'rate', 'error', 'restricted'], 'integer'],
                [['date', 'most_hour', 'visit_in_hour', 'interface', 'most_visited_action', 'most_visitor_user', 'agents', 'referer', 'restricted_ip', 'utms'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param boolean $returnActiveQuery
     *
     * @return ActiveDataProvider OR ActiveQuery
     */
    public function search($params, $returnActiveQuery = FALSE) {
        $query = Stats::find()->alias('stats');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['date' => SORT_DESC]]
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
            'date' => $this->date,
            'visit' => $this->visit,
            'visitor' => $this->visitor,
            'post' => $this->post,
            'user' => $this->user,
            'download' => $this->download,
            'comment' => $this->comment,
            'like' => $this->like,
            'rate' => $this->rate,
            'error' => $this->error,
            'restricted' => $this->restricted,
        ]);

        $query->andFilterWhere(['like', 'most_hour', $this->most_hour])
                ->andFilterWhere(['like', 'visit_in_hour', $this->visit_in_hour])
                ->andFilterWhere(['like', 'interface', $this->interface])
                ->andFilterWhere(['like', 'most_visited_action', $this->most_visited_action])
                ->andFilterWhere(['like', 'most_visitor_user', $this->most_visitor_user])
                ->andFilterWhere(['like', 'agents', $this->agents])
                ->andFilterWhere(['like', 'referer', $this->referer])
                ->andFilterWhere(['like', 'restricted_ip', $this->restricted_ip])
                ->andFilterWhere(['like', 'utms', $this->utms]);

        if ($returnActiveQuery) {
            return $query;
        }
        return $dataProvider;
    }

}
