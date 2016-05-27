<?php
session_start();
include("Include/connection.php");
//include("login.php");
?>
<!doctype html>
<html>
<head>
	<title>Laipni lūgts!</title>
	<link rel="stylesheet" href="Stils/home_style.css" media="all"/>
</head>



<body>

<h1>Laipni lūgts <?php echo $_SESSION['epasts'];?> </h1>

<!--Container starts--> 
	<div class="container">
		<!--Header Wrapper Starts-->
		<div id="head_wrap">
			<!--Header Starts-->
			<div id="header">
				<ul id="menu">
					<li><a href="home.php">Home</a></li>
					<li><a href="members.php">Members</a></li>
					
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
			
					//$lietotaja_zinojumi = "SELECT * FROM temas where id='$id'"; 
					//$run_posts = mysqli_query($con, $lietotaja_zinojumi); 
					//$posts = mysqli_num_rows($run_posts);
					
					//getting the number of unread messages 
					//$sel_msg = "SELECT * FROM zinojumi WHERE sanemejs='$id' AND statuss='nelasita' ORDER by 1 DESC"; 
					//$run_msg = mysqli_query($con,$sel_msg);		
		
					//$count_msg = mysqli_num_rows($run_msg);
					
					
					echo "
						<center>
						<img src='Lietotājs/Lietotaja_bildes/$lietotaja_bilde' width='200' height='200'/>
						</center>
							<p><strong>Vārds:</strong>$vards $uzvards</p>

						<p><strong>Lietotājvārds:</strong> $lietotaj_vards</p>
						<p><strong>Pēdējo reizi manīts:</strong> $pedeja_sesija</p>
						<p><strong>Konts izveidots:</strong> $registresanas_d</p>
					<p><a href=''manas_zinas.php'>Ziņojumi</a></p>
					<p><a href=''mani_posti.php'>Mani posti</a></p>
					<p><a href=''iestatijumi.php'>Iestatījumi</a></p>
						<p><a href='logout.php'>Iziet</a></p>
					";
					?>
					</div>
				</div>
				<!--user timeline ends-->
				<!--Content timeline starts-->
				<div id="content_timeline">
					<form action="home.php?id=<?php echo $lietotaja_id;?>" method="post" id="f">
					<h2>Kas Tev prātā?</h2>
					<textarea cols="83" rows="4" name="content" placeholder=" Pievienot ierakstu..."></textarea><br/>



					<input type="submit" name="sub" value="Pievienot"/>
					</form>
					<?php insertPost();?>
					
						<h3>Ko tavi draugi runā!</h3> 
						<?php get_posts();?>
				</div>
				<!--Content timeline ends-->
			</div>
			<!--Content area ends-->
		
	</div>
	<!--Container ends-->
</body>
</html> 