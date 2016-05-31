<?php
session_start();
include("Include/connection.php");
include("Funkcijas/funkcijas.php"); 

 
if (!isset($_SESSION['epasts'])) {

header("location: index.php");

}
else
{
?>
<!doctype html>
<html>
<head>
	<title>Laipni lūgts!</title>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|PT+Sans+Narrow' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="Stils/home_style.css" media="all"/>
</head>



<body>


<!--Container starts--> 
	<div class="container">
		<!--Header Wrapper Starts-->
		<div id="head_wrap">
			<!--Header Starts-->
			<div id="header">
				<ul id="menu">
					<li><a href="home.php">Sākums</a></li>
					<li><a href="lietotaji.php">Lietotāji</a></li>
			
					<li><a href="jaunumi.php">Jaunumi</a>
					<li><a href="pieteikties_braucienam.php">Pieteikties braucienam</a></li>
					
				</ul>
			</div>
			<!--Header ends-->
		</div>
		<!--Header Wrapper ends-->
			<!--Content area starts-->
			<div class="content">
				<!--user timeline starts-->
				<div id="user_timeline">
					<div id="user_details">
					<?php 
					$lietotajs = $_SESSION['epasts'];
					$get_lietotajs = "SELECT * FROM lietotaji WHERE epasts='$lietotajs'"; 
					$run_lietotajs = mysqli_query($con,$get_lietotajs);
					$rinda1=mysqli_fetch_array($run_lietotajs);
					
					$lietotaja_id = $rinda1['id']; 
					$vards = $rinda1['vards'];
					$uzvards = $rinda1['uzvards'];
					$lietotaj_vards = $rinda1['lietotajvards'];
					$lietotaja_bilde = $rinda1['lietotaja_bilde'];
					$registresanas_d = $rinda1['reg_datums'];
					$pedeja_sesija = $rinda1['pedeja_sesija'];
			
					$lietotaja_zinojumi = "SELECT * FROM ieraksti where lietotaja_id='$lietotaja_id'"; 
					$run_ieraksti = mysqli_query($con, $lietotaja_zinojumi); 
					$ieraksti = mysqli_num_rows($run_ieraksti);
					
					 
					$sel_msg = "SELECT * FROM zinas WHERE sanemejs='$lietotaja_id' AND statuss='nelasita' ORDER by 1 DESC"; 
					$run_msg = mysqli_query($con, $sel_msg);		
		
					$count_msg = mysqli_num_rows($run_msg);
					
					
					echo "
						<h1 id='liett'>Sveiks, <strong>$lietotaj_vards</strong></h1>
						<center>
						<img src='Lietotājs/Lietotaja_bildes/$lietotaja_bilde' width='300' height='200'/>
						</center>
							<p><strong>Vārds:</strong> $vards $uzvards</p>
						<p><strong>Pēdējo reizi manīts:</strong> $pedeja_sesija</p>
						<p><strong>Konts izveidots:</strong> $registresanas_d</p>
					<p><a href='manas_zinas.php?inbox&id=$lietotaja_id'>Ziņojumi($count_msg)</a></p>
					<p><a href='mani_zinojumi.php?id=$lietotaja_id'>Mani ieraksti($ieraksti)</a></p>
					<p><a href='rediget_profilu.php?id=$lietotaja_id'>Profila iestatījumi</a></p>
						<p><a href='logout.php'>Iziet</a></p>
					";
					?>
					</div>
				</div>
				<!--user timeline ends-->
				<!--Content timeline starts-->
				<div id="content_timeline">
						<h3>Lietotāji:</h3> 
					<?php 
					$get_members = "SELECT * FROM lietotaji"; 
					$run_members = mysqli_query($con,$get_members);
					
					while($row=mysqli_fetch_array($run_members)){
					
					$user_id = $row['id']; 
					$user_name = $row['lietotajvards'];
					$user_image = $row['lietotaja_bilde'];
					
					echo "
					<a href='lietotaja_profils.php?liet_id=$user_id'>
					<div id='lietot'>
					<img src='Lietotājs/Lietotaja_bildes/$user_image' width='140' height='100' id='pic' title='$user_name'/>
					<center><h3>$user_name<h3></center>
					
					</div>
					</a>
						
					";
					}
					?>
				</div>
				<!--Content timeline ends-->
			</div>
			<!--Content area ends-->
		
	</div>
	<!--Container ends-->
</body>
</html> 

<?php } ?>  