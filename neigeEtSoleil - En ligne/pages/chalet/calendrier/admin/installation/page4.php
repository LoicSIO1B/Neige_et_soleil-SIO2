<?php

session_start(); 
header( 'content-type: text/html; charset=ISO-8859-1' );
include("../fonction.php");

$affiche_info = '';
$_SESSION['page4'] = false;

//************************************************************
// condition retour page 1
//************************************************************

if ( !(isset($_SESSION['page1'])) || !($_SESSION['page1']) || !(isset($_SESSION['numero_transaction'])) || !(isset($_SESSION['email']))  || !(isset($_SESSION['page2'])) || !($_SESSION['page2']) ) {

   header('Location: index.php?erreur=var_sessions');
   exit;
   }

if ( isset($_POST['Suivant']) && $_POST['Suivant'] == 'Suivant') {
   extract($_POST);


    $_SESSION['page4'] = true;
    $_SESSION['identifiant'] = apos_var ($identifiant);
    $_SESSION['mot_de_passe'] = apos_var ($mot_de_passe);
    if ( isset($securise) && $securise == 'non')
       $_SESSION['securise'] = false;
    else
       $_SESSION['securise'] = true;
    header('Location: page5.php');
    exit;

}

else {

 $identifiant  = '';
 $mot_de_passe = '';

}

if (  isset($_GET['erreur']) && $_GET['erreur']== 'var_sessions') 
      $affiche_info = 'erreur_sessions';


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Installation du calendrier</title>
<meta name="generator" content="WYSIWYG Web Builder - http://www.wysiwygwebbuilder.com">
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="page4.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function ValidateForm1(theForm)
{
   var regexp;
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖØÙÚÛÜİŞßàáâãäåæçèéêëìíîïğñòóôõöøùúûüışÿ \t\r\n\f0-9-'_-]*$/;
   if (!regexp.test(theForm.mot_de_passe.value))
   {
      alert("Vous n'avez pas ou mal renseigné le mot de passe, lettres, chiffres espace  ' _ - autorisés.");
      theForm.mot_de_passe.focus();
      return false;
   }
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖØÙÚÛÜİŞßàáâãäåæçèéêëìíîïğñòóôõöøùúûüışÿ \t\r\n\f0-9-'_-"]*$/;
   if (!regexp.test(theForm.identifiant.value))
   {
      alert("Vous n'avez pas ou mal renseigné l'identifiant de connexion, lettres, chiffres espace  ' _ - \" autorisés.");
      theForm.identifiant.focus();
      return false;
   }
   return true;
}
</script>
<script type="text/javascript" src="../fonction.js"></script>
</head>
<body>
<div id="container">
<table style="position:absolute;left:0px;top:81px;width:742px;height:581px;z-index:19;" cellpadding="5" cellspacing="1" id="Table2">
<tr>
<td style="background-color:#FDFDFD;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:565px;"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Shape3" style="position:absolute;left:10px;top:99px;width:722px;height:50px;z-index:20;">
<img src="images/img0020.png" id="Shape3" alt="" style="border-width:0;width:722px;height:50px;"></div>
<div id="wb_Text2" style="position:absolute;left:28px;top:153px;width:673px;height:57px;z-index:21;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Renseignez les paramètres de connexion ( identifiant et mot de passe) pour l'accès sécurisé à votre espace de gestion du calendrier ou vous pouvez choisir de ne pas sécuriser votre espace d'administration.</strong></span></div>
<div id="wb_Form1" style="position:absolute;left:21px;top:296px;width:673px;height:203px;z-index:22;">
<form name="Form1" method="post" action="page4.php" id="Form1" onsubmit="return ValidateForm1(this)">
<input type="submit" id="Button1" name="Suivant" value="Suivant" style="position:absolute;left:52px;top:161px;width:96px;height:25px;z-index:0;">
<div id="wb_Text1" style="position:absolute;left:12px;top:35px;width:286px;height:18px;text-align:right;z-index:1;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Nom d'utilisateur</strong></span></div>
<div id="wb_Text3" style="position:absolute;left:13px;top:77px;width:286px;height:18px;text-align:right;z-index:2;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Mot de passe</strong></span></div>
<input type="checkbox" id="securise" name="securise" value="non" style="position:absolute;left:311px;top:112px;z-index:3;" tabindex="1" onclick="message_alerte ('securise');">
<input type="text" id="mot_de_passe" style="position:absolute;left:313px;top:74px;width:328px;height:22px;line-height:22px;z-index:4;" name="mot_de_passe" value="<?php echo $mot_de_passe;  ?>" onfocus="bordure_formulaire('mot_de_passe','oui');return false;" onblur="bordure_formulaire('mot_de_passe','non');return false;">
<input type="text" id="identifiant" style="position:absolute;left:313px;top:31px;width:328px;height:22px;line-height:22px;z-index:5;" name="identifiant" value="<?php echo $identifiant; ?>" onfocus="bordure_formulaire('identifiant','oui');return false;" onblur="bordure_formulaire('identifiant','non');return false;">
<div id="wb_Text4" style="position:absolute;left:339px;top:115px;width:298px;height:36px;z-index:6;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Je certifie ne pas vouloir sécurisé l'accès<br>et reconnait les risques</strong></span></div>
</form>
</div>
<div id="wb_Form2" style="position:absolute;left:20px;top:513px;width:673px;height:70px;z-index:23;">
<form name="Form1" method="post" action="page2.php" id="Form2">
<input type="submit" id="suivant" name="Retour" value="Retour" style="position:absolute;left:53px;top:23px;width:96px;height:25px;z-index:7;">
</form>
</div>
<div id="wb_MasterPage2" style="position:absolute;left:0px;top:0px;width:696px;height:80px;z-index:24;">
<div id="wb_Shape2" style="position:absolute;left:16px;top:33px;width:227px;height:44px;z-index:8;">
<img src="images/img0030.png" id="Shape2" alt="" style="border-width:0;width:227px;height:44px;"></div>
<div id="wb_Shape1" style="position:absolute;left:16px;top:22px;width:227px;height:23px;z-index:9;">
<img src="images/img0031.png" id="Shape1" alt="" style="border-width:0;width:227px;height:23px;"></div>
<div id="wb_Text3" style="position:absolute;left:237px;top:47px;width:341px;height:33px;text-align:right;z-index:10;">
<span style="color:#4B4B4B;font-family:'Arial Black';font-size:24px;"><strong>Installation du calendrier</strong></span></div>
<div id="Html2" style="position:absolute;left:244px;top:0px;width:120px;height:23px;z-index:11">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<div id="wb_Text2" style="position:absolute;left:76px;top:32px;width:135px;height:38px;text-align:center;z-index:12;">
<span style="color:#685F4A;font-family:'Arial Black';font-size:27px;">FACILE</span></div>
<div id="wb_Image1" style="position:absolute;left:30px;top:38px;width:42px;height:34px;z-index:13;">
<img src="images/img0484.png" id="Image1" alt="" style="width:42px;height:34px;"></div>
<div id="wb_Text4" style="position:absolute;left:123px;top:59px;width:113px;height:15px;text-align:right;z-index:14;">
<span style="color:#4B4B4B;font-family:Arial;font-size:12px;"><strong>Calendrier php</strong></span></div>
<div id="wb_Image4" style="position:absolute;left:648px;top:0px;width:48px;height:48px;z-index:15;">
<img src="images/32_48x48.png" id="Image4" alt="" style="width:48px;height:48px;"></div>
<div id="wb_Image5" style="position:absolute;left:648px;top:28px;width:48px;height:48px;z-index:16;">
<img src="images/document_library.png" id="Image5" alt="" style="width:48px;height:48px;"></div>
<div id="wb_Image3" style="position:absolute;left:628px;top:21px;width:48px;height:48px;z-index:17;">
<img src="images/magic_wand.png" id="Image3" alt="" style="width:48px;height:48px;"></div>
<div id="wb_Text1" style="position:absolute;left:18px;top:10px;width:231px;height:38px;z-index:18;text-align:left;">
<span style="color:#C0E37B;font-family:'Arial Black';font-size:27px;">Mon calendrier</span></div>
</div>
<table style="position:absolute;left:25px;top:222px;width:668px;height:56px;z-index:25;" cellpadding="0" cellspacing="1" id="Table3">
<tr>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;height:48px;"><span style="color:#FFFFFF;font-family:Arial;font-size:16px;"><strong>Attention : si vous choisissez de ne pas sécuriser l'espace de gestion, c'est à vos risques et périls! Vous risquez de perdre toutes vos données ou de vous faire spamer.</strong></span></td>
</tr>
</table>
<div id="wb_Image2" style="position:absolute;left:10px;top:210px;width:40px;height:40px;z-index:26;">
<img src="images/img0487.png" id="Image2" alt="" style="width:40px;height:40px;"></div>
</div>
</body>
</html>