<?php
session_start();

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_connexion.php");

$separateur  = ";" ;
$liste_email = "";

// test si demande ajout d'un locataire*****************************************************************************
if ( isset($_POST['Afficher']) && ($_POST['Afficher']) == 'Afficher' ) {

  extract($_POST);

}  

  $nb_result = count ($nom_locataire);  
  if ( $nb_result > 0 ) {
  foreach ($nom_locataire as $cle => $nom_loc )  {
      if ( $cle <> 0 && $mailing_list_ok[$cle] && $email_locataire[$cle] <> '')
           $liste_email .= $email_locataire[$cle]." ".$separateur." " ;
      }
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
<link href="liste_mailing.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function Validateliste_mailing(theForm)
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


</head>
<body>
<div id="space"><br></div>
<div id="container">
<table style="position:absolute;left:1px;top:1px;width:746px;height:475px;z-index:7;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Form2" style="position:absolute;left:9px;top:35px;width:720px;height:423px;z-index:8;">
<form name="liste_mailing" method="post" action="" id="Form2" onsubmit="return Validateliste_mailing(this)">
<div id="wb_Text1" style="position:absolute;left:25px;top:25px;width:156px;height:18px;text-align:right;z-index:0;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Séparateur d'email</strong></span></div>
<div id="wb_Text7" style="position:absolute;left:30px;top:63px;width:150px;height:18px;text-align:right;z-index:1;">
<span style="color:#4B4B4B;font-family:Arial;font-size:15px;"><strong>Commentaires</strong></span></div>
<input type="submit" id="Button2" name="Afficher" value="Afficher" style="position:absolute;left:187px;top:383px;width:96px;height:25px;z-index:2;" tabindex="6">
<input type="button" id="Button1" onclick="parent.parent.location = 'locataire.php' ;return false;" name="" value="Fermer" style="position:absolute;left:491px;top:383px;width:96px;height:25px;z-index:3;" tabindex="6">
<textarea name="liste" id="commentaire" style="position:absolute;left:188px;top:62px;width:413px;height:297px;z-index:4;" rows="15" cols="39" tabindex="8" readonly><?php

echo $liste_email;

?></textarea>
<input type="text" id="nom" style="position:absolute;left:187px;top:20px;width:326px;height:20px;line-height:20px;z-index:5;" name="separateur" value="<?php echo $separateur; ?>" tabindex="1">
<div id="wb_Extension1" style="position:absolute;left:523px;top:22px;width:21px;height:21px;z-index:6;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Le séparateur de champs est un caractère qui va séparrer tous les emails.<br>
</font><font style="font-size:13px" color="#FF6820" face="MS Sans Serif"><b>Le séparateur de champs le plus utilisés par les messageries est le ;</b></font></em></a></div>
</form>
</div>
<div id="wb_Image1" style="position:absolute;left:11px;top:7px;width:48px;height:48px;z-index:9;">
<img src="images/export_liste_email.png" id="Image1" alt=""></div>
<div id="Html1" style="position:absolute;left:81px;top:7px;width:120px;height:23px;z-index:10">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
</div>
</body>
</html>