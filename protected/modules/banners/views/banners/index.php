<?php
/* @var $this BannersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Banners',
);

$this->menu=array(
	array('label'=>'Create Banners', 'url'=>array('create')),
	array('label'=>'Manage Banners', 'url'=>array('admin')),
);
?>

<h1>Banners</h1>

<?php echo CHtml::beginForm('', 'get',array('id'=>'searchForm')); ?>

<div class="row">
    <?php echo CHtml::activeLabel($model,'type'); ?>
    <?php echo CHtml::activeTextField($model,'type') ?>
</div>
<div class="row">
    <?php echo CHtml::activeLabel($model,'url'); ?>
    <?php echo CHtml::activeTextField($model,'url') ?>
</div>
<div class="row">
    <?php echo CHtml::activeLabel($model,'description'); ?>
    <?php echo CHtml::activeTextField($model,'description') ?>
</div>
<div class="row">
    <?php echo CHtml::activeLabel($model,'content'); ?>
    <?php echo CHtml::activeTextField($model,'content') ?>
</div>
<div class="row">
    <?php echo CHtml::submitButton('Search'); ?>
</div>
<?php echo CHtml::endForm(); ?>

<?php
Yii::import('application.modules.banners.components.BannersListView');

$this->widget('BannersListView', array(
    'dataProvider'=>$model->search(),
    'template'=>'{summary} {sorter} {items} <hr> {pager}',
    'sortableAttributes'=>array('show','clicks','type'),
    'id'=>'ajaxListView',
    //'ajaxUpdate'=>false
));

Yii::app()->clientScript
    ->registerCssFile(
        Yii::app()->assetManager->publish(
            Yii::getpathOfAlias('application.modules.banners.css').'/bannersList.css'
        ))
    ->registerScriptFile(
        Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('application.modules.banners.js').'/bannersList.js'
        ));
?>