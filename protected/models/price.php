<?php

/**
 * This is the model class for table "item".
 *
 * The followings are the available columns in table 'item':
 * @property string $quantity
 */
class Price extends CActiveRecord
{
   
    /**
	 * @return string the associated database table name
	 */
               public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function tableName()
	{
		return 'price';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	/*public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('quantity', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('quantity', 'safe', 'on'=>'search'),
		);
	}*/

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'item' =>array(self::HAS_MANY, 'Item', 'id_price'),
                    //'price'  =>array(self::HAS_MANY, 'Price', 'id'),
		);
	}

/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'id'          => 'Id',
            'name'        => 'Name',
            'description' => 'Description',
            'price'       => 'Price',
			'quantity'    => 'Quantity',
            'totalprice'  => 'Totalprice',
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
    public function validatePageSize($ps)
    {
        return is_numeric($ps) && array_key_exists($ps, $this->nextPageSize);
    }

public function search()
    {
        return new CActiveDataProvider('Item', array(
            'criteria'   => $this->searchCriteria,
            'pagination' => array(
                'pageSize' => $this->currentPageSize,
            ),
            'sort' => array(
                'multiSort' => true,
            ),
        ));
        
    }

           /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Item the static model class
	 */
	
}