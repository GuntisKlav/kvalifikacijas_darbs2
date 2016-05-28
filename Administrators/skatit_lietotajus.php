<?php 
include("Funkcijas/funkcijas.php");
?> 
<!DOCTYPE html>
<html>
<head>
	<title>Skatīt visus lietotājus</title>
	<link rel="stylesheet" type="text/css" href="AdminStyle/sessionStyle.css">
</head>
<body>
<br>
<center><h1 id="virsraksts">Visa lietotāju informācija</h1></center><br>
<center><table id="table1" width='800' align='center' border='10'>
<tr bgcolor='yellow'>
<th>Lietotāja ID</th>
<th>Vārds</th>
<th>Uzvārds</th>
<th>Lietotājvārds</th>	
<th>Epasts</th>
<th>Dzēst!</th>
</tr>
<tr>
<?php 
echo connect2();

?>

</table></center>
</body>
</html>