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

//nom de la page ou se trouve le script*************************************************************
$adresse_page         = "index_tous.php";
//nom de la page a ouvrir lorsqu'on clic sur une date***********************************************
$adresse_destination  = "index_tous.php";

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

// initialisation variables ************************************************************************

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
$avec_selection_capacite      = true;
$avec_selection_region      = true;

//format de date sur le lien des jours dans le calendrier--------------------------------------------
// si true alors selection format francais, si false alors format date anglais-----------------------
$format_date_fr    = true ;

//insertion des langues ************************************************
     $_GET['langue'] = 'fr' ;
     include("fichier_calendrier/langue.php");

//choix du logement*********************************************************************************
$tri_logement = ' ';
$tri_logement2 = ", ' '";
$tri_logement3 = ' ';

//controle si choix du logement dans l'url**********************************************************
if ( (isset($_POST['logement'])) && (empty($_POST['logement'])) )
    $_SESSION['sel_tri_logement'] = '' ;
if ( (isset($_POST['logement'])) && (!(empty($_POST['logement']))) )
    $_SESSION['sel_tri_logement'] = $_POST['logement'] ;
//si session logement existe alors le logement de la session devient prioritaire********************
if ( (isset($_SESSION['sel_tri_logement'])) && (!(empty($_SESSION['sel_tri_logement']))) ) {
   $tri_logement = " AND id_logement = '".$_SESSION['sel_tri_logement']."'" ;
   $tri_logement2 = ", '".$_SESSION['sel_tri_logement']."'" ;
   $tri_logement3 = " AND id = '".$_SESSION['sel_tri_logement']."'" ;
   }

//choix du locataire********************************************************************************
   $tri_locataire = ' ';
   $tri_locataire2 = ", ' '";
   $num_locataire_en_cours = '';
   $tri_locataire_ssbdd = 0;
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
    unset ($_SESSION['go_date']) ;
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
    unset ($_SESSION['go_date']) ;
   }
//si session année existe alors la session devient prioritaire**************************************
if ( (isset($_SESSION['an'])) && (!(empty($_SESSION['an']))) )
   $annee_premier_mois = $_SESSION['an'] ;

//controle choix date de départ*************************************************************
$date_premier_mois_eng = $annee_premier_mois."-".$premier_mois."-01";
if ( (isset($_GET['go_date'])) && (empty($_GET['go_date'])) )
    $_SESSION['go_date'] = '' ;
if ( (isset($_GET['go_date'])) && (!(empty($_GET['go_date']))) && test_date_eng ($_GET['go_date']) == 0 ) {
   $_SESSION['go_date'] = $_GET['go_date'] ;
   $date_explosee = explode ("-", $_GET['go_date']);
   $annee_premier_mois  = (int)$date_explosee[0];
   $_SESSION['an'] =  $annee_premier_mois;
   $premier_mois  = (int)$date_explosee[1];
   $_SESSION['mois']  = $premier_mois;
   }
//si session mois existe alors la session devient prioritaire***************************************
if ( (isset($_SESSION['go_date'])) && (!(empty($_SESSION['go_date']))) )
   $date_premier_mois_eng = $_SESSION['go_date'] ;

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
//test si couleur "Effacer" **************************************************************************
   $couleur_efface = ( !(isset($_SESSION['choix_couleur_texte_reserve'])) || ($_SESSION['choix_couleur_texte_reserve'] == '') || $_SESSION['choix_couleur_texte_reserve'] == 0 ) ? true : false ;

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
          $tableau_requete[$logement_debut] = $nom_logement[$logement_debut];  // tableau des locations = toutes les locations

      //***********************************************************************
      // fonctionnement avec base de données
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
      $tri_logement_req = ", '".$cle."'" ;
      $tri_logement_requete = " AND id_logement = '".$cle."'" ;
      $liste_query = '';
      $compare_date = nb_jour_date ($date_debut,$date_fin,"/","fr");

      //effacement des dates eventuellement déjà marquées si la couleur en cours n'est pas une couleur invisible******
      $req_sql = "delete from ".Decrypte(nom_table_cal,$Cle)." where date_reservation >= '$date_debut_eng' and date_reservation <= '$date_fin_eng' $tri_logement_requete ";
      if ( !$couleur_invisible[$couleur_texte_reserve_en_cours] )
           @mysql_query($req_sql);

      //ajout dans la liste du premier jour **************************************************************************
      $liste_query .= "(NULL, '".$date_boucle."', '".$couleur_en_cours."', '".$couleur_texte_reserve_en_cours."' $tri_logement_req  $tri_locataire2 , '".$commentaire."', '".$tarif."')";

      while ( $compare_date > 0 ) {
      $date_boucle  =  ajout_jour_date ($date_boucle,1,"JMA","-","eng");
      if ( $liste_query <> '')   // controle si premiere insertion
        $liste_query .= ' ,';
      // on ajoute les marqueurs dans la semaine*******************************
      $liste_query .= "(NULL, '".$date_boucle."', '".$couleur_en_cours."', '".$couleur_texte_reserve_en_cours."' $tri_logement_req  $tri_locataire2 , '".$commentaire."', '".$tarif."')";
      $compare_date = nb_jour_date ($date_boucle,$date_fin_eng,"-","eng");
      }
     $liste_query .= " ;";

     $query = "INSERT INTO `".Decrypte(nom_table_cal,$Cle)."` (`id`, `date_reservation`, `couleur`, `couleur_texte`, `id_logement`, `id_locataire`, `commentaires`, `tarif`) VALUES
              $liste_query";
     $creation_reussi = @mysql_query($query); //echo $query;
     if ( isset($creation_reussi) && $creation_reussi ) {
		 $vecteur_index_logement = $cle;
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

      $nb_jour_a_marquer = nb_jour_date ($date_debut,$date_fin,"/","fr") + 1; //echo $nb_jour_a_marquer;
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
         $affiche_info = "modif_ok";
		}
     else
         $affiche_info = "erreur_execution";

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
          $tableau_requete[$logement_debut] = $nom_logement[$logement_debut];  // tableau des locations = toutes les locations

     //***********************************************************************
     // fonctionnement avec base de données
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
<meta name="description" content="Calendrier des disponibilités , hébergé votre calendrier des disponibilités sur http://www.mathieuweb.fr/calendrier/calendrier.php, calendrier php avec gestion logement et locataire">
<meta name="generator" content="Mathieuweb - http://www.mathieuweb.fr/calendrier/calendrier.php">
<meta http-equiv="Pragma" content="no-cache" >
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" >
<meta http-equiv="Expires" content="0" >
<link href="fichier_calendrier/styles.css?version=<?php echo filemtime('fichier_calendrier/styles.css');?>" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="fonction_tous.js"></script>

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
 format_calendrier_logement=new Array;
 <?php  // liste des logement tableau javascript *****************************************************
 if ( isset ($format_calendrier_logement) ) {
  foreach ($format_calendrier_logement as $cle => $type_cal_log ) {
      echo '
            format_calendrier_logement[',$cle,']=  "',$type_cal_log,'";';
    }
 }
?>
}



//-->
</script>

</head>

<body bgcolor="#FFFFFF" text="#000000" onload ="init_swap()">


<?php

//selection du mois et année en cours***************************************************************
$mois_en_cours  = (int)$premier_mois ;
$annee_en_cours = $annee_premier_mois ;

// affichage sélection mois, année, couleur et champs de réservations ********************************
echo '<Table border = "0" cellpadding="5" cellspacing="0" width ="100%">
      <tr>
      <td align="left" valign="middle" bgcolor="#6785BE" colspan ="3" > <font style="font-size:16px" color="#FFFFFF" face="Arial"><b>Séléction</b><br></font>
      </td>
      <td align="right" valign="middle" bgcolor="#6785BE" height ="5" > <font style="font-size:12px" color="#FFFFFF" face="Arial"><b>Mon calendrier facile - calendrier ',$version,'</b></font><br><font style="font-size:10px" color="#FFFFFF" face="Arial">www.mathieuweb.fr/calendrier/</font>
      </td>
      </tr>
      <tr>
      <td align="left" valign="middle" bgcolor="#FFFFFF" >';
   // si nécessaire affichage du sélecteur d'année et de mois*****************************************
   if ( $selection_mois_an ) {
        echo '<a href="',$adresse_page,'?an=',$annee_en_cours - 1, '" class = selection><font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >&nbsp;<< </a></font>';
        echo '<b><font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >&nbsp;',$annee_en_cours,'&nbsp;</font></b>';
        echo '<a href="',$adresse_page,'?an=',$annee_en_cours + 1, '" class = selection><font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >&nbsp;>> </a></font>';
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
        echo '<font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >Choix de la couleur :<br><select name="couleur" size="1" id="Combobox1" onchange="document.sel_couleur.submit();return false;" style="font-family:',$police,';font-size:',$taille_police_sel_mois_annee,'px;color:',$couleur_texte_jour_reserve[$couleur_texte_reserve_en_cours],';background-color:',$couleur_en_cours,';width:220px;z-index:2"></font>';
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

//**************************************************************************************
// champs sélecteur de période pour calendrier journalier ******************************
//**************************************************************************************

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
      <td align="left" valign="middle" bgcolor="#FFFFFF" colspan ="2" rowspan ="4"> ';
    // affichage des champs de saisie de période à marquer****************************************
    if ( $avec_selection_champs_date ) {
      //recherche si tri sur locataire en cours ****************
    $message_infobulle_par_defaut = "Message de l'infobulle";
    echo '
    <form name="marquage" method="post" action="',$adresse_page,'" id="marquage"  onsubmit="return validation_marquage(this)">
    <textarea name="commentaire" id="commentaire" rows="5" cols="43" style="background-color:#FFFFFF;color:#C0C0C0;border:1px #C0C0C0 solid;font-family:Courier New;font-size:14px;font-weight:bold;" onclick="bordure(\'bulle\');return false;">',$message_infobulle_par_defaut,'</textarea>
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
    <input id="date_debut" name="date_debut" type="text" size="12" value="JJ/MM/AAAA" style="background-color:#FFFFFF;color:#C0C0C0;border:1px #C0C0C0 solid" readonly onclick="bordure(\'debut\');return false;"  >
    <a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">
    Pour remplir ce champs, cliquez directement sur les dates du calendrier ci dessous. Ce champs ne peut être modifié manuellement
    </font>
    </em></a>
    </td>
    <td align="left" valign="middle" bgcolor="#FFFFFF" >';
       // si nécessaire affichage du sélecteur de Locataire **********************************************
    if ( $avec_selection_locataire  ) {
        echo '<font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >Choix Locataire:<br>';
        liste_box ("locataire",220,$nom_locataire,$prenom_locataire,false,$_SESSION['sel_tri_locataire'],true,"");
        }
    echo '
    </td>
    </tr>
    <tr>
    <td align="left" valign="middle" bgcolor="#FFFFFF">
    <font style="font-size:16px;" color="#000000" face="Arial">Date fin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
    <input id="date_fin" name="date_fin" type="text" size="12" value="JJ/MM/AAAA" style="background-color:#FFFFFF;color:#C0C0C0;border:1px #C0C0C0 solid" readonly onclick="bordure(\'fin\');return false">
    <a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">
    Pour remplir ce champs, cliquez directement sur les dates du calendrier ci dessous. Ce champs ne peut être modifié manuellement
    </font>
    </em></a>
    </td>
    <td align="left" valign="middle" bgcolor="#FFFFFF"> 
    </td>
    </tr>
    <tr>
    <td align="left" valign="middle" bgcolor="#FFFFFF">
    <font style="font-size:16px;" color="#000000" face="Arial">Tarif / jour&nbsp;&nbsp;&nbsp;</font>
    <input id="tarif" name="tarif" type="text" size="12" value="" style="background-color:#FFFFFF;color:#909090;border:1px #C0C0C0 solid"  onclick="bordure(\'tarif\');return false">
    <a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">
    Le champs tarif est le tarif journalier de la location, si vous remplissez les champs dates en cliquant sur le calendrier ci dessous, il sera automatiquement rempli par le tarif par défaut de la location ( modifiable sur la page de gestion des locations). Le champs peut également être saisi/ modifié manuellement
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
    <input type="hidden" id="logement_debut" name="logement_debut" value="">
    <input type="hidden" id="logement_fin" name="logement_fin" value="">
    <input type="hidden" id="index_membre" name="index_membre" value="">
    <input type="hidden" id="format_cal" name="format_cal" value="">
    <tr>
    <td align="left" valign="middle" bgcolor="#FFFFFF">
    <font style="font-size:16px;" color="#000000" face="Arial">',$item1,'</font>
    <input id="affiche_logement" name="affiche_logement" type="text" size="20" value="" style="background-color:#FFFFFF;color:#1A84AB;border:1px #C0C0C0 solid" readonly onclick="alert(\'Ce champs n\\\'est pas modifiable ! \nCliquez directement sur les dates du calendrier, il sera rempli automatiquement.\');">
    <a href="#" class = "texte_infobulle" ><img src="images/help.gif" border="0"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">
    Ce champs indique le logement en cours, il est automatiquement rempli lors du clique sur les dates du calendrier ci dessous, ce champs ne peut pas être modifié.
    </font>
    </em></a>
    </td>
    <td align="left" valign="middle" bgcolor="#FFFFFF" id = "marquer_effacer"  >
    <input type="submit" id="Button2" name="Marquer" value="Marquer" style ="background-color:#4B4B4B;color:#FFFFFF;font-family:Arial;font-size:16px;">
    &nbsp;&nbsp;&nbsp;
    <input type="submit" id="Button3" name="Effacer" value="Effacer" onclick="return(confirm(\'Effacer toutes ces dates pour ce logement? \'));return false;" style ="background-color:#FF6262;color:#FFFFFF;font-family:Arial;font-size:16px;">
    <a href="#" class = "texte_infobulle" ><img src="images/help.gif" id = "aide_avertissement_marquage" border="0" style = "visibility:hidden;"><em><span></span><font style="font-size:13px" color="#000000" face="MS Sans Serif">
    Attention! Vous avez sélectionnez des dates qui sont déjà réservées
    </font>
    </em></a>
    </td>
    </tr>
    </form>
    <tr>
    <td align="left" valign="middle" bgcolor="#C0E37B" colspan ="3" > <font style="font-size:16px" color="#FFFFFF" face="Arial"><b>Calendrier</b></font></td>
    <td align="right" valign="middle" bgcolor="#C0E37B"  ><font style="font-size:12px" color="#FFFFFF" face="Arial">Date dernière mise à jour : ',$date_maj_calendrier["fr"],'</font>
    </td>
    </tr>
    </table> ';
    }
    

//************************************************************************************************
//calcul pour récupération des dates dans la période voulue **************************************
//************************************************************************************************
$nombre_jour_pour_periode    = 7 * $nombre_semaine_calendrier_tous;   // période à afficher en nombre de jours
$j = $offset_depart_calendrier_tous ;
// offset de recherche des dates dans la bdd par rapport a la premiere date recalulée,
// a cause des types de calendrier confondus permet de s'assurer que toutes les dates soient bien affichées
// quelques soit leur parametrage ( difference jour debut semaine, calendrier période,etc..)

$jour_deb_periode_trouve = false;
while ( !$jour_deb_periode_trouve ) { // recherche du jour de semaine de debut de période avec au moins une semaine de recul
    $date_premier_jour_calendrier = ajout_jour_date ($date_premier_mois_eng,$j,"JMA","-","eng");
    $date_premier_jour_explode = explode ("-",$date_premier_jour_calendrier);
    $index_jour_ligne_liste_jour = date("w",mktime ( 6,0,0,$date_premier_jour_explode[1] ,$date_premier_jour_explode[2],$date_premier_jour_explode[0])) ;  //numero du jour dans le semaine
    if ( $texte_jour_fr[$index_jour_ligne_liste_jour]== $texte_jour_debut_calendrier_tous)
       $jour_deb_periode_trouve = true;
    $j--;
    }
    
$date_dernier_jour_calendrier = ajout_jour_date ($date_premier_jour_calendrier,$nombre_jour_pour_periode+4,"JMA","-","eng");
$date_offset = ajout_jour_date ($date_premier_jour_calendrier,$offset_depart_calendrier_tous,"JMA","-","eng");

//************************************************************************
// creation des tableaux dates ************************************
//************************************************************************

$date_premier_jour_tableau = ajout_jour_date (ajout_supprime_zero ($date_premier_jour_calendrier,"Ajout","-","eng"),-7,"JMA","-","eng");
$date_dernier_jour_tableau = ajout_jour_date (ajout_supprime_zero ($date_dernier_jour_calendrier,"Ajout","-","eng"),7,"JMA","-","eng");

if ( isset ($nom_logement) ) {
foreach ($nom_logement as $cle => $libelle_logement ) {
$date_boucle = $date_premier_jour_tableau;
if ( $cle <> 0 ) {
//initialisation du tableau des jours reservés dans le mois en cours*****************************
   for ( $i=0; $i < $nombre_jour_pour_periode+abs($offset_depart_calendrier_tous)+28; $i++ )  {
        list($annee_index,$mois_index,$jour_index) = explode ( "-", $date_boucle ) ;
        $jour_reserve[$cle][$date_boucle] = (bool)false ;
        $couleur_reserve_cellule[$cle][$date_boucle] = '' ;
        $class_reserve_cellule[$cle][$date_boucle] = '' ;
        $couleur_police_reserve_bdd[$cle][$date_boucle] = '' ;
        $locataire_reserve[$cle][$date_boucle] = '';
        $texte_type_reservation[$cle][$date_boucle] = '';
        $index_valeur_jour_semaine = date("w",mktime(6, 0, 0, $mois_index, $jour_index, $annee_index));
        $contenu_texte_infobulle[$cle][$date_boucle]  = '' ;
        $contenu_infobulle[$cle][$date_boucle]  = $item1." : ".$libelle_logement."<br>";
        $contenu_infobulle[$cle][$date_boucle] .=  ( $avec_affichage_infobulle_complete ) ? "<u>Tarif</u> :".$tarif_logement[$cle]." €<br>" : '';
        $contenu_infobulle[$cle][$date_boucle] .=  ( $avec_affichage_infobulle_complete ) ? "<u>Capacité</u> :".$capacite_logement[$cle]." personnes<br>" : '';
        $contenu_infobulle[$cle][$date_boucle] .= $texte_jour_fr[$index_valeur_jour_semaine]." ".$jour_index." ".$mois_texte[(int)$mois_index]." ".$annee_index;
        $memoire_bckgrd_jour[$cle][$date_boucle] =( $index_valeur_jour_semaine == 0 || $index_valeur_jour_semaine == 6 ) ? 'weekend' : 'libre';
        $date_boucle = ajout_jour_date ($date_boucle,1,"JMA","-","eng") ;
        }
    }
  }
}

//************************************************************************
// fonctionnement avec base de données
//************************************************************************
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
   $memoire_jour_precedent = '';
   //recherche des jours reservés dans le mois en cours*********************************************
   $valeur_select = "SELECT * FROM ".Decrypte(nom_table_cal,$Cle)." WHERE date_reservation >= '$date_premier_jour_tableau' AND date_reservation <= '$date_dernier_jour_tableau'   order by id_logement , date_reservation, id ";
   $requete = @mysql_query ($valeur_select);
   while ( $data = mysql_fetch_object($requete) )
          {
            if (!isset($memoire_du_logement) )
                 $memoire_du_logement = $data->id_logement ;
             if ( $memoire_du_logement <> $data->id_logement ) //réinitialisation des variables si on traite un autre logement
                 $memoire_jour_precedent = '' ;
            $date_index =  $data->date_reservation;
            list($annee_bdd,$mois_bdd,$jour_bdd) = explode ("-",$date_index );
            $jour_reserve[$data->id_logement][$date_index] = (bool)true ;
            $temp_couleur_texte = $data->couleur_texte ;
            if ($memoire_jour_precedent <> $date_index || $couleur_invisible[$temp_couleur_texte]) { //controle de date en doublon pour ne garder que les couleures transparentes
                $couleur_reserve_cellule[$data->id_logement][$date_index] = $data->couleur;
                $class_reserve_cellule[$data->id_logement][$date_index] = "jour_reserve_".$data->couleur_texte;
                $couleur_police_reserve_bdd[$data->id_logement][$date_index] = $data->couleur_texte;
                $texte_type_reservation[$data->id_logement][$date_index] = $intitule_couleur_reserve[$data->couleur_texte];
                $locataire_reserve[$data->id_logement][$date_index] =  ( $data->id_locataire <> 0 ) ? $nom_locataire[$data->id_locataire]." ".$prenom_locataire[$data->id_locataire] : '';
                $contenu_texte_infobulle[$data->id_logement][$date_index] = $data->commentaires;
                $contenu_infobulle[$data->id_logement][$date_index]  =   $item1." : ".$nom_logement[$data->id_logement]."<br>";
                $contenu_infobulle[$data->id_logement][$date_index] .=  ( $data->commentaires <> '' ) ? stripslashes($data->commentaires)."<br>" : '';
                $contenu_infobulle[$data->id_logement][$date_index] .=  ( $avec_affichage_infobulle_complete ) ? $texte_type_reservation[$data->id_logement][$date_index]."<br>": '';
                $contenu_infobulle[$data->id_logement][$date_index] .=  ( $avec_affichage_infobulle_complete && $locataire_reserve[$data->id_logement][$date_index] <> '') ?"<u>Locataire</u> :".addslashes($locataire_reserve[$data->id_logement][$date_index])."<br>" : '';
                $contenu_infobulle[$data->id_logement][$date_index] .=  ( $avec_affichage_infobulle_complete ) ? "<u>Tarif</u> :".$data->tarif." €<br>" : '';
                $contenu_infobulle[$data->id_logement][$date_index] .=  ( $avec_affichage_infobulle_complete ) ? "<u>Capacité</u> :".$capacite_logement[$data->id_logement]." personnes<br>" : '';
                $contenu_infobulle[$data->id_logement][$date_index] .=  $texte_jour_fr[date("w",mktime(6, 0, 0, $mois_bdd, $jour_bdd, $annee_bdd))]." ".$jour_bdd." ".$mois_texte[(int)$mois_bdd]." ".$annee_bdd ;
                }
            $memoire_jour_precedent = $date_index;
          }
    @mysql_close();
   }
 }
} // fin de recupération avec base de données ***************************

//************************************************************************
// fonctionnement avec base de données
//************************************************************************
elseif ( !AVEC_BDD ) {
   if ( isset ($nom_logement) ) {
   foreach ($nom_logement as $cle => $libelle_logement ) {

   //recupération des dates pour le logement en cours de traitement *********
   unset($tableau_reservation); // réinitialisation des variables tableau ***
   $memoire_jour_precedent = '' ;
   $chemin_fichier_logement = "fichier_calendrier/dates_sans_bdd/".$cle."_calendrier.php";

   if ( file_exists($chemin_fichier_logement)) {
         if ( isset($tableau_reservation_modif[$cle]) && is_array($tableau_reservation_modif[$cle])  )
			$tableau_reservation[$cle] = $tableau_reservation_modif[$cle];
		else
			include($chemin_fichier_logement);

   //controle des fichiers
   $pointeur_variable_ctrl_fin_fichier = 'fin_tableau_reservation_'.$cle;
   if (!isset($$pointeur_variable_ctrl_fin_fichier))
    $affiche_info = 'erreur_fichier_dates';

   if ( isset($tableau_reservation[$cle]) && $cle <> 0) {
   //mise en forme des dates premier et dernier jours **********************************************
   $nombre_jour_periode =  (int) nb_jour_date ($date_premier_jour_calendrier,$date_dernier_jour_tableau,"-","eng") + 1;
   $date_index = $date_premier_jour_tableau ;
   for ( $i = 1 ; $i <= $nombre_jour_periode ; $i++ ) {
     if (array_key_exists($date_index, $tableau_reservation[$cle]))  {
          list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$tableau_reservation[$cle][$date_index]);
            list($annee_bdd,$mois_bdd,$jour_bdd) = explode ("-",$date_index );
            $jour_reserve[$cle][$date_index] = (bool)true ;
            $temp_couleur_texte = $couleur_texte_temp ;
            if ($memoire_jour_precedent <> $date_index || $couleur_invisible[$temp_couleur_texte]) { //controle de date en doublon pour ne garder que les couleures transparentes
                $couleur_reserve_cellule[$cle][$date_index] = $couleur_temp;
                $class_reserve_cellule[$cle][$date_index] = "jour_reserve_".$couleur_texte_temp;
                $couleur_police_reserve_bdd[$cle][$date_index] = $couleur_texte_temp;
                $texte_type_reservation[$cle][$date_index] = $intitule_couleur_reserve[$couleur_texte_temp];
                $locataire_reserve[$cle][$date_index] =  ( $tri_locataire_temp <> 0 ) ? $nom_locataire[$tri_locataire_temp]." ".$prenom_locataire[$tri_locataire_temp] : '';
                $contenu_texte_infobulle[$cle][$date_index] =  $commentaire_temp;
                $contenu_infobulle[$cle][$date_index]  =   $item1." : ".$libelle_logement."<br>";
                $contenu_infobulle[$cle][$date_index] .=  ( $commentaire_temp <> '' ) ? stripslashes($commentaire_temp)."<br>" : '';
                $contenu_infobulle[$cle][$date_index] .=  ( $avec_affichage_infobulle_complete ) ? $texte_type_reservation[$cle][$date_index]."<br>": '';
                $contenu_infobulle[$cle][$date_index] .=  ( $avec_affichage_infobulle_complete && $locataire_reserve[$cle][$date_index] <> '') ?"<u>Locataire</u> :".addslashes($locataire_reserve[$cle][$date_index])."<br>" : '';
                $contenu_infobulle[$cle][$date_index] .=  ( $avec_affichage_infobulle_complete ) ? "<u>Tarif</u> :".$tarif_temp."<br>" : '';
                $contenu_infobulle[$cle][$date_index] .=  ( $avec_affichage_infobulle_complete ) ? "<u>Capacité</u> :".$capacite_logement[$cle]." personnes<br>" : '';
                $contenu_infobulle[$cle][$date_index] .=  $texte_jour_fr[date("w",mktime(6, 0, 0, $mois_bdd, $jour_bdd, $annee_bdd))]." ".$jour_bdd." ".$mois_texte[(int)$mois_bdd]." ".$annee_bdd ;
                }
            $memoire_jour_precedent = $date_index;
         }
       $date_index = ajout_jour_date ($date_index,1,"JMA","-","eng");
     }
     }
   }
   }
   }
}

//creation du tableau des mois**********************************************************************
echo '<br><table cellPadding="',$espace_dans_cellule,'" cellSpacing="',$espace_entre_cellule,'" style = "border :',$couleur_bordure_tableau,' ',$bordure_du_tableau,'px solid " align="left">';

//ligne des mois, années et noms des jours**************************************

$index_jour_ligne_liste_jour = date("w",mktime ( 6,0,0,$date_premier_jour_explode[1] ,$date_premier_jour_explode[2],$date_premier_jour_explode[0])) ;  //numero du jour dans le semaine
$code_html_ligne_texte_jour = ''; // code html de ligne qui affiche le texte des jours 

//calcul lien avance recule date *******************************************************************
$offset_avance_date = $nombre_jour_avance_recul_calendrier_tous ; // Nombre de jours pour faire glisser en avant le calendrier
$offset_recul_date = -$nombre_jour_avance_recul_calendrier_tous ; // Nombre de jours pour faire glisser en arriere le calendrier
$date_recule = ajout_jour_date ($date_premier_jour_calendrier,$offset_recul_date + 7,"JMA","-","eng"); // (+7 car le recul d'une semaine est deja géré)
$date_avance = ajout_jour_date ($date_premier_jour_calendrier,$offset_avance_date + 7,"JMA","-","eng");

for ($j=0; $j< $nombre_jour_pour_periode+2; $j++) // +2 a cause des seprateur vertical entre les mois
     {
       //détermination cle numéro du jour de la semaine
       if  ($index_jour_ligne_liste_jour == 6 || $index_jour_ligne_liste_jour == 0)
          $couleur_fond_nom_jour = "lettre_jour_week_end";
        else
          $couleur_fond_nom_jour = "lettre_jour_semaine" ;
       // enregistrement du numéro du jour de la semaine (6-> dimanche, 1-> lundi,etc...) ***********
       $index_num_jour_de_la_semaine[$j+1] = $texte_jour_fr[$index_jour_ligne_liste_jour];
       //détermination nombre de colonne mois et libellé du mois et année ***************************
       $date_temporaire_colonne = ajout_jour_date ($date_premier_jour_calendrier,$j,"JMA","-","eng");
       $date_temp_explosee = explode ("-", $date_temporaire_colonne);
       $mois_temp_colonne = (int)$date_temp_explosee[1];
       $mois_et_annee = $mois_texte[$mois_temp_colonne]." ".$date_temp_explosee[0];
       if ( !isset($nombre_colonne_mois[$mois_et_annee]) )
             $nombre_colonne_mois[$mois_et_annee] = 0 ;
       $nombre_colonne_mois[$mois_et_annee]++;
       // inscription du tableau des colonnes qui doivent avoir une bordure droite ********
       if ( !isset($memoire_mois_precedent_bordure ) )
            $memoire_mois_precedent_bordure = $mois_temp_colonne;
       // code html texte jour *****************************************************************
       if  (  $mois_temp_colonne <> $memoire_mois_precedent_bordure ) { // demarrage d'un nouveau mois
         $bordure_gauche_colonne[$j+1] = true ;
         $code_html_ligne_texte_jour .= '<td class ="cellule_separateur_vertical" ></td>';
         }
       else {
         $bordure_gauche_colonne[$j+1] = false ;
         }
       $code_html_ligne_texte_jour .= '<td class ="'.$couleur_fond_nom_jour.'">'.$jour_texte[$index_jour_ligne_liste_jour].'</td>';
       $memoire_mois_precedent_bordure = $mois_temp_colonne ;
       //incrément numéro du jour de la semaine ***********************
       if ( $index_jour_ligne_liste_jour == 6 )
            $index_jour_ligne_liste_jour = 0 ;
       else
            $index_jour_ligne_liste_jour++;
     }
//texte des mois ********************************************************************************
echo '<tr><td class= "cellule_offset" nowrap>
      <b>< </b><a href="',$adresse_page,'?go_date=',$date_recule,'" class ="offset"> ',$offset_recul_date/7,' ',$texte_label[0],'</a>
      </td>';

$nb_result = count ($nombre_colonne_mois);
$cpt_colonne = 1 ;

foreach ($nombre_colonne_mois as $cle_mois => $nb_colonne ) {
     if ( $cpt_colonne <> 1 )
         echo '<td class ="cellule_separateur_vertical" ></td>';
     echo '<td class ="cellule_mois_tous" colspan = "',$nb_colonne,'" nowrap>
           <b>'.$cle_mois,'</b></td>';
     $cpt_colonne++;
}
echo '</tr>';
// texte des noms de jours  **********************************************************************
echo '<tr>
     <td class= "cellule_offset" nowrap>
     <b>> </b><a href="',$adresse_page,'?go_date=',$date_avance,'" class ="offset"> +',$offset_avance_date/7,' ',$texte_label[0],'</a>
      </td>
     ',$code_html_ligne_texte_jour,'</tr>
     <tr><td class ="cellule_separateur_horizontal" colspan = "',$nombre_jour_pour_periode+5,'" ></td></tr>';

//affichage des tableaux des logements ***********************************************************
if ( isset ($nom_logement) ) {
  asort($nom_logement);
  foreach ($nom_logement as $cle => $libelle_logement ) {
  if ( $cle <> 0 ) {
//initialisation de variables************************************************************************
// initialisation compteur jour à 2 car le jour 1 est le dernier jour du mois précédent du premier mois du calendrier
// l'index 1 est utilisé pour déterminer l'image de fond de cellule nécessaire pour le premier jour
// le chaoix de l'image se faisant tout le temps par rapport au jour précédent

//particularités du calendrier *********************************************************************
$periode_location = 7 ;
$compteur_jour_bdd = 2 + abs($offset_depart_calendrier_tous);
$memoire_bckgrd_jour_precedent_debut_calendrier = ($couleur_police_reserve_bdd[$cle][$date_premier_jour_calendrier] <> '' ) ? $couleur_police_reserve_bdd[$cle][$date_premier_jour_calendrier] : "libre";
$memoire_bckgrd_jour_precedent = 'libre';
$image_bckgrd_jour = '';

//initailisation compteur de mois par ligne*********************************************************
$compteur_mois_ligne = 1 ;

//initialisation des calendriers*******************************************************************
$fin_tableau              = false ;
$premier_jour_depasse     = false ;
$compteur_jour            = 1 ;
$date_aujourd_hui = ajout_supprime_zero (date("Y-m-d"),"Ajout","-","eng");

//variable pour uniformiser la taille des tableau mois en nombre de ligne pour tous les mois *******
$compteur_cellule         = 1 ; // cellule 1 = première cellule lundi
$index_jour_ligne_liste_jour = date("w",mktime ( 6,0,0,$date_premier_jour_explode[1] ,$date_premier_jour_explode[2],$date_premier_jour_explode[0])) ; ; // index pour couleur de fond suivant jour semaine ou week end

echo '<tr><td class ="cellule_plus_moins_mois" nowrap><b>',stripslashes($libelle_logement),'</b></td>';
//creation du tableau avec numero des jours*********************************************************
while ( !($fin_tableau) )
      {

        $couleur_disponibilite = "lettre_num_jour_libre" ;
        $lien_marquage_date = true ; // remise a true lien sur les dates - toutes les dates pour les journaliers, les dates de période uniquement pour le calendrier période
        if ( $index_jour_ligne_liste_jour == 6 || $index_jour_ligne_liste_jour == 0 )
             $couleur_disponibilite = "lettre_num_jour_libre_week_end" ;
                    //recupération et mise en fomre de late en cours ************************
                    $date_en_cours_colonne  = ajout_jour_date ($date_premier_jour_calendrier,$compteur_jour-1,"JMA","-","eng");
                    list($annee_en_cours,$mois_en_cours,$jour_en_cours) = explode ("-",$date_en_cours_colonne);
                    $date_en_cours_fr  = ajout_supprime_zero ($jour_en_cours."/".$mois_en_cours."/".$annee_en_cours,"Ajout","/","fr") ;
                    $date_en_cours_eng = ajout_supprime_zero ($annee_en_cours."-".$mois_en_cours."-".$jour_en_cours,"Ajout","-","eng") ;
                    // test si le jour affiché correspond au jour d'aujourd'hui *******************
                    if ( $avec_marquage_du_jour_d_aujourd_hui ) {
                        if ( $date_aujourd_hui ==  $date_en_cours_eng )
                            $couleur_disponibilite = "lettre_num_jour_aujourdhui" ;
                        }
                    //test si jour est reservé******************************************************
                    $avertissement_marquage = 'false';
                    if ( $jour_reserve[$cle][$date_en_cours_eng] )  {
                        $index_couleur_texte_police_jour_reserve = $couleur_police_reserve_bdd[$cle][$date_en_cours_eng] ;
                        $coul_police_jour = $couleur_texte_jour_reserve[$index_couleur_texte_police_jour_reserve] ;
                        $couleur_disponibilite = $class_reserve_cellule[$cle][$date_en_cours_eng];
                        $class_date_lien = $couleur_police_reserve_bdd[$cle][$date_en_cours_eng] ;
                        $avertissement_marquage = ($date_couleur_disponible[$index_couleur_texte_police_jour_reserve]) ? 'false' : 'true' ;
                        }
                    else  {
                       $coul_police_jour = $couleur_police_jour ;
                       $class_date_lien = '' ;
                       }
                    //*******************************************************************************
                    // traitement des images de fond de cellules si fonction est activée*************
                    //*******************************************************************************
                    if ( $avec_diagonale_cellule ) {
                       $temp_jour_precedent_reserve   = ajout_jour_date ($date_en_cours_eng,-1,"JMA","-","eng") ;

                       //font montant ***************************************************************
                       if ( $jour_reserve[$cle][$date_en_cours_eng] && !$jour_reserve[$cle][$temp_jour_precedent_reserve])
                           $couleur_disponibilite = 'jour_reserve_triangle_'.$memoire_bckgrd_jour[$cle][$date_en_cours_eng].'-'.$couleur_police_reserve_bdd[$cle][$date_en_cours_eng];
                       // front descendant **********************************************************
                       else if ( !$jour_reserve[$cle][$date_en_cours_eng] && $jour_reserve[$cle][$temp_jour_precedent_reserve] ) // jour actuel est marqué et si on n'est pas le premier jour du calendrier ********
                           $couleur_disponibilite = 'jour_reserve_triangle_'.$couleur_police_reserve_bdd[$cle][$temp_jour_precedent_reserve].'-'.$memoire_bckgrd_jour[$cle][$date_en_cours_eng];
                       // jour prédent et actuel reservé ********************************************
                       else if ( $jour_reserve[$cle][$date_en_cours_eng] && $jour_reserve[$cle][$temp_jour_precedent_reserve] ) {// test si le jour précédent été marqué et donc le jour actuel ne l'est pas********
                           //test si locataire différent - image avec séparateur
							if ( isset($couleur_police_reserve_bdd[$cle][$temp_jour_precedent_reserve],$couleur_police_reserve_bdd[$cle][$date_en_cours_eng],$locataire_reserve[$cle][$date_en_cours_eng],$locataire_reserve[$cle][$temp_jour_precedent_reserve])  
								 && $couleur_police_reserve_bdd[$cle][$temp_jour_precedent_reserve] == $couleur_police_reserve_bdd[$cle][$date_en_cours_eng] 
							     && $locataire_reserve[$cle][$date_en_cours_eng] <> $locataire_reserve[$cle][$temp_jour_precedent_reserve] )
								$couleur_disponibilite = 'jour_reserve_triangle_'.$couleur_police_reserve_bdd[$cle][$temp_jour_precedent_reserve].'-'.$couleur_police_reserve_bdd[$cle][$date_en_cours_eng]."_cgt_client";
							else // sinon image identique
								$couleur_disponibilite = 'jour_reserve_triangle_'.$couleur_police_reserve_bdd[$cle][$temp_jour_precedent_reserve].'-'.$couleur_police_reserve_bdd[$cle][$date_en_cours_eng];
							}
                    }
                    //*******************************************************************************
                    // recherche si separateur vertical pour fin de mois *********************************
                    //*******************************************************************************
                    if ( $bordure_gauche_colonne[$compteur_jour] )
                      echo '<td class ="cellule_separateur_vertical" ></td>';
                    //*******************************************************************************
                    echo '<td class ="',$couleur_disponibilite,'" >';
                    //*******************************************************************************
                    // date et liens pour les calendriers journaliers *******************************
                    //*******************************************************************************
                    if( $format_calendrier_logement[$cle] <> 'calendrier_periode' ) {
                    if ( $date_lien == 0 && $format_date_fr )
                        echo '<a href="javascript:swap_date(\'',$date_en_cours_fr,'\',',$cle,',\'',$format_calendrier_logement[$cle],'\',',$avertissement_marquage,')" class = "date',$class_date_lien,'_admin" >';
                    if ( $date_lien == 0 && (!($format_date_fr)) )
                        echo '<a href="javascript:swap_date(\'',$date_en_cours_eng,'\',',$cle,',\'',$format_calendrier_logement[$cle],'\',',$avertissement_marquage,')" class = "date',$class_date_lien,'_admin" >';
                    echo $jour_en_cours;
                    if ( $date_lien == 0  ) {
                        if  ( $contenu_infobulle[$cle][$date_en_cours_eng] <>  '' )
                             echo '<em><span></span>',$contenu_infobulle[$cle][$date_en_cours_eng],'</em>';
                    echo '</a>';
                     }
                    }
                    //*******************************************************************************
                    // date et liens pour les calendriers période ***********************************
                    //*******************************************************************************
                    else {
                    if ( $date_lien == 0 && $format_date_fr && $lien_marquage_date && $index_num_jour_de_la_semaine[$compteur_cellule] == $texte_jour_debut_semaine_logement[$cle] )
                        echo '<a href="javascript:swap_date(\'',$date_en_cours_fr,'\',',$cle,',\'',$format_calendrier_logement[$cle],'\')" class = "date',$class_date_lien,'" >';
                    if ( $date_lien == 0 && (!($format_date_fr)) && $lien_marquage_date && $index_num_jour_de_la_semaine[$compteur_cellule] == $texte_jour_debut_semaine_logement[$cle] )
                        echo '<a href="javascript:swap_date(\'',$date_en_cours_eng,'\',',$cle,',\'',$format_calendrier_logement[$cle],'\')" class = "date',$class_date_lien,'" >';
                    echo $jour_en_cours;
                      if ( $date_lien == 0  && $lien_marquage_date && $index_num_jour_de_la_semaine[$compteur_cellule] == $texte_jour_debut_semaine_logement[$cle] ) {
                        list($temp_fin_periode_an,$temp_fin_periode_mois,$temp_fin_periode_jour) = explode ("-",ajout_jour_date ($date_en_cours_colonne,$periode_location-1,"JMA","-","eng"));
                        if  ( $contenu_infobulle[$cle][$date_en_cours_eng] <>  '' )
                             echo '<em><span></span>',$contenu_infobulle[$cle][$date_en_cours_eng],'</em>';
                        echo '</a>';
                      }
                     }//********************************************

                    echo '</td>';
                    $compteur_jour++ ;
       // controle jour de la semaine en cours dans la cellule ****
       if ( $index_jour_ligne_liste_jour == 6 )
            $index_jour_ligne_liste_jour = 0 ;
       else
            $index_jour_ligne_liste_jour++;
        $compteur_cellule++;
        if ( $compteur_cellule > $nombre_jour_pour_periode +2 )   // +2 a cause des seprateur vertical entre les mois
                        $fin_tableau = true ;
      }
//fin de la table du mois
echo '</tr>
      <tr><td class ="cellule_separateur_horizontal" colspan = "',$nombre_jour_pour_periode+5,'" ></td></tr>';

    }
  }
}
//fin de paragraphe du tableau*********************************************************************

echo '</table>';

 if ( $avec_compression_page )
    ob_end_flush();

?>

</body>

</html>

