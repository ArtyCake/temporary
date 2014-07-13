<?php
$this->breadcrumbs=array(
	'ProfessionalAreas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'К списку профессиональных областей','url'=>array('index')),

);
?>

<h1>Добавить профессиональную область</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
