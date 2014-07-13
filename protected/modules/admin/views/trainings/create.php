<?php
$this->breadcrumbs=array(
	'Trainings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'К списку видов программы обучений','url'=>array('index')),

);
?>

<h1>Добавить вид программы обучение</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
