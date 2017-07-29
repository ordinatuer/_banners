<?php

class BannerShowController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
            'ajaxOnly + autocoplete'
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
				'actions'=>array('create','update','autocomplete'),
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


    public function actionAutocomplete()
    {
        $controller = Yii::app()->request->getParam('controller');

        Yii::import('application.controllers.AdsController');
        $methods = get_class_methods('AdsController');
        sort($methods);
        $actions = array();

        foreach ($methods as $method) {
            if(FALSE !== stripos($method, '__')) {
                continue;
            }
            if (FALSE !== stripos($method, 'after')) {
                break;
            }
            $method  = str_replace('action', '', $method);
            if (FALSE !== stripos($method, $controller) &&
                's' !== $method &&
                'accessRules' !== $method) {
                $actions[] = $method;
            }
        }

        echo json_encode($actions);
        Yii::app()->end();
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
		$model = new BannerShow;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['BannerShow'])) {
			$model->attributes=$_POST['BannerShow'];
			if ($model->save()) {
                $this->redirect(array('view','id'=>$model->id));
            }
		}

        $banners = $this->bannersList();

		$this->render('create',array(
			'model'=>$model,
            'banners'=>$banners,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BannerShow']))
		{
			$model->attributes=$_POST['BannerShow'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

        $banners = $this->bannersList();

		$this->render('update',array(
			'model'=>$model,
            'banners'=>$banners,
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
		if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('BannerShow');
        $model = new BannerShow('search');
        $model->unsetAttributes();
        if (isset($_GET['BannerShow'])) {
            $model->attributes = $_GET['BannerShow'];
        }

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'model'=>$model
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new BannerShow('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['BannerShow'])) {
			$model->attributes = $_GET['BannerShow'];
        }

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BannerShow the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BannerShow::model()->findByPk($id);
		if ($model === null) {
			throw new CHttpException(404,'The requested page does not exist.');
        }
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BannerShow $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='banner-show-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    /**
     * @return array (banner id => banner description)
     */
    private function bannersList()
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'id, description';
        $banners = Banners::model()->findAll($criteria);

        $_banners = array();
        foreach($banners as $banner) {
            $_banners[$banner->id] = $banner->description;
        }

        return $_banners;
    }
}