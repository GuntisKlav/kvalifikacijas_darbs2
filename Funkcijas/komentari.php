<?php 
	$get_id = $_GET['ieraksta_id'];
		
	$get_kom = "SELECT * FROM komentari WHERE ieraksta_id='$get_id' ORDER by 1 DESC";
	
	$run_kom = mysqli_query($con,$get_kom);
	
	while($rinda=mysqli_fetch_array($run_kom)){
	
		$komentars = $rinda['komentars']; 
		$autors= $rinda['komentara_autors']; 
		$ievietosanas_d = $rinda['ievietosanas_d']; 
		
		echo "
		<div id='komentars'>
		<h3>$autors</h3><span><i> minēja</i> $ievietosanas_d</span>
		<p>$komentars</p>
		</div>
		";
	}
	
?>