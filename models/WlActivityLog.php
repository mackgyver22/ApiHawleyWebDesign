<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%wl_activity_log}}".
 *
 * @property int $id
 * @property int $activity_id
 * @property int $date_occured
 */
class WlActivityLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%wl_activity_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_id', 'date_occured'], 'required'],
            [['activity_id', 'date_occured'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => 'Activity ID',
            'date_occured' => 'Date Occured',
        ];
    }
}
