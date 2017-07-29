<?php
/* @var $this BannerShowController */
/* @var $data BannerShow */
?>

<div class="view">
    <?php /**
        <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
        <br />
     */
    ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('banner_id')); ?>:</b>
	<?php echo CHtml::encode($data->banner_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('place_id')); ?>:</b>
	<?php echo CHtml::encode($data->place_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_type')); ?>:</b>
	<?php echo CHtml::encode($data->property_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deal_kind')); ?>:</b>
	<?php echo CHtml::encode($data->deal_kind); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deal_direction')); ?>:</b>
	<?php echo CHtml::encode($data->deal_direction); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('controller')); ?>:</b>
	<?php echo CHtml::encode($data->controller); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('show')); ?>:</b>
    <?php echo CHtml::encode($data->show); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('clicks')); ?>:</b>
    <?php echo CHtml::encode($data->clicks); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('banners.description')); ?>:</b>
    <?php echo CHtml::encode($data->banners->description); ?>
    <br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('action')); ?>:</b>
	<?php echo CHtml::encode($data->action); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	*/ ?>

    <?php
        $this->renderFile(__DIR__ . DIRECTORY_SEPARATOR . '_banner.php', $data);
    ?>

</div>