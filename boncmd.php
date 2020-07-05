<?php

if(isset($_GET['cmd'])){
	include('config.php');
	require('../FPDF/fpdf.php');
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',11);

	$pdf->Image("img/logo.png");
	$sql = "SELECT * FROM users NATURAL JOIN commands NATURAL JOIN detcommands NATURAL JOIN products WHERE commands.id_cmd={$_GET['cmd']}";
	$res = $conn->query($sql);
	$row = $res->fetch_assoc();
	$pdf->setXY(155, 18);
	$mydate = new DateTime($row['date_cmd']);
	$pdf->Cell(15,5, "Le ".$mydate->format('d/m/Y'),0,1);
	$pdf->Ln();
	$pdf->setY(40);
	$pdf->Cell(15,5, "Bon de command numero : {$_GET['cmd']}",0,1);
	$pdf->Cell(15,5, "Nom : {$row['nom_user']}",0,1);
	$pdf->Cell(15,5, "Prenom : {$row['prenom_user']}",0,1);
	$pdf->Cell(15,5, "Adresse de livraison : {$row['address_cmd']}",0,1);


	$sql = "SELECT * FROM users NATURAL JOIN commands NATURAL JOIN detcommands NATURAL JOIN products WHERE commands.id_cmd={$_GET['cmd']}";
	$res = $conn->query($sql);

	$pdf->SetTextColor(255);
	$pdf->SetFillColor(90,136,202);
	$pdf->setXY(30, 70);
	$pdf->Cell(60,10, "Produit",1,0,"C",1);
	$pdf->Cell(30,10, "Prix",1,0,"C",1);
	$pdf->Cell(30,10, "Quantite",1,0,"C",1);
	$pdf->Cell(30,10, "Montant",1,0,"C",1);

	$pdf->Ln();
	$pdf->SetTextColor(0,0,0);
	$total=0;
	while($row = $res->fetch_assoc()){
		$pdf->setX(30);
		$pdf->Cell(60,10, "{$row['nom_pro']}",1);
		$pdf->Cell(30,10, "{$row['prix_det']} DH",1,0,"C");
		$pdf->Cell(30,10, "{$row['qtte_det']}",1,0,"C");
		$pdf->Cell(30,10, ($row['prix_det'] * $row['qtte_det'])." DH",1,0,"C");
		$pdf->Ln();
		$total += $row['prix_det'] * $row['qtte_det'];
	}
	$pdf->setX(30);
	$pdf->Cell(60,10, "");
	$pdf->Cell(30,10, "");
	$pdf->Cell(30,10, "Total",1,0,"C");
	$pdf->Cell(30,10, "$total DH",1,0,"C");

	$pdf->Output();
}else{
	echo "<h1><center><font color=red>Aucune bon de command séléctionné</font></center></h1>";
}

?>