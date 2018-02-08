<?php
session_start();

require("secure_connexion2.php");

$affiche_info = '';

// test si demande modification des paramètres*****************************************************************************
if ( isset($_POST['Valider']) && $_POST['Valider'] == 'Valider'  && !MODE_DEMO ) {
  extract($_POST);

  //chemin vers le fichier de création liste des locataires/logements**********************************************************
  $chemin_repertoire = '';
  include("genere/genere_para_calendrier.php");

  if ( $avec_diagonale_cellule ) {
   include("fichier_calendrier/calendrier_liste_couleur.php");
   include("genere/genere_image_couleur.php");
  }

  if ( $creation_reussi )
     $affiche_info = 'modif_ok';
  else
    $affiche_info = 'erreur_execution';
}  

// test si demande sélection d'un modele*****************************************************************************
if ( isset($_POST['Choisir']) && ($_POST['Choisir']) == 'Choisir'  && !MODE_DEMO ) {

  extract($_POST);

  //chemin vers le fichier paramètres du modele choisit**********************************************************
  
  include("template_cal/".$choix_modele."/template.php");

if ( $url_image_fond_mois <> '' )
  $url_image_fond_mois                   = $repertoire_installation."admin/".$url_image_fond_mois ;
if ( $url_image_fond_cellule <> '' )
  $url_image_fond_cellule                = $repertoire_installation."admin/".$url_image_fond_cellule ;
if ( $url_image_fond_cellule_week_end <> '' )
  $url_image_fond_cellule_week_end       = $repertoire_installation."admin/".$url_image_fond_cellule_week_end ;
if ( $url_image_fond_cellule_nom_jour <> '' )
  $url_image_fond_cellule_nom_jour       = $repertoire_installation."admin/".$url_image_fond_cellule_nom_jour ;
if ( $url_image_fond_cellule_numero_semaine <> '' )
  $url_image_fond_cellule_numero_semaine = $repertoire_installation."admin/".$url_image_fond_cellule_numero_semaine ;
if ( $url_image_fond_cellule_aujourd_hui <> '' )
  $url_image_fond_cellule_aujourd_hui    = $repertoire_installation."admin/".$url_image_fond_cellule_aujourd_hui ;

  //chemin vers le fichier de création liste des locataires/logements**********************************************************
  $chemin_repertoire = '';
  include("genere/genere_para_calendrier.php");

  if ( $creation_reussi )
     $affiche_info = 'modele_ok';
  else
    $affiche_info = 'erreur_execution';
}  


if ( isset($_POST['Enregistrer']) && ($_POST['Enregistrer']) == 'Enregistrer' && !MODE_DEMO ) {

  extract($_POST);

  //chemin vers le fichier paramètres du modele choisit**********************************************************
  $chemin_repertoire = '';
  include("genere/genere_modele.php");

  if ( $creation_reussi )
     $affiche_info = 'modif_ok';
  else
    $affiche_info = 'erreur_execution';
}  


//chemin vers le fichier de liste des locataires/logements**********************************************************
     include("fichier_calendrier/parametres_calendrier.php");

//**************************************************************************************************
//controle des fichiers 
//**************************************************************************************************

if (!isset($fin_tableau_parametres))
    $affiche_info = 'erreur_fichier_parametres';

//test si utilisation des images diagonale pour cellules marquées*************************

//********************************************************************************
// controle mode démo ************************************************************
//********************************************************************************
  if ( ( (isset($_POST['Valider'])) ||(isset($_POST['Enregistrer']))||(isset($_POST['Choisir'])) ) && MODE_DEMO   )
     $affiche_info = 'mode_demo';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Administration du calendrier des disponibilités</title>
<meta name="generator" content="http://www.mathieuweb.fr/calendrier/">
<link href="icone_cal.ico" rel="shortcut icon" type="image/x-icon">
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="parametrage_calendrier.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function ValidateForm1(theForm)
{
   var regexp;
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ0-9-_]*$/;
   if (!regexp.test(theForm.nom_enregistrement_modele.value))
   {
      alert("Le nom du modèle doit être un texte ou chiffre sans espace et sans accent, _ autorisé!");
      theForm.nom_enregistrement_modele.focus();
      return false;
   }
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ \t\r\n\f0-9-'_-]*$/;
   if (!regexp.test(theForm.item1.value))
   {
      alert("Le type de bien en location n'est pas renseigné ou mal renseigné !");
      theForm.item1.focus();
      return false;
   }
   if (theForm.item1.value == "")
   {
      alert("Le type de bien en location n'est pas renseigné ou mal renseigné !");
      theForm.item1.focus();
      return false;
   }
   if (theForm.item1.value.length < 1)
   {
      alert("Le type de bien en location n'est pas renseigné ou mal renseigné !");
      theForm.item1.focus();
      return false;
   }
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ \t\r\n\f0-9-_-/:&]*$/;
   if (!regexp.test(theForm.repertoire_installation.value))
   {
      alert("Mauvaise entrée dans URL d'installation du script , caractères acceptés: lettres, chiffres, espace, _-/:&");
      theForm.repertoire_installation.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.hysteresis_plus.value))
   {
      alert("L'hystéresis de navigation du calendrier 1 mois doit être un nombre!");
      theForm.hysteresis_plus.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.hysteresis_moins.value))
   {
      alert("L'hystéresis de navigation du calendrier 1 mois doit être un nombre!");
      theForm.hysteresis_moins.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.nombre_semaine_calendrier_tous.value))
   {
      alert("Le nombre de semaine du calendrier toutes locations doit être un chiffre !");
      theForm.nombre_semaine_calendrier_tous.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.largeur_selec_date.value))
   {
      alert("La largeur du sélecteur mois et année doit être un nombre");
      theForm.largeur_selec_date.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.police_select_date.value))
   {
      alert("Taille police des sélecteurs mois et année doit être un nombre");
      theForm.police_select_date.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.bordure_ligne_fin_semaine.value))
   {
      alert("La taille de la bordure ligne fin de semaine doit être un chiffre ");
      theForm.bordure_ligne_fin_semaine.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.espace_entre_les_mois.value))
   {
      alert("L'espace entre les différents calendrier mensuel doit être un chiffre !");
      theForm.espace_entre_les_mois.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.espace_entre_cellule.value))
   {
      alert("L'espace entre les cellules des différents calendrier mensuel doit être un chiffre !");
      theForm.espace_entre_cellule.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.nombre_mois_afficher.value))
   {
      alert("Le nombre de mois doit être un chiffre !");
      theForm.nombre_mois_afficher.focus();
      return false;
   }
   if (theForm.nombre_mois_afficher.value != "" && !(theForm.nombre_mois_afficher.value < 25 && theForm.nombre_mois_afficher.value > 0))
   {
      alert("Le nombre de mois doit être un chiffre !");
      theForm.nombre_mois_afficher.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.nombre_mois_afficher_ligne.value))
   {
      alert("Le nombre de mois par ligne doit être un chiffre !");
      theForm.nombre_mois_afficher_ligne.focus();
      return false;
   }
   if (theForm.nombre_mois_afficher_ligne.value != "" && !(theForm.nombre_mois_afficher_ligne.value < 25 && theForm.nombre_mois_afficher_ligne.value > 0))
   {
      alert("Le nombre de mois par ligne doit être un chiffre !");
      theForm.nombre_mois_afficher_ligne.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.nombre_mois_afficher_admin.value))
   {
      alert("Le nombre de mois doit être un chiffre !");
      theForm.nombre_mois_afficher_admin.focus();
      return false;
   }
   if (theForm.nombre_mois_afficher_admin.value != "" && !(theForm.nombre_mois_afficher_admin.value < 25 && theForm.nombre_mois_afficher_admin.value > 0))
   {
      alert("Le nombre de mois doit être un chiffre !");
      theForm.nombre_mois_afficher_admin.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.nombre_mois_afficher_ligne_admin.value))
   {
      alert("Le nombre de mois par ligne doit être un chiffre !");
      theForm.nombre_mois_afficher_ligne_admin.focus();
      return false;
   }
   if (theForm.nombre_mois_afficher_ligne_admin.value != "" && !(theForm.nombre_mois_afficher_ligne_admin.value < 25 && theForm.nombre_mois_afficher_ligne_admin.value > 0))
   {
      alert("Le nombre de mois par ligne doit être un chiffre !");
      theForm.nombre_mois_afficher_ligne_admin.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.bordure_du_tableau.value))
   {
      alert("La taille de la bordure doit être un chiffre !");
      theForm.bordure_du_tableau.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.hauteur_mini_cellule_date.value))
   {
      alert("Taille hauteur mini cellule doit être un chiffre");
      theForm.hauteur_mini_cellule_date.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.largeur_tableau.value))
   {
      alert("La largeur minimale d'un tableau mois doit être un chiffre !");
      theForm.largeur_tableau.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.Editbox1.value))
   {
      alert("Taille hauteur mini cellule doit être un chiffre !");
      theForm.Editbox1.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.taille_police_mois.value))
   {
      alert("Taille police mois doit être un nombre !");
      theForm.taille_police_mois.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.taille_police_nom_jour.value))
   {
      alert("Taille police mois doit être un nombre!");
      theForm.taille_police_nom_jour.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.taille_police_jour.value))
   {
      alert("Taille police numéro jour doit être un nombre!");
      theForm.taille_police_jour.focus();
      return false;
   }
   return true;
}
</script>
<script type="text/javascript" src="jscolor/jscolor.js"></script><link rel="stylesheet" href="fichier_calendrier/styles.css?version=<?php echo filemtime('fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >

<script type="text/javascript" src="fonction.js"></script>

</head>
<body>
<div id="container">
<div id="wb_MasterPage1" style="position:absolute;left:2px;top:0px;width:964px;height:110px;z-index:604;">
</div>
<table style="position:absolute;left:4px;top:109px;width:982px;height:4005px;z-index:605;" cellpadding="5" cellspacing="1" id="fond_contenu">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Form1" style="position:absolute;left:0px;top:110px;width:1010px;height:3991px;z-index:606;">
<form name="Form1" method="post" action="parametrage_calendrier.php" id="Form1" onsubmit="return ValidateForm1(this)">
<input type="hidden" name="version" value="<?php echo $version; ?>">
<div id="wb_MasterPage11" style="position:absolute;left:12px;top:3614px;width:964px;height:357px;z-index:282;">
<table style="position:absolute;left:0px;top:0px;width:964px;height:34px;z-index:0;" cellpadding="4" cellspacing="0" id="Table1">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Gérer les modèles</strong></span></td>
</tr>
</table>
<table style="position:absolute;left:0px;top:43px;width:960px;height:314px;z-index:1;" cellpadding="0" cellspacing="1" id="Table3_modele">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<!-- liste modèle -->
<div id="Html2" style="position:absolute;left:639px;top:66px;width:273px;height:28px;z-index:2">
<?php 
   echo '<font style="font-size:16px" color="#FFFFFF" face="Arial" ><select name="choix_modele" size="1" id="Combobox1" style="width:220px;z-index:2">';
   $dir    = 'template_cal';

   $dh  = opendir($dir);
   while (false !== ($filename = readdir($dh))) {
    $repertoire[] = $filename;
    }

  usort($repertoire , "strcasecmp");

  // liste fichier à exclure*
  $liste_exclus = array(".htaccess",".","..","origine");

   if  ( $choix_modele == ''  )
        echo '<option value="origine" selected >origine</option>' ;
   else
       echo '<option value="origine">origine</option>' ;
   $nb_result = count ($repertoire);
   if ( $nb_result > 0 ) {
      foreach ($repertoire as $cle => $nom_modele )  {
            if ( !in_array($nom_modele, $liste_exclus) ) { 
            if  ( $nom_modele == $choix_modele  )
                  echo '<option selected value="',guillet_var($nom_modele),'" >',stripslashes($nom_modele),'</option>' ;
             else
                  echo '<option value="',guillet_var($nom_modele),'" >',stripslashes($nom_modele),'</option>' ;
               }
           }
        }
        echo '</select></font>';

?></div>
<div id="wb_Text1" style="position:absolute;left:208px;top:69px;width:423px;height:16px;text-align:right;z-index:3;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Sélectionner un modèle</strong></span></div>
<input type="submit" id="Button1" name="Choisir" value="Choisir" style="position:absolute;left:638px;top:98px;width:96px;height:25px;z-index:4;">
<div id="wb_Text4" style="position:absolute;left:208px;top:137px;width:423px;height:35px;text-align:right;z-index:5;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong><u>Enregistrer mes paramètres actuels dans un modèle<br></u></strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Nom du modèle :</strong></span></div>
<input type="text" id="nom_enregistrement_modele" style="position:absolute;left:640px;top:150px;width:241px;height:22px;line-height:22px;z-index:6;" name="nom_enregistrement_modele" value="">
<input type="submit" id="Button2" name="Enregistrer" value="Enregistrer" style="position:absolute;left:638px;top:183px;width:96px;height:25px;z-index:7;">
<div id="wb_Text6" style="position:absolute;left:22px;top:268px;width:499px;height:19px;z-index:8;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>&gt;</strong></span><span style="color:#00C4FD;font-family:Arial;font-size:16px;"><strong> <a href="http://www.mathieuweb.fr/calendrier/partage_modele.php" target="_blank" class="style3">Partager mes modèles </a>...</strong></span></div>
<div id="wb_Text5" style="position:absolute;left:17px;top:315px;width:333px;height:19px;z-index:9;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>&gt; <a href="http://www.mathieuweb.fr/calendrier/modele_calendrier.php" target="_blank" class="style3">Voir les modèles partagés...</a></strong></span></div>
<div id="wb_Extension2" style="position:absolute;left:917px;top:68px;width:21px;height:21px;z-index:10;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif"><b>Voici la liste des modèles disponibles.<br>
Les modèles contiennent que des paramètres de type &quot;design&quot;.</b></font></em></a></div>
<div id="wb_Text2" style="position:absolute;left:73px;top:203px;width:669px;height:32px;z-index:11;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>L'enregistrement des paramètres actuels dans un modèle n'est pas nécessaire.<br>Créer un modèle vous permettra simplement passer facilement d'un design de calendrier à un autre.</strong></span></div>
</div>
<input type="submit" id="bp_valider" name="Valider" value="Valider" style="position:absolute;left:734px;top:3567px;width:96px;height:25px;z-index:283;" tabindex="6">
<div id="wb_MasterPage10" style="position:absolute;left:11px;top:3412px;width:964px;height:141px;z-index:284;">
<table style="position:absolute;left:0px;top:0px;width:964px;height:34px;z-index:12;" cellpadding="4" cellspacing="0" id="Table1">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Paramétres généraux</strong></span></td>
</tr>
</table>
<table style="position:absolute;left:0px;top:41px;width:960px;height:100px;z-index:13;" cellpadding="0" cellspacing="1" id="Table2_general">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Text2" style="position:absolute;left:283px;top:62px;width:427px;height:16px;text-align:right;z-index:14;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Libellé du type de bien en location</strong></span></div>
<input type="text" id="item1" style="position:absolute;left:723px;top:56px;width:159px;height:22px;line-height:22px;z-index:15;" name="item1" value="<?php  echo $item1;  ?>">
<div id="wb_Text3" style="position:absolute;left:283px;top:96px;width:427px;height:16px;text-align:right;z-index:16;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>URL <u>absolue</u> jusqu'au répertoire admin du calendrier</strong></span></div>
<input type="text" id="repertoire_installation" style="position:absolute;left:723px;top:90px;width:159px;height:22px;line-height:22px;z-index:17;" name="repertoire_installation" value="<?php  echo $repertoire_installation;  ?>">
<div id="wb_Extension1" style="position:absolute;left:887px;top:92px;width:21px;height:21px;z-index:18;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#FF6820" face="MS Sans Serif"><b>Attention: indiquez l' adresse absolue d'installation du script jusqu'au répertoire admin ( répertoire admin non compris), c'est à dire du type http://www.images/</b></font></em></a></div>
<div id="wb_Extension2" style="position:absolute;left:887px;top:57px;width:21px;height:21px;z-index:19;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Libellé du type de bien en location.<br>
Le libellé sera affiché pour les sélecteur de locations mais aussi sur plusieurs pages de l'espace administrateur.<br>
De préfrence, garder un terme générique, type :<br>
- Logements<br>
- Bateaux<br>
- vélos<br>
etc...<br>
Evitez le nom d'établissement.</font></em></a></div>
</div>
<div id="wb_MasterPage9" style="position:absolute;left:12px;top:3269px;width:964px;height:129px;z-index:285;">
<table style="position:absolute;left:0px;top:0px;width:964px;height:34px;z-index:20;" cellpadding="4" cellspacing="0" id="Table1">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Paramétrer le sélécteur de date ( date picker)</strong></span></td>
</tr>
</table>
<table style="position:absolute;left:0px;top:41px;width:960px;height:88px;z-index:21;" cellpadding="0" cellspacing="1" id="Table3_date_picker">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Text2" style="position:absolute;left:226px;top:63px;width:489px;height:16px;text-align:right;z-index:22;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Barrer les numéros de jour qui sont antiérieure à la date d'aujourd'hui</strong></span></div>
<input type="checkbox" id="Checkbox2" name="jour_barre_date_picker" value="on" style="position:absolute;left:727px;top:62px;z-index:23;" <?php if ( $jour_barre_date_picker) {echo 'checked';} ?>>
<div id="wb_Extension1" style="position:absolute;left:749px;top:61px;width:21px;height:21px;z-index:24;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Activer cette option pour barrer les numéros des jours, sur le sélecteur de date, qui sont antérieurs à la date d'aujourd'hui..</font></em></a></div>
</div>
<div id="wb_MasterPage8" style="position:absolute;left:12px;top:3078px;width:964px;height:174px;z-index:286;">
<table style="position:absolute;left:0px;top:0px;width:964px;height:34px;z-index:25;" cellpadding="4" cellspacing="0" id="Table1">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Paramétrer le calendrier 1 mois</strong></span></td>
</tr>
</table>
<table style="position:absolute;left:0px;top:44px;width:960px;height:130px;z-index:26;" cellpadding="0" cellspacing="1" id="Table2_cal_1_mois">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Text2" style="position:absolute;left:282px;top:69px;width:427px;height:16px;text-align:right;z-index:27;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Hystéresis de navigation dans les mois précedents au mois actuel</strong></span></div>
<div id="wb_Text1" style="position:absolute;left:282px;top:101px;width:427px;height:16px;text-align:right;z-index:28;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Hystéresis de navigation dans les mois postérieurs au mois actuel</strong></span></div>
<input type="text" id="hysteresis_plus" style="position:absolute;left:722px;top:95px;width:159px;height:22px;line-height:22px;z-index:29;" name="hysteresis_plus" value="<?php  echo $hysteresis_plus;  ?>">
<input type="text" id="hysteresis_moins" style="position:absolute;left:722px;top:63px;width:159px;height:22px;line-height:22px;z-index:30;" name="hysteresis_moins" value="<?php  echo $hysteresis_moins;  ?>">
<div id="wb_Extension1" style="position:absolute;left:887px;top:96px;width:21px;height:21px;z-index:31;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Nombre de mois maximum qu'un visiteur peut &quot;reculer&quot; par rapport au mois actuel.<br>
</font></em></a></div>
<div id="wb_Extension2" style="position:absolute;left:887px;top:65px;width:21px;height:21px;z-index:32;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Nombre de mois maximum qu'un visiteur peut &quot;avancer&quot; par rapport au mois actuel.<br>
</font></em></a></div>
</div>
<div id="wb_MasterPage12" style="position:absolute;left:13px;top:2830px;width:964px;height:248px;z-index:287;">
<table style="position:absolute;left:0px;top:0px;width:964px;height:34px;z-index:33;" cellpadding="4" cellspacing="0" id="Table1">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Paramétres calendrier pour toutes les locations</strong></span></td>
</tr>
</table>
<table style="position:absolute;left:1px;top:43px;width:960px;height:196px;z-index:34;" cellpadding="0" cellspacing="1" id="Table2_cal_tous">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Text3" style="position:absolute;left:283px;top:96px;width:427px;height:16px;text-align:right;z-index:35;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Nombre de semaine à afficher</strong></span></div>
<input type="text" id="nombre_semaine_calendrier_tous" style="position:absolute;left:723px;top:90px;width:159px;height:22px;line-height:22px;z-index:36;" name="nombre_semaine_calendrier_tous" value="<?php  echo $nombre_semaine_calendrier_tous;  ?>">
<div id="wb_Text1" style="position:absolute;left:430px;top:59px;width:281px;height:18px;text-align:right;z-index:37;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Commencé le calendrier&nbsp; le</strong></span></div>
<select name="texte_jour_debut_calendrier_tous" size="1" id="Combobox1" style="position:absolute;left:721px;top:55px;width:177px;height:24px;z-index:38;" >
<option <?php if ( $texte_jour_debut_calendrier_tous == "lundi" ) echo "selected"; ?> value="lundi">lundi</option>
<option <?php if ( $texte_jour_debut_calendrier_tous == "mardi" ) echo "selected"; ?> value="mardi">mardi</option>
<option <?php if ( $texte_jour_debut_calendrier_tous == "mercredi" ) echo "selected"; ?> value="mercredi">mercredi</option>
<option <?php if ( $texte_jour_debut_calendrier_tous == "jeudi" ) echo "selected"; ?> value="jeudi">jeudi</option>
<option <?php if ( $texte_jour_debut_calendrier_tous == "vendredi" ) echo "selected"; ?> value="vendredi">vendredi</option>
<option <?php if ( $texte_jour_debut_calendrier_tous == "samedi" ) echo "selected"; ?> value="samedi">samedi</option>
<option <?php if ( $texte_jour_debut_calendrier_tous == "dimanche" ) echo "selected"; ?> value="dimanche">dimanche</option>
</select>
<div id="wb_Text2" style="position:absolute;left:283px;top:132px;width:427px;height:16px;text-align:right;z-index:39;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Offset de départ en jour par rapport au début du mois</strong></span></div>
<select name="offset_depart_calendrier_tous" size="1" id="Combobox2" style="position:absolute;left:723px;top:127px;width:177px;height:24px;z-index:40;" >
<option <?php if ( $offset_depart_calendrier_tous == -21 ) echo "selected"; ?> value="-21">-21 jours</option>
<option <?php if ( $offset_depart_calendrier_tous == -14 ) echo "selected"; ?> value="-14">-14 jours</option>
<option <?php if ( $offset_depart_calendrier_tous == -7 ) echo "selected"; ?> value="-7">-7 jours</option>
<option <?php if ( $offset_depart_calendrier_tous == 0 ) echo "selected"; ?> value="0">0 jour</option>
<option <?php if ( $offset_depart_calendrier_tous == 7 ) echo "selected"; ?> value="7">+7 jours</option>
<option <?php if ( $offset_depart_calendrier_tous == 14 ) echo "selected"; ?> value="14">+14 jours</option>
<option <?php if ( $offset_depart_calendrier_tous == 21 ) echo "selected"; ?> value="21">+21 jours</option>
</select>
<div id="wb_Text4" style="position:absolute;left:283px;top:168px;width:427px;height:16px;text-align:right;z-index:41;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Nombre de jours pour les liens&nbsp; &quot;avance et recule&quot; du calendrier</strong></span></div>
<select name="nombre_jour_avance_recul_calendrier_tous" size="1" id="Combobox3" style="position:absolute;left:723px;top:163px;width:177px;height:24px;z-index:42;" >
<option <?php if ( $nombre_jour_avance_recul_calendrier_tous == 7 ) echo "selected"; ?> value="7">1 semaine</option>
<option <?php if ( $nombre_jour_avance_recul_calendrier_tous == 14 ) echo "selected"; ?> value="14">2 semaines</option>
<option <?php if ( $nombre_jour_avance_recul_calendrier_tous == 21 ) echo "selected"; ?> value="21">3 semaines</option>
<option <?php if ( $nombre_jour_avance_recul_calendrier_tous == 28 ) echo "selected"; ?> value="28">4 semaines</option>
<option <?php if ( $nombre_jour_avance_recul_calendrier_tous == 35 ) echo "selected"; ?> value="35">5 semaines</option>
<option <?php if ( $nombre_jour_avance_recul_calendrier_tous == 42 ) echo "selected"; ?> value="42">6 semaines</option>
<option <?php if ( $nombre_jour_avance_recul_calendrier_tous == 49 ) echo "selected"; ?> value="49">7 semaines</option>
</select>
<div id="wb_Text5" style="position:absolute;left:306px;top:203px;width:404px;height:16px;text-align:right;z-index:43;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur fond cellule de séparation des mois et des locations</strong></span></div>
<div id="wb_Extension1" style="position:absolute;left:724px;top:198px;width:175px;height:50px;z-index:44;">
<input type="text" id="couleur_separateur_calendrier_tous" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_separateur_calendrier_tous" value="<?php echo  $couleur_separateur_calendrier_tous;  ?>" class="color {hash:true}" ></div>
<div id="wb_Extension2" style="position:absolute;left:903px;top:199px;width:21px;height:21px;z-index:45;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleurs de fond des lignes verticales de spération des mois, et lignes horizontales de séparation des mois.</font></em></a></div>
<div id="wb_Extension3" style="position:absolute;left:903px;top:164px;width:21px;height:21px;z-index:46;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Nombre de jours pour déplacer le premier jour du calendrier &quot;toutes locations&quot; </font></em></a></div>
<div id="wb_Extension4" style="position:absolute;left:903px;top:129px;width:21px;height:21px;z-index:47;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Pour le calendrier &quot;toutes locations&quot; , vous pouvez déterminer un &quot;offset&quot; de départ  qui sera appliqué au premier jour du calendrier, après avoir sélectionné un mois.<br>
L'offset est calculée par rapport au debut du mois et au jour de début de semaine paramétré</font></em></a></div>
<div id="wb_Extension5" style="position:absolute;left:903px;top:91px;width:21px;height:21px;z-index:48;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Pour le calendrier &quot;toutes locations&quot; , nombre total de semaine à afficher.</font></em></a></div>
<div id="wb_Extension6" style="position:absolute;left:903px;top:55px;width:21px;height:21px;z-index:49;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Pour le calendrier &quot;toutes locations&quot; , les déplacements, chanements de date du premier jour se font toujours par semaine entière.<br>
Indiquez le jour de la semaine ( lundi, samedi,etc..) avec lequel il faudra toujours commencer le calendrier.</font></em></a></div>
</div>
<div id="wb_MasterPage7" style="position:absolute;left:13px;top:2245px;width:964px;height:570px;z-index:288;">
<table style="position:absolute;left:0px;top:0px;width:964px;height:34px;z-index:50;" cellpadding="4" cellspacing="0" id="Table1">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Paramétrer les modules du calendrier visiteur</strong></span></td>
</tr>
</table>
<table style="position:absolute;left:0px;top:42px;width:960px;height:528px;z-index:51;" cellpadding="0" cellspacing="1" id="Table3_module">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Text2" style="position:absolute;left:396px;top:145px;width:316px;height:16px;text-align:right;z-index:52;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Afficher le sélecteur de locataire </strong></span></div>
<div id="Html2" style="position:absolute;left:486px;top:120px;width:231px;height:22px;z-index:53">
<?php
echo '<div id="wb_Text1" align="right"><font style="font-size:13px;align:right" color="#000000" face="Arial"><b>Afficher le sélecteur de ',$item1,'</b></font></div>';
?></div>
<div id="wb_Text1" style="position:absolute;left:397px;top:96px;width:316px;height:16px;text-align:right;z-index:54;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Afficher la légende des couleurs </strong></span></div>
<div id="wb_Text4" style="position:absolute;left:397px;top:73px;width:316px;height:16px;text-align:right;z-index:55;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Afficher le sélecteur d'année </strong></span></div>
<div id="wb_Text3" style="position:absolute;left:397px;top:48px;width:316px;height:16px;text-align:right;z-index:56;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Afficher le sélecteur de mois </strong></span></div>
<input type="checkbox" id="Checkbox2" name="selection_mois_visteur" value="on" style="position:absolute;left:725px;top:47px;z-index:57;" <?php if ( $selection_mois_visteur) {echo 'checked';} ?>>
<input type="checkbox" id="Checkbox1" name="selection_an_visteur" value="on" style="position:absolute;left:725px;top:72px;z-index:58;" <?php if ( $selection_an_visteur) {echo 'checked';} ?>>
<input type="checkbox" id="Checkbox4" name="avec_selection_couleur_visteur" value="on" style="position:absolute;left:724px;top:96px;z-index:59;" <?php if ( $avec_selection_couleur_visteur) {echo 'checked';} ?>>
<input type="checkbox" id="Checkbox3" name="avec_selection_logement_visteur" value="on" style="position:absolute;left:724px;top:119px;z-index:60;" <?php if ( $avec_selection_logement_visteur) {echo 'checked';} ?>>
<input type="checkbox" id="Checkbox6" name="avec_selection_locataire_visteur" value="on" style="position:absolute;left:724px;top:144px;z-index:61;" <?php if ( $avec_selection_locataire_visteur) {echo 'checked';} ?>>
<div id="wb_Extension2" style="position:absolute;left:724px;top:169px;width:175px;height:50px;z-index:62;">
<input type="text" id="couleur_fond_page_visiteur" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_fond_page_visiteur" value="<?php echo  $couleur_fond_page_visiteur;  ?>" class="color {hash:true}" ></div>
<div id="wb_Text6" style="position:absolute;left:383px;top:174px;width:327px;height:16px;text-align:right;z-index:63;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur de fond de la page calendrier visiteur</strong></span></div>
<div id="wb_Text8" style="position:absolute;left:293px;top:261px;width:419px;height:16px;text-align:right;z-index:64;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Afficher un lien vers une autre page avec la date en paramètre </strong></span></div>
<div id="wb_Text7" style="position:absolute;left:395px;top:291px;width:317px;height:32px;text-align:right;z-index:65;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Adresse du lien de destination<br>(voir aide)</strong></span></div>
<textarea name="lien_autre_page_visiteur" id="TextArea1" style="position:absolute;left:725px;top:284px;width:198px;height:60px;z-index:66;" rows="2" cols="22"><?php  echo htmlentities(stripslashes($lien_autre_page_visiteur));  ?></textarea>
<input type="checkbox" id="Checkbox5" name="avec_lien_autre_page_visiteur" value="on" style="position:absolute;left:724px;top:260px;z-index:67;" <?php if ( $avec_lien_autre_page_visiteur) {echo 'checked';} ?>>
<div id="wb_Text12" style="position:absolute;left:389px;top:358px;width:323px;height:16px;text-align:right;z-index:68;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Format de la date envoyé vers l'autre page</strong></span></div>
<div id="wb_Text11" style="position:absolute;left:223px;top:387px;width:489px;height:16px;text-align:right;z-index:69;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Barrer les numéros de jour qui sont antiérieurs à la date d'aujourd'hui</strong></span></div>
<div id="wb_Text14" style="position:absolute;left:223px;top:413px;width:489px;height:16px;text-align:right;z-index:70;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Afficher la date de dernière mise à jour du calendrier</strong></span></div>
<input type="checkbox" id="Checkbox7" name="avec_date_mise_jour_calendrier" value="on" style="position:absolute;left:724px;top:412px;z-index:71;" <?php if ( $avec_date_mise_jour_calendrier) {echo 'checked';} ?>>
<input type="checkbox" id="Checkbox10" name="jour_barre_calendrier_visiteur" value="on" style="position:absolute;left:724px;top:386px;z-index:72;" <?php if ( $jour_barre_calendrier_visiteur) {echo 'checked';} ?>>
<select name="format_date_fr" size="1" id="Combobox2" style="position:absolute;left:725px;top:354px;width:164px;height:23px;z-index:73;" >
<option <?php if ( $format_date_fr) echo "selected"; ?> value="on">Fr JJ/MM/AAAA</option>
<option <?php if ( !$format_date_fr ) echo "selected"; ?> value="off">Eng AAAA/MM/JJ</option>
</select>
<div id="wb_Text10" style="position:absolute;left:215px;top:235px;width:492px;height:16px;text-align:right;z-index:74;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Activer les diagonales dans les cellules qui sont marquées&nbsp; (voir aide)</strong></span></div>
<input type="checkbox" id="Checkbox8" name="avec_diagonale_cellule" value="on" style="position:absolute;left:723px;top:233px;z-index:75;" <?php if ( $avec_diagonale_cellule) {echo 'checked';} ?>>
<div id="wb_Text17" style="position:absolute;left:396px;top:441px;width:316px;height:16px;text-align:right;z-index:76;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Afficher les infobulles&nbsp; sur le calendrier visiteur</strong></span></div>
<input type="checkbox" id="Checkbox9" name="avec_infobulle_visiteur" value="on" style="position:absolute;left:724px;top:440px;z-index:77;" <?php if ( $avec_infobulle_visiteur) {echo 'checked';} ?>>
<div id="wb_Text20" style="position:absolute;left:264px;top:466px;width:448px;height:16px;text-align:right;z-index:78;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Ajouter le nom du locataire aux infobulles sur le calendrier visiteur</strong></span></div>
<input type="checkbox" id="Checkbox11" name="avec_locataire_infobulle_visiteur" value="on" style="position:absolute;left:724px;top:465px;z-index:79;" <?php if ( $avec_locataire_infobulle_visiteur) {echo 'checked';} ?>>
<div id="wb_Text21" style="position:absolute;left:208px;top:491px;width:504px;height:16px;text-align:right;z-index:80;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Ajouter le libellé de la couleur aux infobulles sur le calendrier visiteur</strong></span></div>
<input type="checkbox" id="Checkbox12" name="avec_couleur_infobulle_visiteur" value="on" style="position:absolute;left:724px;top:490px;z-index:81;" <?php if ( $avec_couleur_infobulle_visiteur) {echo 'checked';} ?>>
<input type="checkbox" id="Checkbox13" name="avec_logement_infobulle_visiteur" value="on" style="position:absolute;left:724px;top:514px;z-index:82;" <?php if ( $avec_logement_infobulle_visiteur) {echo 'checked';} ?>>
<div id="Html1" style="position:absolute;left:171px;top:516px;width:547px;height:19px;z-index:83">
<?php
echo '<div id="wb_Text1" align="right"><font style="font-size:13px" color="#000000" face="Arial"><b>Ajouter le libellé ',$item1,' aux infobulles sur le calendrier visiteur</b></font></div>';
?></div>
<div id="wb_Text5" style="position:absolute;left:208px;top:541px;width:504px;height:16px;text-align:right;z-index:84;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Ajouter le tarif aux infobulles sur le calendrier visiteur</strong></span></div>
<input type="checkbox" id="Checkbox14" name="avec_tarif_infobulle_visiteur" value="on" style="position:absolute;left:724px;top:540px;z-index:85;" <?php if ( $avec_tarif_infobulle_visiteur) {echo 'checked';} ?>>
<div id="wb_Text9" style="position:absolute;left:215px;top:208px;width:492px;height:16px;text-align:right;z-index:86;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Fond de page transparent des calendriers visiteur</strong></span></div>
<input type="checkbox" id="Checkbox15" name="avec_transparence_calendrier" value="on" style="position:absolute;left:723px;top:206px;z-index:87;" <?php if ( $avec_transparence_calendrier) {echo 'checked';} ?>>
<div id="wb_Extension20" style="position:absolute;left:743px;top:538px;width:21px;height:21px;z-index:88;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Ajouter dans les infobulles du calendrier visiteur, le tarif si les infobulles visiteur sont activées.</font></em></a></div>
<div id="wb_Extension19" style="position:absolute;left:743px;top:513px;width:21px;height:21px;z-index:89;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Ajouter dans les infobulles du calendrier visiteur, le nom de la location </font><font style="font-size:13px" color="#000000" face="MS Sans Serif"> si les infobulles visiteur sont activées.</font></em></a></div>
<div id="wb_Extension18" style="position:absolute;left:743px;top:488px;width:21px;height:21px;z-index:90;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Ajouter dans les infobulles du calendrier visiteur, le libellé de la couleur si les infobulles visiteur sont activées.</font></em></a></div>
<div id="wb_Extension3" style="position:absolute;left:743px;top:465px;width:21px;height:21px;z-index:91;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Ajouter dans les infobulles du calendrier visiteur, le nom du locataire si les infobulles visiteur sont activées.</font></em></a></div>
<div id="wb_Extension1" style="position:absolute;left:743px;top:440px;width:21px;height:21px;z-index:92;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Afficher les infobulles sur les calendriers visiteurs .</font></em></a></div>
<div id="wb_Extension4" style="position:absolute;left:743px;top:411px;width:21px;height:21px;z-index:93;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Afficher la date de la dernière mise à jour du calendrier, en dessous des calendriers visiteurs.</font></em></a></div>
<div id="wb_Extension5" style="position:absolute;left:743px;top:385px;width:21px;height:21px;z-index:94;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Activer cette option pour barrer les numéros des jours, sur le calendrier visiteur, qui sont antérieurs à la date d'aujourd'hui..</font></em></a></div>
<div id="wb_Extension6" style="position:absolute;left:932px;top:354px;width:21px;height:21px;z-index:95;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Format de la date contenu dans les liens des calendriers visiteurs, si l'option afficher un lien contenant la date sur le calendrier visiteur est activée</font></em></a></div>
<div id="wb_Extension7" style="position:absolute;left:932px;top:283px;width:21px;height:21px;z-index:96;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Si vous avez cochez la case permettant d'afficher un lien vers une autre page sur le calendrier visiteur, vous pouvez indiquer la page de destination du lien </font><font style="font-size:13px" color="#000000" face="MS Sans Serif">si l'option afficher un lien contenant la date sur le calendrier visiteur est activée</font><font style="font-size:11px" color="#000000" face="MS Sans Serif"><br>
</font><font style="font-size:13px" color="#000000" face="MS Sans Serif">.<br>
Ceci vous permet par exemple, d'afficher le contenu de l'événement qui a lieu à cette date ci. <br>
<b><u>exemples:</u></b><br>
- vous voulez envoyer la date cliqué vers la page planning.php dans une nouvelle fenêtre, date que vous récupérer dans une variable $datecal<br>
<b>Ne modifier pas les 4 xxxx ils seront automatiquement remplacés par la date</b><br>
 - <b>inscrivez :</b> href=&quot;planning.php?datecal=xxxx&quot; target=&quot;_blank&quot;<br>
- Vous voulez ouvrir une page planning.php dans une fenêtre popup qui affichera un descriptif de l'événement pour cette date, date que vous récupérez dans une varaiable par exemple $datecal<br>
- <b>Inscrivez :</b> onclick=window.open('planing.php?datecal=xxxx','_blank','toolbar=0, location=1, directories=0, status=0, scrollbars=0, resizable=1, copyhistory=0, menuBar=0, width=800, height=650, left=50, top=50');return(false)&quot; href=&quot;#&quot;<br>
<br>
Voir FAQ du site</font></em></a></div>
<div id="wb_Extension8" style="position:absolute;left:743px;top:259px;width:21px;height:21px;z-index:97;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Cette option va automatiquement ajouter sur les calendriers visiteurs un lien paramètrable contenant la date  vers la page de votre choix</font></em></a></div>
<div id="wb_Extension9" style="position:absolute;left:743px;top:233px;width:21px;height:21px;z-index:98;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Cette option vous permet d'afficher des diagonales entre les différentes dates de couleurs différentes.<br>
</font><font style="font-size:13px" color="#FF6820" face="MS Sans Serif">La librairie GD doit être activée sur votre serveur pour que les diagonales fonctionnent.</font></em></a></div>
<div id="wb_Extension10" style="position:absolute;left:743px;top:206px;width:21px;height:21px;z-index:99;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Le fond de la page des calendriers sera transparent, dans le menu &quot;code&quot; vous trouverez des codes frames pour afficher votre calendrier avec un fond transparent</font></em></a></div>
<div id="wb_Extension17" style="position:absolute;left:834px;top:171px;width:21px;height:21px;z-index:100;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur de fond des pages calendrier visiteurs.<br>
Actif uniquement si le fond de page transparent n'est pas sélectionné.</font></em></a></div>
<div id="wb_Extension11" style="position:absolute;left:743px;top:143px;width:21px;height:21px;z-index:101;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Permet d'afficher une liste de choix avec la liste des locataires sur les calendriers visiteurs</font></em></a></div>
<div id="wb_Extension12" style="position:absolute;left:743px;top:120px;width:21px;height:21px;z-index:102;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Permet d'afficher une liste de choix avec la liste des locations sur les calendriers visiteurs</font></em></a></div>
<div id="wb_Extension13" style="position:absolute;left:743px;top:96px;width:21px;height:21px;z-index:103;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Permet d'afficher la légende des couleurs (libellé couleur) sur les calendriers visiteurs</font></em></a></div>
<div id="wb_Extension14" style="position:absolute;left:743px;top:72px;width:21px;height:21px;z-index:104;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Permet d'afficher un sélecteur d'année sur les calendriers visiteurs</font></em></a></div>
<div id="wb_Extension15" style="position:absolute;left:743px;top:47px;width:21px;height:21px;z-index:105;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Permet d'afficher un sélecteur de mois sur les calendriers visiteurs</font></em></a></div>
</div>
<div id="wb_MasterPage6" style="position:absolute;left:11px;top:2043px;width:964px;height:185px;z-index:289;">
<table style="position:absolute;left:0px;top:0px;width:964px;height:34px;z-index:106;" cellpadding="4" cellspacing="0" id="Table1">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Paramétrer le sélécteur mois et année</strong></span></td>
</tr>
</table>
<table style="position:absolute;left:0px;top:43px;width:960px;height:142px;z-index:107;" cellpadding="0" cellspacing="1" id="Table3_selecteur">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Text2" style="position:absolute;left:428px;top:62px;width:277px;height:16px;text-align:right;z-index:108;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Largeur du sélecteur de mois et années</strong></span></div>
<input type="text" id="largeur_selec_date" style="position:absolute;left:718px;top:56px;width:159px;height:22px;line-height:22px;z-index:109;" name="largeur_sel_mois_annee" value="<?php  echo $largeur_sel_mois_annee;  ?>">
<input type="text" id="police_select_date" style="position:absolute;left:718px;top:87px;width:159px;height:22px;line-height:22px;z-index:110;" name="taille_police_sel_mois_annee" value="<?php  echo $taille_police_sel_mois_annee;  ?>">
<div id="wb_Text1" style="position:absolute;left:388px;top:93px;width:317px;height:16px;text-align:right;z-index:111;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Taille de la police des sélecteurs mois et année</strong></span></div>
<div id="wb_Text4" style="position:absolute;left:376px;top:123px;width:327px;height:16px;text-align:right;z-index:112;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur de la police des sélecteurs mois et année</strong></span></div>
<div id="wb_couleur_select_date" style="position:absolute;left:717px;top:118px;width:175px;height:50px;z-index:113;">
<input type="text" id="couleur_sel_mois_annee" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_sel_mois_annee" value="<?php echo  $couleur_sel_mois_annee;  ?>" class="color {hash:true}" ></div>
<div id="wb_Extension1" style="position:absolute;left:883px;top:120px;width:21px;height:21px;z-index:114;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur de police des textes sélecteur de mois et année sur les calendriers visiteurs et administrateurs.<br>
Pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs,  cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de  la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension2" style="position:absolute;left:883px;top:89px;width:21px;height:21px;z-index:115;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Taille police des textes sélecteur de mois et année sur les calendriers visiteurs et administrateurs.</font></em></a></div>
<div id="wb_Extension3" style="position:absolute;left:883px;top:57px;width:21px;height:21px;z-index:116;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Largeur sélecteur de mois et année sur les calendriers visiteurs et administrateurs.</font></em></a></div>
</div>
<div id="wb_MasterPage5" style="position:absolute;left:11px;top:844px;width:964px;height:1188px;z-index:290;">
<table style="position:absolute;left:0px;top:0px;width:964px;height:34px;z-index:117;" cellpadding="4" cellspacing="0" id="Table1">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Paramétrer l'aspect du calendrier</strong></span></td>
</tr>
</table>
<table style="position:absolute;left:0px;top:42px;width:960px;height:1146px;z-index:118;" cellpadding="0" cellspacing="1" id="Table2_aspect">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Text2" style="position:absolute;left:297px;top:61px;width:409px;height:16px;text-align:right;z-index:119;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur fond cellule nom numéro des semaines </strong></span></div>
<div id="wb_Extension2" style="position:absolute;left:720px;top:56px;width:175px;height:50px;z-index:120;">
<input type="text" id="couleur_nom_numero_semaine" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_nom_numero_semaine" value="<?php echo  $couleur_nom_numero_semaine;  ?>" class="color {hash:true}" ></div>
<div id="wb_Text1" style="position:absolute;left:325px;top:92px;width:381px;height:16px;text-align:right;z-index:121;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur fond cellule contenant le numéro des semaines </strong></span></div>
<div id="wb_Extension1" style="position:absolute;left:720px;top:87px;width:175px;height:50px;z-index:122;">
<input type="text" id="couleur_numero_semaine" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_numero_semaine" value="<?php echo  $couleur_numero_semaine;  ?>" class="color {hash:true}" ></div>
<div id="wb_Text4" style="position:absolute;left:293px;top:124px;width:413px;height:16px;text-align:right;z-index:123;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur fond cellules noms des jours de semaine du calendrier </strong></span></div>
<div id="wb_Extension4" style="position:absolute;left:720px;top:119px;width:175px;height:50px;z-index:124;">
<input type="text" id="couleur_jour_semaine" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_jour_semaine" value="<?php echo  $couleur_jour_semaine;  ?>" class="color {hash:true}" ></div>
<div id="wb_Text3" style="position:absolute;left:322px;top:155px;width:384px;height:16px;text-align:right;z-index:125;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur fond cellule lettres des jours des week end </strong></span></div>
<div id="wb_Extension3" style="position:absolute;left:720px;top:150px;width:175px;height:50px;z-index:126;">
<input type="text" id="couleur_nom_jour_week_end" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_nom_jour_week_end" value="<?php echo  $couleur_nom_jour_week_end;  ?>" class="color {hash:true}" ></div>
<div id="wb_Text6" style="position:absolute;left:360px;top:187px;width:346px;height:16px;text-align:right;z-index:127;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur fond cellule des jours en week end </strong></span></div>
<div id="wb_Extension6" style="position:absolute;left:720px;top:182px;width:175px;height:50px;z-index:128;">
<input type="text" id="couleur_jour_week_end" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_jour_week_end" value="<?php echo  $couleur_jour_week_end;  ?>" class="color {hash:true}" ></div>
<div id="wb_Text8" style="position:absolute;left:213px;top:286px;width:492px;height:16px;text-align:right;z-index:129;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Avec continuité des couleurs même si la cellule des jours week end est vide </strong></span></div>
<div id="wb_Text9" style="position:absolute;left:402px;top:315px;width:305px;height:16px;text-align:right;z-index:130;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur fond cellule affichant le mois </strong></span></div>
<div id="wb_Extension5" style="position:absolute;left:721px;top:310px;width:175px;height:50px;z-index:131;">
<input type="text" id="couleur_fond_mois" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_fond_mois" value="<?php echo  $couleur_fond_mois;  ?>" class="color {hash:true}" ></div>
<div id="wb_Text12" style="position:absolute;left:311px;top:382px;width:396px;height:16px;text-align:right;z-index:132;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>URL <u>absolue</u> image de fond cellule affichant le mois et année</strong></span></div>
<div id="wb_Text11" style="position:absolute;left:311px;top:417px;width:397px;height:16px;text-align:right;z-index:133;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Alignement vertical image de fond cellule </strong></span></div>
<div id="wb_Text14" style="position:absolute;left:305px;top:452px;width:402px;height:16px;text-align:right;z-index:134;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Alignement horizontal image de fond cellule </strong></span></div>
<div id="wb_Text13" style="position:absolute;left:315px;top:348px;width:391px;height:16px;text-align:right;z-index:135;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur fond cellule des jours non marqués en semaine</strong></span></div>
<div id="wb_Text16" style="position:absolute;left:392px;top:960px;width:316px;height:16px;text-align:right;z-index:136;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Mettre une couleur de fond pour le jour actuel </strong></span></div>
<div id="wb_Text15" style="position:absolute;left:405px;top:996px;width:301px;height:16px;text-align:right;z-index:137;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur fond cellule du jour d'aujourd'hui</strong></span></div>
<div id="wb_Extension8" style="position:absolute;left:719px;top:992px;width:175px;height:50px;z-index:138;">
<input type="text" id="couleur_jour_aujourd_hui" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_jour_aujourd_hui" value="<?php echo  $couleur_jour_aujourd_hui;  ?>" class="color {hash:true}" ></div>
<div id="wb_Extension7" style="position:absolute;left:720px;top:343px;width:175px;height:50px;z-index:139;">
<input type="text" id="couleur_libre" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_libre" value="<?php echo  $couleur_libre;  ?>" class="color {hash:true}" ></div>
<select name="alignement_horizontal_image_fond" size="1" id="Combobox2" style="position:absolute;left:720px;top:448px;width:161px;height:24px;z-index:140;" >
<option <?php if ( $alignement_horizontal_image_fond == "left" ) echo "selected"; ?> value="left">Gauche</option>
<option <?php if ( $alignement_horizontal_image_fond == "center" ) echo "selected"; ?> value="center">Centre</option>
<option <?php if ( $alignement_horizontal_image_fond == "right" ) echo "selected"; ?> value="right">Droite</option>
</select>
<select name="alignement_vertical_image_fond" size="1" id="Combobox1" style="position:absolute;left:720px;top:413px;width:161px;height:24px;z-index:141;" >
<option <?php if ( $alignement_vertical_image_fond == "top" ) echo "selected"; ?> value="top">Haut</option>
<option <?php if ( $alignement_vertical_image_fond == "center" ) echo "selected"; ?> value="center">Centre</option>
<option <?php if ( $alignement_vertical_image_fond == "bottom" ) echo "selected"; ?> value="bottom">Bas</option>
</select>
<input type="text" id="url_image_fond_mois" style="position:absolute;left:720px;top:376px;width:159px;height:22px;line-height:22px;z-index:142;" name="url_image_fond_mois" value="<?php  echo $url_image_fond_mois;  ?>">
<div id="wb_Text21" style="position:absolute;left:369px;top:222px;width:338px;height:16px;text-align:right;z-index:143;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Largeur trait fin de semaine sous le dimanche</strong></span></div>
<div id="wb_Text23" style="position:absolute;left:350px;top:257px;width:359px;height:16px;text-align:right;z-index:144;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur trait fin de semaine sous le dimanche</strong></span></div>
<div id="wb_Extension9" style="position:absolute;left:721px;top:250px;width:175px;height:50px;z-index:145;">
<input type="text" id="couleur_ligne_fin_semaine" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_ligne_fin_semaine" value="<?php echo  $couleur_ligne_fin_semaine;  ?>" class="color {hash:true}" ></div>
<input type="text" id="bordure_ligne_fin_semaine" style="position:absolute;left:720px;top:216px;width:159px;height:22px;line-height:22px;z-index:146;" name="bordure_ligne_fin_semaine" value="<?php  echo $bordure_ligne_fin_semaine;  ?>">
<input type="checkbox" id="Checkbox4" name="avec_marquage_du_jour_d_aujourd_hui" value="on" style="position:absolute;left:721px;top:960px;z-index:147;" <?php if ( $avec_marquage_du_jour_d_aujourd_hui) {echo 'checked';} ?>>
<div id="wb_Text24" style="position:absolute;left:281px;top:492px;width:426px;height:16px;text-align:right;z-index:148;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>URL <u>absolue</u> image de fond cellule numéro de jour du calendrier</strong></span></div>
<input type="text" id="url_image_fond_cellule" style="position:absolute;left:719px;top:486px;width:159px;height:22px;line-height:22px;z-index:149;" name="url_image_fond_cellule" value="<?php  echo $url_image_fond_cellule;  ?>">
<div id="wb_Text25" style="position:absolute;left:274px;top:677px;width:432px;height:16px;text-align:right;z-index:150;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Largeur, en pixel, de la bordure supérieur des cellules </strong></span></div>
<div id="wb_Text26" style="position:absolute;left:250px;top:749px;width:456px;height:16px;text-align:right;z-index:151;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Largeur, en pixel, de la bordure gauche des cellules </strong></span></div>
<input type="text" id="largeur_bordure_gauche" style="position:absolute;left:719px;top:743px;width:159px;height:22px;line-height:22px;z-index:152;" name="largeur_bordure_gauche" value="<?php  echo $largeur_bordure_gauche;  ?>">
<div id="wb_Text27" style="position:absolute;left:262px;top:712px;width:444px;height:16px;text-align:right;z-index:153;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Largeur, en pixel, de la bordure inférieur des cellules </strong></span></div>
<input type="text" id="largeur_bordure_inferieur" style="position:absolute;left:719px;top:706px;width:159px;height:22px;line-height:22px;z-index:154;" name="largeur_bordure_inferieur" value="<?php  echo $largeur_bordure_inferieur;  ?>">
<input type="text" id="largeur_bordure_droite" style="position:absolute;left:719px;top:779px;width:159px;height:22px;line-height:22px;z-index:155;" name="largeur_bordure_droite" value="<?php  echo $largeur_bordure_droite;  ?>">
<div id="wb_Text28" style="position:absolute;left:253px;top:785px;width:453px;height:16px;text-align:right;z-index:156;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Largeur, en pixel, de la bordure droite des cellules </strong></span></div>
<div id="wb_Text29" style="position:absolute;left:405px;top:638px;width:301px;height:16px;text-align:right;z-index:157;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur bordure des cellules </strong></span></div>
<div id="wb_Extension10" style="position:absolute;left:720px;top:633px;width:175px;height:50px;z-index:158;">
<input type="text" id="couleur_bordure_cellule_non_vide" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_bordure_cellule_non_vide" value="<?php echo  $couleur_bordure_cellule_non_vide;  ?>" class="color {hash:true}" ></div>
<input type="text" id="largeur_bordure_superieur" style="position:absolute;left:719px;top:671px;width:159px;height:22px;line-height:22px;z-index:159;" name="largeur_bordure_superieur" value="<?php  echo $largeur_bordure_superieur;  ?>">
<div id="wb_Text30" style="position:absolute;left:310px;top:565px;width:396px;height:16px;text-align:right;z-index:160;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>URL <u>absolue</u>&nbsp; image de fond cellule texte nom des jours</strong></span></div>
<input type="text" id="url_image_fond_cellule_nom_jour" style="position:absolute;left:719px;top:559px;width:159px;height:22px;line-height:22px;z-index:161;" name="url_image_fond_cellule_nom_jour" value="<?php  echo $url_image_fond_cellule_nom_jour;  ?>">
<div id="wb_Text31" style="position:absolute;left:310px;top:600px;width:396px;height:16px;text-align:right;z-index:162;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>URL <u>absolue</u> image de fond cellule numero de semaine</strong></span></div>
<input type="text" id="url_image_fond_cellule_numero_semaine" style="position:absolute;left:719px;top:594px;width:159px;height:22px;line-height:22px;z-index:163;" name="url_image_fond_cellule_numero_semaine" value="<?php  echo $url_image_fond_cellule_numero_semaine;  ?>">
<div id="wb_Text32" style="position:absolute;left:237px;top:817px;width:470px;height:16px;text-align:right;z-index:164;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Appliquer les bordures aux cellules avec les numéros de jour</strong></span></div>
<input type="checkbox" id="Checkbox3" name="avec_bordure_cellule_num_jour" value="on" style="position:absolute;left:719px;top:816px;z-index:165;" <?php if ( $avec_bordure_cellule_num_jour) {echo 'checked';} ?>>
<div id="wb_Text33" style="position:absolute;left:220px;top:845px;width:487px;height:16px;text-align:right;z-index:166;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Appliquer les bordures aux cellules avec les textes des jours</strong></span></div>
<input type="checkbox" id="Checkbox5" name="avec_bordure_cellule_texte_jour" value="on" style="position:absolute;left:719px;top:844px;z-index:167;" <?php if ( $avec_bordure_cellule_texte_jour) {echo 'checked';} ?>>
<div id="wb_Text34" style="position:absolute;left:212px;top:873px;width:495px;height:16px;text-align:right;z-index:168;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Appliquer les bordures aux cellules avec les numéros de semaine</strong></span></div>
<input type="checkbox" id="Checkbox6" name="avec_bordure_cellule_numero_semaine" value="on" style="position:absolute;left:719px;top:872px;z-index:169;" <?php if ( $avec_bordure_cellule_numero_semaine) {echo 'checked';} ?>>
<div id="wb_Text35" style="position:absolute;left:221px;top:901px;width:487px;height:16px;text-align:right;z-index:170;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Appliquer les bordures à la cellule avec le nom du mois</strong></span></div>
<input type="checkbox" id="Checkbox7" name="avec_bordure_cellule_nom_mois" value="on" style="position:absolute;left:720px;top:900px;z-index:171;" <?php if ( $avec_bordure_cellule_nom_mois) {echo 'checked';} ?>>
<div id="wb_Text36" style="position:absolute;left:310px;top:1030px;width:396px;height:16px;text-align:right;z-index:172;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>URL <u>absolue</u> image de fond cellule du jour d'aujourd'hui</strong></span></div>
<input type="text" id="url_image_fond_cellule_aujourd_hui" style="position:absolute;left:719px;top:1024px;width:159px;height:22px;line-height:22px;z-index:173;" name="url_image_fond_cellule_aujourd_hui" value="<?php  echo $url_image_fond_cellule_aujourd_hui;  ?>">
<div id="wb_Text37" style="position:absolute;left:222px;top:930px;width:487px;height:16px;text-align:right;z-index:174;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Appliquer les bordures et/ou image de fond aux cellules vides</strong></span></div>
<input type="checkbox" id="Checkbox8" name="avec_bordure_cellules_vides" value="on" style="position:absolute;left:721px;top:929px;z-index:175;" <?php if ( $avec_bordure_cellules_vides) {echo 'checked';} ?>>
<div id="wb_Text38" style="position:absolute;left:95px;top:527px;width:611px;height:16px;text-align:right;z-index:176;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>URL <u>absolue</u> image de fond cellule numéro des jours en week end du calendrier</strong></span></div>
<input type="text" id="url_image_fond_cellule_week_end" style="position:absolute;left:719px;top:521px;width:159px;height:22px;line-height:22px;z-index:177;" name="url_image_fond_cellule_week_end" value="<?php  echo $url_image_fond_cellule_week_end;  ?>">
<div id="wb_Text39" style="position:absolute;left:310px;top:1063px;width:396px;height:16px;text-align:right;z-index:178;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Espace entre les différents calendriers mensuel</strong></span></div>
<input type="text" id="espace_entre_les_mois" style="position:absolute;left:719px;top:1057px;width:159px;height:22px;line-height:22px;z-index:179;" name="espace_entre_les_mois" value="<?php  echo $espace_entre_les_mois;  ?>">
<div id="wb_Text40" style="position:absolute;left:310px;top:1095px;width:396px;height:16px;text-align:right;z-index:180;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Espace entre les cellules dans un calendrier mensuel</strong></span></div>
<input type="text" id="espace_entre_cellule" style="position:absolute;left:719px;top:1089px;width:159px;height:22px;line-height:22px;z-index:181;" name="espace_entre_cellule" value="<?php  echo $espace_entre_cellule;  ?>">
<input type="checkbox" id="Checkbox2" name="avec_continuite_couleur" value="on" style="position:absolute;left:721px;top:284px;z-index:182;" <?php if ( $avec_continuite_couleur) {echo 'checked';} ?>>
<div id="wb_Extension11" style="position:absolute;left:883px;top:1093px;width:21px;height:21px;z-index:183;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Espace, en pixel, separant les différentes cellules dans un même tableau &quot;mois&quot;.</font></em></a></div>
<div id="wb_Extension12" style="position:absolute;left:883px;top:1059px;width:21px;height:21px;z-index:184;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Espace, en pixel, separant les différentes calendrier mensuel.</font></em></a></div>
<div id="wb_Extension13" style="position:absolute;left:883px;top:1026px;width:21px;height:21px;z-index:185;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Adresse URL de l'image de fond de la cellule pour la date d'aujourd'hui si l'option &quot;Mettre une couleur de fond pour le jour actuel.<br>
</font><font style="font-size:13px" color="#FF6820" face="MS Sans Serif"><b>Attention: indiquez l' adresse absolue de l'image, c'est à dire du type http://www.images/mon_image.jpg ou  /images/mon_image.jpg</b></font></em></a></div>
<div id="wb_Extension14" style="position:absolute;left:883px;top:995px;width:21px;height:21px;z-index:186;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur de fond de la cellule pour la date d'aujourd'hui si l'option &quot;Mettre une couleur de fond pour le jour actuel.</font><font style="font-size:13px" color="#000000" face="MS Sans Serif"><br>
Pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs,  cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de  la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension15" style="position:absolute;left:743px;top:959px;width:21px;height:21px;z-index:187;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Cochez cette option pour mettre soit une couleur de fond spécifique, soit une image de fond spécifique pour le jour d'aujourd'hui dans les calendriers.</font></em></a></div>
<div id="wb_Extension16" style="position:absolute;left:743px;top:929px;width:21px;height:21px;z-index:188;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Les images de fond de cellules et ou les bordures de cellules seront aussi appliquées aux cellules &quot;vides&quot; , ne contenant aucun texte</font></em></a></div>
<div id="wb_Extension17" style="position:absolute;left:743px;top:900px;width:21px;height:21px;z-index:189;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Appliquer à la cellule affichant le nom des mois, les largeur de bordures renseignées ( si elles sont différentes de 0).</font></em></a></div>
<div id="wb_Extension18" style="position:absolute;left:743px;top:870px;width:21px;height:21px;z-index:190;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Appliquer à la cellule affichant les numéros de semaines, les largeur de bordures renseignées ( si elles sont différentes de 0).</font></em></a></div>
<div id="wb_Extension19" style="position:absolute;left:743px;top:844px;width:21px;height:21px;z-index:191;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Appliquer à la cellule affichant les textes des jours ( lundi, mardi,etc..), les largeur de bordures renseignées ( si elles sont différentes de 0).</font></em></a></div>
<div id="wb_Extension20" style="position:absolute;left:743px;top:816px;width:21px;height:21px;z-index:192;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Appliquer à la cellule affichant les numéros des jours (1,2,3,...), les largeur de bordures renseignées ( si elles sont différentes de 0).</font></em></a></div>
<div id="wb_Extension21" style="position:absolute;left:883px;top:780px;width:21px;height:21px;z-index:193;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Largeur de bordures droite ( si différent de 0) des cellules qui sera appliquée aux cellules autorisées à afficher une bordure</font></em></a></div>
<div id="wb_Extension22" style="position:absolute;left:883px;top:743px;width:21px;height:21px;z-index:194;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Largeur de bordures gauche ( si différent de 0) des cellules qui sera appliquée aux cellules autorisées à afficher une bordure</font></em></a></div>
<div id="wb_Extension23" style="position:absolute;left:883px;top:707px;width:21px;height:21px;z-index:195;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Largeur de bordures basses ( si différent de 0) des cellules qui sera appliquée aux cellules autorisées à afficher une bordure</font></em></a></div>
<div id="wb_Extension24" style="position:absolute;left:883px;top:672px;width:21px;height:21px;z-index:196;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Largeur de bordures supérieures ( si différent de 0) des cellules qui sera appliquée aux cellules autorisées à afficher une bordure</font></em></a></div>
<div id="wb_Extension25" style="position:absolute;left:883px;top:634px;width:21px;height:21px;z-index:197;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur des bordures appliquées aux cellules autorisées à afficher des bordures.<br>
Pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs,  cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de  la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension26" style="position:absolute;left:883px;top:594px;width:21px;height:21px;z-index:198;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Adresse URL de l'image de fond des cellules indiquant les numéros de semaines.<br>
</font><font style="font-size:13px" color="#FF6820" face="MS Sans Serif"><b>Attention: indiquez l' adresse absolue de l'image, c'est à dire du type http://www.images/mon_image.jpg ou  /images/mon_image.jpg</b></font></em></a></div>
<div id="wb_Extension27" style="position:absolute;left:883px;top:560px;width:21px;height:21px;z-index:199;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Adresse URL de l'image de fond des cellules indiquant les textes des noms des jours (lundi,mardi,etc..).<br>
</font><font style="font-size:13px" color="#FF6820" face="MS Sans Serif"><b>Attention: indiquez l' adresse absolue de l'image, c'est à dire du type http://www.images/mon_image.jpg ou  /images/mon_image.jpg</b></font></em></a></div>
<div id="wb_Extension28" style="position:absolute;left:883px;top:521px;width:21px;height:21px;z-index:200;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Adresse URL de l'image de fond des cellules indiquant les numéros de jour qui sont en week end.<br>
</font><font style="font-size:13px" color="#FF6820" face="MS Sans Serif"><b>Attention: indiquez l' adresse absolue de l'image, c'est à dire du type http://www.images/mon_image.jpg ou  /images/mon_image.jpg</b></font></em></a></div>
<div id="wb_Extension29" style="position:absolute;left:883px;top:487px;width:21px;height:21px;z-index:201;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Adresse URL de l'image de fond des cellules indiquant les numéros des jours hors week end.<br>
</font><font style="font-size:13px" color="#FF6820" face="MS Sans Serif"><b>Attention: indiquez l' adresse absolue de l'image, c'est à dire du type http://www.images/mon_image.jpg ou  /images/mon_image.jpg</b></font></em></a></div>
<div id="wb_Extension30" style="position:absolute;left:883px;top:450px;width:21px;height:21px;z-index:202;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Alignement horizontal des images de fond des cellules.</font></em></a></div>
<div id="wb_Extension31" style="position:absolute;left:883px;top:415px;width:21px;height:21px;z-index:203;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Alignement vertical des images de fond des cellules.</font></em></a></div>
<div id="wb_Extension32" style="position:absolute;left:883px;top:376px;width:21px;height:21px;z-index:204;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Adresse URL de l'image de fond des cellules indiquant le nom du mois et année.<br>
</font><font style="font-size:13px" color="#FF6820" face="MS Sans Serif"><b>Attention: indiquez l' adresse absolue de l'image, c'est à dire du type http://www.images/mon_image.jpg ou  /images/mon_image.jpg</b></font></em></a></div>
<div id="wb_Extension33" style="position:absolute;left:883px;top:345px;width:21px;height:21px;z-index:205;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur de fond des cellules contenant les numéros des jours qui n'ont aucun marqueur de couleur.<br>
Pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs,  cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de  la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension34" style="position:absolute;left:883px;top:312px;width:21px;height:21px;z-index:206;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur de fond des cellules contenant les noms des mois.<br>
Pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs,  cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de  la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension35" style="position:absolute;left:741px;top:283px;width:21px;height:21px;z-index:207;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Appliquer les couleurs de fond des cellules week end même aux cellules de week end qui ne contienent aucun numéros de jours.</font></em></a></div>
<div id="wb_Extension36" style="position:absolute;left:883px;top:253px;width:21px;height:21px;z-index:208;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur trait fin appliqué sous les lignes dimanche pour marquer la fin de semaine.<br>
<b>Valable uniquement pour les calendriers developpés</b></font></em></a></div>
<div id="wb_Extension37" style="position:absolute;left:883px;top:218px;width:21px;height:21px;z-index:209;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Largeur trait fin appliqué sous les lignes dimanche pour marquer la fin de semaine.<br>
<b>Valable uniquement pour les calendriers developpés</b></font></em></a></div>
<div id="wb_Extension38" style="position:absolute;left:883px;top:182px;width:21px;height:21px;z-index:210;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur de fond des cellules contenant les numéros de jours qui sont en week end<br>
Pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs,  cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de  la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension39" style="position:absolute;left:883px;top:151px;width:21px;height:21px;z-index:211;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur de fond des cellules contenant les lettres des jours qui sont en week end ( samedi,dimanche)<br>
Pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs,  cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de  la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension40" style="position:absolute;left:883px;top:122px;width:21px;height:21px;z-index:212;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur de fond des cellules contenant les lettres des jours qui sont pas en week end ( lundi,..., vendredi)<br>
Pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs,  cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de  la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension41" style="position:absolute;left:883px;top:88px;width:21px;height:21px;z-index:213;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur de fond des cellules contenant les numéros des semaines.<br>
Pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs,  cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de  la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension42" style="position:absolute;left:883px;top:59px;width:21px;height:21px;z-index:214;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur de fond des cellules contenant les lettres des semaines ( &quot;S&quot; ).<br>
Pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs,  cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de  la couleur dans la colonne de droite.</font></em></a></div>
</div>
<div id="wb_MasterPage4" style="position:absolute;left:13px;top:345px;width:964px;height:474px;z-index:291;">
<table style="position:absolute;left:0px;top:0px;width:964px;height:34px;z-index:215;" cellpadding="4" cellspacing="0" id="Table1">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Paramétrer le format des calendriers</strong></span></td>
</tr>
</table>
<table style="position:absolute;left:0px;top:46px;width:960px;height:428px;z-index:216;" cellpadding="0" cellspacing="1" id="Table3_format">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Text2" style="position:absolute;left:383px;top:57px;width:325px;height:16px;text-align:right;z-index:217;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Nombre de mois à afficher sur la page visiteur</strong></span></div>
<input type="text" id="nombre_mois_afficher" style="position:absolute;left:721px;top:51px;width:159px;height:22px;line-height:22px;z-index:218;" name="nombre_mois_afficher" value="<?php  echo $nombre_mois_afficher;  ?>">
<input type="text" id="nombre_mois_afficher_ligne" style="position:absolute;left:721px;top:85px;width:159px;height:22px;line-height:22px;z-index:219;" name="nombre_mois_afficher_ligne" value="<?php  echo $nombre_mois_afficher_ligne;  ?>">
<div id="wb_Text3" style="position:absolute;left:342px;top:91px;width:366px;height:16px;text-align:right;z-index:220;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Nombre de mois à afficher par ligne sur la page visiteur</strong></span></div>
<div id="wb_Text4" style="position:absolute;left:348px;top:126px;width:360px;height:16px;text-align:right;z-index:221;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Nombre de mois à afficher sur la page administrateur</strong></span></div>
<input type="text" id="nombre_mois_afficher_admin" style="position:absolute;left:721px;top:120px;width:159px;height:22px;line-height:22px;z-index:222;" name="nombre_mois_afficher_admin" value="<?php  echo $nombre_mois_afficher_admin;  ?>">
<input type="text" id="nombre_mois_afficher_ligne_admin" style="position:absolute;left:721px;top:154px;width:159px;height:22px;line-height:22px;z-index:223;" name="nombre_mois_afficher_ligne_admin" value="<?php  echo $nombre_mois_afficher_ligne_admin;  ?>">
<div id="wb_Text5" style="position:absolute;left:289px;top:160px;width:419px;height:16px;text-align:right;z-index:224;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Nombre de mois à afficher par ligne&nbsp; sur la page administrateur</strong></span></div>
<div id="wb_Text6" style="position:absolute;left:370px;top:196px;width:338px;height:16px;text-align:right;z-index:225;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Largeur de la bordure des tableaux des mois</strong></span></div>
<input type="text" id="bordure_du_tableau" style="position:absolute;left:721px;top:190px;width:159px;height:22px;line-height:22px;z-index:226;" name="bordure_du_tableau" value="<?php  echo $bordure_du_tableau;  ?>">
<div id="wb_Text8" style="position:absolute;left:412px;top:229px;width:297px;height:16px;text-align:right;z-index:227;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur de la bordure des tableaux des mois </strong></span></div>
<div id="wb_Extension1" style="position:absolute;left:723px;top:224px;width:175px;height:50px;z-index:228;">
<input type="text" id="couleur_bordure_tableau" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_bordure_tableau" value="<?php echo  $couleur_bordure_tableau;  ?>" class="color {hash:true}" ></div>
<div id="wb_Text11" style="position:absolute;left:404px;top:265px;width:305px;height:16px;text-align:right;z-index:229;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Hauteur minimale des cellules </strong></span></div>
<input type="text" id="hauteur_mini_cellule_date" style="position:absolute;left:722px;top:259px;width:159px;height:22px;line-height:22px;z-index:230;" name="hauteur_mini_cellule_date" value="<?php  echo $hauteur_mini_cellule_date;  ?>">
<div id="wb_Text13" style="position:absolute;left:313px;top:325px;width:396px;height:16px;text-align:right;z-index:231;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Largeur minimale d'un tableau représentant un mois entier</strong></span></div>
<input type="text" id="largeur_tableau" style="position:absolute;left:722px;top:319px;width:159px;height:22px;line-height:22px;z-index:232;" name="largeur_tableau" value="<?php  echo $largeur_tableau;  ?>">
<div id="wb_Text15" style="position:absolute;left:195px;top:365px;width:439px;height:16px;text-align:right;z-index:233;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Ouvrir par défaut le calendrier administrateur sur le locataire</strong></span></div>
<div id="Html1" style="position:absolute;left:82px;top:395px;width:554px;height:22px;z-index:234">
<?php
echo '<div id="wb_Text1" align="right"><font style="font-size:13px" color="#000000" face="Arial"><b>Ouvrir par défaut le calendrier administrateur sur ',$item1,'</b></font></div>';
?></div>
<div id="wb_Text20" style="position:absolute;left:215px;top:426px;width:492px;height:16px;text-align:right;z-index:235;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Afficher les numéros de semaine</strong></span></div>
<input type="checkbox" id="Checkbox3" name="avec_affichage_numero_semaine" value="on" style="position:absolute;left:723px;top:425px;z-index:236;" <?php if ( $avec_affichage_numero_semaine) {echo 'checked';} ?>>
<div id="Html2" style="position:absolute;left:650px;top:364px;width:227px;height:22px;z-index:237">
<?php
 if (isset($nom_locataire))
   liste_box ("locataire_defaut_cal_admin",250,$nom_locataire,$prenom_locataire,false,$locataire_defaut_cal_admin,true,"");

?></div>
<div id="Html3" style="position:absolute;left:650px;top:395px;width:226px;height:22px;z-index:238">
<?php
 if (isset($nom_logement))
   liste_box ("logement_defaut_cal_admin",250,$nom_logement,"",false,$logement_defaut_cal_admin,false,"");

?></div>
<div id="wb_Text21" style="position:absolute;left:215px;top:449px;width:492px;height:16px;text-align:right;z-index:239;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Afficher les infobulles complètes sur le calendrier administrateur</strong></span></div>
<input type="checkbox" id="Checkbox4" name="avec_affichage_infobulle_complete" value="on" style="position:absolute;left:723px;top:449px;z-index:240;" <?php if ( $avec_affichage_infobulle_complete) {echo 'checked';} ?>>
<div id="wb_Text1" style="position:absolute;left:404px;top:295px;width:305px;height:32px;text-align:right;z-index:241;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Largeur minimale cellule avec numéros de jour</strong></span></div>
<input type="text" id="Editbox1" style="position:absolute;left:722px;top:289px;width:159px;height:22px;line-height:22px;z-index:242;" name="largeur_mini_cellule_date" value="<?php  echo $largeur_mini_cellule_date;  ?>">
<div id="wb_Extension15" style="position:absolute;left:741px;top:448px;width:21px;height:21px;z-index:243;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Permet d'afficher des infobulles &quot;complètes&quot; sur le calendrier administrateur.<br>
C'est à dire, que les infobulles contienent les informations suivantes :<br>
- texte enregistré de l'infobulle<br>
- libellé de la couleur<br>
- nom du locataire<br>
- nom du logement sur le calendrier &quot;toutes locations&quot;<br>
- date ou période</font></em></a></div>
<div id="wb_Extension2" style="position:absolute;left:742px;top:424px;width:21px;height:21px;z-index:244;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Afficher les numéros de semaine sur tous les calendriers visiteurs et administrateur</font></em></a></div>
<div id="wb_Extension3" style="position:absolute;left:913px;top:395px;width:21px;height:21px;z-index:245;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Choix de la location par défaut à afficher lors d'une nouvelle connexion à l'espace administrateur</font></em></a></div>
<div id="wb_Extension4" style="position:absolute;left:913px;top:366px;width:21px;height:21px;z-index:246;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Choix du locataire par défaut à afficher lors d'une nouvelle connexion à l'espace administrateur</font></em></a></div>
<div id="wb_Extension5" style="position:absolute;left:885px;top:320px;width:21px;height:21px;z-index:247;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Largeur minimale en pixel d'un tableau affichant un mois entier</font></em></a></div>
<div id="wb_Extension6" style="position:absolute;left:885px;top:290px;width:21px;height:21px;z-index:248;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Largeur minimale des cellules, valable pour les cellules avec les numéros des jours.<br>
Ce paramètres permet entre autre de corriger les alignements des cellules vides.</font></em></a></div>
<div id="wb_Extension14" style="position:absolute;left:885px;top:260px;width:21px;height:21px;z-index:249;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Hauteur minimale des cellules, valable pour toutes les cellules du calendrier.<br>
Ce paramètres permet entre autre de corriger les alignements des cellules vides.</font></em></a></div>
<div id="wb_Extension7" style="position:absolute;left:885px;top:223px;width:21px;height:21px;z-index:250;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur de la bordure encadrant un tableau mois si le paramètre largeur de bordure est différent de 0.<br>
Pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs,  cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de  la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension8" style="position:absolute;left:885px;top:190px;width:21px;height:21px;z-index:251;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Largeur de la bordure encadrant un tableau mois , indiquer 0 pour ne pas afficher de bordure.</font></em></a></div>
<div id="wb_Extension9" style="position:absolute;left:885px;top:155px;width:21px;height:21px;z-index:252;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Nombre de mois par ligne à afficher sur les calendriers administrateurs.<br>
Si le nombre total de calendrier est supérieur, alors les calendriers suivant seront affichés après un retour à la ligne.</font></em></a></div>
<div id="wb_Extension10" style="position:absolute;left:885px;top:120px;width:21px;height:21px;z-index:253;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Nombre de mois total à afficher sur les calendriers administrateurs.</font></em></a></div>
<div id="wb_Extension11" style="position:absolute;left:885px;top:89px;width:21px;height:21px;z-index:254;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Nombre de mois par ligne à afficher sur les calendriers Visiteur.<br>
Si le nombre total de calendrier est supérieur, alors les calendriers suivant seront affichés après un retour à la ligne.</font></em></a></div>
<div id="wb_Extension13" style="position:absolute;left:885px;top:54px;width:21px;height:21px;z-index:255;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Nombre de mois total à afficher sur les calendriers visiteur.</font></em></a></div>
</div>
<div id="wb_MasterPage3" style="position:absolute;left:14px;top:6px;width:964px;height:320px;z-index:292;">
<table style="position:absolute;left:0px;top:0px;width:964px;height:34px;z-index:256;" cellpadding="4" cellspacing="0" id="Table1">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Paramétrer les textes du calendrier</strong></span></td>
</tr>
</table>
<table style="position:absolute;left:0px;top:42px;width:960px;height:278px;z-index:257;" cellpadding="0" cellspacing="1" id="Table2_textes">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Text2" style="position:absolute;left:394px;top:284px;width:322px;height:16px;text-align:right;z-index:258;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Police des textes</strong></span></div>
<div id="wb_Text1" style="position:absolute;left:298px;top:222px;width:418px;height:16px;text-align:right;z-index:259;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur de la police des numéros des jours dans le calendrier </strong></span></div>
<div id="wb_Text4" style="position:absolute;left:317px;top:191px;width:399px;height:16px;text-align:right;z-index:260;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Taille de la police des numéros des jours dans le calendrier </strong></span></div>
<div id="wb_Extension1" style="position:absolute;left:730px;top:84px;width:175px;height:50px;z-index:261;">
<input type="text" id="couleur_police_mois" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_police_mois" value="<?php echo  $couleur_police_mois;  ?>" class="color {hash:true}" ></div>
<input type="text" id="taille_police_mois" style="position:absolute;left:729px;top:53px;width:159px;height:22px;line-height:22px;z-index:262;" name="taille_police_mois" value="<?php  echo $taille_police_mois;  ?>">
<div id="wb_Text3" style="position:absolute;left:350px;top:59px;width:366px;height:16px;text-align:right;z-index:263;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Taille de la police des textes des mois </strong></span></div>
<div id="wb_Text6" style="position:absolute;left:403px;top:90px;width:313px;height:16px;text-align:right;z-index:264;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur de la police des textes des mois </strong></span></div>
<div id="wb_Text5" style="position:absolute;left:352px;top:124px;width:364px;height:16px;text-align:right;z-index:265;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Taille de la police des lettres des jours </strong></span></div>
<div id="wb_Text8" style="position:absolute;left:365px;top:155px;width:351px;height:16px;text-align:right;z-index:266;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur de la police des lettres des jours </strong></span></div>
<input type="text" id="taille_police_nom_jour" style="position:absolute;left:729px;top:117px;width:159px;height:22px;line-height:22px;z-index:267;" name="taille_police_nom_jour" value="<?php  echo $taille_police_nom_jour;  ?>">
<div id="wb_Extension2" style="position:absolute;left:730px;top:150px;width:175px;height:50px;z-index:268;">
<input type="text" id="couleur_police_nom_jour" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_police_nom_jour" value="<?php echo  $couleur_police_nom_jour;  ?>" class="color {hash:true}" ></div>
<input type="text" id="taille_police_jour" style="position:absolute;left:729px;top:185px;width:159px;height:22px;line-height:22px;z-index:269;" name="taille_police_jour" value="<?php  echo $taille_police_jour;  ?>">
<div id="wb_Extension3" style="position:absolute;left:730px;top:217px;width:175px;height:50px;z-index:270;">
<input type="text" id="couleur_police_jour" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_police_jour" value="<?php echo  $couleur_police_jour;  ?>" class="color {hash:true}" ></div>
<div id="wb_Text7" style="position:absolute;left:232px;top:252px;width:484px;height:16px;text-align:right;z-index:271;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur de la police des numéros des semaines dans le calendrier </strong></span></div>
<div id="wb_Extension4" style="position:absolute;left:730px;top:247px;width:175px;height:50px;z-index:272;">
<input type="text" id="couleur_police_numero_semaine" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_police_numero_semaine" value="<?php echo  $couleur_police_numero_semaine;  ?>" class="color {hash:true}" ></div>
<select name="police" size="1" id="police" style="position:absolute;left:729px;top:280px;width:173px;height:24px;z-index:273;" >
<option <?php if ( $police == "Arial" ) echo "selected"; ?> value="Arial">Arial</option>
<option <?php if ( $police == "Arial Black" ) echo "selected"; ?> value="Arial Black">Arial Black</option>
<option <?php if ( $police == "Bookman Old Style" ) echo "selected"; ?> value="Bookman Old Style">Bookman Old Style</option>
<option <?php if ( $police == "Comic Sans MS" ) echo "selected"; ?> value="Comic Sans MS">Comic Sans MS</option>
<option <?php if ( $police == "Courier New" ) echo "selected"; ?> value="Courier New">Courier New</option>
<option <?php if ( $police == "Georgia" ) echo "selected"; ?> value="Georgia">Georgia</option>
<option <?php if ( $police == "Impact" ) echo "selected"; ?> value="Impact">Impact</option>
<option <?php if ( $police == "Lucida Console" ) echo "selected"; ?> value="Lucida Console">Lucida Console</option>
<option <?php if ( $police == "Tahoma" ) echo "selected"; ?> value="Tahoma">Tahoma</option>
<option <?php if ( $police == "Times New Roman" ) echo "selected"; ?> value="Times New Roman">Times New Roman</option>
<option <?php if ( $police == "Verdana" ) echo "selected"; ?> value="Verdana">Verdana</option>
</select>
<div id="wb_Extension6" style="position:absolute;left:901px;top:281px;width:21px;height:21px;z-index:274;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Police pour tous les textes du calendrier</font></em></a></div>
<div id="wb_Extension7" style="position:absolute;left:837px;top:249px;width:21px;height:21px;z-index:275;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur de la police des textes indiquant le numéro des semaines.<br>
Pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs,  cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de  la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension8" style="position:absolute;left:837px;top:219px;width:21px;height:21px;z-index:276;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur de la police des textes indiquant le numéro des jours ( 1,2,3, 4,etc...)<br>
Pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs,  cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de  la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension9" style="position:absolute;left:890px;top:185px;width:21px;height:21px;z-index:277;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Taille de la police des textes indiquant le numéro des jours ( 1,2,3, 4,etc...)<br>
</font></em></a></div>
<div id="wb_Extension10" style="position:absolute;left:837px;top:150px;width:21px;height:21px;z-index:278;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur de la police des textes indiquant le nom des jours (Lundi, mardi, etc..)<br>
Pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs,  cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de  la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension5" style="position:absolute;left:893px;top:117px;width:21px;height:21px;z-index:279;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Taille en pixel des textes nom des jours (Lundi mardi, mercredi,etc...)</font></em></a></div>
<div id="wb_Extension11" style="position:absolute;left:837px;top:84px;width:21px;height:21px;z-index:280;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Couleur de la police des textes indiquant le nom des mois.<br>
Pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs,  cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de  la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension12" style="position:absolute;left:889px;top:53px;width:21px;height:21px;z-index:281;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Taille en pixel des textes nom des mois.</font></em></a></div>
</div>
</form>
</div>
<div id="wb_MasterPage14" style="position:absolute;left:485px;top:0px;width:96px;height:106px;z-index:607;">
<div id="wb_Shape1" style="position:absolute;left:36px;top:90px;width:21px;height:11px;z-index:575;">
<img src="images/img0003.gif" id="Shape1" alt="" style="width:21px;height:11px;"></div>
<div id="wb_Shape2" style="position:absolute;left:0px;top:98px;width:96px;height:8px;z-index:576;">
<img src="images/img0006.gif" id="Shape2" alt="" style="width:96px;height:8px;"></div>
<div id="wb_Shape3" style="position:absolute;left:0px;top:0px;width:96px;height:3px;z-index:577;">
<img src="images/img0016.gif" id="Shape3" alt="" style="width:96px;height:3px;"></div>
</div>
<div id="wb_MasterPage2" style="position:absolute;left:4px;top:0px;width:998px;height:110px;z-index:608;">
<div id="wb_fond_widget" style="position:absolute;left:960px;top:2px;width:38px;height:108px;filter:alpha(opacity=40);opacity:0.40;z-index:578;">
<img src="images/img0013.png" id="fond_widget" alt="" style="width:38px;height:108px;"></div>
<div id="wb_menu_codes" style="position:absolute;left:800px;top:10px;width:32px;height:32px;z-index:579;">
<a href="./code.php"><img src="images/binary.png" id="menu_codes" alt="Codes pour afficher les calendriers visiteurs" title="Codes pour afficher les calendriers visiteurs"></a></div>
<div id="wb_text_cal" style="position:absolute;left:2px;top:55px;width:95px;height:18px;text-align:center;z-index:580;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./index_calendrier.php" class="Style_menu">Calendrier</a></span></div>
<div id="wb_text_locataire" style="position:absolute;left:97px;top:55px;width:95px;height:18px;text-align:center;z-index:581;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./locataire.php" class="Style_menu">Locataires</a></span></div>
<div id="text_ressource" style="position:absolute;left:193px;top:55px;width:97px;height:44px;z-index:582">
<div  style="text-align:center;">

<font style="font-size:16px" color="#666666" face="Arial"><a href="./logement.php" class="Style_menu">
<?php echo $item1; ?>
</a></font>

</div></div>
<div id="wb_text_couleur" style="position:absolute;left:291px;top:55px;width:95px;height:54px;text-align:center;z-index:583;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./couleur.php" class="Style_menu">Couleurs des marqueurs</a></span></div>
<div id="wb_texte_param" style="position:absolute;left:482px;top:55px;width:95px;height:36px;text-align:center;z-index:584;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./parametrage_calendrier.php" class="Style_menu">Paramètres calendrier</a></span></div>
<div id="wb_text_stats" style="position:absolute;left:387px;top:55px;width:95px;height:18px;text-align:center;z-index:585;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./listing.php" class="Style_menu">Statistiques</a></span></div>
<div id="wb_texte_langues" style="position:absolute;left:578px;top:55px;width:95px;height:18px;text-align:center;z-index:586;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./edit_langue.php" class="Style_menu">Langues</a></span></div>
<div id="wb_text_maintenance" style="position:absolute;left:674px;top:55px;width:95px;height:18px;text-align:center;z-index:587;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./base.php" class="Style_menu">Maintenance</a></span></div>
<div id="wb_text_codes" style="position:absolute;left:769px;top:55px;width:95px;height:18px;text-align:center;z-index:588;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./code.php" class="Style_menu">Codes</a></span></div>
<div id="wb_text_propos" style="position:absolute;left:862px;top:55px;width:95px;height:18px;text-align:center;z-index:589;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./a_propos.php" class="Style_menu">A propos</a></span></div>
<div id="wb_image_location" style="position:absolute;left:967px;top:3px;width:20px;height:20px;z-index:590;">
<a href="identification.php?fct=deconnexion"><img src="images/img0007.png" id="image_location" alt="D&#233;connexion" title="D&#233;connexion"></a></div>
<div id="wb_menu_memo" style="position:absolute;left:961px;top:27px;width:31px;height:31px;z-index:591;">
<a href="#"><img src="images/img0012.png" id="menu_memo" alt="M&#233;mo" title="M&#233;mo" onclick="coller_ajax('memo','colle_memo.html');document.getElementById('Memoire').style.visibility='visible';"></a></div>
<div id="wb_menu_calcul" style="position:absolute;left:963px;top:66px;width:32px;height:32px;z-index:592;">
<a href="#"><img src="images/img0325.png" id="menu_calcul" alt="Calculatrice" title="Calculatrice" onclick="document.getElementById('Calculatrice').style.visibility='visible';"></a></div>
<div id="wb_menu_cal" style="position:absolute;left:27px;top:10px;width:44px;height:37px;z-index:593;">
<a href="./index_calendrier.php"><img src="images/img0021.png" id="menu_cal" alt="Calendrier" title="Calendrier"></a></div>
<div id="wb_menu_locataire" style="position:absolute;left:123px;top:7px;width:48px;height:48px;z-index:594;">
<a href="./locataire.php"><img src="images/people.png" id="menu_locataire" alt="Gestion des locataires" title="Gestion des locataires"></a></div>
<div id="wb_menu_ressources" style="position:absolute;left:217px;top:7px;width:48px;height:48px;z-index:595;">
<a href="./logement.php"><img src="images/09_48x48.png" id="menu_ressources" alt="Gestion des logements" title="Gestion des logements"></a></div>
<div id="wb_menu_couleur" style="position:absolute;left:315px;top:7px;width:48px;height:48px;z-index:596;">
<a href="./couleur.php"><img src="images/palette.png" id="menu_couleur" alt="Gestion des marqueurs" title="Gestion des marqueurs"></a></div>
<div id="wb_manu_maintenance" style="position:absolute;left:699px;top:7px;width:48px;height:48px;z-index:597;">
<a href="./base.php"><img src="images/maintenance.png" id="manu_maintenance" alt="Maintenance des donn&#233;es" title="Maintenance des donn&#233;es"></a></div>
<div id="wb_menu_stat" style="position:absolute;left:411px;top:7px;width:48px;height:48px;z-index:598;">
<a href="./listing.php"><img src="images/stat.png" id="menu_stat" alt="Statistiques de locations" title="Statistiques de locations"></a></div>
<div id="wb_menu_langue" style="position:absolute;left:604px;top:7px;width:48px;height:48px;z-index:599;">
<a href="./edit_langue.php"><img src="images/langue.png" id="menu_langue" alt="Gestion des langues" title="Gestion des langues"></a></div>
<div id="wb_menu_paraemtre" style="position:absolute;left:506px;top:7px;width:48px;height:48px;z-index:600;">
<a href="./parametrage_calendrier.php"><img src="images/administrative_docs.png" id="menu_paraemtre" alt="Param&#233;tres du calendrier" title="Param&#233;tres du calendrier"></a></div>
<div id="wb_menu_propos" style="position:absolute;left:886px;top:7px;width:48px;height:48px;z-index:601;">
<a href="./a_propos.php"><img src="images/brainstorming.png" id="menu_propos" alt="A propos du script" title="A propos du script"></a></div>
<div id="text_affiche_info" style="position:absolute;left:276px;top:2px;width:274px;height:10px;z-index:602">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<!-- widget -->
<div id="text_code_commun" style="position:absolute;left:570px;top:0px;width:25px;height:31px;z-index:603">
<div id="Memoire" style="position:absolute;overflow:auto;background-color:#CDDBEB;opacity:O.95;-moz-opacity:O.95;-khtml-opacity:O.95;filter:alpha(opacity=95);left:10px;top:10px;width:275px;height:270px;z-index:500;visibility: hidden;" title="Memo">
<div id="Memoire_Html" style="position:absolute;left:5px;top:5px;">
<table border="0"  cellspacing="0" cellpadding="5">
<tr>
   <td id="souvient_toi_titre" colspan = "2"  bgcolor="#86A8D2">
      <ilayer width="100%" >
      <layer width="100%" >
      <font face="Arial" color="#FFFFFF" style="font-size:13px;text-decoration:none"><b>Memo</b></font>
      </layer>
      </ilayer>

   </td>
   <td style="cursor:hand" valign="top" align = "right" bgcolor="#86A8D2">
      <a href="#" onClick="document.getElementById('Memoire').style.visibility='hidden';return false">
      <font color="#FFFFFF" face="Arial" style="font-size:13px;text-decoration:none"><b>X</b></font>
      </a>
   </td>
</tr>
<tr>
<td colspan = "3" bgcolor="#CDDBEB">
<textarea name="memo" id="memo" style="border:1px #C0C0C0 solid;font-family:Courier New;font-size:13px;z-index:6" rows="10" cols="29"></textarea>

</td>
</tr>
<tr>
<td bgcolor="#CDDBEB">
<input type="submit" onclick="copier_ajax('memo','colle_memo');return false;" name="Enregistrer" value="Enregistrer" style="width:96px;height:25px;background-color:#638EC5;color:#FFFFFF;font-family:Arial;font-size:13px;z-index:8">
</td>
<td bgcolor="#CDDBEB">
</td>
<td bgcolor="#CDDBEB" align ="right">
<input type="reset" onclick="document.getElementById('memo').value='';return false;" name="Vider" value="Vider" style="width:60px;height:25px;background-color:#638EC5;color:#FFFFFF;font-family:Arial;font-size:13px;z-index:9">
</td>
</tr>
</table>
</div>
</div>





<div id="Calculatrice" style="position:absolute;overflow:visible;background-color:#CDDBEB;left:10px;top:10px;width:200px;height:290px;z-index:500;visibility: hidden;" title="Calculatrice">
<div id="calculatrice_Html" style="position:absolute;left:5px;top:5px;">
<table border="0"  cellspacing="0" cellpadding="5" width="100%">
<tr>
   <td id="calculatrice_titre" width="100%"  bgcolor="#86A8D2">
      <ilayer width="100%" >
      <layer width="100%" >
      <font face="Arial" color="#FFFFFF" style="font-size:13px;text-decoration:none"><b>Calculatrice</b></font>
      </layer>
      </ilayer>

   </td>
   <td style="cursor:hand" valign="top" align = "right" bgcolor="#86A8D2">
      <a href="#" onClick="document.getElementById('Calculatrice').style.visibility='hidden';return false">
      <font color="#FFFFFF" face="Arial" style="font-size:13px;text-decoration:none"><b>X</b></font>
      </a>
   </td>
</tr>
</td>
</tr>
</table>

<form name="calculatrice">
<table border="0" cellspacing="0" cellpadding="5">
<tr>
<td colspan=4>
<input type="text" name="expr" style="border:1px #C0C0C0 solid;font-family:Courier New;font-size:16px;width:150px;height:20px;" action="evaluer(this.form)"> 
</td>
</tr>
<tr>
<td>
<button id="AdvancedButton1" type="button" name="" value=" 7 " onClick="calculatrice_expression(this.form, sept)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>7</b></font></div></button>
</td>
<td>
<button id="AdvancedButton1" type="button" name="" value=" 8 " onClick="calculatrice_expression(this.form, huit)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>8</b></font></div></button>
</td>
<td>
<button id="AdvancedButton1" type="button" name="" value=" 9 " onClick="calculatrice_expression(this.form, neuf)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>9</b></font></div></button>
</td>
<td>
<button id="AdvancedButton1" type="button" name="" value=" / " onClick="calculatrice_expression(this.form, diviser)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>/</b></font></div></button>
</td>
</tr>

<tr>
<td>
<button id="AdvancedButton1" type="button" name="" value=" 4 " onClick="calculatrice_expression(this.form, quatre)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>4</b></font></div></button>
</td>
<td>
<button id="AdvancedButton1" type="button" name="" value=" 5 " onClick="calculatrice_expression(this.form, cinq)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>5</b></font></div></button>
</td>
<td>
<button id="AdvancedButton1" type="button" name="" value=" 6 " onClick="calculatrice_expression(this.form, six)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>6</b></font></div></button>
</td>
<td>
<button id="AdvancedButton1" type="button" name="" value=" * " onClick="calculatrice_expression(this.form, multiplier)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>*</b></font></div></button>
</td>
</tr>

<tr>
<td>
<button id="AdvancedButton1" type="button" name="" value=" 1 " onClick="calculatrice_expression(this.form, un)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>1</b></font></div></button>
</td>
<td>
<button id="AdvancedButton1" type="button" name="" value=" 2 " onClick="calculatrice_expression(this.form, deux)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>2</b></font></div></button>
</td>
<td>
<button id="AdvancedButton1" type="button" name="" value=" 3 " onClick="calculatrice_expression(this.form, trois)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>3</b></font></div></button>
</td>
<td>
<button id="AdvancedButton1" type="button" name="" value=" - " onClick="calculatrice_expression(this.form, soustraire)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>-</b></font></div></button>
</td>
</tr>

<tr>
<td colspan=2>
<button id="AdvancedButton1" type="button" name="" value=" 0 " onClick="calculatrice_expression(this.form, zero)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>0</b></font></div></button>
</td>
<td>
<button id="AdvancedButton1" type="button" name="" value=" . " onClick="calculatrice_expression(this.form, virgule)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>.</b></font></div></button>
</td>
<td>
<button id="AdvancedButton1" type="button" name="" value=" + " onClick="calculatrice_expression(this.form, additionner)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>+</b></font></div></button>
</td>
</tr>

<tr>
<td colspan=2>
<button id="AdvancedButton1" type="button" name="" value=" = " onClick="calculer(this.form)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>=</b></font></div></button>
</td>
<td colspan=2>
<button id="AdvancedButton1" type="button" name="" value="C" onClick="calculatrice_effacer(this.form)" style="width:33px;height:33px;background-image:url(images/bouton_cal.png)"><div><font style="font-size:13px" color="#FFFFFF" face="Arial"><b>C</b></font></div></button>
</td>
</table>
</form>

</div>
</div></div>
</div>
</div>
</body>
</html>