<?php
session_start();
?>



<?php
$sendRegData=array();
$sendRegData[0]=$_POST['category'];
$sendRegData[1]=$_POST['plantName'];
$sendRegData[2]=$_POST['tempFrom'];
$sendRegData[3]=$_POST['tempTo'];
$sendRegData[4]=$_POST['HumidityFrom'];
$sendRegData[5]=$_POST['HumidityTo'];
$sendRegData[6]=$_POST['MoistureFrom'];
$sendRegData[7]=$_POST['MoistureTo'];
$sendRegData[8]=$_POST['PHPFrom'];
$sendRegData[9]=$_POST['PHPTo'];



$funValue=Register($sendRegData);
header("location: $funValue");

function Register($getRegData){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "sdmiotpro";

	$category=$getRegData[0];
	$plantName=$getRegData[1];
	$tempFrom=(int)$getRegData[2];
	$tempTo=(int)$getRegData[3];
	$HumidityFrom=(int)$getRegData[4];
	$HumidityTo=(int)$getRegData[5];
	$MoistureFrom=(int)$getRegData[6];
	$MoistureTo=(int)$getRegData[7];
	$PHPFrom=(float)$getRegData[8];
	$PHPTo=(float)$getRegData[9];


	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$UserExist=getNumOfRow($plantName);



	if($UserExist==0){

		$sql = "INSERT INTO `plants`(`category`, `plantName`, `tempFrom`, `tempTo`, `HumidityFrom`, `HumidityTo`, `MoistureFrom`, `MoistureTo`, `PHPFrom`, `PHPTo`) VALUES ('$category','$plantName','$tempFrom','$tempTo','$HumidityFrom','$HumidityTo','$MoistureFrom','$MoistureTo','$PHPFrom','$PHPTo');";
		
		
		if (mysqli_query($conn, $sql)) {
			$returnvalue="addPlants.php";
		 $_SESSION['ERRMSG_PLANT'] = "Plant details added";
		 session_write_close();
		} else {
			$returnvalue="addPlants.php";
			$_SESSION['ERRMSG_PLANT'] = "Try Again";
			session_write_close();
		}
	}else{
		$returnvalue="addPlants.php";
		$_SESSION['ERRMSG_PLANT'] = "Plant Name  Already exist ,try with different Plant";
		session_write_close();
	}

	return $returnvalue;
}


function getNumOfRow($plantName){

	$link = mysql_connect("localhost", "root", "");
	mysql_select_db("sdmiotpro", $link);

	$result = mysql_query("SELECT * FROM plants where plantName='$plantName'", $link);
	$num_rows = mysql_num_rows($result);

	return $num_rows;


}
