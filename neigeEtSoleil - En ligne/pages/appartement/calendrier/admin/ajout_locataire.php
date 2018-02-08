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
$fichier_libre = false ;
$fin_tableau_locataire = false ;


// test si demande ajout d'un locataire*****************************************************************************
if ( isset($_POST['Ajouter']) && ($_POST['Ajouter']) == 'Ajouter' && !(empty($_POST['nom'])) && !MODE_DEMO) {

  //initialisation des variables*************************
  $num_pointeur_max = 0;
  $nom_locataire_temp = '';
  extract($_POST);

  $chemin_fichier = "fichier_calendrier/calendrier_liste_locataire.php";
  $chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_calendrier_liste_locataire.php";

  while (!isset($fin_tableau_locataire) || !$fin_tableau_locataire) {
  include ($chemin_fichier);
  if ( isset($fin_tableau_locataire)  && $fin_tableau_locataire ) {
     //sauvegarde ancien fichier*********************************
     @copy($chemin_fichier,$chemin_fichier_sauvegarde);
     $file= @fopen($chemin_fichier, "w");
     $fichier_libre = true;
     $fonction = 'Ajouter';
     }

  }

if ( $fichier_libre )
  //chemin vers le fichier de création liste des locataires/logements**********************************************************
  require("genere/genere_listes_locataire.php");


if ( isset($creation_reussi) && $creation_reussi )
    $affiche_info = "ajout_ok" ;
else
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
<title>Ajout</title>
<meta name="generator" content="WYSIWYG Web Builder - http://www.wysiwygwebbuilder.com">
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="ajout_locataire.css" rel="stylesheet" type="text/css">
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


</head>
<body>
<div id="space"><br></div>
<div id="container">
<table style="position:absolute;left:1px;top:1px;width:746px;height:375px;z-index:22;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Form2" style="position:absolute;left:9px;top:35px;width:720px;height:327px;z-index:23;">
<form name="Form1" method="post" action="" id="Form2" onsubmit="return ValidateForm1(this)">
<div id="wb_Text1" style="position:absolute;left:65px;top:25px;width:116px;height:18px;text-align:right;z-index:0;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Nom </strong></span></div>
<div id="wb_Text4" style="position:absolute;left:30px;top:57px;width:150px;height:18px;text-align:right;z-index:1;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Prénom </strong></span></div>
<div id="wb_Text5" style="position:absolute;left:30px;top:89px;width:150px;height:18px;text-align:right;z-index:2;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Téléphone</strong></span></div>
<div id="wb_Text6" style="position:absolute;left:30px;top:122px;width:150px;height:18px;text-align:right;z-index:3;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Email</strong></span></div>
<input type="submit" id="Button2" name="Ajouter" value="Ajouter" style="position:absolute;left:187px;top:289px;width:96px;height:25px;z-index:4;" tabindex="6">
<input type="button" id="Button1" onclick="parent.parent.location = 'locataire.php' ;return false;" name="Fermer" value="Fermer" style="position:absolute;left:491px;top:289px;width:96px;height:25px;z-index:5;" tabindex="6">
<input type="text" id="prenom" style="position:absolute;left:186px;top:54px;width:416px;height:20px;line-height:20px;z-index:6;" name="prenom" value="" tabindex="2" onfocus="bordure_formulaire('prenom','oui');return false;" onblur="bordure_formulaire('prenom','non');return false;">
<input type="text" id="telephone" style="position:absolute;left:186px;top:86px;width:416px;height:20px;line-height:20px;z-index:7;" name="telephone" value="" tabindex="3" onfocus="bordure_formulaire('telephone','oui');return false;" onblur="bordure_formulaire('telephone','non');return false;">
<input type="text" id="email" style="position:absolute;left:186px;top:118px;width:416px;height:20px;line-height:20px;z-index:8;" name="email" value="" tabindex="4" onfocus="bordure_formulaire('email','oui');return false;" onblur="bordure_formulaire('email','non');return false;">
<input type="text" id="nom" style="position:absolute;left:187px;top:20px;width:416px;height:20px;line-height:20px;z-index:9;" name="nom" value="" tabindex="1" onfocus="bordure_formulaire('nom','oui');return false;" onblur="bordure_formulaire('nom','non');return false;">
<div id="wb_Text2" style="position:absolute;left:31px;top:154px;width:150px;height:18px;text-align:right;z-index:10;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Adresse</strong></span></div>
<input type="text" id="adresse" style="position:absolute;left:187px;top:151px;width:416px;height:20px;line-height:20px;z-index:11;" name="adresse" value="" tabindex="5" onfocus="bordure_formulaire('adresse','oui');return false;" onblur="bordure_formulaire('adresse','non');return false;">
<div id="wb_Text3" style="position:absolute;left:32px;top:187px;width:150px;height:18px;text-align:right;z-index:12;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Code postal</strong></span></div>
<input type="text" id="code" style="position:absolute;left:188px;top:183px;width:76px;height:20px;line-height:20px;z-index:13;" name="code" value="" tabindex="6" onfocus="bordure_formulaire('code','oui');return false;" onblur="bordure_formulaire('code','non');return false;">
<div id="wb_Text9" style="position:absolute;left:273px;top:186px;width:81px;height:18px;text-align:right;z-index:14;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Commune</strong></span></div>
<input type="text" id="commune" style="position:absolute;left:360px;top:183px;width:240px;height:20px;line-height:20px;z-index:15;" name="commune" value="" tabindex="7" onfocus="bordure_formulaire('commune','oui');return false;" onblur="bordure_formulaire('commune','non');return false;">
<div id="wb_Text10" style="position:absolute;left:32px;top:219px;width:150px;height:18px;text-align:right;z-index:16;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Pays</strong></span></div>
<div id="Html2" style="position:absolute;left:190px;top:218px;width:409px;height:20px;z-index:17">
<?php

liste_box ("pays",300,$tableau_pays,"",false,"FR",true,"");

?></div>
<input type="checkbox" id="Checkbox1" name="mailing_list" value="oui" checked style="position:absolute;left:190px;top:250px;z-index:18;">
<div id="wb_Text11" style="position:absolute;left:213px;top:251px;width:316px;height:18px;z-index:19;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Inscrire a la liste d'email</strong></span></div>
<div id="wb_Extension1" style="position:absolute;left:611px;top:89px;width:21px;height:21px;z-index:20;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Le champs téléphone peut contenir tous les numéros de téléphone du locataire, <br>
vous pouvez indiquer le numéro de téléphone fixe et/ou le téléphone portable.</font></em></a></div>
<div id="wb_Extension2" style="position:absolute;left:392px;top:250px;width:21px;height:21px;z-index:21;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">La page locataire vous permet de récupérer la liste des locataire étant inscrit à la liste des emails.</font></em></a></div>
</form>
</div>
<div id="wb_Image1" style="position:absolute;left:26px;top:9px;width:48px;height:48px;z-index:24;">
<img src="images/locataire_plus.png" id="Image1" alt=""></div>
<div id="Html1" style="position:absolute;left:76px;top:9px;width:120px;height:23px;z-index:25">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
</div>
</body>
</html>