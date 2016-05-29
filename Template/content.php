<!--Content area starts-->

		<div id="content">
		<div id="parMM">
		<br>
		<center><h1>Par Mountain Maniacs</h1><center><br>
		<div id="text">
			<p>
			"Mountain Maniacs" ir divu jauniešu izveidota kopiena, kurā visi ir kā viena liela ģimene. Šīs grupas pirmsākumi meklējami 2013. gadā, kad sezonas vidū Edgars un Frederiks nolēma dibināt ko aizraujošu. Sasaucot sev pazīstamos kalnu mīlētājus tika veidots pirmais brauciens 2013. gada 6. februārī. Mūsu skatījumā tas bija aizraujošs un katram no tā ir savas patīkamās atmiņas, tā mēs turpinājām to darīt un ar katru gadu augam un augam. Pirmais brauciens tika aizvadīts 21 cilvēka kompānijā, toties lielākais brauciens sastāvēja no 73 ziemas mīlētājiem. "Mountain Maniacs" ir vieta, kur satiekas iesācēji, viduvēja un laba līmeņa braucēji. Vienmēr viens otru pamācīs, tāpēc nevajag baidīties, ja neko daudz par snovošanu/slēpošanu nezini. Nekautrējies un pievienojies!
			</p>
		</div> 
		</div>
			<div id="form2">
				<form action="" method="POST">
					<table> 
						<tr>
							<td align="right"></td>
							<td>
							<input type="text" name="vards" placeholder=" Ievadi savu vārdu" required="required"/>
							</td>
						</tr>
						<tr>
							<td align="right"></td>
							<td>
							<input type="text" name="uzvards" placeholder=" Ievadi savu uzvārdu" required="required"/>
							</td>
						</tr>
						<tr>
							<td align="right"></td>
							<td>
							<input type="text" name="lietotajvards" placeholder=" Ievadi savu lietotājvārdu" required="required"/>
							</td>
						</tr>
						<tr>
							<td align="right"></td>
							<td>
							<input type="password" name="parole" placeholder=" Ievadi savu paroli" required="required"/>
							</td>
						</tr>
						
						<tr>
							<td align="right"></td>
							<td>
							<input type="email" name="epasts1" placeholder=" Ievadi savu epastu" required="required"></td>
						</tr>
						
						<tr>
							<td align="right" required="required"></td>
							<td>
							<select name="dzimums">
								<option>Izvēlies dzimumu</option>
								<option>Vīrietis</option>
								<option>sieviete</option>
								
							</select>
							</td>
						</tr>
						
						<tr>
							<td align="right"></td>
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