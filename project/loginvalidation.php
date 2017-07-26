
<?php
session_start();
?>
<?php

$usernameToCheck=$_POST['user'];
$passwordToCheck=$_POST['password'];

$funValue=checkUser($usernameToCheck,$passwordToCheck);

$_SESSION["User Name"]=$usernameToCheck;

header("location: $funValue");

function checkUser($user,$pass){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "sdmiotpro";
	$count=0;
	$sql="SELECT * FROM `user` WHERE Username='$user' and password='$pass';";
	$returnvalue="Vehicle/index.php";

	$link = mysql_connect("localhost", "root",$password);
	mysql_select_db("sdmiotpro", $link);

	$result = mysql_query($sql, $link);
	$num_rows = mysql_num_rows($result);

	


	// If result matched $username and $password, table row must be 1 row
	if ($num_rows==1) {
		$returnvalue="homeNew.php";
	
	} else {
		$returnvalue="Login.php";
		$_SESSION['ERRMSG_ARR'] = "Invalid Credentials ,Please try again..";
		session_write_close();
	}
	return $returnvalue;

}
?>
