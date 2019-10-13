
<footer style="background: <?php echo '#'. $this->db->get('cstyle')->row()->footercolor; ?>" class="site-footer">

    <div style="font-size: 22px; color: #000;" class="text-center">
            <?php echo 'Hospital Software Copyright @ Sound Health Hospital'?>
        <a href="<?php echo base_url() . '#'; ?>" class="go-top">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>

</footer>
<!--footer end-->
</section>




<!-- 

<script src="include/jsgrtn/jquery-3.4.1.min.js"></script>
<script src="include/jsgrtn/jquery.fireworks.js"></script>

<script type="text/javascript">
    $('.demo').fireworks({ 
  sound: true, // sound effect
  opacity: 0.2,
  width: '100%',
  height: '100%'
});
</script> -->

<!-- js placed at the end of the document so the pages load faster --> 
 




<script src="include/js/chat.js"></script>





<!--bootstrap core JS-->
<script src="include/bootstrap/js/bootstrap.min.js"></script>
<!--bootstrap core JS-->






<script src="include/js/jquery.scrollTo.min.js"></script>

<script src="include/js/moment.min.js"></script>







<script src="include/js/jquery.nicescroll.js" type="text/javascript"></script>

<script type="text/javascript" src="include/assets/DataTables/datatables.min.js"></script>


<script src="include/js/respond.min.js" ></script>





<!--bootstrap date & Time Picker JS-->
<script type="text/javascript" src="include/bootstrap/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="include/bootstrap/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="include/bootstrap/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="include/bootstrap/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<!--bootstrap date & Time Picker JS-->









<script type="text/javascript" src="include/assets/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="include/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>

<script src="include/js/jquery.cookie.js"></script>




<script type="text/javascript" src="include/assets/ckeditor/ckeditor.js"></script>
<!--
<script src="include/js/advanced-form-components.js"></script>
-->


<!--common script for all pages--> 
<script src="include/js/common-scripts.js"></script>
<script class="include" type="text/javascript" src="include/js/jquery.dcjqaccordion.2.7.js"></script>
<!--common script for all pages--> 





<!--script for this page only-->
<script src="include/js/editable-table.js"></script>
<script src="include/js/datepick.js"></script>
<!--script for this page only-->




<script src="include/assets/fullcalendar/fullcalendar.js"></script>


<!--
<script src='include/assets/fullcalendar/locale/en.js'></script>
-->



<!-- For Home Page -->
<script src="include/js/jquery.sparkline.js" type="text/javascript"></script>
<script src="include/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="include/js/owl.carousel.js" ></script>

<!--common script for all pages
<script src="include/js/common-scripts.js"></script>
-->
<!--script for this page-->
<script src="include/js/sparkline-chart.js"></script>
<!--
<script src="include/js/easy-pie-chart.js"></script>
-->
<script src="include/js/count.js"></script>

<script>

    //owl carousel

    $(document).ready(function () {
        $("#owl-demo").owlCarousel({
            navigation: true,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            autoPlay: true

        });
    });

</script>


<!-- For Home Page -->









<script>


    $(document).ready(function () {
        $('#editable-sample').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',



            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                'print'

            ],

            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: -1,

            "order": [[0, "desc"]],
            
            <?php if ($this->router->fetch_method() == 'sent') { ?>
        "order": [[ 0, "asc" ]],
<?php } ?>
<?php if ($this->router->fetch_method() == 'upcoming') { ?>
        "order": [[ 0, "asc" ]],
<?php } ?>

            "language": {
                "lengthMenu": "_MENU_ records per page",

            }





        });
    });

</script>




<script>
    $('.multi-select').multiSelect({
        selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder=' search...'>",
        selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder=''>",
        afterInit: function (ms) {
            var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
        },
        afterSelect: function () {
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function () {
            this.qs1.cache();
            this.qs2.cache();
        }
    });
</script>

<script>
    $('#my_multi_select3').multiSelect()
</script>

<script>
    $(' .default-date-picker, .dtpic').datepicker({
        format: 'dd-mm-yyyy',
        maxDate: 0,
    }).on('changeDate', function(ev){
       $(this).datepicker('hide');
    });
</script>


<script type="text/javascript">

    $(document).ready(function () {
        $('#calendar').fullCalendar({
            lang: 'en',
            events: 'appointment/getAppointmentByJason',
            header:
                    {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay',
                    },
            /*    timeFormat: {// for event elements
             'month': 'h:mm TT A {h:mm TT}', // default
             'week': 'h:mm TT A {h:mm TT}', // default
             'day': 'h:mm TT A {h:mm TT}'  // default
             },
             
             */
            timeFormat: 'h(:mm) A',
            eventRender: function (event, element) {
                element.find('.fc-time').html(element.find('.fc-time').text());
                element.find('.fc-title').html(element.find('.fc-title').text());

            },
            slotDuration: '00:5:00',
            businessHours: false,
            slotEventOverlap: false,
            editable: false,
            selectable: false,
            lazyFetching: true,
            minTime: "6:00:00",
            maxTime: "24:00:00",
            defaultView: 'month',
            allDayDefault: false,
            displayEventEnd: true,
            timezone: false,

        });
    });

</script>

<script>
    $(document).ready(function () {
        $('.timepicker-default').timepicker({defaultTime: 'value'});

    });
</script>

<script type="text/javascript" src="include/assets/select2/js/select2.min.js"></script>


<script type="text/javascript">

    $(document).ready(function () {

        $(".js-example-basic-single").select2();

        $(".js-example-basic-multiple").select2();
    });

</script>




<script type="text/javascript">

    $(document).ready(function () {
    var windowH = $(window).height();
    var wrapperH = $('#container').height();
    if (windowH > wrapperH) {
    $('#sidebar').css('height', (windowH) + 'px');
    } else {
    $('#sidebar').css('height', (wrapperH) + 'px');
    }
    var windowSize = window.innerWidth;
    if (windowSize < 768) {
    $('#sidebar').removeAttr('style');
    }
    });
    function onElementHeightChange(elm, callback) {
    var lastHeight = elm.clientHeight, newHeight;
    (function run() {
    newHeight = elm.clientHeight;
    if (lastHeight != newHeight)
            callback();
    lastHeight = newHeight;
    if (elm.onElementHeightChangeTimer)
            clearTimeout(elm.onElementHeightChangeTimer);
    elm.onElementHeightChangeTimer = setTimeout(run, 200);
    })();
    }


    onElementHeightChange(document.body, function () {
    var windowH = $(window).height();
    var wrapperH = $('#container').height();
    if (windowH > wrapperH) {
    $('#sidebar').css('height', (windowH) + 'px');
    } else {
    $('#sidebar').css('height', (wrapperH) + 'px');
    }

    var windowSize = window.innerWidth;
    if (windowSize < 768) {
    $('#sidebar').removeAttr('style');
    }
    });

</script>


<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

</body>
</html>
