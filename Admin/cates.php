<?php include('header.php');?>
<?php
if(isset($_POST['addcat'])){
	$nom = $_POST['catname'];
	$desc = $_POST['catdesc'];
	$sql = "INSERT INTO categories VALUES('', '$nom', '$desc')";
	$res = $conn->query($sql);
}
if(isset($_POST['doedit'])){
	$sql = "UPDATE categories SET nom_cat='{$_POST['edtname']}', description_cat='{$_POST['edtdesc']}' WHERE id_cat={$_POST['edtid']}";
	$res = $conn->query($sql);
	header('location: cates.php');
}
if(isset($_GET['del'])){
	$sql = "DELETE FROM categories WHERE id_cat={$_GET['del']}";
	$res = $conn->query($sql);
}
?>
	
	<section id="main" class="column">

		<article class="module full_width" style="width: 94%">
		<header><h3 class="tabs_involved">Content Manager</h3>
		<span><a href='cates.php?addnew=true' title="Ajouter Une Catégorie"><font size="5"><b>+</b></font></a></span>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>ID</th> 
    				<th>Category</th>
    				<th>Description</th>
    				<th>Actions</th> 
				</tr> 
			</thead> 
			<tbody> <form method="POST">
			<?php
				$sql = "SELECT * FROM categories";
				$res = $conn->query($sql);
				while($row = $res->fetch_assoc()){
					echo "<tr> 
	    				<td>{$row['id_cat']}</td> 
	    				<td>";
	    				if(isset($_GET['edition'])){
	    					if($_GET['edition'] == $row['id_cat']) echo "<input type='text' name='edtname' value='{$row['nom_cat']}' required>";
	    					else echo $row['nom_cat'];
	    				}else echo $row['nom_cat'];
	    				echo "</td>
	    				<td width='50%'>";
	    				if(isset($_GET['edition'])){
	    					if($_GET['edition'] == $row['id_cat']) echo "<textarea rows='2' cols='30' name='edtdesc'>{$row['description_cat']}</textarea>";
	    					else echo $row['description_cat'];
	    				}else echo $row['description_cat'];
	    				echo "</td>
	    				<td>";
	    				if(isset($_GET['edition'])){
	    					if($_GET['edition'] == $row['id_cat']) echo "<input type='submit' name='doedit' value='OK'><input type='hidden' value='{$row['id_cat']}' name='edtid'>";
	    					else echo "<a href='cates.php?edition={$row['id_cat']}'><img src='images/icn_edit.png' title='Editer'></a> &nbsp; <a href='cates.php?del={$row['id_cat']}'><img src='images/icn_trash.png' title='Supprimer'></a>";
	    				}else echo "<a href='cates.php?edition={$row['id_cat']}'><img src='images/icn_edit.png' title='Editer'></a> &nbsp; <a href='cates.php?del={$row['id_cat']}'><img src='images/icn_trash.png' title='Supprimer'></a>";
	    				echo "</td> 
					</tr>
					";
					$lastid = ++$row['id_cat'];
				}
				if(isset($_GET['addnew'])){
					echo "<tr> 
	    				<td style='transform:scale(1.1)'><b><i>$lastid</i></b></td> 
	    				<td><input type='text' name='catname' placeholder='Nom de la catégorie' required></td>
	    				<td><textarea rows='2' cols='30' name='catdesc'></textarea></td>
	    				<td><button type='submit' title='Ajouter' name='addcat' style='cursor:pointer;background-color:transparent;border:0'><font size=4><b>+</b></font></button></td> 
					</tr>
					";
				}
			?></form>
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->

		<div class="spacer"></div>
	</section>


</body>

</html>