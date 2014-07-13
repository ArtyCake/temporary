<?php
$this->breadcrumbs=array(
	'Structures'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'К списку городов','url'=>array('index')),

);
?>

<h1>Добавить город</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
