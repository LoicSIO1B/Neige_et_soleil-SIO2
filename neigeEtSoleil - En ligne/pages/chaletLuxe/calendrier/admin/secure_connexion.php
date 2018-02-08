<?php
//

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("genere/connexion.php");

//chemin vers le fichier liste des logements couleur et locataires*******************************************
     require("fichier_calendrier/calendrier_liste_couleur.php");
     require("fichier_calendrier/calendrier_liste_logement.php");
     require("fichier_calendrier/calendrier_liste_locataire.php");

//chemin vers le fichier de liste des locataires/logements**********************************************************
    require("fichier_calendrier/parametres_calendrier.php");
    $periode_location = 7 ;
	
// chemin vers le fichier  fonctions ****************************************************************
     require("fonction.php");

    $mot_de_passe_decrypt = Decrypte(mot_de_passe,$Cle);

// controle si sessions avec indentifiants existe ***************************************************

 if (  ( !isset($_SESSION['id_connexion']) || !isset($_SESSION['mdp']) || $_SESSION['id_connexion'] <> identifiant || $_SESSION['mdp'] <> $mot_de_passe_decrypt )  && ( !defined('MODE_SECURE') || MODE_SECURE ) ) {
    header('Location: identification.php');
    exit;
 }

  //test si au moins un logement existe , si non redirection pour créer un logement ****************
  if ( !isset($nom_logement) && ( !isset($page) || ( isset($page) && ( $page <> 'logement' && $page <>  'manque_logement' && $page <> 'ajout_logement' )))  ) {
    header('Location: manque_logement.php');
    exit;
  }

// initialisation de variables *********************************************************************
header( 'content-type: text/html; charset=ISO-8859-1' );
$header_iso	= true ;

$affiche_info = '';

$refresh = time();
?>