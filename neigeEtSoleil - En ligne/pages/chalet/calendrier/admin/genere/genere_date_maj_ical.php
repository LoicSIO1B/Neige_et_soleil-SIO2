<?php

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
if (!defined('AUTOR_FCT_SAUVEGARDE') ) 
	require("secure_genere.php");

if ( isset($vecteur_index_logement) && is_numeric($vecteur_index_logement) ) {
	$chemin_fichier = "fichier_calendrier/ical/".$vecteur_index_logement."_date_mise_a_jour.php";
	$date_maj_calendrier = '';

	$file= @fopen($chemin_fichier, "w");

	@fputs($file, "<?php");
	@fputs($file, "\n");

	$mois_maj 	=  (int)date("m") ;
	$jour_maj 	=  date("d") ;
	$annee_maj 	=  date("Y") ;
	
	$heure_maj 	=  date("H:i:s") ;
	  
	$date_maj_calendrier["fr"] = $jour_maj." ".$mois_fr[$mois_maj]." ".$annee_maj ;
	$date_maj_calendrier["all"] = $jour_maj." ".$mois_all[$mois_maj]." ".$annee_maj ;
	$date_maj_calendrier["eng"] = $jour_maj." ".$mois_eng[$mois_maj]." ".$annee_maj ;
	$date_maj_calendrier["it"] = $jour_maj." ".$mois_it[$mois_maj]." ".$annee_maj ;
	$date_maj_calendrier["esp"] = $jour_maj." ".$mois_esp[$mois_maj]." ".$annee_maj ; 

	@fputs($file, '$date_maj_ical['.$vecteur_index_logement.']["fr"]= "'.$date_maj_calendrier["fr"].' '.$heure_maj.'" ;' );
	@fputs($file, "\n");
	@fputs($file, '$date_maj_ical['.$vecteur_index_logement.']["all"]= "'.$date_maj_calendrier["all"].' '.$heure_maj.'" ;' );
	@fputs($file, "\n");
	@fputs($file, '$date_maj_ical['.$vecteur_index_logement.']["eng"]= "'.$date_maj_calendrier["eng"].' '.$heure_maj.'" ;' );
	@fputs($file, "\n");
	@fputs($file, '$date_maj_ical['.$vecteur_index_logement.']["it"]= "'.$date_maj_calendrier["it"].' '.$heure_maj.'" ;' );
	@fputs($file, "\n");
	@fputs($file, '$date_maj_ical['.$vecteur_index_logement.']["esp"]= "'.$date_maj_calendrier["esp"].' '.$heure_maj.'" ;' );
	@fputs($file, "\n"); 
	@fputs($file, '$date_maj_ical['.$vecteur_index_logement.']["timestamp"]= "'.time().'" ;' );
	@fputs($file, "\n");
	@fputs($file, "\n");


	@fputs($file, "\n");
	@fputs($file, "?>");

	//fermeture du fichier
	$creation_reussi_maj = @fclose($file);

}

 

?>