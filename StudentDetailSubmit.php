<?php
$servername = "localhost";
$username = "root";
$password = "Abcd@1234";
try {
    $conn = new PDO("mysql:host=$servername;dbname=xaviersdatabase2", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$grNo2 = $_POST['grNo1'];
	$admDt2 = $_POST['admDt1'];
	$admClass2 = $_POST['admClass1'];
	$udiseNo2 = $_POST['udiseNo1'];
	$otherudiseNo2 = $_POST['otherudiseNo1'];
	$studID2 = $_POST['studID1'];
	$stFName2 = $_POST['stFName1'];
	$stLName2 = $_POST['stLName1'];
	$house2 = $_POST['house1'];
	$currClass2 = $_POST['currClass1'];
	$rollNo2 = $_POST['rollNo1'];
	$dob2 = $_POST['dob1'];
	$fatherName2 = $_POST['fatherName1'];
	$motherName2 = $_POST['motherName1'];
	$nationality2 = $_POST['nationality1'];
	$mothertongue2 = $_POST['mothertongue1'];
	$religion2 = $_POST['religion1'];
	$caste2 = $_POST['caste1'];
	$sub_caste2 = $_POST['sub_caste1'];
	$birthPlace2 = $_POST['birthPlace1'];
	$taluka2 = $_POST['taluka1'];
	$aadhar2 = $_POST['aadhar1'];
	$div2 = $_POST['div1'];
	$address2 = $_POST['address1'];
	$district2 = $_POST['district1'];
	$state2 = $_POST['state1'];
	$country2 = $_POST['country1'];
	$tel2 = $_POST['tel1'];
	$email2 = $_POST['email1'];
	$Reason2=$_POST['Reason1'];
	
	$deleteStdSQL = "DELETE FROM STUDENT_TBL WHERE GR_NO = '".$grNo2."'";
	$conn->exec($deleteStdSQL);
	
    $sql = "INSERT INTO STUDENT_TBL SELECT '$grNo2', '$admDt2', '$admClass2', '$udiseNo2', '$otherudiseNo2', '$studID2', '$stFName2', '$stLName2', '$house2', '$currClass2', '$rollNo2', '$dob2', '$fatherName2', '$motherName2', '$nationality2', '$mothertongue2', '$religion2', '$caste2', '$sub_caste2', '$birthPlace2', '$taluka2', '$aadhar2', '$div2', '$address2', '$district2', '$state2', '$country2', IFNULL('$tel2',0), '$email2', '$Reason2' FROM DUAL";
    // use exec() because no results are returned
    $conn->exec($sql);
		echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
?>