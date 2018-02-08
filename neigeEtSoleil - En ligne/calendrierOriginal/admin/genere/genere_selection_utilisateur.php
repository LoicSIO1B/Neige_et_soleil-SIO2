<?php

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_genere.php");

//***************************************************************************************************
// création fichier date mise a jour ******************************************************************
//***************************************************************************************************

$chemin_fichier = "fichier_calendrier/calendrier_selection_utilisateur.php";

$date_maj_calendrier = '';

$file= @fopen($chemin_fichier, "w");

  @fputs($file, "<?php");
  @fputs($file, "\n");

  $mois_maj =  (int)date("m") ;
  $jour_maj =  date("d") ;
  $annee_maj =  date("Y") ;

       @fputs($file, '$choix_date_debut = "'.$choix_date_debut.'" ;' );
       @fputs($file, "\n");
       @fputs($file, '$choix_date_fin  = "'.$choix_date_fin.'" ;' );
       @fputs($file, "\n");
       @fputs($file, '$periode_affiche  = "'.$periode_affiche.'" ;' );
       @fputs($file, "\n");

       if ( isset($choix_selection_locataire) && is_numeric($choix_selection_locataire))
         @fputs($file, '$choix_selection_locataire  = '.$choix_selection_locataire.' ;' );
       else
         @fputs($file, '$choix_selection_locataire  = 0 ;' );
       @fputs($file, "\n");

       if ( isset($choix_selection_logement) && is_numeric($choix_selection_logement))
         @fputs($file, '$choix_selection_logement  = '.$choix_selection_logement.' ;' );
       else
         @fputs($file, '$choix_selection_logement  = 0 ;' );
       @fputs($file, "\n");

      if ( isset($liste_couleur) )
             foreach ($liste_couleur as $cle_temp => $val_temp )  {
             @fputs($file, '$liste_couleur['.$cle_temp.']  = '.$val_temp.' ;' );
             @fputs($file, "\n");
       }

       if ( isset($listing_complet) && $listing_complet == 'on' )
          @fputs($file, '$listing_complet = "on" ;' );
       else
          @fputs($file, '$listing_complet = "off" ;' );
       @fputs($file, "\n");

       if ( isset($locataire_complet) && $locataire_complet == 'on' )
          @fputs($file, '$locataire_complet = "on" ;' );
       else
          @fputs($file, '$locataire_complet = "off" ;' );
       @fputs($file, "\n");
       
       if ( isset($avec_infobulle) && $avec_infobulle == 'on' )
          @fputs($file, '$avec_infobulle = "on" ;' );
       else
          @fputs($file, '$avec_infobulle = "off" ;' );
       @fputs($file, "\n");

       if ( isset($format_date_export)  )
          @fputs($file, '$format_date_export = "'.$format_date_export.'" ;' );
       else
          @fputs($file, '$format_date_export = "JJ/MM/AAAA" ;' );

       @fputs($file, "\n");

  @fputs($file, "\n");

  @fputs($file, "?>");

//fermeture du fichier
$creation_reussi = @fclose($file);
 

?>