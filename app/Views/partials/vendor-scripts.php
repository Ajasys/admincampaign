<!-- Sweet Alerts js -->

<script src="https://rudrram.com/assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://rudrram.com/assets/js/pages/sweet-alerts.init.js"></script>
<script src="https://rudrram.com/assets/js/jquery.dataTables.min.js"></script>
<script src="https://rudrram.com/assets/js/dataTables.bootstrap5.min.js"></script>
<script src="https://rudrram.com/assets/js/bootstrap-select.min.js"></script>
<!-- <script src="https://rudrram.com/assets/js/countrystatecity.js?v2"></script> -->
<script src="https://rudrram.com/assets/js/iziToast.js"></script>
<script src="https://rudrram.com/assets/js/sidebar.js"></script>
<!-- <script src="https://rudrram.com/assets/js/ckeditor.js"></script>    -->
<script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script type="text/javascript" src="https://rudrram.com/assets/datetimepicker/js/materialDateTimePicker.js"></script>
<!-- celender -->
<script src="https://rudrram.com/assets/js/fullcalendar.min.js"></script>


<script>
    var current = $(location).attr('href');
    var ddd = "http://localhost/rudram/index";
    if (current !== ddd) {
        $('.sticky_notes_submit').on('click', function (e) {
            event.preventDefault();
            var note = $('#form_stickynotes').val();
            // console.log(note);
            if (note != "") {
                $.ajax({
                    method: "post",
                    url: "<?= site_url('insert_data'); ?>",
                    data: {
                        note: note,
                        table: "notes",
                        action: "insert",
                    },
                    success: function (res) {
                        // console.log(res);
                        if (res != "error") {
                            // list_data();
                            iziToast.success({
                                title: 'Added Successfully'
                            });
                            $("form[name='sticky_notes_hed']").removeClass("was-validated");
                            $("form[name='sticky_notes_hed']")[0].reset();
                            $(".close_btn").trigger("click");
                        } else {
                            $('.loader').hide();
                            iziToast.error({
                                title: 'Duplicate data'
                            });
                        }
                    }
                });
            } else {
                $("form[name='sticky_notes_hed']").addClass("was-validated")
            }
            $("form[name='sticky_notes_hed']")[0].reset();
            // list_data();
        });
        // alert("same");
    } else {
        // alert();
    }


    
    //  let editor_add;
    // ClassicEditor
    // ClassicEditor.create(document.querySelector('#editor_add'), {
    //     toolbar: {
    //         items: [
    //             'undo',
    //             'redo',
    //             '|',
    //             'heading',
    //             '|',
    //             'bold',
    //             'italic',
    //             '|',
    //             'bulletedList',
    //             'numberedList',
    //             '|',
    //             'insertTable',
    //             'Blockquote',
    //             'outdent',
    //             'indent'
    //         ],
    //         shouldNotGroupWhenFull: false
    //     },
    //     language: 'en'
    // })
    //     .then(instance => {
    //         editor_add = instance;
    //     })
    //     .catch(error => { });

    // global search 

    $(document).ready(function () {

        $('#global_search_input').on('keyup', function (e) {

            var search_text = $(this).val();

            if (e.which == 13) {

                $.ajax({

                    url: '<?= site_url('global_search') ?>',

                    type: "POST",

                    data: { search: search_text },

                    success: function (data) {

                        window.location.href = 'allinquiry?mobileno=' + data;

                    }

                });

            }

        });



        $(".main-theme-small-box").click(function () {

            $(".main-theme-box").fadeToggle();

        });



        $(".filter-btn").click(function(){

            $(".offcanvas-backdrop").addClass("d-none");

        });

        



    });

</script>

<script>



    

    $(document).ready(function () {



        $('body').on('click','.search_bar', function(){

            $('.search-box').toggleClass('d-block');

            $('.search-box').toggleClass('d-none');

        });



        // function  remider_inq_data(){



        //     $.ajax({

        //         method: "post",

        //         url: "<?= base_url('Inquriry_time_come');?>",

        //         success: function(res) {

        //         //console.log(res);

        //             if(res != ""){

                        

                    

        //             var response = JSON.parse(res);

        //             //console.log(response);

        //                 $(".dataaaa").trigger('click');

        //                 $(".data_html_notification").html(response.html);

        //                 $(".inqq_cunt").html(response.count_row);

        //                 if(response.htmlssssss != ''){

        //                     Notification.requestPermission().then(function (permission) {

        //                         if (permission === 'granted') {

        //                         var notification = new Notification('Inq :'+response.htmlssssss.inq_id+' 5 Minute left from inquiry '+response.htmlssssss.inq_type);

        //                         }

        //                     });

        //                 } 

        //             }

                        

        //         }

        //     });

        //     return false;



        // }






    

          $('body').on('click', '.remider', function () {



           

            remider_inq_data();

          }  );



        

        remider_inq_data();

            setInterval(function () {



                remider_inq_data();



            }, 60000);



       // if ($("#filter-showw").html() == "") {

            if ($(".filter-show").html() == "") {

            // alert();

            $('#clear').hide();

        }

        $('#clear').hide();



        var fileter = true;

        $(".filter_data input").change(function () {

            $('#clear').show();

            var selectedid = $(this).attr("id");

            if ($("." + selectedid).length > 0) {

                fileter = false;

            } else {

                fileter = true;

            }

            var selectedOption1 = $(this).val();

            //var selectedOption1s = $(this).text();

            if (fileter == true) {

                $("#filter-showw").append('<p class="bg-pink ' + selectedid + '" data-id="' + selectedid + '" style="padding: 4px 8px; margin: 0px 4px;">\u2716 ' + selectedOption1 + '</p>');

            } else {

                $("#filter-showw ." + selectedid).text('\u2716 ' + selectedOption1);

            }

        });



        $(".filter_data select").change(function () {

            $('#clear').show();

            var selectedid = $(this).attr("id");

            if ($("." + selectedid).length > 0) {

                fileter = false;

            } else {

                fileter = true;

            }

            var selectedOption1 = $(this).val();

            var selectedOption1s = $(this).find('option:selected').text();

            if (fileter == true) {

                $("#filter-showw").append('<p class="bg-pink ' + selectedid + '" data-id="' + selectedid + '" style="padding: 4px 8px; margin: 0px 4px;">\u2716 ' + selectedOption1s + '</p>');

            } else {

                $("#filter-showw ." + selectedid).text('\u2716 ' + selectedOption1s);

            }

        });



        $('body').on('click', '#filter-showw p', function () {

            var selectedid = $(this).attr("data-id");

            $("#" + selectedid).val("");

            $(this).remove();

            // $(this).text("").css("padding", "0px 0px").css("margin" , "0px 0px");

            $('.selectpicker').selectpicker('refresh');

            if($(".filter-show").html() == ""){

            // alert();

            $('#clear').hide();

        }

        });



        $("#clear").click(function () {

            $(".filter-show").html("");

            $('#clear').hide();

            $('.filter_data input').val("");

            $('.filter_data select').val("");

            $('.selectpicker').selectpicker('refresh');

            return false;

        });

        $('[data-tbs-toggle="tooltip"]').click(function(){$(this).tooltip('hide')});

        $('[data-tbs-toggle="tooltip"]').hover(function(){$(this).tooltip('show')});

    });

    function timeValidation(datetime,tag){

        // console.log(datetime);

        if(datetime != undefined){

            var hour = datetime.split(" ");

        }else {

            return 1;

        }



        var time = hour[1];

        var ampm = hour[2];



        if(ampm == "AM"){

            time = time.split(':');

            // console.log(time);

            if(time[0] <= 12 && time[0] >= 8){

                $(tag).closest('div').find('.date_valid_msg').html('<span style="color : green; ">time set successfull</span>');

                return 1;

            }else{

                $(tag).closest('div').find('.date_valid_msg').html('<span style="color : red; ">select time between 8 AM to 8 PM</span>');

                return 0;

            }

        }

        if(ampm == "PM"){

            time = time.split(':');

            // console.log(time);

            if(time[0] >= 1 && time[0] < 8 || time[0] == 12){

                $(tag).closest('div').find('.date_valid_msg').html('<span style="color : green; ">time set successfull</span>');

                return 1;

            }else{

                $(tag).closest('div').find('.date_valid_msg').html('<span style="color : red; ">select time between 8 AM to 8 PM</span>');

                return 0;

            }

        }

    }

</script>



</body>

</html>