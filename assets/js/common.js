$(document).ready(function(){
	$('.toggle-menu-btn').each(function(){
		$(this).append('<span class="hide-span"><i class="fa fa-angle-left" aria-hidden="true"></i> Yan menüyü gizle</span>\
				<span class="show-span hidden"><i class="fa fa-angle-right" aria-hidden="true"></i> Yan menüyü göster</span>');
	});

	$('.toggle-menu-btn').click(function(){
		$('.left-side').toggleClass('hidden');
		$('.main-container').toggleClass('col-md-10').toggleClass('col-md-12');
		$('.toggle-menu-btn .hide-span').toggleClass('hidden');
		$('.toggle-menu-btn .show-span').toggleClass('hidden');
	});
});