<?php
session_start();

?>

<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "speed_vehicle";
	

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT  `Sesor1`,`Sesor2`, `Sesor3`, `Sesor4` FROM `sensor` order by Sesor1 DESC;";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$id=$row["Sesor1"];
			$temp=$row["Sesor3"];
			$moisture=$row["Sesor4"] ;
			$humidity=$row["Sesor2"] ;
		}
	} else {

	}?>



<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<style type="text/css">
div.humidity{
	position: relative;

	width: 1300px;
	height: 300px;
	background-color: #778899;
}

</style>
</head>
<body>
	<div class="topbar" id=" class="topbar">
		<ul>
			<center><h1>Agriculture Automation</h1></center> 
		</ul>
	</div>
<center><img src="images/logo.jpg" height="300px" width="1300px"></center>

<center><div class="humidity" id="humidity">

<center><table>
<tr><td><center><h4>PH Level</h4></center></td><td><center><h4>Soil Humidity</h4></center></td><td><center><h4>Temperature</h4></center></td><td><center><h4>Moisture</h4></center></td></tr>

<tr><td><center><h4><?php echo $id ?> %</h4></center></td><td><center><h4><?php echo $humidity ?> %</h4></center></td><td><center><h4><?php echo $temp ?></h4></center></td><td><center><h4><?php echo $moisture?></h4></center></td></tr>
</table></center>



</div></center>

<form action="a.php">

<input type="text" required="required">
<input type="submit" >
</form>

</body>
</html>

