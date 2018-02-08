<!DOCTYPE html>
<html lang="fr">

<?php
session_start();

ini_set('display_errors', 1); 
ini_set('log_errors', 1); 
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); 
error_reporting(E_ALL);

$bdd = new PDO('mysql:host=mesgaranibword.mysql.db;dbname=mesgaranibword', 'mesgaranibword', 'L1v31988');

if(isset($_SESSION['id']))
{
	 $requser = $bdd->prepare("SELECT * FROM proprietaire WHERE idPro = ?");
	 $requser-> execute(array($_SESSION['id']));
	 $user = $requser->fetch();

	 if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['newnom'])
	 {
	 	$newnom = htmlspecialchars($_POST['newnom']);
	 	$insertnom = $bdd->prepare("UPDATE proprietaire SET nomPro = ? WHERE idPro = ?");
	 	$insertnom->execute(array($newnom, $_SESSION['id']));
	 	header('Location: profilPro.php?id='.$_SESSION['id']);
	 }

	 if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['newprenom'])
	 {
	 	$newprenom = htmlspecialchars($_POST['newprenom']);
	 	$insertprenom = $bdd->prepare("UPDATE proprietaire SET prenomPro = ? WHERE idPro = ?");
	 	$insertprenom->execute(array($newprenom, $_SESSION['id']));
	 	header('Location: profilPro.php?id='.$_SESSION['id']);
	 }

	 if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['newmail'])
	 {
	 	$newmail = htmlspecialchars($_POST['newmail']);
	 	$insertmail = $bdd->prepare("UPDATE proprietaire SET mailPro = ? WHERE idPro = ?");
	 	$insertmail->execute(array($newmail, $_SESSION['id']));
	 	header('Location: profilPro.php?id='.$_SESSION['id']);
	 }

	 if(isset($_POST['newtelephone']) AND !empty($_POST['newtelephone']) AND $_POST['newtelephone'] != $user['newtelephone'])
	 {
	 	$newtelephone = htmlspecialchars($_POST['newtelephone']);
	 	$inserttelephone = $bdd->prepare("UPDATE membre SET telephone = ? WHERE id = ?");
	 	$inserttelephone->execute(array($newtelephone, $_SESSION['id']));
	 	header('Location: profil.php?id='.$_SESSION['id']);
	 }

	 if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
	 {
	 	$mdp1 = sha1($_POST['newmdp1']);
	 	$mdp2 = sha1($_POST['newmdp2']);

	 	if ($mdp1 == $mdp2)
	 	{
	 		$insertmdp = $bdd->prepare("UPDATE membre SET motdepasse = ? WHERE id = ?");
	 		$insertmdp->execute(array($mdp1, $_SESSION['id']));
	 		header('Location: profil.php?id='.$_SESSION['id']);
	 	}
	 	else
	 	{
	 		$msg = "Vos mots de passes ne correspondent pas !";
	 	}
	 	
	 }

	 if(isset($_POST['newnom']) AND $_POST['newnom'] == $user['nom'])
	 {
	 	header('Location: profil.php?id='.$_SESSION['id']);
	 }

?>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Edition: Neige et Soleil</title>
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<link href="css/style3colonnes.css" rel="stylesheet">
		<link href="css/contenuContact.css" rel="stylesheet">
	</head>

	<body>
		<header>

		<!-- Gestion du menu responsive -->
		<div class="bouton">
			<a href="inscription.php"><input  type="submit" name="inscription" value="inscription" /></a>
			<a href="connexion.php"><input  type="submit" name="connexion" value="Connexion" /></a>
		</div>
			<nav class="nav bar-default header-top" role="navigation">
				<div class="container">

					<div class="navbar-header">
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <a class="navbar-brand" href="index.php">Neige <span class="signelogo">et</span> Soleil</a>
					</div>
					<!-- Menu -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="index.php">Accueil</a></li>
							<li><a href="pages/presentation.html">Présentation</a></li>
							<li><a href="index.php#catalogue">Nos locations</a></li>
							<li><a href="pages/contact.php">Contact</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>

	<br><br>

	<div id="conteneur">	
		<section class="ombre">
			<section class="nousVous ombre">
				<h1 class="blue">De nous <span class="bdc">à</span> <span class="vert">vous</span></h1>

				<div class="rectangle ombre">
					<h2 class="rouge">Météo</h2>
					<p>Aujourd'hui météo des piste est parfaite pour une journée au ski</p>
				</div>

				<div class="rectangle ombre">
					<h2 class="vert">Vente de matériel</h2>
					<p>Le magasin O'Soleil propose jusquau 21/06/2017 un rabais de 50% sur les locations de matériel de ski</p>
				</div>

				<div class="rectangle ombre">
					<h2 class="orange">Calendrier</h2>
					<p>Aujourd'hui s'ouvre la fête annuel de l'élevage de montagne. Venez déguster les produits de la région</p>
				</div>

				<div class="rectangle ombre">
					<h2 class="bleu">Challenge du mois</h2>
					<p>Le premier qui prendra une photo en haut du pic de la Font-Sancte gagnera une semaine d'hotel dans le Queyras n'importe quand dans l'année.</p>
				</div>
			</section>

			<section class="contenu ombre">
				<section class="contenu ombre">
					<fieldset id="admin" align="center">
					<legend>Edition de mon profil</legend>
					<div align="left">
					<form method="POST" action="">
						<table>
							<tr>
								<td><label>Nom :</label></td>
								<td align="center">
									
									<input type="text" name="newnom" placeholder="Nom" value="<?php echo $user['nomPro'] ?>" />
								</td>
							</tr>
							<tr>
								<td><label>Prénom :</label></td>
								<td align="center">
									
									<input type="text" name="newprenom" placeholder="Prenom" value="<?php echo $user['prenomPro'] ?>" />
								</td>
							</tr>
							<tr>
								<td><label>Mail :</label></td>
								<td align="center">
									
									<input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mailPro'] ?>" />
								</td>
							</tr>
							<tr>
								<td><label>Téléphone :</label></td>
								<td align="center">
									
									<input type="text" name="newtelephone" placeholder="Téléphone" value="<?php echo $user['telephonePro'] ?>" />
								</td>
							</tr>
							<tr>
								<td><label>Nouveau mdp :</label></td>
								<td align="center">
									
									<input type="password" name="newmdp1" placeholder="Mot de passe" />
								</td>
							</tr>
							<tr>
								<td><label>Confimation mdp :</label></td>
								<td align="center">
									
									<input type="password" name="newmdp2" placeholder="Confirmation mot de passe" />
								</td>
							</tr>
							<tr>
								<td></td>
								<td align="center">
									<br>
									<input type="submit" value="Mettre à jour mon profil" />
								</td>
							</tr>
						</table>
					</form>
					<?php if(isset($msg)) { echo $msg;} ?>
					</div>
				</fieldset>
				</section>

			</section>

				<aside class="pub ombre"><img src="images/profil.png" width="175"/></aside>
		</section>
	</div>
	<br/>
		<footer class="jumbotron mt50">
			<div class="container foot">
				<p><strong>Neige et Soleil</strong> 2017 - Tous droits réservés - 12 rue du village 05350 Molines-en-Queyras - Tél: 04.92.45.83.37</p>
			</div>
		</footer>		




		<!-- jQuery (necessaire pour les plugins Javascript de Bootstrap) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Inclu tous les plugins compilés -->
		<script src="js/bootstrap.min.js"></script>




	</body>

</html>

<?php
}
else
{
	header("Location: connexion.php");
}

?>