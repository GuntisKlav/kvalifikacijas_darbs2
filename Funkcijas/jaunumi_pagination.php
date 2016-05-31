<?php 
	$query = "SELECT * FROM ieraksti";
	$rezultats = mysqli_query($con, $query);


	//Izskaita visu ierakstu daudzumu
	$ierakstu_skaits = mysqli_num_rows($rezultats);

	//Sadala konkrētu skaitu ierakstu uz vienu lapu
	$total_pages = ceil($ierakstu_skaits / $uz_lapu);



 
	//Iet uz pirmo lapu
	echo "
	<center>
	<div id='pagination'>
	<a href='jaunumi.php?lapa1=1'> Pirmā lapa </a>
	";
	for ($i=1; $i<=$total_pages; $i++) {
	echo "<a href='jaunumi.php?lapa1=$i'>$i</a>";
	}
	// Iet uz pedēo lapu
	echo "<a href='jaunumi.php?lapa1=$total_pages'>Pēdējā lapa</a></center></div>";
	
	?>