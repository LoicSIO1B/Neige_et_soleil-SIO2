<!DOCTYPE html>
<html lang="fr">

<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=ppeleger', 'root', '');

if(isset($_SESSION['IDRepre']))
{
	$requser = $bdd->prepare("SELECT * FROM representant WHERE IDRepre = ?");
	$requser->execute(array($_SESSION['IDRepre']));
	$user = $requser->fetch();

	if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['NomRepre'])
	{
		$newnom = htmlspecialchars($_POST['newnom']);
		$insertnom = $bdd->prepare("UPDATE representant SET NomRepre = ? WHERE IDRepre = ?");
		$insertnom->execute(array($newnom, $_SESSION['idrepre']));
		header('Location: profil.php?idrepre='.$_SESSION['idrepre']);
	}
	if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['PrenomRepre'])
	{
		$newnom = htmlspecialchars($_POST['newprenom']);
		$insertnom = $bdd->prepare("UPDATE representant SET PrenomRepre = ? WHERE IDRepre = ?");
		$insertnom->execute(array($newnom, $_SESSION['idrepre']));
		header('Location: profil.php?idrepre='.$_SESSION['idrepre']);
	}
	if(isset($_POST['newtel']) AND !empty($_POST['newtel']) AND $_POST['newtel'] != $user['TelRepre'])
	{
		$newnom = htmlspecialchars($_POST['newtel']);
		$insertnom = $bdd->prepare("UPDATE representant SET TelRepre = ? WHERE IDRepre = ?");
		$insertnom->execute(array($newnom, $_SESSION['idrepre']));
		header('Location: profil.php?idrepre='.$_SESSION['idrepre']);
	}

	if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['MailRepre'])
	{
		$newmail = htmlspecialchars($_POST['newmail']);
		$insertmail = $bdd->prepare("UPDATE representant SET MailRepre = ? WHERE IDRepre = ?");
		$insertmail->execute(array($newmail, $_SESSION['idrepre']));
		header('Location: profil.php?idrepre='.$_SESSION['idrepre']);
	}

	if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
	{
		$mdp1 = sha1($_POST['newmdp1']);
		$mdp2 = sha1($_POST['newmdp2']);

		if($mdp1 == $mdp2)
		{
			$insertmdp = $bdd->prepare("UPDATE representant SET mdprepre = ? WHERE IDRepre = ?");
			$insertmdp->execute(array($mdp1,$_SESSION['idrepre']));
			header('Location: profil.php?idrepre='.$_SESSION['idrepre']);
		}
		else
		{
			$msg = "Vos deux mdp ne correspondent pas.";
		}
	}

	if(isset($_POST['newnom']) AND $_POST['newnom'] == $user['NomRepre'])
	{
		header('Location: profil.php?idrepre='.$_SESSION['idrepre']);
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
					  <a class="navbar-brand" href="leSite.html">Neige <span class="signelogo">et</span> Soleil</a>
					</div>
					<!-- Menu -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="leSite.html">Accueil</a></li>
							<li><a href="pages/presentation.html">Présentation</a></li>
							<li><a href="leSite.html#catalogue">Nos locations</a></li>
							<li><a href="/">Contact</a></li>
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
					<div align="center">
						<h2>Edition de mon profil</h2>
						<form method ="POST" action="">
							<table>
								<tr>
									<td align="right">
										<label for="newnom">Nom :</label>
									</td>
									<td>
										<input type="text" placeholder="Votre nom" id="newnom" name="newnom" value="<?php echo $user['NomRepre']; ?>" />
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="newprenom">Prénom :</label>
									</td>
									<td>
										<input type="text" placeholder="Votre prénom" id="newprenom" name="newprenom" value="<?php echo $user['PrenomRepre']; ?>" />
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="newprenom">Téléphone :</label>
									</td>
									<td>
										<input type="text" placeholder="Votre téléphone" id="newtelephone" name="newtelephone" value="<?php echo $user['TelRepre']; ?>" />
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="mail">Mail :</label>
									</td>
									<td>
										<input type="text" placeholder="Votre mail" id="newmail" name="newmail" value="<?php echo $user['MailRepre']; ?>" />
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="mail2">Mot de passe :</label>
									</td>
									<td>
										<input type="password" placeholder="Votre mot de passe" id="newmdp1" name="newmdp1" />
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="mdp">Confirmation MDP :</label>
									</td>
									<td>
										<input type="password" placeholder="Confirmation mot de passe" id="newmdp2" name="mdp2"/>
									</td>
								</tr>
								<tr>
									<td></td>
									<td align="center">
										<br>
										<input type="submit" name="forminscription" value="Mettre à jour"/>
									</td>
								</tr>
							</table>	
						</form>
						<?php if(isset($msg)) { echo $msg; } ?>	
					</div>
				</section>

			</section>

				<aside class="pub ombre"><img src="images/boiteLettres.jpg" width="175"/></aside>
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