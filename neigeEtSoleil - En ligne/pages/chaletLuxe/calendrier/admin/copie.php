<?php
//***************************************************************************************************
// cr�ation fichier copier coller ******************************************************************
//***************************************************************************************************

//*************************************************************************************
// ce fichier doit �tre appel� de fa�con s�curis�, sinon risque d'insertion code php
//*************************************************************************************

session_start();

// chemin vers le fichier  config.inc.php param�trews de connection � la base de donn�es*************
 require("secure_genere.php");

$chemin_fichier = "fichier_calendrier/".$_POST['page_cible'].".html";

$file= fopen($chemin_fichier, "w");

fputs($file, stripslashes($_POST['texte']));

//fermeture du fichier
fclose($file);
 



?>