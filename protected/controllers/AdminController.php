<?php

class AdminController extends Controller
{
    const ADMIN = 'admin';
    const CUSTOMER = 'customer';
    const SUPERVISOR = 'supervisor';
    const MERCHANDISER = 'merchandiser';
    


    public $defaultAction = 'index';

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','edit','remove','index'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
            //array('deny',
              //  'users'=>array('*'),
            //),
        );
    }

    public function prepareAjaxData($dataProvider)
    {
            $data = $dataProvider->getData();
            $user = Yii::app()->user;
            $currentTime = time();
            foreach($data as $i => $row) {
                $data[$i] = $row->getAttributes(null);
                if ( OmsWebUser::isActive($row['id'], $currentTime) ) {
                    $data[$i] += array('active'=>true);
                }
            }
            $data[] = array('userCount' => $dataProvider->getTotalItemCount());
            return CJSON::encode($data);
    }

    
    public function prepareAjaxRendering()
    {
        $this->layout='ajax';
        $cs=Yii::app()->clientScript;
        $cs->defaultScriptPosition = CClientScript::POS_END;
        $cs->packages['yiiactiveform'] = array(
    		'js'=>array('jquery.yiiactiveform.js')
        );
    }
    
    public function actionIndex()
    {
        $model = new User;
        //Yii::log(print_r($_SERVER,true),'error');

        if( isset($_GET['pageSize']) && OmsGridView::validatePageSize($_GET['pageSize']) )
            $model->currentPageSize = $_GET['pageSize'];

        $model->dbCriteria->select = 'id,username,firstname,lastname,role,email,region,deleted';
        $model->dbCriteria->order='`t`.`username` ASC';

        if ( !isset($_GET['showDel']) || !$_GET['showDel'] ) {
            $model->dbCriteria->condition = '`t`.`deleted`=0';
        }

        $fields = new AdminSearchForm('search');

        if( isset($_GET['AdminSearchForm']) ){
            $fields->attributes = $_GET['AdminSearchForm'];

            if( $fields->validate() )
                $model->searchCriteria = $fields->getCriteria();
        }

        if ( Yii::app()->request->isAjaxRequest ) {
            $dataProvider = $model->search();
            echo $this->prepareAjaxData($dataProvider);
            Yii::app()->end();
        } 
        
        
        else 
        {
           $fields->keyField = array_search('User Name', $fields->keyFields);
            $fields->criteria = array_search('starts with', $fields->criterias);
            $fields->keyValue = '';
            $this->render('index',array('model'=>$model, 'fields'=>$fields));
        }
    }


    public function actionUser($id)
    {
        $response = CJSON::encode($this->loadModel($id)->getAttributes(array(
            'username', 'firstname', 'lastname', 'role', 'email', 'region', 'deleted'
        )));
        echo $response;
        Yii::app()->end();
    }

    /*=======USERS ACTIONS=========*/

    public function actionCreate()
    {
        $model = new User;
       // $model->role = self::CUSTOMER;

        if( !empty( $_POST['User']) ){
            $model->attributes = $_POST['User'];
            if($model->save()) {
                $this->assignRole( $model->role,$model->id );
                $this->actionIndex();
            }
        }

        $this->prepareAjaxRendering();
        $this->render('create',array(
            'model'=>$model,
        ));

    }
    public function actionRemove()
    {
        if(isset($_GET['id'])){
            $model = User::model()->findByPk($_GET['id']);
            $model->scenario = 'remove';
            $model->deleted = 1;

            if ( $model->save() ) {
                $this->actionIndex();
            } else {
                throw new Exception(print_r($model->getErrors(), true));
            }
        }
    }

    public function actionEdit($id)
    {
        $model = $this->loadModel($id);
        $model->scenario = 'edit';
        $model->password = false;

        if ( !empty($_POST['User'] ) ) {
            $model->attributes = $_POST['User'];

            if (strlen($model->password) == 0 ) {
                $ret = $model->save(true, array(
                        'username',
                        'role',
                        'firstname',
                        'lastname',
                        'email',
                        'region',
                        'deleted'
                ));
            } else {
                $ret = $model->save();
            }
            if ($ret) {
                $this->assignRole($model->role,$model->id,false);
                $this->actionUser($id);
            } else {
                throw new Exception(print_r($model->getErrors(), true));
            }

        } else {
           // $this->prepareAjaxRendering();
            $this->render('edit',array(
                'model'=>$model,
            ));
        }
    }
    public function loadModel($id)
    {
        $model=User::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    protected function assignRole($role,$userId,$isNewRecord=true)
    {
        if ($isNewRecord ) {
            Yii::app()->authManager->assign($role,$userId);
        } else {
            Yii::app()->db->createCommand('
                UPDATE auth_assignment 
                SET itemname= :role 
                WHERE userid= :userId
            ')->execute(array(
                'role'   => $role,
                'userId' => $userId
                )
            );
        }
    }

    public function actionDuplicate($id){

        $model=$this->loadModel($id);
        $model->scenario = 'duplicate';
        $model->password = false;
        $model->username = false;
        $duplicate = new User;

        if(isset($_POST['User'])) {
            $duplicate->attributes=$_POST['User'];

            if($duplicate->save()) {
                $this->assignRole($duplicate->role, $duplicate->id);
            } else {
                throw new Exception(print_r($duplicate->getErrors(), true));
            }
        } else {
            $this->prepareAjaxRendering();
            $this->render('duplicate',array(
                'model'=>$model,
            ));
        }
    }
}