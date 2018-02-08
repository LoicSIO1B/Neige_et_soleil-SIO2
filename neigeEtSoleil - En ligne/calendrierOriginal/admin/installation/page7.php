<?php

session_start(); 
header( 'content-type: text/html; charset=ISO-8859-1' );
include("../fonction.php");

$affiche_info = '';
$_SESSION['page7'] = false;
$test_chmod        = false;

//************************************************************
// condition retour page 1
//************************************************************

if ( !(isset($_SESSION['page1'])) || !($_SESSION['page1']) || !(isset($_SESSION['numero_transaction'])) || !(isset($_SESSION['page2'])) || !($_SESSION['page2']) || !(isset($_SESSION['page4'])) || !($_SESSION['page4']) || !(isset($_SESSION['page5'])) || !($_SESSION['page5']) || !(isset($_SESSION['page6'])) || !($_SESSION['page6'])) {

   header('Location: index.php?erreur=var_sessions');
   exit;
   }

include ("genere_config.php");

//***********************************************************
// controle si installation réussie
//***********************************************************
$echec_install = false ;
foreach ( $tableau_erreur as $cle => $erreur_presente ) {

  if ( !$tableau_erreur[$cle] ) {
     $echec_install = true ;
  }
}

if ( !$echec_install ) {
   header('Location: reussi.php');
   exit;
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
<link href="page7.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../fonction.js"></script>

</head>
<body>
<div id="container">
<table style="position:absolute;left:0px;top:81px;width:742px;height:1120px;z-index:17;" cellpadding="5" cellspacing="1" id="Table2">
<tr>
<td style="background-color:#FDFDFD;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:1104px;"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Shape3" style="position:absolute;left:10px;top:99px;width:722px;height:50px;z-index:18;">
<img src="images/img0029.png" id="Shape3" alt="" style="border-width:0;width:722px;height:50px;"></div>
<div id="wb_Form1" style="position:absolute;left:18px;top:348px;width:673px;height:833px;z-index:19;">
<form name="Form1" method="post" action="page6.php" id="Form1">
<table style="position:absolute;left:18px;top:11px;width:634px;height:798px;z-index:0;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:782px;"><?php

foreach ( $tableau_erreur as $cle => $erreur_presente ) {

  if ( !$tableau_erreur[$cle] ) {
     echo "- ".$texte_tableau_erreur[$cle]."<br>";
  }
}

?><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
</form>
</div>
<div id="wb_Form2" style="position:absolute;left:17px;top:264px;width:673px;height:72px;z-index:20;">
<form name="Form1" method="post" action="page6.php" id="Form2">
<input type="submit" id="suivant" name="Retour" value="Retour" style="position:absolute;left:6px;top:30px;width:96px;height:25px;z-index:1;">
<button id="AdvancedButton1" type="button" onclick="window.location.reload()" name="Recommencer" value="" style="position:absolute;left:149px;top:30px;width:105px;height:27px;z-index:2;">
<div style="text-align:center"><span style="color:#FFFFFF;font-family:Arial;font-size:13px">Recommencer</span></div>
</button>
<button id="AdvancedButton2" type="button" onclick="window.open('installation_manuelle.php')" name="Recommencer" value="" style="position:absolute;left:298px;top:30px;width:141px;height:27px;z-index:3;">
<div style="text-align:center"><span style="color:#FFFFFF;font-family:Arial;font-size:13px">Installation manuelle</span></div>
</button>
<button id="AdvancedButton3" type="button" onclick="window.open('../index_calendrier.php')" name="Recommencer" value="" style="position:absolute;left:472px;top:30px;width:141px;height:27px;z-index:4;">
<div style="text-align:center"><span style="color:#FFFFFF;font-family:Arial;font-size:13px">Tester le calendrier</span></div>
</button>
<div id="wb_Text2" style="position:absolute;left:10px;top:0px;width:409px;height:19px;z-index:5;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Actions</strong></span></div>
</form>
</div>
<div id="wb_Text1" style="position:absolute;left:24px;top:159px;width:687px;height:95px;z-index:21;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>L'installation c'est malheureusement mal passée,<br>veuillez corriger les erreurs qui se trouvent dans la liste ci dessous.<br></strong></span><span style="color:#FF4F4F;font-family:Arial;font-size:16px;"><strong>Il se peut néanmoins que le programme fonctionne correctement </strong></span><span style="color:#000000;font-family:Arial;font-size:16px;"><strong>( les chmod n'étant pas toujours permis), vous trouverez également des boutons d'action.<br>Liste des erreurs :</strong></span></div>
<div id="wb_MasterPage2" style="position:absolute;left:0px;top:0px;width:696px;height:80px;z-index:22;">
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
<div id="wb_Image1" style="position:absolute;left:22px;top:104px;width:40px;height:40px;z-index:23;">
<img src="images/img0488.png" id="Image1" alt="" style="width:40px;height:40px;"></div>
</div>
</body>
</html>