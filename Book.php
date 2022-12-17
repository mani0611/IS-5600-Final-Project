<?php 
if (!session_id()) {
	session_start();
} 
include 'connect.php';


$seat=$_POST['seat']-1;

$sql="update showOrder set seat=".$seat." where showOrderId=".$_POST['showOrderId'].";";
if ($conn->query($sql) === TRUE) {
	$_SESSION['msg']="Ticket Booked";
}
else{
	echo "Error: " . $sql . "<br>" . $conn->error;
}

header('Location: home.php')
?>