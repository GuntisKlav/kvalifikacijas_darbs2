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

?>
