<?php

session_start();

$affiche_info = '';

//*************************************************************************
//initialisation des variables ********************************************
//*************************************************************************

//chemin relatif depuis la page apellante vers le repertoire admin du calendrier
$chemin_relatif_admin = 'admin/' ;
//affichage des erreurs *************************************************
$affiche_erreur = true;
//avec envoi des informations par email **********************
$envoi_mail_formulaire = true;
//email destinataire du message *****************************************
$email_destinataire = 'elodemoniaque@hotmail.com>';
//$email_destinataire = 'mathieu.munch@wanadoo.fr';
//sujet de l'email ******************************************************
$sujet_email = ' Message depuis le site La route des grands crus ';
//sujet de l'email ******************************************************
$entete_email = 'Contenu du formulaire : ';
//adresse de la page vers laquelle redirigée en cas succès **************
// inscrire $url_succes = '';   pour ne pas faire de redirection
$url_succes = '';

//inclusion du fichier avec les fonctions ******************
include ($chemin_relatif_admin."fonction.php");

//********************************************************************************
// marquage de plusieurs jours****************************************************
//********************************************************************************
  if ( (isset($_POST['Envoyer']) && $_POST['Envoyer'] == 'Envoyer')   ) {

   //controle php des informations du formulaire ********************************
   $test_post_debut = test_date_fr ($_POST['date_debut']);
   $test_post_fin = test_date_fr ($_POST['date_fin']);
   $compare_date = nb_jour_date ($_POST['date_debut'],$_POST['date_fin'],"/","fr");

   if ( isset($_POST['code_controle'],$_SESSION['random_txt']) && md5($_POST['code_controle']) == $_SESSION['random_txt'] ) {

     unset($_POST['code_controle'],$_SESSION['random_txt']);

   if (   $_POST['nom'] <> '' && $_POST['prenom'] <> '' && $_POST['telephone'] <> ''  && $_POST['telephone'] <> ' ' && ctrl_email($_POST['email'])) {
      
     
     $_POST['IP Address'] = $_SERVER['REMOTE_ADDR'];

     $exclus_champs = array ("Envoyer","pays");

     // envoi mail si succes insertion date et demande de confirmation par email ****
     $execution_mail = envoi_email($email_destinataire,$_POST['email'],$sujet_email.'-'.$_POST['nom'].' '.$_POST['prenom'],$entete_email,$_POST,$exclus_champs,$affiche_erreur,'','');
    
     // redirection en cas de succes *******************************
     if ( isset($execution) && $execution && !empty($url_succes) ){
         header('Location: '.$url_succes);
         exit;
         }
     
    }
   }
   
   else
   
     echo '<font style="font-size:20px" color="#FF0000" face="Verdana"><b>Le code de vérification est incorrect veuillez recommencer!!</b></font><br> ';

   if ( isset($execution_mail) && $execution_mail )
     echo '<font style="font-size:20px" color="#FF0000" face="Verdana"><b>Votre message a été envoyé</b></font><br> ';
   else
     echo '<font style="font-size:20px" color="#FF0000" face="Verdana"><b>Le message n\'as pas pu être envoyés, veuillez recommencer</b></font><br>';

 }

//****************************************************************************
// fin du module de recherche de disponibilites ******************************
//****************************************************************************
header( 'content-type: text/html; charset=ISO-8859-1' );

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Exemple module insertion date formulaire visiteur</title>
<meta name="description" content="Exemple module insertion date formulaire depuis le formulaire visiteur, avec possibilité d'ajout du locataire dans la base.">
<meta name="generator" content="http://www.mathieuweb.fr/calendrier/">
<link href="icone_cal.ico" rel="shortcut icon">
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="formulaire.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function ValidateForm1(theForm)
{
   var regexp;
   if (theForm.date_debut.value == "")
   {
      alert("Please enter a value for the \"date_debut\" field.");
      theForm.date_debut.focus();
      return false;
   }
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖØÙÚÛÜİŞßàáâãäåæçèéêëìíîïğñòóôõöøùúûüışÿ]*$/;
   if (!regexp.test(theForm.nom.value))
   {
      alert("Veuillez renseigner votre nom !");
      theForm.nom.focus();
      return false;
   }
   if (theForm.nom.value == "")
   {
      alert("Veuillez renseigner votre nom !");
      theForm.nom.focus();
      return false;
   }
   if (theForm.nom.value.length < 2)
   {
      alert("Veuillez renseigner votre nom !");
      theForm.nom.focus();
      return false;
   }
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖØÙÚÛÜİŞßàáâãäåæçèéêëìíîïğñòóôõöøùúûüışÿ]*$/;
   if (!regexp.test(theForm.prenom.value))
   {
      alert("Veuillez renseigner votre prénom !");
      theForm.prenom.focus();
      return false;
   }
   if (theForm.prenom.value == "")
   {
      alert("Veuillez renseigner votre prénom !");
      theForm.prenom.focus();
      return false;
   }
   if (theForm.prenom.value.length < 2)
   {
      alert("Veuillez renseigner votre prénom !");
      theForm.prenom.focus();
      return false;
   }
   regexp = /^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i;
   if (!regexp.test(theForm.email.value))
   {
      alert("Votre email n'est pas ou mal renseigné !");
      theForm.email.focus();
      return false;
   }
   if (theForm.email.value == "")
   {
      alert("Votre email n'est pas ou mal renseigné !");
      theForm.email.focus();
      return false;
   }
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖØÙÚÛÜİŞßàáâãäåæçèéêëìíîïğñòóôõöøùúûüışÿ]*$/;
   if (!regexp.test(theForm.telephone.value))
   {
      alert("Veuillez saisir votre numéro de téléphone");
      theForm.telephone.focus();
      return false;
   }
   if (theForm.telephone.value == "")
   {
      alert("Veuillez saisir votre numéro de téléphone");
      theForm.telephone.focus();
      return false;
   }
   if (theForm.telephone.value.length < 5)
   {
      alert("Veuillez saisir votre numéro de téléphone");
      theForm.telephone.focus();
      return false;
   }
   return true;
}
</script>
<script type="text/javascript" src="wwb9.min.js"></script>
<script type="text/javascript" src="admin/fonction.js"></script>

</head>
<body style="background-color:transparent">
<div id="container">
<div id="wb_MasterPage3" style="position:absolute;left:2px;top:0px;width:964px;height:110px;z-index:19;">
</div>
<div id="wb_Text2" style="position:absolute;left:17px;top:33px;width:639px;height:23px;z-index:20;text-align:left;">
<span style="color:#0080FF;font-family:Verdana;font-size:19px;"><strong>Renseignements / réservations :</strong></span></div>
<div id="wb_Form1" style="position:absolute;left:14px;top:66px;width:646px;height:519px;z-index:21;">
<form name="Form1" method="post" action="#" id="Form1" onsubmit="return ValidateForm1(this)">
<div id="wb_Text1" style="position:absolute;left:15px;top:21px;width:209px;height:18px;text-align:right;z-index:0;">
<span style="color:#000000;font-family:Verdana;font-size:16px;"><strong>Date d'arrivée</strong></span></div>
<input type="text" id="date_debut" onclick="alert('Veuillez sélectionner une date en cliquant sur le calendrier à coté du champs');return false;" style="position:absolute;left:232px;top:18px;width:155px;height:18px;line-height:18px;z-index:1;" name="date_debut" value="<?php if (isset($_POST['date_debut'] ) ) echo $_POST['date_debut']; ?>" tabindex="1" readonly autocomplete="off" onfocus="bordure_formulaire('date_debut','oui');return false;" onblur="bordure_formulaire('date_debut','non');return false;">
<div id="wb_Image1" style="position:absolute;left:391px;top:6px;width:43px;height:43px;z-index:2;">
<a href="javascript:popupwnd('date-picker.php?idcible=date_debut&logement=1','no','no','no','yes','yes','no','50','50','750','650')" target="_self"><img src="images/img0048.png" id="Image1" alt="Choisir une date" title="Choisir une date" style="width:43px;height:43px;"></a></div>
<div id="wb_Text4" style="position:absolute;left:17px;top:60px;width:207px;height:18px;text-align:right;z-index:3;">
<span style="color:#000000;font-family:Verdana;font-size:16px;"><strong>Date départ</strong></span></div>
<input type="text" id="date_fin" onclick="alert('Veuillez sélectionner une date en cliquant sur le calendrier à coté du champs');return false;" style="position:absolute;left:232px;top:57px;width:155px;height:18px;line-height:18px;z-index:4;" name="date_fin" value="<?php if (isset($_POST['date_fin'] ) ) echo $_POST['date_fin']; ?>" tabindex="2" readonly autocomplete="off" onfocus="bordure_formulaire('date_fin','oui');return false;" onblur="bordure_formulaire('date_fin','non');return false;">
<div id="wb_Image2" style="position:absolute;left:391px;top:45px;width:43px;height:43px;z-index:5;">
<a href="javascript:popupwnd('date-picker.php?idcible=date_fin&logement=1','no','no','no','yes','yes','no','50','50','750','600')" target="_self"><img src="images/img0049.png" id="Image2" alt="Choisir une date" title="Choisir une date" style="width:43px;height:43px;"></a></div>
<input type="submit" id="Button1" name="Envoyer" value="Envoyer" style="position:absolute;left:235px;top:473px;width:96px;height:25px;z-index:6;">
<div id="wb_Text3" style="position:absolute;left:48px;top:108px;width:174px;height:18px;text-align:right;z-index:7;">
<span style="color:#000000;font-family:Verdana;font-size:16px;"><strong>Nom</strong></span></div>
<input type="text" id="nom" style="position:absolute;left:232px;top:105px;width:198px;height:18px;line-height:18px;z-index:8;" name="nom" value="<?php if (isset($_POST['nom'] ) ) echo $_POST['nom']; ?>" tabindex="3" onfocus="bordure_formulaire('nom','oui');return false;" onblur="bordure_formulaire('nom','non');return false;">
<div id="wb_Text5" style="position:absolute;left:55px;top:140px;width:168px;height:18px;text-align:right;z-index:9;">
<span style="color:#000000;font-family:Verdana;font-size:16px;"><strong>Prénom </strong></span></div>
<input type="text" id="prenom" style="position:absolute;left:232px;top:137px;width:198px;height:18px;line-height:18px;z-index:10;" name="prenom" value="<?php if (isset($_POST['prenom'] ) ) echo $_POST['prenom']; ?>" tabindex="4" onfocus="bordure_formulaire('prenom','oui');return false;" onblur="bordure_formulaire('prenom','non');return false;">
<textarea name="message" id="commentaire" style="position:absolute;left:232px;top:251px;width:396px;height:151px;z-index:11;" rows="8" cols="45" tabindex="7" onfocus="bordure_formulaire('message','oui');return false;" onblur="bordure_formulaire('message','non');return false;"><?php if (isset($_POST['message'] ) ) echo $_POST['message']; ?></textarea>
<div id="wb_Text6" style="position:absolute;left:53px;top:255px;width:168px;height:18px;text-align:right;z-index:12;">
<span style="color:#000000;font-family:Verdana;font-size:16px;"><strong>Message</strong></span></div>
<div id="wb_page9Text1" style="position:absolute;left:48px;top:175px;width:174px;height:18px;text-align:right;z-index:13;">
<span style="color:#000000;font-family:Verdana;font-size:16px;"><strong>Email</strong></span></div>
<input type="text" id="email" style="position:absolute;left:232px;top:172px;width:198px;height:18px;line-height:18px;z-index:14;" name="email" value="<?php if (isset($_POST['email'] ) ) echo $_POST['email']; ?>" tabindex="5" onfocus="bordure_formulaire('email','oui');return false;" onblur="bordure_formulaire('email','non');return false;">
<div id="wb_page9Text2" style="position:absolute;left:55px;top:206px;width:168px;height:18px;text-align:right;z-index:15;">
<span style="color:#000000;font-family:Verdana;font-size:16px;"><strong>Téléphone</strong></span></div>
<input type="text" id="telephone" style="position:absolute;left:232px;top:204px;width:198px;height:18px;line-height:18px;z-index:16;" name="telephone" value="<?php if (isset($_POST['telephone'] ) ) echo $_POST['telephone']; ?>" tabindex="6" onfocus="bordure_formulaire('telephone','oui');return false;" onblur="bordure_formulaire('telephone','non');return false;">
<div id="wb_page9Text3" style="position:absolute;left:25px;top:422px;width:197px;height:36px;text-align:right;z-index:17;">
<span style="color:#000000;font-family:Verdana;font-size:16px;"><strong>Veuillez recopier le code de vérification</strong></span></div>
<div id="formulaireHtml1" style="position:absolute;left:234px;top:423px;width:358px;height:34px;z-index:18">
<img src="code_controle.php" alt="Cliquer pour une nouvelle image" title="Cliquer pour une nouvelle image" style="cursor:pointer;width:100px;height:38px;" onclick="this.src='affiche_code.php?'+Math.random()">
<input type="text" id="code_controle" style="width:100px;height:18px;border:1px #C0C0C0 solid;font-family:Arial;font-size:13px;" name="code_controle" value=""></div>
</form>
</div>
<div id="Html4" style="position:absolute;left:172px;top:1px;width:274px;height:10px;z-index:22">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
</div>
</body>
</html>