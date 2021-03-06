<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ospos_sales".
 *
 * @property string $sale_time
 * @property integer $customer_id
 * @property integer $employee_id
 * @property string $comment
 * @property integer $sale_id
 * @property string $payment_type
 *
 * @property OsposEmployees $employee
 * @property OsposCustomers $customer
 * @property OsposSalesItems[] $osposSalesItems
 * @property OsposSalesPayments[] $osposSalesPayments
 */
class Sales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ospos_sales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sale_time'], 'safe'],
            [['customer_id', 'employee_id'], 'integer'],
            [['comment'], 'required'],
            [['comment'], 'string'],
            [['payment_type'], 'string', 'max' => 512],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => OsposEmployees::className(), 'targetAttribute' => ['employee_id' => 'person_id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => OsposCustomers::className(), 'targetAttribute' => ['customer_id' => 'person_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sale_time' => 'Sale Time',
            'customer_id' => 'Customer ID',
            'employee_id' => 'Employee ID',
            'comment' => 'Comment',
            'sale_id' => 'Sale ID',
            'payment_type' => 'Payment Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(OsposEmployees::className(), ['person_id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(OsposCustomers::className(), ['person_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposSalesItems()
    {
        return $this->hasMany(OsposSalesItems::className(), ['sale_id' => 'sale_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposSalesPayments()
    {
        return $this->hasMany(OsposSalesPayments::className(), ['sale_id' => 'sale_id']);
    }
}
