<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>St. Xaviers</title>
	<link rel="stylesheet" href="css/printStyle.css">
	<style type="text/css" media="print">
		.hideMeInPrint{
			display: none; 
		}
		@page {
			margin: 0;  /* this affects the margin in the printer settings */
		
		}
	</style>
	<script type="text/javascript">
	function fetchAmntW(amount){
		var numbr=amount;
		var str=new String(numbr)
		var splt=str.split("");
		var rev=splt.reverse();
		var once=['ZERO', ' ONE', 'TWO', 'THREE', 'FOUR',
		'FIVE', 'SIX', 'SEVEN', 'EIGHT', 'NINE'];
		var twos=['TEN', ' ELEVEN', ' TWELVE', ' THIRTEEN', ' FOURTEEN', ' FIFTEEN', ' SIXTEEN', ' SEVENTEEN', ' EIGHTEEN', ' NINETEEN'];
		var tens=[ '', 'TEN', ' TWENTY', ' THIRTY', ' FORTY', ' FIFTY', ' SIXTY', ' SEVENTY', ' EIGHTY', ' NINETY' ];
		numlen=rev.length;
		var word=new Array();
		var j=0;
		for(i=0;i<numlen;i++){
			switch(i){
				case 0: if((rev[i]==0) || (rev[i+1]==1)){word[j]='';
						}else{word[j]=once[rev[i]];}word[j]=word[j] ;
						break;
				case 1:	abovetens();
						break;
				case 2:	if(rev[i]==0){word[j]='';
						} else if((rev[i-1]==0) || (rev[i-2]==0) ){
							word[j]=once[rev[i]]+" HUNDRED ";
						}else {word[j]=once[rev[i]]+" HUNDRED AND";} 
						break;
				case 3:	if(rev[i]==0 || rev[i+1]==1){
						word[j]='';
						} else{word[j]=once[rev[i]];}if((rev[i+1]!=0) || (rev[i] > 0)){word[j]= word[j]+" THOUSAND";}
						break;
				case 4:	abovetens(); 
						break;
				case 5:if((rev[i]==0) || (rev[i+1]==1)){
						word[j]='';
						} else{word[j]=once[rev[i]];}word[j]=word[j]+" LAKHS";
						break;
				case 6:	abovetens(); 
						break;
				case 7:	if((rev[i]==0) || (rev[i+1]==1)){
						word[j]='';
						} else{word[j]=once[rev[i]];}word[j]= word[j]+" CRORE";
						break;
				case 8:	abovetens(); 
						break;
				default:break;
			}j++;
		} 
		function abovetens(){
			if(rev[i]==0){
				word[j]='';
			} 
			else if(rev[i]==1){
				word[j]=twos[rev[i-1]];
			}else{
				word[j]=tens[rev[i]];
			}
		}
		word.reverse();
		var finalw='';
		for(i=0;i<numlen;i++)
		{
			finalw= finalw+word[i]+' ';
		}
		document.write(finalw);
	}
	function fetchAmntW2(amount){
		var numbr=amount;
		var str=new String(numbr)
		var splt=str.split("");
		var rev=splt.reverse();
		var once=['ZERO', ' FIRST', 'SECOND', 'THIRD', 'FOURTH',
		'FIFTH', 'SIXTH', 'SEVENTH', 'EIGHTH', 'NINETH'];
		var twos=['TENTH', ' ELEVENTH', ' TWELVETH', ' THIRTEENTH', ' FOURTEENTH', ' FIFTEENTH', ' SIXTEENTH', ' SEVENTEENTH', ' EIGHTEENTH', ' NINETEENTH'];
		var tens=[ '', 'TEN', ' TWENTY', ' THIRTY', ' FORTY', ' FIFTY', ' SIXTY', ' SEVENTY', ' EIGHTY', ' NINETY' ];
		numlen=rev.length;
		var word=new Array();
		var j=0;
		for(i=0;i<numlen;i++){
			switch(i){
				case 0: if((rev[i]==0) || (rev[i+1]==1)){word[j]='';
						}else{word[j]=once[rev[i]];}word[j]=word[j] ;
						break;
				case 1:	abovetens();
						break;
				case 2:	if(rev[i]==0){word[j]='';
						} else if((rev[i-1]==0) || (rev[i-2]==0) ){
							word[j]=once[rev[i]]+" HUNDRED ";
						}else {word[j]=once[rev[i]]+" HUNDRED AND";} 
						break;
				case 3:	if(rev[i]==0 || rev[i+1]==1){
						word[j]='';
						} else{word[j]=once[rev[i]];}if((rev[i+1]!=0) || (rev[i] > 0)){word[j]= word[j]+" THOUSAND";}
						break;
				case 4:	abovetens(); 
						break;
				case 5:if((rev[i]==0) || (rev[i+1]==1)){
						word[j]='';
						} else{word[j]=once[rev[i]];}word[j]=word[j]+" LAKHS";
						break;
				case 6:	abovetens(); 
						break;
				case 7:	if((rev[i]==0) || (rev[i+1]==1)){
						word[j]='';
						} else{word[j]=once[rev[i]];}word[j]= word[j]+" CRORE";
						break;
				case 8:	abovetens(); 
						break;
				default:break;
			}j++;
		} 
		function abovetens(){
			if(rev[i]==0){
				word[j]='';
			} 
			else if(rev[i]==1){
				word[j]=twos[rev[i-1]];
			}else{
				word[j]=tens[rev[i]];
			}
		}
		word.reverse();
		var finalw='';
		for(i=0;i<numlen;i++)
		{
			finalw= finalw+word[i]+' ';
		}
		document.write(finalw);
	}
	</script>
</head>
<body onload="window.print()">

	<div id="holder">
		<div id="body">
		
		<?php
				global $conn;
				$stmt = NULL;
				include 'ConnectionToMySQL.php';
				
				if (isset($_GET['LC'])){
					$gLC = $_REQUEST['LC'];
				}
				
				$fetchLCSQL = "SELECT LC_NO, LAST_SCHL_STD, CONDUCT, LV_DT, PROGRESS, CURR_STD_WHEN, LV_RSN, REMARKS, LC_DT, lastexam, MONTH, YEAR FROM LC_TBL WHERE LC_NO = '".$gLC."'";	
				$result = $conn->query($fetchLCSQL);
				foreach ($conn->query($fetchLCSQL) as $row){
					$lcNo = $row["LC_NO"];
					$lschl = $row["LAST_SCHL_STD"];
					$conduct = $row["CONDUCT"];
					$lDate = $row["LV_DT"];
					$pStudies = $row["PROGRESS"];
					$cStd = $row["CURR_STD_WHEN"];
					$lvReason = $row["LV_RSN"];
					$remarks = $row["REMARKS"];
					$lcDate = $row["LC_DT"];
					$lastexam = $row["lastexam"];
					$lcMonth = $row["MONTH"];
					$lcYear = $row["YEAR"];
				}
				
				$fetchLCDetailsSQL = "SELECT GR_NO, ADM_DT, ADM_CLS, UDISE_NO, OTH_UDISE_NO, STD_ID, FNAME, LNAME, HOUSE, CURR_CLS, ROLL_NO, REASON, DOB, FATHER_NAME, MOTHER_NAME, NATIONALITY, MOTHER_TONGUE, RELIGION, CASTE, SUB_CASTE, BIRTH_PLC, TALUKA, AADHAR, DIVS, ADDRESS, DISTRICT, STATE, COUNTRY, TEL, EMAIL FROM STUDENT_TBL WHERE GR_NO = (SELECT GR_NO FROM LC_TBL WHERE LC_NO = '".$gLC."')";
				$result = $conn->query($fetchLCDetailsSQL);
				foreach ($conn->query($fetchLCDetailsSQL) as $row){	
					$grNo = $row["GR_NO"];
					$admDt = $row["ADM_DT"];
					$adCls = $row["ADM_CLS"];
					$udiseNo = $row["UDISE_NO"];
					$othUdiseNo = $row["OTH_UDISE_NO"];
					$fName = $row["FNAME"];
					$lName = $row["LNAME"];
					$house = $row["HOUSE"];
					$currCls = $row["CURR_CLS"];
					$rollNo = $row["STD_ID"];
					$Reason=$row["REASON"];
					$DOB = $row["DOB"];
					$fatherName = $row["FATHER_NAME"];
					$motherName = $row["MOTHER_NAME"];
					$nationality = $row["NATIONALITY"];
					$motherTongue = $row["MOTHER_TONGUE"];
					$religion = $row["RELIGION"];
					$caste = $row["CASTE"];
					$subCaste = $row["SUB_CASTE"];
					$birthPlc = $row["BIRTH_PLC"];
					$taluka = $row["TALUKA"];
					$aadhar = $row["AADHAR"];
					$DIV = $row["DIVS"];
					$address = $row["ADDRESS"];
					$district = $row["DISTRICT"];
					$state = $row["STATE"];
					$country = $row["COUNTRY"];
					$tel = $row["TEL"];
					$email = $row["EMAIL"];
				}
			?>
		
			<div class="topHeader">
				<span style="display:inline;float:left;"><img src="image/Logo.png" alt=""></span>
				<span style="font-size:14px;">Management - St. Xavier's Institute of Education Society</span>
				<h2>ST. XAVIER'S BOYS' ACADEMY (S.S.C)</h2>
				<h3>SECONDARY SECTION</h3>
				
				<span style="display: block;font-size:14px;">40-A, New Marine Lines, Churchgate, Mumbai 400 020.</span>
				<span style="margin-right:150px;font-size:14px;">Taluka:Mumbai</span><span style="font-size:14px;">District:Mumbai</span>
				<br>
				<span style="margin-right:15px;font-size:14px;">Tel.No. 22014358 </span> <span style="margin-right:15px;font-size:14px;">Email: sxbaoffice@gmail.com</span>  <span style="font-size:14px;">Website:www.sxba.org</span>
			</div>
			
			<div class="lc">
				<span class="sub-hdr" style="font-size:18px;">L.C. No.</span><span style="text-decoration:underline;font-size:18px;"><?php echo $lcNo;?></span>
				<span class="sub-hdr" style="padding-left: 40%;font-size:18px;">General Register No.</span><span style="text-decoration:underline;font-size:18px;"><?php echo $grNo;?></span>
			</div>
			
			<div class="schl align-left">
				<span>Recognised as a full fledged High School vide Letter No.A 13 B dt. 11 March, 1960.</span>
				<br>
				<br>
				<span style="margin-right:10px;"><b>UDISE NO.</b> 27230100534</span><span style="margin-right:10px;"><b>Board:</b> S.S.C.</span><span style="margin-right:10px;"><b>School Index: No.</b> 31.01.026</span><span style="margin-right:10px;"><b>Medium:</b> English</span>
			</div>
			
			<div class="hdr">
				<h2>LEAVING CERTIFICATE</h2>
			</div>
			
			<hr>
			
			<div class="stud">
				<span class="sub-hdr">Student's ID.No:</span><span style="margin-right:10px; font-size: 15px;"><?php echo $rollNo; ?></span>
				<span class="sub-hdr">UID.No.(Aadhar Card No.):</span><span style="font-size: 15px;"><?php echo substr($aadhar,0,4),"-".substr($aadhar,4,4),"-".substr($aadhar,8,4); ?></span>
			</div>
			
			<hr>
			
			<div class="stud">
			<table>
				<thead>
					<tr>
						<th><span class="sub-hdr" style="margin-right:10px;">Student's Full Name:</span></th>
						<th><span class="sub-data"><?php echo $fName; ?></span></th>
						<th><span class="sub-data"><?php echo $fatherName; ?></span></th>
						<th><span class="sub-data"><?php echo $lName; ?></span></th>   
					</tr>
				</thead>
				<tbody>
					<tr>
						<!--Each table column is echoed in to a td cell-->
						<td><span style="font-size: 12px;"></span></td>			
						<td><span style="font-size: 12px;">(First Name)</span></td>
						<td><span style="font-size: 12px;">(Father's Name)</span></td>
						<td><span style="font-size: 12px;">(Surname)</span></td>
					</tr>
				</tbody>
			</table>
				
			</div>
			<div class="stud">
				<span class="sub-hdr">Mother's Name:</span><span class="sub-data" style=""><?php echo $motherName; ?></span>
			</div>
			<div class="stud" style="margin-top:20px;">
				<span class="sub-hdr">Nationality:</span><span class="sub-data" style=""><?php echo $nationality; ?></span>
				<span class="sub-hdr">Mother Tongue:</span><span class="sub-data" style=""><?php echo $motherTongue; ?></span>
			</div>
			<div class="stud" style="margin-top:20px;">
				<span class="sub-hdr">Religion:</span><span class="sub-data" style=""><?php echo $religion; ?></span>
				<span class="sub-hdr">Caste:</span><span class="sub-data" style=""><?php echo $caste; ?></span>
				<span class="sub-hdr">Sub-Caste:</span><span class="sub-data" style=""><?php echo $subCaste; ?></span>
			</div>
			<div class="stud" style="margin-top:20px;">
				<span class="sub-hdr">Place of Birth (Village/City):</span><span class="sub-data" style=""><?php echo $birthPlc; ?></span>
				<span class="sub-hdr">Taluka:</span><span class="sub-data" style=""><?php echo $taluka; ?></span>
			</div>
			<div class="stud" style="margin-top:20px;">
			    <span class="sub-hdr">District:</span><span class="sub-data" style=""><?php echo $district; ?></span>
				<span class="sub-hdr">State:</span><span class="sub-data" style=""><?php echo $state; ?></span>
				<span class="sub-hdr">Country:</span><span class="sub-data" style=""><?php echo $country; ?></span>
			</div>
			<div class="stud" style="margin-top:20px;">
				<span class="sub-hdr">Date of Birth, Month and Year according</span>
				<span style="font-size: 14px;font-family: monospace;"><?php echo date_format(date_create($DOB),'d-m-Y')." ("; ?></span>
				<span style="font-size: 14px;font-family: monospace;"><script>fetchAmntW2(<?php echo date_format(date_create($DOB),'d');  ?>);</script></span>
				<span style="font-size: 14px;font-family: monospace;"><?php echo strtoupper(date_format(date_create($DOB),'F'));  ?></span>
				<br> 
				<span class="sub-hdr">to the Christian Era (Figures and Words):</span>
				<!--<div class="stud" style="font-size: 14px;font-family: monospace;">-->
				
				<span style="font-size: 14px;font-family: monospace;margin-left:15px;">
					<script>
						if ((<?php echo date_format(date_create($DOB),'Y');  ?>) >= '2000'){
							fetchAmntW(<?php echo date_format(date_create($DOB),'Y');  ?>);
						}else{
							document.write("NINETEEN");
							fetchAmntW(<?php echo date_format(date_create($DOB),'y');  ?>);
						}
					</script>)
				</span>
				<!--</div>-->
			</div>
			
			<div class="stud" style="margin-top:20px;">
				<span class="sub-hdr">Last School attended and Standard:</span><span class="sub-data" style=""><?php echo $lschl; ?></span>
			</div>
			<div class="stud" style="margin-top:20px;">
				<span class="sub-hdr">Date of Admission:</span><span class="sub-data" style=""><?php echo date_format(date_create($admDt),'d-m-Y'); ?></span>
				<span class="sub-hdr">Std.:</span><span class="sub-data" style=""><?php echo $currCls."  ( "; ?><script>fetchAmntW2(<?php echo $currCls; ?>);</script>)</span>
			</div>
			<div class="stud" style="margin-top:20px;">
				<span class="sub-hdr">Progress in Studies:</span><span class="sub-data" style=""><?php echo $pStudies; ?></span>
				<span class="sub-hdr">Conduct:</span><span class="sub-data" style=""><?php echo $conduct; ?></span>
			</div>
			<div class="stud" style="margin-top:20px;">
				<span class="sub-hdr">Date of Leaving School:</span><span class="sub-data" style=""><?php echo date_format(date_create($lDate),'d-m-Y'); ?></span>
			</div>
			<div class="stud" style="margin-top:20px;">
				<span class="sub-hdr">Standard in which studying and</span><br>
				<span class="sub-hdr">since when (in Figures and Words):</span><span class="sub-data" style=""><?php echo $cStd; ?></span>
			</div>
			<!--<div class="stud">
				<span class="sub-hdr">Division:</span><span class="sub-data" style=""><?php //echo $DIV; ?></span>
			</div>-->
			<div class="stud" style="margin-top:20px;">
				<span class="sub-hdr">Reason for Leaving School:</span><span class="sub-data" style=""><?php echo $lvReason; ?></span>
			</div>
			<div class="stud" style="margin-top:20px;">
				<span class="sub-hdr">Remarks:</span><span class="sub-data" style=""><?php echo $remarks; ?></span>
			</div>
			
			<hr>
			
			<div class="stud">
				<span style="font-size:14px;">Certified that the above information is in accordance with the School General register.</span>
			</div>
			<div class="stud">
				<span class="sub-hdr">Date:</span><span class="sub-data" style=""><?php echo date_format(date_create($lcDate),'d-m-Y'); ?></span>
				<!--<span class="sub-hdr">Month:</span><span class="sub-data" style=""><?php //echo $lcMonth; ?></span>-->
				<!--<span class="sub-hdr">Year:</span><span style=""><?php //echo $lcYear; ?></span>-->
			</div>
			
			<br>
			<br>
			
			<div class="stud s-gap">
				<span style="margin-right:165px;">Class Teacher</span>
				<span style="margin-right:165px;">Clerk</span>
				<span >Principal</span>
			</div>
			<div class="stud s-gap" style="font-size:14px;">
				<p>(No change in any entry in this certificate shall be made except by the authority issuing it and any
				infringement of this requirement is liable to the imposition of a penalty such as that of rustication)
				{(Prescribed by rules 17 & 34(1) & (2) in chapter 11 section 111 of the Grant in aid code)(reprint 1972).}</p>
			</div>
			<div class="stud" style="font-weight:bold;font-size:14px;">
				<span>Any unauthorized change made in the School Leaving Certificate is liable to strict action.<span>
			</div>
			
		
			<div id="body" class="stud1">
				<span style="display:inline;float:left;"><img src="image/Logo.png" alt=""></span>
				<span style="font-size:14px;">Management - St. Xavier's Institute of Education Society</span>
				<h2>ST. XAVIER'S BOYS' ACADEMY (S.S.C)</h2>
				<h3>SECONDARY SECTION</h3>
				
				<span style="display: block;font-size:14px;">40-A, New Marine Lines, Churchgate, Mumbai 400 020.</span>
				<span style="margin-right:150px;font-size:14px;">Taluka:Mumbai</span><span style="font-size:14px;">District:Mumbai</span>
				<br>
				<span style="margin-right:15px;font-size:14px;">Tel.No. 22014358 </span> <span style="margin-right:15px;font-size:14px;">Email: sxbaoffice@gmail.com</span>  <span style="font-size:14px;">Website:www.sxba.org</span>
			</div>
			
			<div class="stud" style="margin-top:50px;">
				<br>
				<br>
				<br>
				<p align="right"><?php echo $lDate; ?></p>
				<br>
				<br>
				<span style="font-size: 14px">This is to certify that </span><span> <b><u><?php echo $lName; ?> <?php echo $fName; ?> <?php echo $fatherName; ?> <?php echo $motherName; ?></u></b> was a bonafide student of this school having passed the Secondary School Certificate Examination held in <b><u><?php echo $lastexam; ?></u></b> at his first attempt. His date of birth as given in the School Register is 
				<span style="font-size: 15px;"><b><u>(<script>fetchAmntW2(<?php echo date_format(date_create($DOB),'d');  ?>);</script><?php echo strtoupper(date_format(date_create($DOB),'F'));  ?>
					<script>
						if ((<?php echo date_format(date_create($DOB),'Y');  ?>) >= '2000'){
							fetchAmntW(<?php echo date_format(date_create($DOB),'Y');  ?>);
						}else{
							document.write("NINETEEN");
							fetchAmntW(<?php echo date_format(date_create($DOB),'y');  ?>);
						}
					</script>)
				<?php echo date_format(date_create($DOB),'d-m-Y'); ?>
				</u></b></span>
				</span> 
				<br>
				<br>
				<br>
				<br>
				<br>
			<p align="right"><b>Principal</b></p>
			</div>
		</div>
		<div style="margin-top:25px;padding-left:45%;background-color:black;position:fixed;bottom:0px;width:100%;" class="hideMeInPrint"><a href='LeavingCert.php' style="text-decoration:underline;font-size:15px;font-weight:bold;">Back to Search Page</a></div>
	</div>

</body>
</html>