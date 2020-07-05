<?php include('config.php');?>
<?php
if(isset($_SESSION['nanouser']) && isset($_GET['login'])){
    header('location: index.php');
}
if(! isset($_SESSION['etatpanier'])) $_SESSION['etatpanier'] = 1;
if(! isset($_GET['suiv']) && isset($_GET['cart'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?cart=true&suiv={$_SESSION['etatpanier']}' />";
}
if(isset($_POST['doConn'])){
    $sql = "SELECT * FROM users WHERE email_user='{$_POST['eml']}' AND pwd_user='{$_POST['pwd']}'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    if(mysqli_num_rows($res) > 0){
        $_SESSION['nanouser'] = $row['id_user'];
        $isloggedin = true;
        if(! isset($_GET['continucart'])) echo "<meta http-equiv='refresh' content='0; url=index.php' />";
        else echo "<meta http-equiv='refresh' content='0; url=index.php?cart=true&suiv=3' />";
    }else{
        $isloggedin = false;
    }
}
if(isset($_SESSION['nanouser'])){
    $sql = "SELECT * FROM users WHERE id_user={$_SESSION['nanouser']}";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    $ui_nom = $row['nom_user'];
    $ui_prenom = $row['prenom_user'];
    $ui_acc = $row['account_type'];
    $ui_address = $row['address_user'];
}
function create_command($date_cmd, $address_cmd, $user_cmd){
    if($date_cmd!="") $_SESSION['command'][0] = $date_cmd;
    else $_SESSION['command'][0] = "";
    if($address_cmd!="") $_SESSION['command'][1] = $address_cmd;
    else $_SESSION['command'][1] = "";
    if($user_cmd!="") $_SESSION['command'][2] = $user_cmd;
    else $_SESSION['command'][2] = "";
}
if(isset($_GET['addtocart']) && isset($_GET['q'])){
    $existpan = false;$idex = 0;
    if(isset($_SESSION['panier'])){
        foreach($_SESSION['panier'] as $pan){
            if($pan[0] == $_GET['addtocart']){
                $existpan = true;
                break;
            }
            $idex++;
        }
    }   
    if(! $existpan){
        $_SESSION['panier'][] = array($_GET['addtocart'], $_GET['q']);
    }
}
if(isset($_POST['btnaddcart'])){
    $existpan = false;$idex = 0;
    if(isset($_SESSION['panier'])){
        foreach($_SESSION['panier'] as $pan){
            if($pan[0] == $_POST['setthisone']){
                $existpan = true;
                break;
            }
            $idex++;
        }
    }
    if(! $existpan){
        $_SESSION['panier'][] = array($_POST['setthisone'], $_POST['qttprd']);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>NanoCommerce | Home</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body onscroll="setTopMenuFixed()" onload="startcarousel()">
<?php
if(! isset($_SESSION['visited'])){
    $_SESSION['visited'][] = 0;
}
?>
<div class="header">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="user-menu">
                    <ul>
                        <?php if(isset($_SESSION['nanouser'])) echo "<li><a><i class='fa fa-user'></i> $ui_prenom $ui_nom</a></li>";?>
                        <?php if(! isset($_SESSION['nanouser'])) echo "<li><a href='index.php?login=true'><i class='fa fa-sign-in'></i> Connexion</a></li>
                        <li><a href='index.php?register=true'><i class='fa fa-user'></i> S'inscrire</a></li>";
                        else echo "<a href='logout.php'><i class='fa fa-sign-out'></i> Déconnexion</a></li>";?>
                    </ul>
                </div>
			</div>
			<div class="col-md-4">
				<div class="right-menu">
                    <ul>
                        <?php
                         if(isset($_SESSION['nanouser']) &&$ui_acc==1) echo "<li><a href='Admin/index.php'><i class='fa fa-user'></i> Administration</a></li>";
                         ?>
                        <li><a href="index.php?cart=true"><i class="fa fa-shopping-cart"></i> Mon Panier</a></li>
                    </ul>
                </div>
			</div>
		</div>
	</div>
</div>

<div class="brinding">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="logo" id="logo">
                    <h1><a href="index.php"><img src="img/logo.png" id="imglogo"></a></h1>
                </div>
			</div>
			<div class="col-sm-6">
				<div class="pub-header">
				<?php
					$sql = "SELECT * FROM pub WHERE id_pub=1";
					$res = $conn->query($sql);
					while($row = $res->fetch_assoc()){
						echo "<a href='{$row['link_pub']}' target='_blank'><img src='{$row['pub']}' width='100%' height='100%'></a>";
					}
				?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="shopping-item">
                    <a href="index.php?cart=true">Panier - <span class="cart-amunt">
                    <?php
                    	if(! isset($_SESSION['panier'])){
                    		echo "0 DH";
                    	}else{
                    		$myprice=0;
                    		foreach($_SESSION['panier'] as $pro){
                    			$sql = "SELECT prix_pro, promo_pro FROM products WHERE id_pro='".$pro[0]."'";
                    			$res = $conn->query($sql);
                    			$row = $res->fetch_array();
                    			if($row['promo_pro']>0){
                    				$k = ceil($row['prix_pro'] - ($row['prix_pro'] * $row['promo_pro']/100));
                    			 	$myprice +=  $k * $pro[1];
                    			 }else{
                    			 	$myprice += $pro[1] * $row['prix_pro'];
                    			}
                    		}
                    		echo $myprice." DH";
                    	}
                    ?>
                    </span> <i class="fa fa-shopping-cart"></i> 
                    <span class="product-count">
                    <?php
                    	if(! isset($_SESSION['panier'])){
                    		echo "0";
                    	}else{
                    		echo count($_SESSION['panier']);
                    	}
                    ?>
                    </span></a>
                </div>
			</div>
		</div>
	</div>
</div>

<div class="datareciever"></div> <!-- ce div recevoir des code php pour l ajout sans actualiser la page (avec ajax(jquery))-->

<div class="mainmenu" id="mainmenu">
	<div class="container">
		<div class="row">
			<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-bars"></i>
                </button>
            </div> 
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li <?php if(! isset($_GET['cat']) && ! isset($_GET['cats']) && ! isset($_GET['cart']) && ! isset($_GET['login']) && ! isset($_GET['contact']) && ! isset($_GET['register']) && ! isset($_GET['search'])) echo "class='active'";?>><a href="index.php">Home</a></li>
                    <li <?php if(isset($_GET['cats']) || isset($_GET['cat'])) echo "class='active'";?>><a href="index.php?cats=true">Catégories</a></li>
                    <li <?php if(isset($_GET['cart'])) echo "class='active'";?>><a href="index.php?cart=true">Panier</a></li>
                    <li <?php if(isset($_GET['contact'])) echo "class='active'";?>><a href="index.php?contact=true">Contact</a></li>
                    <?php 
                        if(! isset($_SESSION['nanouser'])){ echo "<li "; 
                        if(isset($_GET['register']) || isset($_GET['login'])) echo "class='active'";
                        echo "><a href='index.php?login=true'>Connexion</a></li>";
                        }else echo "<li><a href='logout.php'>Déconnexion</a></li>";
                    ?>
                    <li <?php if(isset($_GET['search'])) echo "class='active'";?>> <a href='index.php?search=true'><i class='fa fa-search'></i></a></li>
                </ul>
            </div> 
		</div>
	</div>
</div>
