<?
class UserIdentity extends CUserIdentity
{
    const ERROR_ROLE_INVALID=3;
    private $_id;
    public function authenticate()
    {
        $record=Users::model()->findByAttributes(array('number'=>$this->username, 'deleted'=>0));

        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->password!==sha1($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else if(!in_array($record->role,array(0,1,2,3)))
            $this->errorCode=self::ERROR_ROLE_INVALID;
        else
        {
            $this->_id=$record->id;
            $this->setState('username', $record->getShortFIO().'('.$record->number.')');
            $this->setState('id', $record->id);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
}
