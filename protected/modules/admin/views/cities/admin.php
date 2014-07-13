<?php
$this->breadcrumbs=array(
	'Cities'=>array('index'),
	'Manage',
);

$regions = Regions::model()->findAll('deleted=0');
$regions = CHtml::listData($regions,'id','name');

$this->menu=array(

	array('label'=>'Добавить Город','url'=>array('create')),
);

?>

<h1>Города</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'city-grid',
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
        array('name' => 'region_id',
            'type' => 'raw',
            'header'=>'Регион',
            'value' => function($data){
                    return Regions::model()->findByPk($data->region_id)->name;
                },
            'headerHtmlOptions'=>array('style'=>'width:250px'),
            'filter' => $regions,
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>
