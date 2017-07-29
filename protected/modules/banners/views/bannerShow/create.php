<?php
/* @var $this BannerShowController */
/* @var $model BannerShow */

$this->breadcrumbs=array(
	'Banner Shows'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BannerShow', 'url'=>array('index')),
	array('label'=>'Manage BannerShow', 'url'=>array('admin')),
);
?>

<h1>Create BannerShow</h1>

<?php $this->renderPartial(
        '_form',
        array(
            'model'=>$model,
            'banners'=>$banners,
        )
    ); ?>