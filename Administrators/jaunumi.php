<?php 
session_start();
include("../Funkcijas/funkcijas.php");
if (!isset($_SESSION['admin_lietotajvards'])) { 
	header("location: admin_login.php");
}
?>  
<!DOCTYPE html>
<html>
<head>
<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|PT+Sans+Narrow' rel='stylesheet' type='text/css'>
	<title>Skatīt visus ierakstus</title>
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

<center><div id="timeline"></dcenter>
<div id="content_timeline">
					<form action="jaunumi.php?jaun_id=<?php echo $jaun_id;?>" method="post" id="ff">
					<h2>Ievietot ziņojumu lietotājiem:</h2><br>
					<textarea cols="83" rows="1" name="autors1" placeholder=" Autors..."></textarea><br>

					<textarea cols="83" rows="1" name="nosaukums1" placeholder=" Nosaukums..."></textarea><br>

					<textarea id="saturs1" cols="83" rows="6" name="saturs1" placeholder=" Pievienot ierakstu..."></textarea><br/>

					<input type="submit" name="kek" value="Pievienot"/>
					</form>
					<?php ievietotJaunumus();?>
				</div>
				</div>
<div id="konteineris">
<br>
<center><h1 id="virsraksts">Visi ieraksti</h1></center>
<br>
<br>
<br>
<div id="tabula">
<center><table id="table" width='800' align='center' border='2'>
<tr bgcolor='yellow'>
<th>Ieraksta ID</th>
<th>Temats</th>
<th>Autors</th>
<th>Saturs</th>	
<th>Dzēst</th>
</tr>
<tr>
<?php 
echo adminaIeraksti();
$con = mysqli_connect("localhost", "root", "qrwe1432", "mountain_maniacs");

//izvēlās visu informāciju no tabulas 'lietotaji'
$query = "SELECT * FROM jaunumi";


$palaist = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($palaist)) {
	
	$jaun_id = $row['jaun_id'];
	$jaun_nos = $row['jaun_nosaukums'];
	$jaun_autors = $row['jaun_autors'];
	$jaun_sat = $row['jaun_saturs'];
?> 
<td><?php echo $jaun_id;   ?></td>
<td><?php echo $jaun_nos;   ?></td>
<td><?php echo $jaun_autors;   ?></td>
<td id="saturss"><?php echo $jaun_sat;   ?></td>
<td><a href='dzest_ierakstu.php?dzesana=<?php echo $jaun_id;?>'>Dzēst</td>
</tr>
 <?php } ?>

</table></center>
</div>
</div>
<br><br><br>

</body>
</html>