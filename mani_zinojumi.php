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
					<li><a href="#">Draugi</a></li>
					<li><a href="#">Galerijas</a></li>
					<li><a href="jaunumi.php">Jaunumi</a>
					<li><a href="pieteikties_braucienam.php">Pieteikties braucienam</a></li>
					
				</ul>
				<form method="get" action="results.php" id="form1">
					<input type="text" name="user_query" placeholder=" Meklēšana..."/> 
					<input type="submit" name="search" value="Meklēt"/>
				</form>
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
					
					//getting the number of unread messages 
					//$sel_msg = "SELECT * FROM zinojumi WHERE sanemejs='$id' AND statuss='nelasita' ORDER by 1 DESC"; 
					//$run_msg = mysqli_query($con,$sel_msg);		
		
					//$count_msg = mysqli_num_rows($run_msg);
					
					
					echo "
						<center>
						<img src='Lietotājs/Lietotaja_bildes/$lietotaja_bilde' width='200' height='200'/>
						</center>
							<p><strong>Vārds:</strong> $vards $uzvards</p>

						<p><strong>Lietotājvārds:</strong> $lietotaj_vards</p>
						<p><strong>Pēdējo reizi manīts:</strong> $pedeja_sesija</p>
						<p><strong>Konts izveidots:</strong> $registresanas_d</p>
					<p><a href=''manas_zinas.php'>Ziņojumi</a></p>
					<p><a href=''mani_zinojumi.php'>Mani ieraksti ($ieraksti)</a></p>
					<p><a href=''iestatijumi.php'>Iestatījumi</a></p>
						<p><a href='logout.php'>Iziet</a></p>
					";
					?>
					</div>
				</div>
				<!--user timeline ends-->
				<!--Content timeline starts-->
				<div id="content_timeline">
					

					<h2>Visi Jūsu ieraksti:</h2>
						<?php lietotajaIeraksti();?>
				</div>
				<!--Content timeline ends-->
			</div>
			<!--Content area ends-->
		
	</div>
	<!--Container ends-->
</body>
</html> 

<?php } ?>  