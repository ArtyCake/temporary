<?php
$this->breadcrumbs=array(
	'Structures'=>array('index'),
	'Manage',
);

$this->menu=array(

	array('label'=>'Добавить специализацию','url'=>array('create')),
);

?>

<h1>Специализации кампании</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'structure-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'type'=>'striped',
	'columns'=>array(
		array(
        'header'=>'#',
        'value'=>function($data, $row, $column) {
                /** @var $grid CGridView */
                $grid = $column->grid;
                /** @var $pages CPagination */
                $pages = $grid->dataProvider->getPagination();

                $start = ($grid->enablePagination === false)
                    ? 0
                    : $pages->getCurrentPage(false) * $pages->getPageSize();

                return $start + $row + 1;
            },
        'headerHtmlOptions'=>array('style'=>'width:30px'),
    ),
		'name',
        'type',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>
