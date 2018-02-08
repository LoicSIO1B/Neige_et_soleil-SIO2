<?php
header( 'content-type: text/html; charset=ISO-8859-1' );

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Exemple module de recherche de disponibilités</title>
<meta name="description" content="Exemple module de recherche des disponibilités pour calendrier des réservations php avec couleur différentes">
<meta name="generator" content="http://www.mathieuweb.fr/calendrier/">
<link href="icone_cal.ico" rel="shortcut icon" type="image/x-icon">
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="formulaire-disponibilite.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="wwb10.min.js"></script>
<script type="text/javascript" src="admin/fonction.js"></script>
</head>
<body>
<div id="container">
<table style="position:absolute;left:4px;top:10px;width:894px;height:1012px;z-index:10;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><?php



?><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_MasterPage3" style="position:absolute;left:2px;top:0px;width:964px;height:110px;z-index:11;">
</div>
<div id="wb_Text2" style="position:absolute;left:18px;top:29px;width:856px;height:416px;z-index:12;text-align:left;">
<span style="color:#0080FF;font-family:Verdana;font-size:19px;"><strong>Cette page est un exemple d'utilisation du module de recherche de disponibilité</strong></span><span style="color:#000000;font-family:Verdana;font-size:19px;"><strong><br><br></strong></span><span style="color:#000000;font-family:Verdana;font-size:16px;"><strong><u>Principe :</u> <br><br>Le module après soumission du formulaire va chercher toutes les locations existantes qui sont disponibles dans l'intervalle date début et date fin et dont la capacité est soit ignoré (valeur 0) soit supérieur ou égale à celle renseigné dans le formulaire.<br><br>Les options des marqueurs de couleur permettent de définir si les des jours déjà marqués du calendrier, doivent être considérés comme disponible ou pas.<br><br>Le module retourne un tableau php $tableau_logement_dispo qui contient la liste des locations disponibles dans l'intervale de recherche .Le tableau contient l'id de la location et le nom de la location<br><br>Le tableau des locations disponibles peut alors être exploitées comme vous le désirez, pour afficher une liste avec un lien, etc...<br><br>Des options permettent de paramètrer le module.<br><br></strong></span><span style="color:#0080FF;font-family:Verdana;font-size:19px;"><strong>Démonstration</strong></span></div>
<div id="wb_Text3" style="position:absolute;left:517px;top:426px;width:366px;height:18px;z-index:13;text-align:left;">
<span style="color:#000000;font-family:Verdana;font-size:16px;"><strong>Plus d'informations, <a href="http://www.mathieuweb.fr/calendrier/calendrier.php" target="_blank" class="style3">page documentation </a></strong></span></div>
<div id="wb_Form1" style="position:absolute;left:98px;top:461px;width:646px;height:164px;z-index:14;">
<form name="Form1" method="post" action="formulaire-disponibilite.php" id="Form1">
<div id="wb_Text1" style="position:absolute;left:109px;top:21px;width:115px;height:18px;text-align:right;z-index:0;">
<span style="color:#000000;font-family:Verdana;font-size:16px;"><strong>Date début</strong></span></div>
<input type="text" id="date_debut" style="position:absolute;left:232px;top:18px;width:155px;height:18px;line-height:18px;z-index:1;" name="date_debut" value="" onfocus="bordure_formulaire('date_debut','oui');return false;" onblur="bordure_formulaire('date_debut','non');return false;">
<div id="wb_Image1" style="position:absolute;left:391px;top:6px;width:43px;height:43px;z-index:2;">
<a href="javascript:popupwnd('date-picker.php?idcible=date_debut&logement=0','no','no','no','yes','yes','no','50','50','750','650')" target="_self"><img src="images/img0044.png" id="Image1" alt="Choisir une date" title="Choisir une date"></a></div>
<div id="wb_Text4" style="position:absolute;left:109px;top:60px;width:115px;height:18px;text-align:right;z-index:3;">
<span style="color:#000000;font-family:Verdana;font-size:16px;"><strong>Date fin</strong></span></div>
<input type="text" id="date_fin" style="position:absolute;left:232px;top:57px;width:155px;height:18px;line-height:18px;z-index:4;" name="date_fin" value="" onfocus="bordure_formulaire('date_fin','oui');return false;" onblur="bordure_formulaire('date_fin','non');return false;">
<div id="wb_Image2" style="position:absolute;left:391px;top:45px;width:43px;height:43px;z-index:5;">
<a href="javascript:popupwnd('date-picker.php?idcible=date_fin&logement=0','no','no','no','yes','yes','no','50','50','750','600')" target="_self"><img src="images/img0045.png" id="Image2" alt="Choisir une date" title="Choisir une date"></a></div>
<div id="wb_Text5" style="position:absolute;left:78px;top:97px;width:144px;height:18px;text-align:right;z-index:6;">
<span style="color:#000000;font-family:Verdana;font-size:16px;"><strong>Capacité (mini)</strong></span></div>
<input type="text" id="capacite" style="position:absolute;left:232px;top:94px;width:155px;height:18px;line-height:18px;z-index:7;" name="capacite" value="" onfocus="bordure_formulaire('capacite','oui');return false;" onblur="bordure_formulaire('capacite','non');return false;">
<div id="wb_Text6" style="position:absolute;left:396px;top:97px;width:144px;height:16px;z-index:8;text-align:left;">
<span style="color:#000000;font-family:Verdana;font-size:13px;"><strong>Personnes</strong></span></div>
<input type="submit" id="Button1" name="Chercher" value="Chercher" style="position:absolute;left:231px;top:128px;width:96px;height:25px;z-index:9;">
</form>
</div>
<div id="wb_Text7" style="position:absolute;left:29px;top:637px;width:397px;height:23px;z-index:15;text-align:left;">
<span style="color:#0080FF;font-family:Verdana;font-size:19px;"><strong>Résultat disponibilité</strong></span></div>
<!-- module recherche dispo -->
<div id="Html1" style="position:absolute;left:49px;top:676px;width:638px;height:177px;z-index:16">
<?php
//**********************************************************
// gestion recherche des locations disponibles 
// a placer de préférence en debut de page 
// les locations disponibles sont inscrites
// dans le tableau php $tableau_logement_dispo
//
// Attention :
// a insérer sur une page php unqiuement !
// le fichier fonction doit être inclus avant l'appel 
// de la fonction !
//**********************************************************

//inclusion du fichier avec les fonctions ******************
  include ("admin/fonction.php");

//**********************************************************
// traitement recherche de disponibilité *******************
//**********************************************************

if ( isset($_POST['Chercher']) && $_POST['Chercher'] == "Chercher" ) {


   // module recherche de disponibilités par mi toutes les locations entre 2 dates choisies
   // la fonction retourne un tableau avec la liste des locations disponibles
   // parametres :
   // $chemin_admin     : chemin relatif depuis l'endroit d'appel de la fonction jusqu'au répertoire admin du calendrier
   // $date_debut       : date de debut de recherche format JJ/MM/AAAA
   // $date_fin         : date de fin de recherche format JJ/MM/AAAA
   // $capacite         : capacité minimale de la location en nombre de personnes
   //                     si = 0 alors ne tient pas compte de la capacité
   // $affiche_erreurs  : affiche les erreurs eventuelles ( format date, date fin anterieur date debut)
   // tableau retourn fonction : liste id des locations disponibles pour la période
   // + $tarif_logement_periode[$id_location] = tableau contenant le térif par location disponibles pour la période
   //**************************************************************************************************

   $tableau_logement_dispo = recherche_dispo("admin/",$_POST['date_debut'],$_POST['date_fin'],$_POST['capacite'],true );

} // fin POST ***

//****************************************************************************
// fin du module de recherche de disponibilites ******************************
//****************************************************************************

//

//****************************************************************************
// affichage des disponibilites **********************************************
//****************************************************************************

if ( isset ($tableau_logement_dispo) ) {
echo '<font style="font-size:16px" color="#000000" face="Verdana"><b><u>Locations disponibles :</u></font><br><br>';
   foreach ($tableau_logement_dispo as $cle => $nom_logement ) {
          echo   '<font style="font-size:16px" color="#000000" face="Verdana"><b><u>Nom :</u> ',$nom_logement,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>Id :</u> ',$cle,'<u>Tarif nuitées:</u> ', $tarif_logement_periode_nuitee[$cle],'<u>Tarif journées:</u> ', $tarif_logement_periode_journee[$cle],'<br></b></font>';

   }
}

?></div>
</div>
</body>
</html>