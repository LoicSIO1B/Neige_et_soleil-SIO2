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

$_SESSION['compteur_page'] = 0;

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
<meta name="generator" content="WYSIWYG Web Builder - http://www.wysiwygwebbuilder.com">
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="imprime_locataire.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="fichier_calendrier/styles.css?version=<?php echo filemtime('fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >
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
<div id="container">
<table style="position:absolute;left:2px;top:3px;width:982px;height:692px;z-index:0;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><table width="100%" border="0" cellpadding="0" cellspacing="1" id="Table1">
<tr>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Nom Locataire</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Téléphone</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Email</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Adresse</B></font></td>

</tr>

<?php

$couleur_tab = "#DBE4EE";
$memoire_locataire = '';
$cle_fichier ='';
$memoire_premiere_lettre = '';

 $nb_result = count ($nom_locataire);
 if ( $nb_result > 0 ) {
 $memoire_locataire = $nom_locataire;
 //tri par ordre alphabétique
 usort($memoire_locataire , "strcasecmp");

 foreach ($memoire_locataire as $cle => $val_locataire )  {
   //recherche cle fichier 
  foreach ($nom_locataire as $cle_temp => $val_temp ) {
      if ( $val_locataire == $val_temp )
        $cle_fichier = $cle_temp;
  }

  if ( $cle_fichier <> 0 ) {

  $premiere_lettre = substr(stripslashes($val_locataire), 0, 1); 
  if ( $premiere_lettre <> $memoire_premiere_lettre)
      echo '<tr><td align="left" valign="middle" bgcolor ="#F4F4F4" colspan ="4"><a name="',ucfirst($premiere_lettre),'"><font style="font-size:21px" color="#00C4FD" face="Arial"><b>',ucfirst($premiere_lettre),'...</b></font></a></td>
     </tr>'; 

   $le_pays = $pays_locataire[$cle_fichier];

   echo '<tr><td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',stripslashes($val_locataire),' ',stripslashes($prenom_locataire[$cle_fichier]),'</font></td>

        <td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial">',stripslashes($telephone_locataire[$cle_fichier]),'</font></td>

        <td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial"><a href="mailto:',stripslashes($email_locataire[$cle_fichier]),'" class = style_lien>',stripslashes($email_locataire[$cle_fichier]),'</a></font></td> 

    <td align="center" valign="center" bgcolor =',$couleur_tab,'><font color="#000000" style="font-size:14px" face="Arial"> ',$adresse_locataire[$cle_fichier],'<br> ',$code_locataire[$cle_fichier],' ',$commune_locataire[$cle_fichier],' ',$tableau_pays[$le_pays],'</font></td>

        ';

   $memoire_premiere_lettre = ucfirst($premiere_lettre);
}

 }
}
?>

</table><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_haut" style="position:absolute;left:2px;top:3px;width:18px;height:18px;z-index:1;">
<a id="haut" style="visibility:hidden">&nbsp;</a>
</div>
</div>
</body>
</html><?php

 if ( $avec_compression_page )
    ob_end_flush();

?>