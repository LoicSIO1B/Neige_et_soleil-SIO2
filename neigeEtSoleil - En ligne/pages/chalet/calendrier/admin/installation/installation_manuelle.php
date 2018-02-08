<?php

session_start(); 

$affiche_info = '';

include("../fonction.php");

header( 'content-type: text/html; charset=ISO-8859-1' );

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Administration du calendrier des disponibilités</title>
<meta name="generator" content="WYSIWYG Web Builder - http://www.wysiwygwebbuilder.com">
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="installation_manuelle.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="container">
<table style="position:absolute;left:0px;top:81px;width:742px;height:1413px;z-index:12;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Form1" style="position:absolute;left:533px;top:150px;width:137px;height:36px;z-index:13;">
<form name="Form1" method="post" action="page7.php" id="Form1">
<input type="submit" id="Button1" name="" value="Retour" style="position:absolute;left:22px;top:4px;width:96px;height:25px;z-index:0;">
</form>
</div>
<div id="wb_Text1" style="position:absolute;left:24px;top:159px;width:487px;height:19px;z-index:14;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Cette page va vous aider à réaliser une installation manuelle </strong></span></div>
<table style="position:absolute;left:20px;top:196px;width:700px;height:416px;z-index:15;" cellpadding="5" cellspacing="1" id="Table2">
<tr>
<td class="cell0"><?php 

//étape installation *****************************************************
if ($_SESSION['format_donnees'] == 'avec') {
 
  echo ' - Créez la table dans votre base de données à l\'aide du fichier <a href="calendrier_reservation.sql" target="_blank" class ="style3">suivant</a><br> ';

}

  echo ' - Editez le fichier connexion.php, qui se trouve dans le répertoire admin/genere/, à l\'aide d\'un éditeur de texte (notepad) et renseignez les paramètres de connexion à la base de données. Attention !! : les paramètres sont cryptés, voici les informations à enregistrés dans le fichier :<br> <br> ';

if ($_SESSION['format_donnees'] == 'avec') {
  echo '@define ("hote_cal", \''.apos_var (Crypte(stripslashes($_SESSION['hote_cal']),"calendrier")).'\');<br>';
  echo '@define ("user_cal", \''.apos_var (Crypte(stripslashes($_SESSION['user_cal']),"calendrier")).'\');<br>';
  echo '@define ("password_cal", \''.apos_var (Crypte(stripslashes($_SESSION['password_cal']),"calendrier")).'\');<br>';
  echo '@define ("base_cal", \''.apos_var (Crypte(stripslashes($_SESSION['base_cal']),"calendrier")).'\');<br>';
  echo '@define ("nom_table_cal", \''.apos_var (Crypte(stripslashes($_SESSION['nom_table_cal']),"calendrier")).'\');<br><br>';
}
if ( $_SESSION['securise']) {
  echo '@define ("identifiant", \''.apos_var (stripslashes($_SESSION['identifiant'])).'\');<br>';
  echo '@define ("mot_de_passe", \''.apos_var (Crypte(stripslashes($_SESSION['mot_de_passe']),"calendrier")).'\');<br><br>';
}

  echo '@define ("MODE_DEMO", false) ;<br>';
if ($_SESSION['format_donnees'] == 'avec')
  echo '@define ("AVEC_BDD", true);<br>';
else
  echo '@define ("AVEC_BDD", false);<br>';
if ( $_SESSION['securise']) 
  echo '@define ("MODE_SECURE", true);<br>';
else
  echo '@define ("MODE_SECURE", false);<br>';
  echo '@define ("TOUJOURS_FALSE", false);<br><br>';

  echo '$numero_transaction = \''.apos_var (stripslashes($_SESSION['numero_transaction'])).'\';<br>';
  echo '$email_transaction = \''.apos_var (stripslashes($_SESSION['email'])).'\';<br>';
  echo '$avec_compression_page = false;<br><br>';

  echo ' - Editez le fichier parametres_calendrier.php, qui se trouve dans le répertoire admin/fichier_calendrier/, à l\'aide d\'un éditeur de texte (notepad) et renseignez les variables suivantes : <br> <br> ';

echo '$repertoire_installation = "'.$_SESSION['cfg_repertoire_installation'].'";<br>';
echo '$item1 = "'.guillet_var (stripslashes($_SESSION['cfg_item1'])).'";<br><br>';

  echo ' - Réalisez un chmod 777 sur les fichiers : , (<a href="http://www.mathieuweb.fr/calendrier/faq.php" target="_blank" class ="style3" >faire un chmod avec filezilla</a>)<br> <br> ';

  echo ' * calendrier_liste_couleur.php<br> ';
  echo ' * calendrier_liste_langue.php<br> ';
  echo ' * calendrier_liste_locataire.php<br> ';
  echo ' * calendrier_commentaire_locataire.php<br> ';
  echo ' * calendrier_liste_logement.php<br> ';
  echo ' * calendrier_date_mise_a_jour.php<br> ';
  echo ' * langue.php<br> ';
  echo ' * parametres_calendrier.php<br> ';
  echo ' * sauvegarde_calendrier_liste_couleur.php<br> ';
  echo ' * sauvegarde_calendrier_liste_langue.php<br> ';
  echo ' * sauvegarde_calendrier_liste_locataire.php<br> ';
  echo ' * sauvegarde_calendrier_commentaire_locataire.php<br> ';
  echo ' * sauvegarde_calendrier_liste_logement.php<br> ';
  echo ' * sauvegarde_langue.php<br> ';
  echo ' * sauvegarde_parametres_calendrier.php<br> ';
  echo ' * colle.html<br> ';
  echo ' * colle_memo.html<br> ';
  echo ' * calendrier_selection_utilisateur.php<br> ';
  echo ' * calendrier_export_locataire.csv<br> ';
  echo ' * calendrier_export_stat.csv<br> ';
  echo ' * sauvegarde_sql.sql<br> ';
  echo ' * style.css<br> ';
  echo ' * sauvegarde.zip<br> ';
  echo ' * sauvegarde_style.css<br><br> ';

  echo ' - Réalisez un chmod 777 sur les répertoires : , (<a href="http://www.mathieuweb.fr/calendrier/faq.php" target="_blank" class ="style3" >faire un chmod avec filezilla</a>)<br> <br> ';

  echo ' * fichier_calendrier<br> ';
  echo ' * img_cal<br> ';
  echo ' * template_cal<br> ';
if ($_SESSION['format_donnees'] <> 'avec') {
  echo ' * fichier_calendrier/dates_sans_bdd<br> ';
  echo ' * fichier_calendrier/ical<br> ';
}

echo '<br>';

  echo ' - <u>Après installation supprimez le répertoire installation</u> ';
?><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_MasterPage1" style="position:absolute;left:0px;top:0px;width:696px;height:80px;z-index:16;">
<div id="wb_Shape2" style="position:absolute;left:16px;top:33px;width:227px;height:44px;z-index:1;">
<img src="images/img0030.png" id="Shape2" alt="" style="width:227px;height:44px;"></div>
<div id="wb_Shape1" style="position:absolute;left:16px;top:22px;width:227px;height:23px;z-index:2;">
<img src="images/img0031.png" id="Shape1" alt="" style="width:227px;height:23px;"></div>
<div id="wb_Text3" style="position:absolute;left:237px;top:47px;width:341px;height:33px;text-align:right;z-index:3;">
<span style="color:#4B4B4B;font-family:'Arial Black';font-size:24px;"><strong>Installation du calendrier</strong></span></div>
<div id="Html2" style="position:absolute;left:244px;top:0px;width:120px;height:23px;z-index:4">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<div id="wb_Text2" style="position:absolute;left:76px;top:32px;width:135px;height:38px;text-align:center;z-index:5;">
<span style="color:#685F4A;font-family:'Arial Black';font-size:27px;">FACILE</span></div>
<div id="wb_Image1" style="position:absolute;left:30px;top:38px;width:42px;height:34px;z-index:6;">
<img src="images/img0484.png" id="Image1" alt=""></div>
<div id="wb_Text4" style="position:absolute;left:123px;top:59px;width:113px;height:15px;text-align:right;z-index:7;">
<span style="color:#4B4B4B;font-family:Arial;font-size:12px;"><strong>Calendrier php</strong></span></div>
<div id="wb_Image4" style="position:absolute;left:648px;top:0px;width:48px;height:48px;z-index:8;">
<img src="images/32_48x48.png" id="Image4" alt=""></div>
<div id="wb_Image5" style="position:absolute;left:648px;top:28px;width:48px;height:48px;z-index:9;">
<img src="images/document_library.png" id="Image5" alt=""></div>
<div id="wb_Image3" style="position:absolute;left:628px;top:21px;width:48px;height:48px;z-index:10;">
<img src="images/magic_wand.png" id="Image3" alt=""></div>
<div id="wb_Text1" style="position:absolute;left:18px;top:10px;width:231px;height:38px;z-index:11;text-align:left;">
<span style="color:#C0E37B;font-family:'Arial Black';font-size:27px;">Mon calendrier</span></div>
</div>
<div id="wb_Shape1" style="position:absolute;left:10px;top:99px;width:722px;height:50px;z-index:17;">
<img src="images/img0075.png" id="Shape1" alt="" style="width:722px;height:50px;"></div>
</div>
</body>
</html>