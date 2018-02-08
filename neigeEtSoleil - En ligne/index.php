<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/jpg" href="images/logo.jpg">
		<title>Neige et Soleil</title>
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		
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
					  <a class="navbar-brand" href="#/">Neige <span class="signelogo">et</span> Soleil</a>
					</div>
					<!-- Menu -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li class="active"><a href="/">Accueil</a></li>
							<li><a href="pages\presentation.html">Présentation</a></li>
							<li><a href="#catalogue">Nos locations</a></li>
							<li><a href="pages\contact.php">Contact</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>

		<!-- Gestion du slider -->
		<div class="effetSlider">
		<!-- Gestion de l'image -->
		<style>
			.parallax { 
			    /* The image used */
			    background-image: url("images/slider1.jpg");

			    /* Set a specific height */
			    height: 400px; 

			    /* Create the parallax scrolling effect */
			    background-attachment: fixed;
			    background-position: center;
			    background-repeat: no-repeat;
			    background-size: cover;
			}
		</style>

		<!--Container_element-->
		<div class="parallax"></div>
		<!--fin gestion image -->

			<div class="super text-center mt120 hidden-xs"> <!-- hidden-xs permet de cacher l'écriture sur le slider quand la fenêtre devient trop petite -->
				
				<h3>À la découverte du Queyras</h3>
				<h2>Des vacances inoubliables</h2>
				<h4>Voyagez maintenant</h4>
				<a href="#catalogue" class="btn white">Catalogue</a>
			</div>
		</div> <!-- Fin slider -->
		<!-- Jumbotron -->				
		<div class="jumbotron text-center"><!--jumbotron est une classe bootstrap permettant de créer une zone idéale pour le texte-->
			<div class="container">
				<balise id="catalogue"><balise>
				<p class="accroche"><a class="btn btn-danger btn-lg" href="pages/location_mat.html" role="button"> Locations</a> Location de matériel</p>
			</div>

		</div>


		<!-- Contenu -->
		<div class="container" role="main">
			<!-- row -->
			<div class="row">
				<section class="col-sm-8">
					<h2>Nos locations</h2>
				
					<div class="row">
						<article class="col-sm-6">
							<?php
								session_start();
								 
								if(!empty($_SESSION['nom']))
								{
							?>
								<div class="thumbnail">
								<a href="pages/location_app.html"><img src="images/appartement.jpg" width="100%"></a>
								<div class="caption">
									<h2>Location d'appartements</h2>
									<p>Vous trouverez dans cette rubrique tout le matériel de ski et de randonnée dont vous pourrez avoir besoin lors de vos excursions.</p>
								</div>
							</div>
							<?php	 
								}
								else
								{
							?>	 
								<div class="thumbnail">
								<a href="/" onclick="return confirm('Veuillez-vous identifier pour réserver')"><img src="images/appartementNB.jpg" width="100%"></a>
								<div class="caption">
									<h2>Location d'appartements</h2>
									<p>Vous trouverez dans cette rubrique tout le matériel de ski et de randonnée dont vous pourrez avoir besoin lors de vos excursions.</p>
								</div>
							</div>
							<?php	 
								}
								?>
							
						</article>
						<article class="col-sm-6">
							<?php
								session_start();
								 
								if(!empty($_SESSION['nom']))
								{
							?>
							<div class="thumbnail">
								<a href="pages/location_chal.html"><img src="images/chalet.jpg" width="100%"></a>
								<div class="caption">
									<h2>Location de chalets</h2>
									<p>Vous trouverez dans cette rubrique tout le matériel de ski et de randonnée dont vous pourrez avoir besoin lors de vos excursions.</p>
								</div>
							</div>
							<?php	 
								}
								else
								{
							?>	 
								<div class="thumbnail">
								<a href="/" onclick="return confirm('Veuillez-vous identifier pour réserver')"><img src="images/chaletNB.jpg" width="100%"></a>
								<div class="caption">
									<h2>Location de chalets</h2>
									<p>Vous trouverez dans cette rubrique tout le matériel de ski et de randonnée dont vous pourrez avoir besoin lors de vos excursions.</p>
								</div>
							</div>
							<?php	 
								}
								?>
							
						</article>
						<article class="col-sm-6">
							<?php
								session_start();
								 
								if(!empty($_SESSION['nom']))
								{
							?>
							<div class="thumbnail">
								<a href="pages/location_prest.html"><img src="images/luxe.jpg" width="100%"></a>
								<div class="caption">
									<h2>Location prestigieuses</h2>
									<p>Vous trouverez dans cette rubrique tout le matériel de ski et de randonnée dont vous pourrez avoir besoin lors de vos excursions.</p>
								</div>
							</div>
							<?php	 
								}
								else
								{
							?>	 
								<div class="thumbnail">
								<a href="/" onclick="return confirm('Veuillez-vous identifier pour réserver')"><img src="images/luxeNB.jpg" width="100%"></a>
								<div class="caption">
									<h2>Location prestigieuses</h2>
									<p>Vous trouverez dans cette rubrique tout le matériel de ski et de randonnée dont vous pourrez avoir besoin lors de vos excursions.</p>
								</div>
							</div>
							<?php	 
								}
								?>
							
						</article>
						<article class="col-sm-6">
							<?php
								session_start();
								 
								if(!empty($_SESSION['nom']))
								{
							?>
							<div class="thumbnail">
								<a href="pages/location_mat.html"><img src="images/location.jpg" width="100%"></a>
								<div class="caption">
									<h2>Location de matériel</h2>
									<p>Vous trouverez dans cette rubrique tout le matériel de ski et de randonnée dont vous pourrez avoir besoin lors de vos excursions.</p>
								</div>
							</div>
							<?php	 
								}
								else
								{
							?>	 
								<div class="thumbnail">
								<a href="/" onclick="return confirm('Veuillez-vous identifier pour réserver')"><img src="images/locationNB.jpg" width="100%"></a>
								<div class="caption">
									<h2>Location de matériel</h2>
									<p>Vous trouverez dans cette rubrique tout le matériel de ski et de randonnée dont vous pourrez avoir besoin lors de vos excursions.</p>
								</div>
							</div>
							<?php	 
								}
								?>
						</article>
					</div>
					
				</section>

				
		<!-- Barre sociale -->
		<aside class="col-sm-4 hidden-xs mb30">
			<h2 class="mb30">Nous <strong>suivre</strong></h2>
			<div id="fb-root"></div>
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-page mb30" data-href="https://www.facebook.com/neige.et.soleil.bramans" data-tabs="timeline" data-width="250" data-height="400" data-small-header="false" data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/neige.et.soleil.bramans" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/neige.et.soleil.bramans">Association Neige et Soleil à Bramans</a></blockquote></div>

			<h2>En <strong>direct</strong></h2>
			<a class="twitter-timeline"  href="https://twitter.com/hashtag/neige" data-widget-id="908255113306890240">Tweets sur #neige</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
          
          
          
		</aside>

			</div><!-- fin row -->
		</div><!-- fin contenu -->

		<div class="jumbotron text-center"><!--jumbotron est une classe bootstrap permettant de créer une zone idéale pour le texte-->
<head>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
</head>

<section id="carousel">    				
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
                <div class="quote"><i class="fa fa-quote-left fa-4x"></i></div>
				<div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="7000">
				  <!-- Carousel indicators -->
                  <ol class="carousel-indicators">
				    <li data-target="#fade-quote-carousel" data-slide-to="0"></li>
				    <li data-target="#fade-quote-carousel" data-slide-to="1"></li>
				    <li data-target="#fade-quote-carousel" data-slide-to="2" class="active"></li>
                    <li data-target="#fade-quote-carousel" data-slide-to="3"></li>
                    <li data-target="#fade-quote-carousel" data-slide-to="4"></li>
                    <li data-target="#fade-quote-carousel" data-slide-to="5"></li>
				  </ol>
				  <!-- Carousel items -->
				  <div class="carousel-inner">
				    <div class="item">
                        <div class="profile-circle" style="background-color: rgba(145,169,216,.2);"></div>
				    	<blockquote class="phrase">
				    		<p>Association au top. Nous avons fait de nombreux séjours avec eux hiver comme été. Jamais déçus.<br><br></p>
				    	</blockquote>	
				    </div>
				    <div class="item">
                        <div class="profile-circle" style="background-color: rgba(145,169,216,.2);"></div>
				    	<blockquote class="phrase">
				    		<p>Très bon séjour avec une équipe formidable, rigoureuse et folle-dingue. Bien mieux que les gros séjours type Club Med.<br><br></p>
				    	</blockquote>
				    </div>
				    <div class="active item">
                        <div class="profile-circle" style="background-color: rgba(145,169,216,.2);"></div>
				    	<blockquote class="phrase">
				    		<p>Ma fille devait emménager dans un super appartement pendant son voyage avec l'association. Nous l'avons rejointe et ce fut exceptionnel. Merci pour tout.</p>
				    	</blockquote>
				    </div>
                    <div class="item">
                        <div class="profile-circle" style="background-color: rgba(145,169,216,.2);"></div>
    			    	<blockquote class="phrase">
				    		<p>Premier séjour dans le Queyras et très bonne impression Peu de neige mais une excellente organisation.</p>
				    	</blockquote>
				    </div>
                    <div class="item">
                        <div class="profile-circle" style="background-color: rgba(145,169,216,.2);"></div>
    			    	<blockquote class="phrase">
				    		<p>Encore passé une superbe semaine à la montagne grâce à cette association. Mes enfants adorent tellement qu'ils ne veulent pas changer de lieu de vacances</p>
				    	</blockquote>
				    </div>
                    <div class="item">
                        <div class="profile-circle" style="background-color: rgba(145,169,216,.2);"></div>
    			    	<blockquote class="phrase">
				    		<p>Un séjour parfait dans un cadre fantastique. Petite excursion en Italie pour varier les plaisirs. Un régal.</p>
				    	</blockquote>
				    </div>
				  </div>
				</div>
			</div>							
		</div>
	</div>
</section>

		</div>

		<h2 style="text-align: center;">Ils <strong>parlent de nous</strong></h2>

		<div class="container">
				<img src="images/queyrascom.png">
				<img src="images/hautesalpes.png">
				<img src="images/ledauphine.jpg">
				<img src="images/france3.png">
			</div>

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