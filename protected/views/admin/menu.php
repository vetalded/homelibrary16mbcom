<?php
$this->pageTitle=Yii::app()->name . ' - '.Yii::t('trans','Main menu');


echo '<div class="ic_menu">';
$this->widget('zii.widgets.CMenu', array(
	'items'=>array(
     array('label'=>Yii::t('trans','Books'), 'items'=>array(
      array('label'=>Yii::t('trans','Books'), 'url'=>array('books/index')),
      array('label'=>Yii::t('trans','Author'), 'url'=>array('author/index')),
      array('label'=>Yii::t('trans','Genre'), 'url'=>array('genre/index')),
    ),  'itemOptions'=>array('class'=>'ic_menu_lable')),
    array('label'=>Yii::t('trans','Users'), 'items'=>array(
			array('label'=>Yii::t('trans','Users'), 'url'=>array('user/index')),
      array('label'=>Yii::t('trans','UserType'), 'url'=>array('UserType/index')),
		), 'itemOptions'=>array('class'=>'ic_menu_lable')),

    array('label'=>Yii::t('trans','Other'), 'items'=>array(
			array('label'=>Yii::t('trans','City'), 'url'=>array('city/index')),
		), 'itemOptions'=>array('class'=>'ic_menu_lable')),
    ),
));
echo '</div>';
?>