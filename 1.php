<?php
$servername = "localhost";
$username = "root";
$password = "Abcd@1234";
try {
    $conn = new PDO("mysql:host=$servername;dbname=emergency", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$lcNo2 = $_POST['lcNo1'];
	$lschl2 = $_POST['lschl1'];
	$conduct2 = $_POST['conduct1'];
	$lDate2 = $_POST['lDate1'];
	$pStudies2 = $_POST['pStudies1'];
	$cStd2 = $_POST['cStd1'];
	$lvReason2 = $_POST['lvReason1'];
	$remarks2 = $_POST['remarks1'];
	$lcDate2 = $_POST['lcDate1'];
	$lastexam2 = $_POST['lastexam1'];
	$lcMonth2 = $_POST['lcMonth1'];
	$lcYear2 = $_POST['lcYear1'];
	$grNo2 = $_POST['grNo1'];
	
    $sql = "INSERT INTO LC_TBL SELECT IFNULL((SELECT (MAX(LC_NO)+1) FROM LC_TBL),1), '$lschl2', '$conduct2', '$lDate2', '$pStudies2', '$cStd2', '$lvReason2', '$remarks2', '$lcDate2', '$lastexam2', '$lcMonth2', '$lcYear2', '$grNo2' FROM DUAL";
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