<?php
    /* @var UserPageController $this */
    /* @var $user User */
    /* @var $profile Profile */
    /* @var CActiveForm $form*/
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/index.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/about_book.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/user_page/my_account.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/user_page/my_settings.css" />

<div id="holder">
    <div class="private_account">
        <?php $this->renderPartial('/userPage/_menu') ?>
        <div class="main">
            <div class="mySettigs">
                <div class="colomn1">
                    <div class="frame">
                        <p  class="center settingsHeader">Загальні налаштування</p>
                        <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'profile_settings',
                            'method'=>'post',
                            'action' => Yii::app()->createUrl('userPage/profile_settings'),
                            'enableClientValidation'=>true,
                            'enableAjaxValidation'=>false,
                            'clientOptions'=>array(
                                'validateOnSubmit'=>true,
                                'validateOnChange'=>true,
                            ),
                            'htmlOptions'=>array('class'=>'center')
                        )); ?>
                            <div class="row">
                                <?=$form->labelEx($profile,"city_id")?>
                                <?=$form->dropDownList($profile,"city_id",City::All(),array('class'=>'city','empty'=>Yii::t('trans','City')))?>
                                <div class="clear"></div>
                                <?=$form->error($profile,"city_id")?>
                            </div>
                            <div class="row">
                                <?=$form->labelEx($profile,"phone")?>
                                <?=$form->textField($profile,"phone",array('class'=>'input'))?>
                                <div class="clear"></div>
                                <?=$form->error($profile,"phone")?>
                            </div>
                            <?= CHtml::ajaxSubmitButton('Зберегти',Yii::app()->createUrl('userPage/profile_settings'),[],['class'=>'button-style']) ?>
                        <?php $this->endWidget(); ?>
                        <div class="clear"></div>
                    </div>
                    <div class="frame">
                        <p  class="center settingsHeader">Зміна пароля</p>
                        <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'profile_password',
                            'method'=>'post',
                            'action' => Yii::app()->createUrl('userPage/change_password'),
                            'enableAjaxValidation'=>true,
                            'clientOptions'=>array(
                                'validateOnSubmit'=>true,
                                'validateOnChange'=>false,
                                'afterValidate' => 'js:function(form,field,hasErrors) {
                                    if(!hasErrors) {
                                        $("#ajax-password").click();
                                    }
                                }'
                            ),

                            'htmlOptions'=>array('class'=>'center')
                        )); ?>
                            <div class="row">
                                <?=$form->labelEx($user,"current_password")?>
                                <?=$form->passwordField($user,"current_password",array('class'=>'input','autocomplete'=>false))?>
                                <div class="clear"></div>
                                <?=$form->error($user,"current_password")?>
                            </div>
                            <div class="row">
                                <?=$form->labelEx($user,"new_password")?>
                                <?=$form->passwordField($user,"new_password",array('class'=>'input'))?>
                                <div class="clear"></div>
                                <?=$form->error($user,"new_password")?>
                            </div>
                            <div class="row">
                                <?=$form->labelEx($user,"password_repeat")?>
                                <?=$form->passwordField($user,"password_repeat",array('class'=>'input'))?>
                                <div class="clear"></div>
                                <?=$form->error($user,"password_repeat")?>
                            </div>

                        <?= CHtml::submitButton('Зберегти',['class'=>'button-style']) ?>
                        <?= CHtml::ajaxSubmitButton('Зберегти',Yii::app()->createUrl('userPage/change_password'),[],['hidden'=>true, 'id'=>'ajax-password']) ?>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>

                <div class="colomn2">
                    <label for="avatar">Змінити фото</label>
                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'profile_image',
                        'method'=>'post',
                        'action' => Yii::app()->createUrl('userPage/saveImage'),
                        'htmlOptions'=>array('enctype'=>'multipart/form-data')
                    )); ?>
                        <?= CHtml::openTag('label',['for'=>CHtml::activeId($profile,'image')])?>
                            <?= CHtml::image($profile->profileImage,'',['style'=>'height:100px;width:100px'])?>
                        <?= CHtml::closeTag('label')?>

                        <?= CHtml::ActiveFileField($profile,'image',['hidden'=>'true'])?>
                        <?= CHtml::submitButton('Зберегти',['class'=>'button-style']) ?>
                    <?php $this->endWidget();?>
                </div>

                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>

</div>		<!-- #holder ends -->
<style>
    .errorMessage {
        margin-left: 0px;
    }
</style>
<script>
    $("input[type=file]").change(function(evt){
        var $this = $(this);
        var file = evt.target.files[0];
        if(validateImage(file)) {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("label[for=" + $this.attr('id') + "] img").attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        } else {
            this.innerHtml = this.innerHtml;
            $this.val('');
        }
    });
    /**
     *
     * @param file
     * @returns {boolean}
     */
    function validateImage(file) {
        return file.type.indexOf('image')!=-1
    }
</script>