<?php
session_start();
// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("genere/connexion.php");

// controle si INSTALLATION FAITE ***************************************************

    if ( (identifiant == '' || mot_de_passe == '' ) && MODE_DEMO) {
      echo "Vous devez installer le calendrier avant de commencer, <a href=\"installation/\">Installer</a>";
      exit;
    }


   require("fonction.php");

$erreur_connexion = false ;
$affiche_info     = '';

//modifier les paramètres de connection à la base de données*******************************************************
if ( isset($_POST['Connexion']) && ($_POST['Connexion']) == 'Connexion'  ) {
  extract($_POST);

  $id  = stripslashes($id);
  $mdp = stripslashes($mdp);

  $mot_de_passe_decrypt = Decrypte(mot_de_passe,$Cle);

   if ( $id == identifiant && $mdp == $mot_de_passe_decrypt ) {
   $_SESSION['id_connexion'] = identifiant;
   $_SESSION['mdp'] = $mdp;
   $se_souvenir = isset($_POST['se_souvenir']) ? true : false;
      if ($se_souvenir)
      {
         setcookie('rem_identifiant', identifiant, time() + 3600*24*365);
         setcookie('rem_password', Crypte($mdp,$Cle), time() + 3600*24*365);
      }
   header('Location: index_calendrier.php');
   exit;
   }
   else {
    $_SESSION = array();
    session_destroy();
    $affiche_info = 'erreur_connexion';
  }

}

//modifier les paramètres de connection à la base de données*******************************************************
if ( isset($_GET['Connexion']) && ($_GET['Connexion']) == 'Connexion'  ) {
  extract($_GET);

  $id  = stripslashes($id);
  $mdp = stripslashes($mdp);

  $mot_de_passe_decrypt = Decrypte(mot_de_passe,$Cle);

   if ( $id == identifiant && $mdp == $mot_de_passe_decrypt ) {
   $_SESSION['id_connexion'] = identifiant;
   $_SESSION['mdp'] = $mdp;
   $se_souvenir = isset($_GET['se_souvenir']) ? true : false;
      if ($se_souvenir)
      {
         setcookie('rem_identifiant', identifiant, time() + 3600*24*365);
         setcookie('rem_password', Crypte($mdp,$Cle), time() + 3600*24*365);
      }
   header('Location: index_calendrier.php');
   exit;
   }
   else {
    $_SESSION = array();
    session_destroy();
    $affiche_info = 'erreur_connexion';
  }

}

header( 'content-type: text/html; charset=ISO-8859-1' );

$username = isset($_COOKIE['rem_identifiant']) ? stripslashes($_COOKIE['rem_identifiant']) : '';
$password = isset($_COOKIE['rem_password']) ? stripslashes($_COOKIE['rem_password']) : '';
$password = Decrypte($password,$Cle);

if ( isset($_GET['fct']) && $_GET['fct'] == 'deconnexion' ) {
    $_SESSION = array();
    session_destroy();
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Administration du calendrier des disponibilités</title>
<meta name="description" content="administration du calendrier des réservations, disponibilitée">
<meta name="generator" content="http://www.mathieuweb.fr/calendrier/calendrier.php">
<link href="icone_cal.ico" rel="shortcut icon" type="image/x-icon">
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="identification.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function ValidateForm1(theForm)
{
   var regexp;
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖØÙÚÛÜİŞßàáâãäåæçèéêëìíîïğñòóôõöøùúûüışÿ \t\r\n\f0-9-'_-"]*$/;
   if (!regexp.test(theForm.id.value))
   {
      alert("Vous n'avez pas ou mal renseigné l'identifiant de connexion, lettres, chiffres espace  ' _ -\" autorisés.");
      theForm.id.focus();
      return false;
   }
   if (theForm.id.value == "")
   {
      alert("Vous n'avez pas ou mal renseigné l'identifiant de connexion, lettres, chiffres espace  ' _ -\" autorisés.");
      theForm.id.focus();
      return false;
   }
   if (theForm.id.value.length < 1)
   {
      alert("Vous n'avez pas ou mal renseigné l'identifiant de connexion, lettres, chiffres espace  ' _ -\" autorisés.");
      theForm.id.focus();
      return false;
   }
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖØÙÚÛÜİŞßàáâãäåæçèéêëìíîïğñòóôõöøùúûüışÿ \t\r\n\f0-9-'_-]*$/;
   if (!regexp.test(theForm.mdp.value))
   {
      alert("Vous n'avez pas ou mal renseigné le mot de passe, lettres, chiffres espace  ' _ - autorisés.");
      theForm.mdp.focus();
      return false;
   }
   if (theForm.mdp.value == "")
   {
      alert("Vous n'avez pas ou mal renseigné le mot de passe, lettres, chiffres espace  ' _ - autorisés.");
      theForm.mdp.focus();
      return false;
   }
   if (theForm.mdp.value.length < 1)
   {
      alert("Vous n'avez pas ou mal renseigné le mot de passe, lettres, chiffres espace  ' _ - autorisés.");
      theForm.mdp.focus();
      return false;
   }
   return true;
}
</script>
<script type="text/javascript" src="fonction.js"></script>
</head>
<body>
<div id="container">
<table style="position:absolute;left:0px;top:59px;width:799px;height:380px;z-index:7;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Form1" style="position:absolute;left:41px;top:147px;width:705px;height:251px;z-index:8;">
<form name="Form1" method="post" action="identification.php" id="Form1" onsubmit="return ValidateForm1(this)">
<div id="wb_Text1" style="position:absolute;left:46px;top:43px;width:195px;height:27px;text-align:right;z-index:0;">
<span style="color:#666666;font-family:'Arial Black';font-size:19px;"><strong>Identifiant</strong></span></div>
<div id="wb_Text3" style="position:absolute;left:45px;top:83px;width:195px;height:27px;text-align:right;z-index:1;">
<span style="color:#666666;font-family:'Arial Black';font-size:19px;"><strong>Mot de passe</strong></span></div>
<input type="text" id="id" style="position:absolute;left:249px;top:42px;width:416px;height:20px;line-height:20px;z-index:2;" name="id" value="<?php echo htmlentities($username); ?>" onfocus="bordure_formulaire('id','oui');return false;" onblur="bordure_formulaire('id','non');return false;">
<input type="password" id="mdp" style="position:absolute;left:249px;top:82px;width:416px;height:20px;line-height:20px;z-index:3;" name="mdp" value="<?php echo htmlentities($password); ?>" onfocus="bordure_formulaire('mdp','oui');return false;" onblur="bordure_formulaire('mdp','non');return false;">
<input type="submit" id="Button1" name="Connexion" value="Connexion" style="position:absolute;left:245px;top:158px;width:96px;height:25px;z-index:4;">
<div id="wb_Text5" style="position:absolute;left:279px;top:123px;width:295px;height:23px;z-index:5;text-align:left;">
<span style="color:#666666;font-family:'Arial Black';font-size:16px;">Se souvenir de moi</span></div>
<input type="checkbox" id="Checkbox1" name="se_souvenir" value="on" style="position:absolute;left:249px;top:123px;z-index:6;" <?php if (isset($_COOKIE['rem_identifiant'])) {echo 'checked';} ?>>
</form>
</div>
<div id="wb_Text2" style="position:absolute;left:411px;top:355px;width:368px;height:38px;z-index:9;text-align:left;">
<span style="color:#666666;font-family:'Arial Black';font-size:27px;"><strong>Identification requise</strong></span></div>
<table style="position:absolute;left:7px;top:77px;width:774px;height:40px;z-index:10;" cellpadding="4" cellspacing="0" id="Table2">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:21px;"><strong>Administration du calendrier</strong></span></td>
<td class="cell1"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="Html2" style="position:absolute;left:164px;top:0px;width:120px;height:23px;z-index:11">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<div id="wb_Image1" style="position:absolute;left:366px;top:342px;width:48px;height:64px;z-index:12;">
<img src="images/img0109.png" id="Image1" alt=""></div>
</div>
</body>
</html>