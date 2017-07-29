<?php

/**
 * This is the model class for table "banner_show".
 *
 * The followings are the available columns in table 'banner_show':
 * @property integer $id
 * @property integer $banner_id
 * @property integer $place_id
 * @property integer $show
 * @property integer $clicks
 * @property string $property_type
 * @property string $deal_kind
 * @property string $deal_direction
 * @property string $controller
 * @property string $action
 * @property string $update_time
 */
class BannerShow extends CActiveRecord
{
    /**
     * @property string decription from Banners ($this->banners->description)
     */
    public $description;
    /**
     * @param int $position
     * TopBanner = 1, BottomBanner = 2,
     * RightBanner = 3, MiddleBanner = 4
     * @param array $params_rules
     * array(
     *      controller=>controller_id,
     *      action=>action_id,
     * )
     * @param string $params_url
     * @return BannerShow
     */
    public function pretenders($position, $params_rules, $params_url)
    {
        $params_url = explode('/', $params_url);

        $criteria = new CDbCriteria();
        $criteria->distinct = true;
        $criteria->select = 'id, banner_id';

        $criteria->condition = '`place_id`=:place_id'
                . ' AND ((`property_type`=:params_url1'
                    . ' OR `deal_kind`=:params_url2'
                    . ' OR `deal_direction`=:params_url3)'
                . ' OR (`controller`=:params_rules1'
                . ' OR `action`=:params_rules2))';
        $criteria->params = array(
            ':place_id'=>$position,
            ':params_rules1'=>$params_rules['controller'],
            ':params_rules2'=>$params_rules['action'],
            ':params_url1'=>$params_url[1],
            ':params_url2'=>$params_url[2],
            ':params_url3'=>$params_url[3],
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
			array('banner_id, place_id', 'required'),
			array('banner_id, place_id, show, clicks', 'numerical', 'integerOnly'=>true),
			array('property_type, deal_kind, deal_direction, controller, action',
                'length', 'max'=>32),
			array('update_time', 'safe'),
            array('property_type, deal_direction, deal_kind, description','safe','on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'banners'=>array(self::BELONGS_TO,'Banners','banner_id'),
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
			'show' => 'Show',
			'clicks' => 'Clicks',
			'property_type' => 'Property Type',
			'deal_kind' => 'Deal Kind',
			'deal_direction' => 'Deal Direction',
			'controller' => 'Controller',
			'action' => 'Action',
            'description'=>'Description',
			'update_time' => 'Update Time',
		);
	}
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->with = array('banners');

        $criteria->compare('property_type',$this->property_type);
        $criteria->compare('deal_kind',$this->deal_kind,true);
        $criteria->compare('deal_direction',$this->deal_direction,true);
        $criteria->compare('controller',$this->controller,true);
        $criteria->compare('action',$this->action,true);
        $criteria->compare('banners.description',$this->description,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
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
