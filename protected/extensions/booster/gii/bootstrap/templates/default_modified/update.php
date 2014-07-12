<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	'Update',
);\n";
?>

$this->menu=array(
	array('label'=>'К списку <?php echo $this->modelClass; ?>','url'=>array('index')),
	array('label'=>'Добавить <?php echo $this->modelClass; ?>','url'=>array('create')),
	array('label'=>'Удалить <?php echo $this->modelClass; ?>','url'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
);
?>

<h1>Редактирование <?php echo $this->modelClass." <?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>

<?php echo "<?php echo \$this->renderPartial('_form',array('model'=>\$model)); ?>"; ?>