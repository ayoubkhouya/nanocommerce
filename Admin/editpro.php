<?php include('header.php');?>

<?php

if(isset($_POST['editpro'])){
	$id = $_POST['id'];
	$nom = $_POST['nom'];
	$prix = $_POST['prix'];
	$stock = $_POST['stock'];
	/*if(isset($_FILES['vig']['name'])){
		if(file_exists($edt_vig)) unlink($edt_vig);
		move_uploaded_file($_FILES['vig']['tmp_name'], "../img/products/".$_FILES['vig']['name']);
		$vig = "img/products/".$_FILES['vig']['name'];
		$sql = "UPDATE products SET Vignette_pro='$vig' WHERE id_pro=$id";
		$res = $conn->query($sql);
	}*/
	$promo = $_POST['promo'];
	$cate = $_POST['cat'];
	$nota = $_POST['nota'];
	$descp = "";
	$i=0;
	foreach($_POST['desc'] as $desc){
		$descp .= $desc."|".$_POST['val'][$i]."\n";
		$i++;
	}
	$sql = "UPDATE products SET nom_pro = '$nom', prix_pro = '$prix', stock_pro = '$stock', notation_pro = '$nota', description_pro = '$descp', promo_pro = '$promo', id_cat = $cate WHERE id={$_GET['p']}";
	if($res = $conn->query($sql)){
		echo "<h4 class='alert alert_success'>Votre produit a ete edite avec succes</h4>";
	}else{
		echo "<h4 class='alert alert_error'>Erreur de l edition</h4>";
	}
}

if(isset($_GET['p'])){
	$sql = "SELECT * FROM products WHERE id_pro={$_GET['p']}";
	$res = $conn->query($sql);
	$row = $res->fetch_array();
	$edt_nom = $row['nom_pro'];
	$edt_prix = $row['prix_pro'];
	$edt_stock = $row['stock_pro'];
	$edt_promo = $row['promo_pro'];
	$edt_nota = $row['notation_pro'];
	$edt_cate = $row['id_cat'];
	$edt_vig = $row['Vignette_pro'];
	$edt_desc = $row['description_pro'];
	$sql = "SELECT * FROM categories WHERE id_cat=$edt_cate";
	$res = $conn->query($sql);
	$row = $res->fetch_assoc();
	$edt_catename = $row['nom_cat'];
}
?>
<script type="text/javascript">
function addVal(){
	document.getElementById('Vals').innerHTML += "</br><input type='text' name='desc[]' required style='width: 40%;float: left;' placeholder='Attribue'><input type='text' name='val[]' required style='width: 40%;float: right;' placeholder='Valeur'>";
}
</script>
	<section id="main" class="column">
		
		<article class="module width_full">
			<header><h3>Editer le produit : <?php echo $edt_nom;?></h3></header>
			<div class="module_content">
			<form method="POST"  enctype="multipart/form-data">
				<article class="stats_graph">
					<fieldset>
						<label>Nom De Produit</label>
						<input type="text" name="nom" value="<?php echo $edt_nom;?>" required>
						<input type="hidden" name="id" value="<?php echo $_GET['p'];?>">
					</fieldset>
					<fieldset>
						<label>Prix</label>
						<input type="text" name="prix" value="<?php echo $edt_prix;?>" required>
					</fieldset>
					<fieldset>
						<label>Stock</label>
						<input type="text" name="stock" value="<?php echo $edt_stock;?>" required>
					</fieldset>
					<!--<fieldset>
						<label>Vignette</label>
						<input type="file" name="vig" value="<?php echo $edt_vig;?>">
					</fieldset>-->
					<fieldset>
						<label>Promotion</label>
						<input type="text" name="promo" value="<?php echo $edt_promo;?>" required>
					</fieldset>
					<fieldset style="width:100%; float:left; margin-right: 3%;">
						<label>Category</label>
						<select style="width:92%;" name="cat" required>
							<option disabled>Selectionner une catégorie</option>
							<option value="<?php echo $edt_cate;?>"><?php echo $edt_catename;?></option>
							<?php
								$sql = "SELECT * FROM categories WHERE id_cat<>$edt_cate";
								$res = $conn->query($sql);
								while($row = $res->fetch_array()){
									echo "<option value='{$row['id_cat']}'>{$row['nom_cat']}</option>";
								}
							?>
						</select>
					</fieldset>
					<fieldset>
						<label>Notation</label>
						<textarea rows="6" name="nota" required><?php echo $edt_nota;?></textarea>
					</fieldset>
					<input type="submit" value="Enregistrer" name="editpro" class="alt_btn" style="float: right;">
				</article>

				<article>
					<fieldset>
						<label>Descriptions <span onclick="addVal()" style="float: right;"><font size=5><b>+</b></font></span></label>
						<span id="Vals">
						<?php
						$edt_desc = trim($edt_desc);
						$descm = explode("\n", $edt_desc);
						foreach($descm as $dec){
							$deci = explode('|', $dec);
							echo "<input type='text' name='desc[]' required style='width: 40%;float: left;' placeholder='Attribue' value='{$deci['0']}'><input type='text' name='val[]' required style='width: 40%;float: right;' placeholder='Valeur' value='{$deci['1']}'>";
						}
						?>
						</span>
					</fieldset>
				</article>
				<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->
		</form>

		<div class="spacer"></div>
	</section>


</body>

</html>