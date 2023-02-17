$(document).ready(function(){
	$.ajax({
		type: "GET",
		url: "./home.html",
		success: function(result){
			$(".main").html(result);
		}
	});
	
	$("a").click(function(){
		$.ajax({
		type: "GET",
		url: $(this).attr("href"),
		success: function(result){
			$(".main").html(result);
		}
		});
		return false;
	});
	
});