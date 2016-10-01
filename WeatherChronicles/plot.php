<!DOCTYPE html>
<html>
	<head>
		<title>Trend</title>
	</head>
	
	<body>
	<?php
	    $servername = "localhost";
	    $username = "root";
	    $password = "";
	    $dbname = "weather_chronicles";
	    $conn = new mysqli($servername, $username, $password, $dbname);
	    if ($conn->connect_error) {
	        die("Connection failed: " . $conn->connect_error);
	    } 
		$zip=$_GET['zip'];
		$from_date=$_GET['from_date'];
		$to_date=$_GET['to_date'];
		$attribute=$_GET['value'];
		switch ($attribute) {
 			case 'temperature':
 				$attribute='Temperature';
 				$bit='10000000';
        		break;
		    case 'humidity':
 				$bit='01000000';
 				break;
		    case 'wind':
		    	$attribute="WindDirection";
		        $bit='00100000';
		        break;
 			case 'shark':
 				$attribute="CauseInjury";
 				$bit='00010000';
        		break;
		    case 'precipitation':
		        $bit='00001000';
		        break;
		    case 'oceanconditions':
		        $bit='00000100';
		        break;
		    case 'tides':
		        $bit='00000010';
		        break;
		    case 'moon':
		        $bit='00000001';
		        break;
		    default:
		        $bit='00000000';
		}
		$proc_call="CALL Get_WeatherData ('".$zip."','".$from_date."','".$to_date."','".$bit."')";
		#echo $proc_call;
		session_start();
		$plot_data=array();
		$result = $conn->query($proc_call);
              if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                  		$val=explode(" ", ($row[$attribute]))[0];
                  		$date=explode(":", ($row['Date_Time']))[0];
                  		$dat=explode(" ",explode("-", ($date))[2])[0];
                  		$plot_data[]=array($dat,$val);
                  }
              } else {
                  $url='zero_results.php';
                  echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
                  
              }
              $_SESSION['attribute']=$attribute;
	          $_SESSION['array_to_save'] = $plot_data;
         #     var_dump($plot_data);
              $url='trialgraph.php';
              echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
              $conn->close();
	?>
</body>
</html>