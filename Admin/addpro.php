<?php include('header.php');?>

<?php
if(isset($_POST['addprod'])){
	$nom = $_POST['nom'];
	$prix = $_POST['prix'];
	$stock = $_POST['stock'];
	move_uploaded_file($_FILES['vig']['tmp_name'], "../img/products/".$_FILES['vig']['name']);
	$vig = "img/products/".$_FILES['vig']['name'];
	$promo = $_POST['promo'];
	$cate = $_POST['cat'];
	$nota = $_POST['nota'];
	$imgs = array();
	for($i=1;$i<=4;$i++){
		move_uploaded_file($_FILES["img$i"]['tmp_name'], "../img/products/".$_FILES["img$i"]['name']);
		$imgs[$i] = "img/products/".$_FILES["img$i"]['name'];
	}
	$descp = "";
	$i=0;
	foreach($_POST['desc'] as $desc){
		$descp .= $desc."|".$_POST['val'][$i]."\n";
		$i++;
	}
	$sql = "INSERT INTO products VALUES('', '$nom', '$prix', '$stock', '$vig', '$nota', '$descp', '$promo', 0, $cate)";
	if($res = $conn->query($sql)){
		echo "<h4 class='alert_success'>Votre produit a ete ajoute avec succes</h4>";
		$id_pro = mysqli_insert_id($conn);
		for($i=1;$i<=4;$i++){
			$sql = "INSERT INTO pictures VALUES ('', '{$imgs[$i]}', $id_pro)";
			$res = $conn->query($sql);
		}
	}else{
		echo "<h4 class='alert_error'>Erreur de l ajout</h4>";
	}
}
?>
<script type="text/javascript">
function addVal(){
	document.getElementById('Vals').innerHTML += "</br><input type='text' name='desc[]' required style='width: 40%;float: left;' placeholder='Attribue'><input type='text' name='val[]' required style='width: 40%;float: right;' placeholder='Valeur'>";
}
</script>
	<section id="main" class="column">
		
		<article class="module width_full">
			<header><h3>Ajouter un produit</h3></header>
			<div class="module_content">
			<form method="POST"  enctype="multipart/form-data">
				<article class="stats_graph">
					<fieldset>
						<label>Nom De Produit</label>
						<input type="text" name="nom" required>
					</fieldset>
					<fieldset>
						<label>Prix</label>
						<input type="text" name="prix" required>
					</fieldset>
					<fieldset>
						<label>Stock</label>
						<input type="text" name="stock" required>
					</fieldset>
					<fieldset>
						<label>Vignette</label>
						<input type="file" name="vig" required>
					</fieldset>
					<fieldset>
						<label>Promotion</label>
						<input type="text" name="promo" required>
					</fieldset>
					<fieldset style="width:100%; float:left; margin-right: 3%;">
						<label>Category</label>
						<select style="width:92%;" name="cat" required>
							<option disabled>Selectionner une catégorie</option>
							<?php
								$sql = "SELECT * FROM categories";
								$res = $conn->query($sql);
								while($row = $res->fetch_array()){
									echo "<option value='{$row['id_cat']}'>{$row['nom_cat']}</option>";
								}
							?>
						</select>
					</fieldset>
					<fieldset>
						<label>Notation</label>
						<textarea rows="6" name="nota" required></textarea>
					</fieldset>
					<input type="submit" value="Publish" name="addprod" class="alt_btn" style="float: right;">
				</article>

				<article>
					<fieldset>
						<label>Photo 1</label>
						<input type="file" name="img1" required>
					</fieldset>
					<fieldset>
						<label>Photo 2</label>
						<input type="file" name="img2" required>
					</fieldset>
					<fieldset>
						<label>Photo 3</label>
						<input type="file" name="img3" required>
					</fieldset>
					<fieldset>
						<label>Photo 4</label>
						<input type="file" name="img4" required>
					</fieldset>

					<fieldset>
						<label>Descriptions <span onclick="addVal()" style="float: right;"><font size=5><b>+</b></font></span></label>
						<span id="Vals"><input type='text' name='desc[]' required style='width: 40%;float: left;' placeholder='Attribue'> <input type='text' name='val[]' required style='width: 40%;float: right;' placeholder='Valeur'></span>
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