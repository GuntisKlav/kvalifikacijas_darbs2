<?php
session_start();
include("Include/connection.php");
include("Funkcijas/funkcijas.php");
 

if (!isset($_SESSION['epasts'])) {

header("location: index.php");

} 
else
{
?>
<!doctype html>
<html>
<head>
	<title>Laipni lūgts!</title>
	
	<link rel="stylesheet" href="Stils/home_style.css" media="all"/>
</head>



<body>


<!--Container starts--> 
	<div class="container">
		<!--Header Wrapper Starts-->
		<div id="head_wrap">
			<!--Header Starts-->
			<div id="header">
				<ul id="menu">
					<li><a href="home.php">Sākums</a></li>
				<li><a href="lietotaji.php">Lietotāji</a></li>
					<li><a href="jaunumi.php">Jaunumi</a>
					<li><a href="pieteikties_braucienam.php">Pieteikties braucienam</a></li>
				</ul>
			
			</div>
			<!--Header ends-->
		</div>
		<!--Header Wrapper ends-->
			<div id="braucieni">
		<form action="" method="POST">
		<div id="header4">
		<center><h1>   Piesakies uz tuvāko braucienu!</h1></center>
		</div>
		<br>
							<input type="text" name="br_vards" placeholder=" Tavs vārds" required="required"/>
			
							<input type="text" name="br_uzvards" placeholder=" Tavs uzvārds" required="required"/><br><br>
							
							<input type="text" name="tel_nr" placeholder=" Tavs telefona numurs" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required="required"/>
							
							<input type="email" name="br_epasts" placeholder=" TavsEpasts@epasts.lv" required="required"/><br><br>
							
							<select name="vecums" id="vecums">
								<option>Tavs vecums</option>
								<option>14</option>
								<option>15</option>
							    <option>15</option>
							    <option>17</option>
							    <option>18</option>
							    <option>19</option>
							    <option>20</option>
							    <option>21</option>
							    <option>22</option>
							    <option>23</option>
							    <option>24</option>
							    <option>25</option>
							    <option>26</option>
							    <option>27</option>
							    <option>28</option>
							    <option>29</option>
							    <option>30</option>
							    <option>31</option>
							    <option>32</option>
							    <option>33</option>
							    <option>34</option>
							    <option>35</option>
							    <option>36</option>
							    <option>37</option>
							    <option>38</option>
							    <option>39</option>
							    <option>40</option>
							    <option>41</option>
							    <option>42</option>
							    <option>43</option>
							    <option>44</option>
							    <option>45</option>
							    <option>46</option>
							    <option>47</option>
							    <option>48</option>
							    <option>49</option>
							    <option>50</option>
							    <option>51</option>
							    <option>52</option>
							    <option>53</option>
							    <option>54</option>
							    <option>55</option>
							    <option>56</option>
							    <option>57</option>	
							</select>
							 
							<select name="prasmes">
								<option>Prasmju līmenis</option>
								<option>Iesācējs</option>
								<option>Vidējs</option>
								<option>Profesionālis</option>
							</select>

							<select name="noma">
							<option>Inventāra noma</option>
								<option>Jā</option>
								<option>Nē</option>
							</select>
							<textarea id="komentari1" name="komentari"> </textarea>
							<button name="piete">Pieteikties</button>

							</div>

				</form>
				<?php   
		       include("brauciena_pievienosana.php");
				?>
	</div>
	<!--Container ends-->
</body>
</html> 

<?php } ?>  