
<style type="text/css">

    .s_name_list {
        padding: 10px;  
        cursor: pointer; 
        border-bottom: 1px solid black; 
        background: rgb(0,0,0,0.03); 
    }

    .search_box {
        width: 250px;
        margin: 15px 0 0 0; 
        position: relative;
    }

    .div_box {
        position: absolute; 
        margin: 15px 0 0 20%; 
        width: 250px; 
        background: #FFF; 
    }

</style>





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


            <center>
              <div class="form-group search_box">
                <label>Patient ID</label>
                <input type="text" class="form-control" id="search_P_id" class="search_P_id" onkeyup="findID();" placeholder="Search by Patient ID">
              </div>

                <div class="div_box" >
                </div>
            </center>







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



    function findID() {
        var serch_type = $('#search_P_id').val();

        $.ajax({
            url: 'patient/search_patientByID?id=' + serch_type,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {

                var html = '';
                var n;
                var blank_text = '<div class="s_name_list">Please Type Patient ID</div>';
                for (n = 0; n < response.length; n++) {
                    html += '<div class="s_name_list" id="'+response[n].patient_id+'" onclick="open_win(this.id)">'+response[n].ptnname+'</div>';
                }

                if (serch_type != '') {
                  $('.div_box').html(html);
                }else {
                    $('.div_box').html(blank_text);
                }

            } 
        })            
    }





function open_win(clicked_id){
        var url = 'labrcv/print_memo?labrcvid='+clicked_id;     
      window.open(url, '_blank', 'height=800,width=800');
    }



</script>


















