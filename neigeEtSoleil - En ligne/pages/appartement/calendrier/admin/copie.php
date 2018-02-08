<?php
//***************************************************************************************************
// création fichier copier coller ******************************************************************
//***************************************************************************************************

//*************************************************************************************
// ce fichier doit être appelé de façcon sécurisé, sinon risque d'insertion code php
//*************************************************************************************

session_start();

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
 require("secure_genere.php");

$chemin_fichier = "fichier_calendrier/".$_POST['page_cible'].".html";

$file= fopen($chemin_fichier, "w");

fputs($file, stripslashes($_POST['texte']));

//fermeture du fichier
fclose($file);
 



?>