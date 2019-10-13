<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                  <i class="fa fa-user"></i>   <?php echo lang('manage_profile'); ?>
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">

                            <div class="col-lg-12">
                                <section class="panel">

                                    <div class="panel-body">
                                        <?php echo validation_errors(); ?>
                                        <form role="form" action="profile/Update" method="post" enctype="multipart/form-data">



                                <?php
                                    $this->db->where('emp_id', $profile->emp_id);
                                    $query = $this->db->get('nurse');
                                    $eml = $query->row();
                                        if($query->num_rows > 0 ) {?>
                            
                                <img alt="" src="<?php echo $eml->img_url?>" width="180" height="183">
                                <span style="font-size: 50px;" class="username">
                                     <?php echo  $eml->name;?>
                                </span>
<?php } ?>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo lang('username'); ?></label>
                                                <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php 
                                                    echo $profile->utype; 
                                                ?>' placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo lang('change_password'); ?></label>
                                                <input type="text" class="form-control" name="password" id="exampleInputEmail1" placeholder="********" >
                                            </div>
                                            <input type="hidden" name="id" value='<?php 
                                                echo $profile->id; 
                                            ?>'>
                                            <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                        </form>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->

<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
