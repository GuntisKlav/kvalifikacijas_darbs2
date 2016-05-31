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
					
					<?php 
			
			if(isset($_GET['liet_id'])){
			
			$u_id = $_GET['liet_id'];
			
			$sel = "SELECT * FROM lietotaji WHERE id ='$u_id'"; 
			$run = mysqli_query($con,$sel); 
			$row=mysqli_fetch_array($run); 
			
			$user_name = $row['lietotajvards'];
			$user_image = $row['lietotaja_bilde'];
			$reg_date = $row['reg_datums'];
			}
		
		?>
			
		<h2>Sūtīt ziņu <span style='color:red;'><?php echo $user_name; ?></span></h2>
			



			<form id="topkek" action="zinas.php?liet_id=<?php echo $u_id;?>" method="post" id="f">
				<input type="text" id="zinas_nos" name="zinas_nos" placeholder=" Temats" size="49"/><br>
				<textarea id="zin" name="zina" cols="50" rows="5" placeholder=" Kategorija"/></textarea><br/>
				<input type="submit" name="zinojums" value="Sūtīt ziņu"/>
			</form><br/>
			
			<img style="border:2px solid blue; border-radius:5px;" src="Lietotājs/Lietotaja_bildes/<?php echo $user_image;?>" width="100" height="100"/>
			
			<p><strong><?php echo $user_name;?> </strong> ir aktīvs lietotājs kopš: <?php echo $reg_date;?></p>
			
			</div>
			<!--Content timeline ends-->
		<?php 
	if(isset($_POST['zinojums'])){
	
		$msg_title = $_POST['zinas_nos']; 
		$msg = $_POST['zina']; 
		
		$insert = "INSERT INTO zinas (sutitajs, sanemejs, zinas_kat, zinas_temats, atbilde, statuss, zinas_datums) 
		values ('$lietotaja_id','$u_id','$msg_title','$msg','bez_atbildes','nelasīts',NOW())"; 
		
		$run_insert = mysqli_query($con,$insert); 
		
		if($run_insert){
		echo "<script>alert('Ziņa tika nosūtīta lietotājam ". $user_name . " veiksmīgi!')</script>";
		exit();

		}
		else {
		
		echo "<script>alert('Ziņa netika nosūtīta!')</script>";
		exit();
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