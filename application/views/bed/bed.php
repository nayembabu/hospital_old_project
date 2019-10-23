<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">

            <header class="panel-heading">
                    <i class="fa fa-user"></i>   <?php echo lang('bed'); ?>
                </header>
            <div class="panel-body">
                
                <div class="adv-table editable-table ">
                      <div class=" no-print">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                     <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export no-print" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('id'); ?></th> 
                                <th><?php echo lang('category'); ?></th>
                                <th><?php echo lang('bed').' '.lang('no'); ?></th> 
                                <th><?php echo lang('floor'); ?></th>
                                <th><?php echo lang('price'); ?></th>
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
                        <?php foreach ($beds as $bed) { ?>
                            <tr class="">
                                <td> <?php echo $bed->bed_Idi; ?></td>
                                <td> <?php echo $bed->category; ?></td>
                                <td><?php echo $bed->b_num; ?></td>
                                <td> <?php echo $bed->floor; ?></td>
                                <td> <?php echo $bed->price; ?></td>



                                <td class="no-print">
                                     <a type="button" class="btn editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $bed->bed_Idi; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></a>
                                   
                                     <a class="btn delete_button" title="<?php echo lang('delete'); ?>" href="bed/delete?id=<?php echo $bed->bed_Idi; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                                   

                                </td>
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






<!-- Add Patient Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_bed'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="patientadd" action="bed/addbed" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('category'); ?></label>
                        <input required="required" type="text" class="form-control" name="cat_name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('bed').' '.lang('no'); ?></label>
                        <input required="required" type="text" class="form-control" name="bedno" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label>Bed No for Tracking</label>
                        <input required="required" class="form-control form-control-inline input-medium" type="text" name="bed_cat_i" value="" placeholder="">      
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('floor'); ?></label>
                        <input required="required" type="text" class="form-control" name="floor" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                        <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label><?php echo lang('price'); ?></label>
                        <input required="required" class="form-control form-control-inline input-medium" type="text" name="price" value="" placeholder="">      
                    </div>


                    <section class=""><center>
                        <button style="padding: 20px 60px 20px 60px; font-size: 20px;" type="submit" name="submit" class="btn btn-info"><?php echo lang('register'); ?></button></center>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->







<!-- Edit Patient Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_bed'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="updatebed" action="patient/addNew" method="post" enctype="multipart/form-data">


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('category'); ?></label>
                        <input required="required" type="text" class="form-control" name="cat_name" id="exampleInputEmail1" value='' >
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('bed').' '.lang('no'); ?></label>
                        <input required="required" type="text" class="form-control" name="bedno" id="exampleInputEmail1" value='' >
                    </div>

                    <div class="form-group">
                        <label>Bed No for Tracking</label>
                        <input required="required" class="form-control form-control-inline input-medium" type="text" name="bed_cat_i" value="" placeholder="">      
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('floor'); ?></label>
                        <input required="required" type="text" class="form-control" name="floor" id="exampleInputEmail1" value='' >
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                        <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='' >
                    </div>

                    <div class="form-group">
                        <label><?php echo lang('price'); ?></label>
                        <input required="required" class="form-control form-control-inline input-medium" type="text" name="price" value="" >      
                    </div>

                <input type="text" name="id" value="">

                    <section class=""><center>
                        <button style="padding: 20px 60px 20px 60px; font-size: 20px;" type="submit" name="submit" class="btn btn-info"><?php echo lang('update'); ?></button></center>
                    </section>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Patient Modal-->


<script type="text/javascript">
$(document).ready(function () {
    $(".editbutton").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $('#updatebed').trigger("reset");
        $('#myModal2').modal('show');
        $.ajax({
            url: 'bed/editBedByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
            // Populate the form fields with the data returned from server


            $('#updatebed').find('[name="id"]').val(response.bed_info.bed_Idi).end()
            $('#updatebed').find('[name="cat_name"]').val(response.bed_info.category).end()
            $('#updatebed').find('[name="bedno"]').val(response.bed_info.b_num).end()
            $('#updatebed').find('[name="floor"]').val(response.bed_info.floor).end()
            $('#updatebed').find('[name="bed_cat_i"]').val(response.bed_info.bed_cat_i).end()
            $('#updatebed').find('[name="description"]').val(response.bed_info.description).end()
            $('#updatebed').find('[name="price"]').val(response.bed_info.price).end()

            }
        });
    });
});
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

