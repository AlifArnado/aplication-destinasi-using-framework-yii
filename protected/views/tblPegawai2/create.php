<?php
/* @var $this TblPegawai2Controller */
/* @var $model TblPegawai2 */

$this->breadcrumbs=array(
	'Tbl Pegawai2s'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TblPegawai2', 'url'=>array('index')),
	array('label'=>'Manage TblPegawai2', 'url'=>array('admin')),
);
?>

<h1>Create TblPegawai2</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>