$(document).ready(function() {
	
	// Nivo slider
	$('#slideshow').nivoSlider({
		effect: 'random',
		slices: 1,
		animSpeed: 500,
		pauseTime: 5000,
		directionNav: true, //Next & Prev
		directionNavHide: true, //Only show on hover
		controlNav: true, //1,2,3...
		keyboardNav: true, //Use left & right arrows
		captionOpacity: 1, //Universal caption opacity
		pauseOnHover: true //Stop animation while hovering
	});
    $(".nivoSlider").show();

    $(".nivo-nextNav").ready().click();
    $(".nivo-prevNav").ready().click();
	$("#enter").live("click",function(e){
		e.preventDefault();
		if($("#registrations").is(":visible")){
			$("#registrations").slideUp(300);
		}else{
			$("#registrations").slideDown(300);
		}
		
	});
    $("body").live("click",function(e){
        if(!e.target.closest("#enter")&&!e.target.closest("#registrations")){
            $("#registrations").slideUp(300);
        }
    });
    $(document).ready(function(){
        if($(document).scrollTop()>0){
            if(!$(".header_main").hasClass("header_main_fixed")){
                $(".header_main").addClass("header_main_fixed")
                $("#registrations").addClass("registrations_fixed")
            }
        }else{
            $(".header_main").removeClass("header_main_fixed")
            $("#registrations").removeClass("registrations_fixed")
        }
    });

    $(document).scroll(function(){
        if($(document).scrollTop()>0){
            if(!$(".header_main").hasClass("header_main_fixed")){
                $(".header_main").addClass("header_main_fixed")
                $("#registrations").addClass("registrations_fixed")
            }
        }else{
            $(".header_main").removeClass("header_main_fixed")
            $("#registrations").removeClass("registrations_fixed")
        }
    })
	$('#slideshow').find('.nivo-slice:first').addClass('roundleft');
	$('#slideshow').find('.nivo-slice:last').addClass('roundright');
	
	
	// Fancy modals
	$("a.fancybox, #portfolio .project_small a").fancybox({
		'overlayOpacity' : 0.5,
		'overlayColor' : '#000'
	});


	// Pagetitle search bar
	$('.pagetitle form input.text').click(function() { $(this).attr('value', ''); });
	
	
	// PNG fix
	if(jQuery.browser.version.substr(0,1) < 7) {
		DD_belatedPNG.fix('#header h1, #holder, #content blockquote, #content form input.text, #content form textarea, .blogpost .cmntshead .rss, #services ul li h3, .project_small, #logos li img, #footer .left a, .nivo-controlNav, .nivo-controlNav a, .nivo-directionNav a');
	}
	
});