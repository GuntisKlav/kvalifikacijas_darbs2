<?php 

include("Include/connection.php");



//function ievietotLietotaju(){
	//global $con;




	if (isset($_POST['reg'])) {
$vards = mysqli_real_escape_string($con, $_POST['vards']);
$uzvards = mysqli_real_escape_string($con, $_POST['uzvards']);
$lietotajvards = mysqli_real_escape_string($con, $_POST['lietotajvards']);
$parole = mysqli_real_escape_string($con, $_POST['parole']);
$epasts = mysqli_real_escape_string($con, $_POST['epasts']);
$dzimums = mysqli_real_escape_string($con, $_POST['dzimums']);
$dz_diena = $_POST['dz_diena'];
$statuss = "Neverificēts";
$posti = "Nē";

$get_epasts = "SELECT * FROM lietotaji WHERE epasts = '$epasts'";
$run_epasts = mysqli_query($con, $get_epasts);
$parbaude = mysqli_num_rows($run_epasts);
//$md5_parole = md5($parole);
if ($parbaude == 1) {

	echo "Šad epasts jau ir reģistrēts!";
	exit();
}

if (strlen($parole) <8) {
echo "Parolei jāsastāv vismaz no 8 simboliem!";
	exit();	
}

else{
	$ievietot = "INSERT INTO lietotaji (vards, uzvards, lietotajvards, parole, epasts, dzimums, dz_diena, lietotaja_bilde, reg_datums, pedeja_sesija, statuss, posts) VALUES ('$vards', '$uzvards', '$lietotajvards', '$parole', '$epasts', 'dzimums', '$dz_diena', 'default.jpg', NOW(), NOW(), '$statuss', '$posti')";
	$palaist_ievietosanu = mysqli_query($con, $ievietot);

	if ($palaist_ievietosanu) {
		$_SESSION['epasts'] = $epasts;
		echo "Reģistrācija veiksmīga!";
		echo "<script>window.open('home.php', '_self')</script>";
			}
}
}



//}

?>