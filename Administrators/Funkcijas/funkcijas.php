<?php 
function connect(){
mysqli_connect("localhost", "root", "qrwe1432", "mountain_maniacs");
//ja Poga ir aktīva, vai nospiesta, tiks palaists php kods
if (isset($_POST['admin_login'])) {
	//saņemsim informāciju, un to glabāsim lokālajos mainīgajos
	$admin_username = $_POST['admin_lietotajvards'];
	$admin_pass = $_POST['admin_parole'];
// Piešķiram DB laukiem vērtības, ko tikko nedefinējām ar lokālajiem mainīgajiem
	$query = "SELECT * FROM administratori WHERE admin_lietotajvards = '$admin_username' AND admin_parole = '$admin_pass'";
$palaist = mysqli_query($query);
if (mysqli_num_rows($palaist) > 0) {
	echo "<scipt>window.open('skatit_lietotaju.php', '_self')</script>";
}
else{
	echo "<scipt>alert('Lietotājvārds vai parole ir nepareizi!')</script>";
}
}
}

function connect2(){
$con = mysqli_connect("localhost", "root", "qrwe1432", "mountain_maniacs");

//izvēlās visu informāciju no tabulas 'lietotaji'
$query = "SELECT * FROM lietotaji";


$palaist = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($palaist)) {
	
	$lietotaja_id = $row['id'];
	$vards = $row['vards'];
	$uzvards = $row['uzvards'];
	$lietotajvards = $row['lietotajvards'];
	$epasts = $row['epasts'];
?> 
echo "
<td><?php echo $lietotaja_id;   ?></td>
<td><?php echo $vards;   ?></td>
<td><?php echo $uzvards;   ?></td>
<td><?php echo $lietotajvards;   ?></td>
<td><?php echo $epasts;   ?></td>
<td>Dzēst</td>
</tr>
 } 
}
";


?>

