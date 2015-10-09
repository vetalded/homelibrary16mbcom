function readURLMy(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var no = $(input).attr('no');
            //$("#"+$(input).attr('id')).closest('div').next().find('img').attr('src', e.target.result);
            $(".upload_img[no="+no+"]").find('img').attr('src', e.target.result);

            if($(".new_lot_img").length>0 && no==1){
                $(".new_lot_img").attr('src', e.target.result);
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("input[type=file]").live("change",function(){
    readURLMy(this);
});

$(".upload_img img").live("click", function(evt){
    var no = $(this).parent(".upload_img").attr("no");
    $(".click_file[no="+no+"]").click();
});

$(".delete_img").live("click",function(){
    $(this).parent(".upload_img").find(".flag_delete_img").val("1");
    $(this).parent(".upload_img").find("img").attr("src", "../../../images/no_image.png");
});
