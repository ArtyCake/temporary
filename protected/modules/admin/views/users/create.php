<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'К списку пользователей','url'=>array('index')),

);
?>

<h1>Добавление пользователя</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
