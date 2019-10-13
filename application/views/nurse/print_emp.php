<base href="<?php echo base_url(); ?>">
<style type="text/css">

    @media print {
        @page { margin:0; }
        body { margin: .8cm; }
    }

	* {
		font-family: bangla;
		font-size: 18px;
		margin: 0;
	}

	.sttabtdd {
		width: 180px;
	}

	.logimg {
		position: absolute;
		margin-left: 100px;
	}

	.frmhed{
		font-size: 25px;
		margin: 15px 0 0 0;
		padding: 0;
		font-weight: bold;
		width: 380px;
		border: 1px solid black;
		border-radius: 15px;
	}

	.prflpic{
		border: 1px solid black;
		border-radius: 70px;
		margin: -80px 0 0 600px; 

	}

	.nndttdd {
		width: 550px;
	}
	.jzbNam {
		width: 161px;
	}
	.thknst {
		width: 181px;
	}
	.aplctnspt {
		margin: 12px 0 0 25px;
		font-size: 17px;
	}
	.aplsign {
		float: right;
		border-top: 2px solid black;
		margin: 25px 15px 0 0;
	}
	.vrfsprs{
		margin: 10px 0 0 35px;
		font-weight: bold; 
		font-size: 20px;
	}
	.vrfsign {
		float: right;
		border-top: 2px solid black;
		margin: 45px 10px 0 0;
	}
	.extrd {
		width: 200px;
	}
	.manag {
		float: left;
		border-top: 2px solid black;
		margin-top: 60px;
	}
	.finalmanag {
		float: right;
		border-top: 2px solid black;
		margin-top: 60px;
	}
	.jpnm {
		width: 100px;
	}
	.cmpsss {
		width: 80px;
	}
</style>








				<img class="logimg" width="60px" height="60px" src="<?php echo $this->db->get('settings')->row()->logo; ?>">
				<center>
                    <h1 style="font-size: 35px; margin: 0; padding: 0;"><?php echo $this->db->get('settings')->row()->OffcbnNam; ?></h1>
                    <p style="margin: 0; padding: 0; font-size: 20px;"><?php echo $this->db->get('settings')->row()->OffcbnAddrs; ?></p>
                    <p class="frmhed">কর্মকর্তা / কর্মচারীর ব্যক্তিগত তথ্যাবলী</p>
                </center>
                <img class="prflpic" style="position: absolute;" width="120px" height="120px" src="<?php echo $eMain->img_url; ?>"><br><br>


                <table class="sttab" border="1px">
                	<tr class="sttabrw">
                		<td class="sttabtdd">নাম</td>
                		<td>:</td>
                		<td class="nndttdd"><?php echo $eMain->embn_name; ?></td>
                	</tr>
                	<tr>
                		<td class="sttabtdd">পিতার নাম</td>
                		<td>:</td>
                		<td class="nndttdd"><?php echo $eMain->bn_fatherNam; ?></td>
                	</tr>
                	<tr>
                		<td class="sttabtdd">স্বামী / স্ত্রীর নাম</td>
                		<td>:</td>
                		<td class="nndttdd"><?php echo $eMain->embnHus_name; ?></td>
                	</tr>
                	<tr>
                		<td class="sttabtdd">মাতার নাম</td>
                		<td>:</td>
                		<td class="nndttdd"><?php echo $eMain->emMother_nam; ?></td>
                	</tr>
                </table>
                <table border="1px" class="ndtab">
                	<tr>
                		<td rowspan="3" class="sttabtdd">বর্তমান ঠিকানা</td>
                		<td class="cmpsss">বাড়ির নাম</td>
                		<td>:</td>
                		<td class="thknst"><?php echo $eMain->bn_Phome; ?></td>
                		<td class="cmpsss">গ্রাম/মহল্লা</td>
                		<td>:</td>
                		<td class="thknst"><?php echo $eMain->bn_Pvill_name; ?></td>
                	</tr>
                	<tr>
                		<td class="cmpsss">ডাকঘর</td>
                		<td>:</td>
                		<td class="thknst"><?php echo $eMain->embn_Ppost; ?></td>
                		<td class="cmpsss">থানা</td>
                		<td>:</td>
                		<td class="thknst"><?php echo $eMain->up_bn_name; ?></td>
                	</tr>
                	<tr>
                		<td class="cmpsss">জেলা</td>
                		<td>:</td>
                		<td class="thknst"><?php echo $eMain->ds_bn_name; ?></td>
                		<td class="cmpsss">বিভাগ</td>
                		<td>:</td>
                		<td class="thknst"><?php echo $eMain->dv_bn_name; ?></td>
                	</tr>


                	<tr>
                		<td rowspan="3" class="sttabtdd">স্থায়ী ঠিকানা</td>
                		<td class="cmpsss">বাড়ির নাম</td>
                		<td>:</td>
                		<td class="thknst"><?php echo $forsthaye->bn_Shome; ?></td>
                		<td class="cmpsss">গ্রাম/মহল্লা</td>
                		<td>:</td>
                		<td class="thknst"><?php echo $forsthaye->bn_Svill_name; ?></td>
                	</tr>
                	<tr>
                		<td class="cmpsss">ডাকঘর</td>
                		<td>:</td>
                		<td class="thknst"><?php echo $forsthaye->embn_Spost; ?></td>
                		<td class="cmpsss">থানা</td>
                		<td>:</td>
                		<td class="thknst"><?php echo $forsthaye->up_bn_name; ?></td>
                	</tr>
                	<tr>
                		<td class="cmpsss">জেলা</td>
                		<td>:</td>
                		<td class="thknst"><?php echo $forsthaye->ds_bn_name; ?></td>
                		<td class="cmpsss">বিভাগ</td>
                		<td>:</td>
                		<td class="thknst"><?php echo $forsthaye->dv_bn_name; ?></td>
                	</tr>
                </table>
                <table border="1px">
                	<tr>
                		<td class="sttabtdd">মোবাইল নং</td>
                		<td>:</td>
                		<td class="nndttdd"><?php echo $eMain->phone; ?></td>
                	</tr>
                </table>
                <table border="1px">
                	<tr>
                		<td rowspan="2" class="sttabtdd">জরুরী যোগাযোগ</td>
                		<td class="jpnm">নাম</td>
                		<td>:</td>
                		<td class="jzbNam"><?php echo $empextrInfo->emp_e_name; ?></td>
                		<td class="jpnm">সম্পর্ক</td>
                		<td>:</td>
                		<td class="jzbNam"><?php echo $empextrInfo->emp_e_relat; ?></td>
                	</tr>
                	<tr>
                		<td class="jpnm">মোবাইল নং</td>
                		<td>:</td>
                		<td colspan="4"><?php echo $empextrInfo->emp_e_mobile; ?></td>
                	</tr>
                </table>
                <table border="1px">
                	<tr>
                		<td class="sttabtdd">জন্ম তারিখ</td>
                		<td>:</td>
                		<td class="nndttdd"><?php echo $empextrInfo->em_birth; ?></td>
                	</tr>
                	<tr>
                		<td class="sttabtdd">বৈবাহিক অবস্থা</td>
                		<td>:</td>
                		<td class="nndttdd"><?php 
                			$mstss = $empextrInfo->marital_stus;
                			if ($mstss == 'married') {
                			 	echo "বিবাহীত";
                			 }else echo "অবিবাহীত"; ?></td>
                	</tr>
                	<tr>
                		<td class="">সর্বশেষ শিক্ষাগত যোগ্যতা</td>
                		<td>:</td>
                		<td class="nndttdd"><?php echo $empextrInfo->emp_edu_que; ?></td>
                	</tr>
                	<tr>
                		<td class="sttabtdd">ধর্ম</td>
                		<td>:</td>
                		<td class="nndttdd"><?php echo $empextrInfo->relaigion; ?></td>
                	</tr>
                </table>
                <p class="aplctnspt">আমি এই মর্মে ঘোষণা করছি যে, আমার জানামতে উপরোক্ত তথ্যাবলী নির্ভুল এবং সত্য। মিথ্যা প্রমাণিত হলে কর্তৃপক্ষ আমার বিরুদ্ধে যে কোন আইনানুগ ব্যবস্থা গ্রহণ করতে পারবেন।</p>
                <h3 class="aplsign">আবেদনকারীর স্বাক্ষর</h3><br><br>

                <p class="vrfsprs">**প্রার্থীর সকল তথ্যাবলীর সাথে সংযুক্ত কাগজপত্র যাচাই করা হয়েছে। নিয়োগদানের জন্য সুপারিশ করা যাচ্ছে।</p>
                <h3 class="vrfsign">যাচাইকৃত কর্মকর্তা<br> (ব্যাবস্থাপক আইটি)</h3><br><br><br><br>
                <hr>
                <hr>
                <center><h4>শুধুমাত্র অফিসের ব্যবহারের জন্য</h4></center> 
               <center> <table border="1px">
                	<tr>
                		<td>আইডি নং</td>
                		<td class="extrd"><?php echo substr_replace($eMain->eid, 'ই', 0).'-'.substr($eMain->eid,1); ?></td>
                		<td>পদবী</td>
                		<td class="extrd"><?php echo $empOffc->bn_desig; ?></td>
                	</tr>
                	<tr>
                		<td>যোগদানের তারিখ</td>
                		<td class="extrd"><?php echo $empOffc->joindate; ?></td>
                		<td>মাসিক বেতন</td>
                		<td class="extrd"><?php echo $empOffc->sallary; ?></td>
                	</tr>
                </table></center>

                <h3 class="manag">ব্যবস্থাপক</h3>
                <h3 class="finalmanag">চুড়ান্ত অনুমোদনকারী</h3>