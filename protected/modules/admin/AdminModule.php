<?php

class AdminModule extends CWebModule
{
    public $defaultController = 'structure';
    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
        ));
        $this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'admin/default/error'
            ),
            'user' => array(
                'class' => 'CWebUser',
                'loginUrl' => Yii::app()->createUrl('admin/login'),
            ),
            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'error, warning',

                    ),
                    array(
                        'class'=>'CProfileLogRoute',
                        'levels'=>'profile',
                        'enabled'=>true,
                    ),
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'trace,log',
                        'categories' => 'system.db.CDbCommand',
                        'logFile' => 'db.log',
                    ),
                ),
            ),
        ));
        Yii::app()->user->setStateKeyPrefix('_admin');
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            $route = $controller->id . '/' . $action->id;



            $publicPages = array(
                'login/index',
                'default/error',
            );
            if (Yii::app()->getModule('admin')->user->isGuest && !in_array($route, $publicPages)){
                // $request=Yii::app()->request->getUrl();
                //    Yii::app()->user->returnUrl=$request;
                Yii::app()->getModule('admin')->user->loginRequired();
            }
            else
                return true;
        }
        else
            return false;
    }
}
