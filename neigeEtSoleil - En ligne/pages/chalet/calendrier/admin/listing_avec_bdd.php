<?php
//***************************************************************************************
// listing des dates en mode avec base de données
//***************************************************************************************

// filtres ******************************************************************************

  $tri_couleur = '';
    $tri_couleur .= "AND (";
     foreach ($liste_couleur as $cle => $val_tab) {
      if ( $tri_couleur <> 'AND (')
        $tri_couleur .= " or ";
      $tri_couleur .= " couleur_texte = '$val_tab' ";
     }
    $tri_couleur .= " )";

  $tri_logement = '';
  if ( $choix_selection_logement <> '' && $choix_selection_logement <> 0)
      $tri_logement = "AND id_logement = '$choix_selection_logement' ";
  $tri_locataire = '';
  if ( $choix_selection_locataire <> '' && $choix_selection_locataire <> 0)
      $tri_locataire = "AND id_locataire = '$choix_selection_locataire' ";

// date intervalle de recherche ********************************************************

  $date_deb_eng = date_fr_eng($choix_date_debut,"/","-");
  $date_fin_eng = date_fr_eng($choix_date_fin,"/","-");

// connexion a la base de données ******************************************************

  $connect = @mysql_connect(Decrypte(hote_cal,$Cle), Decrypte(user_cal,$Cle), Decrypte(password_cal,$Cle));
  $connect_base = @mysql_select_db(Decrypte(base_cal,$Cle), $connect) ;

  $valeur_select = "SELECT * FROM ".Decrypte(nom_table_cal,$Cle)."  WHERE date_reservation >= '$date_deb_eng' AND date_reservation <= '$date_fin_eng' $tri_logement $tri_locataire $tri_couleur order by id_logement, id_locataire, date_reservation ";

//initialisation de variables **********************************************************

$memoire_logmement = '';
$memoire_annee = '';
$memoire_logement ='';
$date_temp_fin     = '00/00/0000';
$date_temp_fin_eng = '0000-00-00';

//creation du listing ******************************************************************

  $req = @mysql_query($valeur_select);
  while($data=mysql_fetch_object($req)) {

 $annee_en_cours = explode("-",$data->date_reservation);
 $valeur_logement = $data->id_logement;
 $gain_logement = $data->tarif;

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

if ( $memoire_logement <> $nom_logement[$data->id_logement] && isset($listing_complet) && $listing_complet == 'on' )
  echo '<tr>
<td align="center" valign="center" bgcolor = "#C0E37B" ><font color="#FFFFFF" style="font-size:14px" face="Arial">',$nom_logement[$data->id_logement],'</font></td>
<td align="left" valign="center" bgcolor = "#FFFFFF" colspan = "4"></td>
<tr>';

 if ( isset($listing_complet) && $listing_complet == 'on') {

    if ( $format_calendrier_logement[$data->id_logement] <> 'calendrier_periode' || comparaison_date ($data->date_reservation,$date_temp_fin_eng,'inferieur_egale','-','eng') ) {
      // test et calcul date de fin calendrier période **************
      $date_temp_fin     = ( $format_calendrier_logement[$data->id_logement] <> 'calendrier_periode') ? '31/12/1990': date_eng_fr(ajout_jour_date ($data->date_reservation,$periode_location,"JMA","-","eng"),"-","/");
      $date_temp_fin_eng = ( $format_calendrier_logement[$data->id_logement] <> 'calendrier_periode') ? '1990-12-31': ajout_jour_date ($data->date_reservation,$periode_location,"JMA","-","eng");

      list($temp_jour,$temp_mois,$temp_annee)  = explode("/",$date_temp_fin);
      $nom_jour_fin  = date("w", mktime(6, 0, 0, $temp_mois, $temp_jour, $temp_annee));
      $affiche_date_temp_fin = $texte_jour_fr[$nom_jour_fin]." ".$date_temp_fin;

      $date_debut_listing_temp = date_eng_fr($data->date_reservation,"-","/");
      list($temp_jour,$temp_mois,$temp_annee)  = explode("/",$date_debut_listing_temp);
      $nom_jour_debut= date("w", mktime(6, 0, 0, $temp_mois, $temp_jour, $temp_annee));
      $affiche_date_debut_listing_temp = $texte_jour_fr[$nom_jour_debut]." ".$date_debut_listing_temp;

      $affiche_date_debut_listing = ( $format_calendrier_logement[$data->id_logement] <> 'calendrier_periode') ? $affiche_date_debut_listing_temp : $affiche_date_debut_listing_temp." au ".$affiche_date_temp_fin;

      $gain_logement_listing = ( $format_calendrier_logement[$data->id_logement] <> 'calendrier_periode') ? $gain_logement : $gain_logement * 7 ;

      $contenu_locataire  = stripslashes($nom_locataire[$data->id_locataire])." ".stripslashes($prenom_locataire[$data->id_locataire]);
      if ( isset($listing_complet) && $locataire_complet == "on" ) {
        if ( $adresse_locataire[$data->id_locataire] <> '' )
           $contenu_locataire .= "<br>".stripslashes($adresse_locataire[$data->id_locataire]);
        if ( $adresse_locataire[$data->id_locataire] <> '' ||  $commune_locataire[$data->id_locataire] <> '' )
           $contenu_locataire .= "<br>".stripslashes($code_locataire[$data->id_locataire])." ".stripslashes($commune_locataire[$data->id_locataire]);
        if ( $telephone_locataire[$data->id_locataire] <> '' ||  $email_locataire[$data->id_locataire] <> '' )
           $contenu_locataire .= "<br>".stripslashes($telephone_locataire[$data->id_locataire])." ".stripslashes($email_locataire[$data->id_locataire]);
      }

//affichage des dates********************************
      echo '<tr>
            <td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',stripslashes($nom_logement[$data->id_logement]),'</font></td>
            <td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',stripslashes($intitule_couleur_reserve[$data->couleur_texte]),'</font></td>
            <td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',$contenu_locataire,'</font></td>  ';
      if ( $avec_infobulle == 'on' )
            echo '<td align="center" valign="center" bgcolor="',$couleur_tab,'" ><font color="#000000" style="font-size:14px" face="Arial"><B>',stripslashes($data->commentaires),'</B></font></td>';
      echo '<td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',$affiche_date_debut_listing,'</font></td>
            <td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',$gain_logement_listing,' €</font></td><tr>';
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


if ( $compteur_date <> 0) {
 $taux_remplissage = $compteur_jour * 100 / 365;
 if ( isset($listing_complet) && $listing_complet == 'on' )
      echo '</table>';

  echo '<br><table width="100%" border="0" cellpadding="2" cellspacing="1" id="Table1">
<tr>
<td align="center" valign="center" bgcolor="#B9CBDD" height="40" width ="250"><font color="#000000" style="font-size:14px" face="Arial"><B>Bilan ',$memoire_annee,'  </B></font></td>
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