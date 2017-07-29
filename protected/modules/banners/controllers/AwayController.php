<?php

class AwayController extends Controller
{
    /**
     * @param int $id of the image banner
     * find banner on database, increment of clicks on the banner and redirect on the corresponding link
     */
    public function actionIndex($id)
    {
        $bannerShow = BannerShow::model()->findByPk($id);
        $bannerShow->saveCounters(array('clicks'=>1));

        $this->redirect($bannerShow->banners->url);
    }
}