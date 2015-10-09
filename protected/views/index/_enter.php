<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/enter.css" />

<?php $user=new User('index')?>
<div class="wrapper">
    <div id="registrations">
        <p class="enter_text">Authorization </p>
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'form',
            'action'=>$this->createUrl('index/signin'),
            'enableClientValidation'=>true,
            'enableAjaxValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>
        <div class="row">
            <?=$form->labelEx($user,"login")?>
            <?=$form->textField($user,"login")?>
            <div class="clear"></div>
            <?=$form->error($user,"login")?>
        </div>
        <div class="row">
            <?=$form->labelEx($user,"password")?>
            <?=$form->passwordField($user,"password")?>
            <div class="clear"></div>
            <?=$form->error($user,"password")?>
        </div>
        <?=CHtml::hiddenField('page_url',Yii::app()->Controller->id.'/'.Yii::app()->Controller->action->id)?>
        <a class="link_register" href="<?=$this->createUrl('index/register')?>"><?=Yii::t("trans","Registration")?></a>
        <?=CHtml::submitButton("Enter",array('class'=>'button-style','id'=>'enter_button'))?>
        <?php $this->endWidget(); ?>
    </div>
</div>

