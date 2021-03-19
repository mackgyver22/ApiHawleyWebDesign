<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%ri_recipe}}".
 *
 * @property int $id
 * @property string $title
 * @property int|null $rating
 * @property string|null $last_date_made
 * @property int|null $contains_salad
 * @property int|null $contains_gluten
 * @property string|null $image_path
 * @property int|null $protein_id
 * @property int|null $difficulty_level_id
 * @property int $is_homechef
 * @property int $is_easy
 * @property int|null $recipe_style_id
 * @property int|null $taste_level_id
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
            [['rating', 'contains_salad', 'contains_gluten', 'protein_id', 'difficulty_level_id', 'is_homechef', 'is_easy', 'recipe_style_id', 'taste_level_id'], 'integer'],
            [['last_date_made'], 'safe'],
            [['title', 'image_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(), // auto sets the created_at and updated_at columns
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'is_deleted' => true
                ],
            ],
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
            'image_path' => 'Image Path',
            'protein_id' => 'Protein ID',
            'difficulty_level_id' => 'Difficulty Level ID',
            'is_homechef' => 'Is Homechef',
            'is_easy' => 'Is Easy',
            'recipe_style_id' => 'Recipe Style ID',
            'taste_level_id' => 'Taste Level ID',
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

    public function getRiProtein()
    {
        return $this->hasOne(RiProtein::className(), ['id' => 'protein_id']);
    }

    public function getRiDifficultyLevel()
    {
        return $this->hasOne(RiDifficultyLevel::className(), ['id' => 'difficulty_level_id']);
    }
}
