<?php

/**
 * This is the model class for table "banner_show".
 *
 * The followings are the available columns in table 'banner_show':
 * @property integer $id
 * @property integer $banner_id
 * @property integer $place_id
 * @property string $property_type
 * @property string $dealKind
 * @property string $dealDirection
 * @property string $controller
 * @property string $action
 * @property string $update_time
 */
class BannerShow extends CActiveRecord
{
    /**
     * 
     * @param int $position
     * TopBanner = 1, BottomBanner = 2,
     * RightBanner = 3, MiddleBanner = 4 
     * @param array $params_rules
     * array(
     *      controller=>controller_id,
     *      action=>action_id,
     * )
     * @param string $params_url
     * Yii::app()->request->url
     * 
     * @return object BannerShow
     */
    public function pretenders($position, $params_rules, $params_url)
    {
        $params_url = explode('/', $params_url);

        $criteria = new CDbCriteria();
        $criteria->distinct = true;
        $criteria->select = 'banner_id';
        $criteria->condition = 'place_id=:place_id'
                . ' AND (params_rules=:params_rules1 OR '
                    . 'params_rules=:params_rules2)'
                . ' AND params_url=:params_url1 OR '
                    . 'params_url=:params_url2 OR '
                    . 'params_url=:params_url3'
                ;
        $criteria->params = array(
            ':place_id'=>$position,
            ':params_rules1'=>$params_rules['controller'],
            ':params_rules2'=>$params_rules['controller'].'/'.$params_rules['action'],
            ':params_url1'=>$params_url[1],
            ':params_url2'=>$params_url[1].'/'.$params_url[2],
            ':params_url3'=>$params_url[1].'/'.$params_url[2].'/'.$params_url[3],
        );
        
        $dependency = new CDbCacheDependency('SELECT MAX(`update_time`) FROM `banner_show`');
        
        return $this->cache(86400, $dependency)->findAll($criteria);
    }
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'banner_show';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('banner_id, place_id, params_url, params_rules', 'required'),
                array('banner_id, place_id', 'numerical', 'integerOnly'=>true),
                array('params_url, params_rules', 'length', 'max'=>64),
            );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'banner_id' => 'Banner',
            'place_id' => 'Place',
            'params_url' => 'Params Url',
            'params_rules' => 'Params Rules',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return BannerShow the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
