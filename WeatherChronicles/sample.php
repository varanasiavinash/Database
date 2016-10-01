<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "weather_chronicles";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "<center>";
echo "<table border ='2px'>";
$sql = "CALL GET_WeatherData (28422,'2014-06-02','2014-06-11','11111111');";
$result = $conn->query($sql);
echo "<tr><th> " . "Temperature". "</th><th> " . "humidity". "</th><th>" . "Direction".' '.'Units'."</th><th>" . "Direction" ."</th><th>" . "Units" ."</th><th>" . "Wind_Gusts" ."</th><th>" . "Wind_Speed". "</th><th>" . "Injury_caused". "</th><th>" . "Occurance_date" ."</th><th>" . "precipitation" ."</th><th>" . "Color" ."</th><th>" . "Salinity" ."</th><th>" . "Water_Level" ."</th><th>" . "OceanTemperature" ."</th><th>" . "Highft_AM" ."</th><th>" . "Highft_PM" ."</th><th>" . "HighTime_AM" ."</th><th>" . "HighTime_PM" ."</th><th>" . "Lowft_AM" ."</th><th>" . "Lowft_PM" ."</th><th>" . "LowTime_AM" ."</th><th>" . "LowTime_PM" ."</th><th>" . "Sunrise_Time". "</th><th>" . "Sunset_Time" ."</th><th>" . "Moonrise_Time" ."</th><th>" . "Moonset_Time" ."</th><th>" . "MoonPhase" ."</th><th>" . "Date_Time" ."</th><th>" . "location_ID" ."</th></tr>";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
 //   	 | Direction | Units | Wind_Gusts | Wind_Speed | Injury_caused | Occurance_date | precipitation | Color | Salinity | Water_Level | OceanTemperature | Highft_AM | Highft_PM | HighTime_AM | HighTime_AM | HighTime_PM | Lowft_AM | Lowft_PM | LowTime_AM | LowTime_PM | Sunrise_Time | Sunset_Time | Moonrise_Time | Moonset_Time | MoonPhase | Date_Time           | location_ID
        echo "<tr><td> " . $row["Temperature"]. "</td><td> " . $row["humidity"]. "</td><td>" . $row["Direction"].' '.$row['Units']."</td><td>" . $row["Direction"] ."</td><td>" . $row["Units"] ."</td><td>" . $row["Wind_Gusts"] ."</td><td>" . $row["Wind_Speed"]. "</td><td>" . $row["Injury_caused"]. "</td><td>" . $row["Occurance_date"] ."</td><td>" . $row["precipitation"] ."</td><td>" . $row["Color"] ."</td><td>" . $row["Salinity"] ."</td><td>" . $row["Water_Level"] ."</td><td>" . $row["OceanTemperature"] ."</td><td>" . $row["Highft_AM"] ."</td><td>" . $row["Highft_PM"] ."</td><td>" . $row["HighTime_AM"] ."</td><td>" . $row["HighTime_PM"] ."</td><td>" . $row["Lowft_AM"] ."</td><td>" . $row["Lowft_PM"] ."</td><td>" . $row["LowTime_AM"] ."</td><td>" . $row["LowTime_PM"] ."</td><td>" . $row["Sunrise_Time"]. "</td><td>" . $row["Sunset_Time"] ."</td><td>" . $row["Moonrise_Time"] ."</td><td>" . $row["Moonset_Time"] ."</td><td>" . $row["MoonPhase"] ."</td><td>" . $row["Date_Time"] ."</td><td>" . $row["location_ID"] ."</td></tr>";
    	echo '<br>';
    }
} else {
    echo "0 results";
}
$conn->close();
?>