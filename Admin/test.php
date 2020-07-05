<?php
include("HBA_GD.php");

$gd = new HBA_GD("test1", 1000, 300, "#3399cc");
	
	$gd->set_axes(30, 7, "#ccffff");

	$gd->Output();

echo "<img src='test1.jpg'>";
?>