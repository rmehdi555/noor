
jQuery(function($){


/*---------------------------------------------------------------------------------*/
/*  News Single - Like
/*---------------------------------------------------------------------------------*/
$('.bu-inner-ns-like').click(function(e) {
	e.preventDefault();
	$(this).addClass('liked');
});

/*---------------------------------------------------------------------------------*/
/*  Single Event
/*---------------------------------------------------------------------------------*/
$('.bu-event-slider').owlCarousel({
	loop:false,
	margin:0,
	nav:true,
	dots: false,
	rtl:true,
	items: 1,
	autoplay:false
})
/*---------------------------------------------------------------------------------*/
/*  Banner
/*---------------------------------------------------------------------------------*/
$('.main-banner-slider').owlCarousel({
	loop:true,
	margin:0,
	nav:true,
	rtl:true,
	items: 1,
	autoplay:true
})
/*---------------------------------------------------------------------------------*/
/*  Search
/*---------------------------------------------------------------------------------*/
$('#main-search-btn').click(function(e){
	$('#main-search-box').fadeToggle(300, 'easeOutExpo');
});
$('#main-search-close').click(function(e){
	$('#main-search-box').fadeToggle(300, 'easeOutExpo');
});

/*---------------------------------------------------------------------------------*/
/*  Navbar
/*---------------------------------------------------------------------------------*/
$('.navbar-toggler').click(function(e){
	$('.navbar-toggler').addClass('active');
	if ( $('.navbar-offcanvas').hasClass('in') ) {
		$('.navbar-toggler').addClass('active');
		$('.bu-overlay').addClass('active');  
	} else {
		$('.navbar-toggler').removeClass('active');
		$('.bu-overlay').removeClass('active');
	}
	e.stopPropagation()
});

$(document).on('click', function(e) {
	if ($(e.target).is('.navbar-offcanvas, .bu-menu-list li a') === false) {
		$('.navbar-toggler').removeClass('active');
		$('.bu-overlay').removeClass('active');
	}
});

$( window ).resize(function() {
	if ($(window).width() < 992) {
		$('.bu-overlay').removeClass('active');  
	}
});



    $(".option-field-child").hide();
    $("#select-field-child").val(0);
    var id=$("#select-field-main").val();
    $(".option-field-child-"+id).show();
$("#select-field-main").change(function () {
	$(".option-field-child").hide();
	$("#select-field-child").val(0);
	var id=$(this).val();
	$(".option-field-child-"+id).show();
})



});