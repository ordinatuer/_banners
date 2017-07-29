<?php
/* @var $this BannersController */
/* @var $model Banners */

$this->breadcrumbs=array(
	'Banners'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Banners', 'url'=>array('index')),
	array('label'=>'Create Banners', 'url'=>array('create')),
	array('label'=>'View Banners', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Banners', 'url'=>array('admin')),
);
?>

<h1>Update Banners <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'bannerShow'=>$bannerShow)); ?>