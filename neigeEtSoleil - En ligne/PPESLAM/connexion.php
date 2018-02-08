<!DOCTYPE html>
<html lang="fr">

<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=ppeleger', 'root', '');

if(isset($_POST['formconnexion']))
{
	$mailconnect = htmlspecialchars($_POST['mailconnect']);
	$mdpconnect = sha1($_POST['mdpconnect']);
	if(!empty($mailconnect) AND !empty($mdpconnect))
	{
		$requser = $bdd->prepare("SELECT * FROM client WHERE mailClient = ? AND mdpClient = ?");
		$requser->execute(array($mailconnect, $mdpconnect));
		$userexist = $requser->rowCount();
		if($userexist == 1)
		{
			$userinfo = $requser->fetch();
			$_SESSION['IDClient'] = $userinfo['IDClient'];
			$_SESSION['NomClient'] = $userinfo['NomClient'];
			$_SESSION['mailClient'] = $userinfo['mailClient']; 
			header("Location: profil.php?IDRepre=".$_SESSION['IDRepre']);
		}
		else
		{
			$erreur = "Mauvais mail ou mot de passe";
		}
	}
	else
	{
		$erreur = "Tous les champs doivent être complétés !";
	}
}

?>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Connexion: Neige et Soleil</title>
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
						<h2>Connexion</h2>
						<br><br>
						<form method ="POST" action="">
							<input type="text" name="mailconnect" placeholder="Mail" />
							<input type="password" name="mdpconnect" placeholder="Mot de passe" />
							<input type="submit" name="formconnexion" value="se connecter" />
							<br/>
							<p>Pas encore de compte ? <a href="inscription.php">Inscrivez-vous !</a></p>
						</form>
						<br>
						<?php
						if(isset($erreur))
						{
							echo '<font color="red">'.$erreur."</font>";
						}
						?>
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