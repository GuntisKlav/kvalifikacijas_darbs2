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
	<div id='pagi nation'>
	<a href='home.php?page=1'>Pirmā lapa</a>
	";
	for ($i=1; $i<=$total_pages; $i++) {
	echo "<a href='home.php?page=$i'>$i</a>";
	}
	// Iet uz pedēo lapu
	echo "<a href='home.php?page=$total_pages'>Pēdējā lapa</a></center></div>";
	
	?>