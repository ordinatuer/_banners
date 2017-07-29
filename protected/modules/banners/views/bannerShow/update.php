<?php
/* @var $this BannerShowController */
/* @var $model BannerShow */

$this->breadcrumbs=array(
	'Banner Shows'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BannerShow', 'url'=>array('index')),
	array('label'=>'Create BannerShow', 'url'=>array('create')),
	array('label'=>'View BannerShow', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BannerShow', 'url'=>array('admin')),
);
?>

<h1>Update BannerShow <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'banners'=>$banners)); ?>