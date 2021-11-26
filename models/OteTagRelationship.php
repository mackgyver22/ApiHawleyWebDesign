<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%ote_tag_relationship}}".
 *
 * @property int $id
 * @property int $tag_id
 * @property string $ref_table
 * @property int $ref_table_id
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class OteTagRelationship extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ote_tag_relationship}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tag_id', 'ref_table', 'ref_table_id'], 'required'],
            [['tag_id', 'ref_table_id', 'created_at', 'updated_at'], 'integer'],
            [['ref_table'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_id' => 'Tag ID',
            'ref_table' => 'Ref Table',
            'ref_table_id' => 'Ref Table ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
