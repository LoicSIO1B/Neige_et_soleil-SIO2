<?php

//d�claration des noms des mois et jours en Fran�ais************************************************ 
$mois_fr           = Array ( "", "Janvier", "F�vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "D�cembre" );
$jour_fr           = Array ( "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa", "Di" , "S" );
$texte_jour_fr     = Array ( "dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche" );
$texte_label_fr    = Array ( "Sem.", "Du", "Au", "P�riode", "Derni�re mise � jour :" );
//d�claration des noms des mois et jours en Allemand************************************************ 
$mois_all           = Array ( "", "Januar", "Februar", "M�rz", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember" );
$jour_all           = Array ( "So", "Mo", "Di", "Mi", "Do", "Fr", "Sa", "So" , "W" );
$texte_label_all    = Array ( "W", "Vom", "bis", "Zeitraum", "Letzten Aktualisierung :" );
//d�claration des noms des mois et jours en Anglais************************************************ 
$mois_eng           = Array ( "", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" );
$jour_eng           = Array ( "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su" , "W" );
$texte_label_eng    = Array ( "W", "From", "To", "Period", "Last update :" );
//d�claration des noms des mois et jours en Italien************************************************ 
$mois_it           = Array ( "", "Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre" );
$jour_it           = Array ( "Do", "Lu", "Ma", "Me", "Gi", "Ve", "Sa", "Do" , "S" );
$texte_label_it    = Array ( "S", "Dal", "-", "Periodo", "Ultimo aggiornamento : " );
//d�claration des noms des mois et jours en Espagnol************************************************ 
$mois_esp           = Array ( "", "Enero", "FebreroO", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" );
$jour_esp           = Array ( "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do" , "S" );
$texte_label_esp    = Array ( "S", "Del", "al", "Periodo", "Ultima actualizaci�n : " );
//d�claration des noms des mois et jours en N�erlandais************************************************ 
$mois_nl           = Array ( "", "Januari", "Februari", "Maart", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "December" );
$jour_nl           = Array ( "Zo", "Ma", "Di", "Wo", "Do", "Vr", "Za", "Zo" , "W" );
$texte_label_nl    = Array ( "W", "Vanaf", " - ", "Periode", "Laatste update : " );

//langue par d�faut********************************************************************************* 
if ( !(isset($_SESSION['langue'])) || ((empty($_SESSION['langue']))) )
$langue = 'fr' ;
//controle si choix de la langue dans l'url********************************************************* 
if ( (isset($_GET['langue'])) && (!(empty($_GET['langue']))) ) 
    $_SESSION['langue'] = $_GET['langue'] ; 
//si session langue existe alors la langue de la session devient prioritaire************************
if ( (isset($_SESSION['langue'])) && (!(empty($_SESSION['langue']))) )  
   $langue = $_SESSION['langue'];   

//s�lection des tableaux suivant la langue choisie**************************************************
if ( $langue == 'fr' ) { 
     $mois_texte = $mois_fr ;
     $jour_texte = $jour_fr ;
     $texte_label = $texte_label_fr ; }
if ( $langue == 'all' ) { 
     $mois_texte = $mois_all ;
     $jour_texte = $jour_all ;
     $texte_label = $texte_label_all ; }
if ( $langue == 'eng' ) { 
     $mois_texte = $mois_eng ;
     $jour_texte = $jour_eng ;
     $texte_label = $texte_label_eng ; }
if ( $langue == 'it' ) { 
     $mois_texte = $mois_it ;
     $jour_texte = $jour_it ;
     $texte_label = $texte_label_it ; }
if ( $langue == 'esp' ) { 
     $mois_texte = $mois_esp ;
     $jour_texte = $jour_esp ;
     $texte_label = $texte_label_esp ; }
if ( $langue == 'nl' ) { 
     $mois_texte = $mois_nl ;
     $jour_texte = $jour_nl ;
     $texte_label = $texte_label_nl ; }

?>