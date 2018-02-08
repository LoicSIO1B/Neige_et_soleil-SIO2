<?php
session_start();

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_connexion.php");
     require("fichier_calendrier/calendrier_liste_langue.php");

$lien_page = '';
$code_frame = '';
$code_frame_1mois = '';
$code_datepicker = '';
$locataire ='';
$logement = '';
$liste_id = '';
$langue = 'fr';
$code_include_calendrier_1mois ='';
$adresse_complete = '';
$adresse_ical = 'Veuillez sélectionner une seule location dans le filtre en haut de la page';

// test si demande ajout d'un locataire*****************************************************************************
if ( isset($_POST['code']) && ($_POST['code']) == 'Obtenir le code'  ) {
  extract($_POST);

  include ("contenu_code.php");
 
}  

//chemin absolu serveur	
$chemin_admin = str_replace($_SERVER['DOCUMENT_ROOT'],'',$_SERVER['SCRIPT_FILENAME']);
$chemin_admin = str_replace('/admin/code.php','',$chemin_admin); 	
$chemin_admin = $_SERVER['DOCUMENT_ROOT'].$chemin_admin;


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Administration du calendrier des disponibilités</title>
<meta name="description" content="calendrier">
<meta name="generator" content="http://www.mathieuweb.fr/calendrier/">
<link href="icone_cal.ico" rel="shortcut icon" type="image/x-icon">
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="code.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="fichier_calendrier/styles.css?version=<?php echo filemtime('fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >

<script type="text/javascript" src="fonction.js"></script>

</head>
<body>
<div id="container">
<div id="wb_MasterPage2" style="position:absolute;left:2px;top:0px;width:964px;height:110px;z-index:40;">
</div>
<table style="position:absolute;left:4px;top:106px;width:982px;height:2884px;z-index:41;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Form2" style="position:absolute;left:13px;top:156px;width:959px;height:242px;z-index:42;">
<form name="Form1" method="post" action="code.php" id="Form2">
<div id="wb_Text1" style="position:absolute;left:106px;top:34px;width:178px;height:18px;z-index:0;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Afficher le calendrier en </strong></span></div>
<div id="wb_Text2" style="position:absolute;left:10px;top:70px;width:271px;height:18px;text-align:right;z-index:1;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Pour le ou les locataires suivant :</strong></span></div>
<select name="mois" size="1" id="Combobox3" style="position:absolute;left:298px;top:137px;width:227px;height:24px;z-index:2;" >
<option <?php if ( isset($mois) && ($mois == "" || $mois == "0" ) ) echo "selected"; ?> value="0">Mois courant</option>
<option <?php if ( isset($mois) && $mois == "1" ) echo "selected"; ?> value="1">Janvier</option>
<option <?php if (  isset($mois) && $mois == "2" ) echo "selected"; ?> value="2">Février</option>
<option <?php if (  isset($mois) && $mois == "3" ) echo "selected"; ?> value="3">Mars</option>
<option <?php if (  isset($mois) && $mois == "4" ) echo "selected"; ?> value="4">Avril</option>
<option <?php if (  isset($mois) && $mois =="5" ) echo "selected"; ?> value="5">Mai</option>
<option <?php if (  isset($mois) && $mois =="6" ) echo "selected"; ?> value="6">Juin</option>
<option <?php if (  isset($mois) && $mois =="7" ) echo "selected"; ?> value="7">Juillet</option>
<option <?php if (  isset($mois) && $mois =="8" ) echo "selected"; ?> value="8">Aout</option>
<option <?php if (  isset($mois) && $mois =="9" ) echo "selected"; ?> value="9">Septembre</option>
<option <?php if (  isset($mois) && $mois =="10" ) echo "selected"; ?> value="10">Octobre</option>
<option <?php if (  isset($mois) && $mois == "11" ) echo "selected"; ?> value="11">Novembre</option>
<option <?php if (  isset($mois) && $mois == "12" ) echo "selected"; ?> value="12">Décembre</option


>
</select>
<div id="wb_Text6" style="position:absolute;left:15px;top:141px;width:271px;height:18px;text-align:right;z-index:3;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Avec le premier mois du calendrier</strong></span></div>
<div id="Html3" style="position:absolute;left:7px;top:104px;width:271px;height:22px;z-index:4">
<?php
echo '<div id="wb_Text1" align="right"><font style="font-size:15px" color="#000000" face="Arial"><b>Pour le ou les ',$item1,' suivants</b></font></div>';
?></div>
<select name="an" size="1" id="Combobox2" style="position:absolute;left:298px;top:167px;width:227px;height:24px;z-index:5;" >
<option  value="0">Année en cours</option>
<?php

for ($j=2009; $j<2030 ; $j++) {
  echo '<option value="',$j,'" '; if ( isset($an) && $an == $j) echo " selected "; echo' >',$j,'</option>';
}

?>
<

>
</select>
<div id="wb_Text7" style="position:absolute;left:32px;top:171px;width:254px;height:18px;text-align:right;z-index:6;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Avec l'année du premier mois</strong></span></div>
<input type="submit" id="Button2" name="code" value="Obtenir le code" style="position:absolute;left:298px;top:198px;width:110px;height:25px;z-index:7;">
<div id="Html2" style="position:absolute;left:300px;top:69px;width:315px;height:22px;z-index:8">
<?php

liste_box ("locataire",300,$nom_locataire,$prenom_locataire,false,$locataire,true,"");

?></div>
<div id="Html1" style="position:absolute;left:300px;top:103px;width:314px;height:22px;z-index:9">
<?php

liste_box ("logement",300,$nom_logement,"",false,$logement,false,"");

?></div>
<div id="Html4" style="position:absolute;left:300px;top:33px;width:315px;height:22px;z-index:10">
<?php

liste_box ("langue",300,$nom_langue,"",false,$langue,false,"");

?></div>
</form>
</div>
<textarea name="TextArea1" id="TextArea1" style="position:absolute;left:14px;top:727px;width:953px;height:75px;z-index:43;" rows="3" cols="93" readonly><?php echo html_ent($code_frame); ?></textarea>
<textarea name="TextArea1" id="TextArea2" style="position:absolute;left:16px;top:448px;width:950px;height:64px;z-index:44;" rows="2" cols="93" readonly><?php echo html_ent(str_replace('amp;','',$adresse_complete)); ?></textarea>
<div id="wb_Text9" style="position:absolute;left:11px;top:681px;width:855px;height:19px;z-index:45;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Il peut être nécessaire d'ajuster un peu les paramètres width (largeur) et height (hauteur) du code ci dessous</strong></span></div>
<div id="wb_Text11" style="position:absolute;left:11px;top:2314px;width:858px;height:57px;z-index:46;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Il peut être nécessaire d'ajuster un peu les paramètres width largeur) et height (hauteur) du code ci dessous<br>Si vous souhaitez utiliser plusieurs champs &lt;input&gt; vous devez modifier l'attribut id et name de chaque &lt;input&gt; en indiquant un nom unique, et modifier le paramètre&quot; idcible&quot; du lien choisir.</strong></span></div>
<textarea name="TextArea1" id="TextArea3" style="position:absolute;left:15px;top:2385px;width:952px;height:160px;z-index:47;" rows="7" cols="93" readonly><?php echo html_ent($code_datepicker); ?></textarea>
<div id="wb_Text13" style="position:absolute;left:11px;top:1478px;width:855px;height:38px;z-index:48;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Il peut être nécessaire d'ajuster un peu les paramètres width (largeur) et height (hauteur) du code ci dessous<br>Si vous avez activez l'option &quot;<u>avec lien vers une autre page sur le calendrier visiteur</u>&quot; </strong></span></div>
<textarea name="TextArea1" id="TextArea4" style="position:absolute;left:15px;top:1539px;width:956px;height:104px;z-index:49;" rows="4" cols="93" readonly><?php echo html_ent($code_frame_1mois); ?></textarea>
<div id="wb_Text14" style="position:absolute;left:10px;top:883px;width:858px;height:38px;z-index:50;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Vous pouvez intégrer le calendrier dans une page existante grace à une fonction include, ceci nécessite de petites modifications , éditer les fichiers avec un logiciel texte (notepad)&nbsp; :</strong></span></div>
<textarea name="TextArea1" id="TextArea6" style="position:absolute;left:14px;top:937px;width:956px;height:460px;z-index:51;" rows="24" cols="93" readonly><?php if ( isset($_POST['code']) && ($_POST['code']) == 'Obtenir le code'  ) echo br2nl($code_include_calendrier);  ?></textarea>
<div id="wb_Text4" style="position:absolute;left:10px;top:1721px;width:858px;height:57px;z-index:52;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Vous pouvez intégrer le calendrier 1 mois dans une page existante grace à une fonction include, ceci nécessite de petites modifications de la page calendrier_1mois.php, éditer le fichier avec un logiciel texte (notepad) et modifier :</strong></span></div>
<textarea name="TextArea1" id="TextArea5" style="position:absolute;left:14px;top:1789px;width:955px;height:465px;z-index:53;" rows="24" cols="93" readonly><?php if ( isset($_POST['code']) && ($_POST['code']) == 'Obtenir le code'  ) echo br2nl($code_include_calendrier_1mois);  ?></textarea>
<table style="position:absolute;left:11px;top:114px;width:964px;height:38px;z-index:54;" cellpadding="4" cellspacing="0" id="Table3">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:19px;"><strong>Code d'affichage du calendrier</strong></span></td>
<td class="cell1"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<table style="position:absolute;left:11px;top:405px;width:964px;height:34px;z-index:55;" cellpadding="4" cellspacing="0" id="Table2">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Adresse page du calendrier</strong></span></td>
<td class="cell1"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<table style="position:absolute;left:11px;top:634px;width:964px;height:34px;z-index:56;" cellpadding="4" cellspacing="0" id="Table4">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Affichage du calendrier dans une frame</strong></span></td>
<td class="cell1"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<table style="position:absolute;left:11px;top:835px;width:964px;height:34px;z-index:57;" cellpadding="4" cellspacing="0" id="Table5">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Adresse du calendrier par une fonction include ( utilisateur expérimentés)</strong></span></td>
</tr>
</table>
<table style="position:absolute;left:11px;top:1436px;width:964px;height:34px;z-index:58;" cellpadding="4" cellspacing="0" id="Table6">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Affichage du calendrier 1 mois dans une frame</strong></span></td>
</tr>
</table>
<table style="position:absolute;left:11px;top:1678px;width:964px;height:34px;z-index:59;" cellpadding="4" cellspacing="0" id="Table7">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Affichage du calendrier 1 mois avec une fonction include ( utilisateurs expérimentés)</strong></span></td>
</tr>
</table>
<table style="position:absolute;left:11px;top:2271px;width:964px;height:34px;z-index:60;" cellpadding="4" cellspacing="0" id="Table8">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Affichage du sélécteur de date ( date picker)</strong></span></td>
</tr>
</table>
<div id="wb_Extension2" style="position:absolute;left:362px;top:123px;width:21px;height:21px;z-index:61;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Cette page vous permet d'optenir les codes html ou php pour intégrer les calendriers sur des pages existantes et en fonction du filtre désiré.</font></em></a></div>
<table style="position:absolute;left:12px;top:526px;width:964px;height:34px;z-index:62;" cellpadding="4" cellspacing="0" id="Table9">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Récupérer les id locations et locataires</strong></span></td>
</tr>
</table>
<textarea name="TextArea1" id="TextArea7" style="position:absolute;left:15px;top:572px;width:950px;height:49px;z-index:63;" rows="1" cols="93" readonly><?php echo br2nl(html_ent($liste_id)); ?></textarea>
<div id="wb_MasterPage4" style="position:absolute;left:776px;top:0px;width:96px;height:106px;z-index:64;">
<div id="wb_Shape1" style="position:absolute;left:36px;top:90px;width:21px;height:11px;z-index:11;">
<img src="images/img0003.gif" id="Shape1" alt="" style="width:21px;height:11px;"></div>
<div id="wb_Shape2" style="position:absolute;left:0px;top:98px;width:96px;height:8px;z-index:12;">
<img src="images/img0006.gif" id="Shape2" alt="" style="width:96px;height:8px;"></div>
<div id="wb_Shape3" style="position:absolute;left:0px;top:0px;width:96px;height:3px;z-index:13;">
<img src="images/img0016.gif" id="Shape3" alt="" style="width:96px;height:3px;"></div>
</div>
<div id="wb_MasterPage1" style="position:absolute;left:4px;top:0px;width:998px;height:110px;z-index:65;">
<div id="wb_fond_widget" style="position:absolute;left:960px;top:2px;width:38px;height:108px;filter:alpha(opacity=40);opacity:0.40;z-index:14;">
<img src="images/img0013.png" id="fond_widget" alt="" style="width:38px;height:108px;"></div>
<div id="wb_menu_codes" style="position:absolute;left:800px;top:10px;width:32px;height:32px;z-index:15;">
<a href="./code.php"><img src="images/binary.png" id="menu_codes" alt="Codes pour afficher les calendriers visiteurs" title="Codes pour afficher les calendriers visiteurs"></a></div>
<div id="wb_text_cal" style="position:absolute;left:2px;top:55px;width:95px;height:18px;text-align:center;z-index:16;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./index_calendrier.php" class="Style_menu">Calendrier</a></span></div>
<div id="wb_text_locataire" style="position:absolute;left:97px;top:55px;width:95px;height:18px;text-align:center;z-index:17;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./locataire.php" class="Style_menu">Locataires</a></span></div>
<div id="text_ressource" style="position:absolute;left:193px;top:55px;width:97px;height:44px;z-index:18">
<div  style="text-align:center;">

<font style="font-size:16px" color="#666666" face="Arial"><a href="./logement.php" class="Style_menu">
<?php echo $item1; ?>
</a></font>

</div></div>
<div id="wb_text_couleur" style="position:absolute;left:291px;top:55px;width:95px;height:54px;text-align:center;z-index:19;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./couleur.php" class="Style_menu">Couleurs des marqueurs</a></span></div>
<div id="wb_texte_param" style="position:absolute;left:482px;top:55px;width:95px;height:36px;text-align:center;z-index:20;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./parametrage_calendrier.php" class="Style_menu">Paramètres calendrier</a></span></div>
<div id="wb_text_stats" style="position:absolute;left:387px;top:55px;width:95px;height:18px;text-align:center;z-index:21;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./listing.php" class="Style_menu">Statistiques</a></span></div>
<div id="wb_texte_langues" style="position:absolute;left:578px;top:55px;width:95px;height:18px;text-align:center;z-index:22;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./edit_langue.php" class="Style_menu">Langues</a></span></div>
<div id="wb_text_maintenance" style="position:absolute;left:674px;top:55px;width:95px;height:18px;text-align:center;z-index:23;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./base.php" class="Style_menu">Maintenance</a></span></div>
<div id="wb_text_codes" style="position:absolute;left:769px;top:55px;width:95px;height:18px;text-align:center;z-index:24;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./code.php" class="Style_menu">Codes</a></span></div>
<div id="wb_text_propos" style="position:absolute;left:862px;top:55px;width:95px;height:18px;text-align:center;z-index:25;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./a_propos.php" class="Style_menu">A propos</a></span></div>
<div id="wb_Image10" style="position:absolute;left:967px;top:3px;width:20px;height:20px;z-index:26;">
<a href="identification.php?fct=deconnexion"><img src="images/img0007.png" id="Image10" alt="D&#233;connexion" title="D&#233;connexion"></a></div>
<div id="wb_menu_memo" style="position:absolute;left:961px;top:27px;width:31px;height:31px;z-index:27;">
<a href="#"><img src="images/img0012.png" id="menu_memo" alt="M&#233;mo" title="M&#233;mo" onclick="coller_ajax('memo','colle_memo.html');document.getElementById('Memoire').style.visibility='visible';"></a></div>
<div id="wb_menu_calcul" style="position:absolute;left:963px;top:66px;width:32px;height:32px;z-index:28;">
<a href="#"><img src="images/img0325.png" id="menu_calcul" alt="Calculatrice" title="Calculatrice" onclick="document.getElementById('Calculatrice').style.visibility='visible';"></a></div>
<div id="wb_menu_cal" style="position:absolute;left:27px;top:10px;width:44px;height:37px;z-index:29;">
<a href="./index_calendrier.php"><img src="images/img0021.png" id="menu_cal" alt="Calendrier" title="Calendrier"></a></div>
<div id="wb_menu_locataire" style="position:absolute;left:123px;top:7px;width:48px;height:48px;z-index:30;">
<a href="./locataire.php"><img src="images/people.png" id="menu_locataire" alt="Gestion des locataires" title="Gestion des locataires"></a></div>
<div id="wb_menu_ressources" style="position:absolute;left:217px;top:7px;width:48px;height:48px;z-index:31;">
<a href="./logement.php"><img src="images/09_48x48.png" id="menu_ressources" alt="Gestion des logements" title="Gestion des logements"></a></div>
<div id="wb_menu_couleur" style="position:absolute;left:315px;top:7px;width:48px;height:48px;z-index:32;">
<a href="./couleur.php"><img src="images/palette.png" id="menu_couleur" alt="Gestion des marqueurs" title="Gestion des marqueurs"></a></div>
<div id="wb_manu_maintenance" style="position:absolute;left:699px;top:7px;width:48px;height:48px;z-index:33;">
<a href="./base.php"><img src="images/maintenance.png" id="manu_maintenance" alt="Maintenance des donn&#233;es" title="Maintenance des donn&#233;es"></a></div>
<div id="wb_menu_stat" style="position:absolute;left:411px;top:7px;width:48px;height:48px;z-index:34;">
<a href="./listing.php"><img src="images/stat.png" id="menu_stat" alt="Statistiques de locations" title="Statistiques de locations"></a></div>
<div id="wb_menu_langue" style="position:absolute;left:604px;top:7px;width:48px;height:48px;z-index:35;">
<a href="./edit_langue.php"><img src="images/langue.png" id="menu_langue" alt="Gestion des langues" title="Gestion des langues"></a></div>
<div id="wb_menu_paraemtre" style="position:absolute;left:506px;top:7px;width:48px;height:48px;z-index:36;">
<a href="./parametrage_calendrier.php"><img src="images/administrative_docs.png" id="menu_paraemtre" alt="Param&#233;tres du calendrier" title="Param&#233;tres du calendrier"></a></div>
<div id="wb_menu_propos" style="position:absolute;left:886px;top:7px;width:48px;height:48px;z-index:37;">
<a href="./a_propos.php"><img src="images/brainstorming.png" id="menu_propos" alt="A propos du script" title="A propos du script"></a></div>
<div id="text_affiche_info" style="position:absolute;left:276px;top:2px;width:274px;height:10px;z-index:38">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<!-- widget -->
<div id="text_code_commun" style="position:absolute;left:570px;top:0px;width:25px;height:31px;z-index:39">
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
<table style="position:absolute;left:11px;top:2563px;width:964px;height:34px;z-index:66;" cellpadding="4" cellspacing="0" id="codeTable1">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:16px;"><strong>Adresse page du calendrier format ical</strong></span></td>
<td class="cell1"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<textarea name="TextArea1" id="codeTextArea1" style="position:absolute;left:16px;top:2673px;width:950px;height:64px;z-index:67;" rows="2" cols="93" readonly><?php echo html_ent($adresse_ical); ?></textarea>
<div id="wb_codeText2" style="position:absolute;left:16px;top:2753px;width:858px;height:204px;z-index:68;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Pour automatiser la synchronisation, <br>&nbsp;&nbsp; - il faut éditer le fichier synchro_ical.php qui se trouve dans le répertoire admin/ical/<br>&nbsp;&nbsp; - renseigner l'adresse serveur affichée ci dessous<br><br><br><br><br><br>&nbsp;&nbsp; - mettre à jour le fichier sur le serveur<br>&nbsp;&nbsp; - créer un tâche automatisée chez votre hébergeur en pointant le fichier synchro_ical.php<br></strong></span></div>
<div id="wb_codeText1" style="position:absolute;left:16px;top:2605px;width:858px;height:57px;z-index:69;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong>Permet de synchroniser le calendrier avec un autre site internet (format ical ), seule les dates indisponibles sont synchronisées.<br>Veuillez sélectionner une seule location dans le filtre en haut de cette page.</strong></span></div>
<textarea name="TextArea1" id="codeTextArea2" style="position:absolute;left:16px;top:2824px;width:950px;height:64px;z-index:70;" rows="2" cols="93" readonly><?php echo html_ent($chemin_admin); ?></textarea>
</div>
</body>
</html>