<?php
/* @var $this BooksController */
/* @var $data Books */
?>

<div class="view">
    <table><tr><td class="img_td">
    <?= CHtml::image(empty($data->ext1)?Yii::app()->request->baseUrl."/images/no_image.png":Yii::app()->request->baseUrl."/images/books/".$data->id."_1.".$data->ext1,"",array('class'=>"list_view_img"))?>
    </td><td>
    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author_id')); ?>:</b>
	<?php echo CHtml::encode($data->author->name); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('genre_1')); ?>:</b>
	<?php echo CHtml::encode($data->genre1->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('genre_2')); ?>:</b>
	<?php echo CHtml::encode($data->genre2->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('genre_3')); ?>:</b>
	<?php echo CHtml::encode($data->genre3->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ext1')); ?>:</b>
	<?php echo CHtml::encode($data->ext1); ?>
	<br />

	*/ ?>
    </td></tr>
    </table>
</div>