<?php
$this->breadcrumbs=array(
	'Probations'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$what = ($model->update_date)?'Редактировал':'Добавил';
$when_cr = Yii::app()->dateFormatter->format('d MMMM yyyy в HH:mm:ss',$model->create_date);
$who_cr = Users::model()->findByPk($model->create_user_id)->number;
$when_up = ($model->update_date)?Yii::app()->dateFormatter->format('d MMMM yyyy в HH:mm:ss',$model->update_date):'';
$who_up = ($model->update_date)?Users::model()->findByPk($model->update_user_id)->number:'';

$this->menu=array(
	array('label'=>'К списку направлений стажировок','url'=>array('index')),
	array('label'=>'Добавить направление стажировки','url'=>array('create')),
	array('label'=>'Удалить направление стажировки','url'=>array('delete','id'=>$model->id)),
    '---',
    array('label'=>'Добавил'),
    array('label'=>$who_cr.' '.$when_cr,'icon'=>'user', 'url'=>'')
);

if($model->update_date){
    $this->menu = array_merge($this->menu,array(array('label'=>'Редактировал'),array('label'=>$who_up.' '.$when_up,'icon'=>'user', 'url'=>'')));
}

?>

<h1>Редактирование направления стажировки</h1>
<h3><?php echo $model->name; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
