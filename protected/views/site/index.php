<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$this->widget('application.components.UloginWidget', array(
    'params'=>array(
        'redirect'=>'http://'.$_SERVER['HTTP_HOST'].'/index.php?r=ulogin/login' //Адрес, на который ulogin будет редиректить браузер клиента. Он должен соответствовать контроллеру ulogin и действию login
    )
)); ?>
