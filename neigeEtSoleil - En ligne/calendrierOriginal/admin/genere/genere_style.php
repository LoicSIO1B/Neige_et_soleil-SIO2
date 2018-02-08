<?php

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_genere.php");
     require("fichier_calendrier/parametres_calendrier.php");

//***************************************************************************************************
// création fichier des locataires ******************************************************************
//***************************************************************************************************

$chemin_fichier = "fichier_calendrier/styles.css";
$chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_styles.css";

//sauvegarde ancien fichier*********************************
@copy($chemin_fichier,$chemin_fichier_sauvegarde);

//memo date mise à jour pour rafraichissement des images
$date_maj = filemtime('fichier_calendrier/sauvegarde_styles.css');

//**************************************************************************************************
//style pour infobulle aide espace admin           *********************************************
//**************************************************************************************************

$file= @fopen($chemin_fichier, "w");
$fin_de_ligne = "\n" ;

$style = '

a.texte_infobulle:link { color: '.$couleur_police_jour.'; text-decoration: underline;}
a.texte_infobulle:visited { color:'.$couleur_police_jour.'; text-decoration: underline; }
a.texte_infobulle:active { color: '.$couleur_police_jour.';text-decoration: underline;}
a.texte_infobulle:hover { color: '.$couleur_police_jour.'; text-decoration: underline; }
a.texte_infobulle em {display:none;}
a.texte_infobulle:hover {border: 0; position: relative;z-index: 500;text-decoration:none;}
a.texte_infobulle:hover em {font-style: normal; display: block;position: absolute; top: 27px; left: -280px; padding: 5px; color: #000; border: 1px solid #bbb; background: #ffc; width:350px;}
a.texte_infobulle:hover em span {position: absolute; top: -7px; left: 3px; height: 7px; width: 11px; background: transparent url('.$repertoire_installation.'admin/image-infobulle.gif); margin:0; padding: 0; border: 0;}

';

@fputs($file, $style );

//**************************************************************************************************
//style pour lien sur numero de jour dans le calendrier*********************************************
//**************************************************************************************************

$style = '

a.date:link { color: '.$couleur_police_jour.'; text-decoration: underline;}
a.date:visited { color:'.$couleur_police_jour.'; text-decoration: underline; }
a.date:active { color: '.$couleur_police_jour.';text-decoration: underline;}
a.date:hover { color: '.$couleur_police_jour.'; text-decoration: underline; }
a.date em {display:none;} 
a.date:hover {border: 0; position: relative;z-index: 500;text-decoration:none;} 
a.date:hover em {font-style: normal; display: block;position: absolute; top: 27px; left: -70px; padding: 5px; color: #000; border: 1px solid #bbb; background: #ffc; width:200px;}
a.date:hover em span {position: absolute; top: -7px; left: 3px; height: 7px; width: 11px; background: transparent url('.$repertoire_installation.'admin/image-infobulle.gif); margin:0; padding: 0; border: 0;}

';

@fputs($file, $style );

//**************************************************************************************************
//style pour lien marqués sur numero de jour dans le calendrier*************************************
//**************************************************************************************************

$nb_result = count ($couleur_texte_jour_reserve);
if ( $nb_result > 0 ) {
foreach ($couleur_texte_jour_reserve as $cle => $val_couleur )  {
//style pour lien sur numero de jour dans le calendrier*********************************************
$style = '
a.date'.$cle.':link { color: '.$val_couleur.'; text-decoration: underline; }
a.date'.$cle.':visited { color: '.$val_couleur.';text-decoration: underline;}
a.date'.$cle.':active { color: '.$val_couleur.'; text-decoration: underline;}
a.date'.$cle.':hover { color: '.$val_couleur.'; text-decoration: underline;}
a.date'.$cle.' em {display:none;}
a.date'.$cle.':hover {border: 0; position: relative;z-index: 500;text-decoration:none;}
a.date'.$cle.':hover em {font-style: normal; display: block;position: absolute; top: 27px; left: -70px; padding: 5px; color: #000; border: 1px solid #bbb; background: #ffc; width:200px;}
a.date'.$cle.':hover em span {position: absolute; top: -7px; left: 3px; height: 7px; width: 11px; background: transparent url('.$repertoire_installation.'admin/image-infobulle.gif); margin:0; padding: 0; border: 0;}

a.date'.$cle.'_admin:link { color: '.$val_couleur.'; }
a.date'.$cle.'_admin:visited { color: '.$val_couleur.';text-decoration: underline;}
a.date'.$cle.'_admin:active { color: '.$val_couleur.'; text-decoration: underline;}
a.date'.$cle.'_admin:hover { color: '.$val_couleur.'; text-decoration: underline;}
a.date'.$cle.'_admin em {display:none;}
a.date'.$cle.'_admin:hover {border: 0; position: relative;z-index: 500;text-decoration:none;}
a.date'.$cle.'_admin:hover em {font-style: normal; display: block;position: absolute; top: 27px; left: -70px; padding: 5px; color: #000; border: 1px solid #bbb; background: #ffc; width:200px;}
a.date'.$cle.'_admin:hover em span {position: absolute; top: -7px; left: 3px; height: 7px; width: 11px; background: transparent url('.$repertoire_installation.'admin/image-infobulle.gif); margin:0; padding: 0; border: 0;}

';

   @fputs($file,$style);
}

}

//**************************************************************************************************
//style pour lien sur numero de jour dans le calendrier page administrateur ************************
//**************************************************************************************************

$style = '

a.date_admin:link { color: '.$couleur_police_jour.'; text-decoration: underline;}
a.date_admin:visited { color:'.$couleur_police_jour.'; text-decoration: underline; }
a.date_admin:active { color: '.$couleur_police_jour.';text-decoration: underline;}
a.date_admin:hover { color: '.$couleur_police_jour.'; text-decoration: underline; }
a.date_admin em {display:none;}
a.date_admin:hover {border: 0; position: relative;z-index: 500;text-decoration:none;}
a.date_admin:hover em {font-style: normal; display: block;position: absolute; top: 27px; left: -9px; padding: 5px; color: #000; border: 1px solid #bbb; background: #ffc; width:170px;}
a.date_admin:hover em span {position: absolute; top: -7px; left: 3px; height: 7px; width: 11px; background: transparent url('.$repertoire_installation.'admin/image-infobulle.gif); margin:0; padding: 0; border: 0;}

';

@fputs($file, $style );

//**************************************************************************************************
//style pour lien le navigateur +/- 14 jours calendrier tous ***************************************
//**************************************************************************************************

$style = '

a.offset:link { color: '.$couleur_police_mois.'; }
a.offset:visited { color:'.$couleur_police_mois.'; text-decoration: underline; }
a.offset:active { color: '.$couleur_police_mois.';text-decoration: underline;}
a.offset:hover { color: '.$couleur_police_mois.'; text-decoration: underline; }
a.offset em {display:none;}
a.offset:hover {border: 0; position: relative;z-index: 500;text-decoration:none;}
a.offset:hover em {font-style: normal; display: block;position: absolute; top: 27px; left: -9px; padding: 5px; color: #000; border: 1px solid #bbb; background: #ffc; width:170px;}
a.offset:hover em span {position: absolute; top: -7px; left: 3px; height: 7px; width: 11px; background: transparent url('.$repertoire_installation.'admin/image-infobulle.gif); margin:0; padding: 0; border: 0;}

';

@fputs($file, $style );

//**************************************************************************************************
//style pour lien sur selection mois annee**********************************************************
//**************************************************************************************************

$style = '
a.selection:link { color: '.$couleur_sel_mois_annee.'; text-decoration: none; }
a.selection:visited { color: '.$couleur_sel_mois_annee.'; text-decoration: none; }
a.selection:active { color: '.$couleur_sel_mois_annee.'; text-decoration: none;}
a.selection:hover { color: '.$couleur_sel_mois_annee.'; text-decoration: none; }

';

@fputs($file,$style);

//**************************************************************************************************
//style pour lien sur selection mois plus ou moins calendrier 1 mois *******************************
//**************************************************************************************************

$style = '
a.selection_1mois:link { color: '.$couleur_police_mois.'; text-decoration: none; }
a.selection_1mois:visited { color: '.$couleur_police_mois.'; text-decoration: none; }
a.selection_1mois:active { color: '.$couleur_police_mois.'; text-decoration: none;}
a.selection_1mois:hover { color: '.$couleur_police_mois.'; text-decoration: none; }

';

@fputs($file,$style);

//********************************************************************************
// style cellule MOIS*************************************************************
//********************************************************************************

$style = '
td.cellule_mois
{
   font-family: '.$police.';
   font-size: '.$taille_police_mois.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_mois.';
   background-color: '.$couleur_fond_mois.';
   width : '.$largeur_tableau.'px;
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;   ';
if ( $url_image_fond_mois <> '')
$style .= '
   background-image: url(\''.$url_image_fond_mois.'?version='.$date_maj.'\');
   background-repeat: no-repeat;   
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_nom_mois) 
   $style .= ' 
              border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_nom_mois) 
   $style .= '
              border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_nom_mois) 
   $style .= '
              border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_nom_mois) 
   $style .= '
             border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);

//********************************************************************************
// style cellule MOIS calendrie tous *********************************************
//********************************************************************************

$style = '
td.cellule_mois_tous
{
   font-family: '.$police.';
   font-size: '.$taille_police_mois.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_mois.';
   background-color: '.$couleur_fond_mois.';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;   ';
if ( $url_image_fond_mois <> '')
$style .= '
   background-image: url(\''.$url_image_fond_mois.'?version='.$date_maj.'\');
   background-repeat: no-repeat;   
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_nom_mois) 
   $style .= ' 
              border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_nom_mois) 
   $style .= '
              border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_nom_mois) 
   $style .= '
              border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_nom_mois) 
   $style .= '
             border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);

//********************************************************************************
// style cellule fleche + et - pour le calendrier 1 mois *************************
//********************************************************************************

$style = '
td.cellule_plus_moins_mois
{
   font-family: '.$police.';
   font-size: '.$taille_police_mois.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_mois.';
   background-color: '.$couleur_fond_mois.';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;   ';
if ( $url_image_fond_mois <> '')
$style .= '
   background-image: url(\''.$url_image_fond_mois.'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_nom_mois) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_nom_mois) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_nom_mois) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_nom_mois) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);

//********************************************************************************
// style pour les cellules lettre jour de semaine ********************************
//********************************************************************************

$style = '
td.lettre_jour_semaine
{
   font-family: '.$police.';
   font-size: '.$taille_police_nom_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_nom_jour.';
   background-color: '.$couleur_jour_semaine.';
   width : '.$largeur_mini_cellule_date.'px;
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;   ';
if ( $url_image_fond_cellule_nom_jour <> '')
$style .= '
   background-image: url(\''.$url_image_fond_cellule_nom_jour.'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_texte_jour)  
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_texte_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_texte_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_texte_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);

//********************************************************************************
// style pour les cellules lettre jour week end **********************************
//********************************************************************************

$style = '
td.lettre_jour_week_end
{
   font-family: '.$police.';
   font-size: '.$taille_police_nom_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_nom_jour.';
   background-color: '.$couleur_nom_jour_week_end.';
   width : '.$largeur_mini_cellule_date.'px;
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;   ';
if ( $url_image_fond_cellule_nom_jour <> '')
$style .= '
   background-image: url(\''.$url_image_fond_cellule_nom_jour.'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_texte_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_texte_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_texte_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_texte_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);

//********************************************************************************
// style pour les cellules lettre numéro semaine**********************************
//********************************************************************************

$style = '
td.lettre_jour_num_semaine
{
   font-family: '.$police.';
   font-size: '.$taille_police_nom_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_nom_jour.';
   background-color: '.$couleur_nom_numero_semaine.';
   width : '.$largeur_mini_cellule_date.'px;
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;   ';
if ( $url_image_fond_cellule_nom_jour <> '')
$style .= '
   background-image: url(\''.$url_image_fond_cellule_nom_jour.'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_texte_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_texte_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_texte_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_texte_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);

//********************************************************************************
// style pour les cellules lettre numéro semaine calendrier période **************
//********************************************************************************

$style = '
td.lettre_jour_num_semaine_periode
{
   font-family: '.$police.';
   font-size: '.$taille_police_nom_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_nom_jour.';
   background-color: '.$couleur_nom_numero_semaine.';
   width : '.$largeur_mini_cellule_date.'px;
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;   ';
if ( $url_image_fond_cellule_nom_jour <> '')
$style .= '
   background-image: url(\''.$url_image_fond_cellule_nom_jour.'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_texte_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_texte_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_texte_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_texte_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);

//********************************************************************************
// style pour les cellules chiffre numéro semaine ********************************
//********************************************************************************

$style = '
td.chiffre_num_semaine
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_numero_semaine.';
   background-color: '.$couleur_numero_semaine.';
   width : '.$largeur_mini_cellule_date.'px;
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;   ';
if ( $url_image_fond_cellule_numero_semaine <> '')
$style .= '
   background-image: url(\''.$url_image_fond_cellule_numero_semaine.'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_numero_semaine) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_numero_semaine) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_numero_semaine ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_numero_semaine ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);

//********************************************************************************
// style pour les cellules numéro jour libre**************************************
//********************************************************************************

$style = '
td.lettre_num_jour_libre
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_jour.';
   background-color: '.$couleur_libre.';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;   ';
if ( $url_image_fond_cellule <> '')
$style .= '
   background-image: url(\''.$url_image_fond_cellule.'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);

//********************************************************************************
// style pour les cellules numéro jour libre calendrier période ******************
//********************************************************************************

$style = '
td.lettre_num_jour_libre_periode
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_jour.';
   background-color: '.$couleur_libre.';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;   ';
if ( $url_image_fond_cellule <> '')
$style .= '
   background-image: url(\''.$url_image_fond_cellule.'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);

//********************************************************************************
// style pour les cellules numéro jour libre calendrier developpé ****************
//********************************************************************************

$style = '
td.lettre_num_jour_libre_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_jour.';
   background-color: '.$couleur_libre.';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;   ';
if ( $url_image_fond_cellule <> '')
$style .= '
   background-image: url(\''.$url_image_fond_cellule.'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);

//********************************************************************************
// style pour les cellules numéro jour libre en week end *************************
//********************************************************************************

$style = '
td.lettre_num_jour_libre_week_end
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_jour.';
   background-color: '.$couleur_jour_week_end.';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;   ';
if ( $url_image_fond_cellule <> '')
$style .= '
   background-image: url(\''.$url_image_fond_cellule.'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);

//********************************************************************************
// style pour les cellules numéro jour libre en week end calendrier developpe ****
//********************************************************************************

$style = '
td.lettre_num_jour_libre_week_end_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_jour.';
   background-color: '.$couleur_jour_week_end.';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;   ';
if ( $url_image_fond_cellule <> '')
$style .= '
   background-image: url(\''.$url_image_fond_cellule.'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);

//********************************************************************************
// style pour les cellules numéro jour libre cellules vides***********************
//********************************************************************************

$style = '
td.lettre_num_jour_libre_cellule_vide
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_jour.';
   background-color: '.$couleur_libre.';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ; ';
if ( $url_image_fond_cellule <> ''  && $avec_bordure_cellules_vides )
$style .= '
   background-image: url(\''.$url_image_fond_cellule.'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
$style .= '
}

';



@fputs($file,$style);

//********************************************************************************
// style pour les cellules numéro jour libre cellules vides calendrier developpe *
//********************************************************************************

$style = '
td.lettre_num_jour_libre_cellule_vide_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_jour.';
   background-color: '.$couleur_libre.';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ; ';
if ( $url_image_fond_cellule <> ''  && $avec_bordure_cellules_vides )
$style .= '
   background-image: url(\''.$url_image_fond_cellule.'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
$style .= '
}

';



@fputs($file,$style);

//********************************************************************************
// style pour les cellules numéro jour libre en week end cellules vides **********
//********************************************************************************

$style = '
td.lettre_num_jour_libre_week_end_cellule_vide
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_jour.';
   background-color: '.$couleur_jour_week_end.';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ; ';
if ( $url_image_fond_cellule_week_end <> '' && $avec_bordure_cellules_vides )
$style .= '
   background-image: url(\''.$url_image_fond_cellule_week_end.'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
$style .= '
}

';

@fputs($file,$style);

//********************************************************************************
// style pour les cellules numéro jour libre en week end cellules vides **********
//********************************************************************************

$style = '
td.lettre_num_jour_libre_week_end_cellule_vide_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_jour.';
   background-color: '.$couleur_jour_week_end.';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ; ';
if ( $url_image_fond_cellule_week_end <> '' && $avec_bordure_cellules_vides )
$style .= '
   background-image: url(\''.$url_image_fond_cellule_week_end.'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
$style .= '
}

';

@fputs($file,$style);

//********************************************************************************
// style pour les cellules chiffre numéro semaine avec cellules vides ************
//********************************************************************************

$style = '
td.chiffre_num_semaine_cellule_vide
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_jour.';
   background-color: '.$couleur_numero_semaine.';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
}

';

@fputs($file,$style);

//********************************************************************************
// style pour les cellules numéro jour réservés **********************************
//********************************************************************************

$nb_result = count ($couleur_texte_jour_reserve);
if ( $nb_result > 0 ) {
foreach ($couleur_texte_jour_reserve as $cle => $val_couleur )  {

$style = '
td.jour_reserve_'.$cle.'
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$val_couleur.';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;   ';
if ( $url_couleur_reserve[$cle] <> '')
$style .= '
   background-image: url(\''.$url_couleur_reserve[$cle].'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);

$style = '
td.jour_reserve_'.$cle.'_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$val_couleur.';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;   ';
if ( $url_couleur_reserve[$cle] <> '')
$style .= '
   background-image: url(\''.$url_couleur_reserve[$cle].'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);
 }
}

//********************************************************************************
// style pour les cellules numéro jour réservés avec diagonales cellules *********
//********************************************************************************

// style cellule reservé triangle rectangle montant et descendant ************************

$style = '
td.jour_reserve_libre
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$val_couleur.';
   background-color: '.$couleur_libre.';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/libre.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}
';

@fputs($file,$style);

$style = '
td.jour_reserve_weekend
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$val_couleur.';
   background-color: '.$couleur_jour_week_end.';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/weekend.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}
';

@fputs($file,$style);

$nb_result = count ($couleur_reserve);
if ( $nb_result > 0 ) {
foreach ($couleur_reserve as $cle => $val_couleur_reserve )  {
//création des images couleur actuelle montante et descendant**************
foreach ($couleur_reserve as $cle_triangle => $val_couleur_triangle )  {

// style cellule reservé triangle rectangle montant et descendant ************************

$style = '
td.jour_reserve_triangle_'.$cle_triangle.'-'.$cle.'
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/triangle_'.$cle_triangle.'-'.$cle.'.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
			   
$style = '
td.jour_reserve_triangle_'.$cle_triangle.'-'.$cle.'_cgt_client
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/triangle_'.$cle_triangle.'-'.$cle.'_cgt_client.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';			   
			   
$style .= '
}

td.jour_reserve_triangle_'.$cle.'-'.$cle_triangle.'
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle_triangle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/triangle_'.$cle.'-'.$cle_triangle.'.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
			   
$style .= '
}

td.jour_reserve_triangle_'.$cle.'-'.$cle_triangle.'_cgt_client
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle_triangle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/triangle_'.$cle.'-'.$cle_triangle.'_cgt_client.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';			   
			   
$style .= '
}

td.jour_reserve_triangle_'.$cle_triangle.'-'.$cle.'_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/triangle_'.$cle_triangle.'-'.$cle.'.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
			   
$style .= '
}

td.jour_reserve_triangle_'.$cle_triangle.'-'.$cle.'_developpe_cgt_client
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/triangle_'.$cle_triangle.'-'.$cle.'_cgt_client.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';			   
			   
$style .= '
}

td.jour_reserve_triangle_'.$cle.'-'.$cle_triangle.'_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle_triangle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/triangle_'.$cle.'-'.$cle_triangle.'.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
			   
$style .= '
}

td.jour_reserve_triangle_'.$cle.'-'.$cle_triangle.'_developpe_cgt_client
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle_triangle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/triangle_'.$cle.'-'.$cle_triangle.'_cgt_client.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';			   
			   
$style .= '
}

';

@fputs($file,$style);

// style cellule reservé double rectangle haut et bas ************************

$style = '
td.jour_reserve_rectangle_'.$cle_triangle.'-'.$cle.'
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/rectangle_'.$cle_triangle.'-'.$cle.'.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_rectangle_'.$cle.'-'.$cle_triangle.'
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle_triangle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/rectangle_'.$cle.'-'.$cle_triangle.'.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_rectangle_'.$cle_triangle.'-'.$cle.'_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/rectangle_'.$cle_triangle.'-'.$cle.'.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_rectangle_'.$cle.'-'.$cle_triangle.'_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle_triangle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/rectangle_'.$cle.'-'.$cle_triangle.'.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour )                            
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);


}

//création des images couleur libre et montante **************

// style cellule reservé double rectangle haut et bas ************************

$style = '
td.jour_reserve_triangle_libre-'.$cle.'
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/triangle_libre-'.$cle.'.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_triangle_'.$cle.'-libre
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/triangle_'.$cle.'-libre.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_rectangle_libre-'.$cle.'
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/rectangle_libre-'.$cle.'.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_rectangle_'.$cle.'-libre
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/rectangle_'.$cle.'-libre.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_triangle_libre-'.$cle.'_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/triangle_libre-'.$cle.'.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_triangle_'.$cle.'-libre_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/triangle_'.$cle.'-libre.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_rectangle_libre-'.$cle.'_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/rectangle_libre-'.$cle.'.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_rectangle_'.$cle.'-libre_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_reserve[$cle].';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/rectangle_'.$cle.'-libre.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}


';

@fputs($file,$style);


// style cellule reservé double rectangle haut et bas ************************

$style = '
td.jour_reserve_triangle_weekend-'.$cle.'
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_jour_week_end.';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/triangle_weekend-'.$cle.'.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_triangle_'.$cle.'-weekend
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_jour_week_end.';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/triangle_'.$cle.'-weekend.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_rectangle_weekend-'.$cle.'
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_jour_week_end.';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/rectangle_weekend-'.$cle.'.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_rectangle_'.$cle.'-weekend
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_jour_week_end.';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/rectangle_'.$cle.'-weekend.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_triangle_weekend-'.$cle.'_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_jour_week_end.';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/triangle_weekend-'.$cle.'.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_triangle_'.$cle.'-weekend_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_jour_week_end.';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/triangle_'.$cle.'-weekend.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_rectangle_weekend-'.$cle.'_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_jour_week_end.';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/rectangle_weekend-'.$cle.'.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

td.jour_reserve_rectangle_'.$cle.'-weekend_developpe
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_texte_jour_reserve[$cle].';
   background-color: '.$couleur_jour_week_end.';
   height : '.$hauteur_mini_cellule_date.'px;
   width  : '.$largeur_tableau.'px;
   text-align : center ;
   background-image: url(\''.$repertoire_installation.'admin/img_cal/rectangle_'.$cle.'-weekend.jpg?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}


';

@fputs($file,$style);
     }
  }

//********************************************************************************
// style pour la cellule jour d'aujourd'hui **************************************
//********************************************************************************

$style = '
td.lettre_num_jour_aujourdhui
{
   font-family: '.$police.';
   font-size: '.$taille_police_jour.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_jour.';
   background-color: '.$couleur_jour_aujourd_hui.';
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;   ';
if ( $url_image_fond_cellule_aujourd_hui <> '')
$style .= '
   background-image: url(\''.$url_image_fond_cellule_aujourd_hui.'?version='.$date_maj.'\');
   background-repeat: repeat;
   background-position: center center; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_num_jour) 
     $style .= '
               border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_num_jour ) 
     $style .= '
               border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);


//********************************************************************************
// style pour la cellule avec les offsets*****************************************
//********************************************************************************

$style = '
td.cellule_offset
{
   font-family: '.$police.';
   font-size: '.$taille_police_mois.'px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: '.$couleur_police_mois.';
   background-color: '.$couleur_fond_mois.';
   width : '.$largeur_tableau.'px;
   height : '.$hauteur_mini_cellule_date.'px;
   text-align : center ;   ';
if ( $url_image_fond_mois <> '')
$style .= '
   background-image: url(\''.$url_image_fond_mois.'?version='.$date_maj.'\');
   background-position: '.$alignement_horizontal_image_fond.' '.$alignement_vertical_image_fond.'; ';
if ( $largeur_bordure_superieur > 0 && $avec_bordure_cellule_nom_mois) 
   $style .= ' 
              border-top: '.$largeur_bordure_superieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_inferieur > 0 && $avec_bordure_cellule_nom_mois) 
   $style .= '
              border-bottom: '.$largeur_bordure_inferieur.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_gauche > 0 && $avec_bordure_cellule_nom_mois) 
   $style .= '
              border-left: '.$largeur_bordure_gauche.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
if ( $largeur_bordure_droite > 0 && $avec_bordure_cellule_nom_mois) 
   $style .= '
             border-right: '.$largeur_bordure_droite.'px '.$couleur_bordure_cellule_non_vide.' solid; ';
$style .= '
}

';

@fputs($file,$style);

//********************************************************************************
// style pour la cellule ligne séparateur horizontal *****************************
//********************************************************************************

$style = '
td.cellule_separateur_horizontal
{
   font-family: '.$police.';
   font-size: 12px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   text-align : center ;
   background-color: '.$couleur_separateur_calendrier_tous.';
   color: '.$couleur_police_mois.';
   height : 2px;
}

';

@fputs($file,$style);

//********************************************************************************
// style pour la cellule ligne séparateur vertical *******************************
//********************************************************************************

$style = '
td.cellule_separateur_vertical
{
   font-family: '.$police.';
   font-size: 12px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   text-align : center ;
   background-color: '.$couleur_separateur_calendrier_tous.';
   color: '.$couleur_police_mois.';
   width : 3px;
}

';

@fputs($file,$style);

//fermeture du fichier

$creation_reussi2 = @fclose($file);

?>