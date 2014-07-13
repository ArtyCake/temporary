<?php /* @var $this Controller */
//$this->redirect('http://startberry.ru')?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <link href="/images/rq-favic.ico" rel="shortcut icon" type="image/x-icon" />
    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />


    <?php

    //Yii::app()->clientScript->registerScriptFile('/js/jquery-1.10.2.js');
    Yii::app()->clientScript->registerScriptFile('/js/jquery.form.js');

    Yii::app()->clientScript->registerScriptFile('/js/upload.js');
    Yii::app()->clientScript->registerScriptFile('/js/jquery-ui-1.10.4.custom.min.js');
    Yii::app()->clientScript->registerScriptFile('/js/javascript.js');

    ?>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <!--  <link rel="stylesheet" type="text/css" href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/main.css" />-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin.css" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>

<body>


<div class="container" id="page">

    <div id="header">
    </div><!-- header -->
    <?php
    if(!Yii::app()->getModule('admin')->user->isGuest){
        $user=Users::model()->findByPk(Yii::app()->getModule('admin')->user->id);
        $role=$user->role;
        $this->widget('bootstrap.widgets.TbNavbar', array(
            'type'=>'inverse', // null or 'inverse'
            'brand'=>Yii::app()->name,
            'brandUrl'=>'/',
            'collapse'=>false, // requires bootstrap-responsive.css
            'items'=>array(
                array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'htmlOptions'=>array('style'=>'width:auto'),
                    'items'=>array(
                        (in_array($role, array(0,1))) ? array('label'=>'Пользователи', 'url'=>array('/admin/users'),):null,
                        array('label'=>'Справочники',  'url'=>'#','items'=>array(
                            array('label'=>'Структура компании', 'url'=>array('/admin/structure'),),
                            array('label'=>'Специализации компании', 'url'=>array('/admin/specializations'),),
                            array('label'=>'Области', 'url'=>array('/admin/regions'),),
                            array('label'=>'Города', 'url'=>array('/admin/cities'),),
                            )
                        )
                    ),
                ),
                array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'htmlOptions'=>array('class'=>'pull-right'),
                    'items'=>array(

                        array('label'=>/*$user->getShortFIO().'('.*/$user->number/*.')'*/, 'icon'=>'user','url'=>'#', 'items'=>array(
                            array('label'=>'Выйти', 'url'=>'/admin/login/logout'),
                        )),
                    ),
                ),
            ),
        )); }?>
    <div class="well">
        <?php echo $content; ?>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>

    <div class="well" style="text-align: center">

    </div><!-- footer -->

</div><!-- page -->

</body>
</html>
