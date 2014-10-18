<?php

/**
 * This is the model class for table "ibeacon".
 *
 * The followings are the available columns in table 'ibeacon':
 * @property string $ibeacon_uuid
 * @property integer $minor
 * @property integer $major
 * @property string $title
 * @property string $message
 * @property string $image
 * @property integer $ibeacon_id
 */
class Ibeacon extends CActiveRecord
{

	public $currentPageSize = 10;
    public $filterValue;
  
    public $searchValue;
    public $nextPageSize = array(10=>25,25=>2,2=>3,3=>10);

    public $searchCriteria;

    public $searchCriterias = array('ibeacon_uuid'=>'UUID','minor'=>'Minor','major'=>'Major','title'=>'Title','message'=>'Message','image'=>'Image');
   
  
    public $filterCriteria;
    public $filterCriterias = array('UUID', 'Minor','Major','Title','Message','Image');

    public $addI;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ibeacon';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ibeacon_uuid, minor, major, title, message, image', 'required'),
			array('ibeacon_id', 'unique'),
			array('minor, major', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>20),
			array('minor', 'length', 'max'=>65000),
			array('major', 'length', 'max'=>65000),
			array('ibeacon_uuid', 'unique'),
			array('ibeacon_uuid', 'match', 'not'=> true, 'pattern' => '[\s]', 'message' => 'Ibeacon uuid cannot contain spaces','except'=>'remove'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ibeacon_uuid, minor, major, title, message, image, ibeacon_id,searchValue, searchCriteria, searchCriterias', 'safe', 'on'=>'search'),
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
			'ibeacon_uuid' => 'UUID',
			'minor' => 'Minor',
			'major' => 'Major',
			'title' => 'Title',
			'message' => 'Message',
			'image' => 'Image',
			'ibeacon_id' => 'ID',
		);
	}

	 public function validatePageSize($ps)
    {
        return is_numeric($ps) && array_key_exists($ps, $this->nextPageSize);
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

		$criteria->compare('ibeacon_uuid',$this->ibeacon_uuid,true);
		$criteria->compare('minor',$this->minor,true);
		$criteria->compare('major',$this->major,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('image',$this->image,true);
		//$criteria->compare('ibeacon_id',$this->ibeacon_id);


		if ($this->searchValue!="")
        {
            $keyword = strtr($this->searchValue, array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%';
            $criteria->compare($this->searchCriteria, $keyword, true, 'AND', false);
        }

        $sort=new CSort;
        $sort->attributes=array(
            'ibeacon_id'=>array(
               'asc'=>'ibeacon_id',
                'desc'=>'ibeacon_id desc',
            ),
        );

		return new CActiveDataProvider($this,array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>$this->currentPageSize,
              
            ),
                'sort'=>$sort,
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ibeacon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}









}
