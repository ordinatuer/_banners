<?php
/* @var $this BannerShowController */
/* @var $model BannerShow */

$this->breadcrumbs=array(
	'Banner Shows'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BannerShow', 'url'=>array('index')),
	array('label'=>'Create BannerShow', 'url'=>array('create')),
	array('label'=>'Update BannerShow', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BannerShow', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BannerShow', 'url'=>array('admin')),
);
?>

<h1>View BannerShow #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'banner_id',
		'place_id',
		'property_type',
		'deal_kind',
		'deal_direction',
		'controller',
		'action',
		'update_time',
	),
)); ?>
