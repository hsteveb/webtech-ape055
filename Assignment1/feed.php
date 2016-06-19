<!DOCTYPE html>
<html>
<head>
	<title>MyFacebook Feed</title>
</head>
<body>
<?php
	include('database.php');
	
	session_start();

	$conn = connect_db();

	$username = $_SESSION["username"];
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

	//user information 
	$row = mysqli_fetch_assoc($result);
	$UID = $row[id];

	echo "<h1>Welcome back ".$row['Name']."!</h1>";
	echo "<img src='".$row['profile_pic']."'>";
	echo "<hr>";

	echo "<form method='POST' action='posts.php'>
	<p><textarea name='content'>Say something...</textarea></p>
	<input type='hidden' name='UID' value='$UID'>
	<p><input type='submit' value='Submit'></p></form>";
	echo "<br>";

	$result_posts = mysqli_query($conn, "SELECT * FROM posts");
	$num_of_rows = mysqli_num_rows($result_posts);

	$result_comments = mysqli_query($conn, "SELECT * FROM comments");
	$comment_rows = mysqli_num_rows($result_comments);

	echo "<h2>My Feed</h2>";
	if ($num_of_rows == 0) {
		echo "<p>No new posts to show!</p>";
	}

	//show all posts on myfacebook
	for($i = 0; $i < $num_of_rows; $i++){

		$row = mysqli_fetch_row($result_posts);
		echo "$row[2] said $row[4] ($row[5])";
		echo "<form action='likes.php' method='POST'> 
		<input type='hidden' name='PID' value='$row[0]'> 
		<input type='submit' value='Like'></form>";
		echo "<br>";

		$result_comments = mysqli_query($conn, "SELECT * FROM comments");
		for($j = 0; $j < $comment_rows; $j++)
		{
			$commentrow = mysqli_fetch_row($result_comments);


			if($row[0] == $commentrow[1])
			{
				echo "$commentrow[4]: $commentrow[2] <br>";
			}
		}
		echo "<form action='comments.php' method='POST'>
		<p><textarea name='comment'>Comment on this post!</textarea>
		<input type='hidden' name='PID' value='$row[0]'>
		<input type='hidden' name='UID' value='$UID'>
		<input type='submit' value='Submit'></p>
		</form>";
	}
?>

</body>
</html>
