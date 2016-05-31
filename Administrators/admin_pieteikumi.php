<?php 
session_start();
if (!isset($_SESSION['admin_lietotajvards'])) {
	header("location: admin_login.php");
}
?> 
<!DOCTYPE html>
<html> 
<head>
	<title>Skatīt visus lietotājus</title>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|PT+Sans+Narrow' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="AdminStyle/sessionStyle.css">
</head>
<body>

<div id=header1>
<nav id="nav">
	<ul>
		<li><a href="skatit_lietotajus.php">Lietotāji</a></li>
		<li><a href="admin_pieteikumi.php">Pieteikumi</a></li>
		<li><a href="jaunumi.php">Jaunumi</a></li>
		<li><a href="logout.php">Iziet</a></li>

	</ul>
</nav>
</div>

<div id="konteineris1">
<br>
<center><h1 id="virsraksts">Braucienu pieteikumu anketas</h1></center>
<br>
<br>
<br>
<div id="tabula1">
<center><table id="table1" width='800' align='center' border='2'>
<tr bgcolor='yellow'>
<th>Anketas_ID</th>
<th>Vārds</th>
<th>Uzvārds</th>
<th>Tel. Nr.</th>	
<th>Vecums</th>
<th>Epasts</th>
<th>Prasmes</th>
<th>Inventāra noma</th>
<th>Braucēja komentāri</th>
<th>pieteikšanās datums</th>
<th>Dzēst!</th>
</tr>
<tr>
<?php 
$con = mysqli_connect("localhost", "root", "qrwe1432", "mountain_maniacs");

//izvēlās visu informāciju no tabulas 'pieteiksanas_anketa'
$query1 = "SELECT * FROM pieteiksanas_anketa";


$palaist1 = mysqli_query($con, $query1);
while ($row = mysqli_fetch_array($palaist1)) {
	
	$anketas_id = $row['anketas_id'];
	$brauceja_vards = $row['brauceja_vards'];
	$brauceja_uzvards = $row['brauceja_uzvards'];
	$tel_nr = $row['telefona_nr'];
	$vecums = $row['_brauceja_vecums'];
	$epasts = $row['brauceja_epasts'];
	$prasmes = $row['prasmju_limenis'];
	$inventara_noma = $row['inventara_noma'];
	$datums = $row['pieteiksanas_d'];
	$brauceja_komentari = $row['brauceja_komentari'];
?> 

<td><?php echo $anketas_id;   ?></td>
<td><?php echo $brauceja_vards;   ?></td>
<td><?php echo $brauceja_uzvards;   ?></td>
<td><?php echo $tel_nr;   ?></td>
<td><?php echo $vecums;   ?></td>
<td><?php echo $epasts;   ?></td>
<td><?php echo $prasmes;   ?></td>
<td><?php echo $inventara_noma;   ?></td>
<td><?php echo $brauceja_komentari;   ?></td>
<td><?php echo $datums;   ?></td>
<td><a href='dzest_anketu.php?dzest1=<?php echo $anketas_id;?>'>Dzēst</td>
</tr>
 <?php } ?>

</table></center>
</div>
</div>

<br><br><br>



</body>
</html>