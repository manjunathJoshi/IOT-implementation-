<?php
session_start();
?>

<?php
$user=$_SESSION["User Name"];
$allSensorValue=getSensorValue($user);

$decryptSenValue=getSensorValueDecrypted($allSensorValue);


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


?>
<html>
<head>
<meta charset="UTF-8">
<title>Simple login form</title>

<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="css/style_home.css">

<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="js/Custom_js.js"></script>

<style type="text/css">
.eachPlant{
	width: 36em;
	height: 3em;
	background-color: #4478a0;
}
</style>
</head>

<body>
	<div class="UserName">
		<h3>
			Hi,
			<?php echo  $_SESSION["User Name"] ?>
			<Br> <Br>Your Sensor values are here
		</h3>
	</div>
	<div class="dropdown">
		<button class="dropbtn">
			<b>MENU</b>
		</button>
		<div class="dropdown-content">
		<?php if (getAdminInfo($user)==1){echo  "<a href='addPlants.php'>Plants</a>";}  ?>	 <a href="downloadProgram.php">Program</a> <a
				href="homeNew.php">Home</a><a href="updatePh.php">PH Value</a><a href="Login.php">Logout</a>
		</div>
	</div>

	<div class="phpLevel">
		<center>
			<br> <img src="images/ph.png" height=100px " width="100px"><br> PH
			LEVEL<br> <br> <br>
			<?php echo $PHPvalue?>

		</center>
	</div>
	<div class="moisture">
		<center>
			<br> <img src="images/moisture1.png" height=100px " width="80px"><br>MOISTURE<br>
			<br> <br>

			<?php echo $Moisture?>
			%
		</center>
	</div>
	<div class="humidity">
		<center>
			<br> <img src="images/humidity1.png" height=100px " width="100px"><br>
			HUMIDITY<br> <br> <br>

			<?php echo $Humidity?>
			%
		</center>
	</div>
	<div class="temerature">
		<center>
			<br> <img src="images/temp2.png" height=100px " width="100px"><br>
			TEMPERATURE<br> <br> <br>
			<?php echo $Temerature ?>
			C

		</center>
	</div>

	<div class="plantContainer">
		<center>
			<br>
			<h3>Soil Suit for below plants</h3>
			<br>
			<hr>
			
		</center>
		
		<?php // Create connection
	$conn = new mysqli("localhost","root", "", "sdmiotpro");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT `category`, `plantName` FROM `plants` WHERE `tempFrom` < '$Temerature' and `tempTo` > '$Temerature' and `HumidityFrom` < '$Humidity' and `HumidityTo` > '$Humidity' and `MoistureFrom` < '$Moisture' and `MoistureTo` > '$Moisture' and `PHPFrom` < '$PHPvalue' and `PHPTo` > '$PHPvalue'";
	
	$result = $conn->query($sql);


	
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$cat=$row['category'];
			$plant=$row['plantName'];
			echo " <div class='eachPlant'>";
			echo "&emsp; &emsp;&emsp;&emsp; Category : $cat &emsp; &emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Plant Name : $plant";
		 
		 	echo "</div><hr>";
		}
	} else {

	}?>
		
			 
		
	</div>
</body>
</html>

			<?php
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

			function getSensorValueDecrypted($allSensorValue){
				if($allSensorValue!="null"){
					$pieces = explode("-", $allSensorValue);
				}else{
					$pieces="null";
				}
				return $pieces;
			}

function getAdminInfo($user)
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

				$sql = "SELECT  `admin` FROM `user` WHERE Username ='$user'";
				$result = $conn->query($sql);


				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						$userId=$row["admin"];
					}
				} else {

				}
				$conn->close();
				return $userId;

			}
?>