<?php
session_start();
?>

<?php
$user=$_SESSION["User Name"];
$allSensorValue=getSensorValue($user);

$decryptSenValue=getSensorValueDecrypted($allSensorValue);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sdmiotpro";
$conn1 = mysql_connect($servername, $username,$password);
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$phValue=$_POST['phvalue'];



if($allSensorValue!="null"){
	$PHPvalue=$decryptSenValue[0];
	$Moisture=$decryptSenValue[1];
	$Temerature=$decryptSenValue[2];
	$Humidity=$decryptSenValue[3];
}else{
	$PHPvalue="0";
	$Moisture="0";
	$Temerature="0";
	$Humidity="0";
}

$cobmValue=$phValue."-".$Moisture."-".$Temerature."-".$Humidity;

$userId=getUserId($user);
$funValue=checkUser($cobmValue,$conn1,$dbname,$userId);

echo $cobmValue;

header("location: $funValue");

function checkUser($pageTitle,$conn,$dbname,$userId){

	$count=0;
	$sql="UPDATE `sensorvalues` SET `Value`='$pageTitle' where userId= '$userId'";
	$returnvalue="events.php";
	mysql_select_db($dbname, $conn);

	$result = mysql_query($sql, $conn);

	return "homeNew.php";

}


function getSensorValueDecrypted($allSensorValue){
				if($allSensorValue!="null"){
					$pieces = explode("-", $allSensorValue);
				}else{
					$pieces="null";
				}
				return $pieces;
			}
			
			function getSensorValue($user)
			{
				$userId=getUserId($user);
				$sensorValue="null";
				$servername = "localhost";

				$username = "root";
				$password = "";
				$dbname = "sdmiotpro";
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				$sql = "SELECT `Value` FROM `sensorvalues` WHERE `userId` ='$userId'";
				$result = $conn->query($sql);


				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						$sensorValue=$row["Value"];
					}
				} else {

				}
				$conn->close();
				return $sensorValue;

			}
			
			function getUserId($user)
			{
				$userId="null";

				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "sdmiotpro";
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				$sql = "SELECT  `userId` FROM `user` WHERE Username ='$user'";
				$result = $conn->query($sql);


				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						$userId=$row["userId"];
					}
				} else {

				}
				$conn->close();
				return $userId;

			}
			
?>
