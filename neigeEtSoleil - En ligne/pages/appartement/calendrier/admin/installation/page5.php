<?php

session_start(); 
header( 'content-type: text/html; charset=ISO-8859-1' );
include("../fonction.php");

$affiche_info = '';
$_SESSION['page5'] = false;

//************************************************************
// condition retour page 1
//************************************************************

if ( !(isset($_SESSION['page1'])) || !($_SESSION['page1']) || !(isset($_SESSION['numero_transaction'])) || !(isset($_SESSION['email'])) || !(isset($_SESSION['page2'])) || !($_SESSION['page2']) || !(isset($_SESSION['page4'])) || !($_SESSION['page4']) ) {

   header('Location: index.php?erreur=var_sessions');
   exit;
   }

if ( isset($_POST['Suivant']) && $_POST['Suivant'] == 'Suivant') {
   extract($_POST);


    $_SESSION['page5'] = true;
    // chemin install controle format ********************
    $rest = substr($repertoire_installation, -1);
    $repertoire_installation = trim($repertoire_installation) ;
    $_SESSION['cfg_repertoire_installation'] = ( $rest <> "/" ) ? $repertoire_installation."/": $repertoire_installation;
    $_SESSION['cfg_item1'] = apos_var ($item1);
    header('Location: page6.php');
    exit;

}

else {

include("../fichier_calendrier/parametres_calendrier.php");
$repertoire_installation = dirname(str_replace("admin/installation","","http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']))."/";

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
<link href="page5.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function ValidateForm1(theForm)
{
   var regexp;
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖØÙÚÛÜİŞßàáâãäåæçèéêëìíîïğñòóôõöøùúûüışÿ \t\r\n\f0-9-'_-]*$/;
   if (!regexp.test(theForm.item1.value))
   {
      alert("Vous n'avez pas ou mal renseigné le nom du type de bien en location, lettres, chiffres espace  ' _ - autorisés.");
      theForm.item1.focus();
      return false;
   }
   if (theForm.item1.value == "")
   {
      alert("Vous n'avez pas ou mal renseigné le nom du type de bien en location, lettres, chiffres espace  ' _ - autorisés.");
      theForm.item1.focus();
      return false;
   }
   if (theForm.item1.value.length < 1)
   {
      alert("Vous n'avez pas ou mal renseigné le nom du type de bien en location, lettres, chiffres espace  ' _ - autorisés.");
      theForm.item1.focus();
      return false;
   }
   if (theForm.repertoire_installation.value == "")
   {
      alert("Vous n'avez pas renseigné l'adresse d'installation !");
      theForm.repertoire_installation.focus();
      return false;
   }
   if (theForm.repertoire_installation.value.length < 1)
   {
      alert("Vous n'avez pas renseigné l'adresse d'installation !");
      theForm.repertoire_installation.focus();
      return false;
   }
   return true;
}
</script>
<script type="text/javascript" src="../fonction.js"></script>
</head>
<body>
<div id="container">
<table style="position:absolute;left:0px;top:81px;width:742px;height:581px;z-index:17;" cellpadding="5" cellspacing="1" id="Table2">
<tr>
<td style="background-color:#FDFDFD;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:565px;"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Shape3" style="position:absolute;left:10px;top:99px;width:722px;height:50px;z-index:18;">
<img src="images/img0023.png" id="Shape3" alt="" style="border-width:0;width:722px;height:50px;"></div>
<div id="wb_Form1" style="position:absolute;left:21px;top:361px;width:673px;height:166px;z-index:19;">
<form name="Form1" method="post" action="page5.php" id="Form1" onsubmit="return ValidateForm1(this)">
<input type="submit" id="Button1" name="Suivant" value="Suivant" style="position:absolute;left:52px;top:130px;width:96px;height:25px;z-index:0;">
<div id="wb_Text1" style="position:absolute;left:6px;top:33px;width:286px;height:18px;text-align:right;z-index:1;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Libellé du type de bien en location</strong></span></div>
<input type="text" id="item1" style="position:absolute;left:305px;top:29px;width:349px;height:22px;line-height:22px;z-index:2;" name="item1" value="<?php echo $item1; ?>" onfocus="bordure_formulaire('item1','oui');return false;" onblur="bordure_formulaire('item1','non');return false;">
<div id="wb_Text2" style="position:absolute;left:5px;top:86px;width:286px;height:18px;text-align:right;z-index:3;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>URL Répertoire d'installation du script</strong></span></div>
<input type="text" id="repertoire_installation" style="position:absolute;left:304px;top:82px;width:349px;height:22px;line-height:22px;z-index:4;" name="repertoire_installation" value="<?php echo $repertoire_installation; ?>" onfocus="bordure_formulaire('repertoire_installation','oui');return false;" onblur="bordure_formulaire('repertoire_installation','non');return false;">
</form>
</div>
<div id="wb_Form2" style="position:absolute;left:20px;top:546px;width:673px;height:70px;z-index:20;">
<form name="Form1" method="post" action="page4.php" id="Form2">
<input type="submit" id="suivant" name="Retour" value="Retour" style="position:absolute;left:53px;top:23px;width:96px;height:25px;z-index:5;">
</form>
</div>
<div id="wb_Text3" style="position:absolute;left:23px;top:157px;width:687px;height:190px;z-index:21;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Le calendrier permet de faire une gestion par locataire, mais également par type de bien en location, indiquez ci dessous le libéllé du <u>type</u> de bien en location, utilisez un terme générique pour votre type de bien<br>ex : location de logements , indiquez : Logements<br>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; location de salles, indiquer : Salles <br>Vous pourrez par la suite créer tous les biens associés à ce type de location (gîte bleu, gîte rouge, etc..)<br><br>Le répertoire d'installation est l'adresse URL complète jusqu'au répertoire admin du script (répertoire admin non compris dans l'adresse).</strong></span></div>
<div id="wb_MasterPage2" style="position:absolute;left:0px;top:0px;width:636px;height:78px;z-index:22;">
<div id="wb_Shape2" style="position:absolute;left:16px;top:33px;width:227px;height:44px;z-index:6;">
<img src="images/img0030.png" id="Shape2" alt="" style="border-width:0;width:227px;height:44px;"></div>
<div id="wb_Shape1" style="position:absolute;left:16px;top:22px;width:227px;height:23px;z-index:7;">
<img src="images/img0031.png" id="Shape1" alt="" style="border-width:0;width:227px;height:23px;"></div>
<div id="wb_Text3" style="position:absolute;left:237px;top:47px;width:341px;height:33px;text-align:right;z-index:8;">
<span style="color:#4B4B4B;font-family:'Arial Black';font-size:24px;"><strong>Installation du calendrier</strong></span></div>
<div id="Html2" style="position:absolute;left:244px;top:0px;width:120px;height:23px;z-index:9">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<div id="wb_Text2" style="position:absolute;left:76px;top:32px;width:135px;height:38px;text-align:center;z-index:10;">
<span style="color:#685F4A;font-family:'Arial Black';font-size:27px;">FACILE</span></div>
<div id="wb_Image1" style="position:absolute;left:30px;top:38px;width:42px;height:34px;z-index:11;">
<img src="images/img0484.png" id="Image1" alt="" style="width:42px;height:34px;"></div>
<div id="wb_Text4" style="position:absolute;left:123px;top:59px;width:113px;height:15px;text-align:right;z-index:12;">
<span style="color:#4B4B4B;font-family:Arial;font-size:12px;"><strong>Calendrier php</strong></span></div>
<div id="wb_Image4" style="position:absolute;left:648px;top:0px;width:48px;height:48px;z-index:13;">
<img src="images/32_48x48.png" id="Image4" alt="" style="width:48px;height:48px;"></div>
<div id="wb_Image5" style="position:absolute;left:648px;top:28px;width:48px;height:48px;z-index:14;">
<img src="images/document_library.png" id="Image5" alt="" style="width:48px;height:48px;"></div>
<div id="wb_Image3" style="position:absolute;left:628px;top:21px;width:48px;height:48px;z-index:15;">
<img src="images/magic_wand.png" id="Image3" alt="" style="width:48px;height:48px;"></div>
<div id="wb_Text1" style="position:absolute;left:18px;top:10px;width:231px;height:38px;z-index:16;text-align:left;">
<span style="color:#C0E37B;font-family:'Arial Black';font-size:27px;">Mon calendrier</span></div>
</div>
</div>
</body>
</html>