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
			
			<div class="formContainer">
				<h2>Student Details</h2>
				<hr class="hrBreak">
				
				<?php
					global $conn;
					$stmt = NULL;
					$exists = "N";
					$grNo="";
					$admDt = "";
					$adCls = "";
					$udiseNo = "27230100534";
					$othUdiseNo = "";
					$stdID = "";
					$fName = "";
					$lName = "";
					$house = "";
					$currCls = "";
					$rollNo = "";
					$DOB = "";
					$fatherName = "";
					$motherName = "";
					$nationality = "INDIAN";
					$motherTongue = "";
					$religion = "";
					$caste = "";
					$subCaste = "";
					$birthPlc = "";
					$taluka = "";
					$aadhar = "";
					$DIV = "";
					$address = "";
					$district = "";
					$state = "";
					$country = "INDIA";
					$tel = "";
					$email = "";
					$Reason="";
					include 'ConnectionToMySQL.php';
					
					if (isset($_GET['grNo'])){
						$chkGRNoExists="SELECT 'Y' FROM STUDENT_TBL WHERE GR_NO = '".$_REQUEST['grNo']."'";
						$stmt = $conn->prepare($chkGRNoExists);
						$stmt->execute();
						$row_count = $stmt->fetchColumn();
						if ($row_count != ""){
							$grNo = $_REQUEST['grNo'];
							$exists = "Y";
						}else{
							$grNo = $_REQUEST['grNo'];
						}
					}
					
					if ($exists == "Y"){
						$fetchLCDetailsSQL = "SELECT GR_NO, ADM_DT, ADM_CLS, UDISE_NO, OTH_UDISE_NO, STD_ID, FNAME, LNAME, HOUSE, CURR_CLS, ROLL_NO, DOB, FATHER_NAME, MOTHER_NAME, NATIONALITY, MOTHER_TONGUE, RELIGION, CASTE, SUB_CASTE, BIRTH_PLC, TALUKA, AADHAR, DIVS, ADDRESS, DISTRICT, STATE, COUNTRY, TEL, EMAIL, REASON FROM STUDENT_TBL WHERE GR_NO = '".$grNo."'";
						$result = $conn->query($fetchLCDetailsSQL);
						foreach ($conn->query($fetchLCDetailsSQL) as $row){
							$admDt = $row["ADM_DT"];
							$adCls = $row["ADM_CLS"];
							$udiseNo = $row["UDISE_NO"];
							$othUdiseNo = $row["OTH_UDISE_NO"];
							$stdID = $row["STD_ID"];
							$fName = $row["FNAME"];
							$lName = $row["LNAME"];
							$house = $row["HOUSE"];
							$currCls = $row["CURR_CLS"];
							$rollNo = $row["ROLL_NO"];
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
							$Reason=$row["REASON"];
						}
					}
				?>
				
				<div class="form">
					<h3>Basic</h3>
					<div class="formElm">
						<span>*G.R. No.</span>
						<input type="text" id="grNo" class= "cols-1" value="<?php echo $grNo; ?>" placeholder="G.R. No." onchange="LoadData()">
						<span>*Admission Date</span>
						<input type="date" id="admDt" class= "cols-1" value="<?php echo $admDt; ?>">
						<span>*Admission Class</span>
						<select id="admClass" class="cols-0">
							<option value = ''>Select Std.</option>
							<?php
								$i = 1;
								for($i=1;$i<=12;$i++){
									if ($adCls == $i){
										echo "<option value='".$i."' selected>".$i."</option>";
									}else{
										echo "<option value='".$i."'>".$i."</option>";
									}
								}
						    ?>
						</select>
					</div>
					<div class="formElm">
						<span>*UDISE No.</span>
						<input type="text" id="udiseNo" class= "cols-1" value="<?php echo $udiseNo; ?>" placeholder="UDISE No.">
						<span>Other UDISE No.</span>
						<input type="text" id="otherudiseNo" class= "cols-1" value="<?php echo $othUdiseNo; ?>" placeholder="UDISE No.">
						<span>Student ID</span>
						<input type="text" id="studID" class= "cols-1" value="<?php echo $stdID; ?>" placeholder="Student ID">
					</div>
					
					<hr class="hrBreak">
					<h3>Current</h3>
					
					<div class="formElm">
						<span>*First Name</span>
						<input type="text" id="stFName" class= "cols-1" value="<?php echo $fName; ?>" placeholder="Name">
						<span>Surname</span>
						<input type="text" id="stLName" class= "cols-1" value="<?php echo $lName; ?>" placeholder="Surname">
					</div>
					<div class="formElm">
						<span>House</span>
						<input type="text" id="house" class= "cols-1" value="<?php echo $house; ?>" placeholder="House">
						<span>*Current Class</span>
						<select id="currClass" class="cols-0">
							<option value = ''>Select Std.</option>
							<?php
								$i = 1;
								for($i=1;$i<=12;$i++){
									if ($currCls == $i){
										echo "<option value='".$i."' selected>".$i."</option>";
									}else{
										echo "<option value='".$i."'>".$i."</option>";
									}
								}
						    ?>
						</select>
						<span>Division</span>
						<select id="div" class="cols-0">
							<option value = ''>Division</option>
							<?php
								$i = 1;
								for($i=1;$i<=2;$i++){
									if ($DIV == $i){
										echo "<option value='".$i."' selected>".$i."</option>";
									}else{
										echo "<option value='".$i."'>".$i."</option>";
									}
								}
						    ?>
						</select>
						<!---<input type="text" id="div" class= "cols-1" value="<?php// echo $DIV; ?>" placeholder="Division">-->	
					</div>
					<div class="formElm">
									<span>*Roll No.</span>
						<input type="text" id="rollNo" class= "cols-0" value="<?php echo $rollNo; ?>" placeholder="Roll No.">
						
						</div>
					
					<hr class="hrBreak">
					<h3>Personal</h3>
					
					<div class="formElm">
						<span>*DOB</span>
						<input type="date" id="dob" class= "cols-1" value="<?php echo $DOB; ?>" placeholder="DOB">
						<span>Father's Name</span>
						<input type="text" id="fatherName" class= "cols-1" value="<?php echo $fatherName; ?>" placeholder="Father's Name">
						<span>Mother's Name</span>
						<input type="text" id="motherName" class= "cols-1" value="<?php echo $motherName; ?>" placeholder="Mother's Name">
					</div>
					<div class="formElm">
						<span>*Nationality</span>
						<input type="text" id="nationality" class= "cols-1" value="<?php echo $nationality; ?>" placeholder="Nationality">
						<span>Mother Tongue</span>
						<input type="text" id="mothertongue" class= "cols-1" value="<?php echo $motherTongue; ?>" placeholder="Mother Tongue">
					</div>
					<div class="formElm">
						<span>Religion</span>
						<input type="text" id="religion" class= "cols-1" value="<?php echo $religion; ?>" placeholder="Religion">
						<span>Caste</span>
						<input type="text" id="caste" class= "cols-1" value="<?php echo $caste; ?>" placeholder="Caste">
						<span>Sub-Caste</span>
						<input type="text" id="sub-caste" class= "cols-1" value="<?php echo $subCaste; ?>" placeholder="Sub-Caste">
					</div>
					<div class="formElm">
						<span>Birth Place</span>
						<input type="text" id="birthPlace" class= "cols-1" value="<?php echo $birthPlc; ?>" placeholder="Birth Place">
						<span>Taluka</span>
						<input type="text" id="taluka" class= "cols-1" value="<?php echo $taluka; ?>" placeholder="Taluka">
					</div>
					<div class="formElm">
						<span>Aadhar No.</span>
						<input type="text" id="aadhar" class= "cols-1" value="<?php echo $aadhar; ?>" placeholder="Aadhar No.">
					</div>
					<hr class="hrBreak">
					<h3>Contacts</h3>
					
					<div class="formElm">
						<span>Address</span>
						<input type="text" id="address" class= "cols-3" value="<?php echo $address; ?>" placeholder="Building/Street">
					</div>
					<div class="formElm">
						<span>District</span>
						<input type="text" id="district" class= "cols-1" value="<?php echo $district; ?>" placeholder="District">
						<span>State</span>
						<input type="text" id="state" class= "cols-1" value="<?php echo $state ; ?>" placeholder="State">
						<span>Country</span>
						<input type="text" id="country" class= "cols-1" value="<?php echo $country; ?>" placeholder="Country">
					</div>
					<div class="formElm">
						<span>Tel/Mobile</span>
						<input type="text" id="tel" class= "cols-2" value="<?php echo $tel; ?>" placeholder="Telephone/Mobile" onchange="ValidateNumber()">
						<span>e-Mail</span>
						<input type="text" id="email" class= "cols-2" value="<?php echo $email; ?>" placeholder="e-Mail">
						
					</div>
						
						<div class="formElm <?php if($currCls == "10"){echo "displayOnly";} ?>">
						<span>Reason.</span>
						<input type="text" id="Reason" class= "cols-1" value="<?php echo $Reason; ?>" placeholder="Bonafide Reason." <?php if($currCls == "10"){echo "readonly";} ?>>
						
					</div>
					
				</div>
				<input type="submit" id="bonBtn" value="Print Bonafide" class="btn">
				<input type="submit" id="saveBtn" value="Save" class="btn">
			    <span style="font-size:12px;color:red;">All * fields are required.</span>
			</div>
		
		</div>
		
	</div>
	
	<script src="js/jquery-2.1.1.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#saveBtn").click(function(){
				var grNo = $("#grNo").val();
				var admDt = $("#admDt").val();
				var admClass = $("#admClass").val();
				var udiseNo = $("#udiseNo").val();
				var otherudiseNo = $("#otherudiseNo").val();
				var studID = $("#studID").val();
				var stFName = $("#stFName").val();
				var stLName = $("#stLName").val();
				var house = $("#house").val();
				var currClass = $("#currClass").val();
				var rollNo = $("#rollNo").val();
				var dob = $("#dob").val();
				var fatherName = $("#fatherName").val();
				var motherName = $("#motherName").val();
				var nationality = $("#nationality").val();
				var mothertongue = $("#mothertongue").val();
				var religion = $("#religion").val();
				var caste = $("#caste").val();
				var sub_caste = $("#sub-caste").val();
				var birthPlace = $("#birthPlace").val();
				var taluka = $("#taluka").val();
				var aadhar = $("#aadhar").val();
				var div = $("#div").val();
				var address = $("#address").val();
				var district = $("#district").val();
				var state = $("#state").val();
				var country = $("#country").val();
				var tel = $("#tel").val();
				var email = $("#email").val();
				var Reason=$("#Reason").val();
				
				// Returns successful data submission message when the entered information is stored in database.
				var dataString = 'grNo1='+ grNo + '&admDt1='+ admDt + '&admClass1=' + admClass + '&udiseNo1=' + udiseNo + '&otherudiseNo1=' + otherudiseNo + '&studID1=' + studID + '&stFName1=' + stFName + '&stLName1=' + stLName + '&house1=' + house + '&currClass1=' + currClass + '&rollNo1=' + rollNo + '&dob1=' + dob + '&fatherName1=' + fatherName + '&motherName1=' + motherName + '&nationality1=' + nationality + '&mothertongue1=' + mothertongue + '&religion1=' + religion + '&caste1=' + caste + '&sub_caste1=' + sub_caste + '&birthPlace1=' + birthPlace + '&taluka1=' + taluka + '&aadhar1=' + aadhar + '&div1=' + div + '&address1=' + address + '&district1=' + district + '&state1=' + state + '&country1=' + country + '&tel1=' + tel + '&email1=' + email + '&Reason1=' + Reason ;
				if(grNo==''||admDt==''||admClass==''||udiseNo==''||stFName==''||currClass==''||rollNo==''||dob==''||nationality==''){
					alert("Please Fill All Fields");
				}else{
					// AJAX Code To Submit Form.
					$.ajax({
						type: "POST",
						url: "StudentDetailSubmit.php",
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
		});
		function ValidateNumber(){
			var data = document.getElementById("tel").value;
			var regx = /^[0-9]+$/;

			console.log( data + ' patt:'+ data.match(regx));

			if ( data === '' || data.match(regx) ){
				if(data.length >= 11){
					document.getElementById("tel").value=0;
					alert("Please Enter valid Number. Can't be so long.");
				}
			}else{
				document.getElementById("tel").value=0;
				alert("Please Enter valid Number.");
			}
		}
		function LoadData(){
			location.href = "Index.php?grNo=" + $("#grNo").val();
		}
	</script>
	
</body>
</html>