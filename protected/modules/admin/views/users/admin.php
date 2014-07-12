<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(

	array('label'=>'Добавить пользователя','url'=>array('create')),
);

?>

<h1>Пользователи</h1>

<?php 
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'users-grid',
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
		array(
			'name'=>'number',
	        'headerHtmlOptions'=>array('style'=>'width:100px'),
			),
		
		array(
			'header'=>'ФИО',
			'value'=>function($data){
				return $data->surname.' '.$data->name.' '.$data->patronymic;
			}
			),
		array(
			'name'=>'structure_point',
			'filter'=>CHtml::listData(Structure::model()->findAll('deleted = 0'),'id','name'),
			'value'=>function($data){
				if($data->structure)
					return $data->structure->name;
				return 'Не указано';
			}
			),
		array(
			'name'=>'role',
			'value'=>function($data){
				$roles = array(
			'0'=>'Глобальный администратор', 
			'1'=>'Администратор',
			'2'=>'Модератор',
			'3'=>'On-line констультант',
			'4'=>'Сотрудник',
			'5'=>'Стажер',);
				return $roles[$data->role];
			},
			'filter'=>array(
			'0'=>'Глобальный администратор', 
			'1'=>'Администратор',
			'2'=>'Модератор',
			'3'=>'On-line констультант',
			'4'=>'Сотрудник',
			'5'=>'Стажер')

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
		
		/*
		'role',
		'password',
		'create_user_id',
		'create_date',
		'update_user_id',
		'update_date',
		'deleted',
		'deleted_denied',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>
