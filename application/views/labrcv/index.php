
<style type="text/css">
    .div_box {
        position: absolute; 
        right: 30px; 
        margin-top: 63px; 
        width: 250px; 
        background: #FFF; 
    }

    .s_name_list {
        padding: 10px;  
        cursor: pointer; 
        border-bottom: 1px solid black; 
        background: rgb(0,0,0,0.03); 
    }
</style>




<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


              <div style="width: 250px; float: right; position: relative;" class="form-group">
                <label>Patient ID</label>
                <input type="text" class="fosrm-control" id="search_P_id" class="search_P_id" onkeyup="findID();" placeholder="Search by Patient ID">
              </div>


                <div class="div_box" >
                </div>







        <!-- page start-->
        <section class="">


            <header class="panel-heading">
                    <i class="fa fa-diagnoses"></i>  
                    Test Receive 
            </header>

            <br><br><br><br>

            <div class="panel-body">

                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('patient_id'); ?></th> 
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('doctor').' '.lang('name'); ?></th>
                                <th><?php echo lang('register').' '.lang('no'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($ptNInfo as $pninf) { ?>
                            <tr>
                                <td><?php echo $pninf->labpn_id; ?></td>
                                <td><?php echo $pninf->labpnname; ?></td>
                                <td><?php echo $pninf->drname; ?></td>
                                <td><?php echo $pninf->lab_rgstr_iidd; ?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>













		</section>
	</section>
</section>





<script type="text/javascript">
    function findID() {
        var serch_type = $('#search_P_id').val();

        $.ajax({
            url: 'labrcv/search_patientByID?id=' + serch_type,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {

                var html = '';
                var n;
                var blank_text = '<div class="s_name_list">Please Type Patient ID</div>';
                for (n = 0; n < response.length; n++) {
                    html += '<div class="s_name_list" id="'+response[n].lab_rgstr_iidd+'" onclick="open_win(this.id)">'+response[n].labpnname+'</div>';
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


























