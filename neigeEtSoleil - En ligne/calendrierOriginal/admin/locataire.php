<?php
session_start();

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_connexion.php");

     require("fichier_calendrier/liste_pays.php");

$nom_locataire_temp = '';
$nom_prenom_temp = '';
$nom_telephone_temp = '';
$nom_email_temp = '';
$nom_commentaire_temp = '';
$cle_nom_locataire_modif = '';
$affiche_info = '';
$fichier_libre = false;

//**************************************************************************************************
//controle des fichiers 
//**************************************************************************************************
if (!isset($fin_tableau_locataire))
    $affiche_info = 'erreur_fichier_locataire';

$fin_tableau_locataire = false;

// test si demande effacement d'un locataire*****************************************************************************
if ( isset($_GET['fct']) && !is_numeric($_GET['fct']) &&  !(empty($_GET['fct'])) &&  isset($_GET['num']) && is_numeric($_GET['num'])  ) {

  $num_supprime = $_GET['num'] ;
  $fonction = $_GET['fct'] ;

//fonction supprimer **************************

if ( isset($fonction) && $fonction == 'supprimer'  && !MODE_DEMO ) {

  $chemin_fichier = "fichier_calendrier/calendrier_liste_locataire.php";
  $chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_calendrier_liste_locataire.php";

  while (!isset($fin_tableau_locataire)  || !$fin_tableau_locataire) {
  include ($chemin_fichier);
  if ( isset($fin_tableau_locataire)  && $fin_tableau_locataire ) {
     //sauvegarde ancien fichier*********************************
     @copy($chemin_fichier,$chemin_fichier_sauvegarde);
     $file= @fopen($chemin_fichier, "w");
     $fichier_libre = true;
     }

  }

if ( $fichier_libre )
  //chemin vers le fichier de création liste des locataires/logements**********************************************************
  require("genere/genere_listes_locataire.php");

  if ( isset($etat_req) && $etat_req && isset($creation_reussi) && $creation_reussi)
     $affiche_info = 'modif_ok';
  else
     $affiche_info = 'erreur_execution';

  //chemin vers le fichier de liste des locataires/logements**********************************************************
  include("fichier_calendrier/calendrier_liste_locataire.php");
}

 //********************************************************************************
// controle mode démo ************************************************************
//********************************************************************************
 if ( $fonction == 'supprimer' && MODE_DEMO   )
     $affiche_info = 'mode_demo';

}

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
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="locataire.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
    var GB_ROOT_DIR = "js_lightbox/";
</script>

<script type="text/javascript" src="js_lightbox/AJS.js"></script>
<script type="text/javascript" src="js_lightbox/AJS_fx.js"></script>
<script type="text/javascript" src="js_lightbox/gb_scripts.js"></script>
<link href="js_lightbox/gb_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function ValidateForm1(theForm)
{
   var regexp;
   if (theForm.recherche.value == "")
   {
      alert("Le champs de recherche est vide !");
      theForm.recherche.focus();
      return false;
   }
   if (theForm.recherche.value.length < A)
   {
      alert("Le champs de recherche est vide !");
      theForm.recherche.focus();
      return false;
   }
   return true;
}
</script>
<link rel="stylesheet" href="fichier_calendrier/styles.css?version=<?php echo filemtime('fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >
<script type="text/javascript" src="fonction.js"></script>

<script language="JavaScript" type="text/javascript">
<!--
function popupwnd(url, toolbar, menubar, locationbar, resize, scrollbars, statusbar, left, top, width, height)
{
   var popupwindow = this.open(url, '', 'toolbar=' + toolbar + ',menubar=' + menubar + ',location=' + locationbar + ',scrollbars=' + scrollbars + ',resizable=' + resize + ',status=' + statusbar + ',left=' + left + ',top=' + top + ',width=' + width + ',height=' + height);
}
//-->
</script>

<script src="js_autocomplete/jquery.js"></script>
<script type="text/javascript" src="js_autocomplete/jquery.autocomplete.pack.js"></script>
	
	 
<script type="text/javascript">
	 
// Lorsque la totalité de la page est chargée
	 
        $(document).ready(function() {
	 
	$.ajax({ // Requete ajax
	 
	type: "POST", // envoie en POST
	url: "affiche_autocomplete.php?type=tous", // url cible du script PHP
	async: true, // mode asynchrone
	data: "", // données envoyées
	 
	success: function(xml){ // Lorsque le PHP à renovyé une réponse
	var elementsArray = new Array();
	 
	$(xml).find('element').each(function(){ // pour chaque "element"
	elementsArray.push($(this).text()); // ajout dans le tableau
	});
	 
	$("#recherche").autocomplete(elementsArray); // activation de l'autocompletion

         }
	 
});
	 
});
	 
</script>
</head>
<body>
<div id="container">
<div id="wb_MasterPage2" style="position:absolute;left:2px;top:0px;width:964px;height:110px;z-index:43;">
</div>
<table style="position:absolute;left:4px;top:109px;width:982px;height:692px;z-index:44;" cellpadding="5" cellspacing="1" id="contenu">
<tr>
<td class="cell0"><br><br><br><br><br><br><br><br><br><br>

<a href="#A"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>A&nbsp;</b></font></a>
<a href="#B"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>B&nbsp;</b></font></a>
<a href="#C"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>C&nbsp;</b></font></a>
<a href="#D"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>D&nbsp;</b></font></a>
<a href="#E"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>E&nbsp;</b></font></a>
<a href="#F"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>F&nbsp;</b></font></a>
<a href="#G"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>G&nbsp;</b></font></a>
<a href="#H"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>H&nbsp;</b></font></a>
<a href="#I"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>I&nbsp;</b></font></a>
<a href="#J"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>J&nbsp;</b></font></a>
<a href="#K"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>K&nbsp;</b></font></a>
<a href="#L"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>L&nbsp;</b></font></a>
<a href="#M"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>M&nbsp;</b></font></a>
<a href="#N"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>N&nbsp;</b></font></a>
<a href="#O"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>O&nbsp;</b></font></a>
<a href="#P"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>P&nbsp;</b></font></a>
<a href="#Q"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>Q&nbsp;</b></font></a>
<a href="#R"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>R&nbsp;</b></font></a>
<a href="#S"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>S&nbsp;</b></font></a>
<a href="#T"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>T&nbsp;</b></font></a>
<a href="#U"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>U&nbsp;</b></font></a>
<a href="#V"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>V&nbsp;</b></font></a>
<a href="#W"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>W&nbsp;</b></font></a>
<a href="#X"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>X&nbsp;</b></font></a>
<a href="#Y"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>Y&nbsp;</b></font></a>
<a href="#Z"><font style="font-size:21px" color="#00C4FD" face="Arial" class="style3"><b>Z&nbsp;</b></font></a>

<table width="100%" border="0" cellpadding="0" cellspacing="1" id="Table1">
<tr>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>ID</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Nom Locataire</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Téléphone</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Email</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Adresse</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Commentaire</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Modifier</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Stat</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Supprimer</B></font></td>
</tr>

<?php

$couleur_tab = "#DBE4EE";
$memoire_locataire = '';
$cle_fichier ='';
$memoire_premiere_lettre = '';
$faire_recherche = false;

if ( isset($nom_locataire)) {
 $nb_result = count ($nom_locataire);
 if ( $nb_result > 0 ) {

 //tri par ordre alphabétique
 asort($nom_locataire);

 foreach ($nom_locataire as $cle_fichier => $val_locataire )  {
 
  extract($_POST);

  $le_pays = ($cle_fichier <> 0)? $pays_locataire[$cle_fichier] : "";

  $trouve = false ;
  if ( isset($_POST['Rechercher']) && ($_POST['Rechercher']) == "Rechercher" && $cle_fichier <> 0) {
     $faire_recherche = true;
     if( isset($recherche_nom) && $recherche_nom == "oui" && preg_match("/$recherche/i", stripslashes($nom_locataire[$cle_fichier])) )
         $trouve = true;
     if( isset($recherche_prenom) && $recherche_prenom == "oui" && preg_match("/$recherche/i", stripslashes($prenom_locataire[$cle_fichier])) )
         $trouve = true;
     if( isset($recherche_email) && $recherche_email == "oui" && preg_match("/$recherche/i", stripslashes($email_locataire[$cle_fichier])) )
         $trouve = true;
     if( isset($recherche_ville) && $recherche_ville == "oui" && preg_match("/$recherche/i", stripslashes($commune_locataire[$cle_fichier])) )
         $trouve = true;
     if( isset($recherche_pays) && $recherche_pays == "oui" && preg_match("/$recherche/i", stripslashes($tableau_pays[$le_pays])) )
         $trouve = true;
  }

  if ( ($cle_fichier <> 0 && !$faire_recherche) || ( $cle_fichier <> 0 && $faire_recherche && $trouve) ) {

  $premiere_lettre = substr(stripslashes($val_locataire), 0, 1); 
  if ( $premiere_lettre <> $memoire_premiere_lettre)
      echo '<tr><td align="left" valign="middle" bgcolor ="#F4F4F4" colspan ="8"><a name="',ucfirst($premiere_lettre),'"><font style="font-size:16px" color="#00C4FD" face="Arial"><b>',ucfirst($premiere_lettre),'...</b></font></a></td>
     <td align="right" valign="middle" bgcolor ="#F4F4F4" ><a href="#haut"><font style="font-size:10px" color="#00C4FD" face="Arial" class="style3"><b>^Haut de page</b></font></a></td>
     </tr>'; 

   echo '<tr><td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',$cle_fichier,'</font></td>

        <td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',stripslashes($val_locataire),' ',stripslashes($prenom_locataire[$cle_fichier]),'</font></td>

        <td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',stripslashes($telephone_locataire[$cle_fichier]),'</font></td>

        <td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial"><a href="mailto:',stripslashes($email_locataire[$cle_fichier]),'" class = style_lien>',stripslashes($email_locataire[$cle_fichier]),'</a></font></td> 

    <td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial"> ',$adresse_locataire[$cle_fichier],'<br> ',$code_locataire[$cle_fichier],' ',$commune_locataire[$cle_fichier],' ',$tableau_pays[$le_pays],'</font></td>

        <td align="center" valign="center" bgcolor =',$couleur_tab,'><a href="affiche_commentaire.php?num=',$cle_fichier,'" class = style_lien onclick="return GB_showPage(\'Modifier commentaire locataire ',stripslashes($val_locataire),' ',stripslashes($prenom_locataire[$cle_fichier]),'\', this.href)" ><img src="images/commenter.gif" id="Image2" alt="Commentaires" border="0" title="Modifier le commentaire du locataire" ></a></font></td>

        <td align="center" valign="center" bgcolor =',$couleur_tab,'><a href="modif_locataire.php?fct=modifier&num=',$cle_fichier,'" class = "style_lien" onclick="return GB_showPage(\'Modifier locataire : ',htmlentities(addslashes($val_locataire)),' ',htmlentities(addslashes($prenom_locataire[$cle_fichier])),'\', this.href)"><img src="images/modifier.gif" id="Image2" alt="Modifier" border="0" title="Modifier locataire" ></a></td>

        <td align="center" valign="center" bgcolor =',$couleur_tab,'><a href="listing.php?locataire=',$cle_fichier,'" class = style_lien ><img src="images/stat2.gif" id="Image2" alt="Statistiques" border="0" title="Statistiques locataire" ></a></td>

        <td align="center" valign="center" bgcolor =',$couleur_tab,'><a href="locataire.php?fct=supprimer&num=',$cle_fichier,'" onClick="return(confirm(\'Effacer ce locataire ? Ceci effacera également toutes les dates de ce locataire inscrites dans le calendrier\'));" class = style_lien ><img src="images/effacer.gif" id="Image2" alt="Supprimer" border="0" title="Supprimer le locataire" ></a></td></tr>';

   $memoire_premiere_lettre = ucfirst($premiere_lettre);
}

  }
 }
}
?>

</table><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_haut" style="position:absolute;left:2px;top:3px;width:18px;height:18px;z-index:45;">
<a id="haut" style="visibility:hidden">&nbsp;</a>
</div>
<table style="position:absolute;left:16px;top:114px;width:959px;height:37px;z-index:46;" cellpadding="4" cellspacing="0" id="titre">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:19px;"><strong>Gestion des locataires</strong></span></td>
<td class="cell1"><font style="font-size:12px" color="#FFFFFF" face="Arial Black"><b>
<?php 
if ( isset($nom_locataire)) {
 $nb_result = count ($nom_locataire)-1;
 echo $nb_result ;
}
?>
 locataires</b></font><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Extension1" style="position:absolute;left:21px;top:164px;width:71px;height:66px;z-index:47;">
<a href="ajout_locataire.php" onclick="return GB_showPage('Ajouter un locataire', this.href)" ><img src="locataire_plus.png" alt="Ajout"/ border ="0"></a></div>
<div id="wb_imprime" style="position:absolute;left:322px;top:168px;width:48px;height:48px;z-index:48;">
<a href="./imprime_locataire.php" target="_blank"><img src="images/printer.png" id="imprime" alt="Imprimer" title="Imprimer"></a></div>
<div id="wb_fond_recherche" style="position:absolute;left:537px;top:160px;width:424px;height:75px;z-index:49;">
<img src="images/img0008.png" id="fond_recherche" alt="" style="width:424px;height:75px;"></div>
<div id="wb_Form1" style="position:absolute;left:563px;top:165px;width:391px;height:70px;z-index:50;">
<form name="Form1" method="post" action="locataire.php" id="Form1" onsubmit="return ValidateForm1(this)">
<input type="submit" id="bp_recherche" name="Rechercher" value="Rechercher" style="position:absolute;left:292px;top:9px;width:96px;height:25px;z-index:0;">
<input type="checkbox" id="Checkbox1" name="recherche_nom" value="oui" style="position:absolute;left:60px;top:39px;z-index:1;" <?php 

if ( (isset($recherche_nom) && $recherche_nom =="oui" )  || !isset($Rechercher) ) 
echo "checked";

?>>
<div id="wb_Text1_nom" style="position:absolute;left:77px;top:40px;width:46px;height:16px;z-index:2;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Nom</strong></span></div>
<div id="wb_Text2_email" style="position:absolute;left:205px;top:40px;width:46px;height:16px;z-index:3;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Email</strong></span></div>
<input type="checkbox" id="Checkbox2" name="recherche_email" value="oui" style="position:absolute;left:188px;top:39px;z-index:4;" <?php 

if ( (isset($recherche_email) && $recherche_email =="oui" )  || !isset($Rechercher) ) 
echo "checked";

?>>
<div id="wb_Text3_ville" style="position:absolute;left:267px;top:40px;width:34px;height:16px;z-index:5;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Ville</strong></span></div>
<input type="checkbox" id="Checkbox3" name="recherche_ville" value="oui" style="position:absolute;left:250px;top:39px;z-index:6;" <?php 

if ( (isset($recherche_ville) && $recherche_ville =="oui" )  || !isset($Rechercher) ) 
echo "checked";

?>>
<input type="checkbox" id="Checkbox4" name="recherche_prenom" value="oui" style="position:absolute;left:112px;top:39px;z-index:7;" <?php 

if ( (isset($recherche_prenom) && $recherche_prenom =="oui" )  || !isset($Rechercher) ) 
echo "checked";

?>>
<div id="wb_Text4_prenom" style="position:absolute;left:129px;top:40px;width:55px;height:16px;z-index:8;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Prénom</strong></span></div>
<div id="wb_Image2_locataire_rech" style="position:absolute;left:3px;top:6px;width:48px;height:48px;z-index:9;">
<img src="images/recherche_locataire.png" id="Image2_locataire_rech" alt="Recherche locataire" title="Recherche locataire"></div>
<input type="checkbox" id="Checkbox5" name="recherche_pays" value="oui" style="position:absolute;left:308px;top:39px;z-index:10;" <?php 

if ( (isset($recherche_pays) && $recherche_pays =="oui" )  || !isset($Rechercher) ) 
echo "checked";

?>>
<div id="wb_Text5_pays" style="position:absolute;left:325px;top:40px;width:46px;height:16px;z-index:11;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Pays</strong></span></div>
<input type="text" id="recherche" style="position:absolute;left:59px;top:10px;width:228px;height:18px;line-height:18px;z-index:12;" name="recherche" value="<?php   if ( isset($_POST['Rechercher']) && ($_POST['Rechercher']) == "Rechercher" ) echo $recherche; ?>">
<div id="wb_Extension4" style="position:absolute;left:364px;top:42px;width:21px;height:21px;z-index:13;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">La zone de recherche vous permet de filtrer la liste des locataires suivant :<br>
- Nom<br>
- Prénom<br>
- Email<br>
- Ville<br>
- Pays</font></em></a></div>
</form>
</div>
<div id="wb_Extension2" style="position:absolute;left:97px;top:164px;width:71px;height:66px;z-index:51;">
<a href="liste_mailing.php" onclick="return GB_showPage('Récupérer les inscrits à la liste d\'email :', this.href)" ><img src="liste_email.png" alt="mailing"/ border ="0"></a></div>
<div id="wb_Extension3" style="position:absolute;left:172px;top:164px;width:71px;height:66px;z-index:52;">
<a href="export_locataire.php" onclick="return GB_showPage('Exporter la liste des locataires au format CSV', this.href)" ><img src="export_locataire.png" alt="Export"/ border ="0"></a></div>
<div id="wb_MasterPage5" style="position:absolute;left:102px;top:0px;width:96px;height:106px;z-index:53;">
<div id="wb_Shape1" style="position:absolute;left:36px;top:90px;width:21px;height:11px;z-index:14;">
<img src="images/img0003.gif" id="Shape1" alt="" style="width:21px;height:11px;"></div>
<div id="wb_Shape2" style="position:absolute;left:0px;top:98px;width:96px;height:8px;z-index:15;">
<img src="images/img0006.gif" id="Shape2" alt="" style="width:96px;height:8px;"></div>
<div id="wb_Shape3" style="position:absolute;left:0px;top:0px;width:96px;height:3px;z-index:16;">
<img src="images/img0016.gif" id="Shape3" alt="" style="width:96px;height:3px;"></div>
</div>
<div id="wb_MasterPage1" style="position:absolute;left:4px;top:0px;width:998px;height:110px;z-index:54;">
<div id="wb_fond_widget" style="position:absolute;left:960px;top:2px;width:38px;height:108px;filter:alpha(opacity=40);opacity:0.40;z-index:17;">
<img src="images/img0013.png" id="fond_widget" alt="" style="width:38px;height:108px;"></div>
<div id="wb_menu_codes" style="position:absolute;left:800px;top:10px;width:32px;height:32px;z-index:18;">
<a href="./code.php"><img src="images/binary.png" id="menu_codes" alt="Codes pour afficher les calendriers visiteurs" title="Codes pour afficher les calendriers visiteurs"></a></div>
<div id="wb_text_cal" style="position:absolute;left:2px;top:55px;width:95px;height:18px;text-align:center;z-index:19;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./index_calendrier.php" class="Style_menu">Calendrier</a></span></div>
<div id="wb_text_locataire" style="position:absolute;left:97px;top:55px;width:95px;height:18px;text-align:center;z-index:20;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./locataire.php" class="Style_menu">Locataires</a></span></div>
<div id="text_ressource" style="position:absolute;left:193px;top:55px;width:97px;height:44px;z-index:21">
<div  style="text-align:center;">

<font style="font-size:16px" color="#666666" face="Arial"><a href="./logement.php" class="Style_menu">
<?php echo $item1; ?>
</a></font>

</div></div>
<div id="wb_text_couleur" style="position:absolute;left:291px;top:55px;width:95px;height:54px;text-align:center;z-index:22;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./couleur.php" class="Style_menu">Couleurs des marqueurs</a></span></div>
<div id="wb_texte_param" style="position:absolute;left:482px;top:55px;width:95px;height:36px;text-align:center;z-index:23;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./parametrage_calendrier.php" class="Style_menu">Paramètres calendrier</a></span></div>
<div id="wb_text_stats" style="position:absolute;left:387px;top:55px;width:95px;height:18px;text-align:center;z-index:24;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./listing.php" class="Style_menu">Statistiques</a></span></div>
<div id="wb_texte_langues" style="position:absolute;left:578px;top:55px;width:95px;height:18px;text-align:center;z-index:25;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./edit_langue.php" class="Style_menu">Langues</a></span></div>
<div id="wb_text_maintenance" style="position:absolute;left:674px;top:55px;width:95px;height:18px;text-align:center;z-index:26;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./base.php" class="Style_menu">Maintenance</a></span></div>
<div id="wb_text_codes" style="position:absolute;left:769px;top:55px;width:95px;height:18px;text-align:center;z-index:27;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./code.php" class="Style_menu">Codes</a></span></div>
<div id="wb_text_propos" style="position:absolute;left:862px;top:55px;width:95px;height:18px;text-align:center;z-index:28;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./a_propos.php" class="Style_menu">A propos</a></span></div>
<div id="wb_image_location" style="position:absolute;left:967px;top:3px;width:20px;height:20px;z-index:29;">
<a href="identification.php?fct=deconnexion"><img src="images/img0007.png" id="image_location" alt="D&#233;connexion" title="D&#233;connexion"></a></div>
<div id="wb_menu_memo" style="position:absolute;left:961px;top:27px;width:31px;height:31px;z-index:30;">
<a href="#"><img src="images/img0012.png" id="menu_memo" alt="M&#233;mo" title="M&#233;mo" onclick="coller_ajax('memo','colle_memo.html');document.getElementById('Memoire').style.visibility='visible';"></a></div>
<div id="wb_menu_calcul" style="position:absolute;left:963px;top:66px;width:32px;height:32px;z-index:31;">
<a href="#"><img src="images/img0325.png" id="menu_calcul" alt="Calculatrice" title="Calculatrice" onclick="document.getElementById('Calculatrice').style.visibility='visible';"></a></div>
<div id="wb_menu_cal" style="position:absolute;left:27px;top:10px;width:44px;height:37px;z-index:32;">
<a href="./index_calendrier.php"><img src="images/img0021.png" id="menu_cal" alt="Calendrier" title="Calendrier"></a></div>
<div id="wb_menu_locataire" style="position:absolute;left:123px;top:7px;width:48px;height:48px;z-index:33;">
<a href="./locataire.php"><img src="images/people.png" id="menu_locataire" alt="Gestion des locataires" title="Gestion des locataires"></a></div>
<div id="wb_menu_ressources" style="position:absolute;left:217px;top:7px;width:48px;height:48px;z-index:34;">
<a href="./logement.php"><img src="images/09_48x48.png" id="menu_ressources" alt="Gestion des logements" title="Gestion des logements"></a></div>
<div id="wb_menu_couleur" style="position:absolute;left:315px;top:7px;width:48px;height:48px;z-index:35;">
<a href="./couleur.php"><img src="images/palette.png" id="menu_couleur" alt="Gestion des marqueurs" title="Gestion des marqueurs"></a></div>
<div id="wb_manu_maintenance" style="position:absolute;left:699px;top:7px;width:48px;height:48px;z-index:36;">
<a href="./base.php"><img src="images/maintenance.png" id="manu_maintenance" alt="Maintenance des donn&#233;es" title="Maintenance des donn&#233;es"></a></div>
<div id="wb_menu_stat" style="position:absolute;left:411px;top:7px;width:48px;height:48px;z-index:37;">
<a href="./listing.php"><img src="images/stat.png" id="menu_stat" alt="Statistiques de locations" title="Statistiques de locations"></a></div>
<div id="wb_menu_langue" style="position:absolute;left:604px;top:7px;width:48px;height:48px;z-index:38;">
<a href="./edit_langue.php"><img src="images/langue.png" id="menu_langue" alt="Gestion des langues" title="Gestion des langues"></a></div>
<div id="wb_menu_paraemtre" style="position:absolute;left:506px;top:7px;width:48px;height:48px;z-index:39;">
<a href="./parametrage_calendrier.php"><img src="images/administrative_docs.png" id="menu_paraemtre" alt="Param&#233;tres du calendrier" title="Param&#233;tres du calendrier"></a></div>
<div id="wb_menu_propos" style="position:absolute;left:886px;top:7px;width:48px;height:48px;z-index:40;">
<a href="./a_propos.php"><img src="images/brainstorming.png" id="menu_propos" alt="A propos du script" title="A propos du script"></a></div>
<div id="text_affiche_info" style="position:absolute;left:276px;top:2px;width:274px;height:10px;z-index:41">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<!-- widget -->
<div id="text_code_commun" style="position:absolute;left:570px;top:0px;width:25px;height:31px;z-index:42">
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
<div id="wb_Image3_fond_recherhe" style="position:absolute;left:253px;top:166px;width:48px;height:48px;z-index:55;">
<a href="./locataire.php"><img src="images/affiche_tous_locataire_01.png" id="Image3_fond_recherhe" alt="Afficher tous les locataires" title="Afficher tous les locataires"></a></div>
<div id="wb_Text6" style="position:absolute;left:21px;top:215px;width:65px;height:15px;z-index:56;text-align:left;">
<span style="color:#000000;font-family:'Arial Black';font-size:11px;">Ajouter</span></div>
<div id="wb_Text7" style="position:absolute;left:85px;top:215px;width:76px;height:15px;text-align:center;z-index:57;">
<span style="color:#000000;font-family:'Arial Black';font-size:11px;">Liste Email</span></div>
<div id="wb_Text8" style="position:absolute;left:172px;top:215px;width:76px;height:15px;z-index:58;text-align:left;">
<span style="color:#000000;font-family:'Arial Black';font-size:11px;">Exporter</span></div>
<div id="wb_Text9" style="position:absolute;left:239px;top:215px;width:81px;height:15px;text-align:center;z-index:59;">
<span style="color:#000000;font-family:'Arial Black';font-size:11px;">Afficher tous</span></div>
</div>
</body>
</html><?php

 if ( $avec_compression_page )
    ob_end_flush();

?>