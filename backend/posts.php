<?php 
include 'db.php';
session_start();
$logged = $_SESSION['user_logged'];

if ($logged) {
	$select = "SELECT * FROM `users` WHERE email='$logged'";
	$query = mysqli_query($conn,$select);
	while ($res = mysqli_fetch_assoc($query)) {
		$name = $res['name'];
	}
}
else{
	header("location: ../index.php");
}

if (isset($_POST['post'])) {
	$posts = mysqli_real_escape_string($conn, htmlspecialchars($_POST['posts']));
	if (empty($posts)) {
		header("location: ../post.php?err=");
	}else{
		$ips = $_SERVER['REMOTE_ADDR'];
		$insert = "INSERT INTO `posts` (`user_name`, `user_post`, `ip`) VALUES ('$name', '$posts', '$ips');";
		$queries = mysqli_query($conn, $insert);

		if ($queries) {
			header("location: ../home.php");
		}
		else{
			header("location: ./post.php");
		}
	}
}

?>