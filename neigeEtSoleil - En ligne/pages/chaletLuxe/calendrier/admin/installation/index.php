<?php

session_start(); 
header( 'content-type: text/html; charset=ISO-8859-1' );
include("../fonction.php");

$affiche_info = '';
$premier_valid_ok = false;

// controle free *************************************
   $serveur_free = false;
   $free_sessions_actif = false ;


if ( isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] == 'free' ) {
   $serveur_free = true;
   $free_sessions_actif = is_dir('./sessions');
}
   $cdt_ok_free = ( ($serveur_free && $free_sessions_actif) || ! $serveur_free) ? true : false ;

if ( isset($_POST['Suivant']) && $_POST['Suivant'] == 'Suivant') {
   extract($_POST);

   if ( isset($redistribution) && $redistribution == 'non' && isset($achat) && $achat == 'oui' ) {
   $_SESSION['page1'] = true;
   $_SESSION['numero_transaction'] = apos_var ($numero_transaction);
   $_SESSION['email'] = apos_var ($email);
   header('Location: page2.php');
   exit;
   }
 
}


if (  isset($_GET['erreur']) && $_GET['erreur']== 'var_sessions') {
      $affiche_info = 'erreur_sessions';
      session_destroy();
}


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Installation du calendrier</title>
<meta name="generator" content="WYSIWYG Web Builder - http://www.wysiwygwebbuilder.com">
<link href="icone_cal.ico" rel="shortcut icon">
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="index.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function ValidateForm1(theForm)
{
   var regexp;
   if (theForm.Checkbox1.checked != true)
   {
      alert("Vous n'avez pas certifié ne pas redistribué le script !");
      return false;
   }
   if (theForm.Checkbox2.checked != true)
   {
      alert("Vous n'avez pas certifié avoir acheté une licence !");
      return false;
   }
   if (theForm.Editbox1.value == "")
   {
      alert("Vous n'avez pas renseigné le numéro de transaction !");
      theForm.Editbox1.focus();
      return false;
   }
   if (theForm.Editbox1.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le numéro de transaction !");
      theForm.Editbox1.focus();
      return false;
   }
   regexp = /^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i;
   if (!regexp.test(theForm.email.value))
   {
      alert("Vous n'avez pas renseigné l'email de paiement paypal !");
      theForm.email.focus();
      return false;
   }
   if (theForm.email.value == "")
   {
      alert("Vous n'avez pas renseigné l'email de paiement paypal !");
      theForm.email.focus();
      return false;
   }
   if (theForm.email.value.length < 1)
   {
      alert("Vous n'avez pas renseigné l'email de paiement paypal !");
      theForm.email.focus();
      return false;
   }
   return true;
}
</script>
</head>
<body>
<div id="container">
<table style="position:absolute;left:0px;top:81px;width:742px;height:778px;z-index:20;" cellpadding="5" cellspacing="1" id="Table2">
<tr>
<td style="background-color:#FDFDFD;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:762px;"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Shape3" style="position:absolute;left:10px;top:99px;width:722px;height:50px;z-index:21;">
<img src="images/img0011.png" id="Shape3" alt="" style="border-width:0;width:722px;height:50px;"></div>
<div id="wb_Text2" style="position:absolute;left:30px;top:172px;width:673px;height:171px;z-index:22;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Mon calendrier facile est un script permettant d'afficher un calendrier dynamique sur un serveur php.<br><br>Ce script peut librement être modifié.<br><br><br><br><br>Vous devez accepter les conditions suivantes :</strong></span></div>
<div id="wb_Form1" style="position:absolute;left:21px;top:365px;width:673px;height:406px;z-index:23;">
<form name="Form1" method="post" action="index.php" id="Form1" onsubmit="return ValidateForm1(this)">
<input type="checkbox" id="Checkbox1" name="redistribution" value="non" style="position:absolute;left:25px;top:37px;z-index:0;" tabindex="1">
<div id="wb_Text3" style="position:absolute;left:52px;top:39px;width:545px;height:17px;z-index:1;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:15px;">Je certifie ne pas redistribué le script à un tiers</span></div>
<input type="checkbox" id="Checkbox2" name="achat" value="oui" style="position:absolute;left:25px;top:76px;z-index:2;" tabindex="2">
<div id="wb_Text5" style="position:absolute;left:52px;top:78px;width:545px;height:17px;z-index:3;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:15px;">Je certifie avoir acheté une licence pour chacune des installations du script</span></div>
<input type="submit" id="suivant" name="Suivant" value="Suivant" style="position:absolute;left:52px;top:335px;width:96px;height:25px;z-index:4;">
<div id="wb_Text4" style="position:absolute;left:29px;top:120px;width:607px;height:52px;z-index:5;text-align:left;" dir="ltr">
<div style="position:absolute;left:0px;top:0px;width:607px;height:16px;"><span style="color:#000000;font-family:Arial;font-size:15px;">Une licence est valable pour l'installation du script sur un seul et unqiue nom de domaine</span></div>
<div style="position:absolute;left:0px;top:17px;width:607px;height:16px;"><span style="color:#000000;font-family:Arial;font-size:15px;"><br></span></div>
<div style="position:absolute;left:0px;top:34px;width:607px;height:16px;"><span style="color:#000000;font-family:Arial;font-size:15px;"><strong><u>Si vous installez le script plusieurs fois vous devez acheter d'autres licences</u></strong></span></div>
</div>
<input type="text" id="Editbox1" style="position:absolute;left:264px;top:216px;width:312px;height:18px;line-height:18px;z-index:6;" name="numero_transaction" value="<?php if ( isset($_SESSION['numero_transaction']) ) echo $_SESSION['numero_transaction']; ?>" tabindex="3">
<input type="text" id="email" style="position:absolute;left:266px;top:266px;width:312px;height:18px;line-height:18px;z-index:7;" name="email" value="<?php if ( isset($_SESSION['email']) ) echo $_SESSION['email']; ?>" tabindex="3">
<div id="wb_indexText2" style="position:absolute;left:38px;top:215px;width:219px;height:68px;z-index:8;text-align:left;" dir="ltr">
<div style="position:absolute;left:0px;top:0px;width:219px;height:16px;"><span style="color:#000000;font-family:Arial;font-size:15px;">Numéro de transaction paypal :</span></div>
<div style="position:absolute;left:0px;top:17px;width:219px;height:16px;"><span style="color:#000000;font-family:Arial;font-size:15px;"><br></span></div>
<div style="position:absolute;left:0px;top:34px;width:219px;height:16px;"><span style="color:#000000;font-family:Arial;font-size:15px;"><br></span></div>
<div style="position:absolute;left:0px;top:51px;width:219px;height:16px;"><span style="color:#000000;font-family:Arial;font-size:15px;">L'email fourni pour le paiement :</span></div>
</div>
</form>
</div>
<div id="wb_MasterPage1" style="position:absolute;left:0px;top:0px;width:696px;height:80px;z-index:24;">
<div id="wb_Shape2" style="position:absolute;left:16px;top:33px;width:227px;height:44px;z-index:9;">
<img src="images/img0030.png" id="Shape2" alt="" style="border-width:0;width:227px;height:44px;"></div>
<div id="wb_Shape1" style="position:absolute;left:16px;top:22px;width:227px;height:23px;z-index:10;">
<img src="images/img0031.png" id="Shape1" alt="" style="border-width:0;width:227px;height:23px;"></div>
<div id="wb_Text3" style="position:absolute;left:237px;top:47px;width:341px;height:33px;text-align:right;z-index:11;">
<span style="color:#4B4B4B;font-family:'Arial Black';font-size:24px;"><strong>Installation du calendrier</strong></span></div>
<div id="Html2" style="position:absolute;left:244px;top:0px;width:120px;height:23px;z-index:12">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<div id="wb_Text2" style="position:absolute;left:76px;top:32px;width:135px;height:38px;text-align:center;z-index:13;">
<span style="color:#685F4A;font-family:'Arial Black';font-size:27px;">FACILE</span></div>
<div id="wb_Image1" style="position:absolute;left:30px;top:38px;width:42px;height:34px;z-index:14;">
<img src="images/img0484.png" id="Image1" alt="" style="width:42px;height:34px;"></div>
<div id="wb_Text4" style="position:absolute;left:123px;top:59px;width:113px;height:15px;text-align:right;z-index:15;">
<span style="color:#4B4B4B;font-family:Arial;font-size:12px;"><strong>Calendrier php</strong></span></div>
<div id="wb_Image4" style="position:absolute;left:648px;top:0px;width:48px;height:48px;z-index:16;">
<img src="images/32_48x48.png" id="Image4" alt="" style="width:48px;height:48px;"></div>
<div id="wb_Image5" style="position:absolute;left:648px;top:28px;width:48px;height:48px;z-index:17;">
<img src="images/document_library.png" id="Image5" alt="" style="width:48px;height:48px;"></div>
<div id="wb_Image3" style="position:absolute;left:628px;top:21px;width:48px;height:48px;z-index:18;">
<img src="images/magic_wand.png" id="Image3" alt="" style="width:48px;height:48px;"></div>
<div id="wb_Text1" style="position:absolute;left:18px;top:10px;width:231px;height:38px;z-index:19;text-align:left;">
<span style="color:#C0E37B;font-family:'Arial Black';font-size:27px;">Mon calendrier</span></div>
</div>
<table style="position:absolute;left:27px;top:258px;width:668px;height:56px;z-index:25;" cellpadding="0" cellspacing="1" id="Table1">
<tr>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;height:48px;"><span style="color:#FFFFFF;font-family:Arial;font-size:16px;"><strong>Si vous installez le script sur un compte <em>FREE</em>, vous devez activez les sessions avant de commencer en créant un répertoire sessions à la racine de votre site</strong></span></td>
</tr>
</table>
<div id="wb_indexText1" style="position:absolute;left:223px;top:548px;width:607px;height:17px;z-index:26;text-align:left;" dir="ltr">
<div style="position:absolute;left:0px;top:0px;width:607px;height:16px;"><span style="color:#000000;font-family:Arial;font-size:15px;">&gt; <a href="http://www.mathieuweb.fr/calendrier/telecharger-calendrier.php" target="_blank" class="style3">Acheter une nouvelle licence</a></span></div>
</div>
</div>
</body>
</html>