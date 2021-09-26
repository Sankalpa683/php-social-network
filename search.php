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
	<title>Sociobook - Search Results</title>
	<link rel="stylesheet" type="text/css" href="css/search.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
	<!-- Add icon library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<!-- navbar starts -->
	<div class="nav">
		<h2 style="float: left; margin-left: 28px; font-size: 25px;" class="logo">Sociobook</h2>
		<div class="search">
			<a href="search.php" id="search"><i class="fa fa-search"></i></a>
			<a href="profile.php" id="user"><i class="fa fa-user"></i></a>
		</div>
		<div class="user">
			<a href="profile.php" alt="profile"><img src="img/profile.jpg"></a>
		</div>
	</div>
	<!-- navbar ends -->
	<!-- result fetching starts -->
	<div class="fetch">
		<?php 
			$search = htmlspecialchars($_GET['search']);
			$filter = "SELECT * FROM `users` WHERE email LIKE '%$search%'";
			$run = mysqli_query($conn, $filter);
			if (empty($search)) {
				header("location: home.php");
			}
			else{
				if ($row = mysqli_num_rows($run) > 0) {
					echo '<h2>Search Results for '.$search.'</h2>';
				}
				else{
					echo '<h2>No User Found</h2>';
				}
				while ($rows = mysqli_fetch_assoc($run)) {
					$ress = $rows['name'];
					$ids = $rows['id'];

					echo '
						<div class="newsfeed">
							<a href="userview.php?id='.$ids.'"><img src="img/profile.jpg"><strong>'.$ress.'</strong></a>
						</div>
						<br><br>
					';
				}
			}
		?>
	</div>
	<!-- result fetching ends -->
</body>
</html>