<?php
session_start();

$page = 'logement';

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_connexion.php");

$nom_logement_temp = '';
$cle_nom_logement_modif = '';
$affiche_info  = '';

//**************************************************************************************************
//controle des fichiers 
//**************************************************************************************************
if (!isset($fin_tableau_logement))
    $affiche_info = 'erreur_fichier_logement';

// test si demande effacement d'un logement*****************************************************************************
if ( isset($_GET['fct']) && !is_numeric($_GET['fct']) &&  !(empty($_GET['fct'])) &&  isset($_GET['num']) && is_numeric($_GET['num']) ) {

  $num_supprime = $_GET['num'] ;
  $fonction = $_GET['fct'] ;

//fonction synchoniser **************************

if ( $fonction == 'synchroniser' && !MODE_DEMO ) {
   $chemin_admin = str_replace($_SERVER['DOCUMENT_ROOT'],'',$_SERVER['SCRIPT_FILENAME']);
   $chemin_admin = str_replace('/admin/logement.php','',$chemin_admin);
   $etat = synchronisation_ical($chemin_admin,$num_supprime);

}

//fonction supprimer **************************

if ( $fonction == 'supprimer' && !MODE_DEMO ) {

  //recherche du numéro d'index le plus élevé************
  $nb_result = count ($nom_logement);  
  if ( $nb_result > 0 ) {
      unset($nom_logement[$num_supprime]);
      unset($format_calendrier_logement[$num_supprime]);
      unset($texte_jour_debut_semaine_logement[$num_supprime]);
      unset($tarif_logement[$num_supprime]);
      if ( isset($url_synchro_logement[$num_supprime]) ) unset($url_synchro_logement[$num_supprime]);
  }
 
  //chemin vers le fichier de création liste des locataires/logements**********************************************************
  include("genere/genere_listes_logement.php");

  $chemin_fichier = "fichier_calendrier/ical/".$num_supprime.".ics";
  @unlink($chemin_fichier);
  $chemin_fichier = "fichier_calendrier/ical/".$num_supprime.".ical";
  @unlink($chemin_fichier);
  $chemin_fichier = "fichier_calendrier/ical/".$num_supprime."_date_mise_a_jour.php";
  @unlink($chemin_fichier);

  if ( AVEC_BDD ) {
  //connection a la base de donnees*******************************************************************
  $connect = @mysql_connect(Decrypte(hote_cal,$Cle), Decrypte(user_cal,$Cle), Decrypte(password_cal,$Cle)); 
  $connect_base = @mysql_select_db(Decrypte(base_cal,$Cle), $connect) ;

  $valeur_select = "delete from ".Decrypte(nom_table_cal,$Cle)." where id_logement= '$num_supprime'  ";

  $etat_req = @mysql_query($valeur_select);
  }

  //fonctionnement sans base de données **************************************************************
 
 else {
  $chemin_fichier = "fichier_calendrier/dates_sans_bdd/".$num_supprime."_calendrier.php";
  $etat_req = @unlink($chemin_fichier);
  $chemin_fichier = "fichier_calendrier/dates_sans_bdd/".$num_supprime."_sauvegarde_calendrier.php";
  @unlink($chemin_fichier);

  }

  if ( $logement_defaut_cal_admin == $num_supprime ) {
  // remet le pointeur de tableau sur le premier element
  if ( isset($nom_logement)) {
  $nb_result = count ($nom_logement);
  if ( $nb_result > 0 ) {
  foreach ($nom_logement as $cle => $nom_loc )  {
      if ( !isset($num_pointeur_min) )
           $num_pointeur_min = $cle;
      if ( $cle <= $num_pointeur_min)
           $pointeur_debut_tableau_logement = $cle ;
      }
  $logement_defaut_cal_admin = $pointeur_debut_tableau_logement;
  $chemin_fichier = '' ;
  include("genere/genere_para_calendrier.php");
     }
    }
  }

  $_SESSION['sel_tri_logement'] = '' ;

  //chemin vers le fichier de liste des locataires/logements**********************************************************
  include("fichier_calendrier/calendrier_liste_logement.php");
 
  if ( $etat_req && $creation_reussi)
     $affiche_info = 'modif_ok';
  else
     $affiche_info = 'erreur_execution';
 
  }

//********************************************************************************
// controle mode démo ************************************************************
//********************************************************************************
  if ( $fonction == 'supprimer' && MODE_DEMO  )
     $affiche_info = 'mode_demo';

} 

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
<link href="logement.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
    var GB_ROOT_DIR = "js_lightbox/";
</script>

<script type="text/javascript" src="js_lightbox/AJS.js"></script>
<script type="text/javascript" src="js_lightbox/AJS_fx.js"></script>
<script type="text/javascript" src="js_lightbox/gb_scripts.js"></script>
<link href="js_lightbox/gb_styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="fichier_calendrier/styles.css?version=<?php echo filemtime('fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >

<script type="text/javascript" src="fonction.js"></script>



</head>
<body>
<div id="container">
<div id="wb_MasterPage2" style="position:absolute;left:2px;top:0px;width:964px;height:110px;z-index:34;">
</div>
<div id="wb_MasterPage4" style="position:absolute;left:198px;top:0px;width:96px;height:106px;z-index:35;">
<div id="wb_Shape1" style="position:absolute;left:36px;top:90px;width:21px;height:11px;z-index:0;">
<img src="images/img0003.gif" id="Shape1" alt="" style="width:21px;height:11px;"></div>
<div id="wb_Shape2" style="position:absolute;left:0px;top:98px;width:96px;height:8px;z-index:1;">
<img src="images/img0006.gif" id="Shape2" alt="" style="width:96px;height:8px;"></div>
<div id="wb_Shape3" style="position:absolute;left:0px;top:0px;width:96px;height:3px;z-index:2;">
<img src="images/img0016.gif" id="Shape3" alt="" style="width:96px;height:3px;"></div>
</div>
<div id="wb_MasterPage1" style="position:absolute;left:4px;top:0px;width:998px;height:110px;z-index:36;">
<div id="wb_fond_widget" style="position:absolute;left:960px;top:2px;width:38px;height:108px;filter:alpha(opacity=40);opacity:0.40;z-index:3;">
<img src="images/img0013.png" id="fond_widget" alt="" style="width:38px;height:108px;"></div>
<div id="wb_menu_codes" style="position:absolute;left:800px;top:10px;width:32px;height:32px;z-index:4;">
<a href="./code.php"><img src="images/binary.png" id="menu_codes" alt="Codes pour afficher les calendriers visiteurs" title="Codes pour afficher les calendriers visiteurs"></a></div>
<div id="wb_text_cal" style="position:absolute;left:2px;top:55px;width:95px;height:18px;text-align:center;z-index:5;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./index_calendrier.php" class="Style_menu">Calendrier</a></span></div>
<div id="wb_text_locataire" style="position:absolute;left:97px;top:55px;width:95px;height:18px;text-align:center;z-index:6;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./locataire.php" class="Style_menu">Locataires</a></span></div>
<div id="text_ressource" style="position:absolute;left:193px;top:55px;width:97px;height:44px;z-index:7">
<div  style="text-align:center;">

<font style="font-size:16px" color="#666666" face="Arial"><a href="./logement.php" class="Style_menu">
<?php echo $item1; ?>
</a></font>

</div></div>
<div id="wb_text_couleur" style="position:absolute;left:291px;top:55px;width:95px;height:54px;text-align:center;z-index:8;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./couleur.php" class="Style_menu">Couleurs des marqueurs</a></span></div>
<div id="wb_texte_param" style="position:absolute;left:482px;top:55px;width:95px;height:36px;text-align:center;z-index:9;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./parametrage_calendrier.php" class="Style_menu">Paramètres calendrier</a></span></div>
<div id="wb_text_stats" style="position:absolute;left:387px;top:55px;width:95px;height:18px;text-align:center;z-index:10;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./listing.php" class="Style_menu">Statistiques</a></span></div>
<div id="wb_texte_langues" style="position:absolute;left:578px;top:55px;width:95px;height:18px;text-align:center;z-index:11;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./edit_langue.php" class="Style_menu">Langues</a></span></div>
<div id="wb_text_maintenance" style="position:absolute;left:674px;top:55px;width:95px;height:18px;text-align:center;z-index:12;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./base.php" class="Style_menu">Maintenance</a></span></div>
<div id="wb_text_codes" style="position:absolute;left:769px;top:55px;width:95px;height:18px;text-align:center;z-index:13;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./code.php" class="Style_menu">Codes</a></span></div>
<div id="wb_text_propos" style="position:absolute;left:862px;top:55px;width:95px;height:18px;text-align:center;z-index:14;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./a_propos.php" class="Style_menu">A propos</a></span></div>
<div id="wb_Image10" style="position:absolute;left:967px;top:3px;width:20px;height:20px;z-index:15;">
<a href="identification.php?fct=deconnexion"><img src="images/img0007.png" id="Image10" alt="D&#233;connexion" title="D&#233;connexion"></a></div>
<div id="wb_menu_memo" style="position:absolute;left:961px;top:27px;width:31px;height:31px;z-index:16;">
<a href="#"><img src="images/img0012.png" id="menu_memo" alt="M&#233;mo" title="M&#233;mo" onclick="coller_ajax('memo','colle_memo.html');document.getElementById('Memoire').style.visibility='visible';"></a></div>
<div id="wb_menu_calcul" style="position:absolute;left:963px;top:66px;width:32px;height:32px;z-index:17;">
<a href="#"><img src="images/img0325.png" id="menu_calcul" alt="Calculatrice" title="Calculatrice" onclick="document.getElementById('Calculatrice').style.visibility='visible';"></a></div>
<div id="wb_menu_cal" style="position:absolute;left:27px;top:10px;width:44px;height:37px;z-index:18;">
<a href="./index_calendrier.php"><img src="images/img0021.png" id="menu_cal" alt="Calendrier" title="Calendrier"></a></div>
<div id="wb_menu_locataire" style="position:absolute;left:123px;top:7px;width:48px;height:48px;z-index:19;">
<a href="./locataire.php"><img src="images/people.png" id="menu_locataire" alt="Gestion des locataires" title="Gestion des locataires"></a></div>
<div id="wb_menu_ressources" style="position:absolute;left:217px;top:7px;width:48px;height:48px;z-index:20;">
<a href="./logement.php"><img src="images/09_48x48.png" id="menu_ressources" alt="Gestion des logements" title="Gestion des logements"></a></div>
<div id="wb_menu_couleur" style="position:absolute;left:315px;top:7px;width:48px;height:48px;z-index:21;">
<a href="./couleur.php"><img src="images/palette.png" id="menu_couleur" alt="Gestion des marqueurs" title="Gestion des marqueurs"></a></div>
<div id="wb_manu_maintenance" style="position:absolute;left:699px;top:7px;width:48px;height:48px;z-index:22;">
<a href="./base.php"><img src="images/maintenance.png" id="manu_maintenance" alt="Maintenance des donn&#233;es" title="Maintenance des donn&#233;es"></a></div>
<div id="wb_menu_stat" style="position:absolute;left:411px;top:7px;width:48px;height:48px;z-index:23;">
<a href="./listing.php"><img src="images/stat.png" id="menu_stat" alt="Statistiques de locations" title="Statistiques de locations"></a></div>
<div id="wb_menu_langue" style="position:absolute;left:604px;top:7px;width:48px;height:48px;z-index:24;">
<a href="./edit_langue.php"><img src="images/langue.png" id="menu_langue" alt="Gestion des langues" title="Gestion des langues"></a></div>
<div id="wb_menu_paraemtre" style="position:absolute;left:506px;top:7px;width:48px;height:48px;z-index:25;">
<a href="./parametrage_calendrier.php"><img src="images/administrative_docs.png" id="menu_paraemtre" alt="Param&#233;tres du calendrier" title="Param&#233;tres du calendrier"></a></div>
<div id="wb_menu_propos" style="position:absolute;left:886px;top:7px;width:48px;height:48px;z-index:26;">
<a href="./a_propos.php"><img src="images/brainstorming.png" id="menu_propos" alt="A propos du script" title="A propos du script"></a></div>
<div id="text_affiche_info" style="position:absolute;left:276px;top:2px;width:274px;height:10px;z-index:27">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<!-- widget -->
<div id="text_code_commun" style="position:absolute;left:570px;top:0px;width:25px;height:31px;z-index:28">
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
<div id="logementLayer1" style="position:absolute;overflow:auto;text-align:left;left:4px;top:109px;width:971px;height:1137px;z-index:37;">
<div id="wb_Extension2" style="position:absolute;left:12px;top:60px;width:71px;height:66px;z-index:29;">
<a href="ajout_logement.php" onclick="return GB_showPage('Ajouter  <?php echo $item1; ?>', this.href)" ><img src="location-plus.png" alt="Ajout"/ border ="0"></a></div>
<div id="wb_Image2" style="position:absolute;left:102px;top:60px;width:48px;height:48px;z-index:30;">
<a href="javascript:window.print()" target="_blank"><img src="images/printer.png" id="Image2" alt="Imprimer" title="Imprimer"></a></div>
<table style="position:absolute;left:4px;top:11px;width:963px;height:38px;z-index:31;" cellpadding="4" cellspacing="0" id="Table3">
<tr>
<td class="cell0"><font style="font-size:19px" color="#FFFFFF" face="Arial Black"><b>Gestion <?php echo $item1; ?></b></font><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
<td class="cell1"><font style="font-size:12px" color="#FFFFFF" face="Arial Black"><b>
<?php 
if ( isset($nom_logement)) {
 $nb_result = count ($nom_logement)-1;
 echo $nb_result." ".$item1 ;
}
?>
</b></font><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="logementHtml1" style="position:absolute;left:2px;top:149px;width:966px;height:45px;z-index:32">
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="Table1">
<tr>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>ID</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Nom <?php echo $item1; ?></B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Format calendrier</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Jour début semaine</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Capacité</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Tarif / Jour</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Synchroniser</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Statistiques</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Modifier</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Supprimer</B></font></td>
</tr>

<?php

$couleur_tab = "#DBE4EE";
$memoire_logement = '';
$cle_fichier ='';

if (isset($nom_logement)) {
 $nb_result = count ($nom_logement);
 if ( $nb_result > 0 ) {

 //tri par ordre alphabétique
 asort($nom_logement);

 foreach ($nom_logement as $cle_fichier => $val_logement )  {
 
 //date mise à jour ical ****************
 $chemin_mise_ajour_ical   = 'fichier_calendrier/ical/'.$cle_fichier.'_date_mise_a_jour.php';  
 if ( file_exists($chemin_mise_ajour_ical) ) {
   include($chemin_mise_ajour_ical);  
   $date_maj_ical[$cle_fichier]["fr"] = 'Dernière synchro : <br>'.$date_maj_ical[$cle_fichier]["fr"];
 }
else
   $date_maj_ical[$cle_fichier]["fr"] = '';
   
  if ( $cle_fichier <> 0 )
   echo '<tr><td align="center" height="30"" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',$cle_fichier,'</font></td>

        <td align="center" height="30"valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',stripslashes($val_logement),'</font></td>

        <td align="center" height="30"valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',$format_calendrier_logement[$cle_fichier],'</font></a></td>

        <td align="center" height="30"valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',$texte_jour_debut_semaine_logement[$cle_fichier],'</font></a></td>

        <td align="center" height="30"valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',$capacite_logement[$cle_fichier],'</font></a></td>

        <td align="center" height="30"valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',$tarif_logement[$cle_fichier],'</font></a></td>

        <td align="center" height="30"valign="center" bgcolor =',$couleur_tab,'><a href="logement.php?fct=synchroniser&num=',$cle_fichier,'" class = "style_lien" ><img src="images/sycnhro.png" alt="Synchronise" border="0" title="Synchroniser les réservations avec les autres calendriers" ><br><font color="#000000" style="font-size:10px" face="Arial">',$date_maj_ical[$cle_fichier]["fr"],'</font></a></td>

        <td align="center" height="30"valign="center" bgcolor =',$couleur_tab,'><a href="listing.php?logement=',$cle_fichier,'" class = "style_lien" ><img src="images/stat2.gif"  alt="Statistiques" border="0" title="statistiques de location" ></a></td>

        <td align="center" height="30"valign="center" bgcolor =',$couleur_tab,'><a href="modif_logement.php?fct=modifier&num=',$cle_fichier,'" class = "style_lien" onclick="return GB_showPage(\'Modifier ',addslashes($item1),' : ',htmlentities(addslashes($val_logement)),'\', this.href)"><img src="images/modifier.gif"  alt="Modifier" border="0" title="Modifier la location" ></a></td>

        <td align="center" height="30"valign="center" bgcolor =',$couleur_tab,'><a href="logement.php?fct=supprimer&num=',$cle_fichier,'" onClick="return(confirm(\'Effacer ce ',$item1,' ? Ceci effacera également toutes les dates de ce logement inscrites dans le calendrier\'));"  class = style_lien ><img src="images/effacer.gif"  alt="Supprimer" border="0" title="Supprimer la location" ></a></td></tr>';
  
  }
 }
}
?>

</table></div>
<div id="wb_Text1" style="position:absolute;left:15px;top:117px;width:65px;height:15px;z-index:33;text-align:left;">
<span style="color:#000000;font-family:'Arial Black';font-size:11px;">Ajouter</span></div>
</div>
</div>
</body>
</html>