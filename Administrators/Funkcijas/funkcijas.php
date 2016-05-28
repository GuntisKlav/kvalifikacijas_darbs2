<?php 
function connect(){
mysqli_connect("localhost", "root", "qrwe1432", "mountain_maniacs");
//ja Poga ir aktīva, vai nospiesta, tiks palaists php kods
if (isset($_POST['admin_login'])) {
	//saņemsim informāciju, un to glabāsim lokālajos mainīgajos
	$admin_username = $_POST['admin_lietotajvards'];
	$admin_pass = $_POST['admin_parole'];
// Piešķiram DB laukiem vērtības, ko tikko nedefinējām ar lokālajiem mainīgajiem
	$query = "SELECT * FROM administratori WHERE admin_lietotajvards = '$admin_username' AND admin_parole = '$admin_pass'";
$palaist = mysqli_query($query);
if (mysqli_num_rows($palaist) > 0) {
	echo "<script>window.open('skatit_lietotajus.php', '_self')</script>";
}
else{
	echo "<script>alert('Lietotājvārds vai parole ir nepareizi!')</script>";
}
}
}

?>

