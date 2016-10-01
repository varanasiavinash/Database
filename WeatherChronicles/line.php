<?php
function draw_graph($example_data,$attribute)
{

	require_once 'phplot.php';
	$plot = new PHPlot_truecolor(800,800);
	$plot->SetTitle('Distribution of '. $attribute);
	$plot->SetImageBorderType('plain'); // Improves presentation in the manual
	$plot->SetDataValues($example_data);
	$plot->SetPlotType('linepoints');
	$plot->SetDrawYDataLabelLines(True);
	$plot->SetXTitle("Selected Dates");
	$plot->SetYTitle($attribute);
	$plot->DrawGraph();
}
