<?php 
$con = mysqli_connect("localhost", "root", "qrwe1432", "mountain_maniacs");

$dzest_id = $_GET['dzesana'];

$query = "DELETE FROM jaunumi WHERE jaun_id = '$dzest_id'";


if (mysqli_query($con, $query)) {
echo 
"<script>window.open('jaunumi.php?dzests=ieraksts ir dzests', '_self')</script>";

}


?>