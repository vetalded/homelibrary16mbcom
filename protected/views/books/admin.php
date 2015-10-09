<?php
/* @var $this BooksController */
/* @var $model Books */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Books', 'url'=>array('index')),
	array('label'=>'Create Books', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#books-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Books</h1>

<p>
    You may optionaly enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'books-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'name' => 'id',
            'value' => '$data->id',
            'filterHtmlOptions'=>array('class' => 'filter_id')),
		'name',

        array(
            'name' => 'author_id',
            'value' => '$data->author->name',
            'filter'=>Author::All(),

        ),
        array(
            'name' => 'genre_1',
            'value' => '$data->genre1->name',
            'filter'=>Genre::All(),

        ),
        array(
            'name' => 'genre_2',
            'value' => '$data->genre2->name',
            'filter'=>Genre::All(),

        ),
        array(
            'name' => 'genre_3',
            'value' => '$data->genre3->name',
            'filter'=>Genre::All(),

        ),
        array(
            'name' => 'year',
            'value' => '$data->year',
            'filterHtmlOptions'=>array('class' => 'filter_id')),
		/*
		'description',
		'ext1',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
