<?php
session_start();

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
   require("secure_connexion.php");

   require("fichier_calendrier/langue.php");

//initialisation de variables ********************
$premiere_ligne = true;
$compteur_date = 0;
$affiche_par_get = false; 

if ( isset($_POST['Afficher']) && ($_POST['Afficher']) == 'Afficher' && test_date_fr($_POST['choix_date_debut']) == 0 && test_date_fr($_POST['choix_date_fin']) == 0 ) {

  $liste_couleur = '';
  $liste_couleur = $_POST['couleur'];  

  extract($_POST);

  include("genere/genere_selection_utilisateur.php");

}

if ( isset($_POST['Afficher']) && ($_POST['Afficher']) == 'Afficher pour les 8 jours suivants'  ) {
 
  $date_actuelle = date("d/m/Y");
  
  $_POST['choix_date_debut'] = $date_actuelle;
  $_POST['choix_date_fin']   = ajout_jour_date ($date_actuelle,8,"JMA","/","fr");

  $liste_couleur = '';
  $liste_couleur = $_POST['couleur'];  

  extract($_POST);

  include("genere/genere_selection_utilisateur.php");

}

if ( isset($_POST['Afficher']) && ($_POST['Afficher']) == 'Afficher pour les 15 jours suivants'  ) {
 
  $date_actuelle = date("d/m/Y");
  
  $_POST['choix_date_debut'] = $date_actuelle;
  $_POST['choix_date_fin']   = ajout_jour_date ($date_actuelle,15,"JMA","/","fr");

  $liste_couleur = '';
  $liste_couleur = $_POST['couleur'];  

  extract($_POST);

  include("genere/genere_selection_utilisateur.php");

}

if ( isset($_POST['Afficher']) && ($_POST['Afficher']) == 'Afficher pour les 22 jours suivants'  ) {
 
  $date_actuelle = date("d/m/Y");
  
  $_POST['choix_date_debut'] = $date_actuelle;
  $_POST['choix_date_fin']   = ajout_jour_date ($date_actuelle,22,"JMA","/","fr");

  $liste_couleur = '';
  $liste_couleur = $_POST['couleur'];  

  extract($_POST);

  include("genere/genere_selection_utilisateur.php");

}

if ( isset($_POST['Afficher']) && ($_POST['Afficher']) == 'Afficher pour les 29 jours suivants'  ) {
 
  $date_actuelle = date("d/m/Y");
  
  $_POST['choix_date_debut'] = $date_actuelle;
  $_POST['choix_date_fin']   = ajout_jour_date ($date_actuelle,29,"JMA","/","fr");

  $liste_couleur = '';
  $liste_couleur = $_POST['couleur'];  

  extract($_POST);

  include("genere/genere_selection_utilisateur.php");

}

if ( isset($_POST['Afficher']) && ($_POST['Afficher']) == 'Afficher pour les'  ) {
 
  $date_actuelle = date("d/m/Y");
  
  $_POST['choix_date_debut'] = $date_actuelle;
  $_POST['choix_date_fin']   = ajout_jour_date ($date_actuelle,$_POST['periode_affiche'],"JMA","/","fr");

  $liste_couleur = '';
  $liste_couleur = $_POST['couleur'];  

  extract($_POST);

  include("genere/genere_selection_utilisateur.php");

}

if ( isset($_GET['logement']) && is_numeric($_GET['logement'])  ) {

  include("fichier_calendrier/calendrier_selection_utilisateur.php");
  $choix_selection_logement = $_GET['logement'];

  include("genere/genere_selection_utilisateur.php");
  $affiche_par_get = true;
}


if ( isset($_GET['locataire']) && is_numeric($_GET['locataire'])  ) {

  include("fichier_calendrier/calendrier_selection_utilisateur.php");
  $choix_selection_locataire = $_GET['locataire'];

  include("genere/genere_selection_utilisateur.php");
  $affiche_par_get = true;
} 


if ( isset($_GET['couleur']) && is_numeric($_GET['couleur'])  ) {

  include("fichier_calendrier/calendrier_selection_utilisateur.php");
  $liste_couleur = '' ;
  $liste_couleur[0]   = $_GET['couleur'];

  include("genere/genere_selection_utilisateur.php");
  $affiche_par_get = true;
} 

 include("fichier_calendrier/calendrier_selection_utilisateur.php");

// compression code de la page ********************************************************************
 if ( $avec_compression_page )
    ob_start( 'ob_gzhandler' );

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
<link href="listing.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
<script type="text/javascript">
function Validateliste(theForm)
{
   var regexp;
   if (theForm.choix_date_debut.value.length < 1)
   {
      alert("Vous devez indiquez une date de début de période ( cliquez sur le lien choisir) !");
      theForm.choix_date_debut.focus();
      return false;
   }
   if (theForm.choix_date_fin.value.length < 1)
   {
      alert("Vous devez indiquez une date de fin de période ( cliquez sur le lien choisir) !");
      theForm.choix_date_fin.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.Editbox1.value))
   {
      alert("La période d'affichage doit être un chiffre !");
      theForm.Editbox1.focus();
      return false;
   }
   return true;
}
</script>
<script type="text/javascript">
    var GB_ROOT_DIR = "js_lightbox/";
</script>

<script type="text/javascript" src="js_lightbox/AJS.js"></script>
<script type="text/javascript" src="js_lightbox/AJS_fx.js"></script>
<script type="text/javascript" src="js_lightbox/gb_scripts.js"></script>
<link href="js_lightbox/gb_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="wwb11.min.js"></script>
<link rel="stylesheet" href="fichier_calendrier/styles.css?version=<?php echo filemtime('fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >

<script type="text/javascript" src="fonction.js"></script>

<script>
 function PostSelect(liste){

 // On modifie l'ID du champ select pour que PHP traite cette
 // dernière comme un array
 document.forms[liste].elements.couleur.name = "couleur[]";

 // On soumet le formulaire
 document.forms[liste].submit();
 }
 </script>

<script language="JavaScript" type="text/javascript">
<!--
function popupwnd(url, toolbar, menubar, locationbar, resize, scrollbars, statusbar, left, top, width, height)
{
   var popupwindow = this.open(url, '', 'toolbar=' + toolbar + ',menubar=' + menubar + ',location=' + locationbar + ',scrollbars=' + scrollbars + ',resizable=' + resize + ',status=' + statusbar + ',left=' + left + ',top=' + top + ',width=' + width + ',height=' + height);
}
//-->
</script>



</head>
<body>
<div id="container">
<div id="wb_MasterPage1" style="position:absolute;left:2px;top:0px;width:964px;height:110px;z-index:61;">
</div>
<table style="position:absolute;left:4px;top:109px;width:982px;height:832px;z-index:62;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>



</table><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<table style="position:absolute;left:11px;top:114px;width:960px;height:38px;z-index:63;" cellpadding="4" cellspacing="0" id="Table3">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:19px;"><strong>Statistiques de location</strong></span></td>
<td class="cell1"><div style="color:#FFFFFF;font-size:12px;font-family:Arial;font-weight:normal;font-style:normal;text-decoration:none;text-align:right" id="date_heure_jour"><b></b></div>
<script type="text/javascript">affiche_date_jour();</script><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<table style="position:absolute;left:12px;top:461px;width:964px;height:38px;z-index:64;" cellpadding="4" cellspacing="0" id="Table4">
<tr>
<td class="cell0"><font style="font-size:19px" color="#FFFFFF" face="Arial Black"><b>Occupation <?php echo $item1; ?></b></font><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
<td class="cell1"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_liste" style="position:absolute;left:13px;top:159px;width:955px;height:290px;z-index:65;">
<form name="liste" method="post" action="listing.php" id="liste" onsubmit="if(!Validateliste(this)) return false;PostSelect(this.name);return false;return false;">
<input type="submit" id="Button2" name="Afficher" value="Afficher" style="position:absolute;left:555px;top:246px;width:96px;height:25px;z-index:0;">
<div id="wb_Text1" style="position:absolute;left:26px;top:16px;width:304px;height:18px;text-align:right;z-index:1;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Afficher les jours pour le locataire</strong></span></div>
<div id="Html1" style="position:absolute;left:347px;top:15px;width:315px;height:22px;z-index:2">
<?php

liste_box ("choix_selection_locataire",300,$nom_locataire,$prenom_locataire,false,$choix_selection_locataire,true,"");

?></div>
<div id="wb_Text5" style="position:absolute;left:4px;top:162px;width:326px;height:18px;text-align:right;z-index:3;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Dans la période du </strong></span></div>
<input type="text" id="choix_date_debut" onclick="document.getElementById('choix_date_debut').value='';return false;" style="position:absolute;left:348px;top:158px;width:118px;height:22px;line-height:22px;z-index:4;" name="choix_date_debut" value="<?php  echo $choix_date_debut; ?>" readonly>
<input type="text" id="choix_date_fin" onclick="document.getElementById('choix_date_fin').value='';return false;" style="position:absolute;left:534px;top:158px;width:118px;height:22px;line-height:22px;z-index:5;" name="choix_date_fin" value="<?php echo $choix_date_fin; ?>" readonly>
<div id="wb_Text6" style="position:absolute;left:503px;top:162px;width:24px;height:18px;text-align:right;z-index:6;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>au</strong></span></div>
<div id="wb_Text9" style="position:absolute;left:4px;top:198px;width:326px;height:18px;text-align:right;z-index:7;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Afficher&nbsp; le listing complet des dates</strong></span></div>
<input type="checkbox" id="Checkbox1" name="listing_complet" value="on" style="position:absolute;left:347px;top:197px;z-index:8;" <?php if ( isset($listing_complet) && $listing_complet == "on" ) {echo 'checked';} ?>>
<div id="wb_Text10" style="position:absolute;left:4px;top:86px;width:326px;height:18px;text-align:right;z-index:9;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Afficher les jours marqués de la couleur</strong></span></div>
<div id="Html3" style="position:absolute;left:346px;top:79px;width:315px;height:28px;z-index:10">
<?php 
     echo '<font style="font-size:16px" color="#FFFFFF" face="Arial" >
           <select name="couleur[]" id="couleur[]" multiple size="3" id="Combobox1"  style="font-family:Arial;font-size:16px;color:#FFFFFF;background-color:#000000;width:300px;"></font>';
        $nb_result = count ($couleur_reserve);
        if ( $nb_result > 0 ) {
        foreach ($couleur_reserve as $cle => $val_couleur )  {
           $couleur_selection = false;
           if ( isset($liste_couleur) ) {
             foreach ($liste_couleur as $cle_temp => $val_temp ) { 
               if ( $val_temp == $cle )
                $couleur_selection = true;
            }
           }
           if ( $couleur_selection) 
             echo '<option value="',$cle,'" selected style="background-color:',$val_couleur,';color:',$couleur_texte_jour_reserve[$cle],';font-family:Arial;font-size:16px;">',$intitule_couleur_reserve[$cle],'</option>' ;
           else              
             echo '<option value="',$cle,'" style="background-color:',$val_couleur,';color:',$couleur_texte_jour_reserve[$cle],';font-family:Arial;font-size:16px;">',$intitule_couleur_reserve[$cle],'</option>' ;

         }
        }   
        echo '</select>';

?></div>
<div id="Html5" style="position:absolute;left:8px;top:49px;width:323px;height:22px;z-index:11">
<?php
echo '<div id="wb_Text1" align="right"><font style="font-size:15px" color="#4B4B4B" face="Arial"><b>Afficher les jours pour ',$item1,'</b></font></div>';
?></div>
<div id="Html2" style="position:absolute;left:347px;top:49px;width:314px;height:22px;z-index:12">
<?php

liste_box ("choix_selection_logement",300,$nom_logement,"",false,$choix_selection_logement,false,"");

?></div>
<div id="wb_Image1" style="position:absolute;left:652px;top:149px;width:43px;height:43px;z-index:13;">
<a href="javascript:popupwnd('date-picker.php?idcible=choix_date_fin','no','no','no','yes','yes','no','50','50','650','850')" target="_self"><img src="images/img0464.png" id="Image1" alt="Choisir une date" title="Choisir une date"></a></div>
<div id="wb_Image3" style="position:absolute;left:467px;top:149px;width:43px;height:43px;z-index:14;">
<a href="javascript:popupwnd('date-picker.php?idcible=choix_date_debut','no','no','no','yes','yes','no','50','50','650','850')" target="_self"><img src="images/img0465.png" id="Image3" alt="Choisir une date" title="Choisir une date"></a></div>
<div id="wb_Image2" style="position:absolute;left:781px;top:220px;width:48px;height:48px;z-index:15;">
<a href="javascript:window.print()" target="_self"><img src="images/printer.png" id="Image2" alt=""></a></div>
<div id="wb_Extension1" style="position:absolute;left:720px;top:220px;width:58px;height:53px;z-index:16;">
<a href="export_stat.php" onclick="return GB_showPage('Exporter les locations au format CSV', this.href)" ><img src="stat_csv.png" alt="Export"/ border ="0"></a></div>
<div id="wb_Text2" style="position:absolute;left:716px;top:261px;width:65px;height:15px;text-align:center;z-index:17;">
<span style="color:#000000;font-family:'Arial Black';font-size:11px;">Exporter</span></div>
<input type="submit" id="Button1" name="Afficher" value="Afficher pour les 8 jours suivants" style="position:absolute;left:716px;top:15px;width:226px;height:30px;z-index:18;">
<input type="submit" id="Button3" name="Afficher" value="Afficher pour les 15 jours suivants" style="position:absolute;left:716px;top:48px;width:226px;height:30px;z-index:19;">
<input type="submit" id="Button4" name="Afficher" value="Afficher pour les 22 jours suivants" style="position:absolute;left:717px;top:81px;width:226px;height:30px;z-index:20;">
<input type="submit" id="Button5" name="Afficher" value="Afficher pour les 29 jours suivants" style="position:absolute;left:717px;top:115px;width:226px;height:30px;z-index:21;">
<div id="wb_Text3" style="position:absolute;left:4px;top:227px;width:326px;height:18px;text-align:right;z-index:22;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Afficher&nbsp; le détail du locataire</strong></span></div>
<input type="checkbox" id="locataire_complet" name="locataire_complet" value="on" style="position:absolute;left:347px;top:226px;z-index:23;" <?php if (  isset($locataire_complet) &&  $locataire_complet == "on" ) {echo 'checked';} ?>>
<div id="wb_Text4" style="position:absolute;left:4px;top:254px;width:326px;height:18px;text-align:right;z-index:24;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Afficher&nbsp; les infobulles</strong></span></div>
<input type="checkbox" id="avec_infobulle" name="avec_infobulle" value="on" style="position:absolute;left:347px;top:253px;z-index:25;" <?php if ( isset($avec_infobulle) && $avec_infobulle == "on" ) {echo 'checked';} ?>>
<div id="wb_Extension5" style="position:absolute;left:365px;top:253px;width:21px;height:21px;z-index:26;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Cette option permet d'afficher les infobulles des dates.</font></em></a></div>
<div id="wb_Extension3" style="position:absolute;left:365px;top:226px;width:21px;height:21px;z-index:27;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Cochez cette case pour afficher toutes les coordonnées du locataires, si cette case n'est pas cochée seul le nom et prénom du locataire sera affiché.</font></em></a></div>
<div id="wb_Extension2" style="position:absolute;left:365px;top:197px;width:21px;height:21px;z-index:28;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Le listing complet affichera toutes les dates, avec le détails pour chaque date ( couleur, nom du locataire, tarif de location) + un tableau récapitulatif.</font></em></a></div>
<input type="submit" id="Button6" name="Afficher" value="Afficher pour les" style="position:absolute;left:717px;top:150px;width:121px;height:30px;z-index:29;">
<input type="text" id="Editbox1" style="position:absolute;left:842px;top:153px;width:56px;height:24px;line-height:24px;z-index:30;" name="periode_affiche" value="<?php echo $periode_affiche; ?>">
<div id="wb_Text7" style="position:absolute;left:904px;top:159px;width:42px;height:18px;z-index:31;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>jours</strong></span></div>
</form>
</div>
<div id="wb_Extension4" style="position:absolute;left:317px;top:265px;width:21px;height:21px;z-index:66;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Sélectionnez le ou les marqueurs de couleurs qui doivent être pris en compte dans le listing.<br>
Pour sélectionner plusieurs mrauqueurs, cliquez sur les couleurs de votre choix en maintenant la touche &quot;CTRL&quot; enfoncée.</font></em></a></div>
<div id="wb_Shape1" style="position:absolute;left:393px;top:97px;width:96px;height:9px;z-index:67;">
<img src="images/img0474.gif" id="Shape1" alt="" style="width:96px;height:9px;"></div>
<div id="wb_Shape2" style="position:absolute;left:426px;top:91px;width:25px;height:13px;z-index:68;">
<img src="images/img0475.gif" id="Shape2" alt="" style="width:25px;height:13px;"></div>
<div id="wb_MasterPage4" style="position:absolute;left:391px;top:0px;width:96px;height:106px;z-index:69;">
<div id="wb_Shape1" style="position:absolute;left:36px;top:90px;width:21px;height:11px;z-index:32;">
<img src="images/img0003.gif" id="Shape1" alt="" style="width:21px;height:11px;"></div>
<div id="wb_Shape2" style="position:absolute;left:0px;top:98px;width:96px;height:8px;z-index:33;">
<img src="images/img0006.gif" id="Shape2" alt="" style="width:96px;height:8px;"></div>
<div id="wb_Shape3" style="position:absolute;left:0px;top:0px;width:96px;height:3px;z-index:34;">
<img src="images/img0016.gif" id="Shape3" alt="" style="width:96px;height:3px;"></div>
</div>
<div id="wb_MasterPage2" style="position:absolute;left:4px;top:0px;width:998px;height:110px;z-index:70;">
<div id="wb_fond_widget" style="position:absolute;left:960px;top:2px;width:38px;height:108px;filter:alpha(opacity=40);opacity:0.40;z-index:35;">
<img src="images/img0013.png" id="fond_widget" alt="" style="width:38px;height:108px;"></div>
<div id="wb_menu_codes" style="position:absolute;left:800px;top:10px;width:32px;height:32px;z-index:36;">
<a href="./code.php"><img src="images/binary.png" id="menu_codes" alt="Codes pour afficher les calendriers visiteurs" title="Codes pour afficher les calendriers visiteurs"></a></div>
<div id="wb_text_cal" style="position:absolute;left:2px;top:55px;width:95px;height:18px;text-align:center;z-index:37;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./index_calendrier.php" class="Style_menu">Calendrier</a></span></div>
<div id="wb_text_locataire" style="position:absolute;left:97px;top:55px;width:95px;height:18px;text-align:center;z-index:38;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./locataire.php" class="Style_menu">Locataires</a></span></div>
<div id="text_ressource" style="position:absolute;left:193px;top:55px;width:97px;height:44px;z-index:39">
<div  style="text-align:center;">

<font style="font-size:16px" color="#666666" face="Arial"><a href="./logement.php" class="Style_menu">
<?php echo $item1; ?>
</a></font>

</div></div>
<div id="wb_text_couleur" style="position:absolute;left:291px;top:55px;width:95px;height:54px;text-align:center;z-index:40;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./couleur.php" class="Style_menu">Couleurs des marqueurs</a></span></div>
<div id="wb_texte_param" style="position:absolute;left:482px;top:55px;width:95px;height:36px;text-align:center;z-index:41;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./parametrage_calendrier.php" class="Style_menu">Paramètres calendrier</a></span></div>
<div id="wb_text_stats" style="position:absolute;left:387px;top:55px;width:95px;height:18px;text-align:center;z-index:42;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./listing.php" class="Style_menu">Statistiques</a></span></div>
<div id="wb_texte_langues" style="position:absolute;left:578px;top:55px;width:95px;height:18px;text-align:center;z-index:43;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./edit_langue.php" class="Style_menu">Langues</a></span></div>
<div id="wb_text_maintenance" style="position:absolute;left:674px;top:55px;width:95px;height:18px;text-align:center;z-index:44;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./base.php" class="Style_menu">Maintenance</a></span></div>
<div id="wb_text_codes" style="position:absolute;left:769px;top:55px;width:95px;height:18px;text-align:center;z-index:45;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./code.php" class="Style_menu">Codes</a></span></div>
<div id="wb_text_propos" style="position:absolute;left:862px;top:55px;width:95px;height:18px;text-align:center;z-index:46;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./a_propos.php" class="Style_menu">A propos</a></span></div>
<div id="wb_Image10" style="position:absolute;left:967px;top:3px;width:20px;height:20px;z-index:47;">
<a href="identification.php?fct=deconnexion"><img src="images/img0007.png" id="Image10" alt="D&#233;connexion" title="D&#233;connexion"></a></div>
<div id="wb_menu_memo" style="position:absolute;left:961px;top:27px;width:31px;height:31px;z-index:48;">
<a href="#"><img src="images/img0012.png" id="menu_memo" alt="M&#233;mo" title="M&#233;mo" onclick="coller_ajax('memo','colle_memo.html');document.getElementById('Memoire').style.visibility='visible';"></a></div>
<div id="wb_menu_calcul" style="position:absolute;left:963px;top:66px;width:32px;height:32px;z-index:49;">
<a href="#"><img src="images/img0325.png" id="menu_calcul" alt="Calculatrice" title="Calculatrice" onclick="document.getElementById('Calculatrice').style.visibility='visible';"></a></div>
<div id="wb_menu_cal" style="position:absolute;left:27px;top:10px;width:44px;height:37px;z-index:50;">
<a href="./index_calendrier.php"><img src="images/img0021.png" id="menu_cal" alt="Calendrier" title="Calendrier"></a></div>
<div id="wb_menu_locataire" style="position:absolute;left:123px;top:7px;width:48px;height:48px;z-index:51;">
<a href="./locataire.php"><img src="images/people.png" id="menu_locataire" alt="Gestion des locataires" title="Gestion des locataires"></a></div>
<div id="wb_menu_ressources" style="position:absolute;left:217px;top:7px;width:48px;height:48px;z-index:52;">
<a href="./logement.php"><img src="images/09_48x48.png" id="menu_ressources" alt="Gestion des logements" title="Gestion des logements"></a></div>
<div id="wb_menu_couleur" style="position:absolute;left:315px;top:7px;width:48px;height:48px;z-index:53;">
<a href="./couleur.php"><img src="images/palette.png" id="menu_couleur" alt="Gestion des marqueurs" title="Gestion des marqueurs"></a></div>
<div id="wb_manu_maintenance" style="position:absolute;left:699px;top:7px;width:48px;height:48px;z-index:54;">
<a href="./base.php"><img src="images/maintenance.png" id="manu_maintenance" alt="Maintenance des donn&#233;es" title="Maintenance des donn&#233;es"></a></div>
<div id="wb_menu_stat" style="position:absolute;left:411px;top:7px;width:48px;height:48px;z-index:55;">
<a href="./listing.php"><img src="images/stat.png" id="menu_stat" alt="Statistiques de locations" title="Statistiques de locations"></a></div>
<div id="wb_menu_langue" style="position:absolute;left:604px;top:7px;width:48px;height:48px;z-index:56;">
<a href="./edit_langue.php"><img src="images/langue.png" id="menu_langue" alt="Gestion des langues" title="Gestion des langues"></a></div>
<div id="wb_menu_paraemtre" style="position:absolute;left:506px;top:7px;width:48px;height:48px;z-index:57;">
<a href="./parametrage_calendrier.php"><img src="images/administrative_docs.png" id="menu_paraemtre" alt="Param&#233;tres du calendrier" title="Param&#233;tres du calendrier"></a></div>
<div id="wb_menu_propos" style="position:absolute;left:886px;top:7px;width:48px;height:48px;z-index:58;">
<a href="./a_propos.php"><img src="images/brainstorming.png" id="menu_propos" alt="A propos du script" title="A propos du script"></a></div>
<div id="text_affiche_info" style="position:absolute;left:276px;top:2px;width:274px;height:10px;z-index:59">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<!-- widget -->
<div id="text_code_commun" style="position:absolute;left:570px;top:0px;width:25px;height:31px;z-index:60">
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
<div id="listingHtml1" style="position:absolute;left:19px;top:510px;width:952px;height:167px;z-index:71">
<?php

$couleur_tab = "#DBE4EE";
$compteur_jour = 0;
$compteur_gain = 0;
$compteur_gain_total = 0;

// test si demande ajout d'un locataire*****************************************************************************
if ( (isset($_POST['Afficher']) && test_date_fr($_POST['choix_date_debut']) == 0 && test_date_fr($_POST['choix_date_fin']) == 0 )  ||  $affiche_par_get ) {

  include("genere/genere_selection_utilisateur.php");

  if ( AVEC_BDD )
   include("listing_avec_bdd.php");
  else
   include("listing_sans_bdd.php");   

}

?></div>
</div>
</body>
</html><?php

 if ( $avec_compression_page )
    ob_end_flush();

?>