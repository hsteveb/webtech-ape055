<?php
		
	include("database.php");
	//start session
	session_start();	
	//get username and password from $_POST

	$username = $_POST["username"];
	$password = $_POST["password"];

	$conn = connect_db();

	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

	$num_of_rows = mysqli_num_rows($result);
	//Check in the DB
	if($num_of_rows > 0){


		$row = mysqli_fetch_assoc($result);
		if(password_verify($password, $row["Password"]))
		{
			//If authenticated: say hello!
			$_SESSION["username"] = $username;
			header("Location: feed.php");
			exit();
		}
		else
		{
			//else ask to login again..	
			echo "Invalid username/password! Try again!";
		}
	}

?>