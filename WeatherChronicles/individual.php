<!DOCTYPE html>
<html>
	<link href='searchaction.css' rel='stylesheet' type='text/css'>
	<head>
		<title>Trends</title>
		<center><br>
			<a href="search.php">
				<img src="img/home.ico" style="float:right" height="50" width="50">
			</a>

			<h1 style="color:black">
				There you go!!!
				<br>
				The data you enquired for the calendar day of <br><b>
				<?php 
						echo $_GET['from_date'];
				?></b>
			</h1> 
		</center>
		<style type="text/css">
			body {
			    background-image: url("img/spot_weather.jpg");
			    background-color: #cccccc;
			    background-size: cover;
			    background-repeat: no-repeat;
			}
		</style>
	</head>

	<body>
		<center><br><br>
			<?php
				echo "<table border ='2px'>";
				$temperature=false;
				$humidity=false;
				$wind=false;
				$shark=false;
				$precipitation=false;
				$ocean=false;
				$tides=false;
				$moon=false;
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "weather_chronicles";
				$conn = new mysqli($servername, $username, $password, $dbname);
				if ($conn->connect_error) 
					{
						die("Connection failed: " . $conn->connect_error);
					} 
				$zip=$_GET['zip'];
				$date=$_GET['from_date'];
				$attribute=$_GET['value'];
				switch ($attribute) 
					{
						case 'temperature':
							$attribute='Temperature';
							$bit='10000000';
							$temperature=true;
							break;
						case 'humidity':
							$bit='01000000';
							$humidity=true;
							break;
						case 'wind':
							$wind=true;
							$attribute="Direction";
							$bit='00100000';
							break;
						case 'shark':
							$shark=true;
							$bit='00010000';
							break;
						case 'precipitation':
							$precipitation=true;
							$bit='00001000';
							break;
						case 'oceanconditions':
							$ocean=true;
							$bit='00000100';
							break;
						case 'tides':
							$tides=true;
							$bit='00000010';
							break;
						case 'moon':
							$moon=true;
							$bit='00000001';
							break;
						default:
							$bit='00000000';
					}
				echo"<tr> "."<th>Date_Time</th>".
				(boolval($temperature) ? "<th>Temperature</th>":" ").
				(boolval($humidity) ? "<th>humidity</th>":" ").
				(boolval($wind) ? "<th>Direction</th><th>Units</th>":" ").
				(boolval($shark) ?"<th>Injury_caused</th>":" ").
				(boolval($precipitation)?"<th>precipitation</th>":" ").
				(boolval($ocean)?"<th>Color</th><th>Salinity</th><th>Water_Level</th><th>OceanTemperature</th>":" ").
				(boolval($tides)?"<th>Highft_AM</th><th>Highft_PM</th><th>HighTime_AM</th><th>HighTime_PM</th><th>Lowft_AM</th><th>Lowft_PM</th><th>"."LowTime_AM</th><th>LowTime_PM</th>":" ").
				(boolval($moon)?"<th>Sunrise_Time</th><th>Sunset_Time</th><th>Moonrise_Time</th><th>Moonset_Time</th><th>MoonPhase</th>":" ")."</tr>";
				$proc_call="CALL Get_WeatherDataHourly ('".$zip."','".$date."','".$bit."')";
				#echo $proc_call;
				$result = $conn->query($proc_call);
				if ($result->num_rows > 0)
					{
						while($row = $result->fetch_assoc()) 
							{
								echo"<tr> "."<td>".$row["Date_Time"]."</td>".
								(boolval($temperature) ? "<td>".$row["Temperature"]."</td>":" ").
								(boolval($humidity) ? "<td>".$row["humidity"]."</td>":" ").
								(boolval($wind) ? "<td>".$row["WindDirection"]."</td><td>".$row["Units"]."</td>":" ").
								(boolval($shark) ?"<td>".$row["CauseInjury"]."</td>":" ").
								(boolval($precipitation)?"<td>".$row["precipitation"]."</td>":" ").
								(boolval($ocean)?"<td>".$row["Color"]."</td><td>".$row["Salinity"]."</td><td>".$row["Water_Level"]."</td><td>".$row["OceanTemperature"]."</td>":" ").
								(boolval($tides)?"<td>".$row["Highft_AM"]."</td><td>".$row["Highft_PM"]."</td><td>".$row["HighTime_AM"]."</td><td>".$row["HighTime_PM"]."</td><td>".$row["Lowft_AM"]."</td><td>".$row["Lowft_PM"]."</td><td>".$row["LowTime_AM"]."</td><td>".$row["LowTime_PM"]."</td>":" ").
								(boolval($moon)?"<td>".$row["Sunrise_Time"]."</td><td>".$row["Sunset_Time"]."</td><td>".$row["Moonrise_Time"]."</td><td>".$row["Moonset_Time"]."</td><td>".$row["MoonPhase"]."</td>":" ")."</tr>";
							}
					} 
				$conn->close();
			?>
		</center>
	</body>
</html>