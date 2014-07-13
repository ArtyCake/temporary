<?php
$this->breadcrumbs=array(
	'Probations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'К списку направлений стажировок','url'=>array('index')),

);
?>

<h1>Добавить направление стажировки</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
