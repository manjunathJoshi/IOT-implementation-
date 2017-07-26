<?php
session_start();
?>
<html>
<head>
<meta charset="UTF-8">
<title>Simple login form</title>

<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="css/style_home.css">
<link rel="stylesheet" href="css/style_Login.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="js/Custom_js.js"></script>
<style type="text/css">
.download{
    background-color: #9F8420   ;
    color: white;
    width: 200px;
	height: 60px;
    border: none;
    border-radius: 8px;
    border: 2px solid black;
    cursor: pointer;
}

.download:hover {
    background-color: #FC1A08  ; /* Green */
    color: white;
}

</style>
</head>

<body>
	<div class="UserName">
		<h3>
			Hi,
			<?php 
			echo  $_SESSION["User Name"] 
			
			?>
			<Br> <Br>Want Arduino Code ?
		</h3>
	</div>
	<div class="dropdown">
		<button class="dropbtn"><b>MENU</b></button>
		<div class="dropdown-content">
			<?php if (getAdminInfo($_SESSION["User Name"])==1){echo  "<a href='addPlants.php'>Plants</a>";}  ?>	<a href="downloadProgram.php">Program</a> 
			<a href="homeNew.php">Home</a><a href="updatePh.php">PH Value</a><a href="Login.php">Logout</a>
		</div>
	</div>
	<br>
	
	<div class="addPlants">
	<br>
	<br>
	<center>Please fill below details to get Ardunio Code</center>
	<hr>
	<br>
	<form method="post" action="downloadCode.php">
	IP ADRESS &emsp;&nbsp; : <input type="text" name="ipAddress" required="required" class="addPlant-text" /><br>
	PORT NAME &nbsp; : <input type="text" name="portName" required="required" class="addPlant-text" />
    <br><br><br>
    
    <center><button type="submit" class="download" >DOWNLOAD </button></center>
    </form>
    </div>
	</body>
	</html>
	
	
	<?php 
	
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