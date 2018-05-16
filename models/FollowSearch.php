<?php

namespace elephantsGroup\follow\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use elephantsGroup\follow\models\Follow;

/**
 * FollowSearch represents the model behind the search form about `elephantsGroup\follow\models\Follow`.
 */
class FollowSearch extends Follow
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'item_id', 'service_id', 'user_id', 'follow'], 'integer'],
            [['ip', 'update_time', 'creation_time'], 'safe'],
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
        $query = Follow::find();

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
            'item_id' => $this->item_id,
            'service_id' => $this->service_id,
            'user_id' => $this->user_id,
            'follow' => $this->follow,
            'update_time' => $this->update_time,
            'creation_time' => $this->creation_time,
        ]);

        $query->andFilterWhere(['follow', 'ip', $this->ip]);

        return $dataProvider;
    }
}
