<?php

/**
 *  class.
 *  is the data structure for keeping
 * 
 */
class AdminSearchForm extends CFormModel
{
    public $keyField;
    public $criteria;
    public $keyValue;

    public $keyFields = array('All Columns', 'User Name', 'First Name', 'Last Name', 'Role');
    public $criterias = array('equals','not equals','starts with','contains','does not contain');

    public $keyAttributes = array(
        'All Columns' => array('username','firstname','lastname','role','email','region'),
        'User Name'   => 'username',
        'First Name'  => 'firstname',
        'Last Name'   => 'lastname',
        'Role'        => 'role'
    );

    public $operators = array(
        'equals'           => " =?",
        'not equals'       => " <>?",
        'starts with'      => " LIKE ? '%'",
        'contains'         => " LIKE '%' ? '%'",
        'does not contain' => " NOT LIKE '%' ? '%'"
    );

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array('keyValue', 'required', 'message'=>'please, fill the field before search'),
            array('keyValue', 'length', 'max'=>128),
            //array('keyField, criteria', 'numerical', 'message'=>'illegal filter parameters'),
            array('keyField, criteria', 'validateIndex', 'size'=>4, 'message'=>'illegal filter parameters'),
            array('keyField, criteria, keyValue','safe','on'=>'search'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
        );
    }

    public function validateIndex($index,$size)
    {
        return (0<=$index)&&($index<$size);
    }

    public function getCriteria()
    {

        $keyAttr = $this->keyAttributes[$this->keyFields[$this->keyField]];
        if( !is_array($keyAttr) ) {

            $condition = $keyAttr . $this->operators[$this->criterias[$this->criteria]];

            return array(
                'condition' => $condition,
                'params'    => array($this->keyValue)
            );

        } else {

            $numKeys = count($keyAttr);

            $condition = '';

            $criteria = $this->operators[$this->criterias[$this->criteria]];

            for($i=0; $i < $numKeys-1; ++$i) {
                $condition .= '(' . $keyAttr[$i] . $criteria . ') OR ';
            }

            $condition .= '(' . $keyAttr[$numKeys-1] . $criteria . ')';

            return array(
                'condition'  => $condition,
                'params'     => array_fill(1,$numKeys,$this->keyValue)
            );

        }        
    }

}
