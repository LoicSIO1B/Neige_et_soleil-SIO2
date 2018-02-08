<?php
// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
if (!defined('AUTOR_FCT_GEN_CALENDRIER')  )
     require("secure_genere.php");

  $chemin_fichier = $chemin_vers_fichier."fichier_calendrier/dates_sans_bdd/".$vecteur_index_logement."_calendrier.php";
  
  @fputs($file, "<?php");
  @fputs($file, "\n");

  $nb_result = isset($tableau_reservation[$vecteur_index_logement]) ? count ($tableau_reservation[$vecteur_index_logement]) : 0;
  if ( $nb_result > 0 ) {
	  
  // tri tableau par chronologie *********************************************
  foreach ($tableau_reservation[$vecteur_index_logement] as $date_index => $val_reservation ) {
	  list($annee_temp,$mois_temp,$jour_temp) 										= explode ("-",$date_index);
	  $tableau_reservation_temp[mktime(1,0,0,$mois_temp,$jour_temp,$annee_temp)] 	= $val_reservation ;  // creation nouveau tableau avec timestamp comme index
  }	
  unset($tableau_reservation[$vecteur_index_logement]); // vide le tableau existant
  ksort($tableau_reservation_temp);  // tri chronologique  
  //$tableau_reservation[$vecteur_index_logement] = $tableau_reservation_temp;  // copie dans le tableau réservation 
  foreach ($tableau_reservation_temp as $timestamp_index => $val_reservation ) {
	  $tableau_reservation[$vecteur_index_logement][date("Y-m-d",$timestamp_index)] 	= $val_reservation ;  // creation nouveau tableau avec timestamp comme index
  }	
  //  ************************************************************************
  
  //boucle pour index du logement ************************************
  foreach ($tableau_reservation[$vecteur_index_logement] as $date_index => $val_reservation ) {
     // pour le logement en cours ************************************
      list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$val_reservation);
      $contenu_temp = $couleur_temp.'%&%'.$couleur_texte_temp.'%&%'.$tri_locataire_temp.'%&%'.$tarif_temp.'%&%'.guillet_var ($commentaire_temp);
      @fputs($file, '$tableau_reservation['.$vecteur_index_logement.']["'.$date_index.'"]= "'.$contenu_temp.'" ;' );
      @fputs($file, "\n");
    }
  }

  @fputs($file, "\n");
  @fputs($file, "\n");
  @fputs($file, '$fin_tableau_reservation_'.$vecteur_index_logement.' = true ;');
  @fputs($file, "\n");
  @fputs($file, "\n");

  @fputs($file, "?>");

//fermeture du fichier
$creation_reussi = @fclose($file);

?>