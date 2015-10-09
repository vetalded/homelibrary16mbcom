$(document).ready(function(){
	$(".grid-view[row_click=1] tbody  td:not(.button-column,.empty)").live("click",
		function(){ 
		var loc = $(this).parent().find(".update").attr("href");
		window.location=loc;
	});
});

var highLight = function(id, color)
{
	$(id).find("input[type=text]").each(function()
	{
		var rowIndex = $(id).find("input[type=text]").index($(this));
		var line = $(id).find("tr.filters").find("td").eq(rowIndex+1).find("input").val();
		var line_low = typeof(line) != "undefined" ? line : "-1";
		line_low = line_low.toLowerCase();
		$(id).find("tr").not(":first").not(":first").each(function(){
			var text = $(this).find("td").not(".empty").eq(rowIndex+1).html();
			var re = new RegExp(line_low, "i");


			text = text.replace(re, "<b style=\"color:" + color + "\">" + line_low + "</b>");
			if (typeof(line) != "undefined"){
				$(this).find("td").eq(rowIndex+1).html(text);
			}
		});
	});
}