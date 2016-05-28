<?php 
$con = mysqli_connect("localhost", "root", "qrwe1432", "mountain_maniacs") or die("Nevar pieslēgties datubāzei!");
if (isset($_GET['ieraksta_id'])) {
	global $con;
	$ier_id = $_GET['ieraksta_id'];

	$izdzest_ierakstu = "DELETE FROM ieraksti WHERE ieraksta_id = '$ier_id'";

	$sakt_dzesanu = mysqli_query($con, $izdzest_ierakstu);

	if ($sakt_dzesanu) {
	echo "<script>alert('Ieraksts ir izdzēsts!')</script>";
		echo "<script>window.open('../home.php', '_self')</script>";
	}
}



?> 