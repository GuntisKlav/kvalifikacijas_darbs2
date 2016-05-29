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
	<style>
	input[type='file']{width:180px;}
	</style>
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
					$parole = $rinda1['parole'];
					$epasts = $rinda1['epasts'];
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
					<p><a href='manas_zinas.php?inbox&id=$lietotaja_id'>Ziņojumi ()</a></p>
					<p><a href='mani_zinojumi.php?id=$lietotaja_id'>Mani ieraksti ($ieraksti)</a></p>
					<p><a href='edit_profile.php?id=$lietotaja_id'>Profila iestatījumi</a></p>
						<p><a href='logout.php'>Iziet</a></p>
					";
					?>
					</div>
				</div>
				<!--user timeline ends-->
				<!--Content timeline starts-->
				<div id="content_timeline">




<form action="" method="POST" id="f" class="ff" enctype="multipart/form-data"> 
					<table>
					<h3>Profila iestatījumi</h3> 
						<tr>
							<td align="right">Vārds: </td>
							<td>
							<input type="text" name="vards" required="required" value="<?php echo $vards;?>"/>
							</td>
						</tr>
						<tr>
							<td align="right">Uzvārds: </td>
							<td>
							<input type="text" name="uzvards" required="required" value="<?php echo $uzvards; ?>"/>
							</td>
						</tr>
						<tr>
							<td align="right">Lietotājvārds: </td>
							<td>
							<input type="text" name="lietotajvards" required="required" value="<?php echo $lietotaj_vards;?>"/>
							</td>
						</tr>
						<tr>
							<td align="right">Parole: </td>
							<td>
							<input type="password" name="parole" required="required" value="<?php echo $parole;?>"/>
							</td>
						</tr>
						
						<tr>
							<td align="right">Epasts: </td>
							<td>
							<input type="email" name="epasts1" required="required" value="<?php echo $epasts;?>"></td>
						</tr>
						
						<tr>
							<td align="right" required="required"></td>
							<td>
							<select name="dzimums" disabled="disabled">
								<option>Izvēlies dzimumu</option>
								<option>Vīrietis</option>
								<option>sieviete</option>
								
							</select>
							</td>
						</tr>
						
						<tr>
							<td align="right">Profila bilde: </td>
							<td>
					<input type="file" name="liet_bilde" required="required"/>
							</td>
						</tr>
						
						<tr>
							<td colspan="6">
						<input type="submit" name="atjaunot" value="Saglabāt"> 
							</td>
						</tr>
					</table>
				</form>
				<?php 
if (isset($_POST['atjaunot'])) {
	
$vards_ = $_POST['vards'];
$uzvards_ = $_POST['uzvards'];
$lietotajvards_ = $_POST['lietotajvards'];
$parole_ = $_POST['parole'];
$epasts_ = $_POST['epasts1'];
//$dzimums_ = $_POST['dzimums'];
$bilde_ = $_FILES['liet_bilde']['name'];
$profila_bilde_ = $_FILES['liet_bilde']['tmp_name'];

move_uploaded_file($profila_bilde_, '../Lietotāji/Lietotaja_bildes/');

$atjaunot = "UPDATE lietotaji SET vards = '$vards_', uzvards = '$uzvards_', lietotajvards = '$lietotajvards_', parole = '$parole_', epasts = $epasts_, lietotaja_bilde = '$bilde_' WHERE id = '$lietotaja_id'";
$palaist = mysqli_query($con, $atjaunot);
 if ($palaist) {
 	echo "<script>alert('Izmaiņs saglabātas')</script>";
		echo "<script>window.open('home.php','_self')</script>";
 }
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