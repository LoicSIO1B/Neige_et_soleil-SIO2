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
 $affiche_info = '';

// test si demande ajout d'un locataire*****************************************************************************
if ( isset($_POST['Ajouter']) && ($_POST['Ajouter']) == 'Ajouter' && !(empty($_POST['nom']))  && !MODE_DEMO ) {

  //initialisation des variables*************************
  $num_pointeur_max = 0;
  $nom_couleur_temp = '';
  $nb_result = 0;
  extract($_POST);

  //recherche du numéro d'index le plus élevé************
  if ( isset($couleur_reserve))
     $nb_result = count ($couleur_reserve);  
  if ( $nb_result > 0 ) {
  foreach ($couleur_reserve as $cle => $nom_couleur_reserve )  {
      if ( $cle > $num_pointeur_max)
           $num_pointeur_max = $cle ;
      }
  }

  //contrôle si couleur par defaut ical existe déjà ou pas
  $couleur_defaut_existe = false;
  if ( isset($date_couleur_synchro) && is_array($date_couleur_synchro) ) {
    foreach ( $date_couleur_synchro as $id_couleur => $etat_couleur ) {
      if ( $etat_couleur) $couleur_defaut_existe = true ;
       }
   }

  $num_pointeur_max++;
  $intitule_couleur_reserve[$num_pointeur_max] = guillet_var ($nom) ; 
  $couleur_reserve[$num_pointeur_max] = $couleur_fond ; 
  $couleur_texte_jour_reserve[$num_pointeur_max] = $couleur_texte ;
  if ( $affiche_tarif_couleur == 'tarif' )
      $couleur_affiche_tarif[$num_pointeur_max] = true ;
  else
      $couleur_affiche_tarif[$num_pointeur_max] = false ;
  $url_couleur_reserve[$num_pointeur_max] = guillet_var ($url) ; 
  if ( isset($autor_clic) &&  $autor_clic  == "oui" ) 
      $couleur_date_clic[$num_pointeur_max] = true;
  else
      $couleur_date_clic[$num_pointeur_max] = false;
  if ( isset($visibilite_couleur) &&  $visibilite_couleur  == "oui" ) 
      $couleur_invisible[$num_pointeur_max] = true;
  else
      $couleur_invisible[$num_pointeur_max] = false;
  if ( isset($date_couleur_a_barre) &&  $date_couleur_a_barre  == "oui" ) 
      $date_couleur_barre[$num_pointeur_max] = true;
  else
      $date_couleur_barre[$num_pointeur_max] = false;
  if ( isset($date_dispo) &&  $date_dispo  == "oui" ) 
      $date_couleur_disponible[$num_pointeur_max] = true;
  else
      $date_couleur_disponible[$num_pointeur_max] = false;
  if ( isset($date_synchro) &&  $date_synchro  == "oui" ) 
      $date_couleur_synchro[$num_pointeur_max] = true;
  else
      $date_couleur_synchro[$num_pointeur_max] = false;

  //chemin vers le fichier de création liste des locataires/logements**********************************************************
  if ( !$couleur_defaut_existe || !$date_couleur_synchro[$num_pointeur_max] )
     include("genere/genere_listes_couleur.php");
  else {
   $creation_reussi = false;
   $affiche_info = "erreur_couleur_defaut_existe"; 
   }

if ( isset($creation_reussi) && $creation_reussi )
    $affiche_info = "ajout_ok" ;
else if ( !isset($affiche_info) || $affiche_info == '' )
   $affiche_info = "erreur_execution"; 

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
<link href="ajout_couleur.css" rel="stylesheet" type="text/css">
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
<table style="position:absolute;left:5px;top:7px;width:796px;height:439px;z-index:30;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Form2" style="position:absolute;left:14px;top:63px;width:752px;height:371px;z-index:31;">
<form name="Form1" method="post" action="ajout_couleur.php" id="Form2" onsubmit="return ValidateForm1(this)">
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
<input type="text" id="nom" style="position:absolute;left:307px;top:10px;width:416px;height:20px;line-height:20px;z-index:7;" name="nom" value="<?php echo htmlentities($intitule_couleur_reserve_temp); ?>" onfocus="bordure_formulaire('nom','oui');return false;" onblur="bordure_formulaire('nom','non');return false;">
<input type="checkbox" id="visibilite_couleur" name="visibilite_couleur" value="oui" style="position:absolute;left:306px;top:131px;z-index:8;" <?php if ( $couleur_invisible_temp) {echo 'checked';} ?>>
<div id="wb_Text9" style="position:absolute;left:20px;top:132px;width:276px;height:16px;text-align:right;z-index:9;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur invisible sur le calendrier visiteur</strong></span></div>
<input type="checkbox" id="Checkbox2" name="date_couleur_a_barre" value="oui" style="position:absolute;left:306px;top:180px;z-index:10;" <?php if ( $date_couleur_barre_temp) {echo 'checked';} ?>>
<div id="wb_Text11" style="position:absolute;left:11px;top:181px;width:285px;height:16px;text-align:right;z-index:11;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Barrer les jours marquées de cette couleur</strong></span></div>
<input type="submit" id="Button4" name="Ajouter" value="Ajouter" style="position:absolute;left:202px;top:300px;width:96px;height:25px;z-index:12;">
<input type="button" id="Button1" onclick="parent.parent.location = 'couleur.php' ;return false;" name="Fermer" value="Fermer" style="position:absolute;left:500px;top:300px;width:96px;height:25px;z-index:13;" tabindex="6">
<div id="wb_Text2" style="position:absolute;left:24px;top:104px;width:272px;height:18px;text-align:right;z-index:14;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>URL <u>absolue</u> image du marqueur</strong></span></div>
<input type="text" id="url" style="position:absolute;left:306px;top:99px;width:416px;height:20px;line-height:20px;z-index:15;" name="url" value="<?php echo htmlentities($url_couleur_reserve_temp); ?>" onfocus="bordure_formulaire('url','oui');return false;" onblur="bordure_formulaire('url','non');return false;"
<?php if ( $avec_diagonale_cellule) echo "readonly"; ?>>
<select name="affiche_tarif_couleur" size="1" id="Combobox1" style="position:absolute;left:305px;top:263px;width:374px;height:26px;z-index:16;"  >
<option value="libellé">Afficher le libellé de la couleur</option>
<option value="tarif">Afficher le tarif</option
>
</select>
<div id="wb_Text13" style="position:absolute;left:7px;top:266px;width:291px;height:18px;text-align:right;z-index:17;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Pour le calendrier période, afficher </strong></span></div>
<div id="wb_Text14" style="position:absolute;left:3px;top:207px;width:293px;height:16px;text-align:right;z-index:18;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Les dates de cette couleur sont &quot;disponibles&quot;</strong></span></div>
<input type="checkbox" id="date_dispo" name="date_dispo" value="oui" style="position:absolute;left:306px;top:206px;z-index:19;" <?php if ( $date_couleur_barre_temp) {echo 'checked';} ?>>
<div id="wb_Extension10" style="position:absolute;left:326px;top:205px;width:21px;height:21px;z-index:20;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Le script intégre un module de recherche de disponibilité à placer &quot;coté visiteur&quot; , ce module va chercher parmi toutes les locations lesquelles sont disponible pour une période données.<br>
Si vous indiquez que cette couleur est disponible, alors les dates marquées de cette  couleur sont considérées comme disponible.<br>
Plus d'info voir La FAQ</font></em></a></div>
<div id="wb_Extension9" style="position:absolute;left:326px;top:179px;width:21px;height:21px;z-index:21;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Si cette option est cochée, alors toutes les numéros des jours marqués de cette couleur seront barrées.</font></em></a></div>
<div id="wb_Extension8" style="position:absolute;left:326px;top:154px;width:21px;height:21px;z-index:22;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Le script intégre un sélecteur de date ( date-picker ) qui vous permet de remplir un champs formulaire sur les pages visiteurs avec la date cliquée.<br>
Ce sélecteur de date s'affiche en fonction d'une location, c'est à dire qu'il reprend les marqueurs des calendriers visiteurs, vous pouvez donc déterminier si cette couleur peut être cliquable ou non sur le selecteur de date.<br>
Un exemple d'utilisation du sélecteur de date est fourni par le script formulaire-selection-date.html.<br>
Plus d'info voir La FAQ</font></em></a></div>
<div id="wb_Extension7" style="position:absolute;left:325px;top:130px;width:21px;height:21px;z-index:23;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Vous pouvez déterminer si cette couleur doit être &quot;invisible&quot; sur le calendrier visiteur.<br>
Toutes les dates marquées de cette couleur ne seront visible que sur le calendrier administrateur, vous pouvez utiliser cette couleur pour marquer les dates en attente de réservation par exemple.<br>
Pour les couleurs invisibles, et unqiuement pour les couleurs invisibles, il est donc possible d'avoir 2 marqueurs de couleurs différentes pour une même date, dans ce cas le marqueur &quot;non invisible&quot; sera visible sur le calendrier visiteur, et la marqueur &quot; couleur invisible&quot; sera visible sur le calendrier administrateur.</font></em></a></div>
<div id="wb_Extension5" style="position:absolute;left:414px;top:71px;width:21px;height:21px;z-index:24;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Choisissez la couleur du texte du marqueur, pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs, cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension6" style="position:absolute;left:728px;top:101px;width:21px;height:21px;z-index:25;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Vous avez la possibilité de choisir une image de fond plutot qu'une couleur de fond, les jours marqués de ce marqueur auront cette image de fond.<br>
</font><font style="font-size:13px" color="#FF6820" face="MS Sans Serif"><b>Attention</b></font><font style="font-size:13px" color="#000000" face="MS Sans Serif">: indiquez l' adresse absolue de l'image, c'est à dire du type http://www.images/mon_image.jpg ou /images/mon_image.jpg<br>
Si vous avez activé l'option &quot;Activer les diagonales dans les cellules qui sont marquées&quot; dans les paramètres du calendrier, vous ne pouvez plus indiquer d'image de fond pour les couleurs, car les marqueurs jours en diagonales sont déjà des images .</font></em></a></div>
<div id="wb_Extension11" style="position:absolute;left:681px;top:264px;width:21px;height:21px;z-index:26;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Paramètre unquement valable pour les calendriers période (location à la semaine), vous pouvez choisir d'afficher, dans la ligne de la semaine marquée de cette couleur, soit l'intitulé de la couleur, soit le tarif qui sera alors calulé par le tarif journalier , reporté à la semaine,de location, le tarif journalier de la location est soit le tarif par défaut indiqué pour le locgement ou un le tarif indiquée sur le calendrier administrateur lors du marquage de la semaine.</font></em></a></div>
<div id="wb_ajout_couleurText1" style="position:absolute;left:3px;top:235px;width:293px;height:16px;text-align:right;z-index:27;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Couleur par défaut synchronisation</strong></span></div>
<input type="checkbox" id="date_synchro" name="date_synchro" value="oui" style="position:absolute;left:306px;top:233px;z-index:28;" <?php if ( $date_synchro_temp) {echo 'checked';} ?>>
<div id="wb_ajout_couleurExtension1" style="position:absolute;left:326px;top:233px;width:21px;height:21px;z-index:29;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="color:#000000;font-family:MS Sans Serif;font-size:13px">Le script intégre un module de synchronisation, cochez cette case pour que les dates synchronisée depuis un autre calendrier, soit marquées de cette couleur.</font></em></a></div>
</form>
</div>
<div id="wb_Image1" style="position:absolute;left:18px;top:11px;width:48px;height:48px;z-index:32;">
<img src="images/ajout_couleur.png" id="Image1" alt=""></div>
<div id="Html1" style="position:absolute;left:84px;top:14px;width:120px;height:23px;z-index:33">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<div id="wb_Extension3" style="position:absolute;left:427px;top:105px;width:21px;height:21px;z-index:34;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Choisissez la couleur de fond du marqueur, pour sélectionner une couleur, cliquez directement dans le champs un sélecteur de couleur s'ouvre en dessous du champs, cliquez sur la couleur qui vous interresse, ou maintenez le clique gauche de la souris enfoncé pour modifier le gradient de la couleur dans la colonne de droite.</font></em></a></div>
<div id="wb_Extension12" style="position:absolute;left:742px;top:75px;width:21px;height:21px;z-index:35;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">L'intitulé de la couleur vous permet de différencier les différentes couleurs, vous pouvez créer autant de marqueurs que vous désirez.<br>
Vous pouvez donner le nom que vous désirez (par ex: Réservé, basse saison, promotion, etc ...)<br>
Pour le calendrier période ( location à la semaine uniquement), l'intitulé de la couleur peut également, par paramètrage, être affiché dans la ligne de la semaine.</font></em></a></div>
</div>
</body>
</html>