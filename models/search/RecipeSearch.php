<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Recipe;

/**
 * RecipeSearch represents the model behind the search form of `app\models\Recipe`.
 */
class RecipeSearch extends Recipe
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rating', 'contains_salad', 'contains_gluten'], 'integer'],
            [['title', 'last_date_made'], 'safe'],
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
        $query = Recipe::find();

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
            'rating' => $this->rating,
            'last_date_made' => $this->last_date_made,
            'contains_salad' => $this->contains_salad,
            'contains_gluten' => $this->contains_gluten,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
