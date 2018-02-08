<?php

session_start();

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_connexion.php");

$affiche_info = '';
$val_commentaire = '';


$modif_ok = false;

// test si demande modif****************************************************************************
if ( isset($_POST['Modifier']) && ($_POST['Modifier']) == 'Modifier'  && !MODE_DEMO) {

  extract($_POST);

  $chemin_fichier = "fichier_calendrier/calendrier_commentaire_locataire.php";
  $chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_calendrier_commentaire_locataire.php";

  while (!isset($fin_tableau_commentaire_locataire) || !$fin_tableau_commentaire_locataire) {
  include ($chemin_fichier);
  if ( isset($fin_tableau_commentaire_locataire) && $fin_tableau_commentaire_locataire) {
     //sauvegarde ancien fichier*********************************
     @copy($chemin_fichier,$chemin_fichier_sauvegarde);
     $file= @fopen($chemin_fichier, "w");
     $fichier_libre = true;
     $fonction = 'Modifier';
  }

}

if ( $fichier_libre )
  //chemin vers le fichier de création liste des locataires/logements**********************************************************
  require("genere/genere_commentaire_locataire.php");

if ( isset($creation_reussi) && $creation_reussi )
    $affiche_info = "modif_ok" ;
else
   $affiche_info = "erreur_execution"; 

  $_GET['num'] = $val_id;


}

include ("fichier_calendrier/calendrier_commentaire_locataire.php");

//**************************************************************************************************
//controle des fichiers 
//**************************************************************************************************
if (!isset($fin_tableau_commentaire_locataire))
   $affiche_info = 'erreur_fichier_com_locataire';

if ( isset($_GET['num']) && is_numeric($_GET['num']) ) {
  
 $numero_locataire = $_GET['num'];
 $val_commentaire = (isset($commentaire_locataire[$numero_locataire]) ) ?$commentaire_locataire[$numero_locataire] : '';

}

//********************************************************************************
// controle mode démo ************************************************************
//********************************************************************************
  if ( ( (isset($_POST['Modifier'])) ||(isset($_POST['Effacer'])) ) && MODE_DEMO   )
     $affiche_info = 'mode_demo';
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Administration du calendrier des disponibilités</title>
<meta name="generator" content="WYSIWYG Web Builder - http://www.wysiwygwebbuilder.com">
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="affiche_commentaire.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="fichier_calendrier/styles.css?version=<?php echo filemtime('fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >
</head>
<body>
<div id="space"><br></div>
<div id="container">
<table style="position:absolute;left:3px;top:2px;width:797px;height:516px;z-index:3;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Form1" style="position:absolute;left:9px;top:43px;width:766px;height:465px;z-index:4;">
<form name="Form1" method="post" action="affiche_commentaire.php" id="Form1">
<input type="hidden" name="val_id" value="<?php echo $numero_locataire; ?>">
<input type="submit" id="Button1" name="Modifier" value="Modifier" style="position:absolute;left:49px;top:421px;width:96px;height:25px;z-index:0;">
<textarea name="commentaire" id="TextArea1" style="position:absolute;left:6px;top:6px;width:740px;height:402px;z-index:1;" rows="21" cols="72"><?php echo $val_commentaire; ?></textarea>
<input type="button" id="Button2" onclick="parent.parent.location = 'locataire.php' ;return false;" name="Fermer" value="Fermer" style="position:absolute;left:481px;top:421px;width:96px;height:25px;z-index:2;" tabindex="6">
</form>
</div>
<div id="wb_Image1" style="position:absolute;left:9px;top:2px;width:48px;height:48px;z-index:5;">
<img src="images/locataire_commentaire.png" id="Image1" alt=""></div>
<div id="Html2" style="position:absolute;left:67px;top:10px;width:120px;height:23px;z-index:6">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<div id="wb_Extension2" style="position:absolute;left:19px;top:467px;width:21px;height:21px;z-index:7;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Le champs commentaire vous permet d'indiquer toutes sortes de commentaires liées au lcataire:<br>
- complèment d'adresse<br>
- préférence du locataire<br>
- comportement<br>
etc....<br>
Cliquez sur le bouton fermer pour recharger la page après validation du formulaire.</font></em></a></div>
</div>
</body>
</html>