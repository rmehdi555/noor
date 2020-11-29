<!-- JS Part Start-->
<script src="{{asset('web/2020/assets/plg/bootstrap-4.3.1/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('web/2020/assets/plg/Bootstrap-Offcanvas-master/js/bootstrap.offcanvas.min.js')}}"></script>
<script src="{{asset('web/2020/assets/plg/easing/js/jquery.easing.min.js')}}"></script>
<script src="{{asset('web/2020/assets/plg/OwlCarousel2-2.3.4/js/owl.carousel.min.js')}}"></script>

<script src="{{asset('web/2020/assets/js/custom.js')}}"></script>

<!-- JS Part End-->




<script type="text/javascript">
// Elevate Zoom for Product Page image
$("#zoom_01").elevateZoom({
gallery:'gallery_01',
cursor: 'pointer',
galleryActiveClass: 'active',
imageCrossfade: true,
zoomWindowFadeIn: 500,
zoomWindowFadeOut: 500,
zoomWindowPosition : 11,
lensFadeIn: 500,
lensFadeOut: 500,
loadingIcon: 'image/progress.gif'
});
//////pass the images to swipebox
$("#zoom_01").bind("click", function(e) {
var ez =   $('#zoom_01').data('elevateZoom');
$.swipebox(ez.getGalleryList());
return false;
});
</script>
<!-- JS Part End--
</body>
</html>