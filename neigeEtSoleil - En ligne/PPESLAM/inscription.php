<!DOCTYPE html>
<html lang="fr">

<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=ppeleger', 'root', '');

if (isset($_POST['forminscription']))
{
	$nom=htmlspecialchars($_POST['nom']);
	$prenom=htmlspecialchars($_POST['prenom']);
	$telephone=htmlspecialchars($_POST['telephone']);
	$mail=htmlspecialchars($_POST['mail']);
	$mail2=htmlspecialchars($_POST['mail2']);
	$mdp=sha1($_POST['mdp']);
	$mdp2=sha1($_POST['mdp2']);
	if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['telephone']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
	{
		$pseudolength = strlen($nom);
		if($pseudolength <= 255)
		{
				if($mail == $mail2)
				{
					if(filter_var($mail, FILTER_VALIDATE_EMAIL))
					{
						$reqmail = $bdd ->prepare("SELECT * FROM Client WHERE mailClient = ?");
						$reqmail->execute(array($mail));
						$mailexist = $reqmail->rowCount();	
						if($mailexist == 0)
						{

							if($mdp == $mdp2)
							{
								$insertmbr = $bdd->prepare(" INSERT INTO Client(nomClient, prenomClient, telClient, mailClient mdpClient) VALUES(?, ?, ?, ?, ?)");
								$insertmbr->execute(array($nom, $prenom, $telephone, $mail, $mdp));
								$erreur = "Votre compte à bien été créé <a href=\"connexion.php\">Me connecter</a> ";
							}
							else
							{
								$erreur = "Vos mots de passes ne correspondent pas";
							}
						}
						else
						{
							$erreur = "Votre adresse mail est déjà enregistrée";
						}
					}
					else
					{
						$erreur = "Votre adresse mail n'est pas valide";
					}

				}
				else
				{
					$erreur = "Vos adresses mail ne correspondent pas";
				}
		}
		else
		{
			$erreur = "Votre pseudo ne doit pas dépasser 255 caractéres";
		}
	}
	else
	{
		$erreur = "Tous les champs doivent être complétés";
	}

}

?>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Inscription: Neige et Soleil</title>
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
<h2>Inscription</h2>
		<br><br>
		<form method ="POST" action="">
			<table>
				<tr>
					<td align="right">
						<label for="nom">Nom :</label>
					</td>
					<td>
						<input type="text" placeholder="Votre nom" id="nom" name="nom" <!--pattern="[A-Za-z]*" title="Lettres seulement" --> <value="<?php if(isset($pseudo)) { echo $pseudo; } ?>"/>
					</td>
				</tr>
				<tr>
					<td align="right">
						<label for="prenom">Prénom :</label>
					</td>
					<td>
						<input type="text" placeholder="Votre prenom" id="prenom" name="prenom" <!-- pattern="[A-Za-z]*" title="Lettres seulement" --> <value="<?php if(isset($prenom)) { echo $prenom; } ?>"/>
					</td>
				</tr>
				<tr>
					<td align="right">
						<label for="prenom">Téléphone :</label>
					</td>
					<td>
						<input type="text" placeholder="Votre téléphone" id="telephone" name="telephone" pattern="[0-9]*" title="Nombres seulement" value="<?php if(isset($telephone)) { echo $telephone; } ?>"/>
					</td>
				</tr>
				<tr>
					<td align="right">
						<label for="mail">Mail :</label>
					</td>
					<td>
						<input type="text" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>"/>
					</td>
				</tr>
				<tr>
					<td align="right">
						<label for="mail2">Confirmation mail :</label>
					</td>
					<td>
						<input type="text" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>"/>
					</td>
				</tr>
				<tr>
					<td align="right">
						<label for="mdp">Mot de passe</label>
					</td>
					<td>
						<input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" pattern="[a-zA-Z0-9]{8,}" title="8 caractères minimum."/>
					</td>
				</tr>
				<tr>
					<td align="right">
						<label for="mdp2">Confimation MDP :</label>
					</td>
					<td>
						<input type="password" placeholder="Votre mot de passe" id="mdp2" name="mdp2" pattern="[a-zA-Z0-9]{8}"/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td align="center">
						<br>
						<input type="submit" name="forminscription" value="Je m'inscris"/>
					</td>
				</tr>
			</table>	
		</form>
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