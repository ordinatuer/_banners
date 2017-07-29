<?php
/* @var $this BannerShowController */
/* @var $model BannerShow */
/* @var $form CActiveForm */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'banner-show-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('autocomplete'=>'off',)
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'banner_id'); ?>
		<?php echo $form->dropDownList($model,'banner_id', $banners); ?>
		<?php echo $form->error($model,'banner_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'place_id'); ?>
		<?php echo $form->dropDownList(
                        $model,
                        'place_id',
                        array(
                            1=>'Top',
                            2=>'Bottom',
                            3=>'Right',
                            4=>'Middle',
                        )
                    ); ?>
		<?php echo $form->error($model,'place_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'property_type'); ?>
		<?php echo $form->dropDownList(
                        $model,
                        'property_type',
                        array(
                            ''=>' --- ',
                            'residential'=>'residential',
                            'commercial'=>'commercial',
                            'land'=>'land',
                            'garage'=>'garage',
                        )
                    ); ?>
		<?php echo $form->error($model,'property_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deal_kind'); ?>
		<?php echo $form->dropDownList(
                        $model,
                        'deal_kind',
                        array(
                            ''=>' --- ',
                            'sale'=>'sale',
                            'rent'=>'rent',
                        )
                    ); ?>
		<?php echo $form->error($model,'deal_kind'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deal_direction'); ?>
		<?php echo $form->dropDownList(
                        $model,
                        'deal_direction',
                        array(
                            ''=>' --- ',
                            'offer'=>'offer',
                            'demand'=>'demand',
                        )
                    ); ?>
		<?php echo $form->error($model,'deal_direction'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'controller'); ?>
		<?php echo $form->dropDownList(
                        $model,
                        'controller',
                        array(''=>' --- ', 'ads'=>'ads',)
                    ); ?>
		<?php echo $form->error($model,'controller'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'action'); ?>
		<?php echo $form->textField(
                        $model,
                        'action',
                        array('class'=>'autoAction',)
                    ); ?>
        <ul class="autoList"></ul>
		<?php echo $form->error($model,'action'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
Yii::app()->clientScript
    ->registerPackage('jquery')
    ->registerCssFile(
        Yii::app()->assetManager->publish(
        Yii::getpathOfAlias('application.modules.banners.css').'/autocomplete.css'
    ))
    ->registerScriptFile(
        Yii::app()->assetManager->publish(
        Yii::getPathOfAlias('application.modules.banners.js').'/autocomplete.js'
    ), CClientScript::POS_END);