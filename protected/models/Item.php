<?php

class Item extends CActiveRecord
{
    public $currentPageSize = 10;
    public $filterValue;
  
    public $searchValue;
    public $nextPageSize = array(10=>25,25=>2,2=>3,3=>10);

    public $searchCriteria;

    public $searchCriterias = array('id_item'=>'Id Item','name'=>'Item Name','description'=>'Description','price'=>'Price','quantity'=>'Quantity');
   
  
    public $filterCriteria;
    public $filterCriterias = array('Id Item', 'Item Name','Description','Price','Quantity');

    public $addI;

         /**
         * @return string the associated database table name
         */
	public function tableName()
	{
		return 'item';
	}
        /**
         * @return array validation rules for model attributes.
         */
	public function rules()
	{
		return array(
			array('id_item,price,quantity', 'required'),
                        array('id_item','unique'),
			array('quantity','numerical', 'integerOnly'=>true),
                        array('price','numerical'),
			array('name', 'length', 'max'=>40),
			array('description', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
                        array('id_item, searchValue, searchCriteria, searchCriterias, price, name, description, quantity', 'safe', 'on'=>'search'),

			
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(

            'order_items' => array(self::HAS_MANY, 'OrderItem', 'id_item'),
           // 'dimension' => array(self::HAS_MANY, 'OrderItem', 'id_item'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_item' => 'Item Number',
                        'price'=>'Price',
			'name' => 'Item Name',
			'description' => 'Item Description',
                        'quantity' => 'Quantity',
		);
	}


    public function validatePageSize($ps)
    {
        return is_numeric($ps) && array_key_exists($ps, $this->nextPageSize);
    }

    public function search()
    {
        
        $criteria= new CDbCriteria;
    // $criteria->compare('id_item',$this->id_item,true);
      $criteria->compare('name',$this->name,true);
      $criteria->compare('price',$this->price,true);
 
      
        if ($this->searchValue!="")
        {
            $keyword = strtr($this->searchValue, array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%';
            $criteria->compare($this->searchCriteria, $keyword, true, 'AND', false);
        }

                
       $sort=new CSort;
        $sort->attributes=array(
            'id_item'=>array(
               'asc'=>'id_item',
                'desc'=>'id_item desc',
            ),
            'price'=>array(
                'asc'=>'price',
                'desc'=>'price desc',
                ),
            'quantity'=>array(
                'asc'=>'quantity',
                'desc'=>'quantity desc',
                )
        );
        
return new CActiveDataProvider($this,array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>$this->currentPageSize,
              
            ),
                'sort'=>$sort,
        ));

    }
    
       
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}

