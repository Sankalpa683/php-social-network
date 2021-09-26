<?php 
include 'backend/db.php';
session_start();
$ids = mysqli_real_escape_string($conn, htmlspecialchars($_GET['id']));
$logged = $_SESSION['user_logged'];

if ($logged) {
	$select = "SELECT * FROM `users` WHERE email='$logged'";
	$query = mysqli_query($conn,$select);
	while ($res = mysqli_fetch_assoc($query)) {
		$name = $res['name'];
	}
}
else{
	header("location: index.php");
}

$sql = "SELECT * FROM `users` WHERE id='$ids'";
$run = mysqli_query($conn, $sql);

if (mysqli_num_rows($run) > 0) {
	while ($code = mysqli_fetch_assoc($run)) {
		$username = $code['name'];
		$useremail = $code['email'];

		if ($username == $name && $useremail == $logged) {
			header("location: profile.php");
		}
		else{
			
		}
	}
}
else{
	header("location: 404.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sociobook - Profile</title>
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<!-- navbar starts -->
	<div class="nav">
		<h2 style="float: left; margin-left: 28px; font-size: 25px; cursor: pointer;" class="social">Sociobook</h2>
		<div class="search">
			<form action="search.php" method="get">
				<input type="search" placeholder="Type here to search...." name="search">
			</form>
			<a href="search.php" id="search"><i class="fa fa-search"></i></a>
		</div>
		<div class="user">
			<a href="logout.php" alt="go back">Logout</a>
		</div>
	</div>
	<!-- navbar ends -->
	<!-- profile box starts -->
	<div class="profiles">
		<center><img src="img/profile.jpg" alt="profile"></center>
		<h2><?php echo "<h2 class='username'>$username</h2>"?></h2><hr>
		<h3><?php echo $useremail?></h3>
	</div>
	<!-- profile box ends -->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	$(document).ready(function(){
		$('.social').click(function(){
			window.location.href = "home.php";
		});
	});
</script>
</html>