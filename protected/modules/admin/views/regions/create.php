<?php
$this->breadcrumbs=array(
	'Structures'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'К списку областей','url'=>array('index')),

);
?>

<h1>Добавить область</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
