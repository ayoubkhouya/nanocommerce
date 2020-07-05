<?php include('header.php');?>
<script type="text/javascript">
function macommand_show(){
    document.getElementById('macommand').style.marginTop = "-150px";
}
function macommand_hide(){
	document.getElementById('macommand').style.opacity = 0;
	setTimeout("macommand_destroy()", 1000);
}
function macommand_destroy(){
	document.getElementById('macommand').style.display = "none";
	document.getElementById('comshad').style.display = "none";
}
</script>
<!--<?php 
$sql = "SELECT * FROM products";
$res = $conn->query($sql);
while($row = $res->fetch_assoc()){
	echo "<a class='linker' href='details.php?p={$row['id_pro']}'>{$row['nom_pro']}</a><br>";
}
?>-->
<?php 
if(isset($_GET['showcommand'])){
	echo "<script>setTimeout('macommand_show()', 1000);</script>";
	echo "<div class='comshad' id='comshad' onclick='macommand_hide()'></div>";
	echo "<div class='macommand' id='macommand'>";
		echo "<span id='closecommand' onclick='macommand_hide()'>X</span>";
		echo "<h3 class='title'>Bon de command n° : {$_GET['showcommand']}</h3>
		<span><a href='boncmd.php?cmd={$_GET['showcommand']}' target='_blank' class='btn-download'>Télécharger</a>";?>
		<?php
			$sql = "SELECT * FROM users NATURAL JOIN commands NATURAL JOIN detcommands NATURAL JOIN products WHERE commands.id_cmd=detcommands.id_cmd AND detcommands.id_pro=products.id_pro AND commands.id_cmd={$_GET['showcommand']}";
			$res = $conn->query($sql);$ttm = 0;
			echo "<table class='stripped'><thead>
			<tr><th>Des. Produit</th><th>Prix</th><th>Quantité</th><th>Montant</th></tr></thead><tbody>";
			while($row = $res->fetch_array()){
				echo "<tr>
					<td>{$row['nom_pro']}</td>
					<td>{$row['prix_det']} DH</td>
					<td>{$row['qtte_det']}</td>
					<td>".($row['prix_det'] * $row['qtte_det'])." DH</td>
				</tr>
				";
				$ttm+=($row['prix_det'] * $row['qtte_det']);
			}
			echo "<tr><td colspan=2></td><th>Total</th><td align=center><b>$ttm DH</b></td></tr>";
			echo "</tbody></table>";
		?>
<?
	echo "</div>";
}
?>
<?php if(! isset($_GET['cat']) && ! isset($_GET['cats']) && ! isset($_GET['cart']) && ! isset($_GET['login']) && ! isset($_GET['contact']) && ! isset($_GET['register']) && ! isset($_GET['search'])){?>
<div class="slider" id="slider">
	<div class="container">
		<div class="row">
			<div class="slideshow visible-lg-block visible-md-block" onmouseenter="/*_tslide=86400000;regainmyslide()*/" onmouseleave="/*_tslide=5000;carousel_autoplay();*/">
				<div class="col-md-1 angle-action"><a onclick="carousel_prev()"><i class="fa fa-chevron-left"></i></a></div>
				<div class="col-md-10">
					<ul>
					<?php 
						$sql = "SELECT * FROM products LIMIT 4";
						$res = $conn->query($sql);
						$i=1;
						while($row = $res->fetch_assoc()){
					?>
						<li id="slide<?php echo $i;?>">
							<img src="img/slide<?php echo $i;?>.png">
							<span class="title"><?php echo $row['nom_pro'];?></span>
							<span class="desc"><?php echo $row['notation_pro'];?></span>
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
							<span class="controller">
								<a href="index.php?addtocart=<?php echo $row['id_pro'];?>&q=1" class="btn-action slide-action"><i class="fa fa-shopping-cart"></i> Ajouter au panier</a>
								<a href="details.php?p=<?php echo $row['id_pro'];?>" class="btn-action slide-action"><i class="fa fa-file-text"></i> Voir plus</a>
							</span>
						</li>
					<?php $i++;}?>
					</ul>
				</div>		
				<div class="col-md-1 angle-action"><a onclick="carousel_next()"><i class="fa fa-chevron-right"></i></a></div>
			</div>
		</div>
	</div>
</div>

<div class="promo">
    <div class="field-bottom"></div>
    <div class="container">
        <div class="row">
        <?php
        $sql = "SELECT * FROM categories LIMIT 4";
        $res = $conn->query($sql);$l=1;
        while($row = $res->fetch_array()){
        	echo "
            <div class='col-md-3 col-sm-6'>
                <div class='single-promo promo$l'>
                    <a href='index.php?cat={$row['id_cat']}' style='color:#fff;text-decoration:none'><p>".(ucwords($row['nom_cat']))."</p></a>
                </div>
            </div>";$l++;
        }
        ?>
        </div>
    </div>
</div>

<div class="promotion">
	<div class="container">
		<div class="row">
		<p class="hot-title">Promotions</p>
		<?php
			$sql = "SELECT * FROM products WHERE promo_pro <> '' ORDER BY promo_pro DESC LIMIT 6";
			$res = $conn->query($sql);
			while($row = $res->fetch_assoc()){ ?>
			<div class="col-md-4 prpro-card">
				<div class="proproduct col-md-4">
					<img src="<?php echo $row['vignette_pro'];?>">
					<span class="promo-how-much">Réduction : <b id="prct"><?php echo $row['promo_pro'];?>%</b></span>
				</div>
				<div class="col-md-8 pdesc">
					<a href="details.php?p=<?php echo $row['id_pro'];?>"><span class="title"><?php echo $row['nom_pro'];?></span></a><br>
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
					<br>
					<div class="controller">
						<a href="index.php?addtocart=<?php echo $row['id_pro'];?>&q=1" class="btn-action promo-action"><i class="fa fa-shopping-cart"></i> Ajouter</a>
						<a href="details.php?p=<?php echo $row['id_pro'];?>" class="btn-action promo-action"><i class="fa fa-file-text"></i> Voir Plus</a>
					</div>
				</div>
			</div>
		<?php }?>
		</div>
	</div>
</div>

<div class="brands">
    <div class="field-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="brand-wrapper">
                    <div class="brand-list">
                        <img src="img/brand1.png" alt="">
                        <img src="img/brand2.png" alt="">
                        <img src="img/brand3.png" alt="">
                        <img src="img/brand4.png" alt="">
                        <img src="img/brand5.png" alt="">
                        <img src="img/brand6.png" alt="">
                        <img src="img/brand1.png" alt="">
                        <img src="img/brand2.png" alt="">                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hot">
	<div class="container">
		<div class="row">
			<p class="hot-title">Plus Ventes</p>
			<?php 
			$sql = "SELECT products.id_pro id_pro,prix_pro, nom_pro, vignette_pro, description_pro, promo_pro, sum(qtte_det) as nbsell FROM products INNER JOIN detcommands ON products.id_pro=detcommands.id_pro GROUP BY products.id_pro ORDER BY sum(qtte_det) DESC LIMIT 4";
			$res = $conn->query($sql);
			while($row = $res->fetch_assoc()){
			?>
			<div class="product col-md-3 col-sm-3 col-xs-12">
				<div class="contents">
				<a href="kk?p=2" class="linker">llll</a>
					<div class="hot-img col-md-5">
						<img src="<?php echo $row['vignette_pro'];?>" height="90" width="100">
						<div class="shad">
							<a href="index.php?addtocart=<?php echo $row['id_pro'];?>&q=1">
							<div id="shad-addtocart">
								<i class="fa fa-shopping-cart"></i>
								<span>ajouter</span>
							</div>
							</a>
							<a href="details.php?p=<?php echo $row['id_pro']?>">
							<div id="shad-view">
								<i class="fa fa-file-text"></i>
								<span>voir plus</span>
							</div>
							</a>
						</div>
					</div>
					<div class="hot-desc col-md-7">
						<a href="details.php?p=<?php echo $row['id_pro']?>"><?php echo $row['nom_pro'];?></a>
						<br>
						<span class="descr"><?php echo substr(str_replace("\n", ", ", str_replace("|", ": ", $row['description_pro'])),0, 50)."...";?></span>
						<br>
						<?php
							if($row['promo_pro'] == 0){
								echo "<span class='price'>".$row['prix_pro']." DH</span>";
							}
							else{
								$newprice = ceil($row['prix_pro'] - ($row['prix_pro'] * $row['promo_pro']/100));
								echo "<span class='price'>".$newprice." DH</span><br>
								<span class='price-promo'><s>".$row['prix_pro']." DH</s></span>
								";
							}
						?>
						<br>
						<a href="index.php?addtocart=<?php echo $row['id_pro'];?>&q=1" class="btn-action" id="btn-action-buy"><i class="fa fa-shopping-cart"></i></a>
						<a href="details.php?p=<?php echo $row['id_pro']?>" class="btn-action"><i class="fa fa-file-text"></i> Voir plus</a>
					</div>
				</div>
			</div>
			<?php }?>
		</div>
		<div class="row">
			<p class="hot-title">Top Nouveau</p>
			<?php 
			$sql = "SELECT * FROM products ORDER BY id_pro DESC LIMIT 4";
			$res = $conn->query($sql);
			while($row = $res->fetch_assoc()){
			?>
			<div class="product col-md-3 col-sm-3 col-xs-12">
				<div class="contents">
					<div class="hot-img col-md-5">
						<img src="<?php echo $row['vignette_pro'];?>" height="90" width="100">
						<div class="shad">
							<a href="index.php?addtocart=<?php echo $row['id_pro'];?>&q=1">
							<div id="shad-addtocart">
								<i class="fa fa-shopping-cart"></i>
								<span>ajouter</span>
							</div>
							</a>
							<a href="details.php?p=<?php echo $row['id_pro']?>">
							<div id="shad-view">
								<i class="fa fa-file-text"></i>
								<span>voir plus</span>
							</div>
							</a>
						</div>
					</div>
					<div class="hot-desc col-md-7">
						<a href="details.php?p=<?php echo $row['id_pro']?>"><?php echo $row['nom_pro'];?></a>
						<br>
						<span class="descr"><?php echo substr(str_replace("\n", ", ", str_replace("|", ": ", $row['description_pro'])),0, 50)."...";?></span>
						<br>
						<?php
							if($row['promo_pro'] == 0){
								echo "<span class='price'>".$row['prix_pro']." DH</span>";
							}
							else{
								$newprice = ceil($row['prix_pro'] - ($row['prix_pro'] * $row['promo_pro']/100));
								echo "<span class='price'>".$newprice." DH</span><br>
								<span class='price-promo'><s>".$row['prix_pro']." DH</s></span>
								";
							}
						?>
						<br>
						<a href="index.php?addtocart=<?php echo $row['id_pro'];?>&q=1" class="btn-action" id="btn-action-buy"><i class="fa fa-shopping-cart"></i></a>
						<a href="details.php?p=<?php echo $row['id_pro']?>" class="btn-action"><i class="fa fa-file-text"></i> Voir plus</a>
					</div>
				</div>
			</div>
			<?php }?>
		</div>
		<div class="row">
			<p class="hot-title">Plus Visité</p>
			<?php 
			$sql = "SELECT * FROM products ORDER BY views DESC LIMIT 4";
			$res = $conn->query($sql);
			while($row = $res->fetch_assoc()){
			?>
			<div class="product col-md-3 col-sm-3 col-xs-12">
				<div class="contents">
					<div class="hot-img col-md-5">
						<img src="<?php echo $row['vignette_pro'];?>" height="90" width="100">
						<div class="shad">
							<a href="index.php?addtocart=<?php echo $row['id_pro'];?>&q=1">
							<div id="shad-addtocart">
								<i class="fa fa-shopping-cart"></i>
								<span>ajouter</span>
							</div>
							</a>
							<a href="details.php?p=<?php echo $row['id_pro']?>">
							<div id="shad-view">
								<i class="fa fa-file-text"></i>
								<span>voir plus</span>
							</div>
							</a>
						</div>
					</div>
					<div class="hot-desc col-md-7">
						<a href="details.php?p=<?php echo $row['id_pro']?>"><?php echo $row['nom_pro'];?></a>
						<br>
						<span class="descr"><?php echo substr(str_replace("\n", ", ", str_replace("|", ": ", $row['description_pro'])),0, 50)."...";?></span>
						<br>
						<?php
							if($row['promo_pro'] == 0){
								echo "<span class='price'>".$row['prix_pro']." DH</span>";
							}
							else{
								$newprice = ceil($row['prix_pro'] - ($row['prix_pro'] * $row['promo_pro']/100));
								echo "<span class='price'>".$newprice." DH</span><br>
								<span class='price-promo'><s>".$row['prix_pro']." DH</s></span>
								";
							}
						?>
						<br>
						<a href="index.php?addtocart=<?php echo $row['id_pro'];?>&q=1" class="btn-action" id="btn-action-buy"><i class="fa fa-shopping-cart"></i></a>
						<a href="details.php?p=<?php echo $row['id_pro']?>" class="btn-action"><i class="fa fa-file-text"></i> Voir plus</a>
					</div>
				</div>
			</div>
			<?php }?>
		</div>
	</div>
</div>
<?php }elseif(isset($_GET['cat'])){?>
<?php
	$sql = "SELECT * FROM categories WHERE id_cat={$_GET['cat']}";
	$res = $conn->query($sql);
	$row = $res->fetch_assoc();
	$ca_nom = $row['nom_cat'];
?>
<div class="big-title" id="slider">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="p-big-title text-center">
                    <h2>Catégorie : <i><?php echo $ca_nom;?></i></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="promotion">
	<div class="container">
		<div class="row">
		<?php
			$maxproducts = 20; // nombre des produits par page
			if(isset($_GET['page'])) $mypage = $_GET['page'];
			else $mypage = 1;
			$startfrom = $maxproducts * ($mypage - 1);
			$sql = "SELECT * FROM products WHERE id_cat = {$_GET['cat']} ORDER BY id_pro DESC LIMIT $startfrom, $maxproducts";
			$res = $conn->query($sql);
			$sql1 = "SELECT * FROM products WHERE id_cat = {$_GET['cat']}";
			$res1 = $conn->query($sql1);
			$nbproducts = mysqli_num_rows($res1);
			$nbpages = ceil($nbproducts / $maxproducts);
			while($row = $res->fetch_assoc()){ ?>
			<div class="col-md-3 prpro-card">
				<div class="proproduct col-md-4">
					<img src="<?php echo $row['vignette_pro'];?>">
					<span class="promo-how-much">Réduction : <b id="prct"><?php echo $row['promo_pro'];?>%</b></span>
				</div>
				<div class="col-md-8 pdesc">
					<a href="details.php?p=<?php echo $row['id_pro'];?>"><span class="title"><?php echo $row['nom_pro'];?></span></a><br>
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
					<br>
					<div class="controller">
						<a href="index.php?addtocart=<?php echo $row['id_pro'];?>&q=1" class="btn-action promo-action"><i class="fa fa-shopping-cart"></i> Ajouter</a>
						<a href="details.php?p=<?php echo $row['id_pro'];?>" class="btn-action promo-action"><i class="fa fa-file-text"></i> Voir Plus</a>
					</div>
				</div>
			</div>
		<?php }?>
		</div>
		
		<div class="row">
			<div class="pagepad"><center>
				<?php
				if($nbpages!=1 && $mypage > 1) echo "<a href='index.php?cat={$_GET['cat']}&page=1'><<</a>";
				if($nbpages!=1 && $mypage > 1) echo "<a href='index.php?cat={$_GET['cat']}&page=".($mypage-1)."'>Précédent</a>";
					for($i=1;$i<=$nbpages;$i++){
						if($i==$mypage+2 && $i<$nbpages-1){
							echo "<a>...</a>";
						}else{
							if($i==$mypage) echo "<a class='active-page'>$i</a>";
							else echo "<a href='index.php?cat={$_GET['cat']}&page=$i'>$i</a>";
						}
					}
				if($nbpages!=1 && $mypage<$nbpages) echo "<a href='index.php?cat={$_GET['cat']}&page=".($mypage+1)."'>Suivant</a>";
				if($nbpages!=1 && $mypage<$nbpages) echo "<a href='index.php?cat={$_GET['cat']}&page=".($nbpages)."'>>></a>";
				?>
			</center></div>
		</div>
	</div>
</div>

<?php }elseif(isset($_GET['cats'])){?>

<div class="big-title" id="slider">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="p-big-title text-center">
                    <h2>Catégories</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="categs">
	<div class="container">
		<div class="row">
			<?php
				$catscol = array("#2980b9", "#27ae60", "#e67e22", "#34495e", "#f39c12", "#9b59b6", "#1abc9c", "#f1c40f", "#2c3e50", "#c0392b", "#16a085", "#e74c3c", "#8e44ad");
				$sql = "SELECT * FROM categories";
				$res = $conn->query($sql);
				$i=0;
				while($row = $res->fetch_assoc()){
					echo "
					<div class='cats col-md-3'>
						<a href='index.php?cat={$row['id_cat']}'><div  style='background-color:".$catscol[$i]."'>{$row['nom_cat']}</div></a>
					</div>";
					$i++;
				}
			?>
		</div>
	</div>
</div>
<?php }elseif(isset($_GET['login'])){?>

<div class="big-title" id="slider">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="p-big-title text-center">
                    <h2>Authentification</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="login">
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
					<h2 class="orange">Produits Aléatoire</h2>
					<div>
					<?php 
						$prinsess = array();
						if(! isset($_SESSION['panier'])){$prinsess[0] = 0;}
						else{
							foreach($_SESSION['panier'] as $pro){
								$prinsess[] = $pro[0];
							}
						}
						$sql = "SELECT * FROM products";
						$res = $conn->query($sql);
						$pr = array();
						while(count($pr)<3){
							$pr1 = rand(1,mysqli_num_rows($res));
							if(! in_array($pr1, $pr) && ! in_array($pr1, $prinsess)) $pr[]=$pr1;
						}
						$sql = "SELECT * FROM products WHERE id_pro='{$pr[0]}' OR id_pro='{$pr[1]}' OR id_pro='{$pr[2]}'  ORDER BY id_pro DESC LIMIT 3";
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

			<div class="col-md-6" class="conn">
				<table class="maconn"><form method="POST">
					<tr>
						<th>
							<label>Utilisateur</label>
						</th>
						<td>
							<input type="text" placeholder="Email" name="eml" class="col-md-12 col-sm-12 col-xs-12" required>
						</td>
					</tr>
					<tr>
						<th>
							<label>Mot de pass</label>
						</th>
						<td>
							<input type="password" placeholder="Password" name="pwd" class="col-md-12 col-sm-12 col-xs-12" required>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="reset" value="Effaçer" class="btns" class="col-md-6 col-sm-6 col-xs-12">
							<input type="submit" value="Connexion" class="btns" name="doConn" class="col-md-6 col-sm-6 col-xs-12">
						</td>
					</tr></form>
				</table>
				<?php
					if($isloggedin === false){
						echo "<p class='alert alert-danger'>Les informations sont incorrect</p>";
					}
				?>
			</div>

			<div class="sameas col-md-3">
					<h2 class="orange">Dérniere Produits</h2>
					<div>
					<?php 
						$sql = "SELECT * FROM products WHERE ";
						for($i=0;$i<count($prinsess);$i++) $sql .= "id_pro<>'".$prinsess[$i]."' AND ";
						$sql = substr($sql, 0, strlen($sql) - 4);
						$sql .= "ORDER BY id_pro DESC LIMIT 3";
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
	</div>
</div>


<?php }elseif(isset($_GET['cart'])){?>

<div class="big-title" id="slider">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="p-big-title text-center">
                    <h2>Mon Panier</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="suivipan">
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
					<h2 class="orange">Produits Aléatoire</h2>
					<div>
					<?php 
						$prinsess = array();
						if(! isset($_SESSION['panier'])){$prinsess[0] = 0;}
						else{
							foreach($_SESSION['panier'] as $pro){
								$prinsess[] = $pro[0];
							}
						}
						$sql = "SELECT * FROM products";
						$res = $conn->query($sql);
						$pr = array();
						while(count($pr)<3){
							$pr1 = rand(1,mysqli_num_rows($res));
							if(! in_array($pr1, $pr) && ! in_array($pr1, $prinsess)) $pr[]=$pr1;
						}
						$sql = "SELECT * FROM products WHERE id_pro='{$pr[0]}' OR id_pro='{$pr[1]}' OR id_pro='{$pr[2]}'  ORDER BY id_pro DESC LIMIT 3";
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
						$sql = "SELECT * FROM products WHERE ";
						for($i=0;$i<count($prinsess);$i++) $sql .= "id_pro<>'".$prinsess[$i]."' AND ";
						$sql = substr($sql, 0, strlen($sql) - 4);
						$sql .= "ORDER BY id_pro DESC LIMIT 3";
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
			<?php 
				if(isset($_GET['suiv'])) $suiv = $_GET['suiv'];
				else $suiv = 1;
			?><br><br>
			<div class="col-md-9"><center>
				<div class="col-md-2" style="margin-left:50px;<?php if($suiv==1) echo "color:#5a88ca"?>">
					<label>RESUME</label>
					<div class="pan1" style="<?php if($suiv==1) echo "background-color:#5a88ca"?>"></div>
					<span class="pani" style="<?php if($suiv==1) echo "background-color:#5a88ca;color:#fff"?>">1</span>
				</div>
				<div class="col-md-2" style="<?php if($suiv==2) echo "color:#5a88ca"?>">
					<label>IDENTIFICATION</label>
					<div class="pan2" style="<?php if($suiv==2) echo "background-color:#5a88ca"?>"></div>
					<span class="pani" style="<?php if($suiv==2) echo "background-color:#5a88ca;color:#fff"?>">2</span>
				</div>
				<div class="col-md-2" style="<?php if($suiv==3) echo "color:#5a88ca"?>">
					<label>ADRESSE</label>
					<div class="pan3" style="<?php if($suiv==3) echo "background-color:#5a88ca"?>"></div>
					<span class="pani" style="<?php if($suiv==3) echo "background-color:#5a88ca;color:#fff"?>">3</span>
				</div>
				<div class="col-md-2" style="<?php if($suiv==4) echo "color:#5a88ca"?>">
					<label>FRAIS DE PORT</label>
					<div class="pan4" style="<?php if($suiv==4) echo "background-color:#5a88ca"?>"></div>
					<span class="pani" style="<?php if($suiv==4) echo "background-color:#5a88ca;color:#fff"?>">4</span>
				</div>
				<div class="col-md-2" style="<?php if($suiv==5) echo "color:#5a88ca"?>">
					<label>PAIEMENT</label>
					<div class="pan5" style="<?php if($suiv==5) echo "background-color:#5a88ca"?>"></div>
					<span class="pani" style="<?php if($suiv==5) echo "background-color:#5a88ca;color:#fff"?>">5</span>
				</div></center>
				<?php
					if(isset($_POST['updatecart'])){
						for($i=0;$i<count($_SESSION['panier']);$i++){
							$_SESSION['panier'][$i][1] = $_POST['newqtt'][$i];
						}
					}
				?>

				<?php if($suiv == 1){?>
				<br><br><br><form method="POST">
				<h2>1- Resumé <?php if(isset($_SESSION['panier'])){?><span class="btn-update" style="float: right;"><button type='submit' name='updatecart' style='background-color: transparent;border: 0;color: #5a88ca;cursor: pointer;'><i class="fa fa-save"></i></button></span><?php }?></h2>
				<table class="table-stripped table-samecol">
				<thead>
					<tr>
						<th></th>
						<th>PRODUIT</th>
						<th>DESCRIPTION</th>
						<th>DISPONIBILITE</th>
						<th>PRIX UNITAIRE</th>
						<th>QUANTITE</th>
						<th>TOTAL</th>
					</tr>
				</thead>

				<script type="text/javascript">
					function addV(p){
						var qtt = document.getElementById('panqtt'+p);
						var i = parseInt(qtt.value);
						if(i<30) i = i + 1;
						qtt.value = i;
						calculate(p);
					}
					function splV(p){
						var qtt = document.getElementById('panqtt'+p);
						var i = parseInt(qtt.value);
						if(i>1) i = i - 1;
						qtt.value = i;
						calculate(p);
					}
					function calculate(p){
						var qtt = document.getElementById('panqtt'+p);
						var i = parseInt(qtt.value);
						var prix = document.getElementById('panpr'+p).value;
						document.getElementById('clc'+p).innerHTML = (i * prix) + " DH";
						calculateTotal();
					}
				</script>
				<tbody>
				<?php 
				if(isset($_GET['delpro'])){
					unset($_SESSION['panier'][$_GET['delpro']]);
				}
				$t_ttc=0;
				if(isset($_SESSION['panier'])){
					$k=0;
					foreach($_SESSION['panier'] AS $pro){
						$sql = "SELECT * FROM products WHERE id_pro='".$pro[0]."'";
            			$res = $conn->query($sql);
            			$row = $res->fetch_array();
            			echo "<tr>
            				<td><span><a href='index.php?cart=true&suiv=1&delpro=$k' class='delpro'>x</a></span></td>
							<td align='center'><img src='{$row['vignette_pro']}' width='90' height='100'></td>
							<td align='center'><a href='details.php?p={$pro[0]}'>{$row['nom_pro']}</a></td>
							<td align='center'>";if($row['stock_pro']==0)echo "<img src='img/no.png'>";else echo "<img src='img/yes.png'>"; echo "</td>
							<td align='center'>";
							if($row['promo_pro'] == 0){
								echo "<span class='price'>".$row['prix_pro']." DH</span>";
								$myprc = $row['prix_pro'];
							}
							else{
								$newprice = ceil($row['prix_pro'] - ($row['prix_pro'] * $row['promo_pro']/100));
								echo "<span class='price'>".$newprice." DH</span><br>";
								$myprc = $newprice;
							} echo "</td>
							<td align='center'>"; 
								echo "<a onclick='splV({$pro[0]})' class='pls'>-</a>";
								echo "<input type='number' max='{$row['stock_pro']}' min='1' name='newqtt[]' value='{$pro[1]}' id='panqtt{$pro[0]}' onchange='calculate({$pro[0]});'>";
								echo "<a onclick='addV({$pro[0]})' class='pls'>+</a>
								<br><small><i><h7><font color=#aaa>Quantité stock : {$row['stock_pro']}</font></h7></i></small>
								<input type='hidden' value='$myprc' id='panpr{$pro[0]}' style='display:none'>";
							echo "</td>
							<td align='center'><b><span id='clc{$pro[0]}'>".($myprc * $pro[1])." DH</span></b></td>
						</tr>";
						$t_ttc+=$myprc * $pro[1];$k++;
					}
				}else{
					echo "<tr><td colspan=6><h2>Aucun Produit Dans Le Panier</h2></td></tr>";
				}
				?>
				<tr style="border-top: 1px solid #000;">
					<td colspan="5"></td>
					<th>Total TTC</th>
					<td><b><span id="t_ttc"><?php echo $t_ttc;?> DH</span></b></td>
				</tr>
				</tbody>
			</table></form>
			<?php }elseif($suiv == 2){$_SESSION['etatpanier'] = 2;?>
				<?php
					if(isset($_SESSION['nanouser'])) echo "<meta http-equiv='refresh' content='0; url=index.php?cart=true&suiv=3' />";
					else echo "<meta http-equiv='refresh' content='0; url=index.php?login=true&continucart=true' />";
				?>
			<?php }elseif($suiv == 3){$_SESSION['etatpanier'] = 3;?>
				<br><br><br><br>
				<h2>Addresse de livraison</h2>
				<?php
					if(! isset($_SESSION['command'])) create_command(date("Y-m-d"), "", $_SESSION['nanouser']);
					if(isset($_POST['dovaladdr'])){
						if(isset($_POST['originaddr'])){
							create_command(date("Y-m-d"), $_POST['originaddr'], $_SESSION['nanouser']);
						}else{
							create_command(date("Y-m-d"), $_POST['newaddr'], $_SESSION['nanouser']);
						}
					}
				?>
				<div>
				<script type="text/javascript">
				function changeaddr(){
					if(document.getElementById('livadd').checked == true){
						document.getElementById('mylivaddr').style.display = "none";
					}else{
						document.getElementById('mylivaddr').style.display = "inline-block";
					}
				}
				</script>
				<?php if($_SESSION['command'][1] == ""){?>
					<table style="color: #000"><form method="POST">
						<tr>
							<td>
								<input onclick="changeaddr()" id="livadd" type="checkbox" name="originaddr" value="<?php  echo $ui_address;?>" checked> Utiliser : <b><?php echo $ui_address;?></b>
							</td>
						</tr>
						<tr id="mylivaddr" style="display: none">
							<td>Nouveau addresse de livraison : <br><input type="text" name="newaddr"></td>
						</tr>
						<tr>
							<td><input type="submit" value="Valider L'address" name="dovaladdr" style="border: 2px solid #5a88ca; background-color: #5a88ca;color: #fff;"></td>
						</tr></form>
					</table>
				<?php }else{?>
					<h4 style="color:#5a88ca">Votre address de laivraison est :<b>
					<?php echo $_SESSION['command'][1];?></b></h4>
				<?php }?>
				</div>
			<?php }elseif($suiv == 4){$_SESSION['etatpanier']=4;?>
				<br><br><br><br>
				<h2>Frais de port</h2>
			<?php }elseif($suiv == 5){$_SESSION['etatpanier']=5;?>
				<br><br><br><br>
				<h2>Service de Paiment</h2>
			<?php }elseif($suiv == 6){$_SESSION['etatpanier']=5;
				echo "<br><br><br><br>";
				$date_cmd = $_SESSION['command'][0];
				$address_cmd = $_SESSION['command'][1];
				$user_cmd = $_SESSION['command'][2];
				$sql = "INSERT INTO commands (date_cmd, address_cmd, state_cmd, id_user) VALUES('$date_cmd', '$address_cmd', 0, $user_cmd)";
				$res = $conn->query($sql);
				$cmdid = mysqli_insert_id($conn);
				foreach($_SESSION['panier'] as $pan){
					$sql = "SELECT prix_pro FROM products WHERE id_pro={$pan[0]}";
					$res = $conn->query($sql);
					$row = $res->fetch_assoc();
					$panprix = $row['prix_pro'];
					$sql = "INSERT INTO detcommands (qtte_det, prix_det, id_pro, id_cmd) VALUES($pan[1], $panprix, $pan[0], $cmdid)";
					$res = $conn->query($sql);
				}
				echo "<p class='alert alert-success'>Votre Command A été enregistré avec succees</span>";
				unset($_SESSION['panier']);
				unset($_SESSION['etatpanier']);
				unset($_SESSION['command']);
				echo "<meta http-equiv='refresh' content='5, index.php?showcommand=$cmdid'>";
			 }?>
			<?php if(isset($_SESSION['panier'])){?>
			<?php if($suiv<2) echo "<a href='index.php' style='float: left;'><h3><< CONTINUER MES ACHATS</h3></a>";?>
			<a href="index.php?cart=true&suiv=<?php $suiv++;echo $suiv;?>" style="float: right;"><h3><?php $suiv--;if($suiv<5) echo "SUIVANT";else echo "Passer La Command";?> >></h3></a>
			<?php }?>
			</div>
		</div>
	</div>
</div>

<?php }elseif(isset($_GET['contact'])){ ?>
<div class="big-title" id="slider">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="p-big-title text-center">
                    <h2>Contacter Nous</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="contact">
	<div class="container">
		<div class="row">
			<div class="contact-side col-md-7">
				<form method="POST">
					<table style="width: 100%;margin-top: 20px;margin-bottom: 20px;">
						<body>
							<tr>
								<th><label>Votre Email : </label></th>
								<td><input type="text" name="" class="col-md-12 col-sm-12 col-xs-12" placeholder="votre email"></td>
							</tr>

							<tr>
								<th><label>Sujet : </label></th>
								<td><input type="text" name="" class="col-md-12 col-sm-12 col-xs-12" placeholder="poser un sujet"></td>
							</tr>

							<tr>
								<th><label>Message : </label></th>
								<td><textarea class="col-md-12 col-sm-12 col-xs-12" rows="10" placeholder="votre message ici"></textarea></td>
							</tr>
							<tr><td></td>
								<td><input type="reset" class="btn-action b-0" value="Effaçer">
								<input type="submit" name="sendMsg" class="btn-action f-right b-0" value="Envoyer"></td>
							</tr>
						</body>
					</table>
				</form>
			</div>

			<div class="contact-details col-md-5"><br><br><br>
				<img src="img/main-contact-us.png" class="col-md-12 col-sm-12 col-xs-12">
			</div>
		</div>
	</div>
</div>
<?php }elseif(isset($_GET['register'])){?>
<div class="big-title" id="slider">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="p-big-title text-center">
                    <h2>Créer un compte chez nous</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="register-me">
	<div class="container">
	<?php 
	if(isset($_POST['registerme'])){
		$accexist = false;
		$sql = "SELECT id_user FROM users WHERE email_user='{$row['me_email']}'";
		$res = $conn->query($sql);
		if(mysqli_num_rows($res)>0){
			echo "<center><p class='alert alert-warning'>Ce compte est déjâ existé</p></center>";
		}else{
			move_uploaded_file($_FILES['me_avatar']['tmp_name'], "img/avatars/".$_FILES['me_avatar']['name']);
			$me_avatar = "img/avatars/".$_FILES['me_avatar']['name'];
			$me_nom = $_POST['me_nom'];
			$me_prenom = $_POST['me_prenom'];
			$me_email = $_POST['me_email'];
			$me_address = $_POST['me_address'];
			$me_pwd = $_POST['me_pwd'];
			$me_country = $_POST['me_country'];
			$me_zip = $_POST['me_zip'];
			$me_news = 0;
			if(isset($_POST['me_news'])) $me_news = 1;
			$sql = "INSERT INTO users (nom_user, prenom_user, avatar_user, email_user, pwd_user, address_user, country_user, codezip_user, newsletterable) VALUES('$me_nom', '$me_prenom', '$me_avatar', '$me_email', '$me_pwd', '$me_address', '$me_country', '$me_zip', $me_news)";
			if($res = $conn->query($sql)){
				echo "center><p class='alert alert-success'>Votre compte àn été créer aver succée</p></center>";
				$_SESSION['nanouser'] = mysqli_insert_id($conn);
				$isloggedin = true;
				echo "<meta http-equiv='refresh' content='2, index.php'>";
			}else{
				echo "<center><p class='alert alert-danger'>Erreur pandant la création de votre compte</p></center>";
			}
		}
	}else{
	?>
		<form method="POST" enctype="multipart/Form-data">
		<div class="row">
			<div class="col-md-6">
				<table width="100%">
					<tr>
						<th>Nom : </th>
						<td><input type="text" name="me_nom" required class="col-md-12 col-sm-12 col-lg-12 col-xs-12"></td>
					</tr>
					<tr>
						<th>Prenom : </th>
						<td><input type="text" name="me_prenom" required class="col-md-12 col-sm-12 col-lg-12 col-xs-12"></td>
					</tr>
					<tr>
						<th>Avatar : </th>
						<td><input type="file" name="me_avatar" required class="col-md-12 col-sm-12 col-lg-12 col-xs-12"></td>
					</tr>
					<tr>
						<th>Adresse : </th>
						<td><input type="text" name="me_address" required class="col-md-12 col-sm-12 col-lg-12 col-xs-12"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-6">
				<table width="100%">
					<tr>
						<th>E-mail : </th>
						<td><input type="mail" name="me_email" required class="col-md-12 col-sm-12 col-lg-12 col-xs-12"></td>
					</tr>
					<tr>
						<th>Mot de pass : </th>
						<td><input type="password" name="me_pwd" required class="col-md-12 col-sm-12 col-lg-12 col-xs-12"></td>
					</tr>
					<tr>
						<th>Pays : </th>
						<td>
							<select name="me_country" style="width:100%" required >
								<?php require('countries.php');?>
							</select>
						</td>
					</tr>
					<tr>
						<th>Code Zip : </th>
						<td><input type="text" name="me_zip" required class="col-md-12 col-sm-12 col-lg-12 col-xs-12"></td>
					</tr>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<input type="checkbox" name="me_news"><font color=#456><b> Send me news in my email (<i>activate newspaper</i>)</b></font>
			</div>
			<div class="col-md-6">
				<input type="submit" name="registerme" value="S'inscrire" class="btn-action b-0 f-right promo-btn hba-search-btn">
			</div>
		</div></form>
		<?php }?>
	</div>
</div>

<?php }elseif(isset($_GET['search'])){?>
<div class="big-title" id="slider">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="p-big-title text-center"><form method="POST">
                    <h2>Rechercher <input type="search" name="this_search" required style="border:1px solid #e5e5e5; color:#456;font-size: 14pt;padding:5px"><button type="submit" name="start_search" class="btn-hba-search"><i class="fa fa-search"></i></button></h2></form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hba-search">
	<div class="container">
		<div class="row">
			<div class="col-md-12 hba-search-container">
				<?php if(isset($_POST['start_search'])) echo "<p class='hot-title'>Résultat de la recherche : <i><font color=#5a88ca>  ".$_POST['this_search']."</font></i></p>";?>
			<?php
			if(isset($_POST['start_search'])){
			$sql = "SELECT id_pro,nom_pro FROM products";
			$res = $conn->query($sql);
			$tbwords = array();
			$tbids = array();
			$mysearch = trim($_POST['this_search']);
			$words = explode(' ', $mysearch);
			while($row = $res->fetch_assoc()){
				$nbwords = 0;
				$dwords = explode(' ', $row['nom_pro']);
				foreach($words as $word){
					foreach($dwords as $dword){
						if(strtoupper($word) == strtoupper($dword)) $nbwords++;
					}
				}
				if($nbwords>0){$tbwords[] = $nbwords;$tbids[] = $row['id_pro'];}
				if(count($tbwords) >= 15) break; /// MAximum de produits recherché est 15
			}
			for($i=0;$i<count($tbwords);$i++){
				for($j=$i;$j<count($tbwords);$j++){
					if($j>$i){
						$e = $tbwords[$j];
						$tbwords[$j] = $tbwords[$i];
						$tbwords[$i] = $e;
						$e = $tbids[$j];
						$tbids[$j] = $tbids[$i];
						$tbids[$i] = $e;
					}
				}
			}
			$sql = "SELECT * FROM products WHERE id_pro=0 ";
			for($i=0;$i<count($tbids);$i++){
				$myidsearch = $tbids[$i];
				$sql .= " OR id_pro=$myidsearch";
			}
			$res = $conn->query($sql);
			while($row = $res->fetch_assoc()){
			?>
			<div class="product col-md-4 col-sm-4 col-xs-12" style="height: 150px;">
				<div class="contents">
					<div class="hot-img col-md-5">
						<img src="<?php echo $row['vignette_pro'];?>" height="90" width="100">
						<div class="shad">
							<a href="index.php?addtocart=<?php echo $row['id_pro'];?>&q=1">
							<div id="shad-addtocart">
								<i class="fa fa-shopping-cart"></i>
								<span>ajouter</span>
							</div>
							</a>
							<a href="details.php?p=<?php echo $row['id_pro']?>">
							<div id="shad-view">
								<i class="fa fa-file-text"></i>
								<span>voir plus</span>
							</div>
							</a>
						</div>
					</div>
					<div class="hot-desc col-md-7">
						<a href="details.php?p=<?php echo $row['id_pro']?>"><?php echo $row['nom_pro'];?></a>
						<br>
						<span class="descr"><?php echo substr(str_replace("\n", ", ", str_replace("|", ": ", $row['description_pro'])),0, 50)."...";?></span>
						<br>
						<?php
							if($row['promo_pro'] == 0){
								echo "<span class='price'>".$row['prix_pro']." DH</span>";
							}
							else{
								$newprice = ceil($row['prix_pro'] - ($row['prix_pro'] * $row['promo_pro']/100));
								echo "<span class='price'>".$newprice." DH</span><br>
								<span class='price-promo'><s>".$row['prix_pro']." DH</s></span>
								";
							}
						?>
						<br>
						<a href="index.php?addtocart=<?php echo $row['id_pro'];?>&q=1" class="btn-action" id="btn-action-buy"><i class="fa fa-shopping-cart"></i></a>
						<a href="details.php?p=<?php echo $row['id_pro']?>" class="btn-action"><i class="fa fa-file-text"></i> Voir plus</a>
					</div>
				</div>
			</div>
			<?php } if(count($tbwords) <= 0) echo "<h2><center><font color=grey>Aucun produit pour votre recherche</font></center></h2>";
			}else{
				echo "<h2><center><font color=grey>Aucun recherche n'a pas été éfectué</font></center></h2>";
			}
			?>
			</div>
		</div>
	</div>
</div>

<?php }?>

<?php include('footer.php');?>