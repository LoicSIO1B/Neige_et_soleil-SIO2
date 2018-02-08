<?php
session_start();

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_connexion.php");

$separateur  = "" ;
$affiche_info = "";

// test si demande ajout d'un locataire*****************************************************************************
if ( isset($_POST['Générer']) && ($_POST['Générer']) == 'Générer' ) {

  extract($_POST);

  include("genere/genere_export_locataire.php");



}  



?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Ajout</title>
<meta name="generator" content="WYSIWYG Web Builder - http://www.wysiwygwebbuilder.com">
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="export_locataire.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function Validateexport_locataire.php(theForm)
{
   var regexp;
   if (theForm.nom.value == "")
   {
      alert("Please enter a value for the \"separateur\" field.");
      theForm.nom.focus();
      return false;
   }
   if (theForm.nom.value.length < 1)
   {
      alert("Please enter at least 1 characters in the \"separateur\" field.");
      theForm.nom.focus();
      return false;
   }
   return true;
}
</script>
<link rel="stylesheet" href="fichier_calendrier/styles.css?version=<?php echo filemtime('fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >

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


</head>
<body>
<div id="space"><br></div>
<div id="container">
<table style="position:absolute;left:1px;top:1px;width:746px;height:432px;z-index:29;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Form2" style="position:absolute;left:9px;top:35px;width:720px;height:381px;z-index:30;">
<form name="export_locataire.php" method="post" action="" id="Form2" onsubmit="return Validateexport_locataire.php(this)">
<div id="wb_Text1" style="position:absolute;left:17px;top:25px;width:165px;height:18px;text-align:right;z-index:0;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Séparateur de champs</strong></span></div>
<div id="wb_Text7" style="position:absolute;left:26px;top:59px;width:150px;height:18px;text-align:right;z-index:1;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong><u>Inclure :</u></strong></span></div>
<input type="submit" id="Button2" name="Générer" value="Générer" style="position:absolute;left:179px;top:338px;width:96px;height:25px;z-index:2;" tabindex="6">
<input type="button" id="Button1" onclick="parent.parent.location = 'locataire.php' ;return false;" name="" value="Fermer" style="position:absolute;left:401px;top:338px;width:96px;height:25px;z-index:3;" tabindex="6">
<input type="text" id="nom" style="position:absolute;left:188px;top:20px;width:177px;height:20px;line-height:20px;z-index:4;" name="separateur" value="<?php echo $separateur; ?>" tabindex="1">
<input type="checkbox" id="Checkbox1" name="tabulation" value="oui" checked style="position:absolute;left:375px;top:25px;z-index:5;">
<div id="wb_Text2" style="position:absolute;left:394px;top:25px;width:106px;height:18px;z-index:6;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Tabulation</strong></span></div>
<input type="checkbox" id="Checkbox2" name="nom" value="oui" checked style="position:absolute;left:185px;top:87px;z-index:7;">
<div id="wb_Text3" style="position:absolute;left:203px;top:86px;width:165px;height:18px;z-index:8;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Nom</strong></span></div>
<input type="checkbox" id="Checkbox3" name="prenom" value="oui" checked style="position:absolute;left:185px;top:107px;z-index:9;">
<div id="wb_Text4" style="position:absolute;left:203px;top:106px;width:165px;height:18px;z-index:10;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Prénom</strong></span></div>
<input type="checkbox" id="Checkbox4" name="adresse" value="oui" checked style="position:absolute;left:185px;top:129px;z-index:11;">
<div id="wb_Text5" style="position:absolute;left:203px;top:128px;width:165px;height:18px;z-index:12;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Adresse</strong></span></div>
<input type="checkbox" id="Checkbox5" name="code_postal" value="oui" checked style="position:absolute;left:185px;top:150px;z-index:13;">
<div id="wb_Text6" style="position:absolute;left:203px;top:149px;width:165px;height:18px;z-index:14;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Code postal</strong></span></div>
<input type="checkbox" id="Checkbox6" name="commune" value="oui" checked style="position:absolute;left:185px;top:172px;z-index:15;">
<div id="wb_Text8" style="position:absolute;left:203px;top:171px;width:165px;height:18px;z-index:16;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Commune</strong></span></div>
<input type="checkbox" id="Checkbox7" name="pays" value="oui" checked style="position:absolute;left:185px;top:194px;z-index:17;">
<div id="wb_Text9" style="position:absolute;left:201px;top:193px;width:165px;height:18px;z-index:18;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Pays</strong></span></div>
<input type="checkbox" id="Checkbox8" name="email" value="oui" checked style="position:absolute;left:185px;top:237px;z-index:19;">
<div id="wb_Text10" style="position:absolute;left:203px;top:237px;width:165px;height:18px;z-index:20;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Email</strong></span></div>
<input type="checkbox" id="Checkbox9" name="mailing" value="oui" checked style="position:absolute;left:185px;top:279px;z-index:21;">
<div id="wb_Text11" style="position:absolute;left:203px;top:279px;width:165px;height:18px;z-index:22;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Inscription liste email</strong></span></div>
<input type="checkbox" id="Checkbox10" name="telephone" value="oui" checked style="position:absolute;left:185px;top:215px;z-index:23;">
<div id="wb_Text12" style="position:absolute;left:201px;top:214px;width:165px;height:18px;z-index:24;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Téléphone</strong></span></div>
<input type="checkbox" id="Checkbox11" name="commentaire" value="oui" checked style="position:absolute;left:185px;top:258px;z-index:25;">
<div id="wb_Text13" style="position:absolute;left:203px;top:258px;width:165px;height:18px;z-index:26;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Commentaires</strong></span></div>
<div id="wb_Extension2" style="position:absolute;left:481px;top:24px;width:21px;height:21px;z-index:27;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Le séparateur de champs est un caractère qui va séparer toutes les colonnes du fichier csv.<br>
C'est le séparateur de champs qui va vous permettre d'importer le fichier CSV par un logiciel tableur qui pourra reconnaître ainsi les différentes colonnes.<br>
</font><font style="font-size:13px" color="#FF6820" face="MS Sans Serif"><b>Le séparateur de champs n'est pas obligatoire, généralement la tabulation comme séparateur de champs suffit.</b></font></em></a></div>
<div id="wb_Extension1" style="position:absolute;left:186px;top:58px;width:21px;height:21px;z-index:28;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Cochez les différents éléments qui doivent apparaître dans le fichier CSV.</font></em></a></div>
</form>
</div>
<div id="wb_Image1" style="position:absolute;left:26px;top:9px;width:48px;height:48px;z-index:31;">
<img src="images/export_locataire.png" id="Image1" alt=""></div>
<div id="Html1" style="position:absolute;left:85px;top:9px;width:120px;height:23px;z-index:32">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<div id="wb_Extension3" style="position:absolute;left:295px;top:376px;width:21px;height:21px;z-index:33;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Si le fichier est correctement généré, le téléchargement se lancera tout seul.</font></em></a></div>
</div>
</body>
</html>