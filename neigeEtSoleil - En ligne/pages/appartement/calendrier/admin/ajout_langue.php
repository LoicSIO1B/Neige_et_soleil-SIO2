<?php
session_start();

$page_source_requete = "langue";

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
    require("secure_connexion.php");

$affiche_info = '';

$nom_logement_temp = '';
$cle_nom_logement_modif = '';
$nom_langue_temp = '' ;
$symbole_langue_temp = '' ;
$lundi_temp = '';
$mardi_temp = '';
$mercredi_temp = '';
$jeudi_temp = '';
$vendredi_temp = '';
$samedi_temp = '';
$dimanche_temp = '';
$semaine_temp = '';
$janvier_temp = '';
$fevrier_temp = '';
$mars_temp = '';
$avril_temp = '';
$mai_temp = '';
$juin_temp = '';
$juillet_temp = '';
$aout_temp = '';
$septembre_temp = '';
$octobre_temp = '';
$novembre_temp = '';
$decembre_temp = '';
$periode_temp = '';
$maj_temp = '';
$du_temp = '';
$au_temp = '';
$semaine_periode_temp = '';
$erreur_ajout = false ;
$verrou = '';

// chemin vers le fichier liste logement du membre *********************************************************
  include("fichier_calendrier/calendrier_liste_langue.php");

// test si demande ajout d'un locataire*****************************************************************************
if ( isset($_POST['Ajouter']) && ($_POST['Ajouter']) == 'Ajouter' && !(empty($_POST['symbole_langue']))  && !MODE_DEMO ) {

  //initialisation des variables*************************
  extract($_POST);

if( !array_key_exists($symbole_langue, $nom_langue) && !in_array($nom_langue_post, $nom_langue)  ) {

  $symbole_langue = strtolower($symbole_langue) ;

  $nom_langue[$symbole_langue] = $nom_langue_post ; 
  $lundi[$symbole_langue] = $lundi_post ; 
  $mardi[$symbole_langue] = $mardi_post ;
  $mercredi[$symbole_langue] = $mercredi_post ;
  $jeudi[$symbole_langue] = $jeudi_post ; 
  $vendredi[$symbole_langue] = $vendredi_post ; 
  $samedi[$symbole_langue] = $samedi_post ;
  $dimanche[$symbole_langue] = $dimanche_post ; 
  $semaine[$symbole_langue] = $semaine_post ; 
  $janvier[$symbole_langue] = $janvier_post ;
  $fevrier[$symbole_langue] = $fevrier_post ; 
  $mars[$symbole_langue] = $mars_post ; 
  $avril[$symbole_langue] = $avril_post ; 
  $mai[$symbole_langue] = $mai_post ; 
  $juin[$symbole_langue] = $juin_post ; 
  $juillet[$symbole_langue] = $juillet_post ; 
  $aout[$symbole_langue] = $aout_post ;
  $septembre[$symbole_langue] = $septembre_post ; 
  $octobre[$symbole_langue] = $octobre_post ; 
  $novembre[$symbole_langue] = $novembre_post ; 
  $decembre[$symbole_langue] = $decembre_post ; 
  $periode[$symbole_langue] = $periode_post ; 
  $du[$symbole_langue] = $du_post ;
  $au[$symbole_langue] = $au_post ; 
  $maj[$symbole_langue] = $maj_post ;
  $semaine_periode[$symbole_langue] = $semaine_periode_post ; 

  //chemin vers le fichier de création liste des locataires/logements**********************************************************
  include("genere/genere_listes_langue.php");
  if ( $creation_reussi) 
    $affiche_info = "ajout_ok";
  }
 else 
  $affiche_info = 'erreur_langue';
}  


//********************************************************************************
// controle mode démo ************************************************************
//********************************************************************************
  if ( ( (isset($_POST['Ajouter'])) ||(isset($_POST['Effacer'])) )&& MODE_DEMO   )
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
<link href="ajout_langue.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function ValidateForm1(theForm)
{
   var regexp;
   if (theForm.nom.value == "")
   {
      alert("Vous n'avez pas renseigné le nom de la langue !");
      theForm.nom.focus();
      return false;
   }
   if (theForm.nom.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le nom de la langue !");
      theForm.nom.focus();
      return false;
   }
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ]*$/;
   if (!regexp.test(theForm.Editbox1.value))
   {
      alert("Vous n'avez pas renseigné le symbole de la langue, utilisez un symbole unique et de 3 caractères maximum!");
      theForm.Editbox1.focus();
      return false;
   }
   if (theForm.Editbox1.value == "")
   {
      alert("Vous n'avez pas renseigné le symbole de la langue, utilisez un symbole unique et de 3 caractères maximum!");
      theForm.Editbox1.focus();
      return false;
   }
   if (theForm.Editbox1.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le symbole de la langue, utilisez un symbole unique et de 3 caractères maximum!");
      theForm.Editbox1.focus();
      return false;
   }
   if (theForm.Editbox1.value.length > 3)
   {
      alert("Vous n'avez pas renseigné le symbole de la langue, utilisez un symbole unique et de 3 caractères maximum!");
      theForm.Editbox1.focus();
      return false;
   }
   if (theForm.Editbox2.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour lundi!");
      theForm.Editbox2.focus();
      return false;
   }
   if (theForm.Editbox2.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour lundi!");
      theForm.Editbox2.focus();
      return false;
   }
   if (theForm.Editbox3.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour mardi !");
      theForm.Editbox3.focus();
      return false;
   }
   if (theForm.Editbox3.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour mardi !");
      theForm.Editbox3.focus();
      return false;
   }
   if (theForm.Editbox4.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour mercredi !");
      theForm.Editbox4.focus();
      return false;
   }
   if (theForm.Editbox4.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour mercredi !");
      theForm.Editbox4.focus();
      return false;
   }
   if (theForm.Editbox5.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour le jeudi !");
      theForm.Editbox5.focus();
      return false;
   }
   if (theForm.Editbox5.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour le jeudi !");
      theForm.Editbox5.focus();
      return false;
   }
   if (theForm.Editbox6.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour le vendredi !");
      theForm.Editbox6.focus();
      return false;
   }
   if (theForm.Editbox6.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour le vendredi !");
      theForm.Editbox6.focus();
      return false;
   }
   if (theForm.Editbox7.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour le samedi!");
      theForm.Editbox7.focus();
      return false;
   }
   if (theForm.Editbox7.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour le samedi!");
      theForm.Editbox7.focus();
      return false;
   }
   if (theForm.Editbox8.value == "")
   {
      alert("vous n'avez pas renseigné le texte pour le dimanche !");
      theForm.Editbox8.focus();
      return false;
   }
   if (theForm.Editbox8.value.length < 1)
   {
      alert("vous n'avez pas renseigné le texte pour le dimanche !");
      theForm.Editbox8.focus();
      return false;
   }
   if (theForm.Editbox9.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour la semaine !");
      theForm.Editbox9.focus();
      return false;
   }
   if (theForm.Editbox9.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour la semaine !");
      theForm.Editbox9.focus();
      return false;
   }
   if (theForm.Editbox10.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour janvier!");
      theForm.Editbox10.focus();
      return false;
   }
   if (theForm.Editbox10.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour janvier!");
      theForm.Editbox10.focus();
      return false;
   }
   if (theForm.Editbox11.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour février!");
      theForm.Editbox11.focus();
      return false;
   }
   if (theForm.Editbox11.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour février!");
      theForm.Editbox11.focus();
      return false;
   }
   if (theForm.Editbox12.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour mars!");
      theForm.Editbox12.focus();
      return false;
   }
   if (theForm.Editbox12.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour mars!");
      theForm.Editbox12.focus();
      return false;
   }
   if (theForm.Editbox13.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour avril!");
      theForm.Editbox13.focus();
      return false;
   }
   if (theForm.Editbox13.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour avril!");
      theForm.Editbox13.focus();
      return false;
   }
   if (theForm.Editbox14.value == "")
   {
      alert("Vous n'avez pas renseignez le texte pour mai!");
      theForm.Editbox14.focus();
      return false;
   }
   if (theForm.Editbox14.value.length < 1)
   {
      alert("Vous n'avez pas renseignez le texte pour mai!");
      theForm.Editbox14.focus();
      return false;
   }
   if (theForm.Editbox15.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour juin!");
      theForm.Editbox15.focus();
      return false;
   }
   if (theForm.Editbox15.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour juin!");
      theForm.Editbox15.focus();
      return false;
   }
   if (theForm.Editbox16.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour juillet !");
      theForm.Editbox16.focus();
      return false;
   }
   if (theForm.Editbox16.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour juillet !");
      theForm.Editbox16.focus();
      return false;
   }
   if (theForm.Editbox17.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour aout!");
      theForm.Editbox17.focus();
      return false;
   }
   if (theForm.Editbox17.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour aout!");
      theForm.Editbox17.focus();
      return false;
   }
   if (theForm.Editbox18.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour septembre!");
      theForm.Editbox18.focus();
      return false;
   }
   if (theForm.Editbox18.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour septembre!");
      theForm.Editbox18.focus();
      return false;
   }
   if (theForm.Editbox19.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour octobre!");
      theForm.Editbox19.focus();
      return false;
   }
   if (theForm.Editbox19.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour octobre!");
      theForm.Editbox19.focus();
      return false;
   }
   if (theForm.Editbox20.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour novembre");
      theForm.Editbox20.focus();
      return false;
   }
   if (theForm.Editbox20.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour novembre");
      theForm.Editbox20.focus();
      return false;
   }
   if (theForm.Editbox21.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour décembre!");
      theForm.Editbox21.focus();
      return false;
   }
   if (theForm.Editbox21.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour décembre!");
      theForm.Editbox21.focus();
      return false;
   }
   if (theForm.Editbox22.value == "")
   {
      alert("Vous n'avez pas renseignez le texte pour période !");
      theForm.Editbox22.focus();
      return false;
   }
   if (theForm.Editbox22.value.length < 1)
   {
      alert("Vous n'avez pas renseignez le texte pour période !");
      theForm.Editbox22.focus();
      return false;
   }
   if (theForm.Editbox23.value == "")
   {
      alert("Please enter a value for the \"du_post\" field.");
      theForm.Editbox23.focus();
      return false;
   }
   if (theForm.Editbox23.value.length < 1)
   {
      alert("Please enter at least 1 characters in the \"du_post\" field.");
      theForm.Editbox23.focus();
      return false;
   }
   if (theForm.Editbox24.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour \"au\" !");
      theForm.Editbox24.focus();
      return false;
   }
   if (theForm.Editbox24.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour \"au\" !");
      theForm.Editbox24.focus();
      return false;
   }
   if (theForm.Editbox25.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour la semaine du calendrier période!");
      theForm.Editbox25.focus();
      return false;
   }
   if (theForm.Editbox25.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour la semaine du calendrier période!");
      theForm.Editbox25.focus();
      return false;
   }
   if (theForm.Editbox26.value == "")
   {
      alert("Vous n'avez pas renseigné le texte pour septembre!");
      theForm.Editbox26.focus();
      return false;
   }
   if (theForm.Editbox26.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le texte pour septembre!");
      theForm.Editbox26.focus();
      return false;
   }
   return true;
}
</script>
<link rel="stylesheet" href="fichier_calendrier/styles.css?version=<?php echo filemtime('fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >


<SCRIPT type="text/JavaScript">
<!--
 function init() {
 couleur_bordure_selectionne = "2px C0E37B solid";
 couleur_bordure_initial     = "2px 51B4FD solid"; 
 couleur_fond_modifie        = "#F3FAE4"

}


 function bordure (champ_id) {
        document.getElementById(champ_id).style.border = couleur_bordure_selectionne ;
        document.getElementById(champ_id).style.backgroundColor = couleur_fond_modifie ;
 }

//-->
</script>
</head>
<body onload ="init()">
<div id="space"><br></div>
<div id="container">
<table style="position:absolute;left:5px;top:5px;width:906px;height:422px;z-index:57;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Image2" style="position:absolute;left:14px;top:8px;width:48px;height:48px;z-index:58;">
<img src="images/langue_ajout.png" id="Image2" alt=""></div>
<div id="Html2" style="position:absolute;left:80px;top:14px;width:120px;height:23px;z-index:59">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<div id="wb_Form2" style="position:absolute;left:13px;top:41px;width:886px;height:372px;z-index:60;">
<form name="Form1" method="post" action="ajout_langue.php" id="Form2" onsubmit="return ValidateForm1(this)">
<input type="text" id="nom" onfocus="bordure('nom');return false;return false;" style="position:absolute;left:179px;top:19px;width:341px;height:20px;line-height:20px;z-index:0;" name="nom_langue_post" value="<?php echo html_ent($nom_langue_temp); ?>">
<div id="wb_Text2" style="position:absolute;left:24px;top:23px;width:144px;height:19px;text-align:right;z-index:1;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Nom langue</strong></span></div>
<input type="submit" id="Button1" name="Ajouter" value="Ajouter" style="position:absolute;left:14px;top:335px;width:96px;height:25px;z-index:2;">
<div id="wb_Text3" style="position:absolute;left:538px;top:23px;width:144px;height:19px;text-align:right;z-index:3;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Symbole langue</strong></span></div>
<input type="text" id="Editbox1" onfocus="bordure('nom');return false;return false;" style="position:absolute;left:689px;top:19px;width:66px;height:20px;line-height:20px;z-index:4;" name="symbole_langue" value="<?php echo html_ent($symbole_langue_temp); ?>" maxlength="3" <?php
 echo $verrou;

?>>
<div id="wb_Text4" style="position:absolute;left:31px;top:74px;width:68px;height:19px;text-align:center;z-index:5;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Lundi</strong></span></div>
<div id="wb_Text5" style="position:absolute;left:137px;top:74px;width:68px;height:19px;text-align:center;z-index:6;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Mardi</strong></span></div>
<div id="wb_Text6" style="position:absolute;left:236px;top:74px;width:75px;height:19px;text-align:center;z-index:7;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Mercredi</strong></span></div>
<div id="wb_Text7" style="position:absolute;left:344px;top:74px;width:75px;height:19px;text-align:center;z-index:8;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Jeudi</strong></span></div>
<div id="wb_Text8" style="position:absolute;left:448px;top:74px;width:75px;height:19px;text-align:center;z-index:9;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Vendredi</strong></span></div>
<div id="wb_Text9" style="position:absolute;left:556px;top:74px;width:75px;height:19px;text-align:center;z-index:10;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Samedi</strong></span></div>
<div id="wb_Text10" style="position:absolute;left:658px;top:74px;width:88px;height:19px;text-align:center;z-index:11;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Dimanche</strong></span></div>
<div id="wb_Text11" style="position:absolute;left:765px;top:74px;width:88px;height:19px;text-align:center;z-index:12;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Semaine</strong></span></div>
<input type="text" id="Editbox2" style="position:absolute;left:18px;top:103px;width:84px;height:18px;line-height:18px;z-index:13;" name="lundi_post" value="<?php echo html_ent($lundi_temp); ?>">
<input type="text" id="Editbox3" style="position:absolute;left:125px;top:103px;width:84px;height:18px;line-height:18px;z-index:14;" name="mardi_post" value="<?php echo html_ent($mardi_temp); ?>">
<input type="text" id="Editbox4" style="position:absolute;left:230px;top:103px;width:84px;height:18px;line-height:18px;z-index:15;" name="mercredi_post" value="<?php echo html_ent($mercredi_temp); ?>">
<input type="text" id="Editbox5" style="position:absolute;left:336px;top:103px;width:84px;height:18px;line-height:18px;z-index:16;" name="jeudi_post" value="<?php echo html_ent($jeudi_temp); ?>">
<input type="text" id="Editbox6" style="position:absolute;left:443px;top:103px;width:84px;height:18px;line-height:18px;z-index:17;" name="vendredi_post" value="<?php echo html_ent($vendredi_temp); ?>">
<input type="text" id="Editbox7" style="position:absolute;left:552px;top:103px;width:84px;height:18px;line-height:18px;z-index:18;" name="samedi_post" value="<?php echo html_ent($samedi_temp); ?>">
<input type="text" id="Editbox8" style="position:absolute;left:659px;top:103px;width:84px;height:18px;line-height:18px;z-index:19;" name="dimanche_post" value="<?php echo html_ent($dimanche_temp); ?>">
<input type="text" id="Editbox9" style="position:absolute;left:766px;top:103px;width:84px;height:18px;line-height:18px;z-index:20;" name="semaine_post" value="<?php echo html_ent($semaine_temp); ?>">
<div id="wb_Text12" style="position:absolute;left:31px;top:140px;width:68px;height:19px;text-align:center;z-index:21;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Janvier</strong></span></div>
<input type="text" id="Editbox10" style="position:absolute;left:18px;top:169px;width:84px;height:18px;line-height:18px;z-index:22;" name="janvier_post" value="<?php echo html_ent($janvier_temp); ?>">
<div id="wb_Text13" style="position:absolute;left:137px;top:140px;width:68px;height:19px;text-align:center;z-index:23;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Février</strong></span></div>
<input type="text" id="Editbox11" style="position:absolute;left:125px;top:169px;width:84px;height:18px;line-height:18px;z-index:24;" name="fevrier_post" value="<?php echo html_ent($fevrier_temp); ?>">
<div id="wb_Text14" style="position:absolute;left:236px;top:140px;width:75px;height:19px;text-align:center;z-index:25;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Mars</strong></span></div>
<input type="text" id="Editbox12" style="position:absolute;left:230px;top:169px;width:84px;height:18px;line-height:18px;z-index:26;" name="mars_post" value="<?php echo html_ent($mars_temp); ?>">
<div id="wb_Text15" style="position:absolute;left:344px;top:140px;width:75px;height:19px;text-align:center;z-index:27;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Avril</strong></span></div>
<input type="text" id="Editbox13" style="position:absolute;left:336px;top:169px;width:84px;height:18px;line-height:18px;z-index:28;" name="avril_post" value="<?php echo html_ent($avril_temp); ?>">
<div id="wb_Text16" style="position:absolute;left:448px;top:140px;width:75px;height:19px;text-align:center;z-index:29;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Mai</strong></span></div>
<input type="text" id="Editbox14" style="position:absolute;left:443px;top:169px;width:84px;height:18px;line-height:18px;z-index:30;" name="mai_post" value="<?php echo html_ent($mai_temp); ?>">
<div id="wb_Text17" style="position:absolute;left:556px;top:140px;width:75px;height:19px;text-align:center;z-index:31;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Juin</strong></span></div>
<input type="text" id="Editbox15" style="position:absolute;left:552px;top:169px;width:84px;height:18px;line-height:18px;z-index:32;" name="juin_post" value="<?php echo html_ent($juin_temp); ?>">
<div id="wb_Text18" style="position:absolute;left:658px;top:140px;width:88px;height:19px;text-align:center;z-index:33;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Juillet</strong></span></div>
<input type="text" id="Editbox16" style="position:absolute;left:659px;top:169px;width:84px;height:18px;line-height:18px;z-index:34;" name="juillet_post" value="<?php echo html_ent($juillet_temp); ?>">
<div id="wb_Text19" style="position:absolute;left:765px;top:140px;width:88px;height:19px;text-align:center;z-index:35;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Aout</strong></span></div>
<input type="text" id="Editbox17" style="position:absolute;left:766px;top:169px;width:84px;height:18px;line-height:18px;z-index:36;" name="aout_post" value="<?php echo html_ent($aout_temp); ?>">
<div id="wb_Text20" style="position:absolute;left:17px;top:212px;width:92px;height:19px;text-align:center;z-index:37;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Septembre</strong></span></div>
<div id="wb_Text21" style="position:absolute;left:137px;top:212px;width:68px;height:19px;text-align:center;z-index:38;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Octobre</strong></span></div>
<div id="wb_Text22" style="position:absolute;left:229px;top:212px;width:86px;height:19px;text-align:center;z-index:39;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Novembre</strong></span></div>
<div id="wb_Text23" style="position:absolute;left:334px;top:212px;width:89px;height:19px;text-align:center;z-index:40;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Décembre</strong></span></div>
<div id="wb_Text24" style="position:absolute;left:448px;top:212px;width:75px;height:19px;text-align:center;z-index:41;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Période</strong></span></div>
<div id="wb_Text25" style="position:absolute;left:556px;top:212px;width:75px;height:19px;text-align:center;z-index:42;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Du</strong></span></div>
<div id="wb_Text26" style="position:absolute;left:658px;top:212px;width:88px;height:19px;text-align:center;z-index:43;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Au</strong></span></div>
<div id="wb_Text27" style="position:absolute;left:765px;top:212px;width:88px;height:19px;text-align:center;z-index:44;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Semaine</strong></span></div>
<input type="text" id="Editbox18" style="position:absolute;left:18px;top:241px;width:84px;height:18px;line-height:18px;z-index:45;" name="septembre_post" value="<?php echo html_ent($septembre_temp); ?>">
<input type="text" id="Editbox19" style="position:absolute;left:125px;top:241px;width:84px;height:18px;line-height:18px;z-index:46;" name="octobre_post" value="<?php echo html_ent($octobre_temp); ?>">
<input type="text" id="Editbox20" style="position:absolute;left:230px;top:241px;width:84px;height:18px;line-height:18px;z-index:47;" name="novembre_post" value="<?php echo html_ent($novembre_temp); ?>">
<input type="text" id="Editbox21" style="position:absolute;left:336px;top:241px;width:84px;height:18px;line-height:18px;z-index:48;" name="decembre_post" value="<?php echo html_ent($decembre_temp); ?>">
<input type="text" id="Editbox22" style="position:absolute;left:443px;top:241px;width:84px;height:18px;line-height:18px;z-index:49;" name="periode_post" value="<?php echo html_ent($periode_temp); ?>">
<input type="text" id="Editbox23" style="position:absolute;left:552px;top:241px;width:84px;height:18px;line-height:18px;z-index:50;" name="du_post" value="<?php echo html_ent($du_temp); ?>">
<input type="text" id="Editbox24" style="position:absolute;left:659px;top:241px;width:84px;height:18px;line-height:18px;z-index:51;" name="au_post" value="<?php echo html_ent($au_temp); ?>">
<input type="text" id="Editbox25" style="position:absolute;left:766px;top:241px;width:84px;height:18px;line-height:18px;z-index:52;" name="semaine_periode_post" value="<?php echo html_ent($semaine_periode_temp); ?>">
<div id="wb_Text29" style="position:absolute;left:764px;top:23px;width:98px;height:16px;z-index:53;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong> (3 carct.max.)</strong></span></div>
<input type="button" id="Button2" onclick="parent.parent.location = 'edit_langue.php' ;return false;" name="Fermer" value="Fermer" style="position:absolute;left:755px;top:335px;width:96px;height:25px;z-index:54;" tabindex="6">
<div id="wb_Text1" style="position:absolute;left:17px;top:278px;width:166px;height:19px;text-align:center;z-index:55;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Dernière mise à jour</strong></span></div>
<input type="text" id="Editbox26" style="position:absolute;left:19px;top:306px;width:165px;height:18px;line-height:18px;z-index:56;" name="maj_post" value="<?php echo html_ent($maj_temp); ?>">
</form>
</div>
</div>
</body>
</html>