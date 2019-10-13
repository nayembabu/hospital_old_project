


<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
              <i class="fa fa-user"></i> <?php echo lang('attend'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">




<?php
	include 'conf.php';


		if (isset($_POST['submit'])) {

			$files = $_FILES['file']['tmp_name'];

			$file = fopen($files, "r");

			while (!feof($file)) {
				$content = fgets($file);
				$carray = preg_split('/\s+/', $content);
				list($eid,$dat,$tim) = $carray; 
				$co = date('H',strtotime('13:00:00'));
				$tm = date('H',strtotime($tim));

				$query = "SELECT * FROM attn WHERE emp_id = $eid";
				$run = mysqli_query($conn, $query);
			
				while($row = mysqli_fetch_assoc($run)){
					$empid = $row['emp_id'];
					$datet = $row['date'];
					$int = $row['intim'];
					$outt = $row['outtim'];



				}
					if ($tm <= $co &&$eid==$empid && $dat!=$datet) {
						$sql = "INSERT INTO `attn`(`emp_id`, `date`, intim) VALUES ('$eid', '$dat', '$tim')";
						$result = $conn->query($sql);
						
					}elseif ($tm >= $co && $dat==$datet && $int!='' && $outt=='') {
					$sql = "UPDATE attn SET outtim='$tim' WHERE emp_id='$eid' AND date='$dat'";
					$result = $conn->query($sql);
				}elseif ($tm >= $co && $eid==$empid && $dat!=$datet) {
						$sql = "INSERT INTO `attn`(`emp_id`, `date`, outtim) VALUES ('$eid', '$dat', '$tim')";
						$result = $conn->query($sql);
				

					};

				
				
			
				
			}
			fclose($file);?>
		<center><h3 style="margin-bottom: 20px; background-color: #660808; padding: 10px; color: white; font-weight: bold;">Attendance Upload Successfully</h3></center>

		<style type="text/css">
			.formlue{display: none;};
		</style>




<?php } ?>


  <center class="formlue">
	<form method="POST" action="pharmacist/alup" enctype="multipart/form-data" class="formlue">
		<div id="pb"></div>
		<input required="" class="btn-lg" type="file" name="file">
		<br><br>
		<input id="upload" class="btn-lg" type="submit" name="submit" value="Upload">
		
	</form>
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
    $(document).ready(function(){
        $('#pb').progressbar();
    });
</script>