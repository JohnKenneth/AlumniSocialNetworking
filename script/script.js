
$(document).ready(function(){

	$(".toggle").click(function(){
		var $target = $('.toggleDiv'),
			$toggle = $(this);

		$target.slideToggle( 500, function () {
			$toggle.text(($target.is(':visible') ? 'Hide' : 'Show') + ' My Bag');
		});
	});

});