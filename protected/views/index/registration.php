<?php
/* @var $user User */
/* @var $profile Profile */
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/index.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/Registry.css" />
<div id="holder">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'register',
        'method'=>'post',
        'enableClientValidation'=>true,
        'enableAjaxValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,),
        'htmlOptions'=>array('class'=>'register_form')
    )); ?>
        <div class="content">
            <div class="center">

                <div class="row">
                    <?=$form->labelEx($profile,"first_name")?>
                    <?=$form->textField($profile,"first_name")?>
                    <div class="clear"></div>
                    <?=$form->error($profile,"first_name")?>
                </div>
                <div class="row">
                    <?=$form->labelEx($profile,"second_name")?>
                    <?=$form->textField($profile,"second_name")?>
                    <div class="clear"></div>
                    <?=$form->error($profile,"second_name")?>
                </div>


                <div class="row">
                    <?=$form->labelEx($user,"login")?>
                    <?=$form->textField($user,"login",array('autocomplete'=>"off"))?>
                    <div class="clear"></div>
                    <?=$form->error($user,"login")?>
                </div>
                <div class="row">
                    <?=$user->password=""?>
                    <?=$form->labelEx($user,"password")?>
                    <?=$form->passwordField($user,"password",array('autocomplete'=>"off"))?>
                    <div class="clear"></div>
                    <?=$form->error($user,"password")?>
                </div>
                <div class="row">
                    <?=$user->password_repeat=""?>
                    <?=$form->labelEx($user,"password_repeat")?>
                    <?=$form->passwordField($user,"password_repeat",array('autocomplete'=>"off"))?>
                    <div class="clear"></div>
                    <?=$form->error($user,"password_repeat")?>
                </div>
                 <div class="row">
                    <?=$form->labelEx($profile,"city_id")?>
                    <?=$form->dropDownList($profile,"city_id",City::All(),array('class'=>'city','empty'=>Yii::t('trans','City')))?>
                    <div class="clear"></div>
                    <?=$form->error($profile,"city_id")?>
                </div>
                <div class="row">

                    <?=$form->labelEx($profile,"birthday")?>
                    <?=$form->dropDownList($profile,"b_day",UserFunctions::days(),array('class'=>'day','empty'=>Yii::t('trans','Day')))?>
                    <?=$form->dropDownList($profile,"b_month",UserFunctions::month(),array('class'=>'month','empty'=>Yii::t('trans','Month')))?>
                    <?=$form->dropDownList($profile,"b_year",UserFunctions::years(1950),array('class'=>'year','empty'=>Yii::t('trans','Year')))?>
                    <div class="clear"></div>
                    <?=$form->error($profile,"b_day")?>
                    <?=$form->error($profile,"b_month")?>
                    <?=$form->error($profile,"b_year")?>
                </div>
                <input class="button-style" type="submit" name="submit" value="Зареєструватися">
                <div class="clear"></div>
    <!--                <div class="captcha">-->
    <!--                    <div class="img"><img src="simple_captcha.jpg" alt=""></div>-->
    <!--                    <input type="text">-->
    <!--                    <p>(Введіть код з картинки)</p>-->
    <!--                </div>-->







            </div>

        </div>

    <?php $this->endWidget(); ?>

    <div class="register_benefits">
        <p>Переваги зареєстрованих користувачів</p>
        <ul>
            <li>Можливість оцінювати і коментувати свої улюблені книги</li>
            <li>Унікальна система підбору книги для прочитання</li>
            <li>Змога обмінюватись своїми книжаками</li>
        </ul>
    </div>
    <div class="clear"></div>
</div>		<!-- #holder ends -->