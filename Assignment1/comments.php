<?php
	session_start();

	include("database.php");
	include("functions.php");

	$PID = $_POST["PID"];
	$UID = $_POST["UID"];
	$content = $_POST["comment"];

	$conn = connect_db();

	if($conn)
	{
		$result = mysqli_query($conn, "SELECT * FROM users WHERE id= '$UID'");

		$row = mysqli_fetch_assoc($result);
		$name = $row["Name"];

		$PID = sanitizeString($conn, $PID);
		$UID = sanitizeString($conn, $UID);
		$content = sanitizeString($conn, $content);
		$name = sanitizeString($conn, $name);
		
		$result_insert = mysqli_query($conn, "INSERT INTO comments(PID, content, UID, name) VALUES ('$PID', '$content', '$UID', '$name')");

		if($result_insert)
		{
			header("Location: feed.php");
			exit();
		}
		else
		{
			echo "Oops! Something went wrong! Please try again!";
			//echo mysqli_error($conn);
		}
	}

?>