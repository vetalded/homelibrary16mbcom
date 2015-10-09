<?php
/* @var BooksCommentToComment $comment */
?>
<?php
$class=$comment->rate<0?'commentFalse':'commentTrue';
?>
<div class="<?=$class?> commentToComment">
    <div class="avatar">

    </div>
    <div class="commentInfo">
        <p class="user_name"><?=$comment->user->name?></p><p class="comment_date"><time datetime="2014-12-09T13:55:16+02:00"><?=UserFunctions::getCommentDate($comment->date)?></time></p>
    </div>
    <div class="commentText containerShort">
        <div class="comment_text"><?=$comment->comment?></div>
        <div class="clear"></div>
        <div class="showHide description_change" other="<?=Yii::t('trans','Show less')?>"><?=Yii::t('trans','Show more')?></div>
        <div class="clear"></div>
    </div>
    <?
    $comment_class='';
    switch($comment->wasLiked()){
        case 1:$comment_class='user_plus';break;
        case -1:$comment_class='user_minus';break;
    }
    ?>
    <div class="commentBtns <?=$comment_class?>" comment_id="<?=$comment->id?>">
        <input class="commentBtn plsMnsBtn minusBtn"  id="agree" type="button" name="plusBtn">
        <span class="minuses"><?=$comment->getLike('-')?></span>
        <input class="commentBtn plsMnsBtn plusBtn"  id="disagree" type="button" name="minusBtn">
        <span class="pluses"><?=$comment->getLike()?></span>
    </div>

</div>