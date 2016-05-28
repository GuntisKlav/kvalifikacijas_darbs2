	<?php 
	$query = "SELECT * FROM ieraksti";
	$rezultats = mysqli_query($con, $query);


	//Izskaita visu ierakstu daudzumu
	$ierakstu_skaits = mysqli_num_rows($rezultats);

	//Sadala konkrētu skaitu ierakstu uz vienu lapu
	$total_pages = ceil($ierakstu_skaits / $uzlapu);




	//Iet uz pirmo lapu
	echo "
	<center>
	<div id='pagination'>
	<a href='mani_zinojumi.php?page=1'> Pirmā lapa </a>
	";
	for ($i=1; $i<=$total_pages; $i++) {
	echo "<a href='mani_zinojumi.php?page=$i'>$i</a>";
	}
	// Iet uz pedējo lapu
	echo "<a href='mani_zinojumi.php?page=$total_pages'>Pēdējā lapa</a></center></div>";
	
	?>