<?php
/* @var $this IbeaconController */
/* @var $model Ibeacon */

$this->breadcrumbs=array(
	'Ibeacons'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Ibeacon', 'url'=>array('index')),
	array('label'=>'Create Ibeacon', 'url'=>array('create')),
	array('label'=>'Update Ibeacon', 'url'=>array('update', 'id'=>$model->ibeacon_id)),
	array('label'=>'Delete Ibeacon', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ibeacon_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ibeacon', 'url'=>array('admin')),
);
?>

<h1>View Ibeacon #<?php echo $model->ibeacon_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ibeacon_uuid',
		'minor',
		'major',
		'title',
		'message',
		'image',
		'ibeacon_id',
	),
)); ?>
