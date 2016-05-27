<?php 
$con = mysqli_connect("localhost", "root", "qrwe1432", "mountain_maniacs") or die("Nevar pieslēgties datubāzei!");


function ievietotIerakstu(){

	if(isset($_POST['sub'])){
		global $con;
		global $lietotaja_id;

		$saturs = addslashes($_POST['saturs']);

		if ($saturs == "") {
		echo "<h2>Lūdzu aizpildi lauku!</h2>";
		}
		else
		{

		$ievietot = "INSERT INTO ieraksti (lietotaja_id, ieraksta_saturs, ieraksta_datums) VALUES ('$lietotaja_id', '$saturs', NOW())";

		$run = mysqli_query($con, $ievietot);

		if ($run) {
		echo "<h3>Pievienots!</h3>";
		$update = "UPDATE lietotaji SET posts='yes' where id='$lietotaja_id'";
				$run_update = mysqli_query($con,$update);
			}
		}
	}
}

function sanemtIerakstus(){
	
	global $con;
		
	$uz_lapu = 5;
	
	if (isset($_GET['page'])) {
	$lapa = $_GET['page'];
	}
	else {
	$lapa = 1;
	}
	$sakt_no = ($lapa - 1) * $uz_lapu;
	
	$get_ierakstus = "SELECT * FROM ieraksti ORDER by 1 DESC LIMIT $sakt_no, $uz_lapu";
	
	$run_ieraksti = mysqli_query($con, $get_ierakstus);


	
	while($rindas_ieraksts=mysqli_fetch_array($run_ieraksti)){
	
		$ieraksta_id = $rindas_ieraksts['ieraksta_id'];
		$lietotaja_id = $rindas_ieraksts['lietotaja_id'];
		$saturs = $rindas_ieraksts['ieraksta_saturs'];
		$ieraksta_datums = $rindas_ieraksts['ieraksta_datums'];
		



		//Saņem to lietotāju, kurš ir pievienojis ierakstu
		$lietotajs = "SELECT * FROM lietotaji WHERE id='$lietotaja_id' AND posts='yes'"; 
		
		$palaist_lietotaju = mysqli_query($con, $lietotajs); 
		$rinda_lietotajs = mysqli_fetch_array($palaist_lietotaju);
		$lietotajvards = $rinda_lietotajs['lietotajvards'];
		$lietotaja_bilde = $rinda_lietotajs['lietotaja_bilde'];
		

		//Parāda visus ierakstus reizē
		echo "<div id='posts'>
		<div id='prof'>
		<img src='Lietotājs/Lietotaja_bildes/$lietotaja_bilde' width='50' height='50'/>
		<br>
		<h3><a href='user_profile.php?id = $lietotaja_id'>$lietotajvards</a></h3>
		<p>$ieraksta_datums</p>
		</div>
		<div id='saturam'><p>$saturs</p></div>
		<div id='poga'>
		<a href='single.php?ieraksta_id=$ieraksta_id'><button> Komentēt</button></a>
		
		</div>
		</div><br/>
		";
		
	}
	include("pagination.php");
	}

function viensIeraksts(){
	if(isset($_GET['ieraksta_id'])){
	
	global $con; 
	
	$get_id = $_GET['ieraksta_id'];
		
	$get_ieraksti = "SELECT * FROM ieraksti WHERE ieraksta_id='$get_id'";
	
	$run_ieraksti = mysqli_query($con, $get_posts);
	
	$rindas_ieraksti=mysqli_fetch_array($run_ieraksti);
	
		$ieraksta_id = $rindas_ieraksti['post_id'];
		$lietotaja_id = $rindas_ieraksti['user_id'];
		$saturs = $rindas_ieraksti['post_content'];
		$ieraksta_datums = $rindas_ieraksti['post_date'];
		
		//Iegūšt lietotāju kurš publicēja ierakstu
		$lietotajs = "SELECT * FROM lietotaji WHERE lietotaja_id='$lietotaja_id' AND posts='yes'"; 
		
		$run_lietotajs = mysqli_query($con, $lietotajs); 
		$row_lietotajs=mysqli_fetch_array($run_lietotajs);
		$lietotajvards = $row_lietotajs['lietotajvards'];
		$lietotaja_bilde = $row_lietotajs['lietotaja_bilde'];

		//Lietotāja sesija 
		$lietotaja_s = $_SESSION['epasts'];
		$get_s = "SELECT * FROM lietotaji WHERE epasts='$lietotaja_s'"; 
		$run_s = mysqli_query($con,$get_s);
		$rindas_s=mysqli_fetch_array($run_s);
		$lietotaja_s_id = $rindas_s['id']; 
		$lietotaja_s_vards = $rindas_s['lietotajvards'];
		
		
		//Tagad visus kopā parāda 
		echo "<div id='posts'>
		
		<p><img src='Lietotājs/Lietotaja_bildes/$lietotaja_bilde' width='50' height='50'></p>
		<h3><a href='user_profile.php?id=$lietotaja_id'>$lietotajvards</a></h3> 
		<p>$eraksta_datums</p>
		<p>$saturs</p>
		
		</div>
		"; 
		include("comments.php");
		
		echo "
		<form action='' method='post' id='reply'>
		<textarea cols='50' rows='5' name='comment' placeholder='Ieraksti savu komentāru'></textarea><br/>
		<input type='submit' name='reply' value='Komentēt'/>
		</form>
		";
		
		if(isset($_POST['reply'])){
		
			$comment = $_POST['comment'];
			
			$insert = "insert into comments (post_id,user_id,comment,comment_author,date) values ('$post_id','$user_id','$comment','$user_com_name',NOW())";
			
			$run = mysqli_query($con,$insert); 
			
			echo "<h2>Your Reply was added!</h2>";
			
		
		}
	}
	
	}





?>
