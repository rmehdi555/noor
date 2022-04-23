<!-- JS Part Start-->
<script>
    var add_more_file_name=__('web/public.add_more_file_name');
    var add_more_file_file=__('web/public.add_more_file_file');
</script>
<script src="{{asset('web/2020/assets/plg/bootstrap-4.3.1/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('web/2020/assets/plg/Bootstrap-Offcanvas-master/js/bootstrap.offcanvas.min.js')}}"></script>
<script src="{{asset('web/2020/assets/plg/easing/js/jquery.easing.min.js')}}"></script>
<script src="{{asset('web/2020/assets/plg/OwlCarousel2-2.3.4/js/owl.carousel.min.js')}}"></script>

<script src="{{asset('admin/2020/rtl/assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('admin/2020/assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin/2020/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/2020/assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('admin/2020/assets/vendor/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('admin/2020/assets/vendor/jquery-datatable/buttons/buttons.print.min.js')}}"></script>

<script src="{{asset('admin/2020/rtl/assets/js/pages/tables/jquery-datatable.js')}}"></script>

<script src="{{asset('web/2020/assets/js/custom-v-4.js')}}"></script>

<!-- JS Part End-->
<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

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


<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        w=window.open();
        w.document.write(printContents);
        w.print();
        w.close();
    }

</script>


<script type="text/javascript">

function deleteFunction() {
    event.preventDefault(); // prevent form submit
    var form = event.target.form; // storing the form
    swal({
        title: "آیا از حذف مطمئن هستید؟",
        text: "درصورت تایید حذف دیگر دسترسی به آن نخواهید داشت.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "بله",
        cancelButtonText: "نه",
        closeOnConfirm: false,
        closeOnCancel: false
    })
        .then((isConfirm) => {
            if (isConfirm) {
                form.submit();          // submitting the form when user press yes
            } else {
                swal("انصراف", "شما از حذف کردن منصرف شدین ", "error");
            }
        });;
    }

function cancelFunction() {
    event.preventDefault(); // prevent form submit
    var form = event.target.form; // storing the form
    swal({
        title: "آیا از انصراف مطمئن هستید؟",
        text: "درصورت تایید انصراف دیگر دسترسی به آن نخواهید داشت.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "بله",
        cancelButtonText: "نه",
        closeOnConfirm: false,
        closeOnCancel: false
    })
        .then((isConfirm) => {
            if (isConfirm) {
                form.submit();          // submitting the form when user press yes
            } else {
                swal("انصراف", "شما منصرف شدین ", "error");
            }
        });;
}


</script>


<script type="text/javascript">

    $('.persian-datepicker').persianDatepicker({
        format: 'YYYY-MM-DD',
        timePicker: {
            enabled: false,
        },
    });

    $('.persian-datepicker-time').persianDatepicker({
        format: 'YYYY-MM-DD H:m:s',
        timePicker: {
            enabled: true,
        },
    });

    $('#start-exam-show').persianDatepicker({
        format: 'YYYY-MM-DD H:m:s',
        timePicker: {
            enabled: true,
        },
        altField: '#start-exam'
    });


    $('.only-timepicker').persianDatepicker({
        format: 'H:m:s',
        onlyTimePicker: true
    });
    
    
    $(document).ready(function() {

        $(document).on("keyup", ".exam-mark", function() {
           examMarkSum();
        });
        $(document).on("keyup", "#exam-a-mark", function() {
            examMarkSum();
        });

        function examMarkSum() {
            var sum = 0;
            $(".exam-mark").each(function(){
                sum += +$(this).val();
            });
            //alert(sum);
            $("#exam-t-mark").val(sum);
            sum += +$("#exam-a-mark").val();
            $("#exam-all-mark").val(sum);

        }

    });

</script>



<!-- JS Part End--
</body>
</html>