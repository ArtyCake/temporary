<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>
	<p class="help-block">Поля помеченные <span class="required">*</span> обязательны к заполнению.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'number',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'surname',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'patronymic',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->dropDownListRow($model,'structure_point',CHtml::listData(Structure::model()->findAll('deleted = 0'),'id','name'),array('empty'=>'-- Выберите родительскую структурную единицу -- ', 'class'=>'span5')) ?>

<?php  $roles = array(
			'0'=>'Глобальный администратор', 
			'1'=>'Администратор',
			'2'=>'Модератор',
			'3'=>'On-line констультант',
			'4'=>'Сотрудник',
			'5'=>'Стажер',); ?>
	<?php echo $form->dropDownListRow($model,'role',$roles,array('empty'=>'-- Выберите родительскую структурную единицу -- ', 'class'=>'span5')) ?>

	<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>60)); ?>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
