<?php

class KotaController extends Controller
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
				'actions'=>array('index','view','tampilkan'),
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

	function actionTampilkan()
	{
		$sql = "SELECT kota.propinsi_id, kota.nama_kota, provinsi.propinsi
				FROM kota, provinsi
				WHERE kota.propinsi_id = provinsi.id";
		$cmd = Yii::app()->db->createCommand($sql);
		$rows =$cmd->queryAll();
		$this->render('tampilkan', array('rows'=>$rows));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Kota;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Kota']))
		{
			$model->attributes=$_POST['Kota'];
			$prop_id = $_POST['Kota']['propinsi_id'];
			$nama_kota = $_POST['Kota']['nama_kota'];

			$sql="INSERT INTO kota(propinsi_id, nama_kota) VALUES (:prop_id, :nama_kota)";
			$cmd = Yii::app()->db->createCommand($sql);
			$cmd->bindParam(":prop_id", $prop_id, PDO::PARAM_INT);
			$cmd->bindParam(":nama_kota", $nama_kota, PDO::PARAM_STR);
			try {
				$cmd->execute();
				$this->redirect(array('admin'));
			} catch (Exception $e) {
				Yii::app()->user->setFlash('adaKesalahan', "Ada kesalahan : ". "{$e->getMessage()}");
			}
			// if($model->save())
			// 	$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Kota']))
		{
			$model->attributes=$_POST['Kota'];
			$prop_id = $_POST['Kota']['propinsi_id'];
			$nama_kota = $_POST['Kota']['nama_kota'];

			$sql="UPDATE kota SET propinsi_id=:prop_id, nama_kota=:nama_kota WHERE id=:id";
			$cmd = Yii::app()->db->createCommand($sql);
			$cmd->bindParam(":prop_id", $prop_id, PDO::PARAM_INT);
			$cmd->bindParam(":nama_kota", $nama_kota, PDO::PARAM_STR);
			$cmd->bindParam(":id", $id, PDO::PARAM_INT);
			try {
				$cmd->execute();
				$this->redirect(array('admin'));
			} catch (Exception $e) {
				Yii::app()->user->setFlash('adaKesalahan', "Ada kesalahan : ". "{$e->getMessage()}");
			}
			// if($model->save())
			// 	$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('update',array(
			'model'=>$model,
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
		$sql="DELETE FROM kota WHERE id=:id";
		$cmd = Yii::app()->db->createCommand($sql);
		$cmd->bindParam(":id", $id, PDO::PARAM_INT);
		$cmd->execute();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Kota');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Kota('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Kota']))
			$model->attributes=$_GET['Kota'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Kota the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Kota::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Kota $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kota-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
