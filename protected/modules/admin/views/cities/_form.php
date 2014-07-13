<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'city-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Поля помеченные <span class="required">*</span> обязательны к заполнению.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>100)); ?>

    <?php echo $form->dropDownListRow($model,'region_id',CHtml::listData(Regions::model()->findAll('deleted = 0'),'id','name'),array('class'=>'span5')) ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
