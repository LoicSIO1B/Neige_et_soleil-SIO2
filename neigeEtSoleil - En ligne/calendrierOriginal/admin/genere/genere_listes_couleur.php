<?php
// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_genere.php");

//***************************************************************************************************
// création fichier des locataires ******************************************************************
//***************************************************************************************************

$chemin_fichier = "fichier_calendrier/calendrier_liste_couleur.php";
$chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_calendrier_liste_couleur.php";

//sauvegarde ancien fichier*********************************
@copy($chemin_fichier,$chemin_fichier_sauvegarde);

$entete = '//***************************************************************************************************
// fichier contenant la liste des logements et des locataires
//***************************************************************************************************';

$file= @fopen($chemin_fichier, "w");

  @fputs($file, "<?php");
  @fputs($file, "\n");

  @fputs($file, ''.$entete.' ' );
  @fputs($file, "\n");

// inscription des couleurs********************************************************
  @fputs($file, "\n");
  $nb_result = count ($couleur_reserve);
  if ( $nb_result > 0 ) {
  foreach ($couleur_reserve as $cle => $val_couleur_reserve )  {
  @fputs($file, '$couleur_reserve['.$cle.'] = "'.$val_couleur_reserve.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$url_couleur_reserve['.$cle.'] = "'.guillet_var ($url_couleur_reserve[$cle]).'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$intitule_couleur_reserve['.$cle.'] = "'.guillet_var (ucfirst($intitule_couleur_reserve[$cle])).'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_texte_jour_reserve['.$cle.'] = "'.$couleur_texte_jour_reserve[$cle].'" ;' );
  @fputs($file, "\n");
  if ( $couleur_affiche_tarif[$cle] )
      @fputs($file, '$couleur_affiche_tarif['.$cle.'] = true ;' );
  else
      @fputs($file, '$couleur_affiche_tarif['.$cle.'] = false ;' );
  @fputs($file, "\n");
  if ( $couleur_date_clic[$cle] )
      @fputs($file, '$couleur_date_clic['.$cle.'] = true ;' );
  else
      @fputs($file, '$couleur_date_clic['.$cle.'] = false ;' );
  @fputs($file, "\n");
  if ( $couleur_invisible[$cle] )
      @fputs($file, '$couleur_invisible['.$cle.'] = true ;' );
  else
      @fputs($file, '$couleur_invisible['.$cle.'] = false ;' );
  @fputs($file, "\n");
  if ( $date_couleur_barre[$cle] )
      @fputs($file, '$date_couleur_barre['.$cle.'] = true ;' );
  else
      @fputs($file, '$date_couleur_barre['.$cle.'] = false ;' );
  @fputs($file, "\n");
  if ( $date_couleur_disponible[$cle] )
      @fputs($file, '$date_couleur_disponible['.$cle.'] = true ;' );
  else
      @fputs($file, '$date_couleur_disponible['.$cle.'] = false ;' );
  @fputs($file, "\n");
  if ( isset($date_couleur_synchro[$cle]) && $date_couleur_synchro[$cle] )
      @fputs($file, '$date_couleur_synchro['.$cle.'] = true ;' );
  else 
      @fputs($file, '$date_couleur_synchro['.$cle.'] = false ;' );
  @fputs($file, "\n");
  @fputs($file, "\n");
     }
  }


  @fputs($file, "\n");
  @fputs($file, '$fin_tableau_couleur = true;');
  @fputs($file, "\n");
  @fputs($file, "\n");

  @fputs($file, "?>");

//fermeture du fichier
$creation_reussi = @fclose($file);
 

//test si utilisation des images diagonale pour cellules marquées*************************
//$gd_info = gd_info();
if ( $avec_diagonale_cellule )
   include("genere/genere_image_couleur.php");

//mise a jour feuille de style*************************
   include("genere/genere_style.php");

?>