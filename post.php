<?php 
include 'backend/db.php';
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
	header("location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sociobook - Create Post</title>
	<link rel="stylesheet" type="text/css" href="css/post.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
	<!-- navbar starts -->
	<div class="nav">
		<h2 style="float: left; margin-left: 28px; font-size: 25px;">Sociobook</h2>
		<div class="search">
			<form action="search.php" method="get">
				<input type="search" placeholder="Type here to search...." name="search">
			</form>
			<a href="search.php" id="search"><i class="fa fa-search"></i></a>
			<a href="profile.php" id="user"><i class="fa fa-user"></i></a>
		</div>
		<div class="user">
			<a href="profile.php" alt="profile"><img src="img/profile.jpg"></a>
		</div>
	</div>
	<!-- navbar ends -->
	<?php 
		if (isset($_GET['err'])) {
			echo "<script>swal('Please add something','','error');
		</script>";
		}
		else{

		}
	?>
	<!-- posts box starts -->
	<div class="posts">
		<form action="backend/posts.php" method="post">
			<center><b>Create Post</b></center><br>
			<hr><br>
			<a href="profile.php" target="_blank"><img src="img/profile.jpg"><strong><?php echo $name?></strong></a><br><br>
			<input type="text" placeholder="Write Something...." name="posts"><br><br>
			<button name="post">Post</button>
		</form>
	</div>
	<!-- posts box ends -->
</body>
</html>