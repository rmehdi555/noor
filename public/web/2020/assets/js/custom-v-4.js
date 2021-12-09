jQuery(function ($) {



    /*---------------------------------------------------------------------------------*/
    /*  News Single - Like
    /*---------------------------------------------------------------------------------*/
    $('.bu-inner-ns-like').click(function (e) {
        e.preventDefault();
        $(this).addClass('liked');
    });

    /*---------------------------------------------------------------------------------*/
    /*  Single Event
    /*---------------------------------------------------------------------------------*/
    $('.bu-event-slider').owlCarousel({
        loop: false,
        margin: 0,
        nav: true,
        dots: false,
        rtl: true,
        items: 1,
        autoplay: false
    })
    /*---------------------------------------------------------------------------------*/
    /*  Banner
    /*---------------------------------------------------------------------------------*/
    $('.main-banner-slider').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        rtl: true,
        items: 1,
        autoplay: true
    })
    /*---------------------------------------------------------------------------------*/
    /*  Search
    /*---------------------------------------------------------------------------------*/
    $('#main-search-btn').click(function (e) {
        $('#main-search-box').fadeToggle(300, 'easeOutExpo');
    });
    $('#main-search-close').click(function (e) {
        $('#main-search-box').fadeToggle(300, 'easeOutExpo');
    });

    /*---------------------------------------------------------------------------------*/
    /*  Navbar
    /*---------------------------------------------------------------------------------*/
    $('.navbar-toggler').click(function (e) {
        $('.navbar-toggler').addClass('active');
        if ($('.navbar-offcanvas').hasClass('in')) {
            $('.navbar-toggler').addClass('active');
            $('.bu-overlay').addClass('active');
        } else {
            $('.navbar-toggler').removeClass('active');
            $('.bu-overlay').removeClass('active');
        }
        e.stopPropagation()
    });

    $(document).on('click', function (e) {
        if ($(e.target).is('.navbar-offcanvas, .bu-menu-list li a') === false) {
            $('.navbar-toggler').removeClass('active');
            $('.bu-overlay').removeClass('active');
        }
    });

    $(window).resize(function () {
        if ($(window).width() < 992) {
            $('.bu-overlay').removeClass('active');
        }
    });


    $("#button-level-1-save").click(function () {
        $("#form-level-1-save").submit();
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





    /*select noor */


    $("#select-type-noor").val(1);
    $(".div-type-noor-1").show();
    $(".div-type-noor-all").hide();
    $(".div-type-noor-5").hide();
    $(".input-type-noor-1").prop('required',true);
    $(".input-type-noor-all").prop('required',false);
    // var id = $("#select-province").val();
    // $(".option-city-" + id).show();
    $("#select-type-noor").change(function () {
        var id = $(this).val();
        if(id==1)
        {
            $(".div-type-noor-1").show();
            $(".div-type-noor-all").hide();
            $(".input-type-noor-1").prop('required',true);
            $(".input-type-noor-all").prop('required',false);
        }else{
            $(".div-type-noor-1").hide();
            $(".div-type-noor-all").show();
            $(".input-type-noor-1").prop('required',false);
            $(".input-type-noor-all").prop('required',true);
        }
        if(id==5)
        {
            $(".div-type-noor-5").show();
        }else{
            $(".div-type-noor-5").hide();
        }
    });




    /* add more upload file */
    $('#btn-add-more-upload-file').click(function(e){
        $("#div-add-more-upload-file").before(" <div class=\"row\">\n" +
            "                                    <div class=\"col-md-6 padding-top-15\">\n" +
            "                                        <label class=\"col-md-6 col-sm-6 control-label\" for=\"tel\">عنوان مدرک را وارد نمایید :\n" +
            "                                        </label>\n" +
            "                                        <div class=\"col-md-12 col-sm-10\">\n" +
            "                                            <input type=\"text\" name=\"file_more_name[]\"  class=\"form-control \"/>\n" +
            "                                        </div>\n" +
            "                                    </div>\n" +
            "                                    <div class=\"col-md-6 padding-top-15\">\n" +
            "                                        <label class=\"col-md-9 col-sm-9 control-label\"\n" +
            "                                               for=\"p_image\">فایل مدرک را انتخاب نمایید: </label>\n" +
            "                                        <div class=\"col-md-12 col-sm-10\">\n" +
            "                                            <div class=\"custom-file \">\n" +
            "                                                <input type=\"file\" class=\"custom-file-input\" id=\"customFile\"\n" +
            "                                                       name=\"file_more[]\">\n" +
            "                                                <label class=\"custom-file-label text-align-left\"\n" +
            "                                                       for=\"customFile\"></label>\n" +
            "                                            </div>\n" +
            "                                        </div>\n" +
            "\n" +
            "                                    </div>\n" +
            "                                </div>");


        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });



    $("#select-deposits-type").change(function () {
        var id = $(this).val();
        var type = $("#d-t-type-value-"+id).val();
        var title=$("#d-t-title-value-"+id).val();
        var price=$("#d-t-price-value-"+id).val();

        if(type=="amount")
        {
            $("#price").val(price);
            $("#title").val(title);
            $("#price").prop('disabled',true);
            $("#title").prop('disabled',true);
            $("#price").prop('required',false);
            $("#title").prop('required',false);
        }else{
            $("#price").val('');
            $("#title").val('');
            $("#price").prop('disabled',false);
            $("#title").prop('disabled',false);
            $("#title").prop('required',true);
            $("#price").prop('required',true);
        }

    });


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

    var id = $("#type-adj-number-select").val();
    $(".question-type-test-q-div").hide();
    $(".question-type-test-q-div-"+id).show();

    $("#type-adj-number-select").change(function () {
        var id = $(this).val();
        $(".question-type-test-q-div").hide();
        $(".question-type-test-q-div-"+id).show();
    });






});