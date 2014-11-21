<?php

/**
 *  class.
 *  is the data structure for keeping
 *
 */
class CustomerSearchForm extends CFormModel
{

    public $filterCriteria;
    public $filterRole;
    public $filterStatus;
    public $searchField;
    public $searchValue;

    public $filterCriterias = array('Status', 'Role');
    public $filterStatuses = array('None', 'Ordered', 'Pending', 'Delivered');
    public $filterRoles = array('None', 'Merchandiser', 'Administrator', 'Supervisor');
    public $searchFields = array('Order Name', 'Status', 'Assignee');

    public $filterAttributes = array(
        'Status' => 'status',
        'Role' => 'assignees.role',
    );

    public $searchAttributes = array(
        'None' => '',
        'Order Name' => 'order_name',
        'Status' => 'status',
        'Assignee' => 'assignees.username',
    );

    public $statusAttributes = array(
        'None' => '',
        'User Name' => 'username',
        'First Name' => 'firstname',
        'Last Name' => 'lastname',
        'Role' => 'role'
    );

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            array('searchValue', 'required', 'message' => 'please, fill the field before search'),
            array('filterStatuses, filterRoles', 'required', 'message' => 'please, fill the field before search'),
            array('searchValue', 'length', 'max' => 128),
            array('filterCriteria,filterStatus, filterRole,searchField', 'numerical', 'message' => 'illegal filter parameters'),
            array('filterCriteria,filterStatus, filterRole,searchField', 'safe', 'on' => 'search'),
        );
    }


    /**
     * Declares attribute labels.
     */


    public function attributeLabels()
    {
        return array();
    }

    public function getCriteria()
    {
        if((int)$this->filterStatus == 0)
        {
            $condition = $this->searchAttributes[$this->searchFields[$this->searchField]] . " LIKE '" . $this->searchValue . "%'";
        }else{
        if((int)$this->filterCriteria == 0){
            $condition = $this->filterAttributes[$this->filterCriterias[$this->filterCriteria]] . "='" . $this->filterStatuses[$this->filterStatus] . "' AND "
                .$this->searchAttributes[$this->searchFields[$this->searchField]] . " LIKE '" . $this->searchValue . "%'";
        }else{
            $condition =$this->filterAttributes[$this->filterCriterias[$this->filterCriteria]] . "='" . $this->filterRoles[$this->filterStatus] . "' AND "
                .$this->searchAttributes[$this->searchFields[$this->searchField]] . " LIKE '" . $this->searchValue . "%'";
        }
        }



        return array(
            'condition' => $condition,
        );
    }


}
