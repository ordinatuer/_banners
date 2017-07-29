<?php

class BaseBanner extends CWidget
{
    protected $position = 1;
    protected $params_url;
    protected $params_rules;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->params_url = Yii::app()->request->url;
        $this->params_rules = array(
                        'controller'=>$this->owner->id,
                        'action'=>$this->owner->action->id,
                    );
        $this->searchBanners();
        parent::init();
    }

    protected function searchBanners()
    {
        // banners by parameters
        $banners = BannerShow::model()->pretenders(
                $this->position,
                $this->params_rules, 
                $this->params_url
            );
        if(count($banners)) {
            $random_banner = array_rand($banners);
            $random_banner_id = $banners[$random_banner]->banner_id;
            $banner_show_id = $banners[$random_banner]->id;
            // update show counter
            Yii::import('application.modules.banners.widgets.banners.components.Counter');
            Counter::getInstance($banner_show_id);

            $banner = Banners::model()->findByPk($random_banner_id);
            $type = $this->bannerType($banner->type);
            $this->render($type->template, array('banner'=>$banner,'type'=>$type,'id'=>$banner_show_id));
        }
    }
    protected function bannerType($id)
    {
        return Types::model()->findByPk($id);
    }
}