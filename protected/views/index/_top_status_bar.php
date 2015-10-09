<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/top_status_bar.css" />

<div class="header_main">
    <div class="wrapper">

        <div id="enter" class="user">
            <?php if(!Yii::app()->user->isGuest){
                echo Yii::app()->user->name;
            }else{
                echo Yii::t("trans","Enter");
            }?>
        </div>
        <?=CHtml::button("",array('style'=>'float:right'))?>
        <?=CHtml::searchField('q','',array('placeholder'=>Yii::t('trans','Search')))?>

    </div>

</div>
<?php if(Yii::app()->user->isGuest){ $this->renderPartial("/index/_enter");
}else{
    $this->renderPartial("/index/_profile_menu");
}?>
