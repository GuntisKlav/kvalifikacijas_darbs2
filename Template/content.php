<!--Content area starts-->
		<div id="content">
			<div id="form2">
				<form action="" method="POST">
				<h2>Reģistrējies jau šodien!</h2>
					<table> 
						<tr>
							<td align="right">Vārds:</td>
							<td>
							<input type="text" name="vards" placeholder=" Ievadi savu vārdu" required="required"/>
							</td>
						</tr>
						<tr>
							<td align="right">Uzvārds:</td>
							<td>
							<input type="text" name="uzvards" placeholder=" Ievadi savu uzvārdu" required="required"/>
							</td>
						</tr>
						<tr>
							<td align="right">Lietotājvārds:</td>
							<td>
							<input type="text" name="lietotajvards" placeholder=" Ievadi savu lietotājvārdu" required="required"/>
							</td>
						</tr>
						<tr>
							<td align="right">Parole:</td>
							<td>
							<input type="password" name="parole" placeholder=" Ievadi savu paroli" required="required"/>
							</td>
						</tr>
						
						<tr>
							<td align="right">Epasts:</td>
							<td>
							<input type="email" name="epasts1" placeholder=" Ievadi savu epastu" required="required"></td>
						</tr>
						
						<tr>
							<td align="right" required="required">Dzimums:</td>
							<td>
							<select name="dzimums">
								<option>Izvēlies dzimumu</option>
								<option>Vīrietis</option>
								<option>sieviete</option>
								
							</select>
							</td>
						</tr>
						
						<tr>
							<td align="right">Dzimšanas diena:</td>
							<td>
							<input type="date" name="dz_diena"/>
							</td>
						</tr>
						
						<tr>
							<td colspan="6">
							<button name="reg">Reģistrēties</button>
							</td>
						</tr>
					</table>
				</form>
				
				<?php   
		       include("lietotaja_pievienosana.php");
				?>
			</div>
		</div>
		<!--Content area ends-->