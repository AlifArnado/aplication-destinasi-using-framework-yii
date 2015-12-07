<?php
/* @var $this TblPegawai2Controller */
/* @var $model TblPegawai2 */

$this->breadcrumbs=array(
	'Tbl Pegawai2s'=>array('index'),
	$model->nip=>array('view','id'=>$model->nip),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblPegawai2', 'url'=>array('index')),
	array('label'=>'Create TblPegawai2', 'url'=>array('create')),
	array('label'=>'View TblPegawai2', 'url'=>array('view', 'id'=>$model->nip)),
	array('label'=>'Manage TblPegawai2', 'url'=>array('admin')),
);
?>

<h1>Update TblPegawai2 <?php echo $model->nip; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>