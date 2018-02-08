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
$nom_adresse_temp = '' ; 
$nom_code_temp = '' ;
$nom_commune_temp = ''; 
$nom_pays_temp = '' ;
$mailing_list_temp = '';
$affiche_info = '';
$fichier_libre = false;
$fin_tableau_locataire = false ;

// test si demande Modifier d'un locataire*****************************************************************************
if ( isset($_POST['Modifier']) && ($_POST['Modifier']) == 'Modifier' && !(empty($_POST['nom'])) && !MODE_DEMO ) {

  //initialisation des variables*************************

  extract($_POST);

  $chemin_fichier = "fichier_calendrier/calendrier_liste_locataire.php";
  $chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_calendrier_liste_locataire.php";

  while (!isset($fin_tableau_locataire) || !$fin_tableau_locataire) {
  include ($chemin_fichier);
  if ( isset($fin_tableau_locataire) && $fin_tableau_locataire) {
     //sauvegarde ancien fichier*********************************
     @copy($chemin_fichier,$chemin_fichier_sauvegarde);
     $file= @fopen($chemin_fichier, "w");
     $fichier_libre = true;
     $fonction = 'Modifier';
  }

}

if ( $fichier_libre )
  //chemin vers le fichier de création liste des locataires/logements**********************************************************
  require("genere/genere_listes_locataire.php");

if ( isset($creation_reussi) && $creation_reussi )
    $affiche_info = "modif_ok" ;
else
   $affiche_info = "erreur_execution"; 

  $_GET['fct'] = "modifier";
  $_GET['num'] = $cle_modif;

}  


// test si demande effacement d'un locataire*****************************************************************************
if ( isset($_GET['fct']) && !is_numeric($_GET['fct']) &&  !(empty($_GET['fct'])) &&  isset($_GET['num']) && is_numeric($_GET['num']) ) {

  $num_supprime = $_GET['num'] ;
  $fonction = $_GET['fct'] ;

//fonction modifier **************************

if ( $fonction == 'modifier' ) {

 $nom_locataire_temp = $nom_locataire[$num_supprime];
 $nom_prenom_temp = $prenom_locataire[$num_supprime];
 $nom_telephone_temp = $telephone_locataire[$num_supprime];
 $nom_email_temp = $email_locataire[$num_supprime];
 $nom_adresse_temp = $adresse_locataire[$num_supprime] ; 
 $nom_code_temp = $code_locataire[$num_supprime] ;
 $nom_commune_temp = $commune_locataire[$num_supprime] ; 
 $nom_pays_temp = $pays_locataire[$num_supprime] ;
 $mailing_list_temp = $mailing_list_ok[$num_supprime] ;
 $cle_locataire_modif = $num_supprime;
 }

} 


//********************************************************************************
// controle mode démo ************************************************************
//********************************************************************************
  if ( ( (isset($_POST['Modifier'])) ||(isset($_POST['Effacer'])) )&& MODE_DEMO   )
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
<link href="modif_locataire.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function ValidateForm1(theForm)
{
   var regexp;
   if (theForm.nom.value == "")
   {
      alert("Vous n'avez pas renseigné le nom du locataire!");
      theForm.nom.focus();
      return false;
   }
   if (theForm.nom.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le nom du locataire!");
      theForm.nom.focus();
      return false;
   }
   return true;
}
</script>
<link rel="stylesheet" href="fichier_calendrier/styles.css?version=<?php echo filemtime('fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >
<script type="text/javascript" src="fonction.js"></script>

<script src="js_autocomplete/jquery.js"></script>
<script type="text/javascript" src="js_autocomplete/jquery.autocomplete.pack.js"></script>
	
	 
<script type="text/javascript">
	 
// Lorsque la totalité de la page est chargée
	 
        $(document).ready(function() {
	 
	$.ajax({ // Requete ajax
	 
	type: "POST", // envoie en POST
	url: "affiche_autocomplete.php?type=nom", // url cible du script PHP
	async: true, // mode asynchrone
	data: "", // données envoyées
	 
	success: function(xml){ // Lorsque le PHP à renovyé une réponse
	var elementsArray = new Array();
	 
	$(xml).find('element').each(function(){ // pour chaque "element"
	elementsArray.push($(this).text()); // ajout dans le tableau
	});
	 
	$("#nom").autocomplete(elementsArray); // activation de l'autocompletion

         }
	 
});
	 
});
	 
</script>

<script type="text/javascript">
	 
// Lorsque la totalité de la page est chargée
	 
        $(document).ready(function() {
	 
	$.ajax({ // Requete ajax
	 
	type: "POST", // envoie en POST
	url: "affiche_autocomplete.php?type=prenom", // url cible du script PHP
	async: true, // mode asynchrone
	data: "", // données envoyées
	 
	success: function(xml){ // Lorsque le PHP à renovyé une réponse
	var elementsArray = new Array();
	 
	$(xml).find('element').each(function(){ // pour chaque "element"
	elementsArray.push($(this).text()); // ajout dans le tableau
	});
	 
	$("#prenom").autocomplete(elementsArray); // activation de l'autocompletion

         }
	 
});
	 
});
	 
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
<div id="space"><br></div>
<div id="container">
<table style="position:absolute;left:1px;top:0px;width:746px;height:382px;z-index:21;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Form2" style="position:absolute;left:13px;top:42px;width:720px;height:324px;z-index:22;">
<form name="Form1" method="post" action="modif_locataire.php" id="Form2" onsubmit="return ValidateForm1(this)">
<input type="hidden" name="cle_modif" value="<?php echo $cle_locataire_modif; ?>">
<div id="wb_Text1" style="position:absolute;left:65px;top:25px;width:116px;height:18px;text-align:right;z-index:0;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Nom </strong></span></div>
<div id="wb_Text4" style="position:absolute;left:30px;top:57px;width:150px;height:18px;text-align:right;z-index:1;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Prénom </strong></span></div>
<input type="text" id="prenom" style="position:absolute;left:186px;top:54px;width:416px;height:20px;line-height:20px;z-index:2;" name="prenom" value="<?php echo html_ent($nom_prenom_temp); ?>" tabindex="2" onfocus="bordure_formulaire('prenom','oui');return false;" onblur="bordure_formulaire('prenom','non');return false;" >
<div id="wb_Text5" style="position:absolute;left:30px;top:89px;width:150px;height:18px;text-align:right;z-index:3;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Téléphone</strong></span></div>
<input type="text" id="telephone" style="position:absolute;left:186px;top:86px;width:416px;height:20px;line-height:20px;z-index:4;" name="telephone" value="<?php echo html_ent($nom_telephone_temp); ?>" tabindex="3" onfocus="bordure_formulaire('telephone','oui');return false;" onblur="bordure_formulaire('telephone','non');return false;" >
<div id="wb_Text6" style="position:absolute;left:30px;top:122px;width:150px;height:18px;text-align:right;z-index:5;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Email</strong></span></div>
<input type="text" id="email" style="position:absolute;left:186px;top:118px;width:416px;height:20px;line-height:20px;z-index:6;" name="email" value="<?php echo $nom_email_temp; ?>" tabindex="4" onfocus="bordure_formulaire('email','oui');return false;" onblur="bordure_formulaire('email','non');return false;" >
<input type="text" id="nom" style="position:absolute;left:185px;top:22px;width:416px;height:20px;line-height:20px;z-index:7;" name="nom" value="<?php echo html_ent($nom_locataire_temp); ?>" tabindex="1" onfocus="bordure_formulaire('nom','oui');return false;" onblur="bordure_formulaire('nom','non');return false;" >
<input type="submit" id="Button2" name="Modifier" value="Modifier" style="position:absolute;left:186px;top:285px;width:96px;height:25px;z-index:8;" tabindex="6">
<div id="wb_Text3" style="position:absolute;left:31px;top:154px;width:150px;height:18px;text-align:right;z-index:9;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Adresse</strong></span></div>
<input type="text" id="adresse" style="position:absolute;left:187px;top:151px;width:416px;height:20px;line-height:20px;z-index:10;" name="adresse" value="<?php echo $nom_adresse_temp; ?>" tabindex="5" onfocus="bordure_formulaire('adresse','oui');return false;" onblur="bordure_formulaire('adresse','non');return false;" >
<div id="wb_Text2" style="position:absolute;left:32px;top:187px;width:150px;height:18px;text-align:right;z-index:11;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Code postal</strong></span></div>
<input type="text" id="code" style="position:absolute;left:188px;top:183px;width:76px;height:20px;line-height:20px;z-index:12;" name="code" value="<?php echo $nom_code_temp; ?>" tabindex="6" onfocus="bordure_formulaire('code','oui');return false;" onblur="bordure_formulaire('code','non');return false;" >
<div id="wb_Text10" style="position:absolute;left:273px;top:186px;width:80px;height:18px;text-align:right;z-index:13;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Commune</strong></span></div>
<input type="text" id="commune" style="position:absolute;left:360px;top:183px;width:240px;height:20px;line-height:20px;z-index:14;" name="commune" value="<?php echo $nom_commune_temp; ?>" tabindex="7" onfocus="bordure_formulaire('commune','oui');return false;" onblur="bordure_formulaire('commune','non');return false;" >
<div id="wb_Text9" style="position:absolute;left:33px;top:218px;width:150px;height:18px;text-align:right;z-index:15;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Pays</strong></span></div>
<div id="Html3" style="position:absolute;left:188px;top:216px;width:409px;height:20px;z-index:16">
<?php

liste_box ("pays",300,$tableau_pays,"",false,$nom_pays_temp,true,"");

?></div>
<input type="button" id="Button3" onclick="parent.parent.location = 'locataire.php' ;return false;" name="Fermer" value="Fermer" style="position:absolute;left:505px;top:285px;width:96px;height:25px;z-index:17;" tabindex="6">
<input type="checkbox" id="Checkbox2" name="mailing_list" value="oui" style="position:absolute;left:187px;top:246px;z-index:18;" <?php if ( $mailing_list_temp) {echo 'checked';} ?>>
<div id="wb_Text12" style="position:absolute;left:210px;top:247px;width:316px;height:18px;z-index:19;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Inscrire a la liste d'email</strong></span></div>
<div id="wb_Extension2" style="position:absolute;left:609px;top:88px;width:21px;height:21px;z-index:20;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Le champs téléphone peut contenir tous les numéros de téléphone du locataire, <br>
vous pouvez indiquer le numéro de téléphone fixe et/ou le téléphone portable.</font></em></a></div>
</form>
</div>
<div id="wb_Image2" style="position:absolute;left:26px;top:11px;width:48px;height:48px;z-index:23;">
<img src="images/locataire_change.png" id="Image2" alt=""></div>
<div id="Html1" style="position:absolute;left:80px;top:11px;width:120px;height:23px;z-index:24">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<div id="wb_Extension1" style="position:absolute;left:401px;top:285px;width:21px;height:21px;z-index:25;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">La page locataire vous permet de récupérer la liste des locataire étant inscrit à la liste des emails.</font></em></a></div>
</div>
</body>
</html>