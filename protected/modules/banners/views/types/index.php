<?php
/* @var $this TypesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Types',
);

$this->menu=array(
	array('label'=>'Create Types', 'url'=>array('create')),
	array('label'=>'Manage Types', 'url'=>array('admin')),
);
?>

<h1>Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
