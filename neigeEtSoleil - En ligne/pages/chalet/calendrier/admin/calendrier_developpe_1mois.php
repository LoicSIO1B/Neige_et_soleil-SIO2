<?php

//nombre de colonne dans un calendrier un mois , dépend si choix avec ou sans numéro de semaine****
$nombre_colonne_calendrier = ( $avec_affichage_numero_semaine ) ? 4 : 3;

//affichage des tableaux des mois desirés***********************************************************
for ( $compteur_mois = 1; $compteur_mois <= $nombre_mois_afficher; $compteur_mois++ )
 {
   $compteur_mois_ligne = $compteur_mois_ligne + 1 ;

//creation du tableau des mois**********************************************************************
echo '<table cellPadding="',$espace_dans_cellule,'" cellSpacing="',$espace_entre_cellule,'" style = "width:',$largeur_tableau,'px;border :',$couleur_bordure_tableau,' ',$bordure_du_tableau,'px solid " align="left">';
//affichage du mois et année ***********************************************************************

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
echo '<tr><td class = "cellule_mois" colspan = "8"  height="',$hauteur_mini_cellule_date,'" ><b>';
   if ( $annee_en_cours > $annee_limite_inf ||  $mois_en_cours > $mois_limite_inf )
        echo '<a href="',$adresse_page,'?an=',$annee_selecteur_mois_prec,'&mois=',$mois_moins1,'&locataire='.$_SESSION['sel_tri_locataire'].'&logement='.$_SESSION['sel_tri_logement'].' " class = "selection_1mois" title ="Mois précédent"><font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >&nbsp;< </a></font>';
echo $mois_texte[$mois_en_cours],' ',$annee_en_cours;
   if ( $annee_en_cours < $annee_limite_sup ||  $mois_en_cours < $mois_limite_sup )
        echo '<a href="',$adresse_page,'?an=',$annee_selecteur_mois_suiv,'&mois=',$mois_plus1,'&locataire='.$_SESSION['sel_tri_locataire'].'&logement='.$_SESSION['sel_tri_logement'].'" class = "selection_1mois" title ="Mois suivant"><font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >&nbsp;> </a></font>';
echo '</b></td></tr>';

//initialisation des calendriers*******************************************************************
$fin_tableau              = false ;
$premier_jour_depasse     = false ;
$temp_annee_mois_suivant  = $annee_en_cours ;
$temp_mois_suivant        = $mois_en_cours + 1 ;
if ( $temp_mois_suivant > 12 )  {
    $temp_mois_suivant = 1;
    $temp_annee_mois_suivant++;
    }
$numero_dernier_jour_mois = strftime("%d",mktime ( 6,0,0,$temp_mois_suivant ,0,$temp_annee_mois_suivant)) ;
$compteur_jour            = 1 ;
//variable pour uniformiser la taille des tableau mois en nombre de ligne pour tous les mois *******
$compteur_ligne           = 0 ;
$premier_jour_frame = "1/".$premier_mois."/".$annee_premier_mois;

while ( !($fin_tableau) )
      {
        echo '<tr>';
        $compteur_ligne++;
        //creation des cases par semaine************************************************************
              $couleur_disponibilite = "lettre_num_jour_libre" ;
              if ( $compteur_jour <= $numero_dernier_jour_mois )
                  {
                   $date_en_cours_fr  = ajout_supprime_zero ($compteur_jour."/".$mois_en_cours."/".$annee_en_cours,"Ajout","/","fr") ;
                   $date_en_cours_eng = ajout_supprime_zero ($annee_en_cours."-".$mois_en_cours."-".$compteur_jour,"Ajout","-","eng") ;
                   
                    //index numero du jour de la semaine en cours **************
                    $index_num_jour_semaine = date("w",mktime ( 6,0,0,$mois_en_cours ,$compteur_jour,$annee_en_cours));
                    if ( $index_num_jour_semaine == 6 || $index_num_jour_semaine == 7 || $index_num_jour_semaine == 0 )
                        $couleur_disponibilite = "lettre_num_jour_libre_week_end" ;
                    // test si le jour affiché correspond au jour d'aujourd'hui *******************
                    if ( $avec_marquage_du_jour_d_aujourd_hui ) {
                        if ( $date_aujourd_hui ==  $date_en_cours_eng )
                            $couleur_disponibilite = "lettre_num_jour_aujourdhui" ;
                        }
                    //test si jour est reservé******************************************************
                    $index_couleur_texte_police_jour_reserve = $couleur_police_reserve_bdd[$date_en_cours_eng] ;
                    if ( $jour_reserve[$date_en_cours_eng] )  {
                        $coul_police_jour = $couleur_texte_jour_reserve[$index_couleur_texte_police_jour_reserve] ;
                        $couleur_disponibilite = $class_reserve_cellule[$date_en_cours_eng];
                        $class_date_lien = $couleur_police_reserve_bdd[$date_en_cours_eng] ;
                        }
                    else  {
                       $coul_police_jour = $couleur_police_jour ;
                       $class_date_lien = '' ;
                       }
                    $difference_date_actuel = round (( mktime(0,0,0,date ("m"),date ("d"),date ("Y")) - mktime(0,0,0,$mois_en_cours,$compteur_jour,$annee_en_cours) ) / $jour_en_seconde) ;
                    //*******************************************************************************
                    // traitement des images de fond de cellules si fonction est activée*************
                    //*******************************************************************************
                    if ( $avec_diagonale_cellule ) {
                       $temp_jour_precedent_reserve   = ajout_jour_date ($date_en_cours_eng,-1,"JMA","-","eng") ;

                       //font montant ***************************************************************
                       if ( $jour_reserve[$date_en_cours_eng] && !$jour_reserve[$temp_jour_precedent_reserve])
                           $couleur_disponibilite = 'jour_reserve_rectangle_'.$memoire_bckgrd_jour[$date_en_cours_eng].'-'.$couleur_police_reserve_bdd[$date_en_cours_eng];
                       // front descendant **********************************************************
                       else if ( !$jour_reserve[$date_en_cours_eng] && $jour_reserve[$temp_jour_precedent_reserve] ) // jour actuel est marqué et si on n'est pas le premier jour du calendrier ********
                           $couleur_disponibilite = 'jour_reserve_rectangle_'.$couleur_police_reserve_bdd[$temp_jour_precedent_reserve].'-'.$memoire_bckgrd_jour[$date_en_cours_eng];
                       // jour prédent et actuel reservé ********************************************
                       else if ( $jour_reserve[$date_en_cours_eng] && $jour_reserve[$temp_jour_precedent_reserve] ) // test si le jour précédent été marqué et donc le jour actuel ne l'est pas********
                           $couleur_disponibilite = 'jour_reserve_rectangle_'.$couleur_police_reserve_bdd[$temp_jour_precedent_reserve].'-'.$couleur_police_reserve_bdd[$date_en_cours_eng];

                    }
                    //*******************************************************************************
                    //jour barré en fonction de la couleur ******************************************
                    if  ( isset($date_couleur_barre[$index_couleur_texte_police_jour_reserve]) && $date_couleur_barre[$index_couleur_texte_police_jour_reserve]) {
                       $attribut_debut_strike = "<strike>";
                       $attribut_fin_strike  = "</strike>";
                       }
                    else {
                       $attribut_debut_strike = "";
                       $attribut_fin_strike  = "";
                       }
                    //*******************************************************************************
                    //bordure basse fin de semaine **************************************************
                    if ( $index_num_jour_semaine == 1 || $index_num_jour_semaine == 1 )
                        $bordure_basse_fin_semaine = 'style="border-top:'.$couleur_ligne_fin_semaine.' '.$bordure_ligne_fin_semaine.'px solid;"' ;
                      else
                        $bordure_basse_fin_semaine = '';
                    //*******************************************************************************
                    echo '<td class ="',$couleur_disponibilite,'" ',$bordure_basse_fin_semaine,' nowrap>';
                    if ( ($format_date_fr) && ($avec_lien_autre_page_visiteur || ( $avec_infobulle_visiteur &&  $jour_reserve[$date_en_cours_eng])) && ( $difference_date_actuel <= 0 || !$jour_barre_calendrier_visiteur) ) {
                        $date_envoi_autre_page = Str_replace ( "xxxx",$date_en_cours_fr , stripslashes($lien_autre_page_visiteur)) ;
                        echo '<a ',$date_envoi_autre_page,' class = "date',$class_date_lien,'" >';
                        }
                    if ( !($format_date_fr) && ($avec_lien_autre_page_visiteur || ( $avec_infobulle_visiteur &&  $jour_reserve[$date_en_cours_eng])) && ( $difference_date_actuel <= 0 || !$jour_barre_calendrier_visiteur) ) {
                        $date_envoi_autre_page = Str_replace ( "xxxx",$date_en_cours_eng , stripslashes($lien_autre_page_visiteur));
                        echo '<a ',$date_envoi_autre_page,' class = "date',$class_date_lien,'" >';
                        }
                    if ( $jour_reserve[$date_en_cours_eng] && $avec_infobulle_visiteur && !$avec_lien_autre_page_visiteur)
                        echo '<a href="#" class = "date',$class_date_lien,'" >';
						
                    echo $attribut_debut_strike.$compteur_jour.$attribut_fin_strike;
					
                    if ( ($avec_lien_autre_page_visiteur || ( $avec_infobulle_visiteur &&  $jour_reserve[$date_en_cours_eng])) && ( $difference_date_actuel <= 0 || !$jour_barre_calendrier_visiteur) ) {
                    if ( $contenu_infobulle[$date_en_cours_eng] <> '' )
                        echo '<em><span></span>',$contenu_infobulle[$date_en_cours_eng],'</em>';
                        echo '</a>';
                        }
                    echo '</td>';
                    $contenu_ligne_date = ( $avec_infobulle_visiteur && $contenu_texte_infobulle[$date_en_cours_eng] <> '' ) ? $contenu_texte_infobulle[$date_en_cours_eng] : '&nbsp;' ;
                    echo '<td class ="',$couleur_disponibilite,'" ',$bordure_basse_fin_semaine,' nowrap>',$attribut_debut_strike,'',$jour_texte[$index_num_jour_semaine],'',$attribut_fin_strike,'</td>
                          <td class ="',$couleur_disponibilite,'_developpe" ',$bordure_basse_fin_semaine,'>',$contenu_ligne_date,'</td>';
                    // affichage des numéros  de semaine **********************************************
                    if ( ($index_num_jour_semaine == 1 || $compteur_jour == 1) && $avec_affichage_numero_semaine) {
                        if ( $index_num_jour_semaine == 0 )     // jour actuel est un dimanche
                           $nb_jour_restant_fin_demaine = 1 ;
                        else
                           $nb_jour_restant_fin_demaine = 7 - $index_num_jour_semaine + 1;
                        echo '<td class = "chiffre_num_semaine" ',$bordure_basse_fin_semaine,' rowspan = "',$nb_jour_restant_fin_demaine,'" nowrap>',cherche_num_semaine ($date_en_cours_eng,"arriere","-","eng") ,'</td>';
                        }
                    $compteur_jour++ ;
                  }

        echo '</tr>';
        if ( $compteur_jour > $numero_dernier_jour_mois && $compteur_ligne >= 6)
                        $fin_tableau = true ;
      }
//fin de la table du mois
echo '</table>';

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

