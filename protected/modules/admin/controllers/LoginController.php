<?php

class LoginController extends Controller
{
    public $layout='/layouts/column2';

    public function actionIndex()
    {
        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->number=$_POST['LoginForm']['number'];
            $model->password=$_POST['LoginForm']['password'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->getModule('admin')->user->returnUrl);
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->getModule('admin')->user->logout();
        $this->redirect('/admin/login');
    }

}
