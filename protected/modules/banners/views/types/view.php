<?php
/* @var $this TypesController */
/* @var $model Types */

$this->breadcrumbs=array(
	'Types'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Types', 'url'=>array('index')),
	array('label'=>'Create Types', 'url'=>array('create')),
	array('label'=>'Update Types', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Types', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Types', 'url'=>array('admin')),
);
?>

<h1>View Types #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
		'template',
		'path',
	),
)); ?>
