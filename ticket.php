<?php
if (!session_id()) {
	session_start();
}
include 'connect.php'; ?>
<!DOCTYPE html>
<html>

<head>
	<title>Ticket</title>	
	<link href="css/style.css" rel="stylesheet">
  	<link href="css/main.css" rel="stylesheet">  	
</head>

<body>
	<?php include_once 'header.php'; ?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12  toppad">
				<div class="panel panel-info" style="margin-top:3%;">
					<div class="panel-heading">
						<h3 class="panel-title">
							<?php
							$movieId = $_POST['movieId'];
							$_SESSION['movieId'] = $movieId;
							$res = $conn->query("select * from movielist where movieId=$movieId;");
							$row = $res->fetch_object();

							echo "" . $row->Name; ?>
						</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-4 col-lg-4 " align="center">
								<img alt="User Pic" src=<?php echo '"images/' . $row->image . '"'; ?> class=" img-responsive">
							</div>
							<div class=" col-md-8 col-lg-8 ">
								<table class="table table-user-information">
									<tbody>
										<tr>
											<td><strong>Movie Name </strong></td>
											<td><?php echo "" . $row->Name; ?> </td>
										</tr>
										<tr>
											<td><strong>Genre</strong></td>
											<td> <?php echo "" . $row->Genre; ?> </td>
										</tr>
										<tr>
											<td><strong>Director</strong></td>
											<td><?php echo "" . $row->Director; ?> </td>
										</tr>
										<tr>
										<tr>
											<td><strong>IMDB</strong></td>
											<td><?php echo "" . $row->imdb; ?> </td>
										</tr>
										<tr>
											<td><strong>Description</strong></td>
											<td><?php echo "" . $row->Description;	?> </td>
										</tr>



										<form action="Checkout.php" method="post">

											<tr>
												<td><strong>Date</strong></td>
												<td><input class="boxStyle" type="date" name="date"></td>
											</tr>
											<tr>

												<td><strong>Show Time</strong></td>
												<td> <select name="timeSlot" class="boxStyle">
														<?php $timeSlot = $conn->query("select time from timeslot");
														while ($showTime = $timeSlot->fetch_object()) {

															echo " <option value='" . $showTime->time . "'>" . $showTime->time . "</option>
															";
														} ?>
													</select></td>
											</tr>
											<tr>
												<td><strong>Theater</strong></td>
												<td>
													<select name="theater" class="boxStyle">
														<?php $resourse = $conn->query("select theaterName from theater");
														while ($theater = $resourse->fetch_object()) {

															echo " <option value='" . $theater->theaterName . "'>" . $theater->theaterName . "</option>
																";
														} ?>
												</td>
											</tr>
											<tr>
												<td colspan="2" width="100%">
													<input class="btn btn-primary btn-xs btn-block" type="submit" name="submit" value="Buy Ticket">
												</td>
											</tr>
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