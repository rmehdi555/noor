
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

<script>
    $(function() {
        // validation needs name of the element
        $('#food').multiselect();

        // initialize after multiselect
        $('#basic-form').parsley();
    });
</script>
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
</script>
@yield('script')
</body>
</html>