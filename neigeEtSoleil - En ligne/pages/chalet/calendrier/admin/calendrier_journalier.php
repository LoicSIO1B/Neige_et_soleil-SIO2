<?php

//affichage des tableaux des mois desirés***********************************************************
for ( $compteur_mois = 1; $compteur_mois <= $nombre_mois_afficher_admin; $compteur_mois++ )
 {
   $compteur_mois_ligne = $compteur_mois_ligne + 1 ;

//creation du tableau des mois**********************************************************************
echo '<table cellPadding="',$espace_dans_cellule,'" cellSpacing="',$espace_entre_cellule,'" style = "width:',$largeur_tableau,'px;border :',$couleur_bordure_tableau,' ',$bordure_du_tableau,'px solid " align="left">';

//affichage du mois*********************************************************************************

echo '<tr><td class = "cellule_mois" colspan = "8" ><b>',$mois_texte[$mois_en_cours],' ',$annee_en_cours,'</b></TD></TR>';

//affichage nom des jours et numéro de semaine******************************************************
echo '<tr>';

//nombre de colonne dans un calendrier un mois , dépend si choix avec ou sans numéro de semaine****
$nombre_colonne_calendrier = ( $avec_affichage_numero_semaine ) ? 9 : 8;

//temporaire pour initailisation variable globales

for ($j=1; $j<9; $j++)
     $tempor = $jour_texte[correction_debut_semaine ($texte_jour_debut_semaine,$j)];
for ($j=1; $j<$nombre_colonne_calendrier; $j++)
     {
       if  ($j == $index_jour_samedi || $j == $index_jour_dimanche)
          $style = "lettre_jour_week_end";
       elseif ( $j == 8)
          $style = "lettre_jour_num_semaine";
        else
          $style = "lettre_jour_semaine" ;
       echo '<td class = "',$style,'" >',$jour_texte[correction_debut_semaine ($texte_jour_debut_semaine,$j)],'</td>';
     }
echo '</tr>';

//initialisation des calendriers*******************************************************************
$fin_tableau              = false ;
$premier_jour_depasse     = false ;
$numero_premier_jour_mois = jour_debut_semaine ($texte_jour_debut_semaine,$mois_en_cours ,$annee_en_cours) ;
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
$lundi_trouve = false;

//creation du tableau avec numero des jours*********************************************************
while ( !($fin_tableau) )
      {
        echo '<tr>';
        $compteur_ligne++;
        $au_moins_une_date_sur_la_ligne = false;
        //creation des cases par semaine************************************************************
        for ($j=1; $j<$nombre_colonne_calendrier; $j++)
             {
              $date_en_cours_fr  = ajout_supprime_zero ($compteur_jour."/".$mois_en_cours."/".$annee_en_cours,"Ajout","/","fr") ;
              $date_en_cours_eng = ajout_supprime_zero ($annee_en_cours."-".$mois_en_cours."-".$compteur_jour,"Ajout","-","eng") ;
              $couleur_disponibilite = "lettre_num_jour_libre" ;
              //Test pour debut tableau pour premier jour du mois***********************************
              if ( $numero_premier_jour_mois == $j  )
                  $premier_jour_depasse = true ;
              if ( $premier_jour_depasse && ($compteur_jour <= $numero_dernier_jour_mois) && $j < 8)
                  {
                    if ( $j == $index_jour_samedi || $j == $index_jour_dimanche)
                        $couleur_disponibilite = "lettre_num_jour_libre_week_end" ;
                    // test si le jour affiché correspond au jour d'aujourd'hui *******************
                    if ( $avec_marquage_du_jour_d_aujourd_hui ) {
                        if ( $date_aujourd_hui ==  $date_en_cours_eng )
                            $couleur_disponibilite = "lettre_num_jour_aujourdhui" ;
                        }
                    //test si jour est reservé******************************************************
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
                    // traitement des images de fond de cellules si fonction est activée*************
                    //*******************************************************************************
                    if ( $avec_diagonale_cellule ) {
                       $temp_jour_precedent_reserve   = ajout_jour_date ($date_en_cours_eng,-1,"JMA","-","eng") ;

                       //font montant ***************************************************************
                       if ( $jour_reserve[$date_en_cours_eng] && !$jour_reserve[$temp_jour_precedent_reserve])
                           $couleur_disponibilite = 'jour_reserve_triangle_'.$memoire_bckgrd_jour[$date_en_cours_eng].'-'.$couleur_police_reserve_bdd[$date_en_cours_eng];
                       // front descendant **********************************************************
                       else if ( !$jour_reserve[$date_en_cours_eng] && $jour_reserve[$temp_jour_precedent_reserve] ) // jour actuel est marqué et si on n'est pas le premier jour du calendrier ********
                           $couleur_disponibilite = 'jour_reserve_triangle_'.$couleur_police_reserve_bdd[$temp_jour_precedent_reserve].'-'.$memoire_bckgrd_jour[$date_en_cours_eng];
                       // jour prédent et actuel reservé ********************************************
                       else if ( $jour_reserve[$date_en_cours_eng] && $jour_reserve[$temp_jour_precedent_reserve] ) { // test si le jour précédent été marqué et donc le jour actuel ne l'est pas********
                            //test si locataire différent 
							if ( isset($couleur_police_reserve_bdd[$temp_jour_precedent_reserve],$couleur_police_reserve_bdd[$date_en_cours_eng],$locataire_reserve[$date_en_cours_eng],$locataire_reserve[$temp_jour_precedent_reserve])  
								 && $couleur_police_reserve_bdd[$temp_jour_precedent_reserve] == $couleur_police_reserve_bdd[$date_en_cours_eng] 
							     && $locataire_reserve[$date_en_cours_eng] <> $locataire_reserve[$temp_jour_precedent_reserve] )
								$couleur_disponibilite = 'jour_reserve_triangle_'.$couleur_police_reserve_bdd[$temp_jour_precedent_reserve].'-'.$couleur_police_reserve_bdd[$date_en_cours_eng]."_cgt_client";
							else
								$couleur_disponibilite = 'jour_reserve_triangle_'.$couleur_police_reserve_bdd[$temp_jour_precedent_reserve].'-'.$couleur_police_reserve_bdd[$date_en_cours_eng];
							}

                    }
                    //*******************************************************************************
                    echo '<td class ="',$couleur_disponibilite,'" >';
                    if ( $date_lien == 0 && $format_date_fr)
                        echo '<a href="javascript:swap_date(\'',$date_en_cours_fr,'\',\'',$num_logement_en_cours,'\',\'',$format_calendrier_logement[$num_logement_en_cours],'\',',$avertissement_marquage,')" class = "date',$class_date_lien,'_admin" >';
                    if ( $date_lien == 0 && (!($format_date_fr)) )
                        echo '<a href="javascript:swap_date(\'',$date_en_cours_eng,'\',\'',$num_logement_en_cours,'\',\'',$format_calendrier_logement[$num_logement_en_cours],'\',',$avertissement_marquage,')" class = "date',$class_date_lien,'_admin" >';
                    //recherche de la date du lundi de la semaine
                    if ( $j == $index_jour_lundi )  {
                        $memoire_numero_premier_jour_sem_en_cours =  $compteur_jour;
                        $memoire_numero_mois_premier_jour_sem_en_cours =  $mois_en_cours;
                        $memoire_numero_annee_premier_jour_sem_en_cours =  $annee_en_cours;
                        $lundi_trouve = true;
                        }
                    echo $compteur_jour;
                    if ( $date_lien == 0 ) {
                        if  ( $contenu_infobulle[$date_en_cours_eng] <>  '' )
                             echo '<em><span></span>',$contenu_infobulle[$date_en_cours_eng],'</em>';
                        echo '</a>';
                        }
                    echo '</td>';
                    $compteur_jour++ ;
                    $au_moins_une_date_sur_la_ligne = true ;
                  }
              elseif  ( $j == 8  && $au_moins_une_date_sur_la_ligne)  {
                    //indique numéro de semaine*************************************************************************************************
                    if ( !$lundi_trouve && $compteur_ligne == 1) {  // si aucun lundi dans premier ligne, calcul numéro semaine sur dernier lundi du mois précédent****
                    $temp_mois_precedent = $mois_en_cours -1 ;
                    $temp_annee_precedent = $annee_en_cours ;
                    if  ( $temp_mois_precedent <= 0 ) {
                      $temp_mois_precedent = 12;
                      $temp_annee_precedent = $annee_en_cours - 1 ;
                      }
                    $numero_dernier_jour_calcul_semaine = strftime("%d",mktime ( 0,0,0,$mois_en_cours,0,$temp_annee_precedent)) ;
                    $premiere_boucle_recherche_lundi = true;
                    while ( !$lundi_trouve) {
                        if ( !$premiere_boucle_recherche_lundi )
                           $numero_dernier_jour_calcul_semaine = $numero_dernier_jour_calcul_semaine - 1 ;
                        $premiere_boucle_recherche_lundi = false;
                        $nom_jour_temp_calcul_semaine = strftime("%a",mktime ( 0,0,0,$temp_mois_precedent,$numero_dernier_jour_calcul_semaine,$temp_annee_precedent)) ;
                        if ( $nom_jour_temp_calcul_semaine == "Mon"  || $nom_jour_temp_calcul_semaine == "lun") {
                        $memoire_numero_premier_jour_sem_en_cours =  $numero_dernier_jour_calcul_semaine;
                        $memoire_numero_mois_premier_jour_sem_en_cours =  $temp_mois_precedent;
                        $memoire_numero_annee_premier_jour_sem_en_cours =  $temp_annee_precedent;
                        $lundi_trouve = true;
                           }
                        }
                      }
                    $temp_semaine_en_cours = date("W",mktime ( 0,0,0,$memoire_numero_mois_premier_jour_sem_en_cours ,$memoire_numero_premier_jour_sem_en_cours ,$memoire_numero_annee_premier_jour_sem_en_cours ));
                    echo '<td class ="chiffre_num_semaine" >
                          ',$temp_semaine_en_cours.'</td>';
                    $lundi_trouve = false;
                    }
              else  {
                    if ( ( $j == $index_jour_samedi || $j == $index_jour_dimanche)  && $avec_continuite_couleur )
                        $couleur_disponibilite  = "lettre_num_jour_libre_week_end" ;
                    else
                        $couleur_disponibilite  = "lettre_num_jour_libre" ;
                    if ( $j == 8 && $avec_continuite_couleur )
                        $couleur_disponibilite  = "chiffre_num_semaine" ;
                    if ( !$avec_bordure_cellules_vides )
                          $couleur_disponibilite .= "_cellule_vide" ;
                    echo '<td class ="',$couleur_disponibilite,'" >&nbsp;</td>';
                    }
             }
        echo '</tr>';
        if ( $compteur_jour > $numero_dernier_jour_mois && $compteur_ligne >= 6)
                        $fin_tableau = true ;
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
 if ( $compteur_mois_ligne > $nombre_mois_afficher_ligne_admin )
    {
     echo '</tr></td><tr><td nowrap>';
     $compteur_mois_ligne = 1;
    }
 }
//fin de paragraphe du tableau*********************************************************************
echo '</td>
      </tr>
      </table>';

echo '<br><font style="font-size:11px" color="#000000" face="Arial"><a href="http://www.mathieuweb.fr/calendrier/calendrier.php" target="_blank">Calendrier des réservations</a></font>';

 if ( $avec_compression_page )
    ob_end_flush();

?>

</body>

</html>

