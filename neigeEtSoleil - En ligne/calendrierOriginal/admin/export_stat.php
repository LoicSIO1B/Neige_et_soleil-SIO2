<?php
session_start();

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
    require("secure_connexion.php");

$separateur  = "" ;
$affiche_info = "";

// test si demande ajout d'un locataire*****************************************************************************
if ( isset($_POST['Générer']) && ($_POST['Générer']) == 'Générer' ) {

  $liste_couleur = '';
  $liste_couleur = $_POST['couleur'];  

  extract($_POST);

  include("genere/genere_selection_utilisateur.php");
 
  if ( AVEC_BDD )
     include("genere/genere_export_stat_avec_bdd.php");
  else
     include("genere/genere_export_stat_sans_bdd.php");

}  

  include("fichier_calendrier/calendrier_selection_utilisateur.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Ajout</title>
<meta name="generator" content="WYSIWYG Web Builder - http://www.wysiwygwebbuilder.com">
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="export_stat.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
<script type="text/javascript">
function Validateformulaire(theForm)
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
   if (theForm.Editbox1.value.length < 1)
   {
      alert("Vous devez indiquez une date de début de période ( cliquez sur le lien choisir) !");
      theForm.Editbox1.focus();
      return false;
   }
   if (theForm.Editbox2.value.length < 1)
   {
      alert("Vous devez indiquez une date de fin de période ( cliquez sur le lien choisir) !");
      theForm.Editbox2.focus();
      return false;
   }
   return true;
}
</script>
<script type="text/javascript" src="wwb11.min.js"></script>
<link rel="stylesheet" href="fichier_calendrier/styles.css?version=<?php echo filemtime('fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >

<script>
 function PostSelect(liste){

 // On modifie l'ID du champ select pour que PHP traite cette
 // dernière comme un array
 document.forms[formulaire].elements.couleur.name = "couleur[]";

 // On soumet le formulaire
 document.forms[formulaire].submit();
 }
 </script>



</head>
<body>
<div id="space"><br></div>
<div id="container">
<table style="position:absolute;left:1px;top:1px;width:746px;height:475px;z-index:44;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_formulaire" style="position:absolute;left:11px;top:26px;width:720px;height:434px;z-index:45;">
<form name="formulaire" method="post" action="export_stat.php" id="formulaire" onsubmit="if(!Validateformulaire(this)) return false;PostSelect(this.name);return false;return false;">
<div id="wb_Text1" style="position:absolute;left:17px;top:18px;width:165px;height:18px;text-align:right;z-index:0;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Séparateur de champs</strong></span></div>
<div id="wb_Text7" style="position:absolute;left:16px;top:267px;width:150px;height:18px;text-align:right;z-index:1;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong><u>Inclure :</u></strong></span></div>
<input type="submit" id="Button2" name="Générer" value="Générer" style="position:absolute;left:181px;top:389px;width:96px;height:25px;z-index:2;" tabindex="6">
<input type="button" id="Button1" onclick="parent.parent.location = 'listing.php' ;return false;" name="" value="Fermer" style="position:absolute;left:403px;top:389px;width:96px;height:25px;z-index:3;" tabindex="6">
<input type="text" id="nom" style="position:absolute;left:188px;top:13px;width:177px;height:20px;line-height:20px;z-index:4;" name="separateur" value="<?php echo $separateur; ?>" tabindex="1">
<input type="checkbox" id="Checkbox1" name="tabulation" value="oui" checked style="position:absolute;left:375px;top:18px;z-index:5;">
<div id="wb_Text2" style="position:absolute;left:393px;top:17px;width:165px;height:18px;z-index:6;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Tabulation</strong></span></div>
<input type="checkbox" id="Checkbox2" name="nom" value="oui" checked style="position:absolute;left:185px;top:270px;z-index:7;">
<div id="wb_Text3" style="position:absolute;left:203px;top:269px;width:165px;height:18px;z-index:8;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Nom</strong></span></div>
<input type="checkbox" id="Checkbox3" name="prenom" value="oui" checked style="position:absolute;left:185px;top:290px;z-index:9;">
<div id="wb_Text4" style="position:absolute;left:203px;top:289px;width:165px;height:18px;z-index:10;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Prénom</strong></span></div>
<input type="checkbox" id="Checkbox4" name="adresse" value="oui" checked style="position:absolute;left:185px;top:312px;z-index:11;">
<div id="wb_Text5" style="position:absolute;left:203px;top:311px;width:165px;height:18px;z-index:12;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Adresse</strong></span></div>
<input type="checkbox" id="Checkbox5" name="code_postal" value="oui" checked style="position:absolute;left:185px;top:333px;z-index:13;">
<div id="wb_Text6" style="position:absolute;left:203px;top:332px;width:165px;height:18px;z-index:14;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Code postal</strong></span></div>
<input type="checkbox" id="Checkbox6" name="commune" value="oui" checked style="position:absolute;left:185px;top:355px;z-index:15;">
<div id="wb_Text8" style="position:absolute;left:203px;top:354px;width:165px;height:18px;z-index:16;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Commune</strong></span></div>
<input type="checkbox" id="Checkbox7" name="pays" value="oui" checked style="position:absolute;left:367px;top:269px;z-index:17;">
<div id="wb_Text9" style="position:absolute;left:383px;top:268px;width:165px;height:18px;z-index:18;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Pays</strong></span></div>
<input type="checkbox" id="Checkbox8" name="email" value="oui" checked style="position:absolute;left:367px;top:312px;z-index:19;">
<div id="wb_Text10" style="position:absolute;left:385px;top:312px;width:165px;height:18px;z-index:20;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Email</strong></span></div>
<input type="checkbox" id="Checkbox9" name="mailing_list" value="oui" checked style="position:absolute;left:367px;top:354px;z-index:21;">
<div id="wb_Text11" style="position:absolute;left:385px;top:354px;width:165px;height:18px;z-index:22;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Inscription liste email</strong></span></div>
<input type="checkbox" id="Checkbox10" name="telephone" value="oui" checked style="position:absolute;left:367px;top:290px;z-index:23;">
<div id="wb_Text12" style="position:absolute;left:383px;top:289px;width:165px;height:18px;z-index:24;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Téléphone</strong></span></div>
<input type="checkbox" id="Checkbox11" name="commentaire" value="oui" checked style="position:absolute;left:367px;top:333px;z-index:25;">
<div id="wb_Text13" style="position:absolute;left:385px;top:333px;width:165px;height:18px;z-index:26;text-align:left;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Commentaires</strong></span></div>
<div id="wb_Text15" style="position:absolute;left:29px;top:152px;width:138px;height:18px;text-align:right;z-index:27;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Couleur</strong></span></div>
<div id="wb_Text16" style="position:absolute;left:16px;top:238px;width:152px;height:18px;text-align:right;z-index:28;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Dans la période du </strong></span></div>
<input type="text" id="Editbox1" onclick="document.getElementById('choix_date_debut').value='';return false;" style="position:absolute;left:185px;top:234px;width:118px;height:22px;line-height:22px;z-index:29;" name="choix_date_debut" value="<?php  echo $choix_date_debut; ?>" readonly>
<div id="wb_Image2" style="position:absolute;left:304px;top:226px;width:43px;height:43px;z-index:30;">
<a href="javascript:popupwnd('date-picker.php?idcible=choix_date_debut','no','no','no','yes','yes','no','50','50','650','850')" target="_self"><img src="images/date-picker3.png" id="Image2" alt="Choisir une date" title="Choisir une date"></a></div>
<div id="wb_Text17" style="position:absolute;left:369px;top:238px;width:27px;height:18px;text-align:right;z-index:31;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>au</strong></span></div>
<input type="text" id="Editbox2" onclick="document.getElementById('choix_date_fin').value='';return false;" style="position:absolute;left:403px;top:234px;width:118px;height:22px;line-height:22px;z-index:32;" name="choix_date_fin" value="<?php echo $choix_date_fin; ?>" readonly>
<div id="wb_Image3" style="position:absolute;left:523px;top:225px;width:43px;height:43px;z-index:33;">
<a href="javascript:popupwnd('date-picker.php?idcible=choix_date_fin','no','no','no','yes','yes','no','50','50','650','850')" target="_self"><img src="images/date-picker3.png" id="Image3" alt="Choisir une date" title="Choisir une date"></a></div>
<div id="Html2" style="position:absolute;left:13px;top:110px;width:155px;height:22px;z-index:34">
<?php
echo '<div id="wb_Text1" align="right"><font style="font-size:15px" color="#4B4B4B" face="Arial"><b>',$item1,'</b></font></div>';
?></div>
<div id="Html3" style="position:absolute;left:184px;top:110px;width:314px;height:22px;z-index:35">
<?php

liste_box ("logement",300,$nom_logement,"",false,$choix_selection_logement,false,"");

?></div>
<div id="wb_Text14" style="position:absolute;left:16px;top:77px;width:151px;height:18px;text-align:right;z-index:36;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Le locataire</strong></span></div>
<div id="Html4" style="position:absolute;left:184px;top:76px;width:315px;height:22px;z-index:37">
<?php

liste_box ("locataire",300,$nom_locataire,$prenom_locataire,false,$choix_selection_locataire,true,"");

?></div>
<div id="wb_Text18" style="position:absolute;left:18px;top:47px;width:165px;height:18px;text-align:right;z-index:38;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Format des dates&nbsp; </strong></span></div>
<select name="format_date_export" size="1" id="Combobox1" style="position:absolute;left:187px;top:46px;width:184px;height:24px;z-index:39;" >
<option value="JJ/MM/AAAA" <?php if ( $format_date_export == 'JJ/MM/AAAA') echo 'selected'; ?> >JJ/MM/AAAA</option>
<option value="AAAA/MM/JJ" <?php if ( $format_date_export == 'AAAA/MM/JJ') echo 'selected'; ?> >AAAA/MM/JJ</option>
<option value="JJ-MM-AAAA" <?php if ( $format_date_export == 'JJ-MM-AAAA') echo 'selected'; ?> >JJ-MM-AAAA</option>
<option value="AAAA-MM-JJ" <?php if ( $format_date_export == 'AAAA-MM-JJ') echo 'selected'; ?> >AAAA-MM-JJ</option>
</select>
<div id="Html5" style="position:absolute;left:185px;top:145px;width:315px;height:28px;z-index:40">
<?php 
     echo '<font style="font-size:16px" color="#FFFFFF" face="Arial" >
           <select name="couleur[]" id="couleur[]" multiple size="3" id="Combobox1"  style="font-family:Arial;font-size:16px;color:#FFFFFF;background-color:#000000;width:200px;"></font>';
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
<div id="wb_Extension4" style="position:absolute;left:284px;top:392px;width:21px;height:21px;z-index:41;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Si le fichier est correctement généré, le téléchargement se lancera tout seul.</font></em></a></div>
<div id="wb_Extension2" style="position:absolute;left:146px;top:288px;width:21px;height:21px;z-index:42;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Cochez les différents éléments qui doivent apparaître dans le fichier CSV.</font></em></a></div>
<div id="wb_Extension1" style="position:absolute;left:476px;top:17px;width:21px;height:21px;z-index:43;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Le séparateur de champs est un caractère qui va séparer toutes les colonnes du fichier csv.<br>
C'est le séparateur de champs qui va vous permettre d'importer le fichier CSV par un logiciel tableur qui pourra reconnaître ainsi les différentes colonnes.<br>
</font><font style="font-size:13px" color="#FF6820" face="MS Sans Serif"><b>Le séparateur de champs n'est pas obligatoire, généralement la tabulation comme séparateur de champs suffit.</b></font></em></a></div>
</form>
</div>
<div id="wb_Image1" style="position:absolute;left:0px;top:4px;width:48px;height:48px;z-index:46;">
<img src="images/stat_csv.png" id="Image1" alt=""></div>
<div id="Html1" style="position:absolute;left:56px;top:9px;width:120px;height:23px;z-index:47">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<div id="wb_Extension3" style="position:absolute;left:153px;top:196px;width:21px;height:21px;z-index:48;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Sélectionnez le ou les marqueurs de couleurs qui doivent être pris en compte dans le fichier CSV.<br>
Pour sélectionner plusieurs mrauqueurs, cliquez sur les couleurs de votre choix en maintenant la touche &quot;CTRL&quot; enfoncée.</font></em></a></div>
</div>
</body>
</html>