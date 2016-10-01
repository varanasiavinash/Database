<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Weather Chronicles</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/grayscale.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<style type="text/css">
 tr.spaceUnder > td
{
  padding-bottom: 1em;
}

table{
  width="100%";
  border="0";
  cellspacing="110";
  cellpadding="110";
  border-collapse:separate;
  border-spacing:1em;
}
td {
    padding-top: .5em;
    padding-bottom: .5em;
}
</style>

<script type="text/javascript" source="C:\xampp\htdocs\DB\css\bootstrap.css">
 function checkForm()
  {
      var date1 = new Date(document.forms["Search_Form"]["from_date"].value);
      var date2 = new Date(document.forms["Search_Form"]["to_date"].value);
      if (date1>date2) {
        alert("Sorry the selected time period is either invalid or is not available");
        return false;
    } 
      var timeDiff = Math.abs(date2.getTime() - date1.getTime());
      var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
      if (diffDays <1 || diffDays >120) {
        alert("Sorry the selected time period is either invalid or is not available");
        return false;
    } 
  }



  function validateForm() {
    var x = document.forms["Search_Form"]["Zip"].value;
    if (x == null || x == "") {
        alert("Please Fill in the ZipCode");
        return false;
    }
}
</script>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-shield fa-flip-vertical"></i>  <span class="light">Top</span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
						
                        <a class="page-scroll" href="#about"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp Search</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Weather Chr<i class="fa fa-refresh fa-spin"></i>nicles</h1>
                        <p class="intro-text">A Historic Weather Database</p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-hand-o-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="content-section text-center">
        <div class="row">
            <div class="col-lg-12">
                <h2> Search Here</h2>
				<center>
					<form name="Search_Form" action="search_action.php" method="post" onsubmit="return checkForm()">
			<p align="center" style="font-size:100%">
           Select Zip Code:&nbsp
		  
            <select class="selectpicker" id="sel1" name="Zip" style="background-color: gray">
            <option selected disabled>Choose here</option>
            <?php
            require 'dbconnect.php';  
			 $result = $conn->query("SELECT distinct(Zip_code),state FROM locations");
            #$result = mysql_query("SELECT distinct(Zip_code),state FROM locations");
            //echo "<select name='Zip' value=''><option>Zip Codes</option>";
            while($r = $result->fetch_assoc()) {
              echo "<option>".$r['Zip_code'].'-'.$r['state']."</option>"; 
            }
            echo "</select>";
          ?>
		  </p>
       
    <table align="center" width="10%" height="auto" color="fff">
	<tbody>
	</tr>
          <tr>
              <td>
                  From: <input type="date" name="from_date" value="2014-07-01" style="background-color: gray" data-date-inline-picker="false" required />
              </td>
              <td>
                  Till: <input type="date" name="to_date" value="2014-07-01" style="background-color: gray" data-date-inline-picker="false" required />
              </td>
          </tr>
          <tr>
              <td>
                  <input type='hidden' value='0' name='temperature'>
                  <input type='hidden' value='0' name='humidity'>
                  <input type='hidden' value='0' name='winds'>
                  <input type='hidden' value='0' name='tides'>
                  <input type='hidden' value='0' name='precipitation'>
                  <input type='hidden' value='0' name='moon'>
                  <input type='hidden' value='0' name='shark'>
                  <input type='hidden' value='0' name='ocean'>
                  <input type="checkbox" name="temperature" value="1" ><label>Temperature</label>
              </td>
              <td>
                  <input type="checkbox" name="humidity" value="1"><label>Humidity</label><br>
              </td>
          </tr>
          <tr>
              <td>
                  <input type="checkbox" name="winds" value="1" ><label>Wind Condition</label><br>
              </td>
              <td>
                  <input type="checkbox" name="tides" value="1" ><label>Tidal Currents</label><br>
              </td>
          </tr>
          <tr>
              <td>
                  <input type="checkbox" name="precipitation" value="1"><label>Precipitation</label><br>
              </td>
              <td>
                  <input type="checkbox" name="moon" value="1"><label>Lunar Calendar</label><br>
              </td>
          </tr>

          <tr>
              <td>
                  <input type="checkbox" name="shark" value="1"><label>Shark Attacks</label><br>
              </td>
              <td>
                  <input type="checkbox" name="ocean" style="font-color:red"value="1"><label>Ocean Conditions</label><br>
              </td>

          </tr>
          <tr>
              <td>
                  <button type="submit" class="btn btn-default" value="Submit">Submit</button>
              </td>
              <td>
                  <button type="submit" class="btn btn-default" value="Reset" size="20">Reset</button>
              </form>
              </td>
          </tr>
          </tbody>

      </table>

				</center>
            </div>
        </div>
    </section>


    <!-- Contact Section -->
    <section id="contact" class="contact-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2 style="color:white"> We cherish all interactions </h2>
				<br><br><br><br><br><br><br><br><br><br><br>
				
                <ul class="list-inline banner-social-buttons">
                    <li>
                        <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                    </li>
                    <li>
                        <a href="https://github.com/bsachin207/Database6160" class="btn btn-default btn-lg"><i class="fa fa-github"></i> <span class="network-name">Github</span></a>
                    </li>
                    <li>
                        <a href="mailto:spartans6160@googlegroups.com" class="btn btn-default btn-lg"><i class="fa fa-envelope"></i> <span class="network-name">Email</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p style="font-family:verdana;color:#484848;font-size:100%;" align="left">This web site is a part of academic project<br>Credits to Bootstrap,Google Images</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>

</body>

</html>
