<?php 
session_start();
if (isset($_SESSION['user_logged'])) {
	header("location: home.php");
}
else{

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>SankizTime - Signup</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/signup.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
</head>
<body>

</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</html>
<?php 

if (isset($_GET['err'])) {

	echo "<script>swal('E-mail already existed','','error');
</script>";
}
else{

}

?>
<body>
<div class="header">
	<div class="nav">
		<h2 style="float: left; margin-left: 28px; font-size: 25px;">Sociobook</h2>
	</div>
	<div class="main">
		<form action="backend/signup.php" method="post">
			<h2>Sign up for free</h2>
			<input type="text" class="username" placeholder="Username" name="username" required=""><br>
			<input type="password" class="password" placeholder="Password" name="password" required=""><br>
			<input type="email" class="number" placeholder="E-Mail address" name="email" required=""><br>
			<button name="create">Create</button> 
			<p>Already have an account <a href="index.php">login here</a></p>
		</form>
	</div>
	
</div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>