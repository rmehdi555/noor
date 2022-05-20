
<!-- Javascript -->
<script src="{{asset('admin/2020/rtl/assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('admin/2020/rtl/assets/bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{asset('admin/2020/rtl/assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('admin/2020/assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin/2020/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/2020/assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('admin/2020/assets/vendor/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('admin/2020/assets/vendor/jquery-datatable/buttons/buttons.print.min.js')}}"></script>

<script src="{{asset('admin/2020/assets/vendor/sweetalert/sweetalert.min.js')}}"></script> <!-- SweetAlert Plugin Js -->


<script src="{{asset('admin/2020/rtl/assets/bundles/mainscripts.bundle.js')}}"></script>
<script src="{{asset('admin/2020/rtl/assets/js/pages/tables/jquery-datatable.js')}}"></script>





<script src="{{asset('admin/2020/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>
<script src="{{asset('admin/2020/assets/vendor/parsleyjs/js/parsley.min.js')}}"></script>


<script src="{{asset('admin/2020/assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script> <!-- Bootstrap Colorpicker Js -->
<script src="{{asset('admin/2020/assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script> <!-- Input Mask Plugin Js -->
<script src="{{asset('admin/2020/assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js')}}"></script>
<script src="{{asset('admin/2020/assets/vendor/multi-select/js/jquery.multi-select.js')}}"></script> <!-- Multi Select Plugin Js -->

<script src="{{asset('admin/2020/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('admin/2020/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script> <!-- Bootstrap Tags Input Plugin Js -->
<script src="{{asset('admin/2020/assets/vendor/nouislider/nouislider.js')}}"></script> <!-- noUISlider Plugin Js -->

<script src="{{asset('admin/2020/rtl/assets/js/pages/forms/advanced-form-elements.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@yield('script')

<script src="{{asset('ckeditor/ckeditor.js')}}"></script>

<script type="text/javascript">
    $(function(){
        $('.ckeditor1').each(function(e){
            CKEDITOR.replace( this.id, {
                // Use named CKFinder browser route
                filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
                // Use named CKFinder connector route
                filebrowserUploadUrl: '{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files',
                filebrowserWindowWidth: '1000',
                filebrowserWindowHeight: '700',
            });

        });
        var editor = CKEDITOR.replace( 'ckfinder' );
        CKFinder.setupCKEditor( editor );
    });



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
    },
    function(isConfirm){
        if (isConfirm) {
            form.submit();          // submitting the form when user press yes
        } else {
         swal("انصراف", "شما از حذف کردن منصرف شدین ", "error");
        }
    });
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
            },
            function(isConfirm){
                if (isConfirm) {
                    form.submit();          // submitting the form when user press yes
                } else {
                    swal("انصراف", "شما منصرف شدین ", "error");
                }
            });
    }


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


    $(document).ready(function() {

        $(document).on("keyup", "#a_price", function() {
            workHoursSum();
        });
        $(document).on("keyup", "#k_price", function() {
            workHoursSum();
        });
        $(document).on("keyup", "#price_hours", function() {
            workHoursSum();
        });
        $(document).on("keyup", "#hours", function() {
            workHoursSum();
        });

        function workHoursSum() {
            var sum = 0;
            sum = $("#hours").val()*$("#price_hours").val();
            sum +=$("#a_price").val()-$("#k_price").val();
            $("#totalSum").val(Math.ceil(sum));

        }

    });

</script>


<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
<script>
    $(function() {
        // validation needs name of the element
        $('#food').multiselect();

        // initialize after multiselect
        $('#basic-form').parsley();



        /*married-yes or no select field */

        var test=$("input[name$='married']").val();
        $(".div-married").hide();
        $(".div-married-" + test).show();

        $(".input-married").prop('required',false);
        $(".input-married-"+ test).prop('required',true);

        $("input[name$='married']").click(function () {
            var test = $(this).val();

            $(".div-married").hide();
            $(".div-married-" + test).show();

            $(".input-married").prop('required',false);
            $(".input-married-"+ test).prop('required',true);
        });



        /*select city and province */

        //$(".option-city").hide();
        //$("#select-city").val(0);
        // var id = $("#select-province").val();
        // $(".option-city-" + id).show();
        $("#select-province").change(function () {
            $(".option-city").hide();
            $("#select-city").val(0);
            var id = $(this).val();
            $(".option-city-" + id).show();
        });



        $(document).ready(function(){
            $(".contract-button").hide();

            $('#contract-checkbox').click(function() {
                $(".contract-button").toggle(this.checked);
                $(".contract-div-hide").toggle(!this.checked);
            });


        });
    });


    /*student select field */
    $(".option-field-child").hide();
    $("#select-field-child").val(0);
    var id = $("#select-field-main").val();
    $(".option-field-child-" + id).show();
    $("#select-field-main").change(function () {
        $(".option-field-child").hide();
        $("#select-field-child").val(0);
        var id = $(this).val();
        $(".option-field-child-" + id).show();
    });
</script>
<script src="{{asset('persian-date/persian-date.js')}}"></script>
<script src="{{asset('persian-date/persian-datepicker.js')}}"></script>
<script type="text/javascript">


    $(document).ready(function() {
        var type = $("#question-type-select").val();
        if(type=="test")
        {
            $(".question-type-test-div").show();
            $(".question-type-adj-div").hide();
            $(".question-type-test-q-div").hide();
            $(".question-type-test-q-div-4").show();
        }else{
            $(".question-type-test-div").hide();
            $(".question-type-adj-div").show();
            $(".question-type-test-q-div").hide();
        }
        $("#question-type-select").change(function () {
            var type = $(this).val();
            if(type=="test")
            {
                $(".question-type-test-div").show();
                $(".question-type-adj-div").hide();
                $(".question-type-test-q-div").hide();
                $(".question-type-test-q-div-4").show();
            }else{
                $(".question-type-test-div").hide();
                $(".question-type-adj-div").show();
                $(".question-type-test-q-div").hide();
            }

        });
    });
    var id = $("#type-adj-number-select").val();
    $(".question-type-test-q-div").hide();
    $(".question-type-test-q-div-"+id).show();

    $("#type-adj-number-select").change(function () {
        var id = $(this).val();
        $(".question-type-test-q-div").hide();
        $(".question-type-test-q-div-"+id).show();
    });


    $('.persian-datepicker-time').persianDatepicker({
        format: 'YYYY-MM-DD H:m:s',
        timePicker: {
            enabled: true,
        },
    });

    $('.persian-datepicker').persianDatepicker({
        format: 'YYYY-MM-DD',
        timePicker: {
            enabled: false,
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



</script>









</body>
</html>