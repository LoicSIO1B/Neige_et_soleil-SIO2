<?php

//initialisation de variables************************************************************************
$memoire_num_jour = ajout_supprime_zero ($annee_premier_mois."-".$premier_mois."-01","Ajout","-","eng");

//calcul du mois et année limite en plus du mois en cours*******************************
  $mois_limite_sup  = $hysteresis_plus - (floor($hysteresis_plus / 12 ))*12 + date ("m");
  $annee_limite_sup = date ("Y") + floor($hysteresis_plus / 12 ) ;
  if ( $mois_limite_sup > 12) {
     $mois_limite_inf = $mois_limite_inf - 12;
     $annee_limite_inf++;
  }
//calcul du mois et année limite en moins du mois en cours*******************************
  $annee_limite_inf = date ("Y") - floor($hysteresis_moins / 12 ) ;
  $mois_limite_inf  = date ("m") - ( $hysteresis_moins - (floor($hysteresis_moins / 12 ))*12)  ;
  if ( $mois_limite_inf <= 0) {
     $mois_limite_inf = 12 + $mois_limite_inf;
     $annee_limite_inf--;
  }   

// si nécessaire affichage du sélecteur d'année **************************************************
$annee_selecteur_mois_suiv = $annee_en_cours;
$annee_selecteur_mois_prec = $annee_en_cours;
$mois_plus1 = $mois_en_cours +1;
if ( $mois_plus1 >12) {
     $mois_plus1 = 1;
     $annee_selecteur_mois_suiv++;
}     
$mois_moins1 = $mois_en_cours -1; 
if ( $mois_moins1 < 1) {
     $mois_moins1 = 12;
     $annee_selecteur_mois_prec--;
}

// cellule avec la fleche mois -1 ****************************************************************
if ( $annee_en_cours > $annee_limite_inf ||  $mois_en_cours > $mois_limite_inf )
        $lien_recul = '<a href="'.$adresse_page.'?an='.$annee_selecteur_mois_prec.'&mois='.$mois_moins1.'&locataire='.$_SESSION['sel_tri_locataire'].'&logement='.$_SESSION['sel_tri_logement'].' " class = "selection_1mois" title ="Mois précédent">< </a>';
// cellule avec la fleche mois +1 ****************************************************************
if (  $annee_en_cours < $annee_limite_sup ||  $mois_en_cours < $mois_limite_sup )
        $lien_avance = '<a href="'.$adresse_page.'?an='.$annee_selecteur_mois_suiv.'&mois='.$mois_plus1.'&locataire='.$_SESSION['sel_tri_locataire'].'&logement='.$_SESSION['sel_tri_logement'].'" class = "selection_1mois" title ="Mois suivant"> ></a>';

//affichage des tableaux des mois desirés***********************************************************
for ( $compteur_mois = 1; $compteur_mois <= $nombre_mois_afficher; $compteur_mois++ )
 {
   $compteur_mois_ligne = $compteur_mois_ligne + 1 ;

//nombre de colonne dans un calendrier un mois , dépend si choix avec ou sans numéro de semaine****
$nombre_colonne_calendrier = ( $avec_affichage_numero_semaine ) ? 3 : 2;

//creation du tableau des mois**********************************************************************
echo '<table cellPadding="',$espace_dans_cellule,'" cellSpacing="',$espace_entre_cellule,'" style = "width:',$largeur_tableau,'px;border :',$couleur_bordure_tableau,' ',$bordure_du_tableau,'px solid " align="left">';
//affichage du mois et entete************************************************************************
echo '<tr><td class = "cellule_mois" colspan = "',$nombre_colonne_calendrier,'" >',$lien_recul,'<b>',$mois_texte[$mois_en_cours],' ',$annee_en_cours,'</b>',$lien_avance,'</td></tr>
      <tr>';

if ( $avec_affichage_numero_semaine )
   echo ' <td class = "lettre_jour_num_semaine" ><b>',$texte_label[0],'</b></td>';

echo '    <td class = "lettre_jour_num_semaine" ><b>',$texte_label[3],'</b></td>
          <td class = "lettre_jour_num_semaine_periode" ><b>&nbsp;</b></td></tr>';

//initialisation des calendriers*******************************************************************
$fin_tableau              = false ;
$premier_jour_depasse     = false ; // mémoire à true si le jour de début de semaine paramétré et trouvé pour un nouveau mois
$temp_annee_mois_suivant  = $annee_en_cours ;
$temp_mois_suivant        = $mois_en_cours + 1 ;
if ( $temp_mois_suivant > 12 )  {
    $temp_mois_suivant = 1;
    $temp_annee_mois_suivant++;
    }
$numero_dernier_jour_mois = strftime("%d",mktime ( 6,0,0,$temp_mois_suivant ,0,$temp_annee_mois_suivant)) ;
//variable pour uniformiser la taille des tableau mois en nombre de ligne pour tous les mois *******
$lundi_trouve = false;
$debut_trouve = false ;
$premier_j_mois = false ;
$nombre_periode_max_mois = ceil ( 31 / $periode_location ); // nombre de période maximale par mois, permet d'uniformiser la taille des tableaux de tous les mois
$compteur_ligne_tableau_mois = 0 ;  // compteur de nombre de ligne par mois, pour uniformisation taille des tableaux mois

//creation des tableaux par mois*********************************************************
for ($jour=1; $jour <= $numero_dernier_jour_mois; $jour++) {
   $date_en_cours_fr  = ajout_supprime_zero ($jour."/".$mois_en_cours."/".$annee_en_cours,"Ajout","/","fr") ;
   $date_en_cours_eng = ajout_supprime_zero ($annee_en_cours."-".$mois_en_cours."-".$jour,"Ajout","-","eng") ;
   $numero_jour_semaine = date("w",mktime ( 6,0,0,$mois_en_cours ,$jour,$annee_en_cours)) ; // valeur numérique du numéro de jour (1->lundi,7->dimanche)
   $date_fin_location_jour   = ajout_jour_date ($date_en_cours_eng,$periode_location,"J","-","eng"); //date de fin de la période paramétrée
   //recherche de l'intitulé, tarif pour le jour en cours s'il existe, sinon champs vide
   $intitule_cellule = ( isset($intitule_cellule_bdd[$date_en_cours_eng]) && $intitule_cellule_bdd[$date_en_cours_eng] <> '' ) ? $intitule_cellule_bdd[$date_en_cours_eng] : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
   //recherche si le jour en cours est le premier jour du mois avec le jour de debut de semaine pramétré
   if ( $texte_jour_debut_semaine == $texte_jour_fr[$numero_jour_semaine] && !$debut_trouve ) {
       $debut_trouve = true ;  //premier jour du mois avec debut de semaine trouvé
       $memoire_num_jour = $date_en_cours_eng ; // memoire jour de début de période
       $premier_j_mois = true ;
   }
   $nb_jour_suivant = nb_jour_date ($memoire_num_jour,$date_en_cours_eng,"-","eng") ; // jour de fin de période par rapport au dernier jour de début de période trouvé
   $texte_periode = '&nbsp;';
   $pour_affiche_infobulle = '';

   // controle si le jour ezst marqué***************************************************
   $couleur_disponibilite =  "lettre_num_jour_libre";
   if ( $jour_reserve[$date_en_cours_eng] ) {
       $couleur_disponibilite = $class_reserve_cellule[$date_en_cours_eng] ;
      // contenu a afficher pour la periode ***********************************************
      $index_couleur_periode = $couleur_police_reserve_bdd[$date_en_cours_eng];
      $texte_periode = ( isset($couleur_affiche_tarif[$index_couleur_periode]) && $couleur_affiche_tarif[$index_couleur_periode] ) ? $tarif_reservation[$date_en_cours_eng] : $intitule_couleur_reserve[$index_couleur_periode];
   }

   // controle si date barrée ***********************************************************
   $attribut_strike_debut = '';
   $attribut_strike_fin   = '';
   $difference_date_actuel = nb_jour_date ($date_en_cours_eng,$date_aujourd_hui,"-","eng");
   if ( $difference_date_actuel > 0 && $jour_barre_calendrier_visiteur ) {
      $attribut_strike_debut = '<strike>';
      $attribut_strike_fin   = '</strike>';
   }

   //controle pour infobulle ***************************************************************
   $pour_affiche_infobulle_lien = '';
   $pour_affiche_infobulle_info = '';
   if ( ($avec_lien_autre_page_visiteur || ( $avec_infobulle_visiteur &&  $jour_reserve[$date_en_cours_eng])) && ( $difference_date_actuel <= 0 || !$jour_barre_calendrier_visiteur) ) {

   // renvoie date selon parametres 
   $date_fin_location_lien   	= ajout_jour_date ($date_en_cours_eng,$periode_location,"JMA","-","eng"); //date de fin de la période paramétrée
   $date_envoi_autre_page 		= Str_replace ( "yyyy",$date_fin_location_lien , (Str_replace ( "xxxx",$date_en_cours_eng , stripslashes($lien_autre_page_visiteur))));
   if ( $avec_lien_autre_page_visiteur )
		$pour_affiche_infobulle_lien = '<a '.$date_envoi_autre_page.' class = "date" >';
   else
		$pour_affiche_infobulle_lien = '<a href="#" class ="date">';
   $pour_affiche_infobulle_info = '<em><span></span>'.$contenu_infobulle[$date_en_cours_eng].'</em></a>';
   }

   if ( ($debut_trouve && $nb_jour_suivant == $periode_location) || ( $premier_j_mois && $debut_trouve ) )  {
      $num_semaine = cherche_num_semaine ($date_en_cours_eng,"avant","-","eng") ;
      echo '<tr>';
      if ( $avec_affichage_numero_semaine )
          echo  '<td class = "chiffre_num_semaine" nowrap>',$attribut_strike_debut,'',$pour_affiche_infobulle_lien,'',$num_semaine,'',$pour_affiche_infobulle_info,'',$attribut_strike_fin,'</td> ';
      echo '     <td class = "lettre_num_jour_libre" nowrap>',$attribut_strike_debut,'',$pour_affiche_infobulle_lien,'',$texte_label[1],' ',$jour,' ',$texte_label[2],' ',$date_fin_location_jour,'',$pour_affiche_infobulle_info,'',$attribut_strike_fin,'</td>
                 <td class = "',$couleur_disponibilite,'" nowrap>',$attribut_strike_debut,'',$texte_periode,'',$attribut_strike_fin,'</td></tr>';
      $memoire_num_jour = $date_en_cours_eng;   //mémorisation jour de début période
      $compteur_ligne_tableau_mois++;
   }
   $premier_j_mois = false ;

}
   // uniformisation du nombre de ligne par mois *********************************
   if ( $compteur_ligne_tableau_mois < $nombre_periode_max_mois) {
         echo '<tr>';
         if ( $avec_affichage_numero_semaine )
           echo '<td class = "chiffre_num_semaine" >&nbsp;</td>';
         echo   '<td class = "lettre_num_jour_libre" >&nbsp;</td>
                 <td class = "lettre_num_jour_libre" >&nbsp;</td></tr>';
   }
//fin de la table du mois
echo '</table></td><td>';

//incrementation du mois et annee en cours********************************************************
$mois_en_cours = $mois_en_cours + 1;
if ( $mois_en_cours > 12 )
    {
     $mois_en_cours = 1;
     $annee_en_cours = $annee_en_cours + 1 ;
    }
 if ( $compteur_mois_ligne > $nombre_mois_afficher_ligne )
    {
     echo '</tr></td><tr><td nowrap>';
     $compteur_mois_ligne = 1;
    }
 }
//fin de paragraphe du tableau*********************************************************************
echo '</td>
      </tr>
      </table>';

//affichage date mise à jour **********************************************************************
echo '<table>';
if ( $avec_date_mise_jour_calendrier )
  echo '<tr><td><font style="font-size:10px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >',$texte_label[4],' ',$date_maj_calendrier[$langue],'</font></td></tr>';

echo '<tr><td></td></tr>
      </table>';


 if ( $avec_compression_page )
    ob_end_flush();

?>

</body>

</html>

