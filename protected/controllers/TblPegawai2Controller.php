<?php

class TblPegawai2Controller extends Controller
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
		$model=new TblPegawai2;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblPegawai2']))
		{
			$model->attributes=$_POST['TblPegawai2'];
			$d_nip 			 = $_POST['TblPegawai2']['nip'];
			$d_nama 		 = $_POST['TblPegawai2']['nama'];
			$d_alamat 		 = $_POST['TblPegawai2']['alamat'];
			$d_tanggal_lahir = $_POST['TblPegawai2']['tanggal_lahir'];
			$d_agama 		 = $_POST['TblPegawai2']['agama'];

			$sql = "INSERT INTO tbl_pegawai(nip, nama, alamat, tanggal_lahir, agama) VALUES (:d_nip, :d_nama, :d_alamat, :d_tanggal_lahir, :d_agama)";
			$cmd = Yii::app()->db->createCommand($sql);
			$cmd->bindParam(":d_nip", $d_nip,PDO::PARAM_INT);
			$cmd->bindParam(":d_nama", $d_nama,PDO::PARAM_STR);
			$cmd->bindParam(":d_alamat", $d_alamat,PDO::PARAM_STR);
			$cmd->bindParam(":d_tanggal_lahir", $d_tanggal_lahir,PDO::PARAM_STR);
			$cmd->bindParam(":d_agama", $d_agama,PDO::PARAM_STR);
			try {
				$cmd->execute();
				$this->redirect(array('admin'));
			} catch (Exception $e) {
				ii::app()->user->setFlash('adaKesalahan', "Ada kesalahan : ". "{$e->getMessage()}");
			}

			// if($model->save())
			// 	$this->redirect(array('view','id'=>$model->nip));
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

		if(isset($_POST['TblPegawai2']))
		{
			$model->attributes=$_POST['TblPegawai2'];
			$d_nip 			 = $_POST['TblPegawai2']['nip'];
			$d_nama 		 = $_POST['TblPegawai2']['nama'];
			$d_alamat 		 = $_POST['TblPegawai2']['alamat'];
			$d_tanggal_lahir = $_POST['TblPegawai2']['tanggal_lahir'];
			$d_agama 		 = $_POST['TblPegawai2']['agama'];

			$sql = "UPDATE tbl_pegawai SET nip=:d_nip, nama=:d_nama, alamat=:d_alamat, tanggal_lahir=:d_tanggal_lahir, agama=:d_agama WHERE nip=:id";
			$cmd = Yii::app()->db->createCommand($sql);
			$cmd->bindParam(":d_nip", $d_nip,PDO::PARAM_INT);
			$cmd->bindParam(":d_nama", $d_nama,PDO::PARAM_STR);
			$cmd->bindParam(":d_alamat", $d_alamat,PDO::PARAM_STR);
			$cmd->bindParam(":d_tanggal_lahir", $d_tanggal_lahir,PDO::PARAM_STR);
			$cmd->bindParam(":d_agama", $d_agama,PDO::PARAM_STR);
			$cmd->bindParam(":id", $id, PDO::PARAM_INT);
			try {
				$cmd->execute();
				$this->redirect(array('admin'));
			} catch (Exception $e) {
				ii::app()->user->setFlash('adaKesalahan', "Ada kesalahan : ". "{$e->getMessage()}");
			}
			// if($model->save())
			// 	$this->redirect(array('view','id'=>$model->nip));
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
		$sql="DELETE FROM tbl_pegawai WHERE nip=:id";
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
		$dataProvider=new CActiveDataProvider('TblPegawai2');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TblPegawai2('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblPegawai2']))
			$model->attributes=$_GET['TblPegawai2'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TblPegawai2 the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TblPegawai2::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TblPegawai2 $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-pegawai2-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
