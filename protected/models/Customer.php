<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $customer_id
 * @property string $account_balnce
 * @property string $customer_type
 */
class Customer extends CActiveRecord
{

    const CUSTOMER_STANDART = 0;
    const CUSTOMER_SILVER = 1000;
    const CUSTOMER_GOLD = 3000;
    const CUSTOMER_PLATINUM = 10000;

    const STANDART_DISCOUNT = 0;
    const SILVER_DISCOUNT = 3;
    const GOLD_DISCOUNT = 5;
    const PLATINUM_DISCOUNT = 10;


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id', 'numerical', 'integerOnly'=>true),
			array('account_balance', 'length', 'max'=>6),
			array('customer_type', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('customer_id, account_balance, customer_type', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'customer_id' => 'Customer',
			'account_balance' => 'Account Balance',
			'customer_type' => 'Customer Type',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('account_balance',$this->account_balnce,true);
		$criteria->compare('customer_type',$this->customer_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function updateBalance($sum, $id_customer)
    {
        $customer_info = $this->findByPk($id_customer);
        $customer_info->account_balance += $sum;
        $this->checkType($customer_info);
        $customer_info->save();
    }

    public  function checkType($customer_info)
    {
        if(($customer_info->account_balance > self::CUSTOMER_STANDART)
            && ($customer_info->account_balance < self::CUSTOMER_SILVER)
        ) {
            $customer_info->customer_type = "Standart";
        }
        elseif(($customer_info->account_balance >= self::CUSTOMER_SILVER) &&
            ($customer_info->account_balance < self::CUSTOMER_GOLD)
        ) {
            $customer_info->customer_type = "Silver";
        }
        elseif(($customer_info->account_balance >= self::CUSTOMER_GOLD)
            && ($customer_info->account_balance < self::CUSTOMER_PLATINUM)
        ) {
            $customer_info->customer_type = "Gold";
        }
        elseif($customer_info->account_balance >= self::CUSTOMER_PLATINUM) {
            $customer_info->customer_type = "Platinum";
        }
    }

    public function getDiscount($id_customer)
    {
        $customer_info = $this->findByPk($id_customer);
        switch($customer_info->customer_type) {
            case "Standart":
                return self::STANDART_DISCOUNT;
                break;

            case "Silver":
                return self::SILVER_DISCOUNT;
                break;

            case "Gold":
                return self::GOLD_DISCOUNT;
                break;

            case "Platinum":
                return self::PLATINUM_DISCOUNT;
                break;
        }
    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Customer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
