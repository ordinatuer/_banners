<?php
/* @var $this AdsController */

$this->breadcrumbs=array(
	'advertisement page',
);
$widget = 'application.modules.banners.widgets.banners.';
?>

<div class="banner-grid">
    <div></div>
    <div><?php $this->widget('application.modules.banners.widgets.banners.TopBanner');?></div>
    <div></div>
    
    <div></div>
    <div><?php $this->widget('application.modules.banners.widgets.banners.MiddleBanner');?></div>
    <div><?php $this->widget('application.modules.banners.widgets.banners.RightBanner');?></div>
    
    <div></div>
    <div><?php $this->widget('application.modules.banners.widgets.banners.BottomBanner');?></div>
    <div></div>
</div>
