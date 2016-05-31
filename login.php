<?php 
		//session_start(); 
		
		include("Include/connection.php");
		if(isset($_POST['login1'])){
			
		$em = mysqli_real_escape_string($con,$_POST['email1']);
		$pass = mysqli_real_escape_string($con,$_POST['pass1']);
		
		$get_user = "SELECT * FROM lietotaji WHERE epasts='$em' AND parole='$pass'";
		
		$run_user = mysqli_query($con, $get_user);
		
		$check = mysqli_num_rows($run_user);
		
		if($check==1){
		
			$_SESSION['epasts']=$em;
			
			echo "<script>window.open('home.php','_self')</script>";
		
		}
			else {
			echo "<script>alert('Passowrd or email is not correct!')</script>";
		}
		
		}
?>