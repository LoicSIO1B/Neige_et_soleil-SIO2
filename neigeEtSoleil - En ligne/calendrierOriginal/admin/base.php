<?php
session_start();

$effacement_ok = false;
$affiche_info = '';

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
 require("secure_connexion.php");

//insertion des langues ************************************************
     include("fichier_calendrier/langue.php");

 $date_annee = date("Y"); 

// test si demande effacement date*****************************************************************************
if ( isset($_POST['Effacer']) && ($_POST['Effacer']) == 'Effacer' && !MODE_DEMO ) {
  extract($_POST);
  $date_temp = ajout_supprime_zero (date_fr_eng($choix_date,"/","-"),"Ajout","-","eng");

  if ( AVEC_BDD ) {
  $connect = @mysql_connect(Decrypte(hote_cal,$Cle), Decrypte(user_cal,$Cle), Decrypte(password_cal,$Cle)); 
  $connect_base = @mysql_select_db(Decrypte(base_cal,$Cle), $connect) ;

  $req_log = '';
  $req_loc = '';
  if ( $locataire <> 0 )
      $req_loc = "and id_locataire = '$locataire' ";
  if ( $logement <> 0 )
      $req_log = "and id_logement = '$logement' ";

  $req_sql = "delete from ".Decrypte(nom_table_cal,$Cle)." where date_reservation < '$date_temp' $req_loc $req_log";
  $etat_req = @mysql_query($req_sql);
  }
  // fonctionnement sans base de données ***********************************************
  else {
  include("supprime_date_base.php");
  }

  if ( $etat_req ) 
     $affiche_info = 'efface_date_ok';
  else
     $affiche_info = 'erreur_execution';
  
}  


// test si demande restauration*****************************************************************************
if ( isset($_GET['fct']) && !is_numeric($_GET['fct']) &&  !(empty($_GET['fct'])) &&  isset($_GET['num']) && is_numeric($_GET['num']) ) {

  $num_restaure = $_GET['num'] ;
  $fonction = $_GET['fct'] ;

//fonction restaurer **************************

  if ( $fonction == 'restaurer' && !MODE_DEMO ) {

  $chemin_fichier = 'fichier_calendrier/dates_sans_bdd/'.$num_restaure.'_calendrier.php';
  $chemin_fichier_sauvegarde = 'fichier_calendrier/dates_sans_bdd/'.$num_restaure.'_sauvegarde_calendrier.php';
  if ( file_exists($chemin_fichier) && file_exists($chemin_fichier_sauvegarde) ) {
        @unlink($chemin_fichier );
        $restauration_liste = @copy($chemin_fichier_sauvegarde,$chemin_fichier);
        if ( $restauration_liste ) 
            $affiche_info = 'restaure_ok';
        else
            $affiche_info = 'erreur_execution';
    }
  }
}


// test si demande restauration*****************************************************************************
$restauration_para_cal = false;
$restauration_liste = false;
if ( isset($_POST['Restaurer']) && ($_POST['Restaurer']) == 'Restaurer les paramètres du calendrier avant la dernière modification'  && !MODE_DEMO  ) {
    $chemin_fichier = "fichier_calendrier/parametres_calendrier.php";
    $chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_parametres_calendrier.php";
    if ( file_exists($chemin_fichier) && file_exists($chemin_fichier_sauvegarde) ) {
        @unlink($chemin_fichier );
        $restauration_para_cal = @copy($chemin_fichier_sauvegarde,$chemin_fichier);
        if ( $restauration_para_cal ) 
            $affiche_info = 'restaure_calendrier_ok';
        else
            $affiche_info = 'erreur_execution';
        }
    $chemin_fichier = "fichier_calendrier/styles.css";
    $chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_styles.css";
    if ( file_exists($chemin_fichier) && file_exists($chemin_fichier_sauvegarde) ) {
        @unlink($chemin_fichier );
        $restauration_para_cal = @copy($chemin_fichier_sauvegarde,$chemin_fichier);
        if ( $restauration_para_cal ) 
            $affiche_info = 'restaure_calendrier_ok';
        else
            $affiche_info = 'erreur_execution';
        }
  }
$restauration_para_cal = false;
$restauration_liste = false;
if ( isset($_POST['Restaurer']) && ($_POST['Restaurer']) == 'Restaurer les paramètres du calendrier en version originale'  && !MODE_DEMO  ) {
    $chemin_fichier = "fichier_calendrier/parametres_calendrier.php";
    $chemin_fichier_sauvegarde = "fichier_calendrier/parametres_calendrier_origine.php";

  // recupération adresse installation du script ***********
  include($chemin_fichier);
  $memoire_rep_installation = $repertoire_installation ;
  $memoire_libelle_location = $item1 ;

  // recupération parametres d'origine ***********
  include($chemin_fichier_sauvegarde);
  // mise a jour repertoire d'installation *******
  $repertoire_installation = $memoire_rep_installation ;
  $item1 =  $memoire_libelle_location;

  //chemin vers le fichier de création parametres calendrier 
  $chemin_repertoire = '';
  include("genere/genere_para_calendrier.php");

    $chemin_fichier = "fichier_calendrier/styles.css";
    $chemin_fichier_sauvegarde = "fichier_calendrier/styles_origine.css";
    if ( file_exists($chemin_fichier) && file_exists($chemin_fichier_sauvegarde) ) {
        @unlink($chemin_fichier );
        $restauration_para_cal = @copy($chemin_fichier_sauvegarde,$chemin_fichier);
        if ( $restauration_para_cal ) 
            $affiche_info = 'restaure_calendrier_ok';
        else
            $affiche_info = 'erreur_execution';
        }
  }


if ( isset($_POST['Restaurer']) && ($_POST['Restaurer']) == 'Restaurer les listes locataires avant la dernière modification'   && !MODE_DEMO   ) {
    $chemin_fichier = "fichier_calendrier/calendrier_liste_locataire.php";
    $chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_calendrier_liste_locataire.php";
    if ( file_exists($chemin_fichier) && file_exists($chemin_fichier_sauvegarde) ) {
        @unlink($chemin_fichier );
        $restauration_liste = @copy($chemin_fichier_sauvegarde,$chemin_fichier);
        if ( $restauration_liste ) 
            $affiche_info = 'restaure_ok';
        else
            $affiche_info = 'erreur_execution';
   @copy($chemin_fichier,$chemin_fichier_sauvegarde);
        }
  }

if ( isset($_POST['Restaurer']) && ($_POST['Restaurer']) == 'Restaurer les commentaires locataires avant la dernière modification'   && !MODE_DEMO   ) {
    $chemin_fichier = "fichier_calendrier/calendrier_commentaire_locataire.php";
    $chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_calendrier_commentaire_locataire.php";
    if ( file_exists($chemin_fichier) && file_exists($chemin_fichier_sauvegarde) ) {
        @unlink($chemin_fichier );
        $restauration_liste = @copy($chemin_fichier_sauvegarde,$chemin_fichier);
        if ( $restauration_liste ) 
            $affiche_info = 'restaure_ok';
        else
            $affiche_info = 'erreur_execution';
   @copy($chemin_fichier,$chemin_fichier_sauvegarde);
        }
  }

if ( isset($_POST['Restaurer_item1']) && !MODE_DEMO ) {
    $chemin_fichier = "fichier_calendrier/calendrier_liste_logement.php";
    $chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_calendrier_liste_logement.php";
    if ( file_exists($chemin_fichier) && file_exists($chemin_fichier_sauvegarde) ) {
        @unlink($chemin_fichier );
        $restauration_liste = @copy($chemin_fichier_sauvegarde,$chemin_fichier);
        if ( $restauration_liste ) 
            $affiche_info = 'restaure_ok';
        else
            $affiche_info = 'erreur_execution';
   @copy($chemin_fichier,$chemin_fichier_sauvegarde);
        }
  }

if ( isset($_POST['Restaurer']) && ($_POST['Restaurer']) == 'Restaurer les listes couleurs avant la dernière modification'  && !MODE_DEMO  ) {
    $chemin_fichier = "fichier_calendrier/calendrier_liste_couleur.php";
    $chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_calendrier_liste_couleur.php";
    if ( file_exists($chemin_fichier) && file_exists($chemin_fichier_sauvegarde) ) {
        @unlink($chemin_fichier );
        $restauration_liste = @copy($chemin_fichier_sauvegarde,$chemin_fichier);
        if ( $restauration_liste ) 
            $affiche_info = 'restaure_ok';
        else
            $affiche_info = 'erreur_execution';
   @copy($chemin_fichier,$chemin_fichier_sauvegarde);
     }
  }


if ( isset($_POST['Restaurer']) && ($_POST['Restaurer']) == 'Restaurer les langues avant la dernière modification'   && !MODE_DEMO ) {
    $chemin_fichier = "fichier_calendrier/calendrier_liste_langue.php";
    $chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_calendrier_liste_langue.php";
    if ( file_exists($chemin_fichier) && file_exists($chemin_fichier_sauvegarde) ) {
        @unlink($chemin_fichier );
        $restauration_liste = @copy($chemin_fichier_sauvegarde,$chemin_fichier);
        if ( $restauration_liste ) 
            $affiche_info = 'restaure_ok';
        else
            $affiche_info = 'erreur_execution';
   @copy($chemin_fichier,$chemin_fichier_sauvegarde);
     }

    $chemin_fichier = "fichier_calendrier/langue.php";
    $chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_langue.php";
    if ( file_exists($chemin_fichier) && file_exists($chemin_fichier_sauvegarde) ) {
        @unlink($chemin_fichier );
        $restauration_liste = @copy($chemin_fichier_sauvegarde,$chemin_fichier);
        if ( $restauration_liste ) 
            $affiche_info = 'restaure_ok';
        else
            $affiche_info = 'erreur_execution';
   @copy($chemin_fichier,$chemin_fichier_sauvegarde);
     }

  }

//***************************************************************************************
// restauration sauvegarde zip du serveur
//***************************************************************************************
if ( isset($_POST['Restaurer']) && ($_POST['Restaurer']) == 'Restaurer les fichiers depuis la sauvegarde du serveur'  && !MODE_DEMO  ) {
  require_once('genere/pclzip.lib.php');
  $archive              = new PclZip("fichier_calendrier/sauvegarde.zip");
  $tableau_fichier_zip  = $archive->extract(PCLZIP_OPT_PATH, "",
                                            PCLZIP_OPT_REPLACE_NEWER);

  //restauration sql ******
if ( AVEC_BDD ) {

    //connection a la base de donnees*******************************************************************
    $connect = @mysql_connect(Decrypte(hote_cal,$Cle), Decrypte(user_cal,$Cle), Decrypte(password_cal,$Cle));
    if (!$connect )
       echo '<font style="font-size:16px" color="#FF0000" face="Arial"><b>** Erreur de connexion au serveur sql **</b></font>' ;
    else {
    // on choisit la bonne base
    $connect_base = @mysql_select_db(Decrypte(base_cal,$Cle), $connect) ;
    if (!$connect_base )
       echo '<font style="font-size:16px" color="#FF0000" face="Arial"><b>** Erreur de connexion à la base sql **</b></font>' ;
    else {
      // vide la table ******
      $valeur_req = "TRUNCATE TABLE `".Decrypte(nom_table_cal,$Cle)."` "; 
      $requete = mysql_query ($valeur_req);
      // insertion date depuis le fichier *****
      ob_start(); // debut bufferisation
      include_once('fichier_calendrier/sauvegarde_sql.sql');
      $contenu_sql = ob_get_contents();
      ob_end_clean(); // fin de la bufferisation
      $tableau_requetes_sql = explode('--*requete***',$contenu_sql);
      foreach ( $tableau_requetes_sql as $cle => $val_requete_tableau ) {
         $requete = @mysql_query ($val_requete_tableau);
         }

      }
    }
  }

  if ( $tableau_fichier_zip <> 0 ) 
       $affiche_info = 'restaure_ok';
  else
       $affiche_info = 'erreur_execution';

  }

//***************************************************************************************
// restauration sauvegarde zip upload
//***************************************************************************************
if ( isset($_POST['Restaurer']) && ($_POST['Restaurer']) == 'Télécharger'  && !MODE_DEMO  ) {
 
  $type_fichier   = $_FILES['upload_sauvegarde']['type'];
  $nom_fichier    = $_FILES['upload_sauvegarde']['name'];
  $taille_fichier = $_FILES['upload_sauvegarde']['size'];
  $temp_fichier   = $_FILES['upload_sauvegarde']['tmp_name'];

  if( (strstr($type_fichier, 'application/octetstream') && strstr($nom_fichier, 'sauvegarde.zip')) && $taille_fichier < $_POST['MAX_FILE_SIZE'] ) {
    
    $dest_fichier   = 'fichier_calendrier/sauvegarde.zip';

    $res_copy   = move_uploaded_file($temp_fichier , $dest_fichier);
    chmod ($dest_fichier,0777);

    require_once('genere/pclzip.lib.php');
    $archive              = new PclZip("fichier_calendrier/sauvegarde.zip");
    $tableau_fichier_zip  = $archive->extract(PCLZIP_OPT_PATH, "",
                                          PCLZIP_OPT_REPLACE_NEWER);

    //restauration sql ******
    if ( AVEC_BDD ) {

    //connection a la base de donnees*******************************************************************
    $connect = @mysql_connect(Decrypte(hote_cal,$Cle), Decrypte(user_cal,$Cle), Decrypte(password_cal,$Cle));
    if (!$connect )
       echo '<font style="font-size:16px" color="#FF0000" face="Arial"><b>** Erreur de connexion au serveur sql **</b></font>' ;
    else {
    // on choisit la bonne base
    $connect_base = @mysql_select_db(Decrypte(base_cal,$Cle), $connect) ;
    if (!$connect_base )
       echo '<font style="font-size:16px" color="#FF0000" face="Arial"><b>** Erreur de connexion à la base sql **</b></font>' ;
    else {
      // vide la table ******
      $valeur_req = "TRUNCATE TABLE `".Decrypte(nom_table_cal,$Cle)."` "; 
      $requete = mysql_query ($valeur_req);
      // insertion date depuis le fichier *****
      ob_start(); // debut bufferisation
      include_once('fichier_calendrier/sauvegarde_sql.sql');
      $contenu_sql = ob_get_contents();
      ob_end_clean(); // fin de la bufferisation
      $tableau_requetes_sql = explode('--*requete***',$contenu_sql);
      foreach ( $tableau_requetes_sql as $cle => $val_requete_tableau ) {
         $requete = @mysql_query ($val_requete_tableau);
         }

      }
    }
  }


  }

  if ( isset($tableau_fichier_zip) && $tableau_fichier_zip <> 0 ) 
       $affiche_info = 'restaure_ok';
  else
       $affiche_info = 'erreur_upload_zip';

  }

//***************************************************************************************
// creation sauvegarde zip
//***************************************************************************************
if ( isset($_POST['Sauvegarder']) && ($_POST['Sauvegarder']) == 'Créer une sauvegarde ZIP des fichiers'  && !MODE_DEMO  ) {

 // si avec bdd, creation fichier sql *******

 if ( AVEC_BDD ) {
    include('genere/genere_export_sql.php');
 }

 // creation fichier zip **************
    require_once('genere/pclzip.lib.php');
    $archive              = new PclZip('fichier_calendrier/sauvegarde.zip');
    $action = $archive->create('fichier_calendrier');
    $archive->delete(PCLZIP_OPT_BY_NAME, 'fichier_calendrier/sauvegarde.zip');
    $archive->delete(PCLZIP_OPT_BY_NAME, 'fichier_calendrier/.htaccess');
    if ($action == 0) 
       $affiche_info = 'creation_zip_erreur';
    else
       $affiche_info = 'creation_zip_ok';
  }

//récupération date des fichiers ***************************************************************************
$chemin_fichier = "fichier_calendrier/parametres_calendrier.php";
$date_modif_para_cal  = date ("d", filemtime($chemin_fichier))." ".$mois_fr[(int)date ("m", filemtime($chemin_fichier))]." ".date ("Y", filemtime($chemin_fichier))." ".date ("H:i:s.", filemtime($chemin_fichier));

$chemin_fichier = "fichier_calendrier/sauvegarde_calendrier_liste_locataire.php";
if ( file_exists($chemin_fichier))
  $date_modif_liste_locataire  = date ("d", filemtime($chemin_fichier))." ".$mois_fr[(int)date ("m", filemtime($chemin_fichier))]." ".date ("Y", filemtime($chemin_fichier))." ".date ("H:i:s.", filemtime($chemin_fichier));
else
  $date_modif_liste_locataire  = '';

$chemin_fichier = "fichier_calendrier/sauvegarde_calendrier_commentaire_locataire.php";
if ( file_exists($chemin_fichier))
  $date_modif_commentaire_locataire  = date ("d", filemtime($chemin_fichier))." ".$mois_fr[(int)date ("m", filemtime($chemin_fichier))]." ".date ("Y", filemtime($chemin_fichier))." ".date ("H:i:s.", filemtime($chemin_fichier));
else
  $date_modif_commentaire_locataire  = '';

$chemin_fichier = "fichier_calendrier/sauvegarde_calendrier_liste_logement.php";
if ( file_exists($chemin_fichier))
  $date_modif_liste_logement  = date ("d", filemtime($chemin_fichier))." ".$mois_fr[(int)date ("m", filemtime($chemin_fichier))]." ".date ("Y", filemtime($chemin_fichier))." ".date ("H:i:s.", filemtime($chemin_fichier));
else
  $date_modif_liste_logement  = '';

$chemin_fichier = "fichier_calendrier/sauvegarde_calendrier_liste_couleur.php";
if ( file_exists($chemin_fichier))
  $date_modif_liste_couleur  = date ("d", filemtime($chemin_fichier))." ".$mois_fr[(int)date ("m", filemtime($chemin_fichier))]." ".date ("Y", filemtime($chemin_fichier))." ".date ("H:i:s.", filemtime($chemin_fichier));
else
  $date_modif_liste_couleur  = '';

$chemin_fichier = "fichier_calendrier/sauvegarde_calendrier_liste_langue.php";
if ( file_exists($chemin_fichier))
  $date_modif_liste_langue  = date ("d", filemtime($chemin_fichier))." ".$mois_fr[(int)date ("m", filemtime($chemin_fichier))]." ".date ("Y", filemtime($chemin_fichier))." ".date ("H:i:s.", filemtime($chemin_fichier));
else
  $date_modif_liste_langue  = '';

$chemin_fichier = "fichier_calendrier/sauvegarde.zip";
if ( file_exists($chemin_fichier))
  $date_sauvegarde  = date ("d", filemtime($chemin_fichier))." ".$mois_fr[(int)date ("m", filemtime($chemin_fichier))]." ".date ("Y", filemtime($chemin_fichier))." ".date ("H:i:s.", filemtime($chemin_fichier));
else
  $date_sauvegarde  = '';


//********************************************************************************
// controle mode démo ************************************************************
//********************************************************************************
  if ( ( (isset($_POST['Restaurer'])) || (isset($_POST['Effacer'])) || (isset($_POST['Restaurer_item1'])) ) && MODE_DEMO   )
     $affiche_info = 'mode_demo';

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Administration du calendrier des disponibilités</title>
<meta name="generator" content="http://www.mathieuweb.fr/calendrier/">
<link href="icone_cal.ico" rel="shortcut icon" type="image/x-icon">
<link href="calendrier_administrateurV4.css" rel="stylesheet" type="text/css">
<link href="base.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
<script type="text/javascript">
function ValidateForm1(theForm)
{
   var regexp;
   if (theForm.choix_date.value == "")
   {
      alert("Vous n'avez pas renseigné le nom du serveur host de la base de données!");
      theForm.choix_date.focus();
      return false;
   }
   if (theForm.choix_date.value.length < 1)
   {
      alert("Vous n'avez pas renseigné le nom du serveur host de la base de données!");
      theForm.choix_date.focus();
      return false;
   }
   return true;
}
</script>
<script type="text/javascript">
function ValidateForm1(theForm)
{
   var regexp;
   var extension = theForm.FileUpload1.value.substr(theForm.FileUpload1.value.lastIndexOf('.'));
   if ((extension.toLowerCase() != ".zip") &&
       (extension != ""))
   {
      alert("Le fichier sélectionné n'est pas un fichier zip !");
      theForm.FileUpload1.focus();
      return false;
   }
   return true;
}
</script>
<script type="text/javascript" src="wwb11.min.js"></script>
<link rel="stylesheet" href="fichier_calendrier/styles.css?version=<?php echo filemtime('fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >

<script type="text/javascript" src="fonction.js"></script>

</head>
<body>
<div id="container">
<div id="wb_MasterPage2" style="position:absolute;left:2px;top:0px;width:964px;height:110px;z-index:62;">
</div>
<table style="position:absolute;left:4px;top:108px;width:982px;height:1523px;z-index:63;" cellpadding="5" cellspacing="1" id="Table1">
<tr>
<td class="cell0"><?php

if ( !AVEC_BDD ) {

echo '
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<table style="width:100%;height:38px;background-color:#6785BE;" cellpadding="4" cellspacing="0" id="Table3">
<tr>
<td align="left" valign="middle" style="height:30px;">
<font style="font-size:19px" color="#FFFFFF" face="Arial Black"><b>Liste des fichiers contenant les dates du calendrier</b></font></td>
</tr>
</table>
<br>
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="Table1">
<tr>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>ID</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Calendrier ',$item1,'</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Date dernière sauvegarde</B></font></td>
<td align="center" valign="center" bgcolor="#7D9EC0" height="30"><font color="#FFFFFF" style="font-size:16px" face="Arial"><B>Restaurer</B></font></td>
</tr>';



$couleur_tab = "#DBE4EE";
$memoire_logement = '';
$cle_fichier ='';
$compteur_ligne = 0;

if (isset($nom_logement)) {
 $nb_result = count ($nom_logement);
 if ( $nb_result > 0 ) {

 //tri par ordre alphabétique
 asort($nom_logement);

 foreach ($nom_logement as $cle_fichier => $val_logement )  {

  if ( $cle_fichier <> 0 ) {

   $chemin_fichier_logement = "fichier_calendrier/dates_sans_bdd/".$cle_fichier."_calendrier.php";
   if ( file_exists($chemin_fichier_logement)) {
      include($chemin_fichier_logement);
   //controle des fichiers
   $pointeur_variable_ctrl_fin_fichier = 'fin_tableau_reservation_'.$cle_fichier;

   $date_derniere_modif = date ("d", filemtime($chemin_fichier_logement))." ".$mois_fr[(int)date ("m", filemtime($chemin_fichier_logement))]." ".date ("Y", filemtime($chemin_fichier_logement))." ".date ("H:i:s.", filemtime($chemin_fichier_logement));


     echo '<tr><td align="center" valign="center" bgcolor ="',$couleur_tab,'"  height="30"><font color="#000000" style="font-size:14px" face="Arial">',$cle_fichier,'</font></td>

        <td align="center" valign="center" bgcolor ="',$couleur_tab,'"  height="30"><font color="#000000" style="font-size:14px" face="Arial">',stripslashes($val_logement),'</font></td>

        <td align="center" valign="center" bgcolor ="',$couleur_tab,'"  height="30"><font color="#000000" style="font-size:14px" face="Arial">',$date_derniere_modif,'</font></td>

        <td align="center" valign="center" bgcolor ="',$couleur_tab,'"  height="30"><a href="base.php?fct=restaurer&num=',$cle_fichier,'" onClick="return(confirm(\'Restaurer le fichier ',$cle_fichier,' ? \'));"  class = "style_lien" >Restaurer</a></td></tr>';
      $compteur_ligne++;  

    }
   } // fin cle different de 0 ****
  }
 }
}

if ( $compteur_ligne == 0 )
  echo '<tr><td><font color="#FF0000" style="font-size:16px" face="Arial"><B>Aucun fichier</B></font></td></tr>'; 

echo '</table>';

}
?>

<span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<table style="position:absolute;left:11px;top:544px;width:958px;height:384px;z-index:64;" cellpadding="0" cellspacing="1" id="Table4">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<table style="position:absolute;left:11px;top:360px;width:960px;height:136px;z-index:65;" cellpadding="0" cellspacing="1" id="Table2">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<table style="position:absolute;left:12px;top:154px;width:960px;height:156px;z-index:66;" cellpadding="0" cellspacing="1" id="Table3">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<table style="position:absolute;left:13px;top:114px;width:960px;height:38px;z-index:67;" cellpadding="4" cellspacing="0" id="Table5">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:19px;"><strong>Nettoyer la base de données</strong></span></td>
<td class="cell1"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<table style="position:absolute;left:11px;top:316px;width:960px;height:38px;z-index:68;" cellpadding="4" cellspacing="0" id="Table6">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:19px;"><strong>Restaurer les paramétres du calendrier</strong></span></td>
<td class="cell1"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<table style="position:absolute;left:10px;top:501px;width:960px;height:38px;z-index:69;" cellpadding="4" cellspacing="0" id="Table7">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:19px;"><strong>Restaurer les listes</strong></span></td>
<td class="cell1"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_MasterPage5" style="position:absolute;left:677px;top:0px;width:96px;height:106px;z-index:70;">
<div id="wb_Shape1" style="position:absolute;left:36px;top:90px;width:21px;height:11px;z-index:0;">
<img src="images/img0003.gif" id="Shape1" alt="" style="width:21px;height:11px;"></div>
<div id="wb_Shape2" style="position:absolute;left:0px;top:98px;width:96px;height:8px;z-index:1;">
<img src="images/img0006.gif" id="Shape2" alt="" style="width:96px;height:8px;"></div>
<div id="wb_Shape3" style="position:absolute;left:0px;top:0px;width:96px;height:3px;z-index:2;">
<img src="images/img0016.gif" id="Shape3" alt="" style="width:96px;height:3px;"></div>
</div>
<div id="wb_MasterPage1" style="position:absolute;left:4px;top:0px;width:998px;height:110px;z-index:71;">
<div id="wb_fond_widget" style="position:absolute;left:960px;top:2px;width:38px;height:108px;filter:alpha(opacity=40);opacity:0.40;z-index:3;">
<img src="images/img0013.png" id="fond_widget" alt="" style="width:38px;height:108px;"></div>
<div id="wb_menu_codes" style="position:absolute;left:800px;top:10px;width:32px;height:32px;z-index:4;">
<a href="./code.php"><img src="images/binary.png" id="menu_codes" alt="Codes pour afficher les calendriers visiteurs" title="Codes pour afficher les calendriers visiteurs"></a></div>
<div id="wb_text_cal" style="position:absolute;left:2px;top:55px;width:95px;height:18px;text-align:center;z-index:5;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./index_calendrier.php" class="Style_menu">Calendrier</a></span></div>
<div id="wb_text_locataire" style="position:absolute;left:97px;top:55px;width:95px;height:18px;text-align:center;z-index:6;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./locataire.php" class="Style_menu">Locataires</a></span></div>
<div id="text_ressource" style="position:absolute;left:193px;top:55px;width:97px;height:44px;z-index:7">
<div  style="text-align:center;">

<font style="font-size:16px" color="#666666" face="Arial"><a href="./logement.php" class="Style_menu">
<?php echo $item1; ?>
</a></font>

</div></div>
<div id="wb_text_couleur" style="position:absolute;left:291px;top:55px;width:95px;height:54px;text-align:center;z-index:8;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./couleur.php" class="Style_menu">Couleurs des marqueurs</a></span></div>
<div id="wb_texte_param" style="position:absolute;left:482px;top:55px;width:95px;height:36px;text-align:center;z-index:9;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./parametrage_calendrier.php" class="Style_menu">Paramètres calendrier</a></span></div>
<div id="wb_text_stats" style="position:absolute;left:387px;top:55px;width:95px;height:18px;text-align:center;z-index:10;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./listing.php" class="Style_menu">Statistiques</a></span></div>
<div id="wb_texte_langues" style="position:absolute;left:578px;top:55px;width:95px;height:18px;text-align:center;z-index:11;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./edit_langue.php" class="Style_menu">Langues</a></span></div>
<div id="wb_text_maintenance" style="position:absolute;left:674px;top:55px;width:95px;height:18px;text-align:center;z-index:12;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./base.php" class="Style_menu">Maintenance</a></span></div>
<div id="wb_text_codes" style="position:absolute;left:769px;top:55px;width:95px;height:18px;text-align:center;z-index:13;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./code.php" class="Style_menu">Codes</a></span></div>
<div id="wb_text_propos" style="position:absolute;left:862px;top:55px;width:95px;height:18px;text-align:center;z-index:14;">
<span style="color:#666666;font-family:Arial;font-size:16px;"><a href="./a_propos.php" class="Style_menu">A propos</a></span></div>
<div id="wb_Image10" style="position:absolute;left:967px;top:3px;width:20px;height:20px;z-index:15;">
<a href="identification.php?fct=deconnexion"><img src="images/img0007.png" id="Image10" alt="D&#233;connexion" title="D&#233;connexion"></a></div>
<div id="wb_menu_memo" style="position:absolute;left:961px;top:27px;width:31px;height:31px;z-index:16;">
<a href="#"><img src="images/img0012.png" id="menu_memo" alt="M&#233;mo" title="M&#233;mo" onclick="coller_ajax('memo','colle_memo.html');document.getElementById('Memoire').style.visibility='visible';"></a></div>
<div id="wb_menu_calcul" style="position:absolute;left:963px;top:66px;width:32px;height:32px;z-index:17;">
<a href="#"><img src="images/img0325.png" id="menu_calcul" alt="Calculatrice" title="Calculatrice" onclick="document.getElementById('Calculatrice').style.visibility='visible';"></a></div>
<div id="wb_menu_cal" style="position:absolute;left:27px;top:10px;width:44px;height:37px;z-index:18;">
<a href="./index_calendrier.php"><img src="images/img0021.png" id="menu_cal" alt="Calendrier" title="Calendrier"></a></div>
<div id="wb_menu_locataire" style="position:absolute;left:123px;top:7px;width:48px;height:48px;z-index:19;">
<a href="./locataire.php"><img src="images/people.png" id="menu_locataire" alt="Gestion des locataires" title="Gestion des locataires"></a></div>
<div id="wb_menu_ressources" style="position:absolute;left:217px;top:7px;width:48px;height:48px;z-index:20;">
<a href="./logement.php"><img src="images/09_48x48.png" id="menu_ressources" alt="Gestion des logements" title="Gestion des logements"></a></div>
<div id="wb_menu_couleur" style="position:absolute;left:315px;top:7px;width:48px;height:48px;z-index:21;">
<a href="./couleur.php"><img src="images/palette.png" id="menu_couleur" alt="Gestion des marqueurs" title="Gestion des marqueurs"></a></div>
<div id="wb_manu_maintenance" style="position:absolute;left:699px;top:7px;width:48px;height:48px;z-index:22;">
<a href="./base.php"><img src="images/maintenance.png" id="manu_maintenance" alt="Maintenance des donn&#233;es" title="Maintenance des donn&#233;es"></a></div>
<div id="wb_menu_stat" style="position:absolute;left:411px;top:7px;width:48px;height:48px;z-index:23;">
<a href="./listing.php"><img src="images/stat.png" id="menu_stat" alt="Statistiques de locations" title="Statistiques de locations"></a></div>
<div id="wb_menu_langue" style="position:absolute;left:604px;top:7px;width:48px;height:48px;z-index:24;">
<a href="./edit_langue.php"><img src="images/langue.png" id="menu_langue" alt="Gestion des langues" title="Gestion des langues"></a></div>
<div id="wb_menu_paraemtre" style="position:absolute;left:506px;top:7px;width:48px;height:48px;z-index:25;">
<a href="./parametrage_calendrier.php"><img src="images/administrative_docs.png" id="menu_paraemtre" alt="Param&#233;tres du calendrier" title="Param&#233;tres du calendrier"></a></div>
<div id="wb_menu_propos" style="position:absolute;left:886px;top:7px;width:48px;height:48px;z-index:26;">
<a href="./a_propos.php"><img src="images/brainstorming.png" id="menu_propos" alt="A propos du script" title="A propos du script"></a></div>
<div id="text_affiche_info" style="position:absolute;left:276px;top:2px;width:274px;height:10px;z-index:27">
<?php

if( $affiche_info <> '')
    message_info ($affiche_info);

?></div>
<!-- widget -->
<div id="text_code_commun" style="position:absolute;left:570px;top:0px;width:25px;height:31px;z-index:28">
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
<table style="position:absolute;left:12px;top:981px;width:958px;height:454px;z-index:72;" cellpadding="0" cellspacing="1" id="Table9">
<tr>
<td class="cell0"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<table style="position:absolute;left:11px;top:938px;width:960px;height:38px;z-index:73;" cellpadding="4" cellspacing="0" id="Table8">
<tr>
<td class="cell0"><span style="color:#FFFFFF;font-family:'Arial Black';font-size:19px;"><strong>Sauvegarder / Restaurer les fichiers</strong></span></td>
<td class="cell1"><span style="color:#000000;font-family:Arial;font-size:13px;"> </span></td>
</tr>
</table>
<div id="wb_Form2" style="position:absolute;left:26px;top:115px;width:927px;height:1187px;z-index:74;">
<form name="Form1" method="post" action="base.php" id="Form2" onsubmit="return ValidateForm1(this)">
<div id="wb_Text7" style="position:absolute;left:3px;top:59px;width:532px;height:18px;text-align:right;z-index:29;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Effacer toutes les dates marquées dans la base de données antérieures à </strong></span></div>
<input type="text" id="choix_date" style="position:absolute;left:550px;top:54px;width:171px;height:22px;line-height:22px;z-index:30;" name="choix_date" value="<?php  if (  isset($_POST['Effacer']) && !MODE_DEMO) echo $choix_date; else echo "01/01/".$date_annee; ?>" readonly>
<div id="wb_Text8" style="position:absolute;left:3px;top:94px;width:532px;height:18px;text-align:right;z-index:31;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Pour le ou les locataires suivant :</strong></span></div>
<input type="submit" id="Button1" onclick="return(confirm('Effacer toutes ces dates ? '));return false;" name="Effacer" value="Effacer" style="position:absolute;left:549px;top:158px;width:96px;height:25px;z-index:32;">
<input type="submit" id="Button2" onclick="return(confirm('Restaurer les paramètres du  <?php echo $date_modif_para_cal; ?> ?'));return false;" name="Restaurer" value="Restaurer les paramètres du calendrier avant la dernière modification" style="position:absolute;left:123px;top:285px;width:635px;height:34px;z-index:33;">
<input type="submit" id="Button3" onclick="return(confirm('Restaurer les listes du <?php echo $date_modif_liste_locataire; ?> ? '));return false;" name="Restaurer" value="Restaurer les listes locataires avant la dernière modification" style="position:absolute;left:123px;top:465px;width:635px;height:34px;z-index:34;">
<div id="Html3" style="position:absolute;left:122px;top:264px;width:410px;height:21px;z-index:35">
<font style="font-size:13px" color="#000000" face="Arial">Date dernière sauvegarde : <?php echo $date_modif_para_cal; ?></font></div>
<div id="Html4" style="position:absolute;left:122px;top:446px;width:410px;height:19px;z-index:36">
<font style="font-size:13px" color="#000000" face="Arial">Date dernière sauvegarde : <?php echo $date_modif_liste_locataire; ?></font></div>
<input type="submit" id="Button4" onclick="return(confirm('Restaurer les listes du <?php echo $date_modif_liste_couleur; ?> ? '));return false;" name="Restaurer" value="Restaurer les listes couleurs avant la dernière modification" style="position:absolute;left:123px;top:677px;width:635px;height:34px;z-index:37;">
<input type="submit" id="Button5" onclick="return(confirm('Restaurer les listes du <?php echo $date_modif_liste_logement; ?> ? '));return false;" name="Restaurer_item1" value="Restaurer les listes <?php echo $item1; ?> avant la dernière modification" style="position:absolute;left:123px;top:611px;width:635px;height:34px;z-index:38;">
<div id="Html5" style="position:absolute;left:122px;top:659px;width:410px;height:19px;z-index:39">
<font style="font-size:13px" color="#000000" face="Arial">Date dernière sauvegarde : <?php echo $date_modif_liste_couleur; ?></font></div>
<div id="Html6" style="position:absolute;left:122px;top:593px;width:410px;height:19px;z-index:40">
<font style="font-size:13px" color="#000000" face="Arial">Date dernière sauvegarde  : <?php echo $date_modif_liste_logement; ?></font></div>
<input type="submit" id="Button6" onclick="return(confirm('Restaurer les paramètres du calendrier depuis la version originale ?'));return false;" name="Restaurer" value="Restaurer les paramètres du calendrier en version originale" style="position:absolute;left:122px;top:332px;width:635px;height:34px;z-index:41;">
<div id="Html7" style="position:absolute;left:79px;top:130px;width:455px;height:22px;z-index:42">
<?php
echo '<div id="wb_Text1" align="right"><font style="font-size:15px" color="#000000" face="Arial"><b>Pour le ou les  ',$item1,' suivants :</b></font></div>';
?></div>
<div id="Html9" style="position:absolute;left:122px;top:728px;width:410px;height:19px;z-index:43">
<font style="font-size:13px" color="#000000" face="Arial">Date dernière sauvegarde : <?php echo $date_modif_liste_langue; ?></font></div>
<input type="submit" id="Button8" onclick="return(confirm('Restaurer les listes du <?php echo $date_modif_liste_langue; ?> ? '));return false;" name="Restaurer" value="Restaurer les langues avant la dernière modification" style="position:absolute;left:123px;top:747px;width:635px;height:34px;z-index:44;">
<div id="wb_Image2" style="position:absolute;left:722px;top:45px;width:43px;height:43px;z-index:45;">
<a href="javascript:popupwnd('date-picker.php?idcible=choix_date','no','no','no','yes','yes','no','50','50','650','850')" target="_self"><img src="images/date-picker3.png" id="Image2" alt="Choisir une date" title="Choisir une date"></a></div>
<div id="Html1" style="position:absolute;left:549px;top:127px;width:305px;height:22px;z-index:46">
<?php

liste_box ("logement",300,$nom_logement,"",false,"",false,"");

?></div>
<div id="Html2" style="position:absolute;left:549px;top:93px;width:304px;height:22px;z-index:47">
<?php

liste_box ("locataire",300,$nom_locataire,$prenom_locataire,false,"",true,"");

?></div>
<div id="Html8" style="position:absolute;left:123px;top:520px;width:410px;height:19px;z-index:48">
<font style="font-size:13px" color="#000000" face="Arial">Date dernière sauvegarde : <?php echo $date_modif_commentaire_locataire; ?></font></div>
<input type="submit" id="Button7" onclick="return(confirm('Restaurer les listes du <?php echo $date_modif_liste_locataire; ?> ? '));return false;" name="Restaurer" value="Restaurer les commentaires locataires avant la dernière modification" style="position:absolute;left:124px;top:539px;width:635px;height:34px;z-index:49;">
<input type="submit" id="Button9" name="Sauvegarder" value="Créer une sauvegarde ZIP des fichiers" style="position:absolute;left:120px;top:1008px;width:635px;height:34px;z-index:50;">
<div id="Html10" style="position:absolute;left:384px;top:1066px;width:410px;height:21px;z-index:51">
<font style="font-size:14px" color="#000000" face="Arial"><?php echo $date_sauvegarde; ?></font></div>
<div id="wb_Text1" style="position:absolute;left:20px;top:1065px;width:369px;height:18px;z-index:52;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Date dernière sauvegarde existant sur le serveur :&nbsp; </strong></span></div>
<div id="wb_Text2" style="position:absolute;left:21px;top:878px;width:891px;height:108px;z-index:53;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Le bouton ci dessous &quot;créer une sauvegarde ZIP des fichiers&quot;, permet de créer une sauvegarde de vos données sur votre serveur , le téléchargement du fichier zip va également démarrer automatiquement,<br>il est conseillé de garder au moins une sauvegarde sur votre PC.<br><u>Attention</u> : Tous les paramètres, et listes de votre calendrier sont sauvegardés, ecxepté le fichier admin/genere/connexion.php ( fichier contenant les identifiants de connexion), pour des raisons de sécurité, il n'est pas inclus dans le zip, vous devez faire une sauvegarde manuelle. ( <a href="http://www.mathieuweb.fr/calendrier/faq-calendrier-reservation.php" target="_blank" class="style2">voir FAQ</a>)</strong></span></div>
<div id="wb_Extension2" style="position:absolute;left:770px;top:1017px;width:21px;height:21px;z-index:54;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Cliquez sur ce bouton pour faire une sauvagarde des fichiers du script <br>
( liste locataires, liste couleurs, liste locations, listes des langues, liste commentaires,paramètres calendrier, fichier style, listes des fichiers dates ).<br>
</font><font style="font-size:13px" color="#000000" face="MS Sans Serif"><b>Attention :</b> le fichier contenant les identifiants de connexion ( admin/genere/connexion.php ) ne sera pas restaurée, vous devez faire une sauvagarde manuelle de ce fichier et le restaurer manuellement.</font></em></a></div>
<div id="wb_Extension9" style="position:absolute;left:769px;top:1144px;width:21px;height:21px;z-index:55;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Cliquez sur ce bouton pour restaurer tous les paramètres du calendrier tels qu'ils sont lors de la dernière sauvagarde serveur.<br>
<b>Attention :</b> le fichier contenant les identifiants de connexion ( admin/genere/connexion.php ) ne sera pas restaurée, vous devez faire une sauvagarde manuelle de ce fichier et le restaurer manuellement.</font></em></a></div>
<input type="submit" id="Button10" onclick="return(confirm('Restaurer tous les paramètres du calendrier depuis la sauvegarde serveur ?'));return false;" name="Restaurer" value="Restaurer les fichiers depuis la sauvegarde du serveur" style="position:absolute;left:120px;top:1136px;width:635px;height:34px;z-index:56;">
<div id="Html11" style="position:absolute;left:122px;top:1102px;width:635px;height:28px;z-index:57">
<font style="font-size:15px" color="#000000" face="Arial">
<b>
<a href="fichier_calendrier/sauvegarde.zip?v=<?php echo time(); ?>" class="style3">
Télécharger la sauvegarde se trouvant sur le serveur
</a>
</b>
</font>
</div>
</form>
</div>
<div id="wb_Extension8" style="position:absolute;left:798px;top:872px;width:21px;height:21px;z-index:75;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Après chaque modification , un fichier de sauvegarde est généré.<br>
Cliquez sur ce bouton en cas d'erreur, après ou modification ou pour annuler la dernière modification realisée.</font></em></a></div>
<div id="wb_Extension6" style="position:absolute;left:798px;top:797px;width:21px;height:21px;z-index:76;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Après chaque modification , un fichier de sauvegarde est généré.<br>
Cliquez sur ce bouton en cas d'erreur, après ou modification ou pour annuler la dernière modification realisée.</font></em></a></div>
<div id="wb_Extension5" style="position:absolute;left:798px;top:734px;width:21px;height:21px;z-index:77;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Après chaque modification , un fichier de sauvegarde est généré.<br>
Cliquez sur ce bouton en cas d'erreur, après ou modification ou pour annuler la dernière modification realisée.</font></em></a></div>
<div id="wb_Extension4" style="position:absolute;left:799px;top:661px;width:21px;height:21px;z-index:78;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Après chaque modification , un fichier de sauvegarde est généré.<br>
Cliquez sur ce bouton en cas d'erreur, après ou modification ou pour annuler la dernière modification realisée.</font></em></a></div>
<div id="wb_Extension7" style="position:absolute;left:798px;top:587px;width:21px;height:21px;z-index:79;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Après chaque modification , un fichier de sauvegarde est généré.<br>
Cliquez sur ce bouton en cas d'erreur, après ou modification ou pour annuler la dernière modification realisée.<br>
Si vous avez supprimé un locataire, il peut être nécessaire de restaurer également le fichier commentaire locataires.</font></em></a></div>
<div id="wb_Extension1" style="position:absolute;left:798px;top:455px;width:21px;height:21px;z-index:80;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Cliquez sur ce bouton pour réinitialiser les paramètres du calendrier tels qu'ils sont lors de l'achat du script</font></em></a></div>
<div id="wb_Extension3" style="position:absolute;left:798px;top:407px;width:21px;height:21px;z-index:81;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Après chaque modification des parmètres du calendrier, un fichier de sauvegarde est généré.<br>
Cliquez sur ce bouton en cas d'erreur, après ou modification ou pour annuler la dernière modification realisée.</font></em></a></div>
<div id="wb_Form1" style="position:absolute;left:21px;top:1317px;width:928px;height:106px;z-index:82;">
<form name="Form1" method="post" action="base.php" enctype="multipart/form-data" id="Form1" onsubmit="return ValidateForm1(this)">
<input type="hidden" name="MAX_FILE_SIZE" value="8200000">
<div id="wb_Text3" style="position:absolute;left:22px;top:16px;width:369px;height:36px;z-index:58;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Télécharger une sauvegarde depuis votre PC :<br>(Fichier sauvegare.zip)&nbsp; </strong></span></div>
<input type="file" id="FileUpload1" style="position:absolute;left:399px;top:16px;width:337px;height:23px;line-height:23px;z-index:59;" name="upload_sauvegarde">
<input type="submit" id="Button11" onclick="return(confirm('Télécharger et restaurer tous les paramètres du calendrier depuis une sauvegarde PC ?'));return false;" name="Restaurer" value="Télécharger" style="position:absolute;left:398px;top:46px;width:234px;height:30px;z-index:60;">
<div id="wb_Extension10" style="position:absolute;left:775px;top:20px;width:21px;height:21px;z-index:61;">
<a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">Cette fonction vous permet de télécharger depuis votre pc vers votre serveur un fichier sauvegarde qui a été généré par le script ( bouton &quot;créer une sauvegarde ZIP des fichiers &quot; ).<br>
<b>Attention :</b> le programme vérifie que le fichier zip s'appelle sauvegarde.zip, nom du fichier généré par les sauvegardes du script, veuillez respecter ce nom.<br>
</font><font style="font-size:13px" color="#000000" face="MS Sans Serif">Le fichier contenant les identifiants de connexion ( admin/genere/connexion.php ) ne sera pas restaurée, vous devez faire une sauvagarde manuelle de ce fichier et le restaurer manuellement.</font><font style="font-size:13px" color="#000000" face="MS Sans Serif"><br>
</font></em></a></div>
</form>
</div>
</div>
</body>
</html>