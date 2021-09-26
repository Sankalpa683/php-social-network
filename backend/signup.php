<?php 

include 'db.php';

if (isset($_POST['create'])) {
	$username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username']));
	$password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password']));
	$email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
	$followers = 0;
	$following = 0;
	$ip = $_SERVER['REMOTE_ADDR'];

	$select = "SELECT * FROM `users` WHERE email='$email'";
	$queries = mysqli_query($conn, $select);
	if (mysqli_num_rows($queries) > 0) {
		header("location: ../signup.php?err=alreadyexistemail");
	}
	else{
		$insert = "INSERT INTO `users` (`name`, `password`, `email`,`ip`) VALUES ('$username', '$password', '$email','$ip');";
		$query = mysqli_query($conn, $insert);

		if ($query) {
			header("location: ../index.php");
		}
		else{
			header("location: ../signup.php");
		}
	}
}
else{
	header("location: ../signup.php");
}
?>