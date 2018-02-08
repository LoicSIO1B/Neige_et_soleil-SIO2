<?php

session_start(); 
header( 'content-type: text/html; charset=ISO-8859-1' );
include("../fonction.php");

$affiche_info = '';
$_SESSION['page6'] = false;
$test_chmod        = false;

//************************************************************
// condition retour page 1
//************************************************************

if ( !(isset($_SESSION['page1'])) || !($_SESSION['page1']) || !(isset($_SESSION['numero_transaction'])) || !(isset($_SESSION['page2'])) || !($_SESSION['page2']) || !(isset($_SESSION['page4'])) || !($_SESSION['page4']) || !(isset($_SESSION['page5'])) || !($_SESSION['page5']) ) {

   header('Location: index.php?erreur=var_sessions');
   exit;
   }

if ( isset($_POST['Creer']) && $_POST['Creer'] == 'Creer') {
   extract($_POST);


    $_SESSION['page6'] = true;
    $_SESSION['item1'] = $item1;
    header('Location: page7.php');
    exit;

}

else {

include("../fichier_calendrier/parametres_calendrier.php");
$repertoire_installation = dirname(__FILE__);

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
<link href="page6.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../fonction.js"></script>
</head>
<body>
<div id="container">
<table style="position:absolute;left:0px;top:81px;width:742px;height:581px;z-index:14;" cellpadding="5" cellspacing="1" id="Table2">
<tr>
<td style="background-color:#FDFDFD;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:565px;"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Shape3" style="position:absolute;left:10px;top:99px;width:722px;height:50px;z-index:15;">
<img src="images/img0026.png" id="Shape3" alt="" style="border-width:0;width:722px;height:50px;"></div>
<div id="wb_Form1" style="position:absolute;left:21px;top:186px;width:673px;height:350px;z-index:16;">
<form name="Form1" method="post" action="page6.php" id="Form1">
<input type="submit" id="Button1" name="Creer" value="Creer" style="position:absolute;left:52px;top:305px;width:96px;height:25px;z-index:0;">
<table style="position:absolute;left:18px;top:13px;width:634px;height:282px;z-index:1;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:266px;"><?php 
echo "Numéro de transaction  : ".stripslashes($_SESSION['numero_transaction'])."<br>"; 
echo "Email de paiement PAYPAL  : ".stripslashes($_SESSION['email'])."<br>"; 

if ( $_SESSION['securise']) {
  echo "- Mode sécurisé"."<br>";
  echo "- Identifiant  : ".stripslashes($_SESSION['identifiant'])."<br>"; 
  echo "- Mot de passe  : ".stripslashes($_SESSION['mot_de_passe'])."<br>" ; 
} 
else 
  echo "- Mode non sécurisé"."<br>";

echo "- Adresse installation  : ".stripslashes($_SESSION['cfg_repertoire_installation'])."<br>";
echo "- Libellé du bien  : ".stripslashes($_SESSION['cfg_item1'])."<br>";

if ($_SESSION['format_donnees'] <> 'avec') 
  echo "Sans base de données";
else {
  echo "- Avec base de données"."<br>";
  echo "- Adresse serveur :".stripslashes($_SESSION['hote_cal'])."<br>";
  echo "- Nom utilisateur :".stripslashes($_SESSION['user_cal'])."<br>";
  echo "- Mot de passe :".stripslashes($_SESSION['password_cal'])."<br>";
  echo "- Nom de la base :".stripslashes($_SESSION['base_cal'])."<br>";
  echo "- Nom de la table :".stripslashes($_SESSION['nom_table_cal'])."<br>";
}
?><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
</form>
</div>
<div id="wb_Form2" style="position:absolute;left:20px;top:559px;width:673px;height:70px;z-index:17;">
<form name="Form1" method="post" action="page5.php" id="Form2">
<input type="submit" id="suivant" name="" value="Retour" style="position:absolute;left:53px;top:23px;width:96px;height:25px;z-index:2;">
</form>
</div>
<div id="wb_Text2" style="position:absolute;left:24px;top:159px;width:687px;height:19px;z-index:18;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Rappel des paramètres d'installation :</strong></span></div>
<div id="wb_MasterPage2" style="position:absolute;left:0px;top:0px;width:696px;height:80px;z-index:19;">
<div id="wb_Shape2" style="position:absolute;left:16px;top:33px;width:227px;height:44px;z-index:3;">
<img src="images/img0030.png" id="Shape2" alt="" style="border-width:0;width:227px;height:44px;"></div>
<div id="wb_Shape1" style="position:absolute;left:16px;top:22px;width:227px;height:23px;z-index:4;">
<img src="images/img0031.png" id="Shape1" alt="" style="border-width:0;width:227px;height:23px;"></div>
<div id="wb_Text3" style="position:absolute;left:237px;top:47px;width:341px;height:33px;text-align:right;z-index:5;">
<span style="color:#4B4B4B;font-family:'Arial Black';font-size:24px;"><strong>Installation du calendrier</strong></span></div>
<div id="Html2" style="position:absolute;left:244px;top:0px;width:120px;height:23px;z-index:6">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<div id="wb_Text2" style="position:absolute;left:76px;top:32px;width:135px;height:38px;text-align:center;z-index:7;">
<span style="color:#685F4A;font-family:'Arial Black';font-size:27px;">FACILE</span></div>
<div id="wb_Image1" style="position:absolute;left:30px;top:38px;width:42px;height:34px;z-index:8;">
<img src="images/img0484.png" id="Image1" alt="" style="width:42px;height:34px;"></div>
<div id="wb_Text4" style="position:absolute;left:123px;top:59px;width:113px;height:15px;text-align:right;z-index:9;">
<span style="color:#4B4B4B;font-family:Arial;font-size:12px;"><strong>Calendrier php</strong></span></div>
<div id="wb_Image4" style="position:absolute;left:648px;top:0px;width:48px;height:48px;z-index:10;">
<img src="images/32_48x48.png" id="Image4" alt="" style="width:48px;height:48px;"></div>
<div id="wb_Image5" style="position:absolute;left:648px;top:28px;width:48px;height:48px;z-index:11;">
<img src="images/document_library.png" id="Image5" alt="" style="width:48px;height:48px;"></div>
<div id="wb_Image3" style="position:absolute;left:628px;top:21px;width:48px;height:48px;z-index:12;">
<img src="images/magic_wand.png" id="Image3" alt="" style="width:48px;height:48px;"></div>
<div id="wb_Text1" style="position:absolute;left:18px;top:10px;width:231px;height:38px;z-index:13;text-align:left;">
<span style="color:#C0E37B;font-family:'Arial Black';font-size:27px;">Mon calendrier</span></div>
</div>
</div>
</body>
</html>