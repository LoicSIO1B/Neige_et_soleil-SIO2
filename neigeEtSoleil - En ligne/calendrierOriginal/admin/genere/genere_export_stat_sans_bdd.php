<?php
// chemin vers le fichier  config.inc.php param�trews de connection � la base de donn�es*************
     require("secure_genere.php");

     require("fichier_calendrier/liste_pays.php");

if ( isset($commentaire) && $commentaire == 'oui' )
     require("fichier_calendrier/calendrier_commentaire_locataire.php");

//***************************************************************************************************
// cr�ation fichier des locataires ******************************************************************
//***************************************************************************************************

$chemin_fichier = "fichier_calendrier/calendrier_export_stat.csv";

$file= @fopen($chemin_fichier, "w");

         @fputs($file, 'Date d�but'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
         
         @fputs($file, 'Date fin'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");

         @fputs($file, 'Logement'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");

         @fputs($file, 'Gain'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");

         @fputs($file, 'Couleur'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");

      if ( isset($nom) && $nom == 'oui' ) {
         @fputs($file, 'Nom'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($prenom) && $prenom == 'oui' ) {
         @fputs($file, 'Pr�nom'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($telephone) && $telephone == 'oui' ) {
         @fputs($file, 'T�l�phone'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($email) && $email == 'oui' ) {
         @fputs($file, 'Email'.$separateur);
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($adresse) && $adresse == 'oui' ) {
         @fputs($file, 'Adresse'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($code_postal) && $code_postal == 'oui' ) {
         @fputs($file, 'Code postal'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($commune) && $commune == 'oui' ) {
         @fputs($file, 'Commune'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($pays) && $pays == 'oui' ) {
         @fputs($file, 'Pays'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($mailing) && $mailing == 'oui' ) {
         @fputs($file, 'Inscription liste email'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($commentaire) && $commentaire == 'oui' ) {
         @fputs($file, 'Commentaire'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }

       @fputs($file, "\n");

//**************************************************************************************
//filtre des reservations 
//**************************************************************************************

  $date_deb_eng = ajout_supprime_zero (date_fr_eng($choix_date_debut,"/","-"),"Ajout","-","eng");
  $date_fin_eng = ajout_supprime_zero (date_fr_eng($choix_date_fin,"/","-"),"Ajout","-","eng");

//**************************************************************************************
// r�cup�ration des tableaux dates pour le ou les logements d�sir�es********************
//**************************************************************************************

     unset($tableau_requete_logement);  // initialisation du tableau des logements a marqu�s***
     unset($tableau_reservation_tri_date);  // initialisation du tableau des r�servations tri� par date***

     if ( $logement == 0 ) { //  toutes les locations
          $tableau_requete_logement = $nom_logement ;   // tableau des locations = toutes les locations
          unset($tableau_requete_logement[0]); // suppression index logement tous ******
          }
     else
          $tableau_requete_logement[$logement] = $nom_logement[$logement];  // tableau des locations = toutes les locations

     unset($tableau_reservation); // r�initialisation des variables tableau ************

     foreach ( $tableau_requete_logement as $cle => $nom_logement_requete ) {

     //recup�ration des dates pour le logement en cours de traitement *********
     include("fichier_calendrier/dates_sans_bdd/".$cle."_calendrier.php");

     //************************************************************************
     // tri des donn�es locataires, couleur date ******************************
     //************************************************************************

     unset($tableau_temp);  // initialisation du tableau temp pour tri� par date***

     if ( isset($tableau_reservation[$cle]) ) {
       foreach ($tableau_reservation[$cle] as $date_index => $val_reservation ) {
    
        $memoire_logement_en_traitement = $cle;

        //extraction des donn�es des lignes de r�servation *****************
        list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$val_reservation);

        //si locataire diff�rent de recherche alors on supprime la ligne****
        $efface_locataire = ( $locataire <> 0 && $tri_locataire_temp <> $locataire ) ? true : false;
        
        //si couleur diff�rent de recherche alors on supprime la ligne****
        $efface_couleur   = ( !in_array($couleur_texte_temp, $liste_couleur) ) ? true : false;
        
        //si date diff�rent de recherche alors on supprime la ligne****
        $efface_date      = ( comparaison_date ($date_deb_eng,$date_index,"inferieur","-","eng") || comparaison_date ($date_fin_eng,$date_index,"superieur","-","eng") ) ? true : false;

        //suppression des dates ne correspondant pas a la recherche****
        if( $efface_locataire || $efface_couleur || $efface_date )
           unset ($tableau_reservation[$cle][$date_index]);
        // on transfert la reservation dans un tableau reindex� avec le timestamp au lieu de la date
        else {
           list($annee_poub,$mois_poub,$jour_poub) =explode ("-",$date_index);
           $date_numerique = mktime(6,0,0,$mois_poub,$jour_poub,$annee_poub);
           $tableau_temp[$date_numerique]= $val_reservation ;
           }
       } // fin traitement tableau pour le logement en cours *************

       //tri des dates ***************************************************
       ksort($tableau_temp,SORT_NUMERIC);
       //recreation des cle format date **********************************
       foreach ($tableau_temp as $date_numerique => $val_reservation ) {
          $date_index = ajout_supprime_zero (date("Y-m-d", $date_numerique),"Ajout","-","eng");
          $tableau_reservation_tri_date[$memoire_logement_en_traitement][$date_index] = $val_reservation;
       }

      } //fin test existance du tableau logement *************************

     }  // fin liste des logements a traiter *********************************

//creation du listing ******************************************************************

  $date_calendrier_periode = false ;
  $date_temp_fin = '0000-00-00';

 foreach ( $tableau_requete_logement as $cle => $nom_logement_requete ) {

 foreach ($tableau_reservation_tri_date[$cle] as $date_index => $val_reservation ) {

 list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$val_reservation);

         $date_temp = $date_index;
         if ($format_date_export == "JJ/MM/AAAA" )
             $date_temp = date_eng_fr($date_temp,"-","/");
         if ($format_date_export == "AAAA/MM/JJ" ) {
             $date_temp = date_eng_fr($date_temp,"-","-");
             $date_temp = date_fr_eng($date_temp,"-","/");
         }
         if ($format_date_export == "JJ-MM-AAAA" )
             $date_temp = date_eng_fr($date_temp,"-","-");


    // test si pas calendrier p�riode ou si debut de semaine p�riode
    if ( $format_calendrier_logement[$cle] <> 'calendrier_periode' || comparaison_date ($date_index,$date_temp_fin,'inferieur_egale','-','eng') ) {

         // test et calcul date de fin calendrier p�riode **************
         $date_temp_fin = ( $format_calendrier_logement[$cle]<> 'calendrier_periode') ? '0000-00-00': ajout_jour_date ($date_index,$periode_location,"JMA","-","eng");
         if ($format_date_export == "JJ/MM/AAAA" && $date_temp_fin <> '0000-00-00')
             $date_temp_fin2 = date_eng_fr($date_temp_fin,"-","/");
         if ($format_date_export == "AAAA/MM/JJ" && $date_temp_fin <> '0000-00-00' ) {
             $date_temp_fin2 = date_eng_fr($date_temp_fin,"-","-");
             $date_temp_fin2 = date_fr_eng($date_temp_fin2,"-","/");
         }
         if ($date_temp_fin == "JJ-MM-AAAA" && $date_temp_fin <> '0000-00-00' )
             $date_temp_fin2 = date_eng_fr($date_temp_fin,"-","-");


         @fputs($file, $date_temp.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");

         @fputs($file, $date_temp_fin2.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");

         $logement_temp = $nom_logement[$cle];
         @fputs($file, $logement_temp.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");

         $gain_temp = ( isset($tarif_temp) ) ? $tarif_temp : 0;;
         $gain_temp = ( $format_calendrier_logement[$cle]<> 'calendrier_periode') ? $gain_temp : $gain_temp * 7;
         @fputs($file, $gain_temp.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");

         $couleur_temp = $couleur_texte_temp;
         @fputs($file, $intitule_couleur_reserve[$couleur_temp].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");

      $id = $tri_locataire_temp;

      if ( isset($nom) && $nom == 'oui' ) {
         @fputs($file, $nom_locataire[$id].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($prenom) && $prenom == 'oui' && isset($prenom_locataire[$id])) {
         @fputs($file, $prenom_locataire[$id].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($telephone) && $telephone == 'oui' && isset($telephone_locataire[$id]) ) {
         @fputs($file, $telephone_locataire[$id].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($email) && $email == 'oui'  && isset($email_locataire[$id])) {
         @fputs($file, $email_locataire[$id].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($adresse) && $adresse == 'oui' && isset($adresse_locataire[$id]) ) {
         @fputs($file, $adresse_locataire[$id].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($code_postal) && $code_postal && isset($code_locataire[$id]) == 'oui' ) {
         @fputs($file, $code_locataire[$id].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($commune) && $commune == 'oui' && isset($commune_locataire[$id]) ) {
         @fputs($file, $commune_locataire[$id].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($pays) && $pays == 'oui' && isset($pays_locataire[$id]) ) {
         $pays_temp = $pays_locataire[$id];
         @fputs($file, $tableau_pays[$pays_temp].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($mailing) && $mailing == 'oui' && isset($mailing_list_ok[$id]) ) {
        if ( $mailing_list_ok[$id])
         @fputs($file, 'oui'.$separateur  );
        else
         @fputs($file, 'non'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($commentaire) && $commentaire == 'oui' && isset($commentaire_locataire[$id]) ) {
         @fputs($file, suppr_char_spec($commentaire_locataire[$id]).$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }

       @fputs($file, "\n");
       }
    }
 }


 @fputs($file, "\n");


//fermeture du fichier
$creation_reussi = @fclose($file);

if ( $creation_reussi )
    telecharge ("calendrier_export_stat.csv","fichier_calendrier/");
else
   $affiche_info = "erreur_execution";      
 


?>