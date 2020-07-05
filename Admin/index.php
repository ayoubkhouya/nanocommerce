<?php include('header.php');?>
<?php
if(isset($_GET['del'])){
	$sql = "DELETE FROM products WHERE id_pro={$_GET['del']}";
	if($res = $conn->query($sql)){
		echo "<p class='alert alert-success'>Le produit àn été suprimé</p>";
	}else{
		echo "<p class='alert alert-success'>Erreur pandant la supprission de produit</p>";
	}
}
?>

<?php
if(isset($_POST['export'])){
	$f  = fopen("xml/products.xml", "w");
	////////// XML Header
	fputs($f, "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n");
	fputs($f, "<produits xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"products.xsd\">\n");
	///////// XML Body
	$sql = "SELECT * FROM products NATURAL JOIN categories"; /////:: select all products from database
	$res = $conn->query($sql);
	while($row = $res->fetch_assoc()){
		$data =  "    <produit id=\"{$row['id_pro']}\" prix=\"{$row['prix_pro']}\" quantite=\"{$row['stock_pro']}\">\n";
		$data .= "        {$row['notation_pro']}\n";
		$data .= "        <nom>{$row['nom_pro']}</nom>\n";
		$data .= "        <promo>{$row['promo_pro']}</promo>\n";
		$data .= "        <categorie>{$row['nom_cat']}</categorie>\n";
		$data .= "        <vignette source=\"{$row['vignette_pro']}\"/>\n";
		$data .= "    </produit>\n";
		fputs($f, $data);
	}
	///////// XML Footer
	fputs($f, "</produits>\n");
	fclose($f);
	echo "
	<script type='text/javascript'>
		function doit(){
			var wp = window.open('xml/products.xml', '_blank');
			wp.focus();
		}
		setTimeout('doit()', 500);
	</script>
	";
}
?>
	<section id="main" class="column">

		<article class="module" style="width: 95%">
		<header><h3 class="tabs_involved">Content Manager&nbsp;&nbsp; <small>Cliquer sur le titre d'un champ pour trier</small></h3>
		<a href="gd.php" target="_blank" style="float: right;border: 1px solid #aaa;border-radius: 8px;padding: 6px;margin-top: 3px;color:#fff;cursor:pointer;background-color: #aaa;text-decoration: none;margin-right: 10px;">Statistiques</a>
		<form method="POST">
			<button type="submit" name="export" style="float: right;border: 1px solid #aaa;border-radius: 8px;padding: 5px;margin-top: 3px;color:#fff;cursor:pointer;background-color: #ccc;margin-right: 10px;">Export XML</button>
		</form>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
					<th>Vignette</th>
    				<th>Nom</th> 
    				<th>Prix</th> 
    				<th>Stock</th> 
    				<th>Notation</th> 
    				<th>Promo</th>
    				<th>Visites</th>
    				<th>Catégorie</th>
    				<th>Action</th>
				</tr> 
			</thead> 
			<tbody> 
			<?php 
				$sql = "SELECT * FROM products NATURAL JOIN categories ORDER BY id_pro DESC";
				$res = $conn->query($sql);
				while($row = $res->fetch_assoc()){
					echo "<tr>  
	    				<td><img src='../{$row['vignette_pro']}' width=50 height=60></td>
	    				<td><a href='../details.php?p={$row['id_pro']}' title='afficher dans le site' target='_blank'>{$row['nom_pro']}</a></td>
	    				<td>{$row['prix_pro']}</td>
	    				<td>{$row['stock_pro']}</td>
	    				<td>".substr($row['notation_pro'], 0, 40)."...</td>
	    				<td>{$row['promo_pro']}</td>
	    				<td>{$row['views']}</td>
	    				<td>{$row['nom_cat']}</td>
	    				<td><a href='editpro.php?p={$row['id_pro']}' title='Editer'><img src='images/icn_edit.png'></a> &nbsp; <a href='index.php?del={$row['id_pro']}' title='Supprimer'><img src='images/icn_trash.png'></a></td>
					</tr>";
				}
			?> 
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
		<div class="spacer"></div>
	</section>


</body>

</html>