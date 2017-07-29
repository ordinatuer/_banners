<?php
/* @var $this BannersController */
/* @var $data Banners */
?>

<div class="view">
    <?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:
	<a href="<?php echo CHtml::encode($data->url);?>" target="_blank">
        <?php echo CHtml::encode($data->url); ?>
    </a>

	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
    <img src="/banners/images/<?php echo $data->image; ?>" />
    <br />

</div>

