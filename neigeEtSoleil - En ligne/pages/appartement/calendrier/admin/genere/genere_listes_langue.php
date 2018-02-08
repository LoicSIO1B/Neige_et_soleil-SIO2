<?php
// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_genere.php");

//***************************************************************************************************
// création fichier des langues ******************************************************************
//***************************************************************************************************

$chemin_fichier = "fichier_calendrier/calendrier_liste_langue.php";
$chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_calendrier_liste_langue.php";

//sauvegarde ancien fichier*********************************
@copy($chemin_fichier,$chemin_fichier_sauvegarde);


$file= @fopen($chemin_fichier, "w");

  @fputs($file, "<?php");
  @fputs($file, "\n");
  @fputs($file, "\n");


 $nb_result = count ($nom_langue);
 if ( $nb_result > 0 ) {
 foreach ($nom_langue as $cle => $val_langue )  {
      @fputs($file, '$nom_langue["'.$cle.'"]= "'.guillet_var ($nom_langue[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$lundi["'.$cle.'"]= "'.guillet_var ($lundi[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$mardi["'.$cle.'"]= "'.guillet_var ($mardi[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$mercredi["'.$cle.'"]= "'.guillet_var ($mercredi[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$jeudi["'.$cle.'"]= "'.guillet_var ($jeudi[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$vendredi["'.$cle.'"]= "'.guillet_var ($vendredi[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$samedi["'.$cle.'"]= "'.guillet_var ($samedi[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$dimanche["'.$cle.'"]= "'.guillet_var ($dimanche[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$semaine["'.$cle.'"]= "'.guillet_var ($semaine[$cle]).'" ;' );
      @fputs($file, "\n");                  
      @fputs($file, '$janvier["'.$cle.'"]= "'.guillet_var ($janvier[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$fevrier["'.$cle.'"]= "'.guillet_var ($fevrier[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$mars["'.$cle.'"]= "'.guillet_var ($mars[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$avril["'.$cle.'"]= "'.guillet_var ($avril[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$mai["'.$cle.'"]= "'.guillet_var ($mai[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$juin["'.$cle.'"]= "'.guillet_var ($juin[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$juillet["'.$cle.'"]= "'.guillet_var ($juillet[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$aout["'.$cle.'"]= "'.guillet_var ($aout[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$septembre["'.$cle.'"]= "'.guillet_var ($septembre[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$octobre["'.$cle.'"]= "'.guillet_var ($octobre[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$novembre["'.$cle.'"]= "'.guillet_var ($novembre[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$decembre["'.$cle.'"]= "'.guillet_var ($decembre[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$periode["'.$cle.'"]= "'.guillet_var ($periode[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$du["'.$cle.'"]= "'.guillet_var ($du[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$au["'.$cle.'"]= "'.guillet_var ($au[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$maj["'.$cle.'"]= "'.guillet_var ($maj[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, '$semaine_periode["'.$cle.'"]= "'.guillet_var ($semaine_periode[$cle]).'" ;' );
      @fputs($file, "\n");
      @fputs($file, "\n");
   }
 }
 

  @fputs($file, "\n");

  @fputs($file, "?>");

//fermeture du fichier
 fclose($file);
 

//***************************************************************************************************
// création fichier des listes **********************************************************************
//***************************************************************************************************

include("fichier_calendrier/calendrier_liste_langue.php");

$chemin_fichier = "fichier_calendrier/langue.php";
$chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_langue.php";

//sauvegarde ancien fichier*********************************
copy($chemin_fichier,$chemin_fichier_sauvegarde);


$file= fopen($chemin_fichier, "w");

  @fputs($file, "<?php");
  @fputs($file, "\n");
  @fputs($file, "\n");


 $nb_result = count ($nom_langue);
 if ( $nb_result > 0 ) {
 foreach ($nom_langue as $cle => $val_langue )  {
      @fputs($file, '//déclaration des noms des mois et jours en '.$val_langue.'************************************************ ');
      @fputs($file, "\n");
      @fputs($file, '$mois_'.$cle.'           = Array ( "", "'.$janvier[$cle].'", "'.$fevrier[$cle].'", "'.$mars[$cle].'", "'.$avril[$cle].'", "'.$mai[$cle].'", "'.$juin[$cle].'", "'.$juillet[$cle].'", "'.$aout[$cle].'", "'.$septembre[$cle].'", "'.$octobre[$cle].'", "'.$novembre[$cle].'", "'.$decembre[$cle].'" );' );
      @fputs($file, "\n");
      @fputs($file, '$jour_'.$cle.'           = Array ( "'.$dimanche[$cle].'", "'.$lundi[$cle].'", "'.$mardi[$cle].'", "'.$mercredi[$cle].'", "'.$jeudi[$cle].'", "'.$vendredi[$cle].'", "'.$samedi[$cle].'", "'.$dimanche[$cle].'" , "'.$semaine[$cle].'" );' );
      @fputs($file, "\n");
   if ( $cle == 'fr' ) {
      @fputs($file, '$texte_jour_fr     = Array ( "dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche" );');
      @fputs($file, "\n");
      }
      @fputs($file, '$texte_label_'.$cle.'    = Array ( "'.$semaine_periode[$cle].'", "'.$du[$cle].'", "'.$au[$cle].'", "'.$periode[$cle].'", "'.$maj[$cle].'" );');
      @fputs($file, "\n");

   }
 }
      @fputs($file, "\n");
      @fputs($file, '//langue par défaut********************************************************************************* ');
      @fputs($file, "\n");
      @fputs($file, 'if ( !(isset($_SESSION[\'langue\'])) || ((empty($_SESSION[\'langue\']))) )');
      @fputs($file, "\n");
      @fputs($file, '$langue = \'fr\' ;');
      @fputs($file, "\n");
      @fputs($file, '//controle si choix de la langue dans l\'url********************************************************* ');
      @fputs($file, "\n");
      @fputs($file, 'if ( (isset($_GET[\'langue\'])) && (!(empty($_GET[\'langue\']))) ) ');
      @fputs($file, "\n");
      @fputs($file, '    $_SESSION[\'langue\'] = $_GET[\'langue\'] ; ');
      @fputs($file, "\n");
      @fputs($file, '//si session langue existe alors la langue de la session devient prioritaire************************');
      @fputs($file, "\n");
      @fputs($file, 'if ( (isset($_SESSION[\'langue\'])) && (!(empty($_SESSION[\'langue\']))) )  ');
      @fputs($file, "\n");
      @fputs($file, '   $langue = $_SESSION[\'langue\'];   ');
      @fputs($file, "\n");
      @fputs($file, "\n");
      @fputs($file, '//sélection des tableaux suivant la langue choisie**************************************************');
      @fputs($file, "\n");

 $nb_result = count ($nom_langue);
 if ( $nb_result > 0 ) {
 foreach ($nom_langue as $cle => $val_langue )  {
      @fputs($file, 'if ( $langue == \''.$cle.'\' ) { ');
      @fputs($file, "\n");
      @fputs($file, '     $mois_texte = $mois_'.$cle.' ;' );
      @fputs($file, "\n");
      @fputs($file, '     $jour_texte = $jour_'.$cle.' ;' );
      @fputs($file, "\n");
      @fputs($file, '     $texte_label = $texte_label_'.$cle.' ; }');
      @fputs($file, "\n");

   }
 }

  @fputs($file, "\n");

$creation_reussi = @fputs($file, "?>");

//fermeture du fichier
$creation_reussi = @fclose($file);
?>