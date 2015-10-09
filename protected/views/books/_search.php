<?php
/* @var $this BooksController */
/* @var $model Books */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>
    <div class="row">
            <?php echo $form->label($model,'name'); ?>
            <?php echo $form->textField($model,'name'); ?>
        </div>

	<div class="row">
		<?php echo $form->label($model,'author_id'); ?>
        <?php echo $form->dropDownList($model,'author_id',Author::All(), array('empty'=>'- Choose - ',   'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genre_1'); ?>
        <?php echo $form->dropDownList($model,'genre_1',Genre::All(),array('empty'=>'- Choose - ','maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genre_2'); ?>
        <?php echo $form->dropDownList($model,'genre_2',Genre::All(),array('empty'=>'- Choose - ','maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genre_3'); ?>
        <?php echo $form->dropDownList($model,'genre_3',Genre::All(),array('empty'=>'- Choose - ','maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'year'); ?>
		<?php echo $form->textField($model,'year'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->