<?php

class BannersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    private $types = array(  // model
        1=>'image',
        2=>'flash',
        3=>'html',
    ); // model
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Banners;
        $bannerShow = new BannerShow;
		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['Banners']))
		{
            $bannerShow->attributes = $_POST['BannerShow'];
            $model->attributes=$_POST['Banners'];
            $model->scenario = $this->types[$model->type]; // model

            if($model->save()) {
                $bannerShow->banner_id = $model->id;
                if($bannerShow->save()) {
                    $this->redirect(array('view','id'=>$model->id));
                }
            }
		}

		$this->render('create',array(
			'model'=>$model,
            'bannerShow'=>$bannerShow
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

        $criteria = new CDbCriteria;

        $criteria->condition = 'banner_id=:banner_id';
        $criteria->params = array(':banner_id'=>$model->id);
        $bannerShow = BannerShow::model()->find($criteria);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Banners']))
		{
			$model->attributes=$_POST['Banners'];

            if (1 == $model->type OR 2 == $model->type) {
                if (4 !== $_FILES['Banners']['error']['image']) {
                    $model->setScenario($this->types[$model->type]);
                } else {
                    $model->setScenario('banner_update');
                }
            }

			if ($model->save()) {
                $bannerShow->banner_id = $model->id;
                if ($bannerShow->save()) {
                    $this->redirect(array('view','id'=>$model->id));
                }
            }
        }

		$this->render('update',array(
			'model'=>$model,
            'bannerShow'=>$bannerShow,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('create'));
	}

	/**
	 * Lists all models with filters
	 */
	public function actionIndex()
	{
        $model = new Banners('search');
        $model->unsetAttributes();
        if (isset($_GET['Banners'])) {
            $model->attributes = $_GET['Banners'];
        }

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Banners('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Banners'])) {
            $model->attributes=$_GET['Banners'];
        }

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Banners the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Banners::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Banners $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='banners-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
//    /**
//     * @return array (banner id => banner description)
//     */
//    private function bannersList()
//    {
//        $criteria = new CDbCriteria;
//        $criteria->select = 'id, description';
//        $banners = Banners::model()->findAll($criteria);
//
//        $_banners = array();
//        foreach($banners as $banner) {
//            $_banners[$banner->id] = $banner->description;
//        }
//
//        return $_banners;
//    }
}
