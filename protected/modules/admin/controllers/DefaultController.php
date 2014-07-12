<?php

class DefaultController extends Controller
{
    public $layout='/layouts/column2';

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            print_r($error);
        }
    }
}