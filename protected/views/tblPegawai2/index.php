<?php
/* @var $this TblPegawai2Controller */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tbl Pegawai2s',
);

$this->menu=array(
	array('label'=>'Create TblPegawai2', 'url'=>array('create')),
	array('label'=>'Manage TblPegawai2', 'url'=>array('admin')),
);
?>

<h1>Tbl Pegawai2s</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
