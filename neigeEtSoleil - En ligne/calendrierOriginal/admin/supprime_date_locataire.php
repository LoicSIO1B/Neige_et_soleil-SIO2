<?php
// chemin vers le fichier  config.inc.php param�trews de connection � la base de donn�es*************
  include("secure_genere.php");
//r�cup�ration des listes logement ******************************************************************
  include("fichier_calendrier/calendrier_liste_logement.php");

  $etat_req = true ;

  foreach ($nom_logement as $cle => $val_logement ) {

  if (  $cle <> 0  ) {

  //controle si le fichier est disponible pour �criture *****************
  $fichier_libre = false;
  $chemin_fichier = 'fichier_calendrier/dates_sans_bdd/'.$cle.'_calendrier.php';
  $chemin_fichier_sauvegarde = 'fichier_calendrier/dates_sans_bdd/'.$cle.'_sauvegarde_calendrier.php';
  $pointeur_variable_fin_fichier_ok = 'fin_tableau_reservation_'.$cle;

  while (!isset($$pointeur_variable_fin_fichier_ok)  || !$$pointeur_variable_fin_fichier_ok) {
     include ($chemin_fichier);
     if ( isset($$pointeur_variable_fin_fichier_ok)  && $$pointeur_variable_fin_fichier_ok ) {
     //sauvegarde ancien fichier*********************************
     @copy($chemin_fichier,$chemin_fichier_sauvegarde);
     $file= @fopen($chemin_fichier, "w");
     $fichier_libre = true;
     }
  }

  @fputs($file, "<?php");
  @fputs($file, "\n");

  if ( isset($tableau_reservation[$cle]) ) {
  foreach ($tableau_reservation[$cle] as $date_index => $val_reservation ) {
    //extraction des donn�es des lignes de r�servation *****************
      list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$val_reservation);
    //si locataire diff�rent de id � supprimer alors on ajout la date ******
      if( $tri_locataire_temp <> $num_supprime ) {
         $contenu_temp = $couleur_temp.'%&%'.$couleur_texte_temp.'%&%'.$tri_locataire_temp.'%&%'.$tarif_temp.'%&%'.guillet_var ($commentaire_temp);
         @fputs($file, '$tableau_reservation['.$cle.']["'.$date_index.'"]= "'.$contenu_temp.'" ;' );
         @fputs($file, "\n");
         }
       }
    }

  unset($tableau_reservation );
  @fputs($file, "\n");
  @fputs($file, "\n");
  @fputs($file, '$fin_tableau_reservation_'.$cle.' = true ;');
  @fputs($file, "\n");
  @fputs($file, "\n");
  @fputs($file, "\n");
  @fputs($file, "?>");
  //fermeture du fichier
  $etat_req = @fclose($file);
  //****************************************************************************************************
  }
 }

 
?>