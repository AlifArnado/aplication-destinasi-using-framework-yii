<?php
/* @var $this TblPegawai2Controller */
/* @var $model TblPegawai2 */

$this->breadcrumbs=array(
	'Tbl Pegawai2s'=>array('index'),
	$model->nip,
);

$this->menu=array(
	array('label'=>'List TblPegawai2', 'url'=>array('index')),
	array('label'=>'Create TblPegawai2', 'url'=>array('create')),
	array('label'=>'Update TblPegawai2', 'url'=>array('update', 'id'=>$model->nip)),
	array('label'=>'Delete TblPegawai2', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->nip),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblPegawai2', 'url'=>array('admin')),
);
?>

<h1>View TblPegawai2 #<?php echo $model->nip; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nip',
		'nama',
		'alamat',
		'tanggal_lahir',
		'agama',
	),
)); ?>
