<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/profile_menu.css" />

<?php $user=new User('index')?>
<div class="wrapper">
    <div id="registrations">
       <ul>
           <li><?=CHtml::link(Yii::t("trans","My profile"))?></li>
           <li><?=CHtml::link(Yii::t("trans","Logout"),$this->createUrl("index/logout"))?></li>
       </ul>
    </div>
</div>

