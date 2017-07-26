<?php

error_reporting(0);

$values = $_GET['S'];
$userId=$_GET['U'];


delete($userId);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sdmiotpro";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO `sensorvalues`(`userId`, `Value`) VALUES ('$userId','$values')";

if (mysqli_query($conn, $sql)) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);




function delete($userId){
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

	// sql to delete a record
	$sql = "delete from sensorvalues where userId = '$userId' ";

	if ($conn->query($sql) === TRUE) {
			
	} else {
			
	}

	$conn->close();
}

?>