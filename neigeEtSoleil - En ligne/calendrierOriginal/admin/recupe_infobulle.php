<?php

session_start(); 

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_connexion.php");

    // controle format date ***********************************************************
    $test_date = 1 ;
    if ( isset($_GET['date_recup']) )
      $test_date = test_date_fr ($_GET['date_recup']);

    if ( $test_date == 0 && isset($_GET['log']) && is_numeric($_GET['log']) ) {
      $date_recup = date_fr_eng($_GET['date_recup'],"/","-");
      $log        = $_GET['log'];

    //**********************************************************************************
    // fonctionnement avec base de données
    //**********************************************************************************
    if ( AVEC_BDD ) {

    //connection a la base de donnees*******************************************************************
    $connect = @mysql_connect(Decrypte(hote_cal,$Cle), Decrypte(user_cal,$Cle), Decrypte(password_cal,$Cle));
    if (!$connect )
       echo '** Erreur de connexion au serveur sql **' ;
    else {
    // on choisit la bonne base
    $connect_base = @mysql_select_db(Decrypte(base_cal,$Cle), $connect) ;
    if (!$connect_base )
       echo '** Erreur de connexion à la base sql **' ;
    else {
    
   //recherche des jours reservés dans le mois en cours*********************************************
   $valeur_select = "SELECT * FROM ".Decrypte(nom_table_cal,$Cle)." WHERE date_reservation = '$date_recup' AND id_logement ='$log'  ";
   $requete = mysql_query ($valeur_select);
   while ( $data = mysql_fetch_object($requete) )  {
          $infobulle = utf8_encode(br2nl($data->commentaires)) ;
          print( $infobulle);
     } 
    }
   }

    
}  // fin traitement avec base de données ********************

    //**********************************************************************************
    // fonctionnement sans base de données
    //**********************************************************************************
    else  {
      // recupération fichier du logement *********************
      $index_fichier = "fichier_calendrier/dates_sans_bdd/".$log."_calendrier.php" ;
      if ( file_exists($index_fichier)) {
          require($index_fichier);
          if ( isset($tableau_reservation[$log])) {
            if ( array_key_exists($date_recup,$tableau_reservation[$log])) {
               //recuperation des données pour la date **********
               list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$tableau_reservation[$log][$date_recup]);
               $infobulle = utf8_encode(br2nl($commentaire_temp)) ;
               print( $infobulle);
            }// fin controle date existe dans le fichier ********
            
          } // fin controle si au moins une reservation existe***

      }// fin traitement si fichier du logement existe **********

    }  // fin traitement sans base de données********************

} // fin traitement date format ok ***************************
?>