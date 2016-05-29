<?php 
session_start();
?> 
 
<!DOCTYPE html>
<html>
<head>
	<title>Mountain Maniacs</title>
	<link rel="stylesheet" type="text/css" href=AdminStyle/style.css media="all">
</head>

<body>
<a href="../index.php"><img id="img" src="Bildes/reply.png"></a>
<div id="konteineris">
<div id="login">
<form method="post" action="admin_login.php">
<br>
<h1>Admin Login</h1>
<br>
	<input type="text" placeholder=" Lietotājvārds" name="admin_lietotajvards" required="required"><br><br>
	<input type="password" placeholder=" Parole" name="admin_parole" required="required"><br><br><br>
	<input id="button" type="submit" name="admin_login" value="Ieiet">
</form>
</div>
</div>

</body>
</html>

<?php 
$con1 = mysqli_connect("localhost", "root", "qrwe1432", "mountain_maniacs");
//ja Poga ir aktīva, vai nospiesta, tiks palaists php kods
if (isset($_POST['admin_login'])) {
	//saņemsim informāciju, un to glabāsim lokālajos mainīgajos
	$admin_username = $_POST['admin_lietotajvards'];
	$admin_pass = $_POST['admin_parole'];
// Piešķiram DB laukiem vērtības, ko tikko nedefinējām ar lokālajiem mainīgajiem
	$query = "SELECT * FROM administratori WHERE admin_lietotajvards = '$admin_username' AND admin_parole = '$admin_pass'";

$palaist = mysqli_query($con1, $query);
if (mysqli_num_rows($palaist) > 0) {
	$_SESSION['admin_lietotajvards'] = $admin_username;
	echo "<script>window.open('skatit_lietotajus.php', '_self')</script>";
}
else{
	echo "<script>alert('Lietotājvārds vai parole ir nepareizi!')</script>";
}
}

?> 