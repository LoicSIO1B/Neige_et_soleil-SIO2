<?php
//***************************************************************************************
// listing des dates en mode avec base de données
//***************************************************************************************

// date intervalle de recherche ********************************************************

  $date_deb_eng = ajout_supprime_zero (date_fr_eng($choix_date_debut,"/","-"),"Ajout","-","eng");
  $date_fin_eng = ajout_supprime_zero (date_fr_eng($choix_date_fin,"/","-"),"Ajout","-","eng");

//**************************************************************************************
// récupération des tableaux dates pour le ou les logements désirées********************
//**************************************************************************************

     unset($tableau_requete_logement);  // initialisation du tableau des logements a marqués***
     unset($tableau_reservation_tri_date);  // initialisation du tableau des réservations trié par date***

     if ( $choix_selection_logement == 0 ) { //  toutes les locations
          $tableau_requete_logement = $nom_logement ;   // tableau des locations = toutes les locations
          unset($tableau_requete_logement[0]); // suppression index logement tous ******
          }
     else
          $tableau_requete_logement[$choix_selection_logement] = $nom_logement[$choix_selection_logement];  // tableau des locations = toutes les locations

     unset($tableau_reservation); // réinitialisation des variables tableau ************

     foreach ( $tableau_requete_logement as $cle => $nom_logement_requete ) {

     //recupération des dates pour le logement en cours de traitement *********
     include("fichier_calendrier/dates_sans_bdd/".$cle."_calendrier.php");

     //************************************************************************
     // tri des données locataires, couleur date ******************************
     //************************************************************************

     unset($tableau_temp);  // initialisation du tableau temp pour trié par date***

     if ( isset($tableau_reservation[$cle]) ) {
       foreach ($tableau_reservation[$cle] as $date_index => $val_reservation ) {
    
        $memoire_logement_en_traitement = $cle;

        //extraction des données des lignes de réservation *****************
        list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$val_reservation);
        
        //si locataire différent de recherche alors on supprime la ligne****
        $efface_locataire = ( $choix_selection_locataire <> 0 && $tri_locataire_temp <> $choix_selection_locataire ) ? true : false;
        
        //si couleur différent de recherche alors on supprime la ligne****
        $efface_couleur   = ( !in_array($couleur_texte_temp, $liste_couleur) ) ? true : false;
        
        //si date différent de recherche alors on supprime la ligne****
        $efface_date      = ( comparaison_date ($date_deb_eng,$date_index,"inferieur","-","eng") || comparaison_date ($date_fin_eng,$date_index,"superieur","-","eng") ) ? true : false;

        //suppression des dates ne correspondant pas a la recherche****
        if( $efface_locataire || $efface_couleur || $efface_date )
           unset ($tableau_reservation[$cle][$date_index]);
        // on transfert la reservation dans un tableau reindexé avec le timestamp au lieu de la date
        else {
           list($annee_poub,$mois_poub,$jour_poub) =explode ("-",$date_index);
           $date_numerique = mktime(6,0,0,$mois_poub,$jour_poub,$annee_poub);
           $tableau_temp[$date_numerique]= $val_reservation ;
           }
       } // fin traitement tableau pour le logement en cours *************

       if ( isset($tableau_temp)) {
       //tri des dates ***************************************************
       ksort($tableau_temp,SORT_NUMERIC);
       //recreation des cle format date **********************************
       foreach ($tableau_temp as $date_numerique => $val_reservation ) {
          $date_index = ajout_supprime_zero (date("Y-m-d", $date_numerique),"Ajout","-","eng");
          $tableau_reservation_tri_date[$memoire_logement_en_traitement][$date_index] = $val_reservation;
       } // fin foreach ********
       
       }// fin test si tableau_temp existe *******

      } //fin test existance du tableau logement *************************

     }  // fin liste des logements a traiter *********************************

//initialisation de variables **********************************************************

$memoire_logmement = '';
$memoire_annee = '';
$memoire_logement ='';
$date_temp_fin     = '00/00/0000';
$date_temp_fin_eng = '0000-00-00';

//creation du listing ******************************************************************

 foreach ( $tableau_requete_logement as $cle => $nom_logement_requete ) {

 if ( isset($tableau_reservation_tri_date[$cle]) )  {

 foreach ($tableau_reservation_tri_date[$cle] as $date_index => $val_reservation ) {

 list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$val_reservation);

 $annee_en_cours = explode("-",$date_index);
 $valeur_logement = $cle;
 $gain_logement = $tarif_temp;

 if ( $memoire_annee <> $annee_en_cours[0] && !$premiere_ligne) {
  $taux_remplissage = $compteur_jour * 100 / 365;
 if ( $listing_complet)
      echo '</table>';

  echo '<br><table width="100%" border="0" cellpadding="2" cellspacing="1" id="Table1">
<tr>
<td align="center" valign="center" bgcolor="#B9CBDD" height="40" width ="250"><font color="#000000" style="font-size:14px" face="Arial"><B>Bilan ',$memoire_annee,' </B></font></td>
<td align="center" valign="center" bgcolor="#B9CBDD" height="40" width ="200"><font color="#000000" style="font-size:14px" face="Arial"><B>Nombre de jours : ',$compteur_jour,' </B></font></td>
<td align="center" valign="center" bgcolor="#B9CBDD" height="40" width ="200" ><font color="#000000" style="font-size:14px" face="Arial"><B>Taux de remplissage : ',round($taux_remplissage,2),' %</B></font></td>
<td align="center" valign="center" bgcolor="#B9CBDD" height="40" width ="200" ><font color="#000000" style="font-size:14px" face="Arial"><B>Chiffre d\'affaire : ',$compteur_gain,' €</B></font></td>
</tr>
</table>';
  $compteur_jour = 0;
  $compteur_gain = 0;
  $memoire_logmement = '';
 }

 if ( $memoire_annee <> $annee_en_cours[0] &&  isset($listing_complet) &&  $listing_complet == 'on' ) {
  echo '<br><table width="100%" border="0" cellpadding="2" cellspacing="1" id="Table1">
<tr>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:14px" face="Arial"><B>Nom ',$item1,'</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:14px" face="Arial"><B>Couleur</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:14px" face="Arial"><B>Nom Locataire</B></font></td>';
 if ( $avec_infobulle == 'on' )
    echo '<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:14px" face="Arial"><B>Info</B></font></td>';
echo '<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:14px" face="Arial"><B>Date</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:14px" face="Arial"><B>Chiffre d\'affaire</B></font></td>
</tr>';

 }

 if ( $memoire_annee <> $annee_en_cours[0] && ( !isset($listing_complet) ||  $listing_complet <> 'on' )) 
  echo '<table width="100%" border="0" cellpadding="2" cellspacing="1" id="Table1">';

if ( $memoire_logement <> $nom_logement[$cle] && isset($listing_complet) && $listing_complet == 'on' )
  echo '<tr>
<td align="center" valign="center" bgcolor = "#C0E37B" ><font color="#FFFFFF" style="font-size:14px" face="Arial">',$nom_logement[$cle],'</font></td>
<td align="left" valign="center" bgcolor = "#FFFFFF" colspan = "4"></td>
<tr>';

 if ( isset($listing_complet) && $listing_complet == 'on')   {

    if ( $format_calendrier_logement[$cle] <> 'calendrier_periode' || comparaison_date ($date_index,$date_temp_fin_eng,'inferieur_egale','-','eng') ) {

      // test et calcul date de fin calendrier période **************
      $date_temp_fin     = ( $format_calendrier_logement[$cle] <> 'calendrier_periode') ? '31/12/1990': date_eng_fr(ajout_jour_date ($date_index,$periode_location,"JMA","-","eng"),"-","/");
      $date_temp_fin_eng = ( $format_calendrier_logement[$cle] <> 'calendrier_periode') ? '1990-12-31': ajout_jour_date ($date_index,$periode_location,"JMA","-","eng");

      list($temp_jour,$temp_mois,$temp_annee)  = explode("/",$date_temp_fin);
      $nom_jour_fin  = date("w", mktime(6, 0, 0, $temp_mois, $temp_jour, $temp_annee));
      $affiche_date_temp_fin = $texte_jour_fr[$nom_jour_fin]." ".$date_temp_fin;

      $date_debut_listing_temp = date_eng_fr($date_index,"-","/");
      list($temp_jour,$temp_mois,$temp_annee)  = explode("/",$date_debut_listing_temp);
      $nom_jour_debut= date("w", mktime(6, 0, 0, $temp_mois, $temp_jour, $temp_annee));
      $affiche_date_debut_listing_temp = $texte_jour_fr[$nom_jour_debut]." ".$date_debut_listing_temp;

      $affiche_date_debut_listing = ( $format_calendrier_logement[$cle] <> 'calendrier_periode') ? $affiche_date_debut_listing_temp : $affiche_date_debut_listing_temp." au ".$affiche_date_temp_fin;

      $gain_logement_listing = ( $format_calendrier_logement[$cle] <> 'calendrier_periode') ? $gain_logement : $gain_logement * 7 ;

      $contenu_locataire  = stripslashes($nom_locataire[$tri_locataire_temp])." ".stripslashes($prenom_locataire[$tri_locataire_temp]);
      if ( isset($listing_complet) && $locataire_complet == "on" ) {
        if ( $adresse_locataire[$tri_locataire_temp] <> '' )
           $contenu_locataire .= "<br>".stripslashes($adresse_locataire[$tri_locataire_temp]);
        if ( $adresse_locataire[$tri_locataire_temp] <> '' ||  $commune_locataire[$tri_locataire_temp] <> '' )
           $contenu_locataire .= "<br>".stripslashes($code_locataire[$tri_locataire_temp])." ".stripslashes($commune_locataire[$tri_locataire_temp]);
        if ( $telephone_locataire[$tri_locataire_temp] <> '' ||  $email_locataire[$tri_locataire_temp] <> '' )
           $contenu_locataire .= "<br>".stripslashes($telephone_locataire[$tri_locataire_temp])." ".stripslashes($email_locataire[$tri_locataire_temp]);
      }

      //affichage des dates********************************
      echo '<tr>
            <td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',stripslashes($nom_logement[$cle]),'</font></td>
            <td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',stripslashes($intitule_couleur_reserve[$couleur_texte_temp]),'</font></td>
            <td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',$contenu_locataire,'</font></td>';
       if ( $avec_infobulle == 'on' )
            echo '<td align="center" valign="center" bgcolor="',$couleur_tab,'" ><font color="#000000" style="font-size:14px" face="Arial"><B>',stripslashes($commentaire_temp),'</B></font></td>';
      echo '<td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',$affiche_date_debut_listing,'</font></td>
            <td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',$gain_logement_listing,' €</font></td>
            <tr>';
           }
     }

  $premiere_ligne = false;
  $compteur_jour++;
  $compteur_gain = $compteur_gain + $gain_logement;
  $compteur_gain_total = $compteur_gain_total + $gain_logement;
  $compteur_date++;
  $memoire_logement = $nom_logement[$valeur_logement];
  $memoire_annee =  $annee_en_cours[0];

 }
 }
}  

if ( $compteur_date <> 0) {
 $taux_remplissage = $compteur_jour * 100 / 365;
 if ( isset($listing_complet) && $listing_complet == 'on' )
      echo '</table>';

  echo '<br><table width="100%" border="0" cellpadding="2" cellspacing="1" id="Table1">
<tr>
<td align="center" valign="center" bgcolor="#B9CBDD" height="40" width ="250"><font color="#000000" style="font-size:14px" face="Arial"><B>Bilan ',$memoire_annee,' </B></font></td>
<td align="center" valign="center" bgcolor="#B9CBDD" height="40" width ="200"><font color="#000000" style="font-size:14px" face="Arial"><B>Nombre de jours : ',$compteur_jour,'</B></font></td>
<td align="center" valign="center" bgcolor="#B9CBDD" height="40" width ="200"><font color="#000000" style="font-size:14px" face="Arial"><B>Taux de remplissage :',round($taux_remplissage,2),' %</B></font></td>
<td align="center" valign="center" bgcolor="#B9CBDD" height="40" width ="200" ><font color="#000000" style="font-size:14px" face="Arial"><B>Chiffre d\'affaire : ',$compteur_gain,' €</B></font></td>
</tr>
</table>';
  $compteur_jour = 0;

echo '<br><table width="100%" border="0" cellpadding="2" cellspacing="1" id="Table1">
<tr>
<td align="center" valign="center" bgcolor="#C0E37B" height="40"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Nombre total de jours  : ',$compteur_date,' <br>Chiffre d\'affaire total : ',$compteur_gain_total,' € <br>Chiffre d\'affaire par jour : ',round($compteur_gain_total/$compteur_date,2),' € / jour</B></font></td>
</tr>
</table>';

}
else
echo '<font color="#000000" style="font-size:14px" face="Arial"><B>Il n\'existe aucune date selon vos critères!</B></font>';
?>