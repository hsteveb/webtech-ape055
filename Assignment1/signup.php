<?php
	session_start();
	
	include("database.php");
	include("functions.php");

	//Get Sign up info from POST
	$name = $_POST["Name"];
	$birthday = $_POST["Birthday"];
	$gender = $_POST["Gender"];
	$username = $_POST["Username"];
	$password = $_POST["Password"];
	$verificationquestion = $_POST["VerificationQuestion"];
	$verificationanswer = $_POST["VerificationAnswer"];
	$email = $_POST["Email"];
	$location = $_POST["Location"];
	$profilepic = $_POST["ProfilePic"];


	$conn = connect_db();

	if($conn)
	{
		$name = sanitizeString($conn, $name);
		$birthday = sanitizeString($conn, $birthday);
		$gender = sanitizeString($conn, $gender);
		$username = sanitizeString($conn, $username);
		$password = sanitizeString($conn, $password);
		$verificationquestion = sanitizeString($conn, $verificationquestion);
		$verificationanswer = sanitizeString($conn, $verificationquestion);
		$email = sanitizeString($conn, $email);
		$location = sanitizeString($conn, $location);
		$profilepic = sanitizeString($conn, $profilepic);

		$hash = password_hash($password, PASSWORD_DEFAULT);
		$result_insert = mysqli_query($conn, "INSERT INTO users(Username, Password, Name, email, dob, gender, verification_question, verification_answer, location, profile_pic) VALUES ('$username', '$hash', '$name', '$email', '$birthday', '$gender', '$verificationquestion', '$verificationanswer', '$location', '$profilepic')");
		if($result_insert)
		{
			//redirect to feed page 
			header("Location: login.html");
			exit();
		}
		else
		{
			echo "Oops! Something went wrong! Please try again! <br>";
			//echo mysqli_error($conn);
		}
	}

?>