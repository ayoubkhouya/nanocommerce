<?php include("../config.php");?>
<!DOCTYPE html>
<html>
<head>
	<title>Statistiques</title>
	<script type="text/javascript" src="../js/jquery.js"></script>
<style type="text/css">
#myy{
	margin-left: -2000px;
	position: absolute;
	transition: all 0.5s ease;
}
#myy{
	transition: all 0.5s ease;
}
.brr{
	border: 2px solid #34495e;
}
</style>
<script type="text/javascript">
	function getData(){
		document.getElementById('myy').style.marginLeft = "-8px";
		document.getElementById('myy').style.marginTop = "-8px";
	}
	setTimeout("getData()", 500);
</script>
</head>
<body bgcolor="#ecf0f1">
<?php

$img = imagecreate(500, 300);
$bg = imagecolorallocate($img, 52, 152, 219);
$black = imagecolorallocate($img, 0, 0, 0);
$white    = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
$gray     = imagecolorallocate($img, 0xC0, 0xC0, 0xC0);
$darkgray = imagecolorallocate($img, 0x90, 0x90, 0x90);
$navy     = imagecolorallocate($img, 0x00, 0x00, 0x80);
$darknavy = imagecolorallocate($img, 0x00, 0x00, 0x50);
$red      = imagecolorallocate($img, 0xFF, 0x00, 0x00);
$darkred  = imagecolorallocate($img, 0x90, 0x00, 0x00);

$sql = "SELECT * FROM detcommands";
$res = $conn->query($sql);
$maxsales = mysqli_num_rows($res);
$mx = $maxsales;
$sql = "SELECT * FROM categories";
$res = $conn->query($sql);
$cats = mysqli_num_rows($res);

imageline($img, 20, 20, 20, 280, $white);
imageline($img, 10, 30, 20, 20, $white);
imageline($img, 20, 20, 30, 30, $white);

imageline($img, 20, 280, 480, 280, $white);
imageline($img, 480, 280, 470, 270, $white);
imageline($img, 480, 280, 470, 290, $white);

for($i=1;$i<=12;$i++){
	imagestring($img, 2, $i*30 + 40, 285, $i, $white);
}
for($i=1;$i<=12;$i++){
	imagestring($img, 2, 5,  280 - ($i*20), floor(300/$maxsales) * $i, $white);
}
imagestring($img, 7, 50, 20, "Sales Timeline (Line)", $white);
imagestring($img, 4, 50, 40, "All Categories (per month)", $white);
$y = date('Y');
$sql = "SELECT  count(detcommands.id_det) how, date_cmd FROM categories LEFT JOIN products ON categories.id_cat=products.id_cat LEFT JOIN detcommands ON products.id_pro=detcommands.id_pro LEFT JOIN commands ON commands.id_cmd=detcommands.id_cmd WHERE date_cmd>='$y-01-01' AND date_cmd<='$y-12-31' GROUP BY commands.date_cmd";
$tbmonth = array();
for($mn=0;$mn<12;$mn++){
	$tbmonth[$mn] = 0;
	$res = $conn->query($sql);
	for($ms=0;$ms<mysqli_num_rows($res);$ms++){
		$row = $res->fetch_assoc();
		if(substr($row['date_cmd'], 5, 2)+0 == ($mn+1)){
			$tbmonth[$mn] += $row['how'];
		}
	}
}$last = 278;
for($i=0;$i<12;$i++){
	imageline($img, 30 * ($i+1) + 10, $last, 30 * ($i+1) + 40, 278-$tbmonth[$i] * 3, $red);
	$last = 278-$tbmonth[$i] * 3;
}
$img = imagejpeg($img, "graphs/line.jpg");

/////////////////////////////////////////////////////////////////

$img = imagecreate(500, 300);
$bg = imagecolorallocate($img, 52, 152, 219);
$black = imagecolorallocate($img, 0, 0, 0);
$white    = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
$gray     = imagecolorallocate($img, 0xC0, 0xC0, 0xC0);
$darkgray = imagecolorallocate($img, 0x90, 0x90, 0x90);
$navy     = imagecolorallocate($img, 0x00, 0x00, 0x80);
$darknavy = imagecolorallocate($img, 0x00, 0x00, 0x50);
$red      = imagecolorallocate($img, 0xFF, 0x00, 0x00);
$darkred  = imagecolorallocate($img, 0x90, 0x00, 0x00);

imageline($img, 20, 20, 20, 280, $white);
imageline($img, 10, 30, 20, 20, $white);
imageline($img, 20, 20, 30, 30, $white);

imageline($img, 20, 280, 480, 280, $white);
imageline($img, 480, 280, 470, 270, $white);
imageline($img, 480, 280, 470, 290, $white);

for($i=1;$i<=12;$i++){
	imagestring($img, 2, $i*30 + 40, 285, $i, $white);
}
for($i=1;$i<=12;$i++){
	imagestring($img, 2, 5,  280 - ($i*20), floor(300/$maxsales) * $i, $white);
}
imagestring($img, 7, 50, 20, "Sales Timeline (Line)", $white);
imagestring($img, 4, 50, 40, "By Category (per month)", $white);
$y = date('Y');
$sql = "SELECT count(detcommands.id_det) how, date_cmd, categories.id_cat id_cat FROM categories LEFT JOIN products ON categories.id_cat=products.id_cat LEFT JOIN detcommands ON products.id_pro=detcommands.id_pro LEFT JOIN commands ON commands.id_cmd=detcommands.id_cmd GROUP BY categories.id_cat";
$tbmonth = array();
$sqm = "SELECT * FROM categories";
$rsm = $conn->query($sqm);
while($rw = $rsm->fetch_assoc()){
	for($mn=0;$mn<12;$mn++){
		$tbmonth[$rw['id_cat']][$mn] = 0;
		$res = $conn->query($sql);
		for($ms=0;$ms<mysqli_num_rows($res);$ms++){
			$row = $res->fetch_assoc();
			if(substr($row['date_cmd'], 5, 2)+0 == ($mn+1) && $row['id_cat'] == $rw['id_cat']){
				$tbmonth[$rw['id_cat']][$mn] += $row['how'];
			}
		}
	}
}
$last = 278;
$rsm = $conn->query($sqm);
$tbcol2 = array($red, $navy, $gray, $white);
$ko=0;
imagestring($img, 5, 300, 50, "Significations : ", $white);
while($rw = $rsm->fetch_assoc()){
	$ttl=0;
	for($i=0;$i<12;$i++){
		imageline($img, 30 * ($i+1) + 10, $last, 30 * ($i+1) + 40, 278-$tbmonth[$rw['id_cat']][$i] * 3, $tbcol2[$ko]);
		imagefilledarc($img, 30 * ($i+1) + 10, $last, 4, 4, 0, 360, $tbcol2[$ko], IMG_ARC_EDGED);
		$last = 278-$tbmonth[$rw['id_cat']][$i] * 3;
		$ttl+=$tbmonth[$rw['id_cat']][$i];
	}
	imagefilledrectangle($img, 300, 20 * ($ko+1) + 52, 310, 20 * ($ko+1) + 62, $tbcol2[$ko]);
	$ko++;
	imagestring($img, 4, 320, 20 * $ko + 50, $rw['nom_cat']." ($ttl sales)", $white);
}
$img = imagejpeg($img, "graphs/line2.jpg");

/////////////////////////////////////////////////////////////////

$img = imagecreate(500, 300);
$bg = imagecolorallocate($img, 52, 152, 219);
$black = imagecolorallocate($img, 0, 0, 0);
$white    = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
$gray     = imagecolorallocate($img, 0xC0, 0xC0, 0xC0);
$darkgray = imagecolorallocate($img, 0x90, 0x90, 0x90);
$navy     = imagecolorallocate($img, 0x00, 0x00, 0x80);
$darknavy = imagecolorallocate($img, 0x00, 0x00, 0x50);
$red      = imagecolorallocate($img, 0xFF, 0x00, 0x00);
$darkred  = imagecolorallocate($img, 0x90, 0x00, 0x00);

imageline($img, 20, 20, 20, 280, $white);
imageline($img, 10, 30, 20, 20, $white);
imageline($img, 20, 20, 30, 30, $white);

imageline($img, 20, 280, 480, 280, $white);
imageline($img, 480, 280, 470, 270, $white);
imageline($img, 480, 280, 470, 290, $white);

for($i=1;$i<=12;$i++){
	imagestring($img, 2, $i*30 + 40, 285, $i, $white);
}
for($i=1;$i<=12;$i++){
	imagestring($img, 2, 5,  280 - ($i*20), floor(300/$maxsales) * $i, $white);
}
imagestring($img, 7, 50, 20, "Sales Timeline (2D)", $white);
imagestring($img, 4, 50, 40, "All Categories (per month)", $white);
$y = date('Y');
$sql = "SELECT  count(detcommands.id_det) how, date_cmd FROM categories LEFT JOIN products ON categories.id_cat=products.id_cat LEFT JOIN detcommands ON products.id_pro=detcommands.id_pro LEFT JOIN commands ON commands.id_cmd=detcommands.id_cmd WHERE date_cmd>='$y-01-01' AND date_cmd<='$y-12-31' GROUP BY commands.date_cmd";
$tbmonth = array();
for($mn=0;$mn<12;$mn++){
	$tbmonth[$mn] = 0;
	$res = $conn->query($sql);
	for($ms=0;$ms<mysqli_num_rows($res);$ms++){
		$row = $res->fetch_assoc();
		if(substr($row['date_cmd'], 5, 2)+0 == ($mn+1)){
			$tbmonth[$mn] += $row['how'];
		}
	}
}
for($i=0;$i<12;$i++){
	imagefilledrectangle($img, 30 * ($i+1) + 35, 278, 30 * ($i+1) + 50, 278-$tbmonth[$i] * 3, $navy);
}
$img = imagejpeg($img, "graphs/tmln.jpg");


////////////////////////////////////////////////////////////////////////////

$img = imagecreate(500, 300);
$bg = imagecolorallocate($img, 52, 152, 219);
$black = imagecolorallocate($img, 0, 0, 0);
$white    = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
$gray     = imagecolorallocate($img, 0xC0, 0xC0, 0xC0);
$darkgray = imagecolorallocate($img, 0x90, 0x90, 0x90);
$navy     = imagecolorallocate($img, 0x00, 0x00, 0x80);
$darknavy = imagecolorallocate($img, 0x00, 0x00, 0x50);
$red      = imagecolorallocate($img, 0xFF, 0x00, 0x00);
$darkred  = imagecolorallocate($img, 0x90, 0x00, 0x00);

imageline($img, 20, 20, 20, 280, $white);
imageline($img, 10, 30, 20, 20, $white);
imageline($img, 20, 20, 30, 30, $white);

imageline($img, 20, 280, 480, 280, $white);
imageline($img, 480, 280, 470, 270, $white);
imageline($img, 480, 280, 470, 290, $white);

for($i=1;$i<=12;$i++){
	imagestring($img, 2, $i*30 + 40, 285, $i, $white);
}
for($i=1;$i<=12;$i++){
	imagestring($img, 2, 5,  280 - ($i*20), floor(300/$maxsales) * $i, $white);
}
imagestring($img, 7, 50, 20, "Sales Timeline (3D)", $white);
imagestring($img, 4, 50, 40, "All Categories (per month)", $white);

$tbmonth = array();
for($mn=0;$mn<12;$mn++){
	$tbmonth[$mn] = 0;
	$res = $conn->query($sql);
	for($ms=0;$ms<mysqli_num_rows($res);$ms++){
		$row = $res->fetch_assoc();
		if(substr($row['date_cmd'], 5, 2)+0 == ($mn+1)){
			$tbmonth[$mn] += $row['how'];
		}
	}
}
for($i=0;$i<12;$i++){
	imagefilledrectangle($img, 30 * ($i+1) + 30, 278, 30 * ($i+1) + 50, 275-$tbmonth[$i] * 3, $darkred);
	imagefilledrectangle($img, 30 * ($i+1) + 35, 278, 30 * ($i+1) + 50, 278-$tbmonth[$i] * 3, $red);
}

$img = imagejpeg($img, "graphs/tmln2.jpg");

//////////////////////////////////////////////////////////////////


$img = imagecreate(500, 300);
$bg = imagecolorallocate($img, 52, 152, 219);
$black = imagecolorallocate($img, 0, 0, 0);
$white    = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
$gray     = imagecolorallocate($img, 0xC0, 0xC0, 0xC0);
$darkgray = imagecolorallocate($img, 0x90, 0x90, 0x90);
$navy     = imagecolorallocate($img, 0x00, 0x00, 0x80);
$darknavy = imagecolorallocate($img, 0x00, 0x00, 0x50);
$red      = imagecolorallocate($img, 0xFF, 0x00, 0x00);
$darkred  = imagecolorallocate($img, 0x90, 0x00, 0x00);

imageline($img, 20, 20, 20, 280, $white);
imageline($img, 10, 30, 20, 20, $white);
imageline($img, 20, 20, 30, 30, $white);

imageline($img, 20, 280, 480, 280, $white);
imageline($img, 480, 280, 470, 270, $white);
imageline($img, 480, 280, 470, 290, $white);

for($i=1;$i<=$cats;$i++){
	imagestring($img, 2, $i*30 + 40, 285, $i, $white);
}
for($i=1;$i<=12;$i++){
	imagestring($img, 2, 5,  280 - ($i*20), floor(300/$maxsales) * $i, $white);
}
imagestring($img, 7, 50, 20, "Sales Balence Graph (2D)", $white);
imagestring($img, 4, 50, 40, "By category", $white);

$sql = "SELECT count(detcommands.id_det) how, nom_cat FROM categories LEFT JOIN products ON categories.id_cat=products.id_cat LEFT JOIN detcommands ON products.id_pro=detcommands.id_pro GROUP BY categories.id_cat";
$res = $conn->query($sql);
$i=1;
$tbcol2 = array($red, $navy, $gray, $white);
imagestring($img, 5, 300, 50, "Significations : ", $white);
while($row = $res->fetch_assoc()){
	
	imagefilledrectangle($img, 30 * $i + 35, 278, 30 * $i + 50, 278-$row['how'] * 5, $tbcol2[$i-1]);
	imagefilledrectangle($img, 300, 20 * ($i+1) + 33, 310, 20 * ($i+1) + 43, $tbcol2[$i-1]);
	$i++;
	if($row['how'] == 0) {$row['how']++;}
	imagestring($img, 4, 320, 20 * $i + 30, $row['nom_cat']." ({$row['how']} sales)", $white);
}

$img = imagejpeg($img, "graphs/stats.jpg");


////////////////////////////////////////////////////////////////////////////

$img = imagecreate(500, 300);
$bg = imagecolorallocate($img, 52, 152, 219);
$black = imagecolorallocate($img, 0, 0, 0);
$white    = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
$darkwhite    = imagecolorallocate($img, 230, 230, 230);
$gray     = imagecolorallocate($img, 0xC0, 0xC0, 0xC0);
$darkgray = imagecolorallocate($img, 0x90, 0x90, 0x90);
$navy     = imagecolorallocate($img, 0x00, 0x00, 0x80);
$darknavy = imagecolorallocate($img, 0x00, 0x00, 0x50);
$red      = imagecolorallocate($img, 0xFF, 0x00, 0x00);
$darkred  = imagecolorallocate($img, 0x90, 0x00, 0x00);

imageline($img, 20, 20, 20, 280, $white);
imageline($img, 10, 30, 20, 20, $white);
imageline($img, 20, 20, 30, 30, $white);

imageline($img, 20, 280, 480, 280, $white);
imageline($img, 480, 280, 470, 270, $white);
imageline($img, 480, 280, 470, 290, $white);

for($i=1;$i<=$cats;$i++){
	imagestring($img, 2, $i*30 + 40, 285, $i, $white);
}
for($i=1;$i<=12;$i++){
	imagestring($img, 2, 5,  280 - ($i*20), floor(300/$maxsales) * $i, $white);
}
imagestring($img, 7, 50, 20, "Sales Balence Graph (3D)", $white);
imagestring($img, 4, 50, 40, "By category", $white);

$sql = "SELECT count(detcommands.id_det) how, nom_cat FROM categories LEFT JOIN products ON categories.id_cat=products.id_cat LEFT JOIN detcommands ON products.id_pro=detcommands.id_pro GROUP BY categories.id_cat";
$res = $conn->query($sql);
$i=1;
$tbcol1 = array($darkred, $darknavy, $darkgray, $darkwhite);
$tbcol2 = array($red, $navy, $gray, $white);
imagestring($img, 5, 300, 50, "Significations : ", $white);
while($row = $res->fetch_assoc()){
	imagefilledrectangle($img, 30 * $i + 30, 278, 30 * $i + 50, 275-$row['how'] * 5, $tbcol1[$i-1]);
	imagefilledrectangle($img, 30 * $i + 35, 278, 30 * $i + 50, 278-$row['how'] * 5, $tbcol2[$i-1]);
	imagefilledrectangle($img, 300, 20 * ($i+1) + 33, 310, 20 * ($i+1) + 43, $tbcol2[$i-1]);
	$i++;
	if($row['how'] == 0) {$row['how']++;}
	imagestring($img, 4, 320, 20 * $i + 30, $row['nom_cat']." ({$row['how']} sales)", $white);
}

$img = imagejpeg($img, "graphs/stats0.jpg");


//////////////////////////////////////////////////////////////////


$img = imagecreate(500, 300);
$bg = imagecolorallocate($img, 52, 152, 219);
$black = imagecolorallocate($img, 0, 0, 0);
$white    = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
$gray     = imagecolorallocate($img, 0xC0, 0xC0, 0xC0);
$darkgray = imagecolorallocate($img, 0x90, 0x90, 0x90);
$navy     = imagecolorallocate($img, 0x00, 0x00, 0x80);
$darknavy = imagecolorallocate($img, 0x00, 0x00, 0x50);
$red      = imagecolorallocate($img, 0xFF, 0x00, 0x00);
$darkred  = imagecolorallocate($img, 0x90, 0x00, 0x00);

imagestring($img, 7, 20, 15, "Sales Balence (2D)", $white);
imagestring($img, 4, 20, 30, "By category", $white);
$sql = "SELECT count(detcommands.id_det) how, nom_cat FROM categories LEFT JOIN products ON categories.id_cat=products.id_cat LEFT JOIN detcommands ON products.id_pro=detcommands.id_pro GROUP BY categories.id_cat";
$res = $conn->query($sql);
$i=0;$last=0;
$tbcol = array($red, $navy, $gray, $white);
$maxsales = $mx;
imagestring($img, 5, 300, 30, "Significations : ", $white);
while($row = $res->fetch_assoc()){
	if($row['how'] == 0) {$row['how']++;$maxsales++;}
	$here = $last + $row['how']*360/$maxsales;
	$prc = number_format($row['how']*100/$maxsales, 2);
 	imagefilledarc($img, 140, 170, 250, 250, $last, $here, $tbcol[$i], IMG_ARC_EDGED);
 	$last = $here;
	imagefilledrectangle($img, 300, 20 * ($i+1) + 33, 310, 20 * ($i+1) + 43, $tbcol[$i]);
	$i++;
	imagestring($img, 4, 320, 20 * $i + 30, $row['nom_cat']." ($prc%)", $white);
}

$img = imagejpeg($img, "graphs/stats1.jpg");


///////////////////////////////////////////////////////////////////////////////////

$img = imagecreate(500, 300);
$bg = imagecolorallocate($img, 52, 152, 219);
$black = imagecolorallocate($img, 0, 0, 0);
$white    = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
$gray     = imagecolorallocate($img, 0xC0, 0xC0, 0xC0);
$darkgray = imagecolorallocate($img, 0x90, 0x90, 0x90);
$navy     = imagecolorallocate($img, 0x00, 0x00, 0x80);
$darknavy = imagecolorallocate($img, 0x00, 0x00, 0x50);
$red      = imagecolorallocate($img, 0xFF, 0x00, 0x00);
$darkred  = imagecolorallocate($img, 0x90, 0x00, 0x00);

imagestring($img, 7, 20, 15, "Sales Balence (3D)", $white);
imagestring($img, 4, 20, 30, "By category", $white);
$sql = "SELECT count(detcommands.id_det) how, nom_cat FROM categories LEFT JOIN products ON categories.id_cat=products.id_cat LEFT JOIN detcommands ON products.id_pro=detcommands.id_pro GROUP BY categories.id_cat";

$i=0;$last=0;
$tbcol1 = array($darkred, $darknavy, $darkgray, $white);
$tbcol2 = array($red, $navy, $gray, $white);
$maxsales = $mx;
for($pl=0;$pl<20;$pl++){
	$res = $conn->query($sql);
	while($row = $res->fetch_assoc()){
		if($row['how'] == 0) {$row['how']++;$maxsales++;}
		$here = $last + $row['how']*360/$maxsales;
		
	 		imagefilledarc($img, 130, 165-$pl, 250, 140, $last, $here, $tbcol1[$i], IMG_ARC_EDGED);
	 	$last = $here;
		$i++;
	}
	$i=0;$last=0;
}

$res = $conn->query($sql);
$maxsales = $mx;
imagestring($img, 5, 300, 30, "Significations : ", $white);
while($row = $res->fetch_assoc()){
	if($row['how'] == 0) {$row['how']++;$maxsales++;}
	$here = $last + $row['how']*360/$maxsales;
	$prc = number_format($row['how']*100/$maxsales, 2);
 	imagefilledarc($img, 130, 144, 250, 150, $last, $here, $tbcol2[$i], IMG_ARC_EDGED);
 	$last = $here;
	imagefilledrectangle($img, 300, 20 * ($i+1) + 33, 310, 20 * ($i+1) + 43, $tbcol2[$i]);
	$i++;
	imagestring($img, 4, 320, 20 * $i + 30, $row['nom_cat']." ($prc%)", $white);
}

$img = imagejpeg($img, "graphs/stats2.jpg");
?>

<center>
	<table width="100%" id="myy">
	<tr>
			<td align="center"><img src="graphs/line.jpg" class="brr"></td>
			<td align="center"><img src="graphs/line2.jpg" class="brr"></td>
		</tr>
		<tr>
			<td align="center"><img src="graphs/tmln.jpg" class="brr"></td>
			<td align="center"><img src="graphs/tmln2.jpg" class="brr"></td>
		</tr>
		<tr>
			<td align="center"><img src="graphs/stats.jpg" class="brr"></td>
			<td align="center"><img src="graphs/stats0.jpg" class="brr"></td>
		</tr>
		<tr>
			<td align="center"><img src="graphs/stats1.jpg" class="brr"></td>
			<td align="center"><img src="graphs/stats2.jpg" class="brr"></td>
		</tr>
	</table>
</center>
</body>
</html>