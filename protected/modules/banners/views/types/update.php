<?php
/* @var $this TypesController */
/* @var $model Types */

$this->breadcrumbs=array(
	'Types'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Types', 'url'=>array('index')),
	array('label'=>'Create Types', 'url'=>array('create')),
	array('label'=>'View Types', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Types', 'url'=>array('admin')),
);
?>

<h1>Update Types <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>