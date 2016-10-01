<html>
<body>
<center><table border='1'>
<?php 
  require 'dbconnect.php';  
  $from_date=$_POST['from_date'];
  $to_date=$_POST['to_date'];
  $temperature = $_POST['temperature'];
  $precipitation = $_POST['precipitation'];
  $wind = $_POST['winds'];
  $humidity = $_POST['humidity'];
  $shark=$_POST['shark'];
  $tides = $_POST['tides'];
  $ocean=$_POST['ocean'];
  $moon=$_POST['moon'];
  $Zip_code=$_POST['Zip'];
  $Zip_code=split('-', $Zip_code);  
  $query='select Location_ID '.(boolval($temperature) ? ',temperature' : '').(boolval($precipitation) ? ',precipitation.Percentage as precipitation' : '').(boolval($wind) ? ',concat(Wind_Speed," ",Direction) as speed' : '').(boolval($humidity) ? ',humidity.Percentage as humidity' : '').(boolval($ocean)?',Water_Level,Salinity,Color,Water_Temp' : '').' from humidity join precipitation join oceanconditions join temperature join winds join locations where humidity.Location_ID=precipitation.Location_ID=oceanconditions.Location_ID=temperature.Location_ID=winds.Location_ID=locations.Location_ID and Zip_code='.$Zip_code[0].' and Date_time>"'.$from_date.'" and Date_Time<"'.$to_date.'"';
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

  #$query='select temperature,precipitation.Percentage as precipitation,concat(Wind_Speed," ",Direction) as speed,humidity.Percentage as humidity from humidity join precipitation join temperature join winds join locations limit 10';
  $result = $conn->query($query);
  #echo $result->num_rows;
  $output_table = (boolval($temperature) ? '<th>Temperature</th>' : '').(boolval($precipitation) ? '<th>Precipitation</th>' : '').(boolval($humidity) ? '<th>Humidity</th>' : '').(boolval($wind) ? '<th>Wind</th>' : '').(boolval($ocean) ? '<th>Water_Level</th><th>Salinity</th><th>Color</th><th>Water_Temp</th>' : '')."</tr>";
  //echo $output_table;
  var_dump($result);
  echo "up above";
  if ($result) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $val = (boolval($temperature) ? '<td>'.$row["temperature"].'</td>' : '').(boolval($precipitation) ? '<th>'. $row["precipitation"].'</th>' : '').(boolval($humidity) ? '<td>'.$row["humidity"].'</td>' : '').(boolval($wind) ? '<td>'.$row['speed'].'</td>' : '').(boolval($ocean) ? '<td>'.$row['Water_Level'].'</td><td>'.$row['Salinity'].'</td><td>'.$row["Color"].'</td><td>'.$row["Water_Temp"].'</th>' : '')."</tr>";
        //echo $val;
#        echo $row["temperature"]. " \t " . $row["precipitation"]. "\t " . $row["precipitation"]."\t".$row["speed"]."\t".$row["humidity"]. "<br>";
    }
  } else {
    echo "0 results";
  }

  ?>
</table>
</center>
</body>
</html>