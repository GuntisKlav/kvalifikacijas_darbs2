<?php 
$con = mysqli_connect("localhost", "root", "qrwe1432", "mountain_maniacs");

$dzest_id = $_GET['dzest'];

$query = "DELETE FROM lietotaji WHERE id = '$dzest_id'";


if (mysqli_query($con, $query)) {
echo 
"<script>window.open('skatit_lietotajus.php?dzests=lietotajs ir dzests', '_self')</script>";

}


?>