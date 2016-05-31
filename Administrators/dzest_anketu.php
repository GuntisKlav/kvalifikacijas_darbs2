<?php 
$con = mysqli_connect("localhost", "root", "qrwe1432", "mountain_maniacs");

$dzests_id = $_GET['dzest1'];

$query = "DELETE FROM pieteiksanas_anketa WHERE anketas_id = '$dzests_id'";


if (mysqli_query($con, $query)) {
echo 
"<script>window.open('admin_pieteikumi.php?dzest1=Anketa ir izdzēsta!', '_self')</script>";

}


?>