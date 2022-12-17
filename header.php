<?php 
if (!session_id()) {
	session_start();
} 
include 'connect.php';
if (empty($_SESSION['user'])) {
	header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
</head>
<body>

	<div class="header" style="background-color:grey;">
		<div class="header-top-strip">
			<div class="container" style="background-color:grey;">
				<div class="header-top-left">
					<ul>
						<?php 
						$userId=$_SESSION['user'];
						$res=$conn->query("select * from user where userId='$userId';");
						$row=$res->fetch_object();

						echo "
						
						<li ><a href='#'><span class='glyphicon glyphicon-user' style='font-size:24px'> </span>". strtoupper($row->userName)."</a></li>"
						
						?>
					</ul>
				</div>
				<div class="header-right">
					<div class="cart box_1">
						<a style="color:white;font-size:24px" href="logout.php"> Logout </a>	
						
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>


