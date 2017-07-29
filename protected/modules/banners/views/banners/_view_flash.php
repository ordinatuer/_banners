<?php
/* @var $this BannersController */
/* @var $data Banners */
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
    <embed type="application/x-shockwave-flash"
       src="/banners/swf/<?php echo $data->image;?>"
       width="230px"
       height="200px"
       pluginspage="http://www.adobe.com/go/getflashplayer"
    ></embed>
    <br />

    <?php /**
	<b><?php echo CHtml::encode($data->getAttributeLabel('show')); ?>:</b>
	<?php echo CHtml::encode($data->show); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('clicks')); ?>:</b>
	<?php echo CHtml::encode($data->clicks); ?>
	<br />
    */?>

</div>