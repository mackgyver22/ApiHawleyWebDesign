<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%ote_dish}}".
 *
 * @property int $id
 * @property string $title
 * @property int|null $restaurant_id
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class OteDish extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ote_dish}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['restaurant_id', 'created_at', 'updated_at'], 'integer'],
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
            'restaurant_id' => 'Restaurant ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
