<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mv_box".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $room_id
 * @property int|null $category_id
 * @property string $description
 */
class MvBox extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mv_box';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id', 'category_id'], 'integer'],
            [['description'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 800],
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
            'room_id' => 'Room ID',
            'category_id' => 'Category ID',
            'description' => 'Description',
        ];
    }
}
