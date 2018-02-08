<?php

$creation_reussi = false;

//chemin fichier parametre du calendrier********************************************************
     include("fichier_calendrier/parametres_calendrier.php");

//chemin vers le fichier de fonctions**********************************************************
     include("fonction.php");
     include("fichier_calendrier/calendrier_liste_couleur.php");

//modifier les paramètres de connection à la base de données*******************************************************
if ( isset($_POST['Installer']) && ($_POST['Installer']) == 'Installer'  ) {
     extract($_POST);

  //chemin vers le fichier de création **********************************************************
  include("genere_config.php");

 //chemin vers le fichier de connection**********************************************************
     include("connexion.php");

  // activation des sessions d'indentification **************************************************
  $mot_de_passe_decrypt = Decrypte($mot_de_passe,$Cle);
  $_SESSION['id_connexion'] = $identifiant;
  $_SESSION['mdp'] = $mot_de_passe_decrypt;
  include("genere_para_calendrier.php");

  $connect = @mysql_connect(Decrypte($hote_cal,$Cle), Decrypte($user_cal,$Cle), Decrypte($password_cal,$Cle)) ;

  // on choisit la bonne base
  @mysql_select_db(Decrypte($base_cal,$Cle), $connect) ;

$query = "CREATE TABLE IF NOT EXISTS `".Decrypte($nom_table_cal,$Cle)."` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_reservation` date NOT NULL,
  `couleur` text NOT NULL,
  `couleur_texte` text NOT NULL,
  `id_logement` int(11) NOT NULL,
  `id_locataire` bigint(20) NOT NULL,
  `tarif` tinytext NOT NULL,
  `commentaires` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

 $creation_reussi = mysql_query($query)  ;

// on ferme la base
mysql_close();
 
 if ( $creation_reussi ) 
    header('Location: reussi.php');
 else
    header('Location: echec.php');
}  

//chemin vers le fichier de connection**********************************************************
 include("connexion.php");



?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Administration du calendrier des disponibilités</title>
<meta name="generator" content="WYSIWYG Web Builder - http://www.wysiwygwebbuilder.com">
<style type="text/css">
div#container
{
   width: 910px;
   position: relative;
   margin-top: 0px;
   margin-left: auto;
   margin-right: auto;
   text-align: left;
}
</style>
<style type="text/css">
body
{
   text-align: center;
   margin: 0;
   background-color: #DED7B5;
   background-image: url(images/img0056.gif);
   background-repeat: repeat-x;
   color: #000000;
   scrollbar-face-color: #ECE9D8;
   scrollbar-arrow-color: #000000;
   scrollbar-3dlight-color: #ECE9D8;
   scrollbar-darkshadow-color: #716F64;
   scrollbar-highlight-color: #FFFFFF;
   scrollbar-shadow-color: #ACA899;
   scrollbar-track-color: #D4D0C8;
}
</style>
<style type="text/css">
a
{
   color: #DBE4EE;
}
a:hover
{
   color: #0000FF;
}
a.style3:link
{
   color: #FFFFFF;
   background: #00C4FD;
}
a.style3:visited
{
   color: #FFFFFF;
   background: #00C4FD;
   text-decoration: underline;
}
a.style3:active
{
   color: #FFFFFF;
   background: #00C4FD;
   text-decoration: underline;
}
a.style3:hover
{
   color: #00C4FD;
   background: #FFFFFF;
   text-decoration: underline;
}
a.style_lien:link
{
   color: #A07217;
}
a.style_lien:visited
{
   color: #A07217;
   text-decoration: underline;
}
a.style_lien:active
{
   color: #A07217;
   text-decoration: underline;
}
a.style_lien:hover
{
   color: #A07217;
   text-decoration: underline;
}
</style>
<script type="text/javascript">
<!--
function ValidateForm1(theForm)
{
if (theForm.hote.value == "")
{
   alert("Vous n'avez pas renseigné le nom du serveur host de la base de données!");
   theForm.hote.focus();
   return false;
}
if (theForm.hote.value.length < 1)
{
   alert("Vous n'avez pas renseigné le nom du serveur host de la base de données!");
   theForm.hote.focus();
   return false;
}
if (theForm.base.value == "")
{
   alert("Vous n'avez pas renseigné le nom de la base de données!");
   theForm.base.focus();
   return false;
}
if (theForm.base.value.length < 1)
{
   alert("Vous n'avez pas renseigné le nom de la base de données!");
   theForm.base.focus();
   return false;
}
if (theForm.user.value == "")
{
   alert("Vous n'avez pas renseigné le nom d'utilisateur!");
   theForm.user.focus();
   return false;
}
if (theForm.user.value.length < 1)
{
   alert("Vous n'avez pas renseigné le nom d'utilisateur!");
   theForm.user.focus();
   return false;
}
var strFilter = /^[A-Za-zƒŠŒŽšœžŸÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ0-9-_]*$/;
var chkVal = theForm.Editbox1.value;
if (!strFilter.test(chkVal))
{
   alert("Vous n'avez pas ou mal renseigné le nom de la table, lettres, chiffres, ou _ autorisé, pas d'espace!");
   theForm.Editbox1.focus();
   return false;
}
var strFilter = /^[A-Za-zƒŠŒŽšœžŸÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ \t\r\n\f0-9-'_-]*$/;
var chkVal = theForm.Editbox2.value;
if (!strFilter.test(chkVal))
{
   alert("Vous n'avez pas ou mal renseigné le nom du type de bien en location, lettres, chiffres espace  ' _ - autorisés.");
   theForm.Editbox2.focus();
   return false;
}
if (theForm.Editbox2.value == "")
{
   alert("Vous n'avez pas ou mal renseigné le nom du type de bien en location, lettres, chiffres espace  ' _ - autorisés.");
   theForm.Editbox2.focus();
   return false;
}
if (theForm.Editbox2.value.length < 1)
{
   alert("Vous n'avez pas ou mal renseigné le nom du type de bien en location, lettres, chiffres espace  ' _ - autorisés.");
   theForm.Editbox2.focus();
   return false;
}
var strFilter = /^[A-Za-zƒŠŒŽšœžŸÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ \t\r\n\f0-9-'_-]*$/;
var chkVal = theForm.Editbox3.value;
if (!strFilter.test(chkVal))
{
   alert("Vous n'avez pas ou mal renseigné l'identifiant de connexion, lettres, chiffres espace  ' _ - autorisés.");
   theForm.Editbox3.focus();
   return false;
}
if (theForm.Editbox3.value == "")
{
   alert("Vous n'avez pas ou mal renseigné l'identifiant de connexion, lettres, chiffres espace  ' _ - autorisés.");
   theForm.Editbox3.focus();
   return false;
}
if (theForm.Editbox3.value.length < 1)
{
   alert("Vous n'avez pas ou mal renseigné l'identifiant de connexion, lettres, chiffres espace  ' _ - autorisés.");
   theForm.Editbox3.focus();
   return false;
}
var strFilter = /^[A-Za-zƒŠŒŽšœžŸÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ \t\r\n\f0-9-'_-]*$/;
var chkVal = theForm.Editbox4.value;
if (!strFilter.test(chkVal))
{
   alert("Vous n'avez pas ou mal renseigné le mot de passe, lettres, chiffres espace  ' _ - autorisés.");
   theForm.Editbox4.focus();
   return false;
}
if (theForm.Editbox4.value == "")
{
   alert("Vous n'avez pas ou mal renseigné le mot de passe, lettres, chiffres espace  ' _ - autorisés.");
   theForm.Editbox4.focus();
   return false;
}
if (theForm.Editbox4.value.length < 1)
{
   alert("Vous n'avez pas ou mal renseigné le mot de passe, lettres, chiffres espace  ' _ - autorisés.");
   theForm.Editbox4.focus();
   return false;
}
return true;
}
//-->
</script>
<script type="text/javascript">
<!--
function popupwnd(url, toolbar, menubar, locationbar, resize, scrollbars, statusbar, left, top, width, height)
{
   var popupwindow = this.open(url, '', 'toolbar=' + toolbar + ',menubar=' + menubar + ',location=' + locationbar + ',scrollbars=' + scrollbars + ',resizable=' + resize + ',status=' + statusbar + ',left=' + left + ',top=' + top + ',width=' + width + ',height=' + height);
}
//-->
</script>
</head>
<body>
<div id="container">
<table style="position:absolute;left:0px;top:8px;width:914px;height:1095px;z-index:18;border:1px #C0C0C0 solid;background-color:#F8F8F8;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td align="left" valign="top" bgcolor="#FDFDFD" style="border:1px #C0C0C0 solid;height:1079px;">
&nbsp;</td>
</tr>
</table>
<table style="position:absolute;left:6px;top:706px;width:896px;height:110px;z-index:19;background-color:#DBE4EE;" cellpadding="0" cellspacing="1" id="Table4">
<tr>
<td align="left" valign="top" style="height:108px;">
&nbsp;</td>
</tr>
</table>
<table style="position:absolute;left:6px;top:532px;width:896px;height:74px;z-index:20;background-color:#DBE4EE;" cellpadding="0" cellspacing="1" id="Table3">
<tr>
<td align="left" valign="top" style="height:72px;">
&nbsp;</td>
</tr>
</table>
<table style="position:absolute;left:6px;top:214px;width:896px;height:190px;z-index:21;background-color:#DBE4EE;" cellpadding="0" cellspacing="1" id="Table2">
<tr>
<td align="left" valign="top" style="height:188px;">
&nbsp;</td>
</tr>
</table>
<div id="wb_Form2" style="position:absolute;left:16px;top:228px;width:865px;height:640px;z-index:22">
<form name="Form1" method="post" action="install.php" id="Form2" onsubmit="return ValidateForm1(this)">
<div id="wb_Text1" style="margin:0;padding:0;position:absolute;left:3px;top:13px;width:286px;height:18px;text-align:right;z-index:0;">
<font style="font-size:15px" color="#000000" face="Arial"><b>Nom du serveur de la base de données</b></font></div>
<input type="text" id="hote" style="position:absolute;left:302px;top:9px;width:418px;height:22px;font-family:Courier New;font-size:16px;z-index:1" name="hote_cal" value="<?php echo Decrypte($hote_cal,$Cle); ?>">
<div id="wb_Text4" style="margin:0;padding:0;position:absolute;left:3px;top:43px;width:286px;height:18px;text-align:right;z-index:2;">
<font style="font-size:15px" color="#000000" face="Arial"><b>Nom de la base de données</b></font></div>
<input type="text" id="base" style="position:absolute;left:302px;top:39px;width:418px;height:22px;font-family:Courier New;font-size:16px;z-index:3" name="base_cal" value="<?php echo Decrypte($base_cal,$Cle); ?>">
<input type="text" id="user" style="position:absolute;left:302px;top:70px;width:418px;height:22px;font-family:Courier New;font-size:16px;z-index:4" name="user_cal" value="<?php echo Decrypte($user_cal,$Cle); ?>">
<div id="wb_Text5" style="margin:0;padding:0;position:absolute;left:3px;top:74px;width:286px;height:18px;text-align:right;z-index:5;">
<font style="font-size:15px" color="#000000" face="Arial"><b>Nom d'utilisateur</b></font></div>
<div id="wb_Text6" style="margin:0;padding:0;position:absolute;left:3px;top:103px;width:286px;height:18px;text-align:right;z-index:6;">
<font style="font-size:15px" color="#000000" face="Arial"><b>Mot de passe</b></font></div>
<input type="password" id="password" style="position:absolute;left:302px;top:99px;width:418px;height:22px;font-family:Courier New;font-size:16px;z-index:7" name="password_cal" value="<?php echo Decrypte($password_cal,$Cle); ?>">
<div id="wb_Text8" style="margin:0;padding:0;position:absolute;left:3px;top:136px;width:286px;height:18px;text-align:right;z-index:8;">
<font style="font-size:15px" color="#000000" face="Arial"><b>Nom de la table</b></font></div>
<input type="text" id="Editbox1" style="position:absolute;left:302px;top:132px;width:418px;height:22px;font-family:Courier New;font-size:16px;z-index:9" name="nom_table_cal" value="<?php echo Decrypte($nom_table_cal,$Cle); ?>">
<input type="submit" id="Button2" name="Installer" value="Installer" style="position:absolute;left:646px;top:603px;width:96px;height:25px;background-color:#00C4FD;color:#FFFFFF;font-family:Arial;font-size:13px;z-index:10">
<div id="wb_Text12" style="margin:0;padding:0;position:absolute;left:3px;top:333px;width:286px;height:18px;text-align:right;z-index:11;">
<font style="font-size:15px" color="#000000" face="Arial"><b>Libellé du type de bien en location</b></font></div>
<input type="text" id="Editbox2" style="position:absolute;left:302px;top:329px;width:418px;height:22px;font-family:Courier New;font-size:16px;z-index:12" name="item1" value="<?php echo $item1; ?>">
<div id="wb_Text14" style="margin:0;padding:0;position:absolute;left:725px;top:334px;width:21px;height:19px;text-align:left;z-index:13;">
<font style="font-size:16px" color="#000000" face="Arial"><b><a href="javascript:popupwnd('aide_calendrier.php?id=32','no','no','no','yes','yes','no','50','50','700','750')" target="_self" class="style3">?</a></b></font></div>
<div id="wb_Text16" style="margin:0;padding:0;position:absolute;left:3px;top:501px;width:286px;height:18px;text-align:right;z-index:14;">
<font style="font-size:15px" color="#000000" face="Arial"><b>Identifiant</b></font></div>
<input type="text" id="Editbox3" style="position:absolute;left:302px;top:497px;width:418px;height:22px;font-family:Courier New;font-size:16px;z-index:15" name="identifiant" value="<?php echo $identifiant; ?>">
<div id="wb_Text18" style="margin:0;padding:0;position:absolute;left:3px;top:539px;width:286px;height:18px;text-align:right;z-index:16;">
<font style="font-size:15px" color="#000000" face="Arial"><b>Mot de passe</b></font></div>
<input type="text" id="Editbox4" style="position:absolute;left:302px;top:535px;width:418px;height:22px;font-family:Courier New;font-size:16px;z-index:17" name="mot_de_passe" value="<?php echo Decrypte($mot_de_passe,$Cle);  ?>">
</form>
</div>
<div id="wb_Text3" style="margin:0;padding:0;position:absolute;left:13px;top:29px;width:558px;height:19px;text-align:left;z-index:23;">
<font style="font-size:16px" color="#00C4FD" face="Arial"><b>Installation automatique du script du calendrier des disponibilités</b></font></div>
<hr id="Line2" style="color:#00C4FD;background-color:#00C4FD;border:0px;margin:0;padding:0;position:absolute;left:12px;top:49px;width:890px;height:4px;z-index:24">
<div id="wb_Text2" style="margin:0;padding:0;position:absolute;left:11px;top:128px;width:851px;height:54px;text-align:left;z-index:25;">
<font style="font-size:16px" color="#000000" face="Verdana"><b>Pour faire fonctionner le calendrier , vous devez avoir&nbsp; une base de données mysql.<br>
Remplissez le formulaire ci dessous avec vos paramètres de connexion.<br>
Cette page va créer une table dans votre base de données.</b></font></div>
<div id="wb_Text7" style="margin:0;padding:0;position:absolute;left:13px;top:191px;width:429px;height:19px;text-align:left;z-index:26;">
<font style="font-size:16px" color="#00C4FD" face="Arial"><b>Paramètres de connexion à votre base de données</b></font></div>
<div id="wb_Text9" style="margin:0;padding:0;position:absolute;left:13px;top:868px;width:429px;height:19px;text-align:left;z-index:27;">
<font style="font-size:16px" color="#00C4FD" face="Arial"><b>Ou installation manuelle</b></font></div>
<hr id="Line3" style="color:#00C4FD;background-color:#00C4FD;border:0px;margin:0;padding:0;position:absolute;left:12px;top:890px;width:890px;height:4px;z-index:28">
<div id="wb_Text10" style="margin:0;padding:0;position:absolute;left:14px;top:918px;width:851px;height:72px;text-align:left;z-index:29;">
<font style="font-size:16px" color="#000000" face="Verdana"><b>Si vous préférez, vous pouvez faire une installation manuelle du script, pour cela cliquez sur le lien ci dessous :<br>
<br>
&gt; <a href="./installation_manuelle.html" class="style3">Installation manuelle</a></b></font></div>
<div id="wb_Text11" style="margin:0;padding:0;position:absolute;left:9px;top:411px;width:851px;height:80px;text-align:left;z-index:30;">
<font style="font-size:13px" color="#000000" face="Verdana"><b>Le calendrier permet de faire une gestion par locataire, mais également par type de bien en location, indiquez ci dessous le libéllé du <u>type</u> de bien en location, utilisez un terme générique de votre type de bien<br>
ex : location de logements , indiquer : Logements<br>
&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; location de salles, indiquer : Salles <br>
Vous pourrez par la suite créer tous les biens associés à ce type de location (gîte bleu, gîte rouge, etc..)</b></font></div>
<div id="wb_Text13" style="margin:0;padding:0;position:absolute;left:13px;top:502px;width:429px;height:19px;text-align:left;z-index:31;">
<font style="font-size:16px" color="#00C4FD" face="Arial"><b>Libéllé du type de bien en location</b></font></div>
<div id="wb_Text15" style="margin:0;padding:0;position:absolute;left:13px;top:626px;width:429px;height:19px;text-align:left;z-index:32;">
<font style="font-size:16px" color="#00C4FD" face="Arial"><b>Paramètres de connexion à l'espace administrateur</b></font></div>
<div id="wb_Text17" style="margin:0;padding:0;position:absolute;left:13px;top:652px;width:851px;height:48px;text-align:left;z-index:33;">
<font style="font-size:13px" color="#000000" face="Verdana"><b>L'accès à votre espace administrateur du calendrier est protégé par des sessions serveur, définissez un identifiant et mot de passe pour vous connecter ( utilisez des identifiants simple et qui vous sont famillier, respecter les majuscules et minuscules).</b></font></div>
<table style="position:absolute;left:11px;top:56px;width:886px;height:62px;z-index:34;border:2px #C0C0C0 solid;background-color:#FF8080;" cellpadding="5" cellspacing="1" id="Table5">
<tr>
<td align="center" valign="middle" style="border:1px #C0C0C0 solid;height:44px;">
<font style="font-size:16px" color="#FFFFFF" face="Arial"><b>Une license est valable pour un seul&nbsp; nom de domaine!<br>
<a href="http://www.mathieuweb.fr/calendrier/telecharger-calendrier.php" target="_blank" class="style_lien">Cliquez ici pour acheter une nouvelle license</a></b></font></td>
</tr>
</table>
</div>
</body>
</html>