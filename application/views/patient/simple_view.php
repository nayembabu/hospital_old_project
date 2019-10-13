<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-plus-circle"></i> Patient Statement
            </header> <br><br><br>
            <div class="panel-body">



                <div class="adv-table editable-table ">
                    
                    <input style="width: 200px; float: left;" class="form-control dtpic form-control-lg" id="stdate" type="text" placeholder="Start Date">

                    <!--<button style="margin: 0 0 0 10px;" onclick="daily_report()" class="btn btn-info">Daily View</button>-->



                    <input style="width: 200px; float: left; margin: 0 0 0 10px;" class="form-control dtpic form-control-lg" id="lastdate" type="text" placeholder="End Date">

                    <button style="margin: 0 0 0 10px;" onclick="monthly_report()" class="btn btn-info">View</button>




                </div>



            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->









<script type="text/javascript">
    function daily_report() {
        var url = 'patient/reports_P?st_date='+document.getElementById("stdate").value;     
      window.open(url, '_blank', 'height=800,width=800');
    }


    function monthly_report() {
        var url = 'patient/report_p_m?st_date='+document.getElementById("stdate").value+'&last_date='+document.getElementById("lastdate").value;    
      window.open(url, '_blank', 'height=800,width=800');
    }




</script>


















