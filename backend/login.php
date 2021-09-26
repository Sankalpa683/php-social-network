<?php 
session_start();

include 'db.php';

if (isset($_POST['login'])) {
	$email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
	$password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password']));

	$select = "SELECT * FROM `users` WHERE email='$email' AND password='$password'";
	$query = mysqli_query($conn, $select);
	if (mysqli_num_rows($query) > 0) {
		$_SESSION['user_logged'] = $email;
		header("location: ../home.php");
	}
	else{
		header("location: ../index.php?err=wrong");
	}
}
else{
	header("location: ../index.php");
}

?>