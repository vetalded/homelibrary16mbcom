<?php
/* @var $this BooksController */
/* @var $model Books */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Books', 'url'=>array('index')),
	array('label'=>'Create Books', 'url'=>array('create')),
	array('label'=>'Update Books', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Books', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Books', 'url'=>array('admin')),
);
?>

<h1>View Books #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
        array('name'=>'author_id','value'=>$model->author->name),
        array('name'=>'genre_1','value'=>$model->genre1->name),
        array('name'=>'genre_2','value'=>$model->genre2->name),
        array('name'=>'genre_3','value'=>$model->genre3->name),
		'year',
		'description',
        array( 'type'=>'raw','name'=>'ext1','value'=> CHtml::image(empty($model->ext1)?Yii::app()->request->baseUrl."/images/no_image.png":Yii::app()->request->baseUrl."/images/books/".$model->id."_1.".$model->ext1,"")),

	),
)); ?>
