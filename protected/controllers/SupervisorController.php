<?php

class SupervisorController extends Controller
{
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
            array('allow',
                'roles'=>array('supervisor'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
    	);
    }

    public function actionIndex()
    {
        $model= new Item('search');
  
        if (isset($_GET['pageSize']) && $this->validatePageSize($_GET['pageSize']))
            $model->currentPageSize = $_GET['pageSize'];
        if ( isset($_GET['Item'])) 
            $model->attributes=$_GET['Item'];
            $this->render('index',array('model'=>$model,
                ));
     //  $model->searchCriteria = $fields->getCriteria();
        
    }
    
    
    public function actionCreate()
{
	$model=new Item;

	if(isset($_POST['Item']))
            {
		$model->attributes=$_POST['Item'];
		if($model->save())
		
                $this->redirect(array('index'));
            }

		$this->render('create',array(
                              'model'=>$model,
		));
	}
    

    
    public function loadModel($id)
	{

	$model=Item::model()->findByPk($id);
	if($model===null)
	throw new CHttpException(404,'The requested page does not exist.');
	return $model;
	}
 
    public function actionRemove()
      {
 
      if(isset($_GET['id'])){
        $model = Item::model()->findByPk($_GET['id']);
           if($model->save()) {   
               $model->delete();
               $this->redirect(array('index'));
            }           
            $this->redirect(array('_del'));
            }      
            
      }               
 
 public function actionEdit($id){
         
	
 $model=$this->loadModel($id);
 if(isset($_POST['Item']))
   {
 $model->attributes=$_POST['Item'];
 if($model->save()) {
                $this->redirect(array('index'));
			   } 
     }
 $this->render('edit',array(
               'model'=>$model,
     ));
 }
}
      

           
                
         
   


      

