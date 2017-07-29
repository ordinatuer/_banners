<?php
/* @var $this BannersController */
/* @var $model Banners */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'banners-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
                <?php echo $form->dropDownList($model, 'type', array(
                        1=>'Image',
                        2=>'Flash',
                        3=>'HTML',
                    )); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row urlRow">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textArea($model,'url',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description');?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row contentRow">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>
        
    <div class="row fileRow">
		<?php echo $form->labelEx($model,'image',array('class'=>'fileLabel')); ?>
		<?php echo $form->fileField($model,'image'); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

    <!-- ---___--------- -->
    <?php echo $form->errorSummary($bannerShow); ?>

    <div class="row">
        <?php echo $form->labelEx($bannerShow,'place_id'); ?>
        <?php echo $form->dropDownList(
            $bannerShow,
            'place_id',
            array(
                1=>'Top',
                2=>'Bottom',
                3=>'Right',
                4=>'Middle',
            )
        ); ?>
        <?php echo $form->error($bannerShow,'place_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($bannerShow,'property_type'); ?>
        <?php echo $form->dropDownList(
            $bannerShow,
            'property_type',
            array(
                ''=>' --- ',
                'residential'=>'residential',
                'commercial'=>'commercial',
                'land'=>'land',
                'garage'=>'garage',
            )
        ); ?>
        <?php echo $form->error($bannerShow,'property_type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($bannerShow,'deal_kind'); ?>
        <?php echo $form->dropDownList(
            $bannerShow,
            'deal_kind',
            array(
                ''=>' --- ',
                'sale'=>'sale',
                'rent'=>'rent',
            )
        ); ?>
        <?php echo $form->error($bannerShow,'deal_kind'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($bannerShow,'deal_direction'); ?>
        <?php echo $form->dropDownList(
            $bannerShow,
            'deal_direction',
            array(
                ''=>' --- ',
                'offer'=>'offer',
                'demand'=>'demand',
            )
        ); ?>
        <?php echo $form->error($bannerShow,'deal_direction'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($bannerShow,'controller'); ?>
        <?php echo $form->dropDownList(
            $bannerShow,
            'controller',
            array(''=>' --- ', 'ads'=>'ads',)
        ); ?>
        <?php echo $form->error($bannerShow,'controller'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($bannerShow,'action'); ?>
        <?php echo $form->textField(
            $bannerShow,
            'action',
            array('class'=>'autoAction',)
        ); ?>
        <ul class="autoList"></ul>
        <?php echo $form->error($bannerShow,'action'); ?>
    </div>
    <!-- ---___--------- -->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
Yii::app()->clientScript->registerPackage('jquery')
    ->registerScriptFile(
    Yii::app()->assetManager->publish(
        Yii::getpathOfAlias('application.modules.banners.js').'/bannersForm.js'
    ),CClientScript::POS_END)

    ->registerCssFile(
        Yii::app()->assetManager->publish(
            Yii::getpathOfAlias('application.modules.banners.css').'/autocomplete.css'
        ))
    ->registerScriptFile(
        Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('application.modules.banners.js').'/autocomplete.js'
        ), CClientScript::POS_END);