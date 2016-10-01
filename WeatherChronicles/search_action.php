<html>
    <link href='css/searchaction.css' rel='stylesheet' type='text/css'>

    <head>
        <style type="text/css">
              body {
                  background-image: url("img/DBbg-6.jpg");
                  background-color: #cccccc;
                  background-size: cover;
                  background-repeat: no-repeat;
              }
              th{
                font-size: 150%;
              }
        </style>

        <TITLE>
              Your Search Results!!!
        </TITLE>
        <a href="search.php">
            <img src="img/home.ico" style="float:right" height="50" width="50">
        </a>    
        <center>
            <h1>
                Here are your Results!!!<br>
                Click on the columns for the distribution of the Condition!!<br>
                Select the record for hour wise variations!<br>
                <img src="img/down.gif">
            </h1>
        </center>

    </head>

    <body>

    <center>
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
              $query="CALL Get_WeatherData('".$Zip_code[0]."','".$from_date."','".$to_date."','".$temperature.$humidity.$wind.$shark.$precipitation.$ocean.$tides.$moon."')";
              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "weather_chronicles";
              $conn = new mysqli($servername, $username, $password, $dbname);
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              } 
              echo "<table border ='2px'>";
              $details='plot.php?zip='.$Zip_code[0]."&from_date=";
              echo"<tr> "."<th>Date_Time</th>".
              (boolval($temperature) ? "<th><a href='".$details.explode(" ", $from_date)[0]."&to_date=".explode(" ", $to_date)[0]."&value=temperature'>"."Temperature</th>":" ").
              (boolval($humidity) ? "<th><a href='".$details.explode(" ", $from_date)[0]."&to_date=".explode(" ", $to_date)[0]."&value=humidity'>"."Humidity</th>":" ").
              (boolval($wind) ? "<th><a href='".$details.explode(" ", $from_date)[0]."&to_date=".explode(" ", $to_date)[0]."&value=wind'>"."Wind</th>":" ").
              (boolval($shark) ?"<th><a href='".$details.explode(" ", $from_date)[0]."&to_date=".explode(" ", $to_date)[0]."&value=shark'>"."Shark</th>":" ").
              (boolval($precipitation)?"<th><a href='".$details.explode(" ", $from_date)[0]."&to_date=".explode(" ", $to_date)[0]."&value=precipitation'>"."Precipitation</th>":" ").
              (boolval($ocean)?"<th>Color</th><th>Salinity</th><th>Water_Level</th><th>OceanTemperature</th>":" ").
              (boolval($tides)?"<th>Highft_AM</th><th>Highft_PM</th><th>HighTime_AM</th><th>HighTime_PM</th><th>Lowft_AM</th><th>Lowft_PM</th><th>"."LowTime_AM</th><th>LowTime_PM</th>":" ").
              (boolval($moon)?"<th>Sunrise_Time</th><th>Sunset_Time</th><th>Moonrise_Time</th><th>Moonset_Time</th><th>MoonPhase</th>":" ")."</tr>";
              $details='individual.php?zip='.$Zip_code[0]."&from_date=";
              $result = $conn->query($query);
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    echo"<tr> "."<td>".explode(" ", $row["Date_Time"])[0]."</td>".
                      (boolval($temperature) ? "<td><a href='".$details.explode(" ", $row["Date_Time"])[0]."&value=temperature'>".$row["Temperature"]."</a></td>":" ").
                      (boolval($humidity) ? "<td><a href='".$details.explode(" ", $row["Date_Time"])[0]."&value=humidity'>".$row["humidity"]."</a></td>":" ").
                      (boolval($wind) ? "<td><a href='".$details.explode(" ", $row["Date_Time"])[0]."&value=wind'>".
                        explode(" ",$row["WindDirection"])[0]." ".$row["Units"]."  ".explode(" ",$row["WindDirection"])[1]."</a></td>":" ").
                      (boolval($shark) ?"<td>".((boolval($row["CauseInjury"]=="N/A")? " " : (boolval($row["CauseInjury"])?
                        "<img height='50' width='50' src='img/shark.gif'><br>":""))).
                      "<a href='".$details.explode(" ", $row["Date_Time"])[0]."&value=shark'>".$row["CauseInjury"]."</a></td>":" ").
                      (boolval($precipitation)?"<td><a href='".$details.explode(" ", $row["Date_Time"])[0]."&value=precipitation'>".$row["precipitation"]."</a></td>":" ").
                      (boolval($ocean)?"<td><a href='".$details.explode(" ", $row["Date_Time"])[0].
                        "&value=oceanconditions'>".$row["Color"]."</td><td>".$row["Salinity"]."</td><td>".
                        $row["Water_Level"]."</td><td>".$row["OceanTemperature"]."</a></td>":" ").
                      (boolval($tides)?"<td><a href='".$details.explode(" ", $row["Date_Time"])[0]."&value=tides'>".
                        $row["Highft_AM"]."</td><td>".$row["Highft_PM"]."</td><td>".$row["HighTime_AM"]."</td><td>".
                        $row["HighTime_PM"]."</td><td>".$row["Lowft_AM"]."</td><td>".$row["Lowft_PM"]."</td><td>".
                        $row["LowTime_AM"]."</td><td>".$row["LowTime_PM"]."</a></td>":" ").
                      (boolval($moon)?"<td><a href='".$details.explode(" ", $row["Date_Time"])[0]."&value=moon'>":" ").
                        $row["Sunrise_Time"]."</td><td>".$row["Sunset_Time"]."</td><td>".$row["Moonrise_Time"]."</td><td>".$row["Moonset_Time"]."</td><td>".
                      ((boolval($row["MoonPhase"]=="N/A")? "N/A" : (boolval($row["MoonPhase"])?"<img src=img/".$row["MoonPhase"].".gif><br></td>":" ")))."</tr>";     
                  }
              } else {
                  $url='zero_results.php';
                  echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';                  
              }
              $conn->close();
          ?>
    </center>
    </body>
</html>