<?php
$phLevel=$_POST['ph'];
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

}

echo $phLevel;
echo $id;
echo $temp;
echo $moisture;
echo $humidity;

$url='https://futuregentech.000webhostapp.com/test.php?field='.$humidity.'&value='.$temp.'&value1='.$moisture.'&value2='.$phLevel;
header("location: $url");
?>
