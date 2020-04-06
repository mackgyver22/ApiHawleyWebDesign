<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%ri_recipe}}".
 *
 * @property int $id
 * @property string $title
 * @property int|null $rating
 * @property string|null $last_date_made
 * @property int|null $contains_salad
 * @property int|null $contains_gluten
 *
 * @property RiRecipeAttribute[] $riRecipeAttributes
 * @property RiRecipeFlavor[] $riRecipeFlavors
 * @property RiRecipeIngredient[] $riRecipeIngredients
 */
class RiRecipe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ri_recipe}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['rating', 'contains_salad', 'contains_gluten'], 'integer'],
            [['last_date_made'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'rating' => 'Rating',
            'last_date_made' => 'Last Date Made',
            'contains_salad' => 'Contains Salad',
            'contains_gluten' => 'Contains Gluten',
        ];
    }

    /**
     * Gets query for [[RiRecipeAttributes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRiRecipeAttributes()
    {
        return $this->hasMany(RiRecipeAttribute::className(), ['recipe_id' => 'id']);
    }

    /**
     * Gets query for [[RiRecipeFlavors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRiRecipeFlavors()
    {
        return $this->hasMany(RiRecipeFlavor::className(), ['recipe_id' => 'id']);
    }

    /**
     * Gets query for [[RiRecipeIngredients]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRiRecipeIngredients()
    {
        return $this->hasMany(RiRecipeIngredient::className(), ['recipe_id' => 'id']);
    }
}
