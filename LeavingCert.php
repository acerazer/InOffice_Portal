<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>St. Xaviers</title>
	<link rel="stylesheet" href="css/style.css">
	<style>
		hr.hrBreak{
			border-top: 1px solid #8c8b8b;
			margin:10px;
			padding:2px;
		}
		.hide{
			display:none;
		}
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		td, th {
			border: 1px solid #dddddd;
			text-align: center;
			padding: 2px;
		}

		tr:nth-child(odd) {
			background-color: rgba(240, 230, 140, 0.37);
		}
		tr:nth-child(even) {
			background-color: rgba(100, 149, 237, 0.49);
		}
	</style>
</head>
<body>
	<div id="holder">
	
		<!--Header Section Start-->
		<?php include 'Header.php';?>
		
		<!--Container Start-->
		<div id="body">
		
			<div class="menuCont">
				<div class="menu">
					<div class="innerMenu">
						<div class="menuElm">
							<a href = "Index.php">Student Details</a>
						</div>
						<div class="menuElm">
							<a href = "LeavingCert.php">Leaving Certificate</a>
						</div>
						<div class="menuElm">
							<a href = "#">Reports</a>
						</div>
					</div>
				</div>
			</div>
			
			<?php
				$grNO="";
				$fName="";
				$cls="";
				$tClass0="";
				$tClass1="hide";
				$tClass2="hide";
				$gLC="";
				if (isset($_GET['search1'])){
					if ($_REQUEST['search1'] != ''){
						$grNO = $_REQUEST['search1'];
					}
					if ($_REQUEST['search2'] != ''){
						$fName = $_REQUEST['search2'];
					}
					if ($_REQUEST['search3'] != ''){
						$cls = $_REQUEST['search3'];
					}
					$tClass1 = "";
				}
				if (isset($_GET['gLC'])){
					$gLC = $_REQUEST['gLC'];
					$tClass0="hide";
					$tClass2="";
				}
			?>
			
			<div class="searchDiv <?php echo $tClass0; ?>">
				<h2>Search Parameters</h2>
				<div class="form" style="background-color: aquamarine;">
					<div class="formElm">
						<span>G.R. No.</span>
						<input type="text" id="sgrNo" class= "cols-1" value="<?php echo $grNO ;?>" placeholder="G.R. No.">
						<span>First Name</span>
						<input type="text" id="sstFName" class= "cols-1" value="<?php echo $fName; ?>" placeholder="Name">
						<span>Admission Class</span>
						<select id="scurrClass" class="cols-0">
							<option value = ''>Select Std.</option>
							<option Value='1'>1</option>
							<option Value='2'>2</option>
							<option Value='3'>3</option>
							<option Value='4'>4</option>
							<option Value='5'>5</option>
							<option Value='6'>6</option>
							<option Value='7'>7</option>
							<option Value='8'>8</option>
							<option Value='9'>9</option>
							<option Value='10'>10</option>
							<option Value='11'>11</option>
							<option Value='12'>12</option>
						</select>
						<input type="submit" id="searchBtn" value="Search" class="btn" style="margin-left: 100px;" onclick="formWithSearch();">
					</div>
				</div>
			</div>
			
			<div class="searchRes <?php echo $tClass1; ?>" id="searchRes">
				<table class="table" style="width:100%">
					<tr style="background-color: #031c46; color:white;text-decoration:underline;">
						<th>S.No</th><th>G.R. No.</th><th>Name</th><th>Class</th><th>Roll No.</th><th>LC</th>
					</tr>
					<?php
						global $conn;
						$stmt = NULL;
						$fetchStudSQL = "";
						$count = 0;
						if (isset($_GET['search1'])){
							include 'ConnectionToMySQL.php';
							
							$fetchStudSQL = "SELECT (@rownum:=@rownum+1) AS RANK, GR_NO, CONCAT(FNAME,' ',LNAME) AS NAME, ADM_CLS, ROLL_NO FROM STUDENT_TBL, (SELECT @rownum:=0) R WHERE UPPER(GR_NO) LIKE '%".$grNO."%' AND UPPER(FNAME) LIKE '%".$fName."%' AND UPPER(ADM_CLS) LIKE '%".$cls."%' ORDER BY FNAME";
									
							foreach ($conn->query($fetchStudSQL) as $row){
								++$count;
								echo "<tr><td>".$row["RANK"]."</td><td id='grNO$count' style='font-weight:bold;'>".$row["GR_NO"]."</td><td>".$row["NAME"]."</td><td>".$row["ADM_CLS"]."</td><td>".$row["ROLL_NO"]."</td><td><a href='LeavingCert.php?gLC=".$row["GR_NO"]."'>Generate LC</a></td></tr>";
							}
							$conn = NULL;
						}
					?>
				</table>
			</div>
			
			<div class="formContainer <?php echo $tClass2; ?>">
				<h2>LC Details</h2>
				<hr class="hrBreak">
				
				<div class="form">
				<h3>LC Details</h3>
				
				<?php
					global $conn;
					$stmt = NULL;
					include 'ConnectionToMySQL.php';
					$mkRdOnly = "N";
					if ($tClass2 == ""){
						$chkLCExists="SELECT 'Y' FROM LC_TBL WHERE GR_NO = '".$gLC."'";
						$stmt = $conn->prepare($chkLCExists);
						$stmt->execute();
						$row_count = $stmt->fetchColumn();
						if ($row_count == "Y"){
							$mkRdOnly = "Y";
						}
					}
				?>
				
				<?php
					$lcNo="NEW";
					$lschl="";
					$conduct="";
					$lDate="";
					$lastexam="";
					$pStudies="";
					$cStd="";
					$lvReason="";
					$remarks="";
					$lcDate = date("Y-m-d");
					$lcMonth="";
					$lcYear="";
					
					if ($tClass2 == "" && $mkRdOnly == "Y"){
						$fetchLCSQL = "";
						$rowNum = 0;
						
						$fetchLCSQL = "SELECT LC_NO, LAST_SCHL_STD, CONDUCT, LV_DT , LASTEXAM, PROGRESS, CURR_STD_WHEN, LV_RSN, REMARKS, LC_DT, MONTH, YEAR FROM LC_TBL WHERE GR_NO = '".$gLC."'";
						
						$result = $conn->query($fetchLCSQL);
						foreach ($conn->query($fetchLCSQL) as $row){
							$lcNo = $row["LC_NO"];
							$lschl = $row["LAST_SCHL_STD"];
							$conduct = $row["CONDUCT"];
							$lDate = $row["LV_DT"];
							$lastexam=$row["LASTEXAM"];
							$pStudies = $row["PROGRESS"];
							$cStd = $row["CURR_STD_WHEN"];
							$lvReason = $row["LV_RSN"];
							$remarks = $row["REMARKS"];
							$lcDate = $row["LC_DT"];
							$lcMonth = $row["MONTH"];
							$lcYear = $row["YEAR"];
						}
					}
				?>
					
					<div class="formElm <?php if($mkRdOnly == "Y"){echo "displayOnly";} ?>">
						<span>L.C. No.</span>
						<input type="text" id="lcNo" class= "cols-1" value="<?php echo $lcNo; ?>" placeholder="" readonly>
						<span>Last School & Std.</span>
						<input type="text" id="lschl" class= "cols-1" value="<?php echo $lschl; ?>" placeholder="Last School and Std." <?php if($mkRdOnly == "Y"){echo "readonly";} ?> >
						<span>*Conduct</span>
						<input type="text" id="conduct" class= "cols-2" value="<?php echo $conduct; ?>" placeholder="Behaviour" <?php if($mkRdOnly == "Y"){echo "readonly";} ?> >
					</div>
					
					<div class="formElm <?php if($mkRdOnly == "Y"){echo "displayOnly";} ?>">
						<span>*Leaving Date</span>
						<input type="date" id="lDate" class= "cols-1" value="<?php echo $lDate; ?>" <?php if($mkRdOnly == "Y"){echo "readonly";} ?> >
						<span>*Progress in Studies</span>
						<input type="text" id="pStudies" class= "cols-2" value="<?php echo $pStudies; ?>" placeholder="Progress" <?php if($mkRdOnly == "Y"){echo "readonly";} ?> >
					</div>
					
					<div class="formElm <?php if($mkRdOnly == "Y"){echo "displayOnly";} ?>">
						<span>*Curr. Std. & When</span>
						<input type="text" id="cStd" class= "cols-3" value="<?php echo $cStd; ?>" <?php if($mkRdOnly == "Y"){echo "readonly";} ?> ><I>(in words)</I>
					</div>
					
					
					<div class="formElm <?php if($mkRdOnly == "Y"){echo "displayOnly";} ?>">
						<span>*Leaving Reason</span>
						<input type="text" id="lvReason" class= "cols-3" value="<?php echo $lvReason; ?>" <?php if($mkRdOnly == "Y"){echo "readonly";} ?> >
					</div>
					
					<div class="formElm <?php if($mkRdOnly == "Y"){echo "displayOnly";} ?>">
						<span>Remarks</span>
						<input type="text" id="remarks" class= "cols-3" value="<?php echo $remarks; ?>" placeholder="Remarks" <?php if($mkRdOnly == "Y"){echo "readonly";} ?> >
					</div>
					
					<div class="formElm <?php if($mkRdOnly == "Y"){echo "displayOnly";} ?>">
						<span>*Date</span>
						<input type="date" id="lcDate" class= "cols-1" value="<?php echo $lcDate; ?>" <?php if($mkRdOnly == "Y"){echo "readonly";} ?> >
						<!--<span>*Month</span>
						<input type="text" id="lcMonth" class= "cols-1" value="<?php //echo $lcMonth; ?>" placeholder="Month" <?php //if($mkRdOnly == "Y"){echo "readonly";} ?> >
						<span>*Year</span>
						<input type="text" id="lcYear" class= "cols-1" value="<?php //echo $lcYear; ?>" placeholder="Year" <?php //if($mkRdOnly == "Y"){echo "readonly";} ?> >-->
					</div>
					
					<div class="formElm <?php if($mkRdOnly == "Y"){echo "displayOnly";} ?>">
						<span>*last examination.</span>
						<input type="text" id="lastexam" class= "cols-1" value="<?php echo $lastexam; ?>" placeholder=" last exam date" <?php if($mkRdOnly == "Y"){echo "readonly";} ?> >
					</div>
				
					<hr class="hrBreak">
					
					<?php
						if ($tClass2 == ""){
							$fetchLCDetailsSQL = "";
							$rowNum = 0;
							
							$fetchLCDetailsSQL = "SELECT GR_NO, ADM_DT, ADM_CLS, UDISE_NO, OTH_UDISE_NO, STD_ID, FNAME, LNAME, HOUSE, CURR_CLS, ROLL_NO, DOB, FATHER_NAME, MOTHER_NAME, NATIONALITY, MOTHER_TONGUE, RELIGION, CASTE, SUB_CASTE, BIRTH_PLC, TALUKA, AADHAR, DIVS, ADDRESS, DISTRICT, STATE, COUNTRY, TEL, EMAIL FROM STUDENT_TBL WHERE GR_NO = '".$gLC."'";
							
							$result = $conn->query($fetchLCDetailsSQL);
							foreach ($conn->query($fetchLCDetailsSQL) as $row){								
					?>
					
					<h3>Basic</h3>
					<div class="formElm displayOnly">
						<span>*G.R. No.</span>
						<input type="text" id="grNo" class= "cols-1" value="<?php echo $row["GR_NO"]; ?>" placeholder="G.R. No." readonly>
						<span>*Admission Date</span>
						<input type="date" id="admDt" class= "cols-1" value="<?php echo $row["ADM_DT"]; ?>" readonly>
						<span>*Admission Class</span>
						<input type="text" id="admClass" class= "cols-0" value="<?php echo $row["ADM_CLS"]; ?>" placeholder="" readonly>
					</div>
					<div class="formElm displayOnly">
						<span>*UDISE No.</span>
						<input type="text" id="udiseNo" class= "cols-1" value="<?php echo $row["UDISE_NO"]; ?>" placeholder="UDISE No." readonly>
						<span>Other UDISE No.</span>
						<input type="text" id="otherudiseNo" class= "cols-1" value="<?php echo $row["OTH_UDISE_NO"]; ?>" placeholder="UDISE No." readonly>
						<span>Student ID</span>
						<input type="text" id="studID" class= "cols-1" value="<?php echo $row["STD_ID"]; ?>" placeholder="Student ID" readonly>
					</div>
					
					<hr class="hrBreak">
					<h3>Current</h3>
					
					<div class="formElm displayOnly">
						<span>*First Name</span>
						<input type="text" id="stFName" class= "cols-1" value="<?php echo $row["FNAME"]; ?>" placeholder="Name" readonly>
						<span>Surname</span>
						<input type="text" id="stLName" class= "cols-1" value="<?php echo $row["LNAME"]; ?>" placeholder="Surname" readonly>
					</div>
					<div class="formElm displayOnly">
						<span>House</span>
						<input type="text" id="house" class= "cols-1" value="<?php echo $row["HOUSE"]; ?>" placeholder="House" readonly>
						<span>*Current Class</span>
						<input type="text" id="currClass" class= "cols-0" value="<?php echo $row["CURR_CLS"]; ?>" placeholder="" readonly>
						<span>Division</span>
						<input type="text" id="pan" class= "cols-1" value="<?php echo $row["DIVS"]; ?>" placeholder="Division" readonly>
					</div>

					<div class="formElm displayOnly">
						<span>*Roll No.</span>
						<input type="text" id="rollNo" class= "cols-0" value="<?php echo $row["ROLL_NO"]; ?>" placeholder="Roll No." readonly>
					
					</div>

					
					<hr class="hrBreak">
					<h3>Personal</h3>
					
					<div class="formElm displayOnly">
						<span>*DOB</span>
						<input type="date" id="dob" class= "cols-1" value="<?php echo $row["DOB"]; ?>" placeholder="DOB" readonly>
						<span>Father's Name</span>
						<input type="text" id="fatherName" class= "cols-1" value="<?php echo $row["FATHER_NAME"]; ?>" placeholder="Father's Name" readonly>
						<span>Mother's Name</span>
						<input type="text" id="motherName" class= "cols-1" value="<?php echo $row["MOTHER_NAME"]; ?>" placeholder="Mother's Name" readonly>
					</div>
					<div class="formElm displayOnly">
						<span>*Nationality</span>
						<input type="text" id="nationality" class= "cols-1" value="<?php echo $row["NATIONALITY"]; ?>" placeholder="Nationality" readonly>
						<span>Mother Tongue</span>
						<input type="text" id="mothertongue" class= "cols-1" value="<?php echo $row["MOTHER_TONGUE"]; ?>" placeholder="Mother Tongue" readonly>
					</div>
					<div class="formElm displayOnly">
						<span>Religion</span>
						<input type="text" id="religion" class= "cols-1" value="<?php echo $row["RELIGION"]; ?>" placeholder="Religion" readonly>
						<span>Caste</span>
						<input type="text" id="caste" class= "cols-1" value="<?php echo $row["CASTE"]; ?>" placeholder="Caste" readonly>
						<span>Sub-Caste</span>
						<input type="text" id="sub-caste" class= "cols-1" value="<?php echo $row["SUB_CASTE"]; ?>" placeholder="Sub-Caste" readonly>
					</div>
					<div class="formElm displayOnly">
						<span>Birth Place</span>
						<input type="text" id="birthPlace" class= "cols-1" value="<?php echo $row["BIRTH_PLC"]; ?>" placeholder="Birth Place" readonly>
						<span>Taluka</span>
						<input type="text" id="taluka" class= "cols-1" value="<?php echo $row["TALUKA"]; ?>" placeholder="Taluka" readonly>
					</div>
					<div class="formElm displayOnly">
						<span>Aadhar No.</span>
						<input type="text" id="aadhar" class= "cols-1" value="<?php echo $row["AADHAR"]; ?>" placeholder="Aadhar No." readonly>
					</div>
					
					<hr class="hrBreak">
					<h3>Contacts</h3>
					
					<div class="formElm displayOnly">
						<span>Address</span>
						<input type="text" id="address" class= "cols-3" value="<?php echo $row["ADDRESS"]; ?>" placeholder="Building/Street" readonly>
					</div>
					<div class="formElm displayOnly">
						<span>District</span>
						<input type="text" id="district" class= "cols-1" value="<?php echo $row["DISTRICT"]; ?>" placeholder="District" readonly>
						<span>State</span>
						<input type="text" id="state" class= "cols-1" value="<?php echo $row["STATE"]; ?>" placeholder="State" readonly>
						<span>Country</span>
						<input type="text" id="country" class= "cols-1" value="<?php echo $row["COUNTRY"]; ?>" placeholder="Country" readonly>
					</div>
					<div class="formElm displayOnly">
						<span>Tel/Mobile</span>
						<input type="text" id="tel" class= "cols-2" value="<?php echo $row["TEL"]; ?>" placeholder="Telephone/Mobile" readonly>
						<span>e-Mail</span>
						<input type="text" id="email" class= "cols-2" value="<?php echo $row["EMAIL"]; ?>" placeholder="e-Mail" readonly>
					</div>
					
					<?php
							}
						}
					?>
					
				</div>
				
				<?php
					if ($tClass2 == ""){
						$chkLCExists="SELECT 'Y' FROM LC_TBL WHERE GR_NO = '".$gLC."'";
						$stmt = $conn->prepare($chkLCExists);
						$stmt->execute();
						$row_count = $stmt->fetchColumn();
						if ($row_count == "Y"){
				?>
							<input type="submit" id="printBtn" value="Print" class="btn">
				<?php
						}else{
				?>
							<input type="submit" id="saveBtn" value="Save" class="btn">
				<?php
						}
					}
				?>
				
			    <span style="font-size:12px;color:red;">All * fields are required.</span>
			</div>
		
		</div>
		
	</div>
	
	<script src="js/jquery-2.1.1.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#saveBtn").click(function(){
				var lcNo = $("#lcNo").val();
				var lschl = $("#lschl").val();
				var conduct = $("#conduct").val();
				var lDate = $("#lDate").val();
				var lastexam = $("#lastexam").val();
				var pStudies = $("#pStudies").val();
				var cStd = $("#cStd").val();
				var lvReason = $("#lvReason").val();
				var remarks = $("#remarks").val();
				var lcDate = $("#lcDate").val();
				var lcMonth = $("#lcMonth").val();
				var lcYear = $("#lcYear").val();
								
				// Returns successful data submission message when the entered information is stored in database.
				var dataString = 'lcNo1='+ lcNo + '&lschl1='+ lschl + '&conduct1=' + conduct + '&lDate1=' + lDate + '&pStudies1=' + pStudies + '&cStd1=' + cStd + '&lvReason1=' + lvReason + '&remarks1=' + remarks + '&lcDate1=' + lcDate + '&lastexam1=' + lastexam + '&lcMonth1=' + lcMonth + '&lcYear1=' + lcYear + '&grNo1=' + $("#grNo").val();
				if(conduct==''||lDate==''||pStudies==''||cStd==''||lvReason==''||lcDate==''||lastexam==''){
					alert("Please Fill All Fields");
				}else{
					// AJAX Code To Submit Form.
					$.ajax({
						type: "POST",
						url: "LCDetailSubmit.php",
						data: dataString,
						cache: false,
						success: function(result){
						alert(result);
								location.reload();	
						}
					});
				}
				return false;
			});
			$("#printBtn").click(function(){
				location.href = "LCPrint.php?LC=" + $("#lcNo").val();
			});
		});
		function formWithSearch(){
			if(document.getElementById("sgrNo").value== '' && document.getElementById("sstFName").value== '' && document.getElementById("scurrClass").value== ''){
				location.href = "LeavingCert.php";
			}else{
				if(document.getElementById("sgrNo").value != '' || document.getElementById("sstFName").value != '' || document.getElementById("scurrClass").value != ''){
					location.href = "LeavingCert.php?search1=" + document.getElementById("sgrNo").value + "&search2=" + document.getElementById("sstFName").value + "&search3=" + document.getElementById("scurrClass").value;
				}
			}
		}
	</script>
	
</body>
</html>