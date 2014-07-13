<?php
$this->breadcrumbs=array(
	'Structures'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'К списку специализаций','url'=>array('index')),

);
?>

<h1>Добавление специализации</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
