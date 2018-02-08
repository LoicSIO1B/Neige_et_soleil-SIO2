<?php
// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_genere.php");

//***************************************************************************************************
// création fichier des locataires ******************************************************************
//***************************************************************************************************

$chemin_fichier = "fichier_calendrier/calendrier_liste_logement.php";
$chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_calendrier_liste_logement.php";

//sauvegarde ancien fichier*********************************
@copy($chemin_fichier,$chemin_fichier_sauvegarde);

$entete = "//***************************************************************************************************
// fichier contenant la liste des logements et des locataires
//***************************************************************************************************
";

$file= @fopen($chemin_fichier, "w");

  @fputs($file, "<?php");
  @fputs($file, "\n");

  @fputs($file, ''.$entete.' ' );
  @fputs($file, "\n");

// inscription des logements********************************************************
 @fputs($file, '$nom_logement[0]= "Tous" ;' );
 @fputs($file, "\n");
 @fputs($file, "\n");

 $nb_result = count ($nom_logement);
 if ( $nb_result > 0 ) {
 foreach ($nom_logement as $cle => $val_logement )  {
   if ( $cle <> 0 ) {
      @fputs($file, '$nom_logement['.$cle.']= "'.guillet_var (ucfirst($val_logement)).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$format_calendrier_logement['.$cle.']= "'.guillet_var ($format_calendrier_logement[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$texte_jour_debut_semaine_logement['.$cle.']= "'.guillet_var ($texte_jour_debut_semaine_logement[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$tarif_logement['.$cle.']= "'.guillet_var ( str_replace(",",".",$tarif_logement[$cle])).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$capacite_logement['.$cle.']= "'.guillet_var ( $capacite_logement[$cle]).'" ;' );
      @fputs($file, "\n");
	  if ( !isset($url_synchro_logement[$cle]) || empty($url_synchro_logement[$cle]) ) {
		  @fputs($file, '$url_synchro_logement['.$cle.']= "" ;');
		  @fputs($file, "\n");
		}
	  
	  if ( isset($url_synchro_logement[$cle]) && is_array($url_synchro_logement[$cle]) ) {
			foreach ( $url_synchro_logement[$cle] as $cle_temp => $valeur ) {
				if ( $valeur <> '' ) {
					@fputs($file, '$url_synchro_logement['.$cle.']['.$cle_temp.']= "'.guillet_var ($valeur).'" ;');
					@fputs($file, "\n");
					}
			}
		}
	  //@fputs($file, '$url_synchro_logement['.$cle.']= Array('.implode(', ',$url_synchro_logement2[$cle]).' ) ;');
      //@fputs($file, "\n");
      @fputs($file, "\n");
    }
   }
 }
 
  @fputs($file, "\n");
  @fputs($file, "\n");
  @fputs($file, '$fin_tableau_logement = true;');
  @fputs($file, "\n");
  @fputs($file, "\n");
  @fputs($file, '$derniere_cle_tableau_logement = "'.$cle.'";');  
  @fputs($file, "\n");
  @fputs($file, "\n");

  @fputs($file, "?>");

//fermeture du fichier
$creation_reussi = @fclose($file);




?>