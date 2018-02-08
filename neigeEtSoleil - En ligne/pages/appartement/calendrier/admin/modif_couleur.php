<?php
session_start();

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
    require("secure_connexion.php");


 $couleur_reserve_temp = 'FF0000';
 $intitule_couleur_reserve_temp = '';
 $url_couleur_reserve_temp = '';
 $couleur_texte_jour_reserve_temp = 'FFFFFF';
 $couleur_date_clic_temp = '';
 $couleur_invisible_temp = ''; 
 $date_couleur_barre_temp = '';
 $date_dispo_temp = '';
 $date_synchro_temp = '';
 $cle_couleur_modif = '';
 $affiche_tarif_couleur_temp = '';
 $affiche_info = '';


// test si demande ajout d'un locataire*****************************************************************************
if ( isset($_POST['Modifier']) && ($_POST['Modifier']) == 'Modifier' && !(empty($_POST['nom']))  && !MODE_DEMO ) {

  //initialisation des variables*************************
  extract($_POST);

  //contrôle si couleur par defaut ical existe déjà ou pas
  $couleur_defaut_existe = false;
  $id_couleur_defaut_ical= 0;
  if ( isset($date_couleur_synchro) && is_array($date_couleur_synchro) ) {
    foreach ( $date_couleur_synchro as $id_couleur => $etat_couleur ) {
      if ( $etat_couleur) { $couleur_defaut_existe = true ; $id_couleur_defaut_ical= $id_couleur; }
       }
   }

  $intitule_couleur_reserve[$cle_modif] = guillet_var ($nom) ; 
  $couleur_reserve[$cle_modif] = $couleur_fond ; 
  $url_couleur_reserve[$cle_modif] = guillet_var ($url) ; 
  $ancienne_couleur = $couleur_fond ; 
  $couleur_texte_jour_reserve[$cle_modif] = $couleur_texte ;
  if ( $affiche_tarif_couleur == 'tarif' )
      $couleur_affiche_tarif[$cle_modif] = true ;
  else
      $couleur_affiche_tarif[$cle_modif] = false ;
  if ( isset($visibilite_couleur) &&  $visibilite_couleur  == "oui" ) 
      $couleur_invisible[$cle_modif] = true;
  else
      $couleur_invisible[$cle_modif] = false;
  if ( isset($autor_clic) &&  $autor_clic  == "oui" ) 
      $couleur_date_clic[$cle_modif] = true;
  else
      $couleur_date_clic[$cle_modif] = false;
  if ( isset($date_couleur_a_barre) &&  $date_couleur_a_barre  == "oui" ) 
      $date_couleur_barre[$cle_modif] = true;
  else
      $date_couleur_barre[$cle_modif] = false;
  if ( isset($date_dispo) &&  $date_dispo  == "oui" ) 
      $date_couleur_disponible[$cle_modif] = true;
  else
      $date_couleur_disponible[$cle_modif] = false;
  if ( isset($date_synchro) &&  $date_synchro  == "oui" ) 
      $date_couleur_synchro[$cle_modif] = true;
  else
      $date_couleur_synchro[$cle_modif] = false;

  //chemin vers le fichier de création liste des locataires/logements**********************************************************
  if ( $id_couleur_defaut_ical == $cle_modif  || !$couleur_defaut_existe || !$date_couleur_synchro[$cle_modif] )
     include("genere/genere_listes_couleur.php");
  else {
   $creation_reussi = false;
   $affiche_info = "erreur_couleur_defaut_existe"; 
   }


  if ( AVEC_BDD ) {
  //connection a la base de donnees*******************************************************************

  $connect = @mysql_connect(Decrypte(hote_cal,$Cle), Decrypte(user_cal,$Cle), Decrypte(password_cal,$Cle));  
  $connect_base = @mysql_select_db(Decrypte(base_cal,$Cle), $connect) ;

  $valeur_select = "UPDATE ".Decrypte(nom_table_cal,$Cle)."  SET couleur = '$couleur_fond' where couleur_texte = '$cle_modif'";

  $etat_req = @mysql_query($valeur_select);
  }
  //fonctionnement sans base de données *************************************************************
  else {
   include("modif_date_couleur.php");
  }

  $_SESSION['couleur'] = '';
  unset($_SESSION['couleur']);
  unset($_SESSION['choix_couleur_texte_reserve']);

if ( isset($creation_reussi,$etat_req) && $creation_reussi && $etat_req )
    $affiche_info = "ajout_ok" ;
else if ( !isset($affiche_info) || $affiche_info == '' )
   $affiche_info = "erreur_execution"; 

  $_GET['num'] = $cle_modif;
  $_GET['fct'] = "modifier";
} 


// test si demande effacement d'une couleur*****************************************************************************
if ( isset($_GET['fct']) && !is_numeric($_GET['fct']) &&  !(empty($_GET['fct'])) &&  isset($_GET['num']) && is_numeric($_GET['num'])) {

  $num_supprime = $_GET['num'] ;
  $couleur_supprime = $couleur_reserve[$num_supprime] ;

  $fonction = $_GET['fct'] ;

//fonction modifier **************************

if ( $fonction == 'modifier' ) {

 $couleur_reserve_temp = $couleur_reserve[$num_supprime];
 $intitule_couleur_reserve_temp = $intitule_couleur_reserve[$num_supprime];
 $url_couleur_reserve_temp = $url_couleur_reserve[$num_supprime];
 $couleur_texte_jour_reserve_temp = $couleur_texte_jour_reserve[$num_supprime];
 $couleur_date_clic_temp = $couleur_date_clic[$num_supprime];
 $couleur_invisible_temp = $couleur_invisible[$num_supprime];
 $date_couleur_barre_temp = $date_couleur_barre[$num_supprime];
 $affiche_tarif_couleur_temp = $couleur_affiche_tarif[$num_supprime];
 $date_dispo_temp = $date_couleur_disponible[$num_supprime];
 $date_synchro_temp = $date_couleur_synchro[$num_supprime];
 $cle_couleur_modif = $num_supprime;
 }


} 

//********************************************************************************
// controle mode démo ************************************************************
//********************************************************************************
  if ( ( (isset($_POST['Modifier'])) ||(isset($_POST['Effacer'])) ) && MODE_DEMO   )
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
<link href="modif_couleur.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function ValidateForm1(theForm)
{
   var regexp;
   if (theForm.nom.value == "")
   {
      alert("Vous n'avez pas renseigné l'intitulé de la couleur!");
      theForm.nom.focus();
      return false;
   }
   if (theForm.nom.value.length < 1)
   {
      alert("Vous n'avez pas renseigné l'intitulé de la couleur!");
      theForm.nom.focus();
      return false;
   }
   return true;
}
</script>
<script type="text/javascript" src="jscolor/jscolor.js"></script><script type="text/javascript" src="fonction.js"></script>
<link rel="stylesheet" href="fichier_calendrier/styles.css?version=<?php echo filemtime('fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >

</head>
<body>
<div id="space"><br></div>
<div id="container">
<table style="position:absolute;left:5px;top:7px;width:796px;height:465px;z-index:24;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Form2" style="position:absolute;left:14px;top:63px;width:752px;height:386px;z-index:25;">
<form name="Form1" method="post" action="modif_couleur.php" id="Form2" onsubmit="return ValidateForm1(this)">
<input type="hidden" name="cle_modif" value="<?php echo $cle_couleur_modif; ?>">
<div id="wb_Text1" style="position:absolute;left:187px;top:14px;width:116px;height:18px;z-index:0;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Intitulé couleur</strong></span></div>
<div id="wb_Extension2" style="position:absolute;left:307px;top:40px;width:175px;height:50px;z-index:1;">
<input type="text" id="couleur_fond" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_fond" value="<?php echo $couleur_reserve_temp; ?>" class="color {hash:true}" ></div>
<div id="wb_Text4" style="position:absolute;left:46px;top:46px;width:247px;height:16px;text-align:right;z-index:2;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur de fond </strong></span></div>
<div id="wb_Text5" style="position:absolute;left:46px;top:77px;width:247px;height:16px;text-align:right;z-index:3;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur du texte </strong></span></div>
<div id="wb_Extension1" style="position:absolute;left:306px;top:71px;width:175px;height:50px;z-index:4;">
<input type="text" id="couleur_texte" style="width:100px;font-family:Courier New;font-size:19px;" name="couleur_texte" value="<?php echo $couleur_texte_jour_reserve_temp ?>" class="color {hash:true}" ></div>
<div id="wb_Text6" style="position:absolute;left:46px;top:157px;width:250px;height:16px;text-align:right;z-index:5;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Jour cliquable sur le sélecteur de date</strong></span></div>
<input type="checkbox" id="Checkbox1" name="autor_clic" value="oui" style="position:absolute;left:306px;top:156px;z-index:6;" <?php if ( $couleur_date_clic_temp) {echo 'checked';} ?>>
<input type="text" id="nom" style="position:absolute;left:307px;top:10px;width:416px;height:20px;line-height:20px;z-index:7;" name="nom" value="<?php echo html_ent($intitule_couleur_reserve_temp); ?>" onfocus="bordure_formulaire('nom','oui');return false;" onblur="bordure_formulaire('nom','non');return false;">
<input type="checkbox" id="visibilite_couleur" name="visibilite_couleur" value="oui" style="position:absolute;left:306px;top:131px;z-index:8;" <?php if ( $couleur_invisible_temp) {echo 'checked';} ?>>
<div id="wb_Text9" style="position:absolute;left:20px;top:132px;width:276px;height:16px;text-align:right;z-index:9;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur invisible sur le calendrier visiteur</strong></span></div>
<input type="checkbox" id="Checkbox2" name="date_couleur_a_barre" value="oui" style="position:absolute;left:306px;top:180px;z-index:10;" <?php if ( $date_couleur_barre_temp) {echo 'checked';} ?>>
<div id="wb_Text11" style="position:absolute;left:11px;top:181px;width:285px;height:16px;text-align:right;z-index:11;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Barrer les jours marquées de cette couleur</strong></span></div>
<input type="submit" id="Button4" name="Modifier" value="Modifier" style="position:absolute;left:202px;top:310px;width:96px;height:25px;z-index:12;">
<input type="button" id="Button1" onclick="parent.parent.location = 'couleur.php' ;return false;" name="" value="Fermer" style="position:absolute;left:500px;top:310px;width:96px;height:25px;z-index:13;" tabindex="6">
<div id="wb_Text2" style="position:absolute;left:24px;top:104px;width:272px;height:18px;text-align:right;z-index:14;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>URL absolue image du marqueur</strong></span></div>
<input type="text" id="url" style="position:absolute;left:304px;top:99px;width:416px;height:20px;line-height:20px;z-index:15;" name="url" value="<?php echo html_ent($url_couleur_reserve_temp); ?>" onfocus="bordure_formulaire('url','oui');return false;" onblur="bordure_formulaire('url','non');return false;" 
<?php if ( $avec_diagonale_cellule) echo "readonly"; ?>>
<div id="wb_Text14" style="position:absolute;left:8px;top:265px;width:291px;height:18px;text-align:right;z-index:16;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Pour le calendrier période, afficher </strong></span></div>
<select name="affiche_tarif_couleur" size="1" id="Combobox2" style="position:absolute;left:306px;top:262px;width:374px;height:26px;z-index:17;"  >
<option <?php if ( !$affiche_tarif_couleur_temp) echo "selected"; ?> value="libellé">Afficher le libellé de la couleur</option>
<option <?php if ( $affiche_tarif_couleur_temp ) echo "selected"; ?> value="tarif">Afficher le tarif</option
>
</select>
<div id="wb_Text13" style="position:absolute;left:3px;top:205px;width:293px;height:16px;text-align:right;z-index:18;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Les dates de cette couleur sont &quot;disponibles&quot;</strong></span></div>
<input type="checkbox" id="date_dispo" name="date_dispo" value="oui" style="position:absolute;left:306px;top:204px;z-index:19;" <?php if ( $date_dispo_temp) {echo 'checked';} ?>>
<div id="wb_Extension3" style="position:absolute;left:681px;top:266px;width:21px;height:21px;z-index:20;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Paramètre unquement valable pour les calendriers période (location à la semaine), vous pouvez choisir d'afficher, dans la ligne de la semaine marquée de cette couleur, soit l'intitulé de la couleur, soit le tarif qui sera alors calulé par le tarif journalier , reporté à la semaine,de location, le tarif journalier de la location est soit le tarif par défaut indiqué pour le locgement ou un le tarif indiquée sur le calendrier administrateur lors du marquage de la semaine.</font></em></a></div>
<input type="checkbox" id="date_synchro" name="date_synchro" value="oui" style="position:absolute;left:306px;top:231px;z-index:21;" <?php if ( $date_synchro_temp) {echo 'checked';} ?>>
<div id="wb_ajout_couleurExtension1" style="position:absolute;left:326px;top:231px;width:21px;height:21px;z-index:22;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="color:#000000;font-family:MS Sans Serif;font-size:13px">Le script intégre un module de synchronisation, cochez cette case pour que les dates synchronisée depuis un autre calendrier, soit marquées de cette couleur.</font></em></a></div>
<div id="wb_ajout_couleurText1" style="position:absolute;left:3px;top:233px;width:293px;height:16px;text-align:right;z-index:23;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur par défaut synchronisation</strong></span></div>
</form>
</div>
<div id="wb_Image1" style="position:absolute;left:19px;top:11px;width:48px;height:48px;z-index:26;">
<img src="images/modif_couleur.png" id="Image1" alt=""></div>
<div id="Html1" style="position:absolute;left:82px;top:14px;width:120px;height:23px;z-index:27">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<div id="wb_Extension4" style="position:absolute;left:340px;top:268px;width:21px;height:21px;z-index:28;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Le script intégre un module de recherche de disponibilité à placer &quot;coté visiteur&quot; , ce module va chercher parmi toutes les locations lesquelles sont disponible pour une période données.<br>
Si vous indiquez que cette couleur est disponible, alors les dates marquées de cette  couleur sont considérées comme disponible.<br>
Plus d'info voir La FAQ</font></em></a></div>
<div id="wb_Extension5" style="position:absolute;left:340px;top:242px;width:21px;height:21px;z-index:29;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Si cette option est cochée, alors toutes les numéros des jours marqués de cette couleur seront barrées.</font></em></a></div>
<div id="wb_Extension6" style="position:absolute;left:340px;top:217px;width:21px;height:21px;z-index:30;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Le script intégre un sélecteur de date ( date-picker ) qui vous permet de remplir un champs formulaire sur les pages visiteurs avec la date cliquée.<br>
Ce sélecteur de date s'affiche en fonction d'une location, c'est à dire qu'il reprend les marqueurs des calendriers visiteurs, vous pouvez donc déterminier si cette couleur peut être cliquable ou non sur le selecteur de date.<br>
Un exemple d'utilisation du sélecteur de date est fourni par le script formulaire-selection-date.html.<br>
Plus d'info voir La FAQ</font></em></a></div>
<div id="wb_Extension8" style="position:absolute;left:339px;top:193px;width:21px;height:21px;z-index:31;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Vous pouvez déterminer si cette couleur doit être &quot;invisible&quot; sur le calendrier visiteur.<br>
Toutes les dates marquées de cette couleur ne seront visible que sur le calendrier administrateur, vous pouvez utiliser cette couleur pour marquer les dates en attente de réservation par exemple.<br>
Pour les couleurs invisibles, et unqiuement pour les couleurs invisibles, il est donc possible d'avoir 2 marqueurs de couleurs différentes pour une même date, dans ce cas le marqueur &quot;non invisible&quot; sera visible sur le calendrier visiteur, et la marqueur &quot; couleur invisible&quot; sera visible sur le calendrier administrateur.</font></em></a></div>
<div id="wb_Extension7" style="position:absolute;left:742px;top:164px;width:21px;height:21px;z-index:32;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Vous avez la possibilité de choisir une image de fond plutot qu'une couleur de fond, les jours marqués de ce marqueur auront cette image de fond.<br>
</font><font style="font-size:13px" color="#FF6820" face="MS Sans Serif"><b>Attention</b></font><font style="font-size:13px" color="#000000" face="MS Sans Serif">: indiquez l' adresse absolue de l'image, c'est à dire du type http://www.images/mon_image.jpg ou /images/mon_image.jpg<br>
</font><font style="font-size:13px" color="#000000" face="MS Sans Serif">Si vous avez activé l'option &quot;Activer les diagonales dans les cellules qui sont marquées&quot; dans les paramètres du calendrier, vous ne pouvez plus indiquer d'image de fond pour les couleurs, car les marqueurs jours en diagonales sont déjà des images .</font></em></a></div>
<div id="wb_Extension10" style="position:absolute;left:428px;top:134px;width:21px;height:21px;z-index:33;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Choisissez la couleur du texte du marqueur, pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs, cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension11" style="position:absolute;left:427px;top:105px;width:21px;height:21px;z-index:34;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Choisissez la couleur de fond du marqueur, pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs, cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension9" style="position:absolute;left:742px;top:75px;width:21px;height:21px;z-index:35;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">L'intitulé de la couleur vous permet de différencier les différentes couleurs, vous pouvez créer autant de marqueurs que vous désirez.<br>
Vous pouvez donner le nom que vous désirez (par ex: Réservé, basse saison, promotion, etc ...)<br>
Pour le calendrier période ( location à la semaine uniquement), l'intitulé de la couleur peut également, par paramètrage, être affiché dans la ligne de la semaine.</font></em></a></div>
</div>
</body>
</html>