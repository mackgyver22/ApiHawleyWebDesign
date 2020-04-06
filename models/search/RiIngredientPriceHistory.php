<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RiIngredientPriceHistory as RiIngredientPriceHistoryModel;

/**
 * RiIngredientPriceHistory represents the model behind the search form of `app\models\RiIngredientPriceHistory`.
 */
class RiIngredientPriceHistory extends RiIngredientPriceHistoryModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ingredient_id', 'grocery_store_id'], 'integer'],
            [['price'], 'number'],
            [['date_purchased'], 'safe'],
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
        $query = RiIngredientPriceHistoryModel::find();

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
            'ingredient_id' => $this->ingredient_id,
            'price' => $this->price,
            'date_purchased' => $this->date_purchased,
            'grocery_store_id' => $this->grocery_store_id,
        ]);

        return $dataProvider;
    }
}
