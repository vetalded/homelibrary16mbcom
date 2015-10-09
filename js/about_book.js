var offset = 10;
function setShortComment() {
    $('.comment .showHide,.commentToComment .showHide').each(function() {
        var $container=$(this).parents(".commentText").find(".comment_text");

        if( $container.height()== parseInt($container.css('max-height'))) {
            $(this).show();
        }
    })
}
function minimizeMaximize(comment) {
   var container= comment.find('.commentToCommentContainer');
   if(container.hasClass('moreComments')){
       container.find('.commentToComment').show();
       container.removeClass('moreComments');
       container.find('.arrow_comment').addClass('arrow_comment_fixed');
   }else{
       var all=container.find('.commentToComment').length;
       container.find('.commentToComment').each(function(index){
           if(index<all-3){
               $(this).hide();
           }
       });
       container.addClass('moreComments');
       if(all>3){
           container.find('.arrow_comment').show();
           container.find('.arrow_comment').removeClass('arrow_comment_fixed');
       }
   }
}
$(document).ready(function() {

    setShortComment();
    $('.commentContainer').each(function() {
       minimizeMaximize($(this));
    });
    $('.arrow_comment').live('click',function(){
       minimizeMaximize($(this).parents('.commentContainer'))
       $(document).scrollTop($(this).parents('.commentContainer').offset().top-32);
    });
    $('.setRate .stars_none').live('mouseover mousemove',function(e){
        if($(this).parents(".setRate").attr('active')=='1'){
            $(this).find('.stars_all').attr('rate',parseInt(e.clientX-$(this).offset().left)-parseInt(e.clientX-$(this).offset().left)%20+20);
        }
    });
    $('.setRate .stars_none').live('click',function(e){
        if($(this).parents(".setRate").attr('active')=='1'){
            var rate = parseInt(e.clientX-$(this).offset().left)-parseInt(e.clientX-$(this).offset().left)%20+20;
            var id = $(this).find('.stars_all').attr('bookId');
            $.ajax({
                url:setRate,
                data:{
                    id:id,
                    rate:rate
                },
                success:function(data){
                    if(data!=''){
                        $('.stars_all').attr('rate',data);
                        $('.stars_all').attr('realrate',data);
                        $('.rate_button').html($('.rate_button').attr('thanks'));
                        $(".setRate").attr('active',0);
                    }
                }
            })
        }
    });
    $('.setRate .stars_none').live('mouseleave',function(e){
        $(this).find('.stars_all').attr('rate',$(this).find('.stars_all').attr('realrate'));
    });
    $('.showHide').live('click',function(){
       var $container=$(this).parents(".containerShort");
        if($container.hasClass('full')){
            $container.removeClass('full');
       }else{
            $container.addClass('full');
        }
        var name=$(this).attr('other');
        $(this).attr('other',$(this).html());
        $(this).html(name);

    });
    if(parseInt($('.book_description').css('max-height'))==($('.book_description').height()+10)){
        $('.descriptionContainer').find('.description_change').show();
    };
    $('#answer').live('click',function(){
        var $newComToCom;
        $newComToCom= $(this).parents('.commentContainer').find('.newCommentToComment');
        if(!$newComToCom.is(':visible')){
                $newComToCom.slideDown(300);
            $(document).scrollTop($newComToCom.offset().top+$newComToCom.height());
        }else{
             $newComToCom.slideUp(300);

        }
    });
    $('.comment .plsMnsBtn').live('click',function(){
       var buttons=$(this).parents('.commentBtns');
       var val=$(this).hasClass('plusBtn')?1:-1;
       var comment_id=buttons.attr('comment_id');
        $.ajax({

            url:setCommentLike,
            data:{
                val:val,
                comment_id:comment_id
            },
            success:function(data){
                var result = JSON.parse(data);
                buttons.find('.minuses').html(result['dislike']);
                buttons.find('.pluses').html(result['like']);
                var comment = buttons.parents('.comment').removeClass('commentTrue').removeClass('commentFalse');
                buttons.removeClass('user_plus').removeClass('user_minus');
                if(result['status']==1){
                    buttons.addClass('user_plus');
                }
                if(result['status']==-1){
                    buttons.addClass('user_minus');
                }
                if(result['like']-result['dislike']>=0){
                   comment.addClass('commentTrue');
                }else{
                    comment.addClass('commentFalse');
                }
            }
        })
    });
    $('.commentToComment .plsMnsBtn').live('click',function(){
       var buttons=$(this).parents('.commentBtns');
       var val=$(this).hasClass('plusBtn')?1:-1;
       var comment_id=buttons.attr('comment_id');
        $.ajax({
            url:setCommentToCommentLike,
            data:{
                val:val,
                comment_id:comment_id
            },
            success:function(data){
                var result = JSON.parse(data);
                buttons.find('.minuses').html(result['dislike']);
                buttons.find('.pluses').html(result['like']);
                var comment = buttons.parents('.commentToComment').removeClass('commentTrue').removeClass('commentFalse');
                buttons.removeClass('user_plus').removeClass('user_minus');
                if(result['status']==1){
                    buttons.addClass('user_plus');
                }
                if(result['status']==-1) {
                    buttons.addClass('user_minus');
                }
                if(result['like']-result['dislike']>=0){
                   comment.addClass('commentTrue');
                }else{
                    comment.addClass('commentFalse');
                }
            }
        })
    });
    $('textarea').live('click',function(e){
        if(e.timeStamp==0){
            $(this).parents('.createCommentComment').find('.sendComment').click();
        }

    })
    $('.justComment').live('click',function(){
       var id = $(this).attr('bookId');
       var comment =$(this).parents('.newComment').find('textarea').val();
        $(this).parents('.newComment').find('textarea').val('');
        $.ajax({
            type:"POST",
            url:createComment,
            data:{
                id:id,
                comment:comment
            },
            success:function(data){

                $('.allComments').html(data+$('.allComments').html());
                setShortComment();
                setXhediotors(data);

            }
        })
    });
    function setXhediotors(data){
    $(data).find('textarea').each(function(){
        var xheditor_id=$(this).attr('id');
        $('#'+xheditor_id).xheditor({
            language:'ru',
            name:'doComment',
            height:'100px',
            skin:'o2007silver',
            width:'700px',
            tools:'Fontface,FontSize,Bold,Italic,Underline,Strikethrough,FontColor,BackColor,Emot,Removeformat', // mini, simple, fill or from XHeditor::$_tools

        });
    });
    }
    $('.justCommentToComment').live('click',function(){
       var $_this =$(this);
       var comment_id = $(this).attr('commentID');
       var comment =$(this).parents('.newCommentToComment').find('textarea').val();
        $(this).parents('.newCommentToComment').find('textarea').val('')
        $.ajax({
            type:"POST",
            url:createCommentToComment,
            data:{
                comment_id:comment_id,
                comment:comment
            },
            success:function(data){
                $_this.parents('.commentContainer').find('.commentToCommentContainer div').eq(0).append(data);
                setShortComment();
            }
        })
    });
    var stopFlag=true;
    $(document).scroll(function(){
        $('.commentToCommentContainer').each(function(){
           if(!$(this).hasClass('moreComments')&&$(this).find('.commentToComment').length>0){
               if((($(this).offset().top+$(this).height())>($(document).scrollTop()+$(window).height()))&&($(this).find('.commentToComment').eq(0).offset().top)<($(document).scrollTop()+$(window).height())){
                   $(this).find('.arrow_comment').addClass('arrow_comment_fixed')
               }else{
                   $(this).find('.arrow_comment').removeClass('arrow_comment_fixed')
               }
           }else(   $(this).find('.arrow_comment').removeClass('arrow_comment_fixed'))
        });
        if(stopFlag&&($(document).scrollTop()+$(window).height())>$(document).height()-50){
           stopFlag=false;
            var scroll=$(document).scrollTop();
            book_id=$('#search_simular_button').attr('bookId');
            $.ajax({
                url:loadComments,
                data:{
                   book_id:book_id,
                    offset:offset
                },
                success:function(data){
                    if(data!=''){
                        stopFlag=true;
                        offset+=10;

                        $(".allComments").append(data);
                        $('.commentContainer').each(function(){
                            minimizeMaximize($(this));
                        });
                        setXhediotors(data);
                        setShortComment();
                        $(document).scrollTop(scroll);
                    }
                }
            })
        }
    })
});