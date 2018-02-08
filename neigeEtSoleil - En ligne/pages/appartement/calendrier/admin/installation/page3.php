<?php

session_start(); 
header( 'content-type: text/html; charset=ISO-8859-1' );
include("../fonction.php");

$affiche_info = '';
$_SESSION['page3'] = false;

//************************************************************
// condition retour page 1
//************************************************************

if ( !(isset($_SESSION['page1'])) || !($_SESSION['page1']) || !(isset($_SESSION['numero_transaction']))  || $_SESSION['format_donnees'] <> 'avec' || !(isset($_SESSION['page2'])) || !($_SESSION['page2']) ) {

   header('Location: index.php?erreur=var_sessions');
   exit;
   }

if ( isset($_POST['Suivant']) && $_POST['Suivant'] == 'Suivant') {
   extract($_POST);

 //***********************************************************
 // essaye connection a la base de données *******************
 //***********************************************************

  $connect = @mysql_connect($hote_cal,$user_cal,$password_cal);
  if (!$connect )
       $affiche_info = 'erreur_connecte_sql';
    else {
    $connect_base = @mysql_select_db($base_cal, $connect) ;
    if (!$connect_base )
       $affiche_info = 'erreur_connecte_base';

    else {
    // connexion sql et base ok ******************************
    $_SESSION['page4'] = true;
    //recryptage des donnees *****************************************
    $_SESSION['hote_cal'] = apos_var ($hote_cal);
    $_SESSION['user_cal'] = apos_var ($user_cal);
    $_SESSION['password_cal'] = apos_var ($password_cal);
    $_SESSION['base_cal'] = apos_var ($base_cal);
    $_SESSION['nom_table_cal'] = apos_var ($nom_table_cal);
    header('Location: page4.php');
    exit;

    }

  }

}

else if ( !(isset($_SESSION['page4'])) ) {

  $hote_cal = '';
  $user_cal = '';
  $password_cal = '';
  $base_cal = '';
  $nom_table_cal = '';

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
<link href="page3.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function ValidateForm1(theForm)
{
   var regexp;
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖØÙÚÛÜİŞßàáâãäåæçèéêëìíîïğñòóôõöøùúûüışÿ0-9-_]*$/;
   if (!regexp.test(theForm.nom_table_cal.value))
   {
      alert("Vous n'avez pas ou mal renseigné le nom de la table, lettres, chiffres, ou _ autorisé, pas d'espace!");
      theForm.nom_table_cal.focus();
      return false;
   }
   if (theForm.user_cal.value == "")
   {
      alert("Vous n'avez pas renseigné le nom d'utilisateur!");
      theForm.user_cal.focus();
      return false;
   }
   if (theForm.user_cal.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le nom d'utilisateur!");
      theForm.user_cal.focus();
      return false;
   }
   if (theForm.base_cal.value == "")
   {
      alert("Vous n'avez pas renseigné le nom de la base de données!");
      theForm.base_cal.focus();
      return false;
   }
   if (theForm.base_cal.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le nom de la base de données!");
      theForm.base_cal.focus();
      return false;
   }
   if (theForm.hote_cal.value == "")
   {
      alert("Vous n'avez pas renseigné le nom du serveur host de la base de données!");
      theForm.hote_cal.focus();
      return false;
   }
   if (theForm.hote_cal.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le nom du serveur host de la base de données!");
      theForm.hote_cal.focus();
      return false;
   }
   return true;
}
</script>
<script type="text/javascript" src="../fonction.js"></script>
</head>
<body>
<div id="container">
<table style="position:absolute;left:0px;top:81px;width:742px;height:535px;z-index:24;" cellpadding="5" cellspacing="1" id="Table2">
<tr>
<td style="background-color:#FDFDFD;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:519px;"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Shape3" style="position:absolute;left:10px;top:99px;width:722px;height:50px;z-index:25;">
<img src="images/img0017.png" id="Shape3" alt="" style="border-width:0;width:722px;height:50px;"></div>
<div id="wb_Form1" style="position:absolute;left:16px;top:216px;width:673px;height:284px;z-index:26;">
<form name="Form1" method="post" action="page3.php" id="Form1" onsubmit="return ValidateForm1(this)">
<input type="submit" id="Button1" name="Suivant" value="Suivant" style="position:absolute;left:49px;top:244px;width:96px;height:25px;z-index:0;">
<div id="wb_Text2" style="position:absolute;left:10px;top:61px;width:286px;height:18px;text-align:right;z-index:1;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Nom du serveur de la base de données</strong></span></div>
<div id="wb_Text1" style="position:absolute;left:10px;top:91px;width:286px;height:18px;text-align:right;z-index:2;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Nom de la base de données</strong></span></div>
<div id="wb_Text3" style="position:absolute;left:10px;top:122px;width:286px;height:18px;text-align:right;z-index:3;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Nom d'utilisateur</strong></span></div>
<div id="wb_Text5" style="position:absolute;left:10px;top:151px;width:286px;height:18px;text-align:right;z-index:4;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Mot de passe</strong></span></div>
<div id="wb_Text6" style="position:absolute;left:10px;top:184px;width:286px;height:18px;text-align:right;z-index:5;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Nom de la table</strong></span></div>
<input type="text" id="nom_table_cal" style="position:absolute;left:309px;top:180px;width:343px;height:22px;line-height:22px;z-index:6;" name="nom_table_cal" value="<?php echo $nom_table_cal; ?>" onfocus="bordure_formulaire('nom_table_cal','oui');return false;" onblur="bordure_formulaire('nom_table_cal','non');return false;">
<input type="text" id="password_cal" style="position:absolute;left:309px;top:147px;width:343px;height:22px;line-height:22px;z-index:7;" name="password_cal" value="<?php echo $password_cal; ?>" onfocus="bordure_formulaire('password_cal','oui');return false;" onblur="bordure_formulaire('password_cal','non');return false;">
<input type="text" id="user_cal" style="position:absolute;left:309px;top:118px;width:343px;height:22px;line-height:22px;z-index:8;" name="user_cal" value="<?php echo $user_cal; ?>" onfocus="bordure_formulaire('user_cal','oui');return false;" onblur="bordure_formulaire('user_cal','non');return false;">
<input type="text" id="base_cal" style="position:absolute;left:309px;top:87px;width:343px;height:22px;line-height:22px;z-index:9;" name="base_cal" value="<?php echo $base_cal; ?>" onfocus="bordure_formulaire('base_cal','oui');return false;" onblur="bordure_formulaire('base_cal','non');return false;">
<input type="text" id="hote_cal" style="position:absolute;left:309px;top:57px;width:343px;height:22px;line-height:22px;z-index:10;" name="hote_cal" value="<?php echo $hote_cal; ?>" onfocus="bordure_formulaire('hote_cal','oui');return false;" onblur="bordure_formulaire('hote_cal','non');return false;">
<div id="wb_Text7" style="position:absolute;left:15px;top:5px;width:545px;height:18px;z-index:11;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Paramètres de connexion :</strong></span></div>
</form>
</div>
<div id="wb_Form2" style="position:absolute;left:13px;top:513px;width:673px;height:70px;z-index:27;">
<form name="Form1" method="post" action="page2.php" id="Form2">
<input type="submit" id="suivant" name="Retour" value="Retour" style="position:absolute;left:53px;top:23px;width:96px;height:25px;z-index:12;">
</form>
</div>
<div id="wb_MasterPage2" style="position:absolute;left:0px;top:0px;width:696px;height:80px;z-index:28;">
<div id="wb_Shape2" style="position:absolute;left:16px;top:33px;width:227px;height:44px;z-index:13;">
<img src="images/img0030.png" id="Shape2" alt="" style="border-width:0;width:227px;height:44px;"></div>
<div id="wb_Shape1" style="position:absolute;left:16px;top:22px;width:227px;height:23px;z-index:14;">
<img src="images/img0031.png" id="Shape1" alt="" style="border-width:0;width:227px;height:23px;"></div>
<div id="wb_Text3" style="position:absolute;left:237px;top:47px;width:341px;height:33px;text-align:right;z-index:15;">
<span style="color:#4B4B4B;font-family:'Arial Black';font-size:24px;"><strong>Installation du calendrier</strong></span></div>
<div id="Html2" style="position:absolute;left:244px;top:0px;width:120px;height:23px;z-index:16">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<div id="wb_Text2" style="position:absolute;left:76px;top:32px;width:135px;height:38px;text-align:center;z-index:17;">
<span style="color:#685F4A;font-family:'Arial Black';font-size:27px;">FACILE</span></div>
<div id="wb_Image1" style="position:absolute;left:30px;top:38px;width:42px;height:34px;z-index:18;">
<img src="images/img0484.png" id="Image1" alt="" style="width:42px;height:34px;"></div>
<div id="wb_Text4" style="position:absolute;left:123px;top:59px;width:113px;height:15px;text-align:right;z-index:19;">
<span style="color:#4B4B4B;font-family:Arial;font-size:12px;"><strong>Calendrier php</strong></span></div>
<div id="wb_Image4" style="position:absolute;left:648px;top:0px;width:48px;height:48px;z-index:20;">
<img src="images/32_48x48.png" id="Image4" alt="" style="width:48px;height:48px;"></div>
<div id="wb_Image5" style="position:absolute;left:648px;top:28px;width:48px;height:48px;z-index:21;">
<img src="images/document_library.png" id="Image5" alt="" style="width:48px;height:48px;"></div>
<div id="wb_Image3" style="position:absolute;left:628px;top:21px;width:48px;height:48px;z-index:22;">
<img src="images/magic_wand.png" id="Image3" alt="" style="width:48px;height:48px;"></div>
<div id="wb_Text1" style="position:absolute;left:18px;top:10px;width:231px;height:38px;z-index:23;text-align:left;">
<span style="color:#C0E37B;font-family:'Arial Black';font-size:27px;">Mon calendrier</span></div>
</div>
<div id="wb_Text4" style="position:absolute;left:24px;top:159px;width:687px;height:38px;z-index:29;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>La base de donnée doit être crée avant, la table utilisée par le script sera crée pendant l'installation.</strong></span></div>
</div>
</body>
</html>