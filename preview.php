<div class="preview">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php
					$con = new mysqli('localhost', 'root', '.....', 'nanocommerce');
					$sql = "SELECT * FROM products WHERE id_pro={$_GET['p']}";
					$res = $con->query($sql);
					$row = $res->fetch_assoc();
					$img = $row['vignette_pro'];
					$nom = $row['nom_pro'];
					echo "
						<img src='$img'><br><span class=title>$nom</span>
					";
				?>
				<br>
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
				<div class="controller">
						<a href="index.php?addtocart=<?php echo $row['id_pro'];?>&q=1" class="btn-action promo-action" style='text-decoration: none;'><i class="fa fa-shopping-cart"></i> Ajouter</a>
						<a href="details.php?p=<?php echo $row['id_pro'];?>" class="btn-action promo-action" style='margin-left: 10px;text-decoration: none;'><i class="fa fa-file-text"></i> Voir Plus</a>
					</div>
			</div>
		</div>
	</div>
</div>


<dir class="profile">
	hello world
</dir>