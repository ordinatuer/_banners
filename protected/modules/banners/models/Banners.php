<?php

/**
 * This is the model class for table "banners".
 *
 * The followings are the available columns in table 'banners':
 * @property integer $id
 * @property integer $type
 * @property string $url
 * @property string $description
 * @property string $content
 * @property string $image
 */
class Banners extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'banners';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type', 'required'),
            array('url', 'required', 'on'=>'image'),
            array(
                'image',
                'file',
                'types'=>array('jpg','png','gif'),
                'on'=>'image',
                'except'=>'banner_update',
                'message' => 'Image cannot be blank'
            ),
            array(
                'image',
                'file',
                'types'=>array('swf'),
                'on'=>'flash',
                'except'=>'banner_update',
                'message'=>'SWF cannot be blank',
            ),
            array(
                'content',
                'required',
                'on'=>'html',
            ),
            array('content','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
            array('type', 'numerical', 'integerOnly'=>true),
            array('content, description', 'safe'),
            array('url', 'url'),
            // search rules
            array('url','length', 'on'=>'search'),
            array('type, description, content', 'safe', 'on'=>'search'),
        );
	}

    /**
     * save the file (SWF or Image) according to the scenario
     * @return bool
     */
    protected function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if ('flash' === $this->scenario ||
                'image' === $this->scenario) {
                $type = Types::model()->findByPk($this->type);
                $this->image = CUploadedFile::GetInstance($this, 'image');
                $file = Yii::getPathOfAlias('webroot') . $type->path . $this->image;


                if($this->image && !$this->image->saveAs($file)) {
                    $this->addError('image', 'the file is not saved');
                    return false;
                }

                if('flash' === $this->scenario) {
                    $this->url = '';
                    $this->content = '';
                }
                if('image' === $this->scenario) {
                    $this->content = '';
                }
            }
            if('html' === $this->scenario) {
                $this->url = '';
            }
            return true;
        }
        return false;
    }
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'showRules'=>array(self::HAS_MANY, 'BannerShow', 'banner_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'url' => 'Url',
			'description' => 'Description',
			'content' => 'Content',
			'image' => 'Image',
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

        $criteria->compare('type',$this->type);
        $criteria->compare('url',$this->url,true);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('content',$this->content,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Banners the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
