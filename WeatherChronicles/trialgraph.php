<?php
session_start();
$example_data=($_SESSION['array_to_save']);
$attribute=($_SESSION['attribute']);
include 'line.php';
draw_graph($example_data,$attribute);
?>
<<!DOCTYPE html>
<html>
<head>
	<title><?php echo ($_SESSION['attribute']); ?> variation</title>
</head>
<body>
This is the <?php echo ($_SESSION['attribute']); ?> variation you Requested 
<center>
<img src="<?php echo $plot->EncodeImage();?>" alt="Plot Image">
</center>
</body>
</html>