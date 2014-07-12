<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
    'Login',
);
?>

<h1>Login</h1>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    <p class="note">Поля помеченные <span class="required">*</span> обязательны к заполнению</p>

    <div class="row">
        <?php echo $form->labelEx($model,'number'); ?>
        <?php echo $form->textField($model,'number'); ?>
        <?php echo $form->error($model,'number'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password'); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="row rememberMe">
        <?php echo $form->checkBox($model,'rememberMe'); ?>
        <?php echo $form->label($model,'rememberMe'); ?>
        <?php echo $form->error($model,'rememberMe'); ?>
    </div>

    <p>Для правильной работы админки неободимо включить JavaScript</p>
    <p>Для корректной работы админки используйте Firefox 4 или Google Chrome</p>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Login'); ?>
    </div>


    <?php $this->endWidget(); ?>
</div><!-- form -->
