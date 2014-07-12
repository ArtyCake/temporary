<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends Users
{
    public $rememberMe;
    private $_identity;

    public function rules()
    {
        return array(
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('pass', 'authenticate'),
        );
    }
    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'rememberMe'=>'Запомнить меня',
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $this->_identity=new UserIdentity($this->number,$this->password);
            if(!$this->_identity->authenticate()){
               if($this->_identity->errorCode===UserIdentity::ERROR_ROLE_INVALID)
                   $this->addError('number','У вас недостаточно прав для входа в админ панель.');
               else
                $this->addError('password','Неверный табельный номер или пароль.');
//                print_r(Yii::app()->getModule('admin')->user->returnUrl);
            }
//				$this->addError('pass',$this->pass);
        }
    }
    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if($this->_identity===null)
        {
            $this->_identity=new UserIdentity($this->number,$this->password);
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
        {
            $duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
            Yii::app()->getModule('admin')->user->login($this->_identity,$duration);
            return true;
        }
        else
            return false;
    }
}
