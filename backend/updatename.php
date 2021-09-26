<?php 
include 'db.php';
session_start();
$logged = $_SESSION['user_logged'];

if ($logged) {
	$select = "SELECT * FROM `users` WHERE email='$logged'";
	$query = mysqli_query($conn,$select);
	while ($res = mysqli_fetch_assoc($query)) {
		$id = $res['id'];
		$name = $res['name'];
	}
}
else{
	header("location: index.php");
}

$newname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['newname']));
$updates = "UPDATE `posts` SET `user_name`='$newname' WHERE user_name='$name';";
$queries = mysqli_query($conn, $updates);
if ($queries) {
	$update = "UPDATE `users` SET `name`='$newname' WHERE id='$id'";
	$query = mysqli_query($conn, $update);
	if ($query) {
		echo "Done";
	}
	else{
		echo "Fuck you";
	}
}
else{
	echo "Fuck you!";
}
	
?>