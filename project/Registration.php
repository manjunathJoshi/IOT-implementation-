<?php
session_start();
?>



<?php
$sendRegData=array();
$sendRegData[0]=$_POST['Firstname'];
$sendRegData[1]=$_POST['Lastname'];
$sendRegData[2]=$_POST['contactDetails'];
$sendRegData[3]=$_POST['address'];
$sendRegData[4]=$_POST['password'];
$sendRegData[5]=$_POST['Username'];


$funValue=Register($sendRegData);
header("location: $funValue");

function Register($getRegData){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "sdmiotpro";

	$Firstname=$getRegData[0];
	$Lastname=$getRegData[1];
	$contactDetails=$getRegData[2];
	$address=$getRegData[3];
	$password123=$getRegData[4];
	$Username=$getRegData[5];
	$admin=0;
	$other="NILL";
	$sequence=(int)getCount($servername,$username,$password,$dbname)+1;

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$UserExist=getNumOfRow($Username);



	if($UserExist==0){

		$sql = "INSERT INTO `user`(`Firstname`, `Lastname`, `contactDetails`, `address`, `password`, `Username`, `admin`, `other`,`userId`)  VALUES ('$Firstname','$Lastname','$contactDetails','$address','$password123','$Username','$admin','$other','$sequence')";

		if (mysqli_query($conn, $sql)) {
			$returnvalue="Login.php";
		 $_SESSION['ERRMSG_ARR'] = "Account Created Successfully";
		 session_write_close();
		} else {
			$returnvalue="Login.php";
			$_SESSION['ERRMSG_ARR'] = "Try Again..";
			session_write_close();
		}
	}else{
		$returnvalue="Login.php";
		$_SESSION['ERRMSG_ARR'] = "User Already exist ,try different username";
		session_write_close();
	}

	return $returnvalue;
}


function getNumOfRow($userName){

	$link = mysql_connect("localhost", "root", "");
	mysql_select_db("sdmiotpro", $link);

	$result = mysql_query("SELECT * FROM user where Username='$userName'", $link);
	$num_rows = mysql_num_rows($result);

	return $num_rows;

}

function  getCount($servername,$username,$password,$dbname){
	$link = mysql_connect($servername, $username, $password);
	mysql_select_db($dbname, $link);

	$result = mysql_query("SELECT * FROM user", $link);
	$num_rows = mysql_num_rows($result);

	return $num_rows;

}
?>
