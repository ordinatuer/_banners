<?php
/* @var $this BannerShowController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
	'Banner Shows',
);

$this->menu = array(
	array('label'=>'Create BannerShow', 'url'=>array('create')),
	array('label'=>'Manage BannerShow', 'url'=>array('admin')),
);
?>

<?php echo CHtml::beginForm('', 'get',array('id'=>'searchForm')); ?>

<div class="row">
    <?php echo CHtml::activeLabel($model,'property_type'); ?>
    <?php echo CHtml::activeTextField($model,'property_type') ?>
</div>
<div class="row">
    <?php echo CHtml::activeLabel($model,'deal_kind'); ?>
    <?php echo CHtml::activeTextField($model,'deal_kind') ?>
</div>
<div class="row">
    <?php echo CHtml::activeLabel($model,'deal_direction'); ?>
    <?php echo CHtml::activeTextField($model,'deal_direction') ?>
</div>
<div class="row">
    <?php echo CHtml::activeLabel($model,'controller'); ?>
    <?php echo CHtml::activeTextField($model,'controller') ?>
</div>
<div class="row">
    <?php echo CHtml::activeLabel($model,'action'); ?>
    <?php echo CHtml::activeTextField($model,'action') ?>
</div>
<div class="row">
    <?php echo CHtml::activeLabel($model,'description'); ?>
    <?php echo CHtml::activeTextField($model,'description') ?>
</div>
<div class="row">
    <?php echo CHtml::submitButton('Search'); ?>
</div>
<?php echo CHtml::endForm(); ?>

<h1>Banner Shows</h1>

<?php $this->widget('zii.widgets.CListView', array(
	//'dataProvider'=>$dataProvider,
    'dataProvider'=>$model->search(),
	'itemView'=>'_view',
    'id'=>'ajaxListView',
));

Yii::app()->clientScript
    ->registerCssFile(
        Yii::app()->assetManager->publish(
            Yii::getpathOfAlias('application.modules.banners.css').'/bannersList.css'
        ))
    ->registerScriptFile(
        Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('application.modules.banners.js').'/bannersList.js'
        ),CClientScript::POS_END);
