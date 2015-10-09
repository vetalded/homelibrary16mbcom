<?php
/* @var Books $book */
/* @var Array $comments */
?>
<style>
    <?php for($i=0;$i<=100;$i++){?>
    .stars_all[rate="<?=$i?>"]{
        width: <?=$i?>px;
    }
    <?php }?>

</style>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/index.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/about_book.css" />
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/about_book.js',CClientScript::POS_HEAD); ?>
<div id="holder">
    <div id="BookDescription">
        <div class="poster ">
            <img src="<?=empty($book->ext1)?Yii::app()->request->baseUrl."/images/no_image.png":Yii::app()->request->baseUrl."/images/books/".$book->id."_1.".$book->ext1?>" alt="">
        </div>
        <div class="row">
            <input class="lookForSimularBook" id="search_simular_button" type="button" bookId="<?=$book->id?>" name="searchSimBtn" value="Знайти таку книгу">
        </div>
        <div class="rating_block">

            <div class="setRate" active=<?=!BookRate::doUserRate($book->id)?>>
                <div class='stars_none'><div class='stars_all' bookId="<?=$book->id?>" realrate=<?=$book->rate?> rate=<?=$book->rate?> ></div></div>
            </div>
            <?php if(!BookRate::doUserRate($book->id)){?>
                <div class="rate_button" thanks="<?=Yii::t('trans',"Thank your for you rate")?>"><?=Yii::t('trans',"Please rate it")?></div>
            <?php }?>
        </div>

        <div class="row">
            <table class="book_info">
                <tbody>
                <tr>
                    <th>
                        <?=Yii::t("trans","Name")?>
                    </th>
                    <td>
                        <?=$book->name?>
                    </td>
                </tr>
                <tr>
                    <th>
                        <?=Yii::t("trans","Author")?>
                    </th>
                    <td>
                        <?=$book->author->name?>
                    </td>
                </tr>
                <tr>
                    <th>
                        <?=Yii::t("trans","Year")?>
                    </th>
                    <td>
                        <?=$book->year?>
                    </td>
                </tr>
                <tr>
                    <th>
                        <?=Yii::t("trans","Genre")?>
                    </th>
                    <td>
                        <?=$book->genre?>
                    </td>
                </tr>
                <tr>
                </tbody>
            </table>
        </div>


        <div class="clear"></div>
        <div class="containerShort descriptionContainer">
            <p class="book_description">
                <?=$book->description?>
            </p>
            <div class="clear"></div>
                <div class="showHide description_change" other="<?=Yii::t('trans','Show less')?>"><?=Yii::t('trans','Show more')?></div>
            <div class="clear"></div>
        </div>

        <h2><?=Yii::t('trans','Comments')?></h2>
        <div class="newComment createCommentComment">
            <div class="avatar">
            </div>
            <?php
            $this->widget('application.components.widgets.XHeditor',array(

                'language'=>'ru',
                'config'=>array(
                    'name'=>'doComment',
                    'height'=>'150px',
                    'skin'=>'o2007silver',
                    'width'=>'800px',
                    'tools'=>'Fontface,FontSize,Bold,Italic,Underline,Strikethrough,FontColor,BackColor,Emot,Removeformat', // mini, simple, fill or from XHeditor::$_tools
                ),
            ));
            ?>
            <div class="clear"></div>
            <?=CHtml::button(Yii::t('trans','Send'),array('class'=>'button-style sendComment  justComment','bookId'=>$book->id))?>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="allComments">
            <?php
            foreach($comments as $comment){
                $this->renderPartial('_comment',array('comment'=>$comment));
            }?>
        </div>
        <div class="clear"></div>
    </div>
</div>		<!-- #holder ends -->

