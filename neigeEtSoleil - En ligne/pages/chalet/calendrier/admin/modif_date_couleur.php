<?php
// chemin vers le fichier  config.inc.php param�trews de connection � la base de donn�es*************
  include("secure_genere.php");
//r�cup�ration des listes logement ******************************************************************
  include("fichier_calendrier/calendrier_liste_logement.php");


  foreach ($nom_logement as $cle => $val_logement ) {

  $chemin_fichier = "fichier_calendrier/dates_sans_bdd/".$cle."_calendrier.php";

  if ( $cle <> 0 ) {

  //r�cup�ration des dates par logement ******************************************************************
  include($chemin_fichier);

  $file= @fopen($chemin_fichier, "w");

  @fputs($file, "<?php");
  @fputs($file, "\n");

  if ( isset($tableau_reservation[$cle]) ) {
  foreach ($tableau_reservation[$cle] as $date_index => $val_reservation ) {
    //extraction des donn�es des lignes de r�servation *****************
      list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$val_reservation);
    //modification des couleurs ******
      if( $couleur_texte_temp == $cle_modif )
         $contenu_temp = $couleur_fond.'%&%'.$couleur_texte_temp.'%&%'.$tri_locataire_temp.'%&%'.$tarif_temp.'%&%'.guillet_var ($commentaire_temp);
       else    // couleur non modifi�es **************
         $contenu_temp = $couleur_temp.'%&%'.$couleur_texte_temp.'%&%'.$tri_locataire_temp.'%&%'.$tarif_temp.'%&%'.guillet_var ($commentaire_temp);
       
       @fputs($file, '$tableau_reservation['.$cle.']["'.$date_index.'"]= "'.$contenu_temp.'" ;' );
       @fputs($file, "\n");
      }
    }
  unset ($tableau_reservation );
  @fputs($file, "\n");
  @fputs($file, "\n");
  @fputs($file, '$fin_tableau_reservation_'.$cle.' = true ;');
  @fputs($file, "\n");  
  @fputs($file, "\n");
  @fputs($file, "?>");
  //fermeture du fichier
  $etat_req = @fclose($file);
  //****************************************************************************************************
  }
 }

 
?>