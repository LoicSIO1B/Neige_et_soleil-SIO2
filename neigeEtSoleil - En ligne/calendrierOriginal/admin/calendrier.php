<?php
//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
//demarrage des sessions****************************************************************************
//----  si cette page est affcihée en dehors de la page index_calendrier.php il faut absolument ----
//----  mettre l'instruction suivante en début du fichier                                       ----
//                session_start();                                                              ----
//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
//----                  Script de gestion pour calendrier de reservation                        ----
//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
//----   Paramètres possible dans l'url :                                                       ----
//----       mois      : numero du premier mois à afficher dans le calendrier                   ----
//----       an        : année du premier mois a afficher dans le calendrier                    ----
//----       langue    : choix de la langue ( fr,francais, all,allemand, eng, anglais )         ----
//----       logement  : tri des réservations suivant numéro "id_logement"                      ----
//----       locataire : tri des réservations suivant numero "id_locataire"                     ----
//----       date_lien : si égale à 0, les dates sont cliquables                                ----
//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
//----                http://mathieuweb.fr/calendrier                                           ----
//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
//----     Paramètres de configurations générales et modifiables                               -----
//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

if (!isset($header_iso) || !$header_iso)
	header( 'content-type: text/html; charset=ISO-8859-1' );


// initialisation de variables *********************************************************************
     $affiche_info = '';

//chemin vers le fichier identifiants **************************************************************
     require_once("genere/connexion.php");

// controle si sessions avec indentifiants existe ***************************************************
 if ( (!isset($_SESSION['id_connexion']) || !isset($_SESSION['mdp']) || $_SESSION['id_connexion'] <> identifiant || $_SESSION['mdp'] <> $mot_de_passe_decrypt )  && ( !defined('MODE_SECURE') || MODE_SECURE ) ) {
    if ( identifiant == '' || mot_de_passe == '' )
       echo "Vous devez installer le calendrier avant de commencer, <a href=\"installation/\">Installer</a>";
    else
       echo "Vous n'êtes pas identifié, <a href=\"identification.php\">identifiez vous ici</a>";
    exit;
 }

//chemin vers le fichier date mise à jour **********************************************************
     include("fichier_calendrier/calendrier_date_mise_a_jour.php");

//**************************************************************************************************
//controle des fichiers 
//**************************************************************************************************
if (!isset($fin_tableau_logement))
    $affiche_info = 'erreur_fichier_logement';
if (!isset($fin_tableau_locataire))
    $affiche_info = 'erreur_fichier_locataire';
if (!isset($fin_tableau_couleur))
    $affiche_info = 'erreur_fichier_couleur';
if (!isset($fin_tableau_parametres))
    $affiche_info = 'erreur_fichier_parametres';
//if (!isset($fin_tableau_commentaire_locataire))
//    $affiche_info = 'erreur_fichier_com_locataire';

//nom de la page ou se trouve le script*************************************************************
$adresse_page         = "index_calendrier.php"; 
//nom de la page a ouvrir lorsqu'on clic sur une date***********************************************
$adresse_destination  = "index_calendrier.php";

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
// sélection de l'affichage des modules ************************************************************
//avec selection possible du mois et année----------------------------------------------------------
$selection_mois_an    = true ;
//avec selection des couleurs pour marquer des jours de plusieurs------------------------------------
$avec_selection_couleur      = true;
//avec affichage des champs de saisie pour réserver plusieurs jours consécutifs----------------------
$avec_selection_champs_date      = true;
//avec affichage des champs de sélection des locataires----------------------------------------------
$avec_selection_locataire      = true;
//avec affichage des champs de sélection des logements-----------------------------------------------
$avec_selection_logement      = true;

//format de date sur le lien des jours dans le calendrier--------------------------------------------
// si true alors selection format francais, si false alors format date anglais-----------------------
$format_date_fr    = true ;

//insertion des langues ************************************************
     $_GET['langue'] = 'fr' ;
     include("fichier_calendrier/langue.php");

//si session logement existe alors le logement de la session devient prioritaire********************
if ( (isset($_SESSION['sel_tri_logement'])) && (!(empty($_SESSION['sel_tri_logement']))) ) {
   $tri_logement = " AND id_logement = '".$_SESSION['sel_tri_logement']."'" ;
   $tri_logement2 = ", '".$_SESSION['sel_tri_logement']."'" ;
   $num_logement_en_cours = $_SESSION['sel_tri_logement'];
   }

// selection du format du calendrier ***************************************************************
   $format_calendrier_admin = $format_calendrier_logement[$num_logement_en_cours];
// selection jour début de semaine *****************************************************************
   $texte_jour_debut_semaine = $texte_jour_debut_semaine_logement[$num_logement_en_cours];

//choix du locataire********************************************************************************
   $tri_locataire = ' ';
   $tri_locataire2 = ", ' '";
   $tri_locataire_ssbdd = 0;
   $num_locataire_en_cours = '';
//controle si choix du locataire dans l'url*********************************************************
//test si demande ouverture du calendrier administrateur sur un logement par défaut
if (  !(isset($_SESSION['sel_tri_locataire'])) )
   $_SESSION['sel_tri_locataire'] = $locataire_defaut_cal_admin ;
if ( (isset($_POST['locataire'])) && (empty($_POST['locataire'])) )
    $_SESSION['sel_tri_locataire'] = '' ;
if ( (isset($_POST['locataire'])) && (!(empty($_POST['locataire']))) )
    $_SESSION['sel_tri_locataire'] = (int)$_POST['locataire'] ;
//controle si choix du locataire dans l'url*********************************************************
if ( (isset($_GET['locataire'])) && (empty($_GET['locataire'])) )
    $_SESSION['sel_tri_locataire'] = '' ;
if ( (isset($_GET['locataire'])) && (!(empty($_GET['locataire']))) )
    $_SESSION['sel_tri_locataire'] = (int)$_GET['locataire'] ;
//si session locataire existe alors le locataire de la session devient prioritaire******************
if ( (isset($_SESSION['sel_tri_locataire'])) && (!(empty($_SESSION['sel_tri_locataire']))) ) {
      $tri_locataire = " AND id_locataire = '".$_SESSION['sel_tri_locataire']."'" ;
      $tri_locataire2 = ", '".$_SESSION['sel_tri_locataire']."'" ;
      $tri_locataire_ssbdd = $_SESSION['sel_tri_locataire'];
      $num_locataire_en_cours = $_SESSION['sel_tri_locataire'];
    }

//choix date avec lien******************************************************************************
// si $date_lien = 0 alors chaque jour du calendrier aura lien , celien peut servir à marquer les jours
// ou peut renvoyer la date vers une autre page
// si $date_lien =1 alors les jours n'ont aucun lien 
$date_lien = 0;

//choix du mois*************************************************************************************
$selection_mois_depart = 0;
$offset_annee          = 0;
$premier_mois       = date ("m") + $selection_mois_depart;
if ($premier_mois >12) {
    $premier_mois = 1;
    $offset_annee = 1; }
if ($premier_mois < 1) {
    $premier_mois = 12; 
    $offset_annee = -1; }

//controle si choix du mois dans l'url**************************************************************
if ( (isset($_GET['mois'])) && (empty($_GET['mois'])) )
    $_SESSION['mois'] = '' ;
if ( (isset($_GET['mois'])) && (!(empty($_GET['mois']))) )  {
    $_SESSION['mois'] = (int)$_GET['mois'] ;
    //fixe les limites de valeur ***
    if ( $_SESSION['mois'] < 1 )
         $_SESSION['mois'] = 1 ;
    else if ( $_SESSION['mois'] >12 )
         $_SESSION['mois'] = 12 ;
    }
//si session mois existe alors la session devient prioritaire***************************************
if ( (isset($_SESSION['mois'])) && (!(empty($_SESSION['mois']))) )
   $premier_mois = $_SESSION['mois'] ;

//choix de l'année**********************************************************************************
$annee_premier_mois       = date ("Y") + $offset_annee ;
//controle si choix de l'année dans l'url***********************************************************
if ( (isset($_GET['an'])) && (empty($_GET['an'])) )
    $_SESSION['an'] = '' ;
if ( (isset($_GET['an'])) && (!(empty($_GET['an']))) )  {
    $_SESSION['an'] = (int)$_GET['an'] ;
    //fixe les limites de valeur ***
    if ( $_SESSION['an'] < 1980 )
         $_SESSION['an'] = 1980 ;
    else if ( $_SESSION['an'] > 2030)
         $_SESSION['an'] = 2030 ;
    }
//si session année existe alors la session devient prioritaire**************************************
if ( (isset($_SESSION['an'])) && (!(empty($_SESSION['an']))) )
   $annee_premier_mois = $_SESSION['an'] ;

//choix de la couleur de fond des jours à marquer***************************************************
$nb_result = count ($couleur_reserve);
$premiere_couleur_tableau = false;
if ( $nb_result > 0 ) {
foreach ($couleur_reserve as $cle => $val_couleur )  {
     if ( !$premiere_couleur_tableau ) {
             $couleur_texte_reserve_en_cours  = $cle ;
             $couleur_en_cours    = $val_couleur ;
         }
     $premiere_couleur_tableau = true;
   }
}
//controle si choix de la couleur dans l'url***********************************************************
if ( (isset($_GET['couleur'])) && (empty($_GET['couleur'])) ) {
    $_SESSION['couleur'] = '' ;
    $_SESSION['choix_couleur_texte_reserve'] = '';
    }
if ( (isset($_GET['couleur'])) && (!(empty($_GET['couleur']))) ) {
    $temp_couleur = (int)$_GET['couleur'] ;
    $_SESSION['couleur'] = $couleur_reserve[$temp_couleur] ;
    $_SESSION['choix_couleur_texte_reserve'] = $temp_couleur ;
    }
//si session couleur existe alors la session devient prioritaire**************************************
if ( (isset($_SESSION['couleur'])) && (!(empty($_SESSION['couleur']))) )  {
   $couleur_en_cours                = $_SESSION['couleur'] ;
   $couleur_texte_reserve_en_cours  = $_SESSION['choix_couleur_texte_reserve'] ;
}


//********************************************************************************
// marquage de plusieurs jours****************************************************
//********************************************************************************
  if ( (isset($_POST['Marquer']) && $_POST['Marquer'] == 'Marquer')  && !MODE_DEMO ) {

   $date_debut_est_deja_inscrit  = false ;
   $date_fin_est_deja_inscrit    = false ;

   if ( $avec_diagonale_cellule )
       $_POST['date_fin'] = jour_precedent ($_POST['date_fin'],"/","fr");

   $test_post_debut = test_date_fr ($_POST['date_debut']);
   $test_post_fin = test_date_fr ($_POST['date_fin']);
   extract($_POST);
   
  if (  $test_post_debut==0 && $test_post_fin==0 )
   //test pour eviter de marquer un nombre de jour reservé trop important > 1000 jours
   $compare_date = nb_jour_date ($date_debut,$date_fin,"/","fr");   

  if (  $test_post_debut==0 && $test_post_fin==0 && $compare_date >= 0  && $compare_date <= 1000 ) {

      $date_debut_eng   = ajout_supprime_zero (date_fr_eng($date_debut,"/","-"),"Ajout","-","eng");
      $date_fin_eng     = ajout_supprime_zero (date_fr_eng($date_fin,"/","-"),"Ajout","-","eng");

      $tarif = str_replace(",",".",$tarif);  // transformation des virgules en . pour les chiffres
      $commentaire = nl2br(stripslashes($commentaire));
      $commentaire = ( $commentaire == "Message de l'infobulle" ) ? '' : addslashes($commentaire);

      // initialisation de variables ******************************************
      unset($tableau_requete);  // initialisation du tableau des logements a marqués***

      //***********************************************************************
      // liste des locations  marquer *****************************************
      //***********************************************************************

      if ( isset($marquer_tous) && $marquer_tous == 'oui' ) {// si marquage de toutes les locations
          $tableau_requete = $nom_logement ;   // tableau des locations = toutes les locations
          unset($tableau_requete[0]); // suppression index logement tous ******
          }
      else
          $tableau_requete[$num_logement_en_cours] = $nom_logement[$num_logement_en_cours];  // tableau des locations = toutes les locations

      //***********************************************************************
      // fonctionnement avec base de données  - ajout
      //***********************************************************************
      if ( AVEC_BDD ) {
      //connection a la base de donnees*******************************************************************
      $connect = @mysql_connect(Decrypte(hote_cal,$Cle), Decrypte(user_cal,$Cle), Decrypte(password_cal,$Cle)) or die("erreur de connexion au serveur sql");
      @mysql_select_db(Decrypte(base_cal,$Cle), $connect);

      // boucle de marquage des dates pour le ou les locations selectionnées 1 par 1 ****
      foreach ( $tableau_requete as $cle => $nom_logement_requete ) {

      //initialisation liste requete*****************************************
	  $connection_sql_active	= true;
      $date_boucle      = $date_debut_eng ;
      $tri_logement_requete = " AND id_logement = '".$cle."'" ;
      $liste_query = '';
      $compare_date = nb_jour_date ($date_debut,$date_fin,"/","fr");

      //effacement des dates eventuellement déjà marquées si la couleur en cours n'est pas une couleur invisible******
      $req_sql = "delete from ".Decrypte(nom_table_cal,$Cle)." where date_reservation >= '$date_debut_eng' and date_reservation <= '$date_fin_eng' $tri_logement_requete ";
      if ( !$couleur_invisible[$couleur_texte_reserve_en_cours] )
           @mysql_query($req_sql);

      //ajout dans la liste du premier jour **************************************************************************
      $tri_logement_requete = ", '".$cle."'" ;
      $liste_query .= "(NULL, '".$date_boucle."', '".$couleur_en_cours."', '".$couleur_texte_reserve_en_cours."' $tri_logement_requete  $tri_locataire2 , '".$commentaire."', '".$tarif."')";

      while ( $compare_date > 0 ) {
      $date_boucle  =  ajout_jour_date ($date_boucle,1,"JMA","-","eng");
      if ( $liste_query <> '')   // controle si premiere insertion
        $liste_query .= ' ,';
      // on ajoute les marqueurs dans la semaine*******************************
      $liste_query .= "(NULL, '".$date_boucle."', '".$couleur_en_cours."', '".$couleur_texte_reserve_en_cours."' $tri_logement_requete  $tri_locataire2 , '".$commentaire."', '".$tarif."')";
      $compare_date = nb_jour_date ($date_boucle,$date_fin_eng,"-","eng");
      }
     $liste_query .= " ;";

     $query = "INSERT INTO `".Decrypte(nom_table_cal,$Cle)."` (`id`, `date_reservation`, `couleur`, `couleur_texte`, `id_logement`, `id_locataire`, `commentaires`, `tarif`) VALUES
              $liste_query";
     $creation_reussi = @mysql_query($query)  ;
	 if ( isset($creation_reussi) && $creation_reussi ) {
		 $vecteur_index_logement 	= $cle;
		 include("genere/genere_export_ical.php");
		}
     
       }  // fin boucle foreach insertion des dates dans la base de données*****
          //********************************************************************
     }    // fin fonctionnement avec base de données ***************************
          //********************************************************************

      //***********************************************************************
      // fonctionnement sans base de données  - ajout
      //***********************************************************************
      
      else {
      // boucle de marquage des dates pour le ou les locations selectionnées 1 par 1 ****
      foreach ( $tableau_requete as $cle => $nom_logement_requete ) {
      //recupération des dates pour le logement en cours de traitement *********
      unset($tableau_reservation); // réinitialisation des variables tableau ***
 
      //controle si le fichier est disponible pour écriture *****************
      $fichier_libre = false;
      $chemin_fichier = 'fichier_calendrier/dates_sans_bdd/'.$cle.'_calendrier.php';
      $chemin_fichier_sauvegarde = 'fichier_calendrier/dates_sans_bdd/'.$cle.'_sauvegarde_calendrier.php';
      $pointeur_variable_fin_fichier_ok = 'fin_tableau_reservation_'.$cle;

      while (!isset($$pointeur_variable_fin_fichier_ok)  || !$$pointeur_variable_fin_fichier_ok) {
        include ($chemin_fichier);
        if ( isset($$pointeur_variable_fin_fichier_ok)  && $$pointeur_variable_fin_fichier_ok ) {
        //sauvegarde ancien fichier*********************************
        @copy($chemin_fichier,$chemin_fichier_sauvegarde);
        $file= @fopen($chemin_fichier, "w");
        $fichier_libre = true;
        }
      }

      //initialisation liste requete*****************************************
      $date_boucle      = $date_debut_eng ;

      $nb_jour_a_marquer = nb_jour_date ($date_debut,$date_fin,"/","fr") + 1;
      if ( !$couleur_invisible[$couleur_texte_reserve_en_cours] ) {
        //effacement des dates eventuellement déjà marquées ********************
        for ( $i = 1; $i <= $nb_jour_a_marquer; $i++ ) {
          if ( isset($tableau_reservation[$cle][$date_boucle]) )
            unset($tableau_reservation[$cle][$date_boucle]);
            $date_boucle = ajout_jour_date ($date_boucle,1,"JMA","-","eng") ;
          }
        }

       $date_boucle      =  $date_debut_eng ;

       for ( $i = 1; $i <= $nb_jour_a_marquer; $i++ ) {
         $tableau_reservation[$cle][$date_boucle] = $couleur_en_cours."%&%".$couleur_texte_reserve_en_cours."%&%".$tri_locataire_ssbdd."%&%".$tarif."%&%".guillet_var ($commentaire);
         $date_boucle = ajout_jour_date ($date_boucle,1,"JMA","-","eng") ;
       }
       // mise a jour du fichier *********************************************
       $vecteur_index_logement = $cle;
       $chemin_vers_fichier = '';
       if ( $fichier_libre) {
            include("genere/genere_tableau_calendrier.php");
			}
		if ( isset($creation_reussi) && $creation_reussi ) {
		 $vecteur_index_logement 	= $cle;
		 $tableau_reservation_modif = $tableau_reservation ;
		 include("genere/genere_export_ical.php");
		}	
       } // fin boucle foreach insertion des dates sans la base de données*****
         //********************************************************************
     }    // fin fonctionnement avec base de données ***************************
          //********************************************************************

     if ( isset($creation_reussi) && $creation_reussi ) {
         $affiche_info = 'modif_ok';
		}
     else
         $affiche_info = 'erreur_execution';
     include("genere/genere_date_maj.php");
    }
  else 
   $affiche_info = "erreur_execution";
 }

   //********************************************************************************
   // effacement de plusieurs jours****************************************************
   //********************************************************************************

    // test si demande effacement par le post ********************************
   if ( isset($_POST['Effacer']) && $_POST['Effacer'] == 'Effacer'  && !MODE_DEMO ) {
   $test_post_debut = test_date_fr ($_POST['date_debut']);
   $test_post_fin = test_date_fr ($_POST['date_fin']);

   extract($_POST);
   
   if ( $avec_diagonale_cellule )
      $date_fin = jour_precedent ($date_fin,"/","fr");

   if (  $test_post_debut==0 && $test_post_fin==0 ) {

     $date_debut_eng   = ajout_supprime_zero (date_fr_eng($date_debut,"/","-"),"Ajout","-","eng");
     $date_fin_eng     = ajout_supprime_zero (date_fr_eng($date_fin,"/","-"),"Ajout","-","eng");

      // initialisation de variables ******************************************
     unset($tableau_requete);  // initialisation du tableau des logements a marqués***

     //***********************************************************************
     // liste des locations  effacer *****************************************
     //***********************************************************************

     if ( isset($marquer_tous) && $marquer_tous == 'oui' ) {// si marquage de toutes les locations
          $tableau_requete = $nom_logement ;   // tableau des locations = toutes les locations
          unset($tableau_requete[0]); // suppression index logement tous ******
          }
     else
          $tableau_requete[$num_logement_en_cours] = $nom_logement[$num_logement_en_cours];  // tableau des locations = toutes les locations

      //***********************************************************************
      // fonctionnement avec base de données - efface
      //***********************************************************************
     if ( AVEC_BDD ) {
     //connection a la base de donnees*******************************************************************
     $connect = @mysql_connect(Decrypte(hote_cal,$Cle), Decrypte(user_cal,$Cle), Decrypte(password_cal,$Cle)) or die("erreur de connexion au serveur sql");
     @mysql_select_db(Decrypte(base_cal,$Cle), $connect);

     // boucle de marquage des dates pour le ou les locations selectionnées 1 par 1 ****
     foreach ( $tableau_requete as $cle => $nom_logement_requete ) {

     //initialisation liste requete*****************************************
     $tri_logement_requete = " AND id_logement = '".$cle."'" ;
	 $connection_sql_active	= true;

     $req_sql = "delete from ".Decrypte(nom_table_cal,$Cle)." where date_reservation <= '$date_fin_eng' and date_reservation >= '$date_debut_eng' $tri_logement_requete ";
     $creation_reussi = @mysql_query($req_sql);
	 if ( isset($creation_reussi) && $creation_reussi ) {
		 $vecteur_index_logement 	= $cle;
		 include("genere/genere_export_ical.php");
		}
       } // fin boucle foreach suppression des dates dans la base de données*****
         //**********************************************************************
     }    // fin fonctionnement avec base de données ***************************
          //********************************************************************

      //***********************************************************************
      // fonctionnement sans base de données - efface
      //***********************************************************************
      
      else {
       $nb_jour_a_marquer = nb_jour_date ($date_debut,$date_fin,"/","fr") + 1;

       // boucle de marquage des dates pour le ou les locations selectionnées 1 par 1 ****
       foreach ( $tableau_requete as $cle => $nom_logement_requete ) {
       //recupération des dates pour le logement en cours de traitement *********
       unset($tableau_reservation); // réinitialisation des variables tableau ***

       //controle si le fichier est disponible pour écriture *****************
       $fichier_libre = false;
       $chemin_fichier = 'fichier_calendrier/dates_sans_bdd/'.$cle.'_calendrier.php';
       $chemin_fichier_sauvegarde = 'fichier_calendrier/dates_sans_bdd/'.$cle.'_sauvegarde_calendrier.php';
       $pointeur_variable_fin_fichier_ok = 'fin_tableau_reservation_'.$cle;

       while (!isset($$pointeur_variable_fin_fichier_ok)  || !$$pointeur_variable_fin_fichier_ok) {
         include ($chemin_fichier);
         if ( isset($$pointeur_variable_fin_fichier_ok)  && $$pointeur_variable_fin_fichier_ok ) {
         //sauvegarde ancien fichier*********************************
         @copy($chemin_fichier,$chemin_fichier_sauvegarde);
         $file= @fopen($chemin_fichier, "w");
         $fichier_libre = true;
         }
       }

       $date_boucle =   $date_debut_eng ;
       //effacement des dates déjà marquées ************************************************************
       for ( $i = 1; $i <= $nb_jour_a_marquer; $i++ ) {
         if ( isset($tableau_reservation[$cle][$date_boucle]) )
             unset ($tableau_reservation[$cle][$date_boucle]);
         $date_boucle = ajout_jour_date ($date_boucle,1,"JMA","-","eng") ;
       }
       // mise a jour du fichier *********************************************
       $vecteur_index_logement = $cle;
       $chemin_vers_fichier = '';
       if ( $fichier_libre) {
            include("genere/genere_tableau_calendrier.php");
			}
		if ( isset($creation_reussi) && $creation_reussi ) {
		 $vecteur_index_logement 	= $cle;
		 $tableau_reservation_modif = $tableau_reservation ;
		 include("genere/genere_export_ical.php");
		}
       } // fin boucle foreach insertion des dates sans la base de données*****
         //********************************************************************
     }    // fin fonctionnement avec base de données ***************************
          //********************************************************************

     if ( isset($creation_reussi) && $creation_reussi ) {
         $affiche_info = "modif_ok";
		}
     else
         $affiche_info = "erreur_execution";
     include("genere/genere_date_maj.php");
     }
   }

//********************************************************************************
// controle mode démo ************************************************************
//********************************************************************************
  if ( ( (isset($_POST['Marquer'])) ||(isset($_POST['Effacer'])) )&& MODE_DEMO   )
     $affiche_info = 'mode_demo';

// compression code de la page ********************************************************************
 if ( $avec_compression_page )
    ob_start( 'ob_gzhandler' );

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
//----     Ne plus rein modifié                                                                -----
//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

<title>Administration Calendrier des réservations / disponibilités </title>
<meta name="description" content="Calendrier des disponibilités http://www.mathieuweb.fr/calendrier/calendrier.php, calendrier php avec gestion logement et locataire">
<meta name="generator" content="Mathieuweb - http://www.mathieuweb.fr/calendrier/calendrier.php">
<meta http-equiv="Pragma" content="no-cache" >
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" >
<meta http-equiv="Expires" content="0" >
<link rel="stylesheet" href="fichier_calendrier/styles.css?version=<?php echo filemtime('fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >
<script type="text/javascript" src="fonction.js"></script>

<SCRIPT type="text/JavaScript">
<!--
 function init_swap() {
 choix_selecteur_debut =  true ;
 avertissement_date_debut = false ;
 avertissement_date_fin   = false ;
 couleur_fond_champs_selectionne = "#00C7FF";
 couleur_fond_champs_avertissement = "#FF8812";
 couleur_fond_champs_initial     = "#FFFFFF";
 couleur_fond_champs_erreur      = "#F26363"; 
 couleur_texte_champs_selectionne = "#FFFFFF";
 couleur_texte_champs_initial     = "#000000";
 couleur_texte_champs_commentaire = "#000000";
 bordure_champs_initial           = "2px #C0C0C0 solid";
 bordure_champs_modifie           = "4px #C0E37B solid";
 bordure_commentaire_initial      = "1px #C0C0C0 solid";
 bordure_commentaire_modifie      = "3px #E0D182 solid";
 couleur_fond_commentaire_initial = "#FFFFFF";
 couleur_fond_commentaire_modifie = "#F7F0E8";
 document.getElementById('date_debut').style.border=bordure_champs_modifie;
 nom_logement=new Array;
 <?php  // liste des logement tableau javascript *****************************************************
 if ( isset ($nom_logement) ) {
  foreach ($nom_logement as $cle => $libelle_logement ) {
      echo '
            nom_logement[',$cle,']=  "',guillet_var($libelle_logement),'";';
    }
 }
?>
 tarif_logement=new Array;
 <?php  // liste des logement tableau javascript *****************************************************
 if ( isset ($tarif_logement) ) {
  foreach ($tarif_logement as $cle => $prix_logement ) {
      echo '
            tarif_logement[',$cle,']=  "',$prix_logement,'";';
    }
 }
?>
}


//-->
</script>

</head>

<body bgcolor="#FFFFFF" text="#000000" onload ="init_swap()">


<?php

$largeur_div = $largeur_tableau * $nombre_mois_afficher_ligne_admin ;

//selection du mois et année en cours***************************************************************
$mois_en_cours  = (int)$premier_mois ;
$annee_en_cours = $annee_premier_mois ;

// affichage sélection mois, année, couleur et champs de réservations ********************************
echo '<Table border = "0" cellpadding="5" cellspacing="0" width ="100%" id ="selecteur">
      <tr>
      <td align="left" valign="middle" bgcolor="#6785BE" colspan ="3" > <font style="font-size:16px" color="#FFFFFF" face="Arial"><b>Filtrer - choix couleur</b><br></font>
      </td>
      <td align="right" valign="middle" bgcolor="#6785BE" height ="5" > <font style="font-size:12px" color="#FFFFFF" face="Arial"><b>Mon calendrier facile - calendrier ',$version,'</b></font><br><font style="font-size:10px" color="#FFFFFF" face="Arial">www.mathieuweb.fr/calendrier/</font>
      </td>
      </tr>
      <tr>
      <td align="left" valign="middle" bgcolor="#FFFFFF"  >';
   // si nécessaire affichage du sélecteur d'année et de mois*****************************************
   if ( $selection_mois_an ) {
        echo '<a href="',$adresse_page,'?an=',$annee_en_cours - 1, '" class = selection><font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >&nbsp;<< </font></a>';
        echo '<b><font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >&nbsp;',$annee_en_cours,'&nbsp;</font></b>';
        echo '<a href="',$adresse_page,'?an=',$annee_en_cours + 1, '" class = selection><font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >&nbsp;>> </font></a>';
        echo '<form name="sel_mois" method="get" action="',$adresse_page,'" id="Form1">';
        echo '<select name="mois" size="1" id="Combobox1" onchange="document.sel_mois.submit();return false;" style="font-family:',$police,';font-size:',$taille_police_sel_mois_annee,'px;z-index:2">';
        for ($i=1; $i<13; $i++)  {
            if  ( $premier_mois == $i )
                  echo '<option selected value="',$i,'">',$mois_texte[$i],'</option>' ;
             else
                  echo '<option value="',$i,'">',$mois_texte[$i],'</option>' ;
        }
        echo '</select>';
        echo '</form>';
        }
echo '</td>
      <td align="left" valign="middle"  bgcolor="#FFFFFF" >';
   // si nécessaire affichage du sélecteur de couleur **********************************************
   if ( $avec_selection_couleur  ) {
        echo '<form name="sel_couleur" method="get" action="',$adresse_page,'" id="Form1">';
        echo '<font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >Choix de la couleur :<br>
        <select name="couleur" size="1" id="Combobox1" onchange="document.sel_couleur.submit();return false;" style="font-family:',$police,';font-size:',$taille_police_sel_mois_annee,'px;color:',$couleur_texte_jour_reserve[$couleur_texte_reserve_en_cours],';background-color:',$couleur_en_cours,';width:220px;z-index:2"></font>';
        $nb_result = count ($intitule_couleur_reserve);
        if ( $nb_result > 0 ) {
        asort($intitule_couleur_reserve);  //tri alphabétique ********
        foreach ($intitule_couleur_reserve as $cle => $val_couleur )  {
            if  ( $couleur_texte_reserve_en_cours == $cle )
                  echo '<option selected value="',$cle,'" style="background-color:',$couleur_reserve[$cle],';color:',$couleur_texte_jour_reserve[$cle],';font-family:',$police,';font-size:',$taille_police_sel_mois_annee,'px;">',$intitule_couleur_reserve[$cle],'</option>' ;
             else
                  echo '<option value="',$cle,'" style="background-color:',$couleur_reserve[$cle],';color:',$couleur_texte_jour_reserve[$cle],';font-family:',$police,';font-size:',$taille_police_sel_mois_annee,'px;">',$intitule_couleur_reserve[$cle],'</option>' ;
          }
        }
        echo '</select>';
        echo '</form>';
        }
echo '</td>
      <td align="left" valign="middle"  bgcolor="#A5BEE0"  >';
     // si nécessaire affichange du sélecteur de logement **********************************************
    if ( $avec_selection_logement  ) {

        echo '<form name="logement" method="get" action="',$adresse_page,'" id="Form1">
              <font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >Choix ',$item1,':<br>';
        liste_box ("logement",220,$nom_logement,"",false,$_SESSION['sel_tri_logement'],false,"logement");
        echo '</form>';
        }

echo '</td>
      <td align="left" valign="middle"  bgcolor="#FFFFFF" >';


echo '</td></tr>
      <tr>
      <td align="left" valign="middle" bgcolor="#CBA674" colspan ="3" > <font style="font-size:16px" color="#FFFFFF" face="Arial"><b>Marquer / Effacer</b></font>
      </td>
      <td align="right" valign="middle" bgcolor="#CBA674" >
      <div style="color:#FFFFFF;font-size:12px;font-family:Arial;font-weight:normal;font-style:normal;text-decoration:none;text-align:right" id="date_heure_jour"><b></b></div>
      <script type="text/javascript">affiche_date_jour();</script>
      </td>
      </tr>
      <tr>
      <td align="left" valign="middle" bgcolor="#FFFFFF" colspan ="2" rowspan ="3"> ';
    // affichage des champs de saisie de période à marquer****************************************
    if ( $avec_selection_champs_date ) {
      //recherche si tri sur locataire en cours ****************
    $message_infobulle_par_defaut = "Message de l'infobulle";
    echo '
    <form name="marquage" method="post" action="',$adresse_page,'" id="marquage"  onsubmit="return validation_marquage(this)">
    <textarea name="commentaire" id="commentaire" rows="4" cols="43" style="background-color:#FFFFFF;color:#C0C0C0;border:1px #C0C0C0 solid;font-family:Courier New;font-size:14px;font-weight:bold;" onclick="bordure(\'bulle\');return false;">',$message_infobulle_par_defaut,'</textarea>
    <br>
    <input type="button" id="Button3" name="Copier" value="Copier" onclick="copier_ajax(\'commentaire\',\'colle\');return false;" style ="background-color:#00C4FD;color:#FFFFFF;font-family:Arial;font-size:11px;">
    <input type="button" id="Button3" name="Coller" value="Coller" onclick="coller_ajax(\'commentaire\',\'colle.html\');return false;" style ="background-color:#00C4FD;color:#FFFFFF;font-family:Arial;font-size:11px;">
    &nbsp;&nbsp;
    <input type="button" id="Button3" name="Vider" value="Vider" onclick="document.getElementById(\'commentaire\').value=\'\';return false;" style ="background-color:#00C4FD;color:#FFFFFF;font-family:Arial;font-size:11px;">
    &nbsp;&nbsp;
    <input type="button" value="Gras" onClick="insertion(\'<b>\', \'</b>\',\'commentaire\')" style ="background-color:#00C4FD;color:#FFFFFF;font-family:Arial;font-size:11px;">
    <input type="button" value="Italique" onClick="insertion(\'<i>\', \'</i>\',\'commentaire\')" style ="background-color:#00C4FD;color:#FFFFFF;font-family:Arial;font-size:11px;">
    <input type="button" value="Souligné" onClick="insertion(\'<u>\', \'</u>\',\'commentaire\')" style ="background-color:#00C4FD;color:#FFFFFF;font-family:Arial;font-size:11px;">
    <a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">
    <u>Pour copier le texte contenu dans l\'infobulle</u>, cliquez sur "Copier" (vous n\'avez pas besoin de sélectionner le texte, tout le texte contenu dans l\'infobulle sera copié)<br><br>
    <u>Pour coller le texte contenu dans l\'infobulle</u>, cliquez sur "Coller", ce bouton va remplir l\'infobulle avec le dernier texte qui a été copié avec le bouton "Copier"<br><br>
    <u>Pour vider toute le contenu de l\'infobulle</u>, cliquez sur "Vider"<br><br>
    <u>Pour mettre en forme le contenu de l\'infobulle</u> :<br><br>
     <u>- pour mettre en gras</u> : sélectionnez la partie du texte à mettre en gras, puis cliquez sur le bouton "Gras", des balises de mise en forme du texte seront automatiquement ajoutées au contenu de l\'infobulle, le rendu réel ne sera visible que sur les infobulles des calendriers<br><br>
     <u>- pour mettre en italique</u> : sélectionnez la partie du texte à mettre en italique, puis cliquez sur le bouton "Italique", des balises de mise en forme du texte seront automatiquement ajoutées au contenu de l\'infobulle, le rendu réel ne sera visible que sur les infobulles des calendriers<br><br>
     <u>- pour souligné</u> : sélectionnez la partie du texte à mettre à souligner, puis cliquez sur le bouton "Souligné", des balises de mise en forme du texte seront automatiquement ajoutées au contenu de l\'infobulle, le rendu réel ne sera visible que sur les infobulles des calendriers<br><br>
    </font>
    </em></a>
    </td>
    <td align="left" valign="middle" bgcolor="#FFFFFF">
    <font style="font-size:16px;" color="#000000" face="Arial">Date début</font>
    <input id="date_debut" name="date_debut" type="text" size="12" value="JJ/MM/AAAA" style="background-color:#FFFFFF;color:#C0C0C0;border:1px #C0C0C0 solid"  onclick="bordure(\'debut\');return false;"  >
    <a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">
    Pour remplir ce champs, cliquez directement sur les dates du calendrier ci dessous. Vous pouvez également remplir le champs manuellement en indiquant la date au format JJ/MM/AAAA. Atttention la date de fin doit toujours être postérieure à la date début.
    </font>
    </em></a>
    <input type="hidden" id="format_cal" name="format_cal" value="">
    </td>
    <td align="left" valign="middle" bgcolor="#FFFFFF" >';
   // si nécessaire affichage du sélecteur de Locataire **********************************************
   if ( $avec_selection_locataire  ) {
        echo '<font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >Choix Locataire:<br>';
        liste_box ("locataire",220,$nom_locataire,$prenom_locataire,false,$_SESSION['sel_tri_locataire'],true,"");
        }
    echo '
    </td><tr>
    <td align="left" valign="middle" bgcolor="#FFFFFF">
    <font style="font-size:16px;" color="#000000" face="Arial">Date fin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
    <input id="date_fin" name="date_fin" type="text" size="12" value="JJ/MM/AAAA" style="background-color:#FFFFFF;color:#C0C0C0;border:1px #C0C0C0 solid"  onclick="bordure(\'fin\');return false">
    <a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">
    Pour remplir ce champs, cliquez directement sur les dates du calendrier ci dessous. Vous pouvez également remplir le champs manuellement en indiquant la date au format JJ/MM/AAAA. Atttention la date de fin doit toujours être postérieure à la date début.
    </font>
    </em></a>
    </td>
    <td align="left" valign="middle" id = "cellule_marquer_tous"  style ="background-color: #FFFFFF;">
    <input type="checkbox" id="marquer_tous" name="marquer_tous" value="oui" onclick = "message_alerte(\'marquer_tous\');">
    <font style="font-size:16px;" color="#000000" face="Arial">Pour tous les ',$item1,'</font>
    <a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">
    En cochant cette option, les dates seront marquées ou éffacées pour tous les locations existantes
    </font>
    </em></a>
    </td>
    </tr>
    <tr>
    <td align="left" valign="middle" bgcolor="#FFFFFF">
    <font style="font-size:16px;" color="#000000" face="Arial">Tarif / jour&nbsp;&nbsp;&nbsp;</font>
    <input id="tarif" name="tarif" type="text" size="12" value="',$tarif_logement[$num_logement_en_cours],'" style="background-color:#FFFFFF;color:#909090;border:1px #C0C0C0 solid"  onclick="bordure(\'tarif\');return false">
    <a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">
    Le champs tarif est le tarif journalier de la location, si vous remplissez les champs dates en cliquant sur le calendrier ci dessous, il sera automatiquement rempli par le tarif par défaut de la location ( modifiable sur la page de gestion des locations). Le champs peut également être saisi/ modifié manuellement
    </font>
    </em></a>
    </td>
    <td align="left" valign="middle" id = "marquer_effacer"  >
    <input type="submit" id="Button2" name="Marquer" value="Marquer" style ="background-color:#4B4B4B;color:#FFFFFF;font-family:Arial;font-size:16px;">
    &nbsp;&nbsp;&nbsp;
    <input type="submit" id="Button3" name="Effacer" value="Effacer" onclick="return(confirm(\'Effacer toutes ces dates pour ce logement? \'));return false;" style ="background-color:#FF6262;color:#FFFFFF;font-family:Arial;font-size:16px;">
    <a href="#" class = "texte_infobulle" ><img src="images/help.gif" id = "aide_avertissement_marquage" border="0" style = "visibility:hidden;"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">
    Attention! Vous avez sélectionnez des dates qui sont déjà réservées
    </font>
    </em></a>
    </form>
    </td>
    </tr>
    <tr>
    <td align="left" valign="middle" bgcolor="#C0E37B" colspan ="3" > <font style="font-size:16px" color="#FFFFFF" face="Arial"><b>Calendrier - ',$nom_logement[$num_logement_en_cours],' -</b></font></td>
    <td align="right" valign="middle" bgcolor="#C0E37B"  ><font style="font-size:12px" color="#FFFFFF" face="Arial">Date dernière mise à jour : ',$date_maj_calendrier["fr"],'</font>
    </td>
    </tr>
    </table> ';
    }
//initailisation compteur de mois par ligne*********************************************************
$compteur_mois_ligne = 1 ;

echo '<table cellSpacing="',$espace_entre_les_mois,'" id="affiche_cal">
      <tr>
      <td nowrap>';

//calcul pour récupération des dates dans la période voulue **************************************
$poub_mois_dernier_mois = $premier_mois ;
$poub_annee_dernier_mois = $annee_premier_mois;
$jour_en_seconde = 3600 * 24 ;
//calcul numéro dernier mois et année du dernier mois ********************************************
for ( $temp_compteur_mois = 1; $temp_compteur_mois < $nombre_mois_afficher_admin ; $temp_compteur_mois++ )  {
      $poub_mois_dernier_mois++;
      if ( $poub_mois_dernier_mois > 12 ) {
           $poub_mois_dernier_mois = 1;
           $poub_annee_dernier_mois++;
           }
}
//incrément pour avoir numéro dernier jour du mois avec fonction mktime **************************
$poub_mois_dernier_mois++;
if ( $poub_mois_dernier_mois > 12 ) {
     $poub_mois_dernier_mois = 1;
     $poub_annee_dernier_mois++;
     }

$periode_location = 7;
//mise en forme des dates premier et dernier jours **********************************************
   $poub_date_premier_jour = $annee_premier_mois."-".($premier_mois-1)."-".strftime("%d",mktime ( 0,0,0,$premier_mois ,0,$annee_premier_mois));
   $poub_date_dernier_jour = $poub_annee_dernier_mois."-".$poub_mois_dernier_mois."-".strftime("%d",mktime ( 0,0,0,$poub_mois_dernier_mois ,0,$poub_annee_dernier_mois));
   $memoire_jour_precedent = '';

//************************************************************************
// creation des tableaux dates ************************************
//************************************************************************
$date_premier_jour_tableau = ajout_jour_date (ajout_supprime_zero ($poub_date_premier_jour,"Ajout","-","eng"),-7,"JMA","-","eng");
$date_dernier_jour_tableau = ajout_jour_date (ajout_supprime_zero ($poub_date_dernier_jour,"Ajout","-","eng"),7,"JMA","-","eng");
$nombre_jour_pour_periode = (int) nb_jour_date ($date_premier_jour_tableau,$date_dernier_jour_tableau,"-","eng");

$date_boucle = ajout_supprime_zero ($date_premier_jour_tableau,"Ajout","-","eng");

//initialisation du tableau des jours reservés dans le mois en cours*****************************
   for ( $i=0; $i < $nombre_jour_pour_periode+2; $i++ ) {
        list($annee_index,$mois_index,$jour_index) = explode ( "-", $date_boucle ) ;
        $jour_reserve[$date_boucle] = (bool)false ;
        $couleur_reserve_cellule[$date_boucle] = '' ;
        $class_reserve_cellule[$date_boucle] = '' ;
        $couleur_police_reserve_bdd[$date_boucle] = '' ;
        $contenu_infobulle[$date_boucle] = '';
        $contenu_texte_infobulle[$date_boucle] = '';
        $locataire_reserve[$date_boucle] = '';
        $logement_reserve[$date_boucle] = '';
        $texte_type_reservation[$date_boucle] = '';
        $tarif_reservation[$date_boucle] = '';
        $index_valeur_jour_semaine = date("w",mktime(6, 0, 0, $mois_index, $jour_index, $annee_index));
        $memoire_bckgrd_jour[$date_boucle] =( $index_valeur_jour_semaine == 0 || $index_valeur_jour_semaine == 6 ) ? 'weekend' : 'libre';
        $date_boucle = ajout_jour_date ($date_boucle,1,"JMA","-","eng") ;
        }

//************************************************************************
// fonctionnement avec base de données
//************************************************************************
if ( AVEC_BDD ) {
    //connection a la base de donnees*******************************************************************
    $connect = @mysql_connect(Decrypte(hote_cal,$Cle), Decrypte(user_cal,$Cle), Decrypte(password_cal,$Cle));
    if (!$connect )
       echo '<font style="font-size:16px" color="#FF0000" face="Arial"><b>** Erreur de connexion au serveur sql **</b><br></font>' ;
    else {
    // on choisit la bonne base
    $connect_base = @mysql_select_db(Decrypte(base_cal,$Cle), $connect) ;
    if (!$connect_base )
       echo '<font style="font-size:16px" color="#FF0000" face="Arial"><b>** Erreur de connexion à la base sql **</b><br></font>' ;
    else {
   //recherche des jours reservés dans le mois en cours*********************************************
   $valeur_select = "SELECT * FROM ".Decrypte(nom_table_cal,$Cle)." WHERE date_reservation >= '$date_premier_jour_tableau' AND date_reservation <= '$date_dernier_jour_tableau' $tri_logement order by date_reservation, id ";
   $requete = @mysql_query ($valeur_select);
   while ( $data = mysql_fetch_object($requete) )
          {
            $date_index =  $data->date_reservation;
            list($annee_bdd,$mois_bdd,$jour_bdd) = explode ("-",$date_index );
            $jour_reserve[$date_index] = (bool)true ;
            $temp_couleur_texte = $data->couleur_texte ;
            $logement_reserve[$date_index]  = ( $data->id_logement <> 0 ) ? $nom_logement[$data->id_logement] : '';
            if ($memoire_jour_precedent <> $date_index || $couleur_invisible[$temp_couleur_texte]) { //controle de date en doublon pour ne garder que les couleures transparentes
                $couleur_reserve_cellule[$date_index] = $data->couleur;
                $class_reserve_cellule[$date_index] = "jour_reserve_".$data->couleur_texte;
                $couleur_police_reserve_bdd[$date_index] = $data->couleur_texte;
                $texte_type_reservation[$date_index] = $intitule_couleur_reserve[$data->couleur_texte];
                $locataire_reserve[$date_index] =  ( $data->id_locataire <> 0 ) ? $nom_locataire[$data->id_locataire]." ".$prenom_locataire[$data->id_locataire] : '';
                $tarif_reservation[$date_index] = ( isset($format_calendrier_logement[$data->id_logement]) && $format_calendrier_logement[$data->id_logement] == 'calendrier_periode' ) ? (($data->tarif)*$periode_location)." euros" : $data->tarif ;
                $contenu_texte_infobulle[$date_index] = $data->commentaires;
                $contenu_infobulle[$date_index]  =  ( $data->commentaires <> '' ) ? stripslashes($data->commentaires)."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_affichage_infobulle_complete ) ? $texte_type_reservation[$date_index]."<br>": '';
                $contenu_infobulle[$date_index] .=  ( $avec_affichage_infobulle_complete && $locataire_reserve[$date_index] <> '') ?"<u>Locataire</u> :".addslashes($locataire_reserve[$date_index])."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_affichage_infobulle_complete ) ? "<u>Tarif</u> :".$data->tarif." €<br>" : '';
                $contenu_infobulle[$date_index] .=  $texte_jour_fr[date("w",mktime(6, 0, 0, $mois_bdd, $jour_bdd, $annee_bdd))]." ".$jour_bdd." ".$mois_texte[(int)$mois_bdd]." ".$annee_bdd ;
                }
            $memoire_jour_precedent = $date_index;
          }
    mysql_close();
      }
   }
} // fin de recupération avec base de données ***************************

//************************************************************************
// fonctionnement avec base de données
//************************************************************************
elseif ( !AVEC_BDD ) {

   //recupération des dates pour le logement en cours de traitement *********
   unset($tableau_reservation); // réinitialisation des variables tableau ***
   $fichier_calendrier = "fichier_calendrier/dates_sans_bdd/".$num_logement_en_cours."_calendrier.php";
   if ( file_exists($fichier_calendrier) ) {
	   
	    if ( isset($tableau_reservation_modif[$num_logement_en_cours]) && is_array($tableau_reservation_modif[$num_logement_en_cours])  )
			$tableau_reservation[$num_logement_en_cours] = $tableau_reservation_modif[$num_logement_en_cours];
		else
			include("fichier_calendrier/dates_sans_bdd/".$num_logement_en_cours."_calendrier.php");
	   
   }

   //controle des fichiers
   $pointeur_variable_ctrl_fin_fichier = 'fin_tableau_reservation_'.$num_logement_en_cours;
   if (!isset($$pointeur_variable_ctrl_fin_fichier))
    $affiche_info = 'erreur_fichier_dates';

   if ( isset($tableau_reservation) ) {

   //mise en forme des dates premier et dernier jours **********************************************
   $nombre_jour_periode =  (int) nb_jour_date ($poub_date_premier_jour,$date_dernier_jour_tableau,"-","eng") + 1;
   $date_index = $date_premier_jour_tableau ;
   for ( $i = 1 ; $i <= $nombre_jour_periode + 2 ; $i++ ) {
     if (array_key_exists($date_index, $tableau_reservation[$num_logement_en_cours]))  {
          
          list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$tableau_reservation[$num_logement_en_cours][$date_index]);
            list($annee_bdd,$mois_bdd,$jour_bdd) = explode ("-",$date_index );
            $jour_reserve[$date_index] = (bool)true ;
            $temp_couleur_texte = $couleur_texte_temp ;
            $logement_reserve[$date_index]  = ( $num_logement_en_cours <> 0 ) ? $nom_logement[$num_logement_en_cours] : '';
            if ($memoire_jour_precedent <> $date_index || $couleur_invisible[$temp_couleur_texte]) { //controle de date en doublon pour ne garder que les couleures transparentes
                $couleur_reserve_cellule[$date_index] = $couleur_temp;
                $class_reserve_cellule[$date_index] = "jour_reserve_".$couleur_texte_temp;
                $couleur_police_reserve_bdd[$date_index] = $couleur_texte_temp;
                $texte_type_reservation[$date_index] = $intitule_couleur_reserve[$couleur_texte_temp];
                $locataire_reserve[$date_index]  =  ( $tri_locataire_temp <> 0 ) ? $nom_locataire[$tri_locataire_temp]." ".$prenom_locataire[$tri_locataire_temp] : '';
                $tarif_reservation[$date_index]  =  ( isset($format_calendrier_logement[$num_logement_en_cours]) && $format_calendrier_logement[$num_logement_en_cours] == 'calendrier_periode' ) ? (($tarif_temp)*$periode_location)." euros" : $tarif_temp ;
                $contenu_texte_infobulle[$date_index] =  $commentaire_temp;
                $contenu_infobulle[$date_index]  =  ( $commentaire_temp <> '' ) ? stripslashes($commentaire_temp)."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_affichage_infobulle_complete ) ? $texte_type_reservation[$date_index]."<br>": '';
                $contenu_infobulle[$date_index] .=  ( $avec_affichage_infobulle_complete && $locataire_reserve[$date_index] <> '') ?"<u>Locataire</u> :".addslashes($locataire_reserve[$date_index])."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_affichage_infobulle_complete ) ? "<u>Tarif</u> :".$tarif_temp."<br>" : '';
                $contenu_infobulle[$date_index] .=  $texte_jour_fr[date("w",mktime(6, 0, 0, $mois_bdd, $jour_bdd, $annee_bdd))]." ".$jour_bdd." ".$mois_texte[(int)$mois_bdd]." ".$annee_bdd ;
               }
            $memoire_jour_precedent = $date_index;
         }
       $date_index = ajout_jour_date ($date_index,1,"JMA","-","eng");
     }
   }
}

//initialisation de variables************************************************************************

$date_aujourd_hui = ajout_supprime_zero (date("Y-m-d"),"Ajout","-","eng");

// chemin vers le fichier calendrier selon le format désiré *************
     include($format_calendrier_admin.".php");
?>