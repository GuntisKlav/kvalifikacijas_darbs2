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
					$run_msg = mysqli_query($con,$sel_msg);		
		
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


				<div id="msg">
				<div id="zinojumi">
		<p align="center">
			<a href="manas_zinas.php?iesutne">Iesūtne</a> || 
			<a href="manas_zinas.php?izsutne">Izsūtne</a>
			
		</p>
		</div>
		
		<?php 
		if(isset($_GET['izsutne'])){
		include("nosutitas.php");
		}
		?> 
		<?php if(isset($_GET['iesutne'])){?>
		<table width="700">
			<tr>
				<th>Sūtītājs:</th>
				<th>Nosaukums</th>
				<th>Saturs</th>
				<th>Datums</th>
				<th>Atbilde</th>
			</tr>
			
			<?php 
		
		$sel_msg = "SELECT * FROM zinas where sanemejs='$lietotaja_id' ORDER by 1 DESC"; 
		$run_msg = mysqli_query($con,$sel_msg);		
		
		$count_msg = mysqli_num_rows($run_msg);
		
		while($row_msg=mysqli_fetch_array($run_msg))
		{
		
		$msg_id = $row_msg['zinas_id']; 
		$msg_receiver= $row_msg['sanemejs']; $msg_sender= $row_msg['sutitajs'];
		$msg_sub = $row_msg['zinas_kat'];
		$msg_topic = $row_msg['zinas_temats'];
		$msg_date = $row_msg['zinas_datums'];
		
		$get_sender = "SELECT * FROM lietotaji WHERE id='$msg_sender'"; 
		$run_sender = mysqli_query($con,$get_sender); 
		$row=mysqli_fetch_array($run_sender); 
		
		$sender_name = $row['lietotajvards'];
		
		
		?>
			
			<tr align="center">
				<td>
				<a href="lietotaja_profils.php?liet_id=<?php echo $msg_sender;?>" target="blank">
				<?php echo $sender_name;?>
				</a>
				</td>
				<td>
				<a href="manas_zinas.php?iesutne&zinas_id=<?php echo $msg_id;?>">
				<?php echo $msg_sub;?>
				</a>
				</td>
				<td>
				<a href="manas_zinas.php?iesutne&zinas_id=<?php echo $msg_id;?>">
				<?php echo $msg_topic;?>
				</a>
				</td>
				<td><?php echo $msg_date;?></td>
				<td><a href="manas_zinas.php?iesutne&inas_id=<?php echo $msg_id;?>">Atbilde</a></td>
			</tr>
		<?php } ?>
		</table>
		
		<?php 
			if(isset($_GET['zinas_id'])){
			
			$get_id = $_GET['zinas_id'];
			
			$sel_message = "SELECT * FROM zinas WHERE zinas_id='$get_id'";
			$run_message = mysqli_query($con,$sel_message); 
			
			$row_message=mysqli_fetch_array($run_message); 
			
			$msg_subject = $row_message['zinas_kat']; 
			$msg_topic = $row_message['zinas_temats']; 
			$reply_content = $row_message['atbilde'];
			
			//atjauno nelasīto ziņu par lasītu
			$update_unread="UPDATE zinas SET statuss='lasīts' WHERE zinas_id='$get_id'"; 
			$run_unread = mysqli_query($con,$update_unread);
			
			echo "<center><br/><hr>
			<h2>$msg_subject</h2>
			<p><b>Ziņa:</b> $msg_topic</p>
			<p><b>Mana atbide:</b> $reply_content</p>
			
			<form action='' method='post'>
				<textarea cols='30' rows='5' name='reply'></textarea><br/>
				<input type='submit' name='msg_reply' value='Atbildēt:'/> 
			</form>
			</center>
			";
			}
			
			if(isset($_POST['msg_reply'])){
			
				$user_reply = $_POST['reply'];
				
				if($reply_content!='no_reply'){
				echo "<h2 align='center'>Uz šo ziņu Tu jau atbildēji!</h2>";
				exit();
				}
				else {
				$update_msg = "UPDATE zinas SET atbilde='$user_reply' WHERE zinas_id='$get_id' AND atbilde='bez_atbildes'";
				
				$run_update = mysqli_query($con,$update_msg);
				
				echo "<script>alert('Atbildēta ziņa')</script>";
				}
				
			}
		}
		?>
		
		</div>
	</div>
	<!--Container ends-->

</body>
</html>
<?php } ?>