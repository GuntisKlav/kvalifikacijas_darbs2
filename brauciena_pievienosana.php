<?php 
error_reporting('0');
include("Include/connection.php");

	


	if (isset($_POST['piete'])) {

		$id = mysqli_real_escape_string($con, $_POST['anketas_id']);
$brauceja_vards = mysqli_real_escape_string($con, $_POST['br_vards']);
$brauceja_uzvards = mysqli_real_escape_string($con, $_POST['br_uzvards']);
$br_tel = mysqli_real_escape_string($con, $_POST['tel_nr']);
$vecums = mysqli_real_escape_string($con, $_POST['vecums']);
$epasts = mysqli_real_escape_string($con, $_POST['br_epasts']);
$prasmes = mysqli_real_escape_string($con, $_POST['prasmes']);
$inv_noma = mysqli_real_escape_string($con, $_POST['noma']);
$komenti = mysqli_real_escape_string($con, $_POST['komentari']);


$get_id = "SELECT * FROM pieteiksanas_anketa WHERE anketas_id = '$id'";
$run_id = mysqli_query($con, $get_id);
$parbaude = mysqli_num_rows($run_id);
//$md5_parole = md5($parole);
if ($parbaude == 1) {
		//echo "Šad epasts jau ir reģistrēts!";
	exit();
}
else{

	$ievietot = "INSERT INTO pieteiksanas_anketa (anketas_id, brauceja_vards, brauceja_uzvards, telefona_nr, _brauceja_vecums, brauceja_epasts, prasmju_limenis, inventara_noma,  pieteiksanas_d, brauceja_komentari) VALUES ('', '$brauceja_vards', '$brauceja_uzvards', '$br_tel', '$vecums', '$epasts', '$prasmes', '$inv_noma', NOW(), '$komenti')";
	$palaist_ievietosanu = mysqli_query($con, $ievietot);

	//if ($palaist_ievietosanu) {
	//	$_SESSION['epasts']=$epasts_;
	//echo "<script>alert('Reģistrācja veiksmīga!'')</script>";
	//	}
}

}
?>