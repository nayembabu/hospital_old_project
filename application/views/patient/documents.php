<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
               <i class="fa fa-book"> </i>  <?php echo lang('patient'); ?>  <?php echo lang('documents'); ?> 
            </header> 
            <div class="">
                <div class="">
                    <div class="panel-body">
                        <a class="btn btn-info btn_width" data-toggle="modal" href="#myModal1">
                            <i class="fa fa-plus-circle"> </i> <?php echo lang('add_new'); ?> 
                        </a>
                    </div>


                    <div class="adv-table editable-table panel-body">
                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                            <thead>
                                <tr>
                                    <th><?php echo lang('date'); ?></th>
                                    <th><?php echo lang('patient'); ?></th>
                                    <th><?php echo lang('description'); ?></th>
                                    <th style="width: 20%;"><?php echo lang('document'); ?></th>
                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($files as $file) { ?>
                                    <tr class="">

                                        <td><?php echo date('m/d/Y', $file->date); ?></td>
                                        <td><?php echo $this->patient_model->getPatientById($file->patient)->name; ?></td>
                                        <td> <?php
                                            if (!empty($file->title)) {
                                                echo $file->title;
                                            }
                                            ?></td>
                                        <td> 
                                            <img src="<?php echo $file->url; ?>" width="100px" height="100px">
                                        </td>
                                        <td class="no-print">
                                            <a class="btn btn-info btn-xs" href="<?php echo $file->url; ?>" download> <?php echo lang('download'); ?> </a>
                                            <a class="btn btn-info btn-xs delete_button" href="patient/deletePatientMaterial?id=<?php echo $file->id; ?>&redirect=documents"onclick="return confirm('Are you sure you want to delete this item?');"> X </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->




<!-- Add Patient Material Modal-->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php echo lang('add'); ?> <?php echo lang('files'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientMaterial" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" name="patient" value=''>
                            <?php foreach ($patients as $patient) { ?>
                                <option value="<?php echo $patient->id; ?>"> <?php echo $patient->name; ?> </option>
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('file'); ?></label>
                        <input type="file" name="img_url">
                    </div>
                    <input type="hidden" name="redirect" value='patient/documents'>
                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->






<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
