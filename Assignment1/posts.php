<?php
	
	session_start();

	include("database.php");
	include("functions.php");


	//Get data from the form
	$content = $_POST['content'];
	$UID = $_POST['UID'];

	//connect to DB
	$conn = connect_db();
	if($conn)
	{
		$result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$UID'");
		$row = mysqli_fetch_assoc($result);

		//Fetch User information	
		$name = $row["Name"];
		$profile_pic = $row["profile_pic"];

		$content = sanitizeString($conn, $content);
		$UID = sanitizeString($conn, $UID);
		$name = sanitizeString($conn, $name);
		$profile_pic = sanitizeString($conn, $profile_pic);

		$result_insert = mysqli_query($conn, "INSERT INTO posts(content, UID, name, profile_pic, likes) VALUES ('$content', $UID, '$name', '$profile_pic', 0)");

		//check if insert was okay
		if($result_insert)
		{
			//redirect to feed page 
			header("Location: feed.php");
			exit();
		}
		else
		{
			//throw an error	
			echo "Oops! Something went wrong! Please try again!";
		}
	}
 
?>