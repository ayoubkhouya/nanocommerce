<?php include('header.php');?>
<script type="text/javascript">
// var nb = 4;
// function setNewValue(){
// 	document.getElementById('hrefer').innerHTML = nb;
// 	nb--;
// 	if(nb>=0){
// 		setTimeout("setNewValue()", 1000);
// 	}
// }
// setNewValue();
</script>
<div class="big-title" id="slider">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="p-big-title text-center">
                    <h2><?php 
                    	if(isset($_GET['p'])){
                    		if(isset($_SESSION['visited'])){
                    			if(! in_array($_GET['p'], $_SESSION['visited'])){	
		                    		$sql = "SELECT views FROM products WHERE id_pro = {$_GET['p']}";
			                    	$res = $conn->query($sql);
			                    	$row = $res->fetch_assoc();
			                    	$views = ++$row['views'];
			                    	$sql = "UPDATE products SET views=$views WHERE id_pro = {$_GET['p']}";
			                    	$res = $conn->query($sql);
			                    	$_SESSION['visited'][] = $_GET['p'];
                    			}
                    		}

	                    	$sql = "SELECT * FROM products WHERE id_pro = {$_GET['p']}";
	                    	$res = $conn->query($sql);
	                    	if($row = $res->fetch_assoc()){
	                    		$p_id = $row['id_pro'];
	                    		$p_nom = $row['nom_pro'];
	                    		$p_vignette = $row['vignette_pro'];
	                    		$p_prix = $row['prix_pro'];
	                    		$p_promo = $row['promo_pro'];
	                    		$p_nota = $row['notation_pro'];
	                    		$p_stock = $row['stock_pro'];
	                    		$p_visit = $row['views'];
	                    		echo ucwords($p_nom);
	                    		$res = $conn->query("SELECT categories.id_cat as id_cat, nom_cat FROM categories INNER JOIN products ON categories.id_cat = products.id_cat WHERE id_pro ='{$_GET['p']}'");
	                    		$row = $res->fetch_assoc();
	                    		$ca_id = $row['id_cat'];
	                    		$ca_nom = $row['nom_cat'];
	                    	}else{
	                    		echo "<meta http-equiv='refresh' content='5; url=index.php'/>";
	                    		die("<h2><center>Aucun Produit Trouvé Pour Votre Recherche</center></h2><br>
	                    			<h3>Redirection vers la page d'accueil aprés : <b><span id='hrefer'>5</span></b>s</h3>");
	                    	}
                    	}else{
                    		die("<h2><center>Aucun Produit Sélectionné</center></h2>");
                    	}
                    ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-details">
	<div class="container">
		<div class="row">
			<div class="col-md-3 promore">
				<div class="srh-field">
					<h2 class="orange">Recherche</h2>
					<form method="POST" action="index.php?search=true">
						<input type="search" name="this_search" class="input-field" placeholder="Recherche...">
						<button type="submit" name="start_search" class="btn-action butto"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<div class="sameas">
					<h2 class="orange">Même catégorie</h2>
					<div>
					<?php 
						$sql = "SELECT * FROM products WHERE id_cat = $ca_id AND id_pro<>{$_GET['p']} ORDER BY id_pro DESC LIMIT 3";
						$res = $conn->query($sql);
						while($row = $res->fetch_assoc()){?>
							<div class="same-cat col-md-12 col-ms-12 col-xs-12">
								<div class="same-cat-img col-md-4 col-ms-4 col-xs-4">
									<img src="<?php echo $row['vignette_pro'];?>">
								</div>
								<div class="same-cat-det col-md-8 col-ms-8 col-xs-8">
									<p class="title"><h5 style="color: #5a88ca;"><?php echo $row['nom_pro'];?></h5><p>
									<p>
									<?php
										if($row['promo_pro'] == 0){
											echo "<span class='price'>".$row['prix_pro']." DH</span>";
										}
										else{
											$newprice = ceil($row['prix_pro'] - ($row['prix_pro'] * $row['promo_pro']/100));
											echo "<span class='price'>".$newprice." DH</span>
												<span class='price-promo'><s>".$row['prix_pro']." DH</s></span>
											";
										}
									?>
									</p>
									<a href="index.php?addtocart=<?php echo $row['id_pro'];?>&q=1" class="btn-action promo-action" style="margin-right: 10px;text-decoration: none;"><i class="fa fa-shopping-cart"></i></a>
									<a href="details.php?p=<?php echo $row['id_pro'];?>" style="margin-right: 10px;text-decoration: none;" class="btn-action promo-action"><i class="fa fa-file-text"></i> Plus</a>
								</div>
							</div>
						<?php }?>
					</div>
				</div>

				<div class="sameas">
					<h2 class="orange">Dérniere Produits</h2>
					<div>
					<?php 
						$sql = "SELECT * FROM products WHERE id_pro <> {$_GET['p']} ORDER BY id_pro DESC LIMIT 3";
						$res = $conn->query($sql);
						while($row = $res->fetch_assoc()){?>
							<div class="same-cat col-md-12 col-ms-12 col-xs-12">
								<div class="same-cat-img col-md-4 col-ms-4 col-xs-4">
									<img src="<?php echo $row['vignette_pro'];?>">
								</div>
								<div class="same-cat-det col-md-8 col-ms-8 col-xs-8">
									<p class="title"><h5 style="color: #5a88ca;"><?php echo $row['nom_pro'];?></h5><p>
									<p>
									<?php
										if($row['promo_pro'] == 0){
											echo "<span class='price'>".$row['prix_pro']." DH</span>";
										}
										else{
											$newprice = ceil($row['prix_pro'] - ($row['prix_pro'] * $row['promo_pro']/100));
											echo "<span class='price'>".$newprice." DH</span>
												<span class='price-promo'><s>".$row['prix_pro']." DH</s></span>
											";
										}
									?>
									</p>
									<a href="index.php?addtocart=<?php echo $row['id_pro'];?>&q=1" class="btn-action promo-action" style="margin-right: 10px;text-decoration: none;"><i class="fa fa-shopping-cart"></i></a>
									<a href="details.php?p=<?php echo $row['id_pro'];?>" style="margin-right: 10px;text-decoration: none;" class="btn-action promo-action"><i class="fa fa-file-text"></i> Plus</a>
								</div>
							</div>
						<?php }?>
					</div>
				</div>
			</div>

			<div class="col-md-6 propic">
				<div class="picno">
					<center><img src="<?php echo $p_vignette;?>" id="globpic"></center>
				</div>
				<div class="proimgs"><center>
				<img src='<?php echo $p_vignette;?>' onclick="document.getElementById('globpic').src=this.src;">
				<?php 
					$sql = "SELECT * FROM products NATURAL JOIN pictures WHERE products.id_pro = {$_GET['p']} LIMIT 4";
					$res = $conn->query($sql);
					while($row = $res->fetch_assoc()){?>
						<img src='<?php echo $row['pic'];?>' onclick="document.getElementById('globpic').src=this.src;">
				<?php	}?>
				</center>
				</div>

				<div class="publ">
					<?php
					$sql = "SELECT * FROM pub WHERE id_pub=2";
					$res = $conn->query($sql);
					while($row = $res->fetch_assoc()){
						echo "<a href='{$row['link_pub']}'><img src='{$row['pub']}'></a>";
					}
				?>
				</div>
			</div>

			<div class="col-md-3 prodet">
				<h2><?php echo ucwords($p_nom);?></h2>
				<p>
				<?php
					if($p_promo == 0){
						echo "<span class='price'><b>".$p_prix." DH</b></span>";
					}
					else{
						$newprice = ceil($p_prix - ($p_prix * $p_promo/100));
						echo "<span class='price'><b>".$newprice." DH</b></span>
						<span class='price-promo' style='margin-left: 10px;'><s>".$p_prix." DH</s></span>
						";
					}
				?>
				</p>
				<span>Quantité available : <b><?php echo $p_stock;?></b></span>
				<form method="POST">
					<table>
						<tr>
							<td><input type="number" name="qttprd" min="1" max="<?php echo $p_stock;?>" value="1" class="input-align-center"><input type="hidden" name="setthisone" value="<?php echo $p_id;?>"></td>
							<td><button type="submit" name="btnaddcart" class="btn-action" style="padding: 10px;margin-left: 10px;text-decoration: none;border:0"><i class="fa fa-shopping-cart"></i> Ajouter au panier</button></td>
						</tr>
					</table>
				</form>
				<h5><span>Categorie : <?php echo "<a href='index.php?cat=$ca_id'>".$ca_nom."</a>";?></span>
				<span>Visites : <i><?php echo $p_visit;?></i></span></h5>
				<p class="text-adjust">
					<?php echo $p_nota;?>
				</p>
				<table class="table-stripped" cellspacing="0" cellpadding="0">
					<thead>
						<tr>
							<th>Option</th>
							<th>Valeur</th>
						</tr>
					</thead>

					<tbody>
					<?php
						$sql = "SELECT description_pro FROM products WHERE id_pro = {$_GET['p']}";
						$res = $conn->query($sql);
						$row = $res->fetch_array();
						$mydesc = $row['description_pro'];
						foreach(explode("\n", $mydesc) as $adesc){
							$descinf = explode('|', $adesc);
							echo "<tr>
								<td>".strtoupper($descinf[0])."</td>
								<td><i>".$descinf[1]."</i></td>
							</tr>";
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php include('footer.php');?>