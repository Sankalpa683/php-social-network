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
		<h2 style="float: left; margin-left: 28px; font-size: 25px;">Sociobook</h2>
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
		<center><h2><?php echo $name?> &nbsp;&nbsp; <a id="edit"><i class="fa fa-edit"></i></a></h2></center>
	</div>
	<div class="modal">
		<center>
			<input type="text" placeholder="Name..." id="newname"><button class="save">Save</button><br>
			
		</center>
	</div>
	<br><hr width="50%">
	<!-- profile box ends -->
	<!-- recently joined starts -->
	<div class="recents">
		<h1><b>Recently Joined</b></h1>
		<?php 
			$datas = "SELECT * FROM `users` ORDER BY 1 DESC LIMIT 5";
			$queried = mysqli_query($conn, $datas);
			while ($rowss = mysqli_fetch_assoc($queried)) {
				$naam = $rowss['name'];
				$idds = $rowss['id'];
				echo "<a href='userview.php?id=$idds'><p>".$naam."</p></a><hr>";
			}
		?>
	</div>
	<!-- recently joined ends -->
	<!-- recents posts starts -->
	<div class="recentspost">
		<div class="newfeed">
			<?php 
				$data = "SELECT * FROM `posts` WHERE user_name='$name'";
				$result = mysqli_query($conn, $data);
				if ($rows = mysqli_num_rows($result) > 0) {
					while ($rep = mysqli_fetch_assoc($result)){
					$user_name = $rep['user_name'];
					$user_post = $rep['user_post'];

					echo '<div class="newsfeed">
							<a><img src="img/profile.jpg"><strong>'.$user_name.'</strong><a class="edits"><i class="fa fa-edit" id="dot"></i></a></a>
							<b><p style="overflow-wrap: break-word;">'.$user_post.'</p></b>
						</div>';
					}
				}
				else{
					echo "<b>You haven't posted anything yet <a href='post.php' style='color: blue'>Post now!</a></b>";
				}
			?>
		</div>
		<br><br>
	</div>
	<!-- recents posts ends -->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	$(document).ready(function(){
		// change name options
		$('#edit').click(function(){ 
			$(".profiles").css("z-index","100", "background","rgba(0,0,0,0.7)");
			$(".modal").css("display","block");
		});
		$('.save').click(function(){
			var newname = $("#newname").val();
			var save = $('.save'); 

			if (newname == "") { 
				swal("Please! Enter your name");
			}else{
				$.ajax({
					url: 'backend/updatename.php',
					type: 'POST',
					data: "newname="+newname,
					success:function(e){
						location.reload();
						$(".modal").css("display","none");
						$(".profiles").css("display","block");
					}

				});
			}
		});
	});
</script>
</html>
