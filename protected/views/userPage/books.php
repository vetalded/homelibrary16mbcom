<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/user_page/my_book.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/user_page/my_settings.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/user_page/edit_book.css" />
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'dialogError',
    'options' => array(
        'title' => Yii::t('general','Attention'),
        'autoOpen' => true,
        'modal' => true,
        'closeOnEscape' => true,
        'resizable'=> false,
        'width'=>'800',
    ),
));
?>

<div class="dialog_window editBook">
        <form action="" class="bookAddForm">
            <p>Редагувати книгу</p>
            <div class="row">
                <label for="title">Назва:</label>
                <input type="text" id="title" class="inputB" />
                <div class="clear"></div>
            </div>
            <div class="row">
                <label for="author">Автор:</label>
                <input type="text" id="author" class="inputB"/>
                <div class="clear"></div>
            </div>
            <div class="row">
                <label for="year">Рік:</label>
                <input type="text" id="year" class="inputB"/>
                <div class="clear"></div>
            </div>
            <div class="row">
                <label for="state">Стан:</label>
                <input type="text" id="state" class="inputB"/>
                <div class="clear"></div>
            </div>
            <div class="row">
                <label for="type">Тип пропозиції:</label>
                <select name="" id="type" class="bookAddSelect">
                    <option value="">Тип пропозиції</option>
                    <option value="1">Продам</option>
                    <option value="2">Обміняю</option>
                    <option value="3">Подарую</option>
                </select>
                <div class="clear"></div>
            </div>
            <input type="button" value="Додати" class="button-style" />
            <div class="clear"></div>
        </form>

        <div class="clear"></div>
    </div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>