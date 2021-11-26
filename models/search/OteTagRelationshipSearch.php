<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OteTagRelationship;

/**
 * OteTagRelationshipSearch represents the model behind the search form of `app\models\OteTagRelationship`.
 */
class OteTagRelationshipSearch extends OteTagRelationship
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tag_id', 'ref_table_id', 'created_at', 'updated_at'], 'integer'],
            [['ref_table'], 'safe'],
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
        $query = OteTagRelationship::find();

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
            'tag_id' => $this->tag_id,
            'ref_table_id' => $this->ref_table_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'ref_table', $this->ref_table]);

        return $dataProvider;
    }
}
