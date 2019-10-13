<!--sidebar end-->
<!--main content start-->

<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-user"></i>  <?php  echo lang('income').' '.lang('expense'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">



                    <table style="width: 450px; float: left;" class="table table-bordered inccls">
                        <thead>
                            <tr>
                                <th>Income Perpose</th>
                                <th>Taka</th>
                            </tr>
                        </thead>
                <?php foreach ($dctr as $dcr) { ?>
                        <tr>
                            <td><?php echo $dcr->drname; ?></td>
                            <td><input type="text" class="form-control" placeholder="Income Taka"></td>
                        </tr>
                <?php } ?>
                        <tr>
                            <td></td>
                        </tr>
                    </table>

                
                </div>
            </div>
        </section>
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
