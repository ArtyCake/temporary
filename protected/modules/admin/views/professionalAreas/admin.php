<?php
$this->breadcrumbs=array(
	'ProfessionalAreas'=>array('index'),
	'Manage',
);

$this->menu=array(

	array('label'=>'Добавить профессиональную область','url'=>array('create')),
);

?>

<h1>Профессиональные области</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'professionalareas-grid',
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
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>
