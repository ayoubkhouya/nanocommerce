<?php include('../config.php');?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<style type="text/css">
	body{
		background-color: #e5e5e5;
		background-image: url("../img/pix.jpg");
	}
	.all{
		margin-top: 220px;
	}
	.tbl{
		width: 300px;
	}
	.tbl tr td input{
		border: 2px solid #5acca8;
		padding: 5px;
		margin-top: 5px;

	}
	.tbl tr td input.btns{
		width: 48%;
	}
</style>
</head>
<body>

<?php
if(isset($_SESSION['nanadmin'])) header('location: index.php');
if(isset($_POST['doadmini'])){
	$sql = "SELECT * FROM users WHERE email_user='{$_POST['admin']}' AND pwd_user='{$_POST['pwd']}' AND account_type=1";
	$res = $conn->query($sql);
	$row = $res->fetch_assoc();
	if(mysqli_num_rows($res) > 0){
		$_SESSION['nanadmin'] = $row['id_user'];
		header('location: index.php');
	}else{
		echo "<p class='alert alert-danger' style='margin-top:-220px;position:fixed;width:100%;text-align:center'><font size=4><b>Les informations sont incorrect</b></font></p>";
	}
}
?>

<div class="all"><center>
	<div class="container">
		<div class="row">
		<form method="POST">
			<table class="tbl">
			<caption><a href="../index.php"><< Renvoie Au Site</a></caption>
				<tr>
					<td>
						Utilisateur :
					</td>
					<td>
						<input type="text" name="admin" style="width: 98%" required>
					</td>
				</tr>
				<tr>
					<td>
						Mot de pass :
					</td>
					<td>
						<input type="password" name="pwd" style="width: 98%" required>
					</td>
				</tr>
				<tr><td></td>
					<td>
						<input type="reset" value="Effaçer" class="btns">
						<input type="submit" name="doadmini" value="Connexion" class="btns">
					</td>
				</tr>
			</table>
		</form>
		</div>
	</div></center>
</div>

</body>
</html>