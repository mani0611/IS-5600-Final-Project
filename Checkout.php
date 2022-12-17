<?php 
if (!session_id()) {
	session_start();
} 
include 'connect.php';
include_once 'header.php'; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	<link href="css/style.css" rel="stylesheet">
  	<link href="css/main.css" rel="stylesheet">  	
</head>
<body>
	<?php 
	$movieId=$_SESSION['movieId'];

	$movieIdentity=$conn->query("select * from movielist where movieId=$movieId;");
	$row=$movieIdentity->fetch_object();
	$movieName=$row->Name;
	$date=$_POST['date'];
	$time=$_POST['timeSlot'];
	$theater=$_POST['theater'];
	$showOrder="";
	$seatCount="";

	$resourse=$conn->query("select date from showOrder;");
	$dateExists=false;
	while ($rw=$resourse->fetch_object()) {
		if ($rw->date===$date) {
			$dateExists=true;
			break;
		}
	}
	$seatCount="";

	if (!$dateExists) {
		$sql="INSERT INTO showOrder(showOrderId,date,timeslot,theater,movieName,seat)  VALUES ('','".$date."','". $time. "','".$theater."','".$movieName."',".'50'.");";



		if ($conn->query($sql) === TRUE) {
			$result=$conn->query("select showOrderId from showOrder where date='".$date."' and timeslot='".$time."' and theater='".$theater."' and movieName='".$movieName ."' ;");

			$r=$result->fetch_object();

			$showOrder=$r->showOrderId;//we will use this id to reduce seat

			$result=$conn->query("select seat from showOrder where showOrderId='".$showOrder."';");
			
			$r=$result->fetch_object();

			$seatCount=$r->seat;
			
		}else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	else{
		$resourse=$conn->query("select timeslot from showOrder where date='".$date."';");
		$timeExist=false;
		while ($rw=$resourse->fetch_object()) {
			if ($rw->timeslot===$time) {
				$timeExist=true;
				break;
			}
		}
		if (!$timeExist) {
			$sql="INSERT INTO showOrder(showOrderId,date,timeslot,theater,movieName,seat)  VALUES ('','".$date."','". $time. "','".$theater."','".$movieName."',".'50'.");";
			if ($conn->query($sql) === TRUE) {
				$result=$conn->query("select showOrderId from showOrder where date='".$date."' and timeslot='".$time."' and theater='".$theater."' and movieName='".$movieName ."' ;");
				$r=$result->fetch_object();
				$showOrder=$r->showOrderId;
				$result=$conn->query("select seat from showOrder where showOrderId='".$showOrder."';");
				$r=$result->fetch_object();
				$seatCount=$r->seat;

			}else{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}else{

			$resourse=$conn->query("select theater from showOrder where date='".$date."' and timeslot='".$time."';");
			$theaterExist=false;
			while ($rw=$resourse->fetch_object()) {
				if ($rw->theater===$theater) {
					$theaterExist=true;
					break;
				}
			}

			if (!$theaterExist) {
				$sql="INSERT INTO showOrder(showOrderId,date,timeslot,theater,movieName,seat)  VALUES ('','".$date."','". $time. "','".$theater."','".$movieName."',".'50'.");";
				if ($conn->query($sql) === TRUE) {
					$result=$conn->query("select showOrderId from showOrder where date='".$date."' and timeslot='".$time."' and theater='".$theater."' and movieName='".$movieName ."' ;");

					$r=$result->fetch_object();

				$showOrder=$r->showOrderId;

				$result=$conn->query("select seat from showOrder where showOrderId='".$showOrder."';");

				$r=$result->fetch_object();

				$seatCount=$r->seat;
			}

		}
		else{
			$resourse=$conn->query("select movieName from showOrder where date='".$date."' and timeslot='".$time."' and theater='".$theater."';");
			$movieExist=false;
			while ($rw=$resourse->fetch_object()) {
				if ($rw->movieName===$movieName) {
					$movieExist=true;
					break;
				}
			}
			if (!$movieExist) {
				$sql="INSERT INTO showOrder(showOrderId,date,timeslot,theater,movieName,seat)  VALUES ('','".$date."','". $time. "','".$theater."','".$movieName."',".'50'.");";
				if ($conn->query($sql) === TRUE) {
					$result=$conn->query("select showOrderId from showOrder where date='".$date."' and timeslot='".$time."' and theater='".$theater."' and movieName='".$movieName ."' ;");
					$r=$result->fetch_object();
				    $showOrder=$r->showOrderId;
				    $result=$conn->query("select seat from showOrder where showOrderId='".$showOrder."';");
				    $r=$result->fetch_object();
				    $seatCount=$r->seat;
			}
		}
		else{
			$result=$conn->query("select showOrderId from showOrder where date='".$date."' and timeslot='".$time."' and theater='".$theater."';");
			$r=$result->fetch_object();
			$showOrder=$r->showOrderId;
			$result=$conn->query("select seat from showOrder where showOrderId='".$showOrder."';");
			$r=$result->fetch_object();
			$seatCount=$r->seat;
			}
		}
	}
}

?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
			<div class="panel panel-info" style="margin-top:3%;">
				<div class="panel-heading">
					<h3 class="panel-title">
						<?php 
						echo "".$movieName;
						?>

					</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4 col-lg-4 " align="center">
							<img alt="User Pic" src=<?php echo '"images/'.$row->image.'"';?> class=" img-responsive"> 
						</div>
						<div class=" col-md-8 col-lg-8 "> 
							<table class="table table-user-information">
								<tbody>

									<tr>
										<td><strong>Date </strong></td>
										<td><?php echo "".$date ?> </td>
									</tr>
									<tr>
										<td><strong>Movie Name </strong></td>
										<td><?php echo "".$row->Name;?> </td>
									</tr>
									<tr>
										<td><strong>Time </strong></td>
										<td><?php echo "". $_POST['timeSlot']?></td>
									</tr>
									<tr>
										<td><strong>Movie Name </strong></td>
										<td><?php echo "". $_POST['theater']?></td>
									</tr>
									<tr>
										<td><strong>Seat Available </strong></td>
										<td><?php echo $seatCount;?> </td>
									</tr>
									<tr>
										<td><strong>Ticket Price </strong></td>
										<td> 300 </td>
									</tr>
									<form action="Book.php" method="post">
										<input type="hidden" name="showOrderId" value=<?php echo '"'.$showOrder.'"'; ?>>
										<input type="hidden" name="date" value=<?php echo '"'.$date.'"'; ?>>
										<input type="hidden" name="time" value=<?php echo '"'.$time.'"'; ?>>
										<input type="hidden" name="theater" value=<?php echo '"'.$theater.'"'; ?>>
										<input type="hidden" name="seat" value=<?php echo '"'.$seatCount.'"'; ?>>
										<tr>
											<td colspan="2" width="100%">
												<input class="btn btn-primary btn-xs btn-block" type="submit" name="submit" value="Confirm Ticket">
											</td>
										</td>
									</form>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    <!-- Footer -->
    <footer class="page-footer font-small blue">
        <div class="footer-copyright text-center py-3">© 2022 Copyright:
            <a href="/"> Movie Bookings</a>
        </div>
    </footer>
</body>

</html>
