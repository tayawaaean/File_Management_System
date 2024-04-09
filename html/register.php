<?php
	$name = $_POST['name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// Database connection
	$conn = new mysqli('localhost','root','','file_management_system_bingao');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into users(name, email, username, password) values(?, ?, ?, ?)");
		$stmt->bind_param("ssss", $name, $email, $username, $password);
		$execval = $stmt->execute();
		echo $execval;
		$stmt->close();
		$conn->close();
	}
?>



