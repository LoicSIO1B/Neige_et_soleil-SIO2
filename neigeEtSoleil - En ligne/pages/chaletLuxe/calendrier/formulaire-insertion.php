<?php
$affiche_info = '';

//inclusion du fichier avec les fonctions ******************
include ("admin/fonction.php");

//inclusion du fichier avec les fonctions ******************
include ("admin/fichier_calendrier/calendrier_liste_logement.php");

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Reservation Luxueuse</title>
<meta name="description" content="Module insertion date formulaire depuis le formulaire visiteur, avec possibilité d'ajout du locataire dans la base.">
<meta name="generator" content="http://www.MesGarants.com">
<link rel="shortcut icon" href="icone_cal.ico">
<style type="text/css">
div#container
{
   width: 902px;
   position: relative;
   margin-top: 0px;
   margin-left: auto;
   margin-right: auto;
   text-align: left;
}
</style>
<style type="text/css">
body
{
   text-align: center;
   margin: 0;
   background-color: #DED7B5;
   color: #000000;
}
</style>
<style type="text/css">
a
{
   color: #DBE4EE;
}
a:hover
{
   color: #0000FF;
}
a.style3:link
{
   color: #FFFFFF;
   background: #00C4FD;
}
a.style3:visited
{
   color: #FFFFFF;
   background: #00C4FD;
   text-decoration: underline;
}
a.style3:active
{
   color: #FFFFFF;
   background: #00C4FD;
   text-decoration: underline;
}
a.style3:hover
{
   color: #00C4FD;
   background: #FFFFFF;
   text-decoration: underline;
}
</style>
<script type="text/javascript">
<!--
function popupwnd(url, toolbar, menubar, locationbar, resize, scrollbars, statusbar, left, top, width, height)
{
   if (left == -1)
   {
      left = (screen.width/2)-(width/2);
   }
   if (top == -1)
   {
      top = (screen.height/2)-(height/2);
   }
   var popupwindow = this.open(url, '', 'toolbar=' + toolbar + ',menubar=' + menubar + ',location=' + locationbar + ',scrollbars=' + scrollbars + ',resizable=' + resize + ',status=' + statusbar + ',left=' + left + ',top=' + top + ',width=' + width + ',height=' + height);
}
//-->
</script>
<!--[if lt IE 7]>
<style type="text/css">
   img { behavior: url("pngfix.htc"); }
</style>
<![endif]-->
<script type="text/javascript" src="admin/fonction.js"></script>
</head>
<body>
<div id="container">
<table style="position:absolute;left:4px;top:10px;width:894px;height:1012px;z-index:14;border:1px #C0C0C0 outset;background-color:#FFFFFF;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td align="left" valign="top" bgcolor="#FBFBFB" style="border:1px #C0C0C0 solid;height:996px;">
<?php



?></td>
</tr>
</table>
<div id="wb_MasterPage3" style="margin:0;padding:0;position:absolute;left:2px;top:0px;width:964px;height:110px;text-align:left;z-index:15;">
</div>
<div id="wb_Text2" style="margin:0;padding:0;position:absolute;left:18px;top:29px;width:860px;height:380px;text-align:left;z-index:16;">
<br>
<br>
</b></font><font style="font-size:19px; margin-left: 37%;" color="#0080FF" face="Verdana"><b>Reservation</b></font></div>
<div id="wb_Form1" style="position:absolute;background-color:#59ACFF;left:93px;top:100px;width:646px;height:314px;z-index:17">
<form name="Form1" method="post" action="formulaire-insertion.php" id="Form1">
<div id="wb_Text1" style="margin:0;padding:0;position:absolute;left:109px;top:21px;width:115px;height:18px;text-align:right;z-index:0;">
<font style="font-size:16px" color="#000000" face="Verdana"><b>Date debut</b></font></div>
<input type="text" id="date_debut" style="position:absolute;left:232px;top:18px;width:155px;height:18px;border:1px #C0C0C0 solid;font-family:Courier New;font-size:13px;z-index:1" name="date_debut" value="" onfocus="bordure_formulaire('date_debut','oui');return false;" onblur="bordure_formulaire('date_debut','non');return false;">
<div id="wb_Image1" style="margin:0;padding:0;position:absolute;left:391px;top:6px;width:43px;height:43px;text-align:left;z-index:2;">
<a href="javascript:popupwnd('date-picker.php?idcible=date_debut&logement=0','no','no','no','yes','yes','no','50','50','750','650')" target="_self"><img src="images/img0046.png" id="Image1" alt="Choisir une date" border="0" title="Choisir une date" style="width:43px;height:43px;"></a></div>
<div id="wb_Text4" style="margin:0;padding:0;position:absolute;left:109px;top:60px;width:115px;height:18px;text-align:right;z-index:3;">
<font style="font-size:16px" color="#000000" face="Verdana"><b>Date fin</b></font></div>
<input type="text" id="date_fin" style="position:absolute;left:232px;top:57px;width:155px;height:18px;border:1px #C0C0C0 solid;font-family:Courier New;font-size:13px;z-index:4" name="date_fin" value="" onfocus="bordure_formulaire('date_fin','oui');return false;" onblur="bordure_formulaire('date_fin','non');return false;">
<div id="wb_Image2" style="margin:0;padding:0;position:absolute;left:391px;top:45px;width:43px;height:43px;text-align:left;z-index:5;">
<a href="javascript:popupwnd('date-picker.php?idcible=date_fin&logement=0','no','no','no','yes','yes','no','50','50','750','600')" target="_self"><img src="images/img0047.png" id="Image2" alt="Choisir une date" border="0" title="Choisir une date" style="width:43px;height:43px;"></a></div>
<input type="submit" id="Button1" name="Envoyer" value="Envoyer" style="position:absolute;left:231px;top:283px;width:96px;height:25px;background-color:#525252;color:#FFFFFF;font-family:Arial;font-size:13px;z-index:6">
<div id="Html2" style="position:absolute;left:132px;top:99px;width:469px;height:30px;z-index:7">
<font style="font-size:16px" color="#000000" face="Verdana"><b>Locations</b></font>&nbsp;&nbsp;&nbsp;&nbsp;

<?php
//affiche du sélecteur de locations ****************************************************
liste_box ("logement",220,$nom_logement,"",true,"",false,"");
?></div>
<div id="wb_Text3" style="margin:0;padding:0;position:absolute;left:48px;top:148px;width:174px;height:18px;text-align:right;z-index:8;">
<font style="font-size:16px" color="#000000" face="Verdana"><b>Nom locataire</b></font></div>
<input type="text" id="nom" style="position:absolute;left:232px;top:145px;width:155px;height:18px;border:1px #C0C0C0 solid;font-family:Courier New;font-size:13px;z-index:9" name="nom" value="" onfocus="bordure_formulaire('nom','oui');return false;" onblur="bordure_formulaire('nom','non');return false;">
<div id="wb_Text5" style="margin:0;padding:0;position:absolute;left:55px;top:180px;width:168px;height:18px;text-align:right;z-index:10;">
<font style="font-size:16px" color="#000000" face="Verdana"><b>Prenom locataire</b></font></div>
<input type="text" id="prenom" style="position:absolute;left:232px;top:177px;width:155px;height:18px;border:1px #C0C0C0 solid;font-family:Courier New;font-size:13px;z-index:11" name="prenom" value="" onfocus="bordure_formulaire('prenom','oui');return false;" onblur="bordure_formulaire('prenom','non');return false;">
<textarea name="commentaire" id="commentaire" style="position:absolute;left:232px;top:213px;width:322px;height:55px;border:1px #C0C0C0 solid;font-family:Courier New;font-size:13px;z-index:12" rows="2" cols="36" onfocus="bordure_formulaire('commentaire','oui');return false;" onblur="bordure_formulaire('commentaire','non');return false;"></textarea>
<div id="wb_Text6" style="margin:0;padding:0;position:absolute;left:53px;top:217px;width:168px;height:36px;text-align:right;z-index:13;">
<font style="font-size:16px" color="#000000" face="Verdana"><b>Commentaire dans l'infobulle</b></font></div>
</form>
</div>
<!-- module insertion date locataire -->
<div id="Html1" style="position:absolute;left:19px;top:500px;width:638px;height:177px;z-index:18">
<?php
//**********************************************************
// exemple d'un formulaire coté visiteur qui va insérer les 
// dates dans le calendrier
// La fonction permet :
// ** de marquer les dates indiquées avec la couleur 
//    paramétrée par la variable $id_couleur_insertion
// ** ajouter automatiquement les informations du locataire
//    venant du formulaire si le locataire n'existe pas 
//    encore dans la liste des locataires
//    le controle se fait sur le nom et prenom uniquement
//
// Attention : *********************************************
// a insérer sur une page php unqiuement !
// le fichier fonction et calendrier_liste_logement doivent
// être inclus avant l'appel de la fonction !
//**********************************************************


//********************************************************************************
// marquage de plusieurs jours****************************************************
//********************************************************************************
  if ( (isset($_POST['Envoyer']) && $_POST['Envoyer'] == 'Envoyer')  ) {

   //champs a renseigner pour le locataire laisser vide si non renseigné
   $tableau_locataire[0] = $_POST['nom'] ;          // nom de famille du locataire
   $tableau_locataire[1] = $_POST['prenom'] ;       // prénom du locataire
   $tableau_locataire[2] = '' ;                     // téléphone locataire
   $tableau_locataire[3] = '' ;                     // email locataire
   $tableau_locataire[4] = '' ;                     // adresse locataire
   $tableau_locataire[5] = '' ;                     // code postal locataire
   $tableau_locataire[6] = '' ;                     // commune locataire
   $tableau_locataire[7] = '' ;                     // pays locataire
   $tableau_locataire[8] = $_POST['commentaire'] ;  // infobulle dates,
   $tableau_locataire[9] = false ;                  // inscription mailing liste locataire

   // important !!  à renseigner ci dessous !! ****************
   //initialisation de variable *******************************
   $id_couleur_insertion = 1;

   // $chemin_admin     : chemin relatif depuis l'endroit d'appel de la fonction jusqu'au répertoire admin du calendrier
   // $id_logement_marquer: numéro id de la location a marquer
   // $date_debut       : date de debut  format JJ/MM/AAAA
   // $date_fin         : date de fin  format JJ/MM/AAAA
   // $tableau_locataire: nom du tableau locataire contenant les informations du nouveau locataires
   // ajout_locataire   : si le locataire n'existe pas , il sera rajouté
   // couleur           : numéro id de la couleur du marqueur pour la période a marquer
   // nb_max_jour       : nombre maximum de jours successifs pouvant être marqués
   // ctrl_date_existe  : si true alors, si dans l'intervalle date debut/date fin , il y a au moins une date de couleur dites
   //                     non disponible alors les dates indiquées ne sont pas enregistrées dans le calendrier
   // $affiche_erreurs  : affiche les erreurs eventuelles ( format date, date fin anterieur date debut)
   // La fonction retourne TRUE si les dates ont étaient marquées

   $execution = insertion_date("admin/",$_POST['logement'],$_POST['date_debut'],$_POST['date_fin'],$tableau_locataire,true,$id_couleur_insertion,15,true,true) ;

   if ( $execution )
     echo '<font style="font-size:16px" color="#000000" face="Verdana"><b>Les dates ont etaient ajoutees</b></font><br><br> ';
   else
     echo '<font style="font-size:16px" color="#000000" face="Verdana"><b> Les dates n\'ont pas etaient ajoutees</b></font><br><br>';

 }

//****************************************************************************
// fin du module de recherche de disponibilites ******************************
//****************************************************************************
?></div>
<div id="wb_Text8" style="margin:0;padding:0;position:absolute;left:18px;top:450px;width:235px;height:23px;text-align:left;z-index:19;">
<font style="font-size:19px" color="#0080FF" face="Verdana"><b>Resultat</b></font></div>

<div id="Html4" style="position:absolute;left:172px;top:1px;width:274px;height:10px;z-index:21">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
</div>
</body>
</html>