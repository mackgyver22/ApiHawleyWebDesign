<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%tax_expense}}".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $expense_category_id
 * @property float|null $amount
 * @property string|null $vendor
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class TaxExpense extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tax_expense}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(), // auto sets the created_at and updated_at columns
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['expense_category_id', 'created_at', 'updated_at'], 'integer'],
            [['amount'], 'number'],
            [['title'], 'string', 'max' => 800],
            [['vendor'], 'string', 'max' => 255],
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
            'expense_category_id' => 'Expense Category ID',
            'amount' => 'Amount',
            'vendor' => 'Vendor',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
