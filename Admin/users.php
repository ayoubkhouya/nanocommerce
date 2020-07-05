<?php include('header.php');?>
<?php
if(isset($_GET['del'])){
	$sql = "DELETE FROM users WHERE id_user={$_GET['del']}";
	$res = $conn->query($sql);
}
if(isset($_GET['make'])){
	$sql = "UPDATE users SET account_type=1 WHERE id_user={$_GET['make']}";
	$res = $conn->query($sql);
}
if(isset($_GET['unmake'])){
	$sql = "UPDATE users SET account_type=0 WHERE id_user={$_GET['unmake']}";
	$res = $conn->query($sql);
}
?>
	
	<section id="main" class="column">

		<article class="module full_width" style="width: 94%">
		<header><h3 class="tabs_involved">Content Manager</h3>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>ID</th> 
    				<th>Nom</th>
    				<th>Email</th>
    				<th>Fonctionalité</th> 
    				<th>Actions</th>
				</tr> 
			</thead> 
			<tbody> <form method="POST">
			<?php
				$sql = "SELECT * FROM users WHERE id_user<>{$_SESSION['nanadmin']}";
				$res = $conn->query($sql);
				while($row = $res->fetch_assoc()){
					echo "<tr> 
	    				<td>{$row['id_user']}</td> 
	    				<td>";
	    				 echo $row['nom_user'];
	    				echo "</td>
	    				<td width='50%'>";
	    				 echo $row['email_user'];
	    				echo "</td><td>";
	    				if($row['account_type'] == 1) echo "<a href='users.php?unmake={$row['id_user']}' title='Unset admin' style='color:orange'><b>Administrateur</b></a>";
	    				else echo "<a href='users.php?make={$row['id_user']}' title='Set admin'>Client</a>";
	    				echo "</td><td>";
	    				 echo "<a href='users.php?del={$row['id_user']}'><img src='images/icn_trash.png' title='Supprimer'></a>";
	    				echo "</td> 
					</tr>
					";
					$lastid = ++$row['id_user'];
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