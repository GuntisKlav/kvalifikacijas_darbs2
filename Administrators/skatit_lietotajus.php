<?php 
include("Funkcijas/funkcijas.php");
?> 
<!DOCTYPE html>
<html>
<head>
	<title>Skatīt visus lietotājus</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
$con = mysqli_connect("localhost", "root", "qrwe1432", "mountain_maniacs");

//izvēlās visu informāciju no tabulas 'lietotaji'
$query = "SELECT * FROM lietotaji";


$palaist = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($palaist)) {
	
	$lietotaja_id = $row['id'];
	$vards = $row['vards'];
	$uzvards = $row['uzvards'];
	$lietotajvards = $row['lietotajvards'];
	$epasts = $row['epasts'];
?> 
<td><?php echo $lietotaja_id;   ?></td>
<td><?php echo $vards;   ?></td>
<td><?php echo $uzvards;   ?></td>
<td><?php echo $lietotajvards;   ?></td>
<td><?php echo $epasts;   ?></td>
<td><a href='dzest.php?dzest=<?php echo $lietotaja_id;?>'>Dzēst</td>
</tr>
 <?php } ?>


?>

</table></center>
</body>
</html>