<?php

//*****************************************************************
// initialisation des variables
//*****************************************************************

if ( $logement <> 0 ) {
   $largeur_frame = $largeur_tableau * $nombre_mois_afficher_ligne  ;
   $largeur_frame = $largeur_frame  + 10 ;
   $calcul_nb_ligne = ceil ($nombre_mois_afficher / $nombre_mois_afficher_ligne) ;
   $hauteur_temp = explode ("px", $hauteur_mini_cellule_date);
   $hauteur_tableau = $hauteur_temp[0] * 9 +30 ;
   $offset_ht_sel     =  95 ;
   $hauteur_frame = $hauteur_tableau * $calcul_nb_ligne  ;
   $hauteur_frame = $hauteur_frame  + $offset_ht_sel ;
}
else {
   $largeur_frame = $largeur_tableau + ( ( 7 * $nombre_semaine_calendrier_tous) * ($taille_police_nom_jour + 4))  ;
   $largeur_frame = $largeur_frame  + 20 ;
   $nb_logement = count($nom_logement);
   $hauteur_frame = $nb_logement * $hauteur_mini_cellule_date + ( 2 * $hauteur_mini_cellule_date) + 50;

}

$autoriser_transparence = ($avec_transparence_calendrier) ? 'allowtransparency="true"' : '';

//*****************************************************************
// adresse calendrier
//*****************************************************************

$liste_id  = 'ID '.$item1.' '.$nom_logement[$logement].' = '.$logement.'     ';
$liste_id .= 'ID locataire '.$nom_locataire[$locataire].' = '.$locataire ;

//*****************************************************************
// adresse calendrier
//*****************************************************************

$filtre    = ".php?mois=$mois&amp;an=$an&amp;langue=$langue&amp;locataire=$locataire&amp;logement=$logement";
$lien_page = 'calendrier';
$lien_page2= ( $logement == 0 ) ? "_tous" : '';

$adresse_complete =   $repertoire_installation.$lien_page.$lien_page2.$filtre;

//*****************************************************************
// code pour calendrier dans une frame
//*****************************************************************

$code_frame = '<div id="calendrier" style="max-width:'.$largeur_frame.'px"><iframe name="calendrier" id="calendrier" style="width:100%;height:'.$hauteur_frame.'px;" src="'.$adresse_complete.'" scrolling="no" frameborder="0" '.$autoriser_transparence.'>Votre navigateur ne supporte pas les frames</iframe></div>';

//*****************************************************************
// code pour include du calendrier
//*****************************************************************

 $code_include_calendrier  = 'Attention , ce code ne fonctionne correctement que s\'il n\'y a pas de conflit entre les noms de variables avec le fichier calendrier et la page ou il sera inclus, et il ne peut y avoir qu\'un seul calenrier sur une même page!
 
 Dans le fichier '.$lien_page.$lien_page2.'.php, modifier la variable adresse de la page:
 
 $adresse_page         = "'.$lien_page.$lien_page2.'.php";
 
 par le nom de la page ou sera incluse le calendrier
 
 Dans le fichier '.$lien_page.$lien_page2.'.php, 
 
 supprimer l\'instruction session_start(); qui se trouve au début du fichier, et la déplacer au tout début de la page ou sera insérée le calendrier, cela doit être la toute première instruction de la page:
  
 <?php session_start(); ?>

 supprimer le lien vers le fichier CSS
 
 <META HTTP-EQUIV="Content-Style-Type" CONTENT="text/css">
 <link rel="stylesheet" href="'.$repertoire_installation.'admin/fichier_calendrier/styles.css" type="text/css" media="ALL" />
 
 et l\'installer entre les balises HEAD de la page ou est incluse le calendrier
 
 Dans le fichier '.$lien_page.$lien_page2.'.php, supprimer tous les métatags Html, Head, Title,body,Doctype
 
 Dans la nouvelle page ou sera affichée le calendrier, insérer ce code:
 
 <?php include("'.$lien_page.$lien_page2.'.php"); ?>
 
 Si nécessaire modifier le chemin relatif vers le fichier calendrier.php
 
 Rappel, la nouvelle page ou sera affichée le calendrier doit avoir l\'extension .php
 
 Ajouter les varibales suivantes à l\'URL de la page
 
 '.$filtre;

//*****************************************************************
// adresse calendrier 1 mois
//*****************************************************************

if ($logement <> 0 )
   $lien_page_1mois = $repertoire_installation.'calendrier_1mois'.$filtre;

//*****************************************************************
// code pour calendrier 1 mois dans une frame
//*****************************************************************

if ($logement <> 0 )
   $code_frame_1mois = '<iframe name="calendrier" id="calendrier" style="width:'.($largeur_tableau +10).'px;height:'.$hauteur_tableau.'px;" src="'.$lien_page_1mois.'" scrolling="no" frameborder="0" '.$autoriser_transparence.'>Votre navigateur ne supporte pas les frames</iframe>';

//*****************************************************************
// code pour include du calendrier 1 mois
//*****************************************************************

if ($logement <> 0 ) {
 $code_include_calendrier_1mois  = 'Attention , ce code ne fonctionne correctement que s\'il n\'y a pas de conflit entre les noms de variables avec le fichier calendrier et la page ou il sera inclus, et il ne peut y avoir qu\'un seul calenrier sur une même page!
 
 Dans le fichier calendrier.php, modifier la variable adresse de la page:
 
 $adresse_page         = "calendrier_1mois.php";
 
 par le nom de la page ou sera incluse le calendrier
 
 Dans le fichier calendrier.php, supprimer le lien vers le fichier CSS
 
 <META HTTP-EQUIV="Content-Style-Type" CONTENT="text/css">
 <link rel="stylesheet" href="'.$repertoire_installation.'admin/fichier_calendrier/styles.css" type="text/css" media="ALL" />
 
 et l\'installer entre les balises HEAD de la page ou est incluse le calendrier_1mois

 Dans le fichier calendrier.php, supprimer tous les métatags Html, Head, Title,body,Doctype

 Dans la nouvelle page ou sera affichée le calendrier, insérer ce code:
 
 <?php include("calendrier_1mois.php"); ?>
 
 Si nécessaire modifier le chemin relatif vers le fichier calendrier.php

 Rappel, la nouvelle page ou sera affichée le calendrier doit avoir l\'extension .php

 Ajouter les varibales suivantes à l\'URL de la page 
 
 '.$filtre;
}

//*****************************************************************
// code pour date picker
//*****************************************************************

$code_datepicker = '<input type="text" id="date" style="width:115px;height:18px;border:1px #C0C0C0 solid;font-family:Courier New;font-size:13px;z-index:0" name="date" value=""> <font style="font-size:11px" color="#000000" face="Arial"><a onclick="window.open(\''.$repertoire_installation.'date-picker.php?idcible=date&amp;mois='.$mois.'&amp;an='.$an.'&amp;langue='.$langue.'&amp;locataire='.$locataire.'&amp;logement='.$logement.'\',\'_blank\',\'toolbar=0, location=1, directories=0, status=0, scrollbars=0, resizable=1, copyhistory=0, menuBar=0, width=800, height=650, left=50, top=50\');return(false)" href="#"><font style="font-size: 12px" face=Arial>Choisir</font></a> ';

//*****************************************************************
// code pour ical
//*****************************************************************
if ($logement <> 0 ) {
	$temp1_ical =   $repertoire_installation."admin/fichier_calendrier/ical/".$logement.".ics";
	$temp2_ical =   $repertoire_installation."admin/fichier_calendrier/ical/".$logement.".ical";
	$adresse_ical =   $temp1_ical."   OU   ".$temp2_ical;
	}

	
?>
