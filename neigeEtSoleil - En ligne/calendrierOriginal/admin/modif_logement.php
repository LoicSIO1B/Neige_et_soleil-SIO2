<?php
session_start();

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_connexion.php");

$nom_logement_temp = '';
$tarif_logement_temp = '';
$capacite_logement_temp = '';
$format_calendrier_logement_temp = '';
$texte_jour_debut_semaine_logement_temp = '';
$cle_nom_logement_modif = '';
$url_synchro_logement_modif = '';
$affiche_info = '';

// test si demande modification d'un locataire*****************************************************************************
if ( isset($_POST['Modifier']) && ($_POST['Modifier']) == 'Modifier' && !(empty($_POST['nom'])) && !MODE_DEMO) {

  //initialisation des variables*************************
  extract($_POST);

  $nom_logement[$cle_modif] = guillet_var ($nom) ; 
  $format_calendrier_logement[$cle_modif] = guillet_var ($format_calendrier) ; 
  $texte_jour_debut_semaine_logement[$cle_modif] = guillet_var ($texte_jour_debut_semaine) ; 
  $tarif_logement[$cle_modif] = guillet_var ($tarif) ;
  $capacite_logement[$cle_modif] = guillet_var ($capacite) ;
  //traitement url
  if ( strlen($url) > 5 ) {
     $url_synchro_logement[$cle_modif] = nl2array($url);
     }
  else {
     $url_synchro_logement[$cle_modif] = '' ;
     }
  

  //chemin vers le fichier de création liste des locataires/logements**********************************************************
  include("genere/genere_listes_logement.php");

if ( $creation_reussi )
    $affiche_info = "modif_ok" ;
else
   $affiche_info = "erreur_execution"; 

  $_GET['num'] = $cle_modif ;
  $_GET['fct'] = "modifier" ;
} 



// test si demande effacement d'un logement*****************************************************************************
if ( isset($_GET['fct']) && !is_numeric($_GET['fct']) &&  !(empty($_GET['fct'])) &&  isset($_GET['num']) && is_numeric($_GET['num']) ) {

  $num_supprime = $_GET['num'] ;
  $fonction = $_GET['fct'] ;

//fonction modifier **************************

if ( $fonction == 'modifier' ) {

 $nom_logement_temp = $nom_logement[$num_supprime]; 
 $format_calendrier_logement_temp = $format_calendrier_logement[$num_supprime]; 
 $tarif_logement_temp = $tarif_logement[$num_supprime]; 
 $texte_jour_debut_semaine_logement_temp = $texte_jour_debut_semaine_logement[$num_supprime];
 $cle_nom_logement_modif = $num_supprime;
 $capacite_logement_temp = $capacite_logement[$num_supprime];
 $url_synchro_logement_temp = (isset($url_explode) && is_array($url_explode) ) ? str_replace('"','',$url_explode) :((isset($url_synchro_logement[$num_supprime])) ? $url_synchro_logement[$num_supprime] : '' );
 }

} 

//********************************************************************************
// controle mode démo ************************************************************
//********************************************************************************
  if ( ( (isset($_POST['Modifier'])) ||(isset($_POST['Effacer'])) )&& MODE_DEMO  )
     $affiche_info = 'mode_demo';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Administration du calendrier des disponibilités</title>
<meta name="generator" content="WYSIWYG Web Builder - http://www.wysiwygwebbuilder.com">
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="modif_logement.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function ValidateForm1(theForm)
{
   var regexp;
   if (theForm.nom.value == "")
   {
      alert("Vous n'avez pas renseigné le nom du locataire!");
      theForm.nom.focus();
      return false;
   }
   if (theForm.nom.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le nom du locataire!");
      theForm.nom.focus();
      return false;
   }
   if (theForm.tarif.value.length < 0)
   {
      alert("Please enter at least 0 characters in the \"tarif\" field.");
      theForm.tarif.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.capacite.value))
   {
      alert("La capcité ne peut être qu'un nombre !");
      theForm.capacite.focus();
      return false;
   }
   if (theForm.capacite.value.length < 0)
   {
      alert("La capcité ne peut être qu'un nombre !");
      theForm.capacite.focus();
      return false;
   }
   return true;
}
</script>
<link rel="stylesheet" href="fichier_calendrier/styles.css?version=<?php echo filemtime('fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >


<script type="text/javascript" src="fonction.js"></script>
</head>
<body>
<div id="space"><br></div>
<div id="container">
<table style="position:absolute;left:5px;top:7px;width:695px;height:412px;z-index:16;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Form2" style="position:absolute;left:13px;top:64px;width:627px;height:340px;z-index:17;">
<form name="Form1" method="post" action="modif_logement.php" id="Form2" onsubmit="return ValidateForm1(this)">
<input type="hidden" name="cle_modif" value="<?php echo $cle_nom_logement_modif; ?>">
<input type="text" id="nom" onfocus="bordure_formulaire('nom','oui');return false;return false;" onblur="bordure_formulaire('nom','non');return false;return false;" style="position:absolute;left:194px;top:21px;width:392px;height:20px;line-height:20px;z-index:0;" name="nom" value="<?php echo html_ent($nom_logement_temp); ?>">
<input type="submit" id="Button1" name="Modifier" value="Modifier" style="position:absolute;left:193px;top:302px;width:96px;height:25px;z-index:1;">
<div id="Html3" style="position:absolute;left:24px;top:25px;width:167px;height:20px;z-index:2">
<?php
echo '<div id="wb_Text1" align="right"><font style="font-size:15px" color="#000000" face="Arial"><b>Nom ',$item1,'</b></font></div>'; 
?></div>
<input type="button" id="Button3" onclick="parent.parent.location = 'logement.php' ;return false;" name="" value="Fermer" style="position:absolute;left:475px;top:302px;width:96px;height:25px;z-index:3;" tabindex="6">
<div id="wb_Text2" style="position:absolute;left:18px;top:62px;width:170px;height:18px;text-align:right;z-index:4;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Format du calendrier</strong></span></div>
<div id="wb_Text1" style="position:absolute;left:3px;top:95px;width:185px;height:18px;text-align:right;z-index:5;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Commencé la semaine le</strong></span></div>
<select name="format_calendrier" size="1" id="Combobox2" style="position:absolute;left:194px;top:59px;width:277px;height:26px;z-index:6;" >
<option <?php if ( $format_calendrier_logement_temp == "calendrier_journalier" ) echo "selected"; ?> value="calendrier_journalier">Calendrier journalier</option>
<option <?php if ( $format_calendrier_logement_temp == "calendrier_compact" ) echo "selected"; ?> value="calendrier_compact">Calendrier compact</option>
<option <?php if ( $format_calendrier_logement_temp == "calendrier_developpe" ) echo "selected"; ?> value="calendrier_developpe">Calendrier développé</option>
<option <?php if ( $format_calendrier_logement_temp == "calendrier_periode" ) echo "selected"; ?> value="calendrier_periode">Calendrier période</option
>
</select>
<div id="wb_Text4" style="position:absolute;left:37px;top:162px;width:150px;height:18px;text-align:right;z-index:7;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Tarif</strong></span></div>
<input type="text" id="tarif" onfocus="bordure_formulaire('tarif','oui');return false;return false;" onblur="bordure_formulaire('tarif','non');return false;return false;" style="position:absolute;left:195px;top:158px;width:76px;height:20px;line-height:20px;z-index:8;" name="tarif" value="<?php echo htmlentities($tarif_logement_temp,ENT_HTML401,'ISO-8859-1'); ?>" tabindex="6">
<div id="wb_Text5" style="position:absolute;left:280px;top:163px;width:63px;height:18px;z-index:9;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>/ jour</strong></span></div>
<select name="texte_jour_debut_semaine" size="1" id="Combobox1" style="position:absolute;left:195px;top:92px;width:277px;height:26px;z-index:10;" >
<option <?php if ( $texte_jour_debut_semaine_logement_temp == "lundi" ) echo "selected"; ?> value="lundi">lundi</option>
<option <?php if ( $texte_jour_debut_semaine_logement_temp == "mardi" ) echo "selected"; ?> value="mardi">mardi</option>
<option <?php if ( $texte_jour_debut_semaine_logement_temp == "mercredi" ) echo "selected"; ?> value="mercredi">mercredi</option>
<option <?php if ( $texte_jour_debut_semaine_logement_temp == "jeudi" ) echo "selected"; ?> value="jeudi">jeudi</option>
<option <?php if ( $texte_jour_debut_semaine_logement_temp == "vendredi" ) echo "selected"; ?> value="vendredi">vendredi</option>
<option <?php if ( $texte_jour_debut_semaine_logement_temp == "samedi" ) echo "selected"; ?> value="samedi">samedi</option>
<option <?php if ( $texte_jour_debut_semaine_logement_temp == "dimanche" ) echo "selected"; ?> value="dimanche">dimanche</option>
</select>
<input type="text" id="capacite" onfocus="bordure_formulaire('capacite','oui');return false;return false;" onblur="bordure_formulaire('capacite','non');return false;return false;" style="position:absolute;left:195px;top:125px;width:76px;height:20px;line-height:20px;z-index:11;" name="capacite" value="<?php echo htmlentities($capacite_logement_temp,ENT_HTML401,'ISO-8859-1'); ?>" tabindex="6">
<div id="wb_Extension4" style="position:absolute;left:322px;top:162px;width:21px;height:21px;z-index:12;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Tarif de location moyen par jour et <b>par défaut </b>pour cette location.<br>
Le tarif peut être modifié directement sur le calendrier avant de marquer une nouvelle réservation.<br>
Ce tarif indiquée au moment de la création d'une réservation sur le calendrier sera utilisé pour calculer le chiffre d'affaire de la location.</font></em></a></div>
<div id="wb_ajout_logementText1" style="position:absolute;left:10px;top:192px;width:176px;height:36px;text-align:right;z-index:13;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Adresse web synchronisation</strong></span></div>
<textarea name="url" id="url" onfocus="bordure_formulaire('url','oui');return false;return false;" onblur="bordure_formulaire('url','non');return false;return false;" style="position:absolute;left:192px;top:192px;width:389px;height:86px;z-index:14;" rows="5" cols="75"><?php echo array2nl($url_synchro_logement_temp); ?></textarea>
<div id="wb_ajout_logementExtension1" style="position:absolute;left:596px;top:194px;width:21px;height:21px;z-index:15;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="color:#000000;font-family:ms shell dlg;font-size:13px">Le programme permet de synchroniser le calendrier de cette ressource avec un ou plusieurs autre calendrier se trouvant sur d'autres sites internet, permettant ainsi la mise à jour automatique et synchronisée de tous les calendriers .<br>
</font><font style="color:#FF0000;font-family:ms shell dlg;font-size:13px">Veuillez indiquer une adresse url par ligne.</font></em></a></div>
</form>
</div>
<div id="wb_Image2" style="position:absolute;left:11px;top:11px;width:48px;height:48px;z-index:18;">
<img src="images/location_change.png" id="Image2" alt=""></div>
<div id="Html2" style="position:absolute;left:74px;top:15px;width:120px;height:23px;z-index:19">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<div id="wb_Text3" style="position:absolute;left:51px;top:194px;width:150px;height:18px;text-align:right;z-index:20;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Capacité</strong></span></div>
<div id="wb_Text6" style="position:absolute;left:292px;top:195px;width:90px;height:18px;z-index:21;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>personnes</strong></span></div>
<div id="wb_Extension5" style="position:absolute;left:389px;top:195px;width:21px;height:21px;z-index:22;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Capacité en nombre de personnes poucette location.<br>
La capacité peut être utilisée dans le module de recherche disponibilité.</font></em></a></div>
<div id="wb_Extension6" style="position:absolute;left:488px;top:159px;width:21px;height:21px;z-index:23;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Pour cette location, jour début de semaine pour les formats calendrier journalier et période.</font></em></a></div>
<div id="wb_Extension1" style="position:absolute;left:489px;top:125px;width:21px;height:21px;z-index:24;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Vous pouvez choisir le format du calendrier pour cette location, chaque locations pouvant avoir un format de calendrier différent.<br>
Format possible :<br>
- Calendrier journalier : calendrier classique affichant un tableau par mois<br>
- Calendrier compact : 1 seul tableau calendrier pour afficher plusieurs mois<br>
- Calendrier developpé : calendrier style &quot;papier&quot;, un tableau par mois, avec possibilité de mettre du texte visible directement pour chaque jour<br>
- Calendrier période : pour des locations unqiuement à la semaine, un tableau par mois.</font></em></a></div>
<div id="wb_Extension2" style="position:absolute;left:610px;top:87px;width:21px;height:21px;z-index:25;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Vous pouvez créer autant de locations que vous désirez.<br>
Il y aura un calendrier associé à chaques locations ( voir Page code).</font></em></a></div>
</div>
</body>
</html>