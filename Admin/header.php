<?php include('../config.php');?>
<?php
if(! isset($_SESSION['nanadmin'])) header('location: login.php');
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>NanoCommerce Admin Panel</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	<script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="js/dataTables.bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.php">NanoCommerce</a></h1>
			<h2 class="section_title">Admin Panel</h2><div class="btn_view_site">
			<a href="../index.php" target="_blank">Visiter le site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p><?php 
				$sql = "SELECT * FROM users WHERE id_user={$_SESSION['nanadmin']}";
				$res = $conn->query($sql);
				$row = $res->fetch_assoc();
				echo $row['nom_user']." ".$row['prenom_user'];
			?><a href="logout.php" style="float: right;">Déconnexion</a></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="index.html">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Dashboard</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<h3>Contenu</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="addpro.php">Ajout produit</a></li>
			<li class="icn_edit_article"><a href="index.php">Editer produit</a></li>
			<li class="icn_categories"><a href="cates.php">Categories</a></li>
			<li class="icn_images"><a href="index.php?banner=true">Bannière</a></li>
		</ul>
		<h3>Accounts</h3>
		<ul class="toggle">
			<li class="icn_folder"><a href="users.php">Utilisateurs</a></li>

		</ul>	
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2019 <a href="#" target="_blank">Ayoub KHOUYA</a></strong></p>
			<p>&copy; NanoCommerce</p>
		</footer>
	</aside><!-- end of sidebar -->