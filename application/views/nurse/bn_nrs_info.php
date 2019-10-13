<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-user"></i>  <?php echo lang('emp'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix no-print">
                        
                        <button class="export no-print" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('emp_id'); ?></th>
                                <th><?php echo lang('image'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('dasign'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <style>

                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }

                        </style>

                        <?php foreach ($nurses as $nurse) { ?>
                            <tr class="">
                                <td> <?php echo $nurse->eid; ?></td>
                            <?php if ($nurse->img_url != '') {?>        
                                <td style="width:10%;"><img style="width:50px;height: 50px;" src="<?php echo $nurse->img_url; ?>"></td>
                            <?php }else {?>
                                    <td><?php echo lang('no_photo'); ?></td>
                            <?php } ?>
                                <td style="font-weight: bold;"> <?php echo $nurse->ename; ?></td>
                                <td><?php echo $nurse->desig; ?></td>
                                <td><?php echo $nurse->phone; ?></td>

                            <?php if (empty($nurse->embn_name)) { ?>
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $nurse->emp_id; ?>"><i class="fa fa-edit"> </i></button>
                                </td>
                            <?php }else { ?>
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width green" title="<?php echo $nurse->emp_id; ?>" onclick="emPrintInfo(this.title)" data-id="<?php echo $nurse->emp_id; ?>"><i class="fa fa-print"> </i></button>
                                </td>
                            <?php } ?>

                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->






<!-- Add Nurse Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_emp'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="nurse/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">


                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value=''>

                    </div>
                    <div class="form-group">


                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="id" value=''>


                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Nurse Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_emp'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editNurseForm" action="nurse/updateNursebnInfo" method="post" enctype="multipart/form-data">

                     <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('emp_id'); ?></label>
                        <input disabled="disabled" type="text" class="form-control" name="eid" id="exampleInputEmail1" value='' placeholder="Employee ID Such (E101)">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label><br>
                        <input type="text" style="width: 50%; float: left;" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                        <input type="text" style="width: 50%; float: left;" class="form-control" name="bnname" id="exampleInputEmail1" value='' placeholder="বাংলায় নাম লিখুন">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('father'); ?></label><br>
                        <input type="text" style="width: 50%; float: left;"  class="form-control" name="father" id="exampleInputEmail1" placeholder="Father">
                        <input type="text" style="width: 50%; float: left;" class="form-control" name="bnfthname" id="exampleInputEmail1" value='' placeholder="বাংলায় পিতার নাম লিখুন">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('mother'); ?></label><br>
                        <input type="text" style="width: 50%; float: left;"  class="form-control" name="mother" id="exampleInputEmail1" value='' placeholder="Mother">
                        <input type="text" style="width: 50%; float: left;" class="form-control" name="bnmothname" id="exampleInputEmail1" value='' placeholder="বাংলায় মাতার নাম লিখুন">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Husband / Wife</label><br>
                        <input type="text" style="width: 50%; float: left;"  class="form-control" name="husname" id="exampleInputEmail1" value='' placeholder="Husband Or Wife Name">
                        <input type="text" style="width: 50%; float: left;" class="form-control" name="bnhusname" id="exampleInputEmail1" value='' placeholder="বাংলায় স্বামী / স্ত্রীর নাম লিখুন">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Designation</label><br>
                        <input type="text" style="width: 50%; float: left;"  class="form-control" name="desgntn" id="exampleInputEmail1" value='' placeholder="">
                        <input type="text" style="width: 50%; float: left;" class="form-control" name="bndesgntn" id="exampleInputEmail1" value='' placeholder="বাংলায় পদবী লিখুন">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">বৈবাহিক অবস্থা</label>
                        <select  class="form-control form-control-lg" name="marstaus">
                            <option value="unmarried">অবিবাহিত</option>
                            <option value="married">বিবাহিত</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">সর্বশেষ শিক্ষাগত যোগ্যতা</label>
                        <input type="text" class="form-control" name="eduqulify" id="exampleInputEmail1" value='' placeholder="শিক্ষাগত যোগ্যতা লিখুন">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">জন্ম তারিখ</label>
                        <input type="text" class="form-control datepickk" name="dobirth" id="exampleInputEmail1" value='' >
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">জরুরী যোগাযোগ</label><br>
                        <input type="text" style="width: 33%; float: left;" class="form-control" name="emenam" id="exampleInputEmail1" value='' placeholder="ব্যক্তির নাম">
                        <input type="text" class="form-control" style="width: 33%; float: left;"  name="emembl" id="exampleInputEmail1" value='' placeholder="ব্যক্তির মোবাইল">
                        <input type="text" class="form-control" style="width: 33%; float: left;"  name="emereltn" id="exampleInputEmail1" value='' placeholder="ব্যক্তির সাথে সম্পর্ক">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleInputEmail1">ধর্ম</label><br>
                        <input type="text" class="form-control" name="rlgn" id="exampleInputEmail1" value='' placeholder="ধর্ম লিখুন">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="Full Address With Village, Post-Office, Thana, Distric">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Present Address (সম্পুর্ণ বর্তমান ঠিকানা)</label>
                        <div style="border:1px black dashed; margin-left: 80px;">
                            <select class="form-control form-control-lg pdvid" name="pdiviid">
                                <option value="">Select.........</option>
                            <?php foreach ($dvbnnam as $dvion) { ?>
                                <option value="<?php echo $dvion->dv_id; ?>"><?php echo $dvion->dv_bn_name; ?> </option>
                            <?php } ?>
                            </select>
                            <select class="form-control form-control-lg pdsid" name="pdisiid">
                                <option value="">Select.........</option>
                            </select>                        
                            <select class="form-control form-control-lg pupid" name="pupaiid">
                                <option value="">Select.........</option>
                            </select>               
                            <input type="text" class="form-control" name="ppost_office" id="exampleInputEmail1" value='' placeholder="বাংলায় পোষ্ট অফিসের নাম লিখুন">
                            <input type="text" class="form-control" name="pvill_nam" id="exampleInputEmail1" value='' placeholder="বাংলায় গ্রামের নাম লিখুন">
                            <input type="text" class="form-control" name="bhom_nam" id="exampleInputEmail1" value='' placeholder="বাংলায় বাড়ি / বাসার নাম লিখুন">
                        </div>
                    </div>




                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Parmanent Address (সম্পুর্ণ স্থায়ী ঠিকানা)</label>
                        <div style="border:1px black dashed; margin-left: 80px;">
                            <select class="form-control form-control-lg sdvid" name="sdividd">
                                <option value="">Select.........</option>
                            <?php foreach ($dvbnnam as $dvion) { ?>
                                <option value="<?php echo $dvion->dv_id; ?>"><?php echo $dvion->dv_bn_name; ?> </option>
                            <?php } ?>
                            </select>
                            <select class="form-control form-control-lg sdsid" name="sdisiidd"> 
                                <option value="">Select.........</option>
                            </select>                        
                            <select class="form-control form-control-lg supid" name="suipiidd">
                                <option value="">Select.........</option>
                            </select>               
                            <input type="text" class="form-control" name="sPostOffice" id="exampleInputEmail1" value='' placeholder="বাংলায় পোষ্ট অফিসের নাম লিখুন">
                            <input type="text" class="form-control" name="sVillNam" id="exampleInputEmail1" value='' placeholder="বাংলায় গ্রামের নাম লিখুন">
                            <input type="text" class="form-control" name="sHomNam" id="exampleInputEmail1" value='' placeholder="বাংলায় বাড়ি / বাসার নাম লিখুন">
                        </div>
                    </div>






                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label><br>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="Mobile Number">
                    </div><br><br><br>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input style="float: left;" type="file" name="img_url" id="file" onchange="loadfile(event)">
                        <img id="preimage" width="100px" height="100px" name="img_url" src="">
                        <script type="text/javascript">
                            function loadfile(){
                                var output=document.getElementById('preimage');
                                output.src=URL.createObjectURL(event.target.files[0]);
                            };
                        </script>
                    </div>

                    <input type="hidden" name="id" value=''>


                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script type="text/javascript">
$(document).ready(function () {
    $(".editbutton").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $('#editNurseForm').trigger("reset");
        $.ajax({
            url: 'nurse/editNurseByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            // Populate the form fields with the data returned from server
            $('#editNurseForm').find('[name="id"]').val(response.nurse.emp_id).end()


            $('#editNurseForm').find('[name="eid"]').val(response.nurse.eid).end()
            $('#editNurseForm').find('[name="name"]').val(response.nurse.ename).end()
            $('#editNurseForm').find('[name="father"]').val(response.nurse.father).end()
            $('#editNurseForm').find('[name="mother"]').val(response.nurse.mother).end()
            $('#editNurseForm').find('[name="address"]').val(response.nurse.address).end()
            $('#editNurseForm').find('[name="blood"]').val(response.nurse.blood).end()
            $('#editNurseForm').find('[name="phone"]').val(response.nurse.phone).end()
            $('#editNurseForm').find('[name="desgntn"]').val(response.nInf.desig).end()
            $('#editNurseForm').find('[name="img_url"]').attr('src', response.nurse.img_url).end()
            $('#myModal2').modal('show');
        });

    });

});



// Get Present Distric 
    $('.pdvid').change(function(){
        var dviidd = $('.pdvid').val(); 
        $.ajax({
            url: 'nurse/getdsbyjson?dvid=' + dviidd,
            data: '',
            dataType: 'json',
            }).success(function(ds_info) {
            var html;
            var n;
            for (n=0; n<ds_info.length; n++) {
               html += '<option value="'+ds_info[n].ds_id+'">'+ds_info[n].ds_bn_name+'</option>';
            }
            $('.pdsid').html('<option value="">Select..........................</option>'+html);
          })
        })
// Get Present Distric 



// Get Present Upazilla 
    $('.pdsid').change(function(){
        var dssidd = $('.pdsid').val(); 
        $.ajax({
            url: 'nurse/getupnbyjson?dsid=' + dssidd,
            data: '',
            dataType: 'json',
            }).success(function(up_info) {
            var html;
            var n;
            for (n=0; n<up_info.length; n++) {
               html += '<option value="'+up_info[n].up_id+'">'+up_info[n].up_bn_name+'</option>';
            }
            $('.pupid').html('<option value="">Select..........................</option>'+html);
          })
        })
// Get Present Upazilla










// Get Parmanent Distric 
    $('.sdvid').change(function(){
        var dviidd = $('.sdvid').val(); 
        $.ajax({
            url: 'nurse/getdsbyjson?dvid=' + dviidd,
            data: '',
            dataType: 'json',
            }).success(function(ds_info) {
            var html;
            var n;
            for (n=0; n<ds_info.length; n++) {
               html += '<option value="'+ds_info[n].ds_id+'">'+ds_info[n].ds_bn_name+'</option>';
            }
            $('.sdsid').html('<option value="">Select..........................</option>'+html);
          })
        })
// Get Parmanent Distric 



// Get Parmanent Upazilla 
    $('.sdsid').change(function(){
        var dssidd = $('.sdsid').val(); 
        $.ajax({
            url: 'nurse/getupnbyjson?dsid=' + dssidd,
            data: '',
            dataType: 'json',
            }).success(function(up_info) {
            var html;
            var n;
            for (n=0; n<up_info.length; n++) {
               html += '<option value="'+up_info[n].up_id+'">'+up_info[n].up_bn_name+'</option>';
            }
            $('.supid').html('<option value="">Select..........................</option>'+html);
          })
        })
// Get Parmanent Upazilla








  $( function() {
    $( ".datepickk" ).datepicker({

    format: "dd-mm-yyyy",
    maxDate: "0",
    }).on('changeDate', function(ev){
       $(this).datepicker('hide');
    });
  });




function emPrintInfo(clicked_title){
        var url = 'nurse/print_empInfo?emp_id='+clicked_title;     
      window.open(url, '_blank', 'height=800,width=800');
    }

</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

