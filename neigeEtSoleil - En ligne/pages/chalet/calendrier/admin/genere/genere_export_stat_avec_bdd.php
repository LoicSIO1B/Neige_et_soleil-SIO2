<?php
// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_genere.php");

     require("fichier_calendrier/liste_pays.php");

if ( isset($commentaire) && $commentaire == 'oui' )
     require("fichier_calendrier/calendrier_commentaire_locataire.php");

//***************************************************************************************************
// création fichier des locataires ******************************************************************
//***************************************************************************************************

$chemin_fichier = "fichier_calendrier/calendrier_export_stat.csv";

$file = @fopen($chemin_fichier, "w");

         @fputs($file, 'Date début'.$separateur  );
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
         @fputs($file, 'Prénom'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($telephone) && $telephone == 'oui' ) {
         @fputs($file, 'Téléphone'.$separateur  );
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


  $tri_couleur = '';
    $tri_couleur .= "AND (";
     foreach ($liste_couleur as $cle => $val_tab) {
      if ( $tri_couleur <> 'AND (')
        $tri_couleur .= " or ";
      $tri_couleur .= " couleur_texte = '$val_tab' ";
     }
    $tri_couleur .= " )";

  $tri_logement = '';
  if ( $logement <> '' && $logement <> 0)
      $tri_logement = "AND id_logement = '$logement' ";
  $tri_locataire = '';
  if ( $locataire <> '' && $locataire <> 0)
      $tri_locataire = "AND id_locataire = '$locataire' ";

  $date_deb_eng = date_fr_eng($choix_date_debut,"/","-");
  $date_fin_eng = date_fr_eng($choix_date_fin,"/","-");
  $date_calendrier_periode = false ;
  $date_temp_fin = '0000-00-00';

  $connect = @mysql_connect(Decrypte(hote_cal,$Cle), Decrypte(user_cal,$Cle), Decrypte(password_cal,$Cle)); 
  $connect_base = @mysql_select_db(Decrypte(base_cal,$Cle), $connect) ;

  $valeur_select = "SELECT * FROM ".Decrypte(nom_table_cal,$Cle)."  WHERE date_reservation >= '$date_deb_eng' AND date_reservation <= '$date_fin_eng' $tri_logement $tri_locataire $tri_couleur order by id_logement, id_locataire, date_reservation ";

  $req = @mysql_query($valeur_select);
  while($data=mysql_fetch_object($req)) {

         $date_temp = $data->date_reservation;

         if ($format_date_export == "JJ/MM/AAAA" )
             $date_temp = date_eng_fr($date_temp,"-","/");
         if ($format_date_export == "AAAA/MM/JJ" ) {
             $date_temp = date_eng_fr($date_temp,"-","-");
             $date_temp = date_fr_eng($date_temp,"-","/");
         }
         if ($format_date_export == "JJ-MM-AAAA" )
             $date_temp = date_eng_fr($date_temp,"-","-");

    // test si pas calendrier période ou si debut de semaine période
    if ( $format_calendrier_logement[$data->id_logement] <> 'calendrier_periode' || comparaison_date ($data->date_reservation,$date_temp_fin,'inferieur_egale','-','eng') ) {

         // test et calcul date de fin calendrier période **************
         $date_temp_fin = ( $format_calendrier_logement[$data->id_logement]<> 'calendrier_periode') ? '0000-00-00': ajout_jour_date ($data->date_reservation,$periode_location,"JMA","-","eng");
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

         $logement_temp = $nom_logement[$data->id_logement];
         @fputs($file, $logement_temp.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");

         $gain_temp = ( isset($data->tarif) ) ? $data->tarif : 0;
         $gain_temp = ( $format_calendrier_logement[$data->id_logement]<> 'calendrier_periode') ? $gain_temp : $gain_temp * 7;
         @fputs($file, $gain_temp.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");

         $couleur_temp = $data->couleur_texte;
         @fputs($file, $intitule_couleur_reserve[$couleur_temp].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");

      $cle = $data->id_locataire;

      if ( isset($nom) && $nom == 'oui' ) {
         @fputs($file, $nom_locataire[$cle].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($prenom) && $prenom == 'oui' && isset($prenom_locataire[$cle])) {
         @fputs($file, $prenom_locataire[$cle].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($telephone) && $telephone == 'oui' && isset($telephone_locataire[$cle]) ) {
         @fputs($file, $telephone_locataire[$cle].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($email) && $email == 'oui'  && isset($email_locataire[$cle])) {
         @fputs($file, $email_locataire[$cle].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($adresse) && $adresse == 'oui' && isset($adresse_locataire[$cle]) ) {
         @fputs($file, $adresse_locataire[$cle].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($code_postal) && $code_postal && isset($code_locataire[$cle]) == 'oui' ) {
         @fputs($file, $code_locataire[$cle].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($commune) && $commune == 'oui' && isset($commune_locataire[$cle]) ) {
         @fputs($file, $commune_locataire[$cle].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($pays) && $pays == 'oui' && isset($pays_locataire[$cle]) ) {
         $pays_temp = $pays_locataire[$cle];
         @fputs($file, $tableau_pays[$pays_temp].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($mailing) && $mailing == 'oui' && isset($mailing_list_ok[$cle]) ) {
        if ( $mailing_list_ok[$cle])
         @fputs($file, 'oui'.$separateur  );
        else
         @fputs($file, 'non'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($commentaire) && $commentaire == 'oui' && isset($commentaire_locataire[$cle]) ) {
         @fputs($file, suppr_char_spec($commentaire_locataire[$cle]).$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }

       @fputs($file, "\n");

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