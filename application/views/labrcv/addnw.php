<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">

            <header class="panel-heading">
	            <i class="fa fa-diagnoses"></i>  
	            Test Receive 
            </header>
            <br><br><br>



			<center>
				<form action="labrcv/newtest" method="post" style="width: 65%; ">


					<div class="input-group">
						<span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">
							Patient Name
						</span>
						<input type="text" required="required" name="ptnname" class="form-control" placeholder="Type Patient Name" aria-describedby="basic-addon3">
					</div>


					<br>
					<div class="input-group">
						<span style="font-weight: bold; color: black;" class="input-group-addon" id="basic-addon3">
							Patient Age
						</span>
						<input type="text" name="ptnage" required="required" class="form-control" style="width: 25%; float: left;" placeholder="Type Age" aria-describedby="basic-addon3">
						<select class="form-control custom-select custom-select-lg mb-3" name="ymd" style="width: 15%; float: left;">
						  <option value="y">Years</option>
						  <option value="m">Months</option>
						  <option value="d">Days</option>
						</select>
						<select class="form-control custom-select custom-select-lg mb-3" name="gender" style="width: 15%; float: left;">
						  <option value="m">Male</option>
						  <option value="f">Female</option>
						</select>
					</div>
					<br>
					<div class="input-group">
						<span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">
							Doctor's Name
						</span>
                        <select class="form-control custom-select custom-select-lg m-bot15 js-example-basic-single dri_id" required="required" name="dctr_id" value=''>
						  <option value="">Select.........</option>
					<?php foreach ($doctor as $dctr) { ?>
						  <option value="<?php echo $dctr->dr_id; ?>"><?php echo  $dctr->dr_id.'----------'.$dctr->drname; ?></option>
					<?php } ?>
						</select>
					</div><br>

				<div class="optdrad">

					
				</div>




					<br><br>

					<div class="testDivFull" style="margin-top: 15px;">
						<div class="input-group apndBox">
							<span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">
								Test ID / Name
							</span>
							<div style="width: 55%; float: left;">
		                        <select required="required" class="form-control tstiids custom-select custom-select-lg m-bot15 js-example-basic-single" id="tstiids" name="test_iiddd[]">
								  <option value="">Select.........</option>
							<?php foreach ($labtest as $tst) { ?>						
								  <option value="<?php echo $tst->tstinv_id; ?>"><?php echo $tst->inv_code.'-----------'.$tst->inv_name; ?></option>
							<?php } ?>
								</select>
							</div>
							<input type="text" name="testtakk[]" readonly="readonly" class="form-control tstrate tstrtval" style="width: 20%; float: left; text-align: right;" >
							<input type="hidden" name="testtypss[]" class="form-control tsttypes" >



							<div class="" style="width: 90px; float: right;">
								<img style="cursor: pointer; float: left;" width="40px" height="40px" src="uploads/ad_plus.png" class="plusAddBtn">					
							</div>
						</div>
					</div>
						<br><br><br>

					<div class="input-group" style="width: 300px; float: right;">
						<span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">
							Total Taka
						</span>
						<input type="text" readonly="readonly" name="ttlrattte" style="text-align: right; font-weight: bold; border: 1px solid black" class="form-control tttltstrtval" aria-describedby="basic-addon3">
					</div><br><br><br>


					<div class="input-group" style="width: 300px; float: right;">
						<span style="font-weight: bold; color: black;" class="input-group-addon " id="basic-addon3">
							Discount
						</span>
						<input required="required" type="text" name="discnt" style="text-align: right; font-weight: bold; border: 1px solid black" class="form-control dscntamnt " aria-describedby="basic-addon3" value="0">
					</div><br><br><br>



					<div class="input-group" style="width: 300px; float: right;">
						<span style="font-weight: bold; color: black;" class="input-group-addon" id="basic-addon3">
							Received
						</span>
						<input required="required" type="text" name="ttlrcvamnt" style="text-align: right; font-weight: bold; border: 1px solid black" class="form-control  rcvtakkak " aria-describedby="basic-addon3">
					</div><br><br><br>

					<div style="width: 50%; float: left; margin-top: -150px" class="discntrfrs">
						
					</div>

					<div class="ttlrcvtakkatk" style="font-size: 25px; font-weight: bold; text-align: right;"></div>

					<br>

					<div class="input-group" style="width: 300px; float: right;">
						<span style="transform: rotate(290deg); position: absolute; margin: -80px 0 0 -220px; font-weight: bold; color: black; font-size: 35px;" class="input-group-addon pdtxtval" id="basic-addon3">
						</span>
<!--						<input type="text" name="ttldueamnt" style="text-align: right; font-weight: bold; border: 1px solid black" class="form-control " aria-describedby="basic-addon3">-->
					</div><br><br><br>  

					<div class="input-group rfrtxvl" style="width: 400px; float: right;">
					</div><br><br><br>




						<br><br><br><br>

					<button type="submit" class="btn btn-info sbmtbtn" style="font-size: 42px; font-weight: bold;">Submit</button>

				</form>
			</center>



      <!--       <h1 style="transform: rotate(290deg); position: absolute; margin: -300px 0 0 -90px; font-family: solaimanlipi;"> Enter চাপ দিবেন না।</h1>
 -->







        </section>
    </section>
</section>




<script type="text/javascript">

var ttltstamnt;
var dscnttakka;
var sum_t = 0;
var rcvamnttaka;
var dscntprsntg;

var optionaldr = '<div class="optdrassd"><div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">Doctor Name</span><input type="text" name="optdrname" required="required" class="form-control" placeholder="Type Doctor Name" aria-describedby="basic-addon3"></div><br><div class="input-group"><span style="font-weight: bold; color: black;" class="input-group-addon lanr sp_dr_name" id="basic-addon3">Doctor Degree</span><input type="text" required="required" name="optdrdgre" class="form-control" placeholder="Type Doctor Degree" aria-describedby="basic-addon3"></div></div>';




var rfrtxtvl = '<div class="rfrbxtxt"><span style="font-weight: bold; color: black;" class="input-group-addon" id="basic-addon3"> Name of Reffer</span><input type="text"  required="required" name="hsprfrname" style="text-align: right; font-weight: bold; border: 1px solid black" class="form-control " aria-describedby="basic-addon3"><span style="font-weight: bold; color: black;" class="input-group-addon" id="basic-addon3"> Mobile No </span><input type="text" required="required" name="ptnmblno" style="text-align: right; font-weight: bold; border: 1px solid black" class="form-control " aria-describedby="basic-addon3"></div>';

var discntrfr = '<div class="duerfrtxt"><span style="font-weight: bold; color: black;" class="input-group-addon" id="basic-addon3"> Discount Reffer Name </span><input type="text" required="required" name="discntrfstxs" style=" font-weight: bold; border: 2px solid black" class="form-control " aria-describedby="basic-addon3"></div>'; 



	function tstttlval() {
		var sum_tss = 0;
        $('.tstrtval').each(function(){
            var bill_r = $(this).val();
        if (bill_r != 0) {
            sum_tss += parseInt(bill_r);
            }
        });
        $('.tttltstrtval').val(sum_tss);

	sum_t = sum_tss;

		$('.ttlrcvtakkatk').html(sum_t);

		rcvamnttaka = sum_t;
	}


tstttlval();


	function chngval() {
       $('.tstiids').off('change').on('change', function(){
        var tstsiid = $(this).children("option:selected").val();
        var rrratte = 0;
        var tsttp = 0;

			$.ajax({
	            url: "labrcv/testbill?tstiid=" + tstsiid, 
	            method: 'GET',
	            data: '',
	            dataType: 'json',
	            async: false,
	            success: function(tstinf){ 
	            	rrratte = tstinf.tstinfo.rate;
	            	tsttp = tstinf.tstinfo.repo_type;
	            }
	        })


	        $(this).parents('.apndBox').find('.tstrate').val(rrratte);
	        $(this).parents('.apndBox').find('.tsttypes').val(tsttp);
			tstttlval();



		})
	}



chngval();










	$('.plusAddBtn').click(function() {

		var nwtst = "<div class='input-group apndBox' style='margin-top: 10px;'><span style='font-weight: bold; color: black;' class='input-group-addon lanr sp_dr_name' id='basic-addon3'>Test ID / Name</span><div style='width: 55%; float: left;'><select class='form-control tstiids m-bot15 js-example-basic-single' id='tstiids' name='test_iiddd[]'><option value=''>Select......</option><?php foreach ($labtest as $tst) { ?> <option value='<?php echo $tst->tstinv_id; ?>'><?php echo $tst->inv_code.'-----------'.$tst->inv_name; ?></option> <?php } ?></select></div><input type='text' name='testtakk[]' readonly='readonly' class='form-control tstrate tstrtval' style='width: 20%; float: left; text-align: right;' value='0'><input type='hidden' name='testtypss[]' class='form-control tsttypes' ><div class='' style='width: 90px; float: right;'><img style='cursor: pointer; float: right;' class='dltBtnS' width='40px' height='40px' src='uploads/delete.png'></div></div>";

		$('.testDivFull').append(nwtst); 
		chngval();

        $(".js-example-basic-single").select2();

	})


	$("body").on("click",".dltBtnS",function(e){
	       $(this).parents('.apndBox').remove();
			tstttlval();
	  });


	$('.dscntamnt').keyup(function() {
		dscnttakka = $('.dscntamnt').val();
		rcvamnttaka = sum_t - dscnttakka;
		if (rcvamnttaka < 0 ) {
			alert('Hei Check Again and Again');
		}else {
			$('.ttlrcvtakkatk').html(rcvamnttaka); 
		}

		dscntprsntg = (sum_t * 20) / 100;
		if (dscnttakka > dscntprsntg) {
			$('.discntrfrs').html(discntrfr);
		}else {
			$('.duerfrtxt').remove();
		}



	});


	$('.rcvtakkak').keyup(function() {
		dscnttakka = $('.rcvtakkak').val();		
		obosisto = rcvamnttaka - dscnttakka;
		if (obosisto < 0 ) {
			alert('Hei Check Again and Again');			
	  	$('.sbmtbtn').css('display', 'none');
		}else if (obosisto == 0) {
		$('.ttlrcvtakkatk').html(obosisto);
			$('.pdtxtval').html('Full Paid');		
	  	$('.sbmtbtn').css('display', 'block');
		$('.rfrbxtxt').remove();
		}else if (obosisto > 0) {
		$('.ttlrcvtakkatk').html(obosisto);
		$('.pdtxtval').html('Due '+ obosisto +' Taka');
		$('.rfrtxvl').html(rfrtxtvl);			
	  	$('.sbmtbtn').css('display', 'block');		
		}
	});


  $("form").submit(function(){
  	$('.sbmtbtn').attr('disabled', 'disabled');
  });


$('.dri_id').change(function() {
	var idval = $(this).val();
	if (idval == 9999) {
		$('.optdrad').html(optionaldr);
	}else {
		$('.optdrassd').remove();
	}
});






</script>















