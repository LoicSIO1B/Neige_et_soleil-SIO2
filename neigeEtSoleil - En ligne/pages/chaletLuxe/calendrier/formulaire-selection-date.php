<?php
header( 'content-type: text/html; charset=ISO-8859-1' );

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Exemple sélecteur de date pour formulaire, date picker</title>
<meta name="description" content="Exemple d'utilisation du selecteur de date pour formulaire, avec jour cliquable ou non selon la couleur de la date">
<meta name="generator" content="http://www.mathieuweb.fr/calendrier/">
<link href="icone_cal.ico" rel="shortcut icon">
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="formulaire-selection-date.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="wwb9.min.js"></script>
</head>
<body>
<div id="container">
<table style="position:absolute;left:4px;top:10px;width:894px;height:472px;z-index:0;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td style="background-color:#FBFBFB;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:456px;"><?php



?><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_MasterPage3" style="position:absolute;left:2px;top:0px;width:964px;height:110px;z-index:1;">
</div>
<div id="wb_Text2" style="position:absolute;left:18px;top:29px;width:847px;height:272px;z-index:2;text-align:left;">
<span style="color:#0080FF;font-family:Verdana;font-size:19px;"><strong>Cette page est un exemple d'utilisation du sélecteur de date pour formulaire ( date picker).</strong></span><span style="color:#000000;font-family:Verdana;font-size:19px;"><strong><br><br></strong></span><span style="color:#000000;font-family:Verdana;font-size:16px;"><strong><u>Principe :</u> <br><br>- En cliquant sur le calendrier à coté du champs ci dessous, une fenêtre popup s'ouvre en affichant le calendrier de la location voulue avec ces disponibilités.<br><br>- le champs du formulaire sera remplie par la date cliquée.<br><br>- dans l'espace d'administration du calendrier, vous pouvez déterminier via les paramètres des couleurs des marqueurs, si les dates marquées peuvent être cliquable ou non.<br><br></strong></span><span style="color:#0080FF;font-family:Verdana;font-size:19px;"><strong>Démonstration</strong></span></div>
<input type="text" id="date" style="position:absolute;left:314px;top:335px;width:155px;height:18px;line-height:18px;z-index:3;" name="date" value="">
<div id="wb_Text1" style="position:absolute;left:214px;top:338px;width:92px;height:18px;text-align:right;z-index:4;">
<span style="color:#000000;font-family:Verdana;font-size:16px;"><strong>Date</strong></span></div>
<div id="wb_Image1" style="position:absolute;left:473px;top:323px;width:43px;height:43px;z-index:5;">
<a href="javascript:popupwnd('date-picker.php?idcible=date&logement=1','no','no','no','yes','yes','no','50','50','750','650')" target="_self"><img src="images/img0043.png" id="Image1" alt="Choisir une date" title="Choisir une date" style="width:43px;height:43px;"></a></div>
<div id="wb_Text3" style="position:absolute;left:32px;top:387px;width:419px;height:18px;z-index:6;text-align:left;">
<span style="color:#000000;font-family:Verdana;font-size:16px;"><strong>Plus d'informations, <a href="http://www.mathieuweb.fr/calendrier/calendrier.php" target="_blank" class="style3">page documentation </a></strong></span></div>
</div>
</body>
</html>