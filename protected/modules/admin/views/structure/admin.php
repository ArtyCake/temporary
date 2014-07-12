<?php
$this->breadcrumbs=array(
	'Structures'=>array('index'),
	'Manage',
);

$this->menu=array(

	array('label'=>'Добавить подразделение','url'=>array('create')),
);

?>

<h1>Структура кампании</h1>

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
		array(
			'name'=>'parent_id',
			'value'=>function($data){
				if($data->parent){
					return $data->parent->name;
				}
				return '---';
			},
			'filter'=>CHtml::listData(Structure::model()->findAll('deleted = 0'),'id','name')
			),
		array(
			'header'=>'Инфо',
			'type'=>'raw',
			'value'=>function($data){
				$res = 'Созд. '.Users::model()->findByPk($data->create_user_id)->number.' '.Yii::app()->dateFormatter->format('d MMMM yyyy в HH:mm:ss',$data->create_date);
				if($data->update_user_id)
					$res .='<br>Ред. '.Users::model()->findByPk($data->update_user_id)->number.' '.Yii::app()->dateFormatter->format('d MMMM yyyy в HH:mm:ss',$data->update_date);

				return $res; 
			},
			'headerHtmlOptions'=>array('style'=>'width:100px'),
			'htmlOptions'=>array('style'=>'font-size:9px;'),
			),		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>
