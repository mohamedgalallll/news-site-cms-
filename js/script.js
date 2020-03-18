$(document).ready( function() {
    $('#myCarousel').carousel({
		interval:   4000
	});
	
	var clickEvent = false;
	$('#myCarousel').on('click', '.sliddd a', function() {
			clickEvent = true;
			$('.sliddd li').removeClass('active');
			$(this).parent().addClass('active');		
	}).on('slid.bs.carousel', function(e) {
		if(!clickEvent) {
			var count = $('.sliddd').children().length -1;
			var current = $('.sliddd li.active');
			current.removeClass('active').next().addClass('active');
			var id = parseInt(current.data('slide-to'));
			if(count == id) {
				$('.sliddd li').first().addClass('active');	
			}
		}
		clickEvent = false;
	});
	$(function () {
		$("#registor").ajaxForm({
			beforeSend: function (){
				$("#result").html("<img src='images/5.gif'>");
			},
			success:function (r) {
				$("#result").html(r)
			}
		});
		return false;
	});
	$(function () {
		$("#login").ajaxForm({
			beforeSend: function () {
				$("#login_result").html("<img src='images/5.gif'width='30px'>");
			},
			success: function (r) {
				$("#login_result").html(r)
			}
		});
		return false;
	});
});