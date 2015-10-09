<?php
/* @var $this BooksController */
/* @var $model Books */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'books-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name'); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'author_id'); ?>
		<?php echo $form->dropDownList($model,'author_id',Author::All(), array('empty'=>'- Choose - ','maxlength'=>10)); ?>
		<?php echo $form->error($model,'author_id'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'genre_1'); ?>
		<?php echo $form->dropDownList($model,'genre_1',Genre::All(),array('empty'=>'- Choose - ','maxlength'=>10)); ?>
		<?php echo $form->error($model,'genre_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'genre_2'); ?>
		<?php echo $form->dropDownList($model,'genre_2',Genre::All(),array('empty'=>'- Choose - ','maxlength'=>10)); ?>
		<?php echo $form->error($model,'genre_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'genre_3'); ?>
		<?php echo $form->dropDownList($model,'genre_3',Genre::All(),array('empty'=>'- Choose - ','maxlength'=>10)); ?>
		<?php echo $form->error($model,'genre_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->textField($model,'year',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
    <div  class="upload_img" no=1>
        <?= CHtml::image(empty($model->ext1)?Yii::app()->request->baseUrl."/images/no_image.png":Yii::app()->request->baseUrl."/images/books/".$model->id."_1.".$model->ext1,"")?>
        <div class="delete_img"></div>
        <?php echo $form->fileField($model,'ext1', array("no"=>1, "class"=>"click_file")); ?>
        <?php echo $form->hiddenField($model,'delete_img1',array('class'=>'flag_delete_img')); ?>
    </div>

    <div class="clear"></div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->