<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%wl_week_log}}".
 *
 * @property int $id
 * @property int $week_start
 * @property int $week_end
 * @property int $rating
 */
class WlWeekLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%wl_week_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['week_start', 'week_end', 'rating'], 'required'],
            [['week_start', 'week_end', 'rating'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'week_start' => 'Week Start',
            'week_end' => 'Week End',
            'rating' => 'Rating',
        ];
    }
}
