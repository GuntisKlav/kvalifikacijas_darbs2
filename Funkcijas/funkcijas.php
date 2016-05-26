<?php 
$con = mysqli_connect("localhost", "root", "qrwe1432", "lietotaji") or die("Nevar pieslēgties datubāzei!");

function ievietotLietotaju(){
	if (isset($_POST['reg'])) {
$vards = $_POST['vards'];
$uzvards = $_POST['uzvards'];
$lietotajvards = $_POST['lietotajvards'];
$parole = $_POST['parole'];
$epasts = $_POST['epasts'];
$dzimums = $_POST['dzimums'];
$dz_diena = $_POST['dz_diena'];
$datums = date("d-m-g");
$statuss = "Neverificēts";
$posti = "Nē";

$get_epasts = "SELECT * FROM lietotaji";
$run_epasts = mysqli_query($con, $get_epasts);
$parbaude = mysqli_num_rows($run_epasts);












}


?>
