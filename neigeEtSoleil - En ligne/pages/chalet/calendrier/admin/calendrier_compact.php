<?php

//initailisation compteur de mois par ligne*********************************************************
$compteur_mois_ligne = 1 ;

//creation du tableau des mois**********************************************************************
echo '<br><table cellPadding="',$espace_dans_cellule,'" cellSpacing="',$espace_entre_cellule,'" style = "border :',$couleur_bordure_tableau,' ',$bordure_du_tableau,'px solid " align="left">';
//affichage du mois*********************************************************************************

//affichage nom des jours ******************************************************
echo '<tr>
      <td class = "lettre_jour_semaine" >&nbsp;</td>';
//premier jour est un lundi ****************************************************
$index_jour_ligne_liste_jour = 1 ;  //numero du jour dans le semaine
for ($j=1; $j< 38; $j++)
     {
       if  ($index_jour_ligne_liste_jour == 6 || $index_jour_ligne_liste_jour == 0)
          $style = "lettre_jour_week_end";
        else
          $style = "lettre_jour_semaine" ;
       echo '<td class =',$style,' >',$jour_texte[$index_jour_ligne_liste_jour],'</td>';
       if ( $index_jour_ligne_liste_jour == 6 )
            $index_jour_ligne_liste_jour = 0 ;
       else
            $index_jour_ligne_liste_jour++;
     }
echo '</tr>';

//affichage des tableaux des mois desir�s***********************************************************
for ( $compteur_mois = 1; $compteur_mois <= $nombre_mois_afficher_admin; $compteur_mois++ )
 {
   $compteur_mois_ligne = $compteur_mois_ligne + 1 ;

//initialisation des calendriers*******************************************************************
$fin_tableau              = false ;
$premier_jour_depasse     = false ;
$numero_premier_jour_mois = date("w",mktime ( 6,0,0,$mois_en_cours  ,1,$annee_en_cours)) ; //recherche si premier jour du mois est un lundi, mardi,etc...
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
$compteur_cellule         = 1 ; // cellule 1 = premi�re cellule lundi
$index_jour_ligne_liste_jour = 1 ; // index pour couleur de fond suivant jour semaine ou week end

echo '<tr><td class = "cellule_mois" nowrap><b>',$mois_texte[$mois_en_cours],' ',$annee_en_cours,'</b></td>';
//creation du tableau avec numero des jours*********************************************************
while ( !($fin_tableau) )
      {
        if ( $numero_premier_jour_mois == $compteur_cellule || !$premier_jour_depasse && $compteur_cellule == 7 &&  $numero_premier_jour_mois == 0)
             $premier_jour_depasse = true ;
        $couleur_disponibilite = "lettre_num_jour_libre" ;
        if ( $index_jour_ligne_liste_jour == 6 || $index_jour_ligne_liste_jour == 0 )
             $couleur_disponibilite = "lettre_num_jour_libre_week_end" ;
        if ( $premier_jour_depasse && ($compteur_jour <= $numero_dernier_jour_mois) )
                  {
                    $date_en_cours_fr  = ajout_supprime_zero ($compteur_jour."/".$mois_en_cours."/".$annee_en_cours,"Ajout","/","fr") ;
                    $date_en_cours_eng = ajout_supprime_zero ($annee_en_cours."-".$mois_en_cours."-".$compteur_jour,"Ajout","-","eng") ;
                    // test si le jour affich� correspond au jour d'aujourd'hui *******************
                    if ( $avec_marquage_du_jour_d_aujourd_hui ) {
                        if ( $date_aujourd_hui ==  $date_en_cours_eng )
                            $couleur_disponibilite = "lettre_num_jour_aujourdhui" ;
                        }
                    //test si jour est reserv�******************************************************
                    $index_couleur_texte_police_jour_reserve = $couleur_police_reserve_bdd[$date_en_cours_eng] ;
                    $avertissement_marquage = 'false';
                    if ( $jour_reserve[$date_en_cours_eng] )  {
                        $coul_police_jour = $couleur_texte_jour_reserve[$index_couleur_texte_police_jour_reserve] ;
                        $couleur_disponibilite = $class_reserve_cellule[$date_en_cours_eng];
                        $class_date_lien = $couleur_police_reserve_bdd[$date_en_cours_eng] ;
                        $avertissement_marquage = ($date_couleur_disponible[$index_couleur_texte_police_jour_reserve]) ? 'false' : 'true' ;
                        }
                    else  {
                       $coul_police_jour = $couleur_police_jour ;
                       $class_date_lien = '' ;
                       }
                    //*******************************************************************************
                    // traitement des images de fond de cellules si fonction est activ�e*************
                    //*******************************************************************************
                    if ( $avec_diagonale_cellule ) {
                       $temp_jour_precedent_reserve   = ajout_jour_date ($date_en_cours_eng,-1,"JMA","-","eng") ;

                       //font montant ***************************************************************
                       if ( $jour_reserve[$date_en_cours_eng] && !$jour_reserve[$temp_jour_precedent_reserve])
                           $couleur_disponibilite = 'jour_reserve_triangle_'.$memoire_bckgrd_jour[$date_en_cours_eng].'-'.$couleur_police_reserve_bdd[$date_en_cours_eng];
                       // front descendant **********************************************************
                       else if ( !$jour_reserve[$date_en_cours_eng] && $jour_reserve[$temp_jour_precedent_reserve] ) // jour actuel est marqu� et si on n'est pas le premier jour du calendrier ********
                           $couleur_disponibilite = 'jour_reserve_triangle_'.$couleur_police_reserve_bdd[$temp_jour_precedent_reserve].'-'.$memoire_bckgrd_jour[$date_en_cours_eng];
                       // jour pr�dent et actuel reserv� ********************************************
                       else if ( $jour_reserve[$date_en_cours_eng] && $jour_reserve[$temp_jour_precedent_reserve] ) // test si le jour pr�c�dent �t� marqu� et donc le jour actuel ne l'est pas********
							//test si locataire diff�rent - image avec s�parateur
							if ( isset($couleur_police_reserve_bdd[$temp_jour_precedent_reserve],$couleur_police_reserve_bdd[$date_en_cours_eng],$locataire_reserve[$date_en_cours_eng],$locataire_reserve[$temp_jour_precedent_reserve])  
								 && $couleur_police_reserve_bdd[$temp_jour_precedent_reserve] == $couleur_police_reserve_bdd[$date_en_cours_eng] 
							     && $locataire_reserve[$date_en_cours_eng] <> $locataire_reserve[$temp_jour_precedent_reserve] )
								$couleur_disponibilite = 'jour_reserve_triangle_'.$couleur_police_reserve_bdd[$temp_jour_precedent_reserve].'-'.$couleur_police_reserve_bdd[$date_en_cours_eng]."_cgt_client";
							else // sinon image identique
								$couleur_disponibilite = 'jour_reserve_triangle_'.$couleur_police_reserve_bdd[$temp_jour_precedent_reserve].'-'.$couleur_police_reserve_bdd[$date_en_cours_eng];

                    }
                    //*******************************************************************************
                    echo '<td class ="',$couleur_disponibilite,'" >';
                    if ( $date_lien == 0 && $format_date_fr)
                        echo '<a href="javascript:swap_date(\'',$date_en_cours_fr,'\',\'',$num_logement_en_cours,'\',\'',$format_calendrier_logement[$num_logement_en_cours],'\',',$avertissement_marquage,')" class = "date',$class_date_lien,'" >';
                    if ( $date_lien == 0 && (!($format_date_fr)) )
                        echo '<a href="javascript:swap_date(\'',$date_en_cours_eng,'\',\'',$num_logement_en_cours,'\',\'',$format_calendrier_logement[$num_logement_en_cours],'\',',$avertissement_marquage,')" class = "date',$class_date_lien,'" >';
                    echo $compteur_jour;
                    if ( $date_lien == 0 ) {
                        if  ( $contenu_infobulle[$date_en_cours_eng] <>  '' )
                             echo '<em><span></span>',$contenu_infobulle[$date_en_cours_eng],'</em>';
                        echo '</a>';
                        }
                    echo '</td>';
                    $compteur_jour++ ;
                  }
       else   {    // il n'y as pas de date pour cette cellule
           if ( !$avec_bordure_cellules_vides )
                $couleur_disponibilite .= "_cellule_vide" ;
           echo '<td class ="',$couleur_disponibilite,'" >&nbsp;</td>';
      }     
       // controle jour de la semaine en cours dans la cellule ****
       if ( $index_jour_ligne_liste_jour == 6 )
            $index_jour_ligne_liste_jour = 0 ;
       else
            $index_jour_ligne_liste_jour++;
        $compteur_cellule++;
        if ( $compteur_cellule > 37 )
                        $fin_tableau = true ;
      }
//fin de la table du mois
echo '</tr>';

//incrementation du mois et annee en cours********************************************************
$mois_en_cours = $mois_en_cours + 1;
if ( $mois_en_cours > 12 )
    {
     $mois_en_cours = 1;
     $annee_en_cours = $annee_en_cours + 1 ;
    }

 }
//fin de paragraphe du tableau*********************************************************************

echo '</table></table>';


 if ( $avec_compression_page )
    ob_end_flush();

?>

</body>

</html>

