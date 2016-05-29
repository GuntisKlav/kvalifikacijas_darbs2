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
		<h3><a href='lietotaja_profils.php?id = $lietotaja_id'>$lietotajvards</a></h3>
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
		
	$get_posts = "SELECT * FROM ieraksti WHERE ieraksta_id='$get_id'";
	
	$run_posts = mysqli_query($con,$get_posts);
	
	$row_posts=mysqli_fetch_array($run_posts);
	
		$post_id = $row_posts['ieraksta_id'];
		$lietotaja_id = $row_posts['lietotaja_id'];
		$content = $row_posts['ieraksta_saturs'];
		$post_date = $row_posts['ieraksta_datums'];
		
		//atrod lietotāju, kurš izveidoja ierakstu
		$user = "SELECT * FROM lietotaji WHERE id='$lietotaja_id' AND posts='yes'"; 
		
		$run_user = mysqli_query($con, $user); 
		$row_user=mysqli_fetch_array($run_user);
		$user_name = $row_user['lietotajvards'];
		$user_image = $row_user['lietotaja_bilde'];

		// Tiek pie lietotaja sesijas 
		$user_kom = $_SESSION['epasts'];
		$get_kom = "SELECT * FROM lietotaji WHERE epasts='$user_kom'"; 
		$run_kom = mysqli_query($con,$get_kom);
		$row_kom=mysqli_fetch_array($run_kom);
		$user_kom_id = $row_kom['id']; 
		$user_kom_name = $row_kom['lietotajvards'];
		
		
		//parāda visus reizē
		echo "<div id='posts'>
		
		<p><img src='Lietotājs/Lietotaja_bildes/$user_image' width='50' height='50'></p>
		<h3><a href='lietotaja_profils.php?id=$lietotaja_id'>$user_name</a></h3> 
		<p>$post_date</p>
		<p>$content</p>
		
		</div>
		"; 
		include("komentari.php");
		
		echo "
		<form action='' method='post' id='reply'>
		<textarea cols='50' rows='5' name='comment' placeholder='write your reply'></textarea><br/>
		<input type='submit' name='reply' value='Reply to This'/>
		</form>
		";
		
		if(isset($_POST['reply'])){
		
			$comment = $_POST['comment'];
			
			$insert = "INSERT INTO komentari (ieraksta_id, lietotaja_id, komentars, komentara_autors, ievietosanas_d) values ('$post_id','$lietotaja_id','$comment','$user_kom_name',NOW())";
			
			$run = mysqli_query($con,$insert); 
			
			echo "<h2>Your Reply was added!</h2>";
		}
	}
	}

function lietotajaIeraksti(){
	
	global $con;
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	$get_ierakstus = "SELECT * FROM ieraksti WHERE lietotaja_id = '$id' ORDER by 1 DESC LIMIT 5";
	 
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
		<h3><a href='lietotaja_profils.php?id = $lietotaja_id'>$lietotajvards</a></h3>
		<p>$ieraksta_datums</p>
		</div>
		<div id='saturam'><p>$saturs</p></div>
		<div id='poga'>
		<a href='single.php?ieraksta_id=$ieraksta_id'><button> Skatīt</button></a>
		<a href='rediget_ierakstu.php?ieraksta_id=$ieraksta_id'><button> Rediģēt</button></a>
		<a href='Funkcijas/izdzest_ierakstu.php?ieraksta_id=$ieraksta_id'><button>Dzēst</button></a>
		</div>
		</div><br/>
		";
		
	}
		include("izdzest_ierakstu.php");
	}
function lietotajaProfils(){
		
		if(isset($_GET['id'])){
				
				global $con;
				
				$user_id = $_GET['id']; 
				
				$select = "SELECT * FROM lietotaji WHERE id='$user_id'";
				$run = mysqli_query($con, $select); 
				$row=mysqli_fetch_array($run);
				
				$id = $row['id'];
				$name = $row['vards'];
				$surname = $row['uzvards'];
				$image = $row['lietotaja_bilde'];
				$u_name = $row['lietotajvards'];
				$gender = $row['dzimums'];
				$last_login = $row['pedeja_sesija']; 
				$register_date = $row['reg_datums'];
				
				echo "<div id='user_profile'>
					
					<img src='Lietotājs/Lietotaja_bildes/$image' width='150' height='150' />
					<br/>
					
					<p><strong>Vārds:</strong> $name </p><br/>
					<p><strong>Uzvārds:</strong> $surname </p><br/>
					<p><strong>Pēdējo reizi redzēts:</strong> $last_login </p><br/>
					<p><strong>Lietotājs kopš:</strong> $register_date</p>
					<a href='zinas.php?id=$id'><button>$msg</button></a><hr>
					</div>
				";
	
		}
		//new_members();
		
		//echo "</div>";
	}





function ievietotJaunumus(){

	if(isset($_POST['kek'])){
		global $con;
		$nosaukums = addslashes($_POST['nosaukums1']);
		$autors = addslashes($_POST['autors1']);
		$saturs = addslashes($_POST['saturs1']);
		if ($saturs == "") {
		echo "<h2>Lūdzu aizpildi lauku!</h2>";
		}
		else
		{

		$ievietot = "INSERT INTO jaunumi (jaun_id, cat_id, jaun_nosaukums, jaun_autors, jaun_saturs) VALUES ('', '', '$nosaukums', '$autors', '$saturs')";

		$run = mysqli_query($con, $ievietot);
		}
	}
}

function sanemtJaunumus(){
	
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
		<h3><a href='lietotaja_profils.php?id = $lietotaja_id'>$lietotajvards</a></h3>
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
	function adminaIeraksti(){
	
	global $con;
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	$get_ierakstus = "SELECT * FROM ieraksti WHERE lietotaja_id = '$id' ORDER by 1 DESC LIMIT 5";
	 
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
		<h3><a href='lietotaja_profils.php?id = $lietotaja_id'>$lietotajvards</a></h3>
		<p>$ieraksta_datums</p>
		</div>
		<div id='saturam'><p>$saturs</p></div>
		<div id='poga'>
		<a href='single.php?ieraksta_id=$ieraksta_id'><button> Skatīt</button></a>
		<a href='rediget_ierakstu.php?ieraksta_id=$ieraksta_id'><button> Rediģēt</button></a>
		<a href='Funkcijas/izdzest_ierakstu.php?ieraksta_id=$ieraksta_id'><button>Dzēst</button></a>
		</div>
		</div><br/>
		";
		
	}
		include("izdzest_ierakstu.php");
	}
?>
