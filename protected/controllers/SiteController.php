
<?php
/*



class SiteController extends Controller
{
    public $layout = 'login';
    /**
     * This is the action to handle external exceptions.
     */
    /*
    public function actionError()
    {
        if ($error=Yii::app()->errorHandler->error) {
            if ( Yii::app()->request->isAjaxRequest ) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }
*/

    /**
     * Displays the login page
     */
    /*
    public function actionLogin()
    {
        if ( UserIdentity::isBlocked($_SERVER['REMOTE_ADDR']) ) {
            $this->render('login-blocked');
            Yii::app()->end();
        } else {
            $model=new LoginForm;
            if ( isset($_POST['LoginForm']) ) {
                $model->attributes=$_POST['LoginForm'];

                if ( $model->validate() && $model->login() ) {
                    $this->redirect(Yii::app()->createUrl(Yii::app()->user->homeController));

                } else {
                    $errorCode = $model->getErrorCode();
                    if ( $errorCode == LoginForm::ERROR_USER_LOGGED ) {
                        $this->redirect(array('site/warning','view'=>'login-already'));
                    } elseif ( $errorCode == LoginForm::ERROR_ACTIVE_LIMIT ) {
                        $this->redirect(array('site/warning','view'=>'login-limit'));
                    } elseif ( UserIdentity::isBlocked($_SERVER['REMOTE_ADDR']) ) {
                        $this->redirect(array('site/warning','view'=>'login-blocked'));
                    }
                }
            }

            if ( $rememberedName = Yii::app()->user->getRememberedName()) {
                $model->username = $rememberedName;
                $model->rememberMe = true;
            }
            // display the login form
            $this->render('login',array('model'=>$model));
        }
    }
    public function actionForceLogin()
    {
        $user = Yii::app()->user;
        $id = $user->getState('forceLogin');
        if ( !empty($id) ) {
            $user->id=$id;
            $user->makeUnActive();
        }
        $this->redirect(array('site/login'));
    }
    /**
     * Logs out the current user and redirect to homepage.
     */
    /*
    public function actionLogout()
    {
        parent::logout();
    }
    */
/*
    public function actionWarning($view)
    {
        $this->render($view);
    }


}
*/


class SiteController extends Controller
{
    public $layout = 'login';
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error=Yii::app()->errorHandler->error) {
            if ( Yii::app()->request->isAjaxRequest ) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }


    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        if ( UserIdentity::isBlocked($_SERVER['REMOTE_ADDR']) ) {
            $this->render('login-blocked');
            Yii::app()->end();
        } else {
            $model=new LoginForm;
            if ( isset($_POST['LoginForm']) ) {
                $model->attributes=$_POST['LoginForm'];

                if ( $model->validate() && $model->login() ) {
                    $this->redirect(Yii::app()->createUrl(Yii::app()->user->homeController));

                } else {
                    $errorCode = $model->getErrorCode();
                    if ( $errorCode == LoginForm::ERROR_USER_LOGGED ) {
                        $this->redirect(array('site/warning','view'=>'login-already'));
                    } elseif ( $errorCode == LoginForm::ERROR_ACTIVE_LIMIT ) {
                        $this->redirect(array('site/warning','view'=>'login-limit'));
                    } elseif ( UserIdentity::isBlocked($_SERVER['REMOTE_ADDR']) ) {
                        $this->redirect(array('site/warning','view'=>'login-blocked'));
                    }
                }
            }

            if ( $rememberedName = Yii::app()->user->getRememberedName()) {
                $model->username = $rememberedName;
                $model->rememberMe = true;
            }
            // display the login form
            $this->render('login',array('model'=>$model));
        }
    }
    public function actionForceLogin()
    {
        $user = Yii::app()->user;
        $id = $user->getState('forceLogin');
        if ( !empty($id) ) {
            $user->id=$id;
            $user->makeUnActive();
        }
        $this->redirect(array('site/login'));
    }
    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        parent::logout();
    }

    public function actionWarning($view)
    {
        $this->render($view);
    }


}