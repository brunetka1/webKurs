<?php 
/**
*Override CWebUser to save in cookie only username
*and not to populate session from this cookie
*/
class OmsWebUser extends CWebUser
{

    public $homeController = '';
    public $rememberedName = '';

    protected function restoreFromCookie()
    {

        $app=Yii::app();
        $request=$app->getRequest();
        $cookie=$request->getCookies()->itemAt($this->getStateKeyPrefix());

        if($cookie && !empty($cookie->value) && is_string($cookie->value) && ($data=$app->getSecurityManager()->validateData($cookie->value))!==false)
        {
            $data=@unserialize($data);

            if(is_array($data) && isset($data[0],$data[1],$data[2],$data[3]))
            {
                list($id,$name,$duration,$states)=$data;
                if($this->beforeLogin($id,$states,true))
                {
                    $this->rememberedName = htmlspecialchars($name);
                    if($this->autoRenewCookie)
                    {
                        $this->saveToCookie($duration);
                    }
                    $this->afterLogin(true);
                }
            }
        }

    }
    
    public function getRememberedName()
    {
        //remembered name from cookie
        $rememberedName = $this->rememberedName;
        if (empty($rememberedName)) {
            //remembered name from session
            $rememberedName = $this->getState('Remembered Name');
        }
        return $rememberedName;
    }


    /**
    *@return true if last action time is fresh, false otherwise
    */
    public static function isActive($userId, $currentTime)
    {
        $lastActionTime = self::getLastActionTime($userId);
        return ($lastActionTime != 0) &&
            ($currentTime - $lastActionTime < Yii::app()->params['secondsBeforeDisactivate']);
    }

    /**
    *@return time() of last action or zero
    */
    public static function getLastActionTime($userId)
    {
        $command = Yii::app()->db->createCommand('
            SELECT last_action_time 
            FROM user_login 
            WHERE user_id=?
        ');
        return (int)($command->queryScalar(array(1=>$userId)));
    }

    /**
    * update last action time to the current time for logged user
    * or insert new record if user made first action
    *@return number of affected rows
    */
    public function updateLastActionTime()
    {
            
        $currentTime = time();
        $affectedRows = 0;
        
        $command = Yii::app()->db->createCommand('
            SELECT id 
            FROM user_login 
            WHERE user_id=?
        ');
        $rowId = $command->queryScalar(array(1=>$this->id));
        if ( $rowId ) {
            $command = Yii::app()->db->createCommand('
                UPDATE user_login 
                SET last_action_time= :currentTime, user_agent= :userAgent
                WHERE user_id= :userId
            ');
            $affectedRows = $command->execute(array(
                'userId'      => $this->id,
                'currentTime' => $currentTime,
                'userAgent'   => $_SERVER['HTTP_USER_AGENT'],
            ));
        } else {

            $command = Yii::app()->db->createCommand('
                INSERT INTO user_login (user_id,last_action_time,user_agent) 
                VALUE (:userId, :currentTime, :userAgent)
            ');
            $affectedRows = $command->execute(array(
                'userId'      => $this->id,
                'currentTime' => $currentTime,
                'userAgent'   => $_SERVER['HTTP_USER_AGENT'],
            ));
        }

        return $affectedRows;
    }

    /**
    *@return number of active users for given $currentTime
    */
    public static function countActive($currentTime)
    {
            $command = Yii::app()->db->createCommand('
                SELECT COUNT(*)
                FROM user_login 
                WHERE last_action_time>?
            ');
            return $command->queryScalar(array(
                1 => $currentTime - Yii::app()->params['secondsBeforeDisactivate']
            ));
    
    }

    /**
    *@return true if user's current request is made from the same browser as previos one
    */
    public static function isSameUserAgent($userId)
    {
            $command = Yii::app()->db->createCommand('
                SELECT user_agent
                FROM user_login 
                WHERE user_id=?
            ');
            
            return 0 == strcmp(
                $command->queryScalar(array(1=>$userId)),
                $_SERVER['HTTP_USER_AGENT']
            );
    }

    /**
    * update the table so that current user will be considered to be inactive
    *@return number of affected rows
    */
    public function makeUnActive()
    {
            
        $command = Yii::app()->db->createCommand('
            UPDATE user_login 
            SET last_action_time= :oldTime
            WHERE (user_id= :userId)
        ');
        return $command->execute(array(
            'userId'  => $this->id,
            'oldTime' => 1,
        ));
    }

}