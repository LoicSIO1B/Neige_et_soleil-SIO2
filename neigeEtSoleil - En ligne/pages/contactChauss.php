<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Contact: Neige et Soleil</title>
		<!-- Bootstrap -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/bootstrap-theme.css" rel="stylesheet">
		<link href="../css/style3colonnes.css" rel="stylesheet">
		<link href="../css/contenuContact.css" rel="stylesheet">
	</head>

	<body>
		<header>

		<!-- Gestion du menu responsive -->
		<div class="bouton">
			<a href="../inscription.php"><input  type="submit" name="inscription" value="inscription" /></a>
			<a href="../connexion.php"><input  type="submit" name="connexion" value="Connexion" /></a>
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
					  <a class="navbar-brand" href="../index.php">Neige <span class="signelogo">et</span> Soleil</a>
					</div>
					<!-- Menu -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="../index.php">Accueil</a></li>
							<li><a href="presentation.html">Présentation</a></li>
							<li><a href="../index.php#catalogue">Nos locations</a></li>
							<li class="active"><a href="/">Contact</a></li>
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
				<form id="form" name="form1" method="post" action=" ">

				<div class="container2">  
				  <form id="contact" action="" method="post">
				    <h3>Réserver des Chausses-Ski</h3>
				    <h4>Contactez nous, nous vous répondrons en 24h !</h4>
				    <fieldset>
				      <input placeholder="Votre nom" name="nom" type="text" tabindex="1" style="width: 250px; margin-left: 30%; margin-bottom: 5px;" required autofocus>
				    </fieldset>
				    <fieldset>
				      <input placeholder="Votre prénom" name="prenom" type="text" tabindex="2" style="width: 250px; margin-left: 30%; margin-bottom: 5px;" required autofocus>
				    </fieldset>
				    <fieldset>
				      <input placeholder="Votre Adresse Mail" name="mail" type="email" tabindex="3" style="width: 250px; margin-left: 30%; margin-bottom: 5px;" required>
				    </fieldset>
				    <fieldset>
				      <input placeholder="Votre Numéro de Téléphone" name="tel" type="tel" tabindex="4" style="width: 250px; margin-left: 30%; margin-bottom: 5px;" required>
				    </fieldset>
				    <fieldset>
				      <input placeholder="Votre age" name="age" type="text" tabindex="5" style="width: 250px; margin-left: 30%; margin-bottom: 5px;" required>
				    </fieldset>
				    <fieldset>
				      <textarea placeholder="Entrez les caractéristiques de la location ici (taille, marque, modéle, etc...)." name="msg" tabindex="6" style="width: 250px; height: 200px; margin-left: 30%; margin-bottom: 5px;" required></textarea>
				    </fieldset>
				    <fieldset>
				      <button name="submit" type="submit" id="contact-submit" style="margin-left: 50%;" data-submit="...Sending">Réserver</button>
				    </fieldset>
				  </form>
				</div>

				<?php
				  if(isset($_POST) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['tel']) && !empty($_POST['age']) && !empty($_POST['msg'])){
				      extract($_POST);
				      $destinataire = 'francis.motsch@gmail.com';
				      $sdl = '\n';
				      $expediteur =' Prénom:'.$prenom.$sdl.' Nom:'.$nom.' '.' <'.$mail.'>'. ' Tel:'.$tel.' Age:'.$age;
				      $mail=mail($destinataire, "De MesGarants.com : Chausse-Ski", $expediteur, $msg);
				      if($mail) echo'<div align=center><font color="white">'.'Email envoyé avec succés'."</font></div>"; else echo'<div align=center><font color="red">'.'Echec d\'envoi de l\'email'."</font></div>";
				  }else echo'<div align=center><font color="red">'."Formulaire non soumis ou des champs sont vides"."</font></div>";
				  

				?>

				<script>
				  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

				  ga('create', 'UA-40633639-2', 'auto');
				  ga('send', 'pageview');

				</script>	
				

				</form>

			</section>

		</section>

				<aside class="pub ombre"><img src="../images/logo.jpg" width="175"/></aside>
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