<table width="700">
			<tr>
				<th>Saņēmējs:</th>
				<th>Temats</th>
				<th>Datums</th>
				<th>Atbilde</th>
			</tr>
			
			<?php 
		
		$sel_msg = "SELECT * FROM zinas WHERE sutitajs='$lietotaja_id' ORDER by 1 DESC"; 
		
		$run_msg = mysqli_query($con,$sel_msg);		
		
		$count_msg = mysqli_num_rows($run_msg);
		
		while($row_msg=mysqli_fetch_array($run_msg))
		{
		
		$msg_id = $row_msg['zinas_id']; 
		$msg_receiver= $row_msg['sanemejs'];
		$msg_sender= $row_msg['sutitajs'];
		$msg_sub = $row_msg['zinas_kat'];
		$msg_topic = $row_msg['zinas_temats'];
		$msg_date = $row_msg['zinas_datums'];
		
		$get_receiver = "SELECT * FROM lietotaji WHERE id='$msg_receiver'"; 
		$run_receiver = mysqli_query($con,$get_receiver); 
		$row=mysqli_fetch_array($run_receiver); 
		
		$receiver_name = $row['lietotajvards'];
		
		
		?>
			
			<tr align="center">
				<td>
				<a href="lietotaja_profils.php?liet_id=<?php echo $msg_receiver;?>" target="blank">
				<?php echo $receiver_name;?>
				</a>
				</td>
				<td>
				<a href="manas_zinas.php?izsutne&zinas_id=<?php echo $msg_id;?>">
				<?php echo $msg_sub;?>
				</a>
				</td>
				<td><?php echo $msg_date;?></td>
				<td><a href="manas_zinas.php?izsutne&zinas_id=<?php echo $msg_id;?>">Skatīt atbildi</a></td>
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
			
			echo "<center><br/><hr>
			<h2>$msg_subject</h2>
			<p><b>Mana ziņa: </b> $msg_topic</p>
			<p><b>Lietotāja atbilde: </b> $reply_content</p>

			</center>
			";
			}
		
		?>