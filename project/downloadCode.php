<?php
session_start();

$user=$_SESSION["User Name"];
$ipAddress=$_POST['ipAddress'];
$portName=$_POST['portName'];
$userId=getUserId($user);

$path_to_file = 'program.txt';
$store_file_to='ArdunioCode.txt';
$file_contents = file_get_contents($path_to_file);
$file_contents = str_replace('${IPADDRESS}',$ipAddress,$file_contents);
$file_contents = str_replace('${YOURPCPORT}',$portName,$file_contents);
$file_contents = str_replace('${USEDIDFROMDATABASE}',$userId,$file_contents);
file_put_contents($store_file_to,$file_contents);

header("location: $store_file_to");

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