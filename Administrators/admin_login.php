<?php 
include("Funkcijas/funkcijas.php");


?> 
<!DOCTYPE html>
<html>
<head>
	<title>Mountain Maniacs</title>
	<link rel="stylesheet" type="text/css" href=AdminStyle/style.css media="all">
</head>

<body>
<div id="konteineris">
<div id="login">
<form>
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
echo connect();

?> 