<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    private $_userId = 0;
    private $_home = '';

    /**
    * increments number of times user entered incorrect credentials
    * @return current counter
    */
    public static function addFailedAttempt($userIp)
    {
        $curAttempts = 0;
        $affectedRows = 0;
        
        $command = Yii::app()->db->createCommand('
            SELECT attempt_count 
            FROM user_attempt
            WHERE user_ip= :userIp
        ');
        $curAttempts = $command->queryScalar(array(
            'userIp' => $userIp,
        ));
        if ($curAttempts === false) {
            $command = Yii::app()->db->createCommand('
                INSERT INTO user_attempt (user_ip,attempt_count) 
                VALUE (:userIp, 1)
            ');
            $affectedRows = $command->execute(array(
                'userIp' => $userIp,
            ));
            return 1;
        }  else {
            $curAttempts = (int)$curAttempts + 1;
            $command = Yii::app()->db->createCommand('
                UPDATE user_attempt 
                SET attempt_count= :attempts
                WHERE user_ip= :userIp
            ');
            $affectedRows = $command->execute(array(
                'attempts' => $curAttempts,
                'userIp'  => $userIp,
            ));
            return $curAttempts;
        }
        return $affectedRows;
    }

    /**
    * sets blocked until time for userIp
    * @return number of affected rows
    */
    public static function setBlock($userIp)
    {
        $affectedRows = 0;        
        $command = Yii::app()->db->createCommand('
            UPDATE user_attempt 
            SET blocked_until= :blockedTime, attempt_count= 0
            WHERE user_ip= :userIp
        ');
        $affectedRows = $command->execute(array(
            'blockedTime' => time() + Yii::app()->params['blockSeconds'],
            'userIp'  => $userIp,
        ));

        return $affectedRows;
    }        

    /**
    * resets number of attempts to zero 
    * @return number of affected rows
    */
    public static function resetAttempt($userIp)
    {
        $affectedRows = 0;
        $command = Yii::app()->db->createCommand('
            UPDATE user_attempt 
            SET attempt_count= 0
            WHERE user_ip= :userIp
        ');
        $affectedRows = $command->execute(array(
            'userIp'  => $userIp,
        ));

        return $affectedRows;
    }    
    
    /**
    * @return true if useIp is blocked now, false otherwise
    */
    public static function isBlocked($userIp)
    {
        $command = Yii::app()->db->createCommand('
            SELECT blocked_until
            FROM user_attempt
            WHERE user_ip= :userIp
        ');
        $blockedTime = $command->queryScalar(array(
            'userIp' => $userIp,
        ));
        return $blockedTime >= time();
    }
    
    public function authenticate()
    {
        $model = User::model()->find(
            'LOWER(username)=?',
            array(strtolower(trim($this->username)))
        );
        $userIp = $_SERVER['REMOTE_ADDR'];
        $attemptCount = 0;
        if ( $model===null || $model->deleted ) {
            $attemptCount = self::addFailedAttempt($userIp);
            if ( $attemptCount >= Yii::app()->params['maxCredentialAttempts'] ) {
                self::setBlock($userIp);
            } else {
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            }
        } elseif ( !$model->validatePassword($this->password) ) {
            $attemptCount = self::addFailedAttempt($userIp);
            if ( $attemptCount >= Yii::app()->params['maxCredentialAttempts'] ) {
                self::setBlock($userIp);
            } else {
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }
        } else {
            self::resetAttempt($userIp);
            $this->errorCode=self::ERROR_NONE;
            $this->_userId = $model->id;
            $this->_home = $model->role;
            return true;
        }
        return false;
    }

    public function getId()
    {
        return $this->_userId;
    }

    public function getHomeController()
   
    {
        return $this->_home;
    }

}