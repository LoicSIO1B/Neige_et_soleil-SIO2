<?php
//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
//demarrage des sessions****************************************************************************
//----   pour sauvegarder les selections de mois annees mettre en tout debut de page ce code    ----
//                session_start();                                                              ----
//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
session_start();

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
//----                  Script de gestion pour calendrier de reservation                        ----
//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
//----   Paramètres possible dans l'url :                                                       ----

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
//----     Paramètres de configurations générales et modifiables                               -----
//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     include("admin/genere/connexion.php");

//chemin vers le fichier paramètres du calendrier****************************************************
     include("admin/fichier_calendrier/parametres_calendrier.php");

//chemin vers le fichier liste des logements et locataires*******************************************
     include("admin/fichier_calendrier/calendrier_liste_couleur.php");
     include("admin/fichier_calendrier/calendrier_liste_logement.php");
     include("admin/fichier_calendrier/calendrier_liste_locataire.php");

//chemin vers le fichier convertisseur date**********************************************************
     include("admin/fonction.php");

//chemin vers le fichier date mise à jour **********************************************************
     include("admin/fichier_calendrier/calendrier_date_mise_a_jour.php");

// initialisation de variables *********************************************************************
header( 'content-type: text/html; charset=ISO-8859-1' );
$header_iso	= true ;	 
	 
// indiquez le caractère séparateur de date ********************************************************
$format_separateur_date = "/";

//nom de la page ou se trouve le script*************************************************************
$adresse_page         = "date-picker.php";
//nom de la page a ouvrir lorsqu'on clic sur une date***********************************************
$adresse_destination  = "date-picker.php";
//recherche des dates dans les fichiers ou dans la bdd
$avec_selection_location            = true ;

//format de date sur le lien des jours dans le calendrier--------------------------------------------
// si true alors selection format francais, si false alors format date anglais-----------------------
$format_date_fr    = true ;

//insertion des langues ************************************************
     include("admin/fichier_calendrier/langue.php");

//choix du logement*********************************************************************************
$tri_logement = ' ';
$tri_logement2 = '';
$lien_logement = 0 ;
$num_logement_en_cours = 0;
//controle si choix du logement dans l'url**********************************************************
if ( (isset($_GET['logement'])) && (empty($_GET['logement'])) )
    $_SESSION['sel_tri_logement'] = '' ;
if ( (isset($_GET['logement'])) && (!(empty($_GET['logement']))) )
    $_SESSION['sel_tri_logement'] = (int)$_GET['logement'] ;
//si session logement existe alors le logement de la session devient prioritaire********************
if ( (isset($_SESSION['sel_tri_logement'])) && (!(empty($_SESSION['sel_tri_logement']))) ) {
   $tri_logement = " AND id_logement = '".$_SESSION['sel_tri_logement']."'" ;
   $tri_logement2 = ", id_logement = '".$_SESSION['sel_tri_logement']."'" ;
   $num_logement_en_cours = $_SESSION['sel_tri_logement'];
   $lien_logement = $_SESSION['sel_tri_logement'];
   }
// selection jour début de semaine *****************************************************************
   $texte_jour_debut_semaine =  ( isset($texte_jour_debut_semaine_logement[$num_logement_en_cours])) ? $texte_jour_debut_semaine_logement[$num_logement_en_cours] : "lundi";

// controle si un logement est selectionné **********************************************************
if ( !isset($_SESSION['sel_tri_logement']) || empty($_SESSION['sel_tri_logement']) || $_SESSION['sel_tri_logement'] == '') {
    //echo " Aucune location n'est sélectionnée, adresse du calendrier invalide !<br>" ;
    $avec_selection_location = false;
    $texte_jour_debut_semaine =  "lundi";
    $avec_selection_couleur_visteur = false;
    }

//choix du locataire********************************************************************************
$tri_locataire = ' ';
$tri_locataire2 = '';
$lien_locataire = 0 ;
$tri_locataire_ss_bdd = 0 ;
//controle si choix du locataire dans l'url*********************************************************
if ( (isset($_GET['locataire'])) && (empty($_GET['locataire'])) )
    $_SESSION['sel_tri_locataire'] = '' ;
if ( (isset($_GET['locataire'])) && (!(empty($_GET['locataire']))) )
    $_SESSION['sel_tri_locataire'] = (int)$_GET['locataire'] ;
//si session locataire existe alors le locataire de la session devient prioritaire******************
if ( (isset($_SESSION['sel_tri_locataire'])) && (!(empty($_SESSION['sel_tri_locataire']))) ) {
   $tri_locataire = " AND id_locataire = '".$_SESSION['sel_tri_locataire']."'" ;
   $tri_locataire2 = " , id_locataire = '".$_SESSION['sel_tri_locataire']."'" ;
   $lien_locataire = $_SESSION['sel_tri_locataire'] ;
   $tri_locataire_ss_bdd = $_SESSION['sel_tri_locataire'] ;
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
             $couleur_en_cours    = $couleur_reserve[$cle] ;
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

//controle si choix nom du champs dans lequel la date cliquée doit être inscrite dans l'url*********
if ( (isset($_GET['idcible'])) && (empty($_GET['idcible'])) )
    $_SESSION['idcible'] = '' ;
if ( (isset($_GET['idcible'])) && (!(empty($_GET['idcible']))) )
    $_SESSION['idcible'] = $_GET['idcible'] ;
//si session mois existe alors la session devient prioritaire***************************************
if ( (isset($_SESSION['idcible'])) && (!(empty($_SESSION['idcible']))) )
   $nom_champs_selecteur = $_SESSION['idcible'] ;

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

<title>Sélecteur de date Calendrier des réservations / disponibilités </title>
<meta name="description" content="Calendrier des disponibilités , calendrier php avec gestion logement et locataire">
<meta name="generator" content="Mathieuweb - http://www.mathieuweb.fr/calendrier/calendrier.php">
<meta http-equiv="Pragma" content="no-cache" >
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" >
<meta http-equiv="Expires" content="0" >
<link rel="stylesheet" href="admin/fichier_calendrier/styles.css?version=<?php echo filemtime('admin/fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >

</head>

<body bgcolor="<?php echo $couleur_fond_page_visiteur; ?>" text="#000000" >


<?php

//selection du mois et année en cours***************************************************************
$mois_en_cours  = (int)$premier_mois ;
$annee_en_cours = $annee_premier_mois ;

// affichage sélection mois, année, couleur et champs de réservations ********************************
echo '<Table border = 0 >
      <tr>
      <td width = "140">';
   // si nécessaire affichage du sélecteur d'année **************************************************
   if ( $selection_an_visteur ) {
        echo '<a href="',$adresse_page,'?an=',$annee_en_cours - 1,'&amp;mois=',$premier_mois,'&amp;locataire=',$lien_locataire,'&amp;logement=',$lien_logement,'" class = "selection"><font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >&nbsp;<< </font></a>
              <b><font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >&nbsp;',$annee_en_cours,'&nbsp;</font></b>
              <a href="',$adresse_page,'?an=',$annee_en_cours + 1,'&amp;mois=',$premier_mois,'&amp;locataire=',$lien_locataire,'&amp;logement=',$lien_logement,'" class = "selection"><font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >&nbsp;>> </font></a>';
        }
echo '</td>
      <td width = "450">';
   // si nécessaire affichage du sélecteur de couleur **********************************************
   if ( $avec_selection_couleur_visteur  ) {
        echo '<Table border = "0" >
              <tr> ';
        $nb_max_couleur_par_ligne = 6 ; // nombre de libellé de couleur par ligne
        $compteur_colonne = 0;
        $nb_result = count ($intitule_couleur_reserve);
        if ( $nb_result > 0 ) {
        asort($intitule_couleur_reserve);  //tri alphabétique ********
        foreach ($intitule_couleur_reserve as $cle => $val_couleur )  {
             if ( !$couleur_invisible[$cle]) {
               $compteur_colonne++;
               if ( $compteur_colonne > $nb_max_couleur_par_ligne) {
                   echo '</tr><tr>';
                   $compteur_colonne = 1 ;
                   }
               echo '<td class = "jour_reserve_',$cle,'" >',$intitule_couleur_reserve[$cle],'</td>';
             }
           }
        }
        echo '</tr>
              </table>';
   }
echo '</td>
      </tr>
      <tr>
      <td width = "140">';
   // si nécessaire affichage du sélecteur de mois **********************************************
   if ( $selection_mois_visteur ) {
        echo '<form name="sel_mois" method="get" action="',$adresse_page,'" id="Form1">';
        echo '<select name="mois" size="1" id="Combobox1" onchange="document.sel_mois.submit();return false;" style="position:font-family:',$police,';font-size:',$taille_police_sel_mois_annee,'px;z-index:2">';
        for ($i=1; $i<13; $i++)  {
            if  ( $premier_mois == $i )
                  echo '<option selected value="',$i,'">',$mois_texte[$i],'</option>' ;
             else
                  echo '<option value="',$i,'">',$mois_texte[$i],'</option>' ;
        }
        echo '</select>
              <input type="hidden" id="locataire" name="locataire" value="',$lien_locataire,'">
              <input type="hidden" id="logement" name="logement" value="',$lien_logement,'">
			  <input type="hidden" id="an" name="an" value="',$annee_premier_mois,'">
              </form>';
        }
echo '</td>
      <td width = "450">';
    // affichage des champs de saisie de période à marquer****************************************
    if ( $avec_selection_champs_date_visteur )
    echo '
    <form name="Form1" method="post" action="',$adresse_page,'" id="Form2">
    <font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'">Date début :</font>
    <input id="date_debut" name="date_debut" type="text" size="10" value="JJ/MM/AAAA">
    <font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'">Date fin :</font>
    <input id="date_fin" name="date_fin" type="text" size="10" value="JJ/MM/AAAA">
    <input type="submit" id="Button2" name="Réserver" value="Réserver" >
    </form>';
echo '</td>
      </tr>
      <tr>
      <td width = "140">';
   // si nécessaire affichange du sélecteur de logement **********************************************
   if ( $avec_selection_logement_visteur  ) {
         echo '<form name="logement" method="get" action="',$adresse_page,'" id="Form1">
               <font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >Choix ',$item1,':<br>';
        liste_box ("logement",220,$nom_logement,"",true,$_SESSION['sel_tri_logement'],false,"logement");
        echo '</form> ';
        }

echo '</td>
      <td width = "450">';
   // si nécessaire affichage du sélecteur de Locataire **********************************************
   if ( $avec_selection_locataire_visteur  ) {
        echo '<form name="locataire" method="get" action="',$adresse_page,'" id="Form1">
              <font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >Choix Locataire:<br>';
        liste_box ("locataire",220,$nom_locataire,$prenom_locataire,false,$_SESSION['sel_tri_locataire'],true,"");
        echo '</form>';
        }

echo '</td>
      </tr> 
      </table> ';

//initailisation compteur de mois par ligne*********************************************************
$compteur_mois_ligne = 1 ;
$periode_location = 7;

echo '<table cellSpacing="',$espace_entre_les_mois,'" >
      <tr>
      <td nowrap>';

//calcul pour récupération des dates dans la période voulue **************************************
$poub_mois_dernier_mois = $premier_mois ;
$poub_annee_dernier_mois = $annee_premier_mois;
$jour_en_seconde = 3600 * 24 ;
//calcul numéro dernier mois et année du dernier mois ********************************************
for ( $temp_compteur_mois = 1; $temp_compteur_mois < $nombre_mois_afficher; $temp_compteur_mois++ )  {
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

//mise en forme des dates premier et dernier jours **********************************************
$poub_date_premier_jour = $annee_premier_mois."-".($premier_mois-1)."-".strftime("%d",mktime ( 0,0,0,$premier_mois ,0,$annee_premier_mois));
$poub_date_dernier_jour = $poub_annee_dernier_mois."-".$poub_mois_dernier_mois."-".strftime("%d",mktime ( 0,0,0,$poub_mois_dernier_mois ,0,$poub_annee_dernier_mois));

//************************************************************************
// creation des tableaux dates ************************************
//************************************************************************
$date_premier_jour_calendrier = $poub_date_premier_jour;
$date_premier_jour_tableau = ajout_jour_date (ajout_supprime_zero ($date_premier_jour_calendrier,"Ajout","-","eng"),-7,"JMA","-","eng");
$date_dernier_jour_tableau = ajout_jour_date (ajout_supprime_zero ($poub_date_dernier_jour,"Ajout","-","eng"),7,"JMA","-","eng");
$nombre_jour_pour_periode = (int) nb_jour_date ($date_premier_jour_tableau,$date_dernier_jour_tableau,"-","eng");

$date_boucle = ajout_supprime_zero ($date_premier_jour_tableau,"Ajout","-","eng");

//initialisation du tableau des jours reservés dans le mois en cours*****************************
   for ( $i=0; $i < $nombre_jour_pour_periode+2; $i++ )   {
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
if ( AVEC_BDD && $avec_selection_location ) {
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
   //recherche des jours reservés dans le mois en cours*********************************************
   $valeur_select = "SELECT * FROM ".Decrypte(nom_table_cal,$Cle)." WHERE date_reservation >= '$date_premier_jour_tableau' AND date_reservation <= '$date_dernier_jour_tableau' $tri_logement $tri_locataire order by date_reservation ";
   $requete = @mysql_query ($valeur_select);
   while ( $data = mysql_fetch_object($requete) )  {
            $date_index =  $data->date_reservation;
            list($annee_bdd,$mois_bdd,$jour_bdd) = explode ("-",$date_index );
            $temp_couleur_texte = $data->couleur_texte ;
            $logement_reserve[$date_index]  = ( $data->id_logement <> 0 ) ? $nom_logement[$data->id_logement] : '';
            if ( !$couleur_invisible[$data->couleur_texte] ) {
                $jour_reserve[$date_index] = (bool)true ;
                $class_reserve_cellule[$date_index] = "jour_reserve_".$data->couleur_texte;
                $couleur_reserve_cellule[$date_index] = $data->couleur;
                $couleur_police_reserve_bdd[$date_index] = $data->couleur_texte;
                $texte_type_reservation[$date_index] = $intitule_couleur_reserve[$data->couleur_texte];
                $locataire_reserve[$date_index] =  ( $data->id_locataire <> 0 ) ? $nom_locataire[$data->id_locataire]." ".$prenom_locataire[$data->id_locataire] : '';
                $tarif_reservation[$date_index] = ( isset($format_calendrier_logement[$data->id_logement]) && $format_calendrier_logement[$data->id_logement] == 'calendrier_periode' ) ? (($data->tarif)*$periode_location)." euros" : $data->tarif ;
                $contenu_texte_infobulle[$date_index] =  $data->commentaires;
                $contenu_infobulle[$date_index]  =  ( $avec_infobulle_visiteur && $avec_logement_infobulle_visiteur ) ? stripslashes($logement_reserve[$date_index])."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur && $data->commentaires <> '' ) ? stripslashes($data->commentaires)."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur && $avec_couleur_infobulle_visiteur ) ? $texte_type_reservation[$date_index]."<br>": '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur && $avec_locataire_infobulle_visiteur && $locataire_reserve[$date_index] <> '') ? addslashes($locataire_reserve[$date_index])."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur && $avec_tarif_infobulle_visiteur ) ? $tarif_reservation[$date_index]."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur) ? $texte_jour_fr[date("w",mktime(6, 0, 0, $mois_bdd, $jour_bdd, $annee_bdd))]." ".$jour_bdd." ".$mois_texte[(int)$mois_bdd]." ".$annee_bdd: '' ;
                }

          }
      @mysql_close();
      }
   }
} // fin de recupération avec base de données ***************************

//************************************************************************
// fonctionnement avec base de données
//************************************************************************
elseif ( !AVEC_BDD && $avec_selection_location ) {
   //recupération des dates pour le logement en cours de traitement *********
   unset($tableau_reservation); // réinitialisation des variables tableau ***
   $fichier_calendrier = "admin/fichier_calendrier/dates_sans_bdd/".$num_logement_en_cours."_calendrier.php";
   if ( file_exists($fichier_calendrier) )
      include("admin/fichier_calendrier/dates_sans_bdd/".$num_logement_en_cours."_calendrier.php");
   if ( isset($tableau_reservation) ) {
   //mise en forme des dates premier et dernier jours **********************************************
   $nombre_jour_periode =  (int) nb_jour_date ($date_premier_jour_tableau,$date_dernier_jour_tableau,"-","eng") + 1;
   $date_index = $date_premier_jour_tableau ;

   for ( $i = 1 ; $i <= $nombre_jour_periode ; $i++ ) {
     if (array_key_exists($date_index, $tableau_reservation[$num_logement_en_cours]))  {
          list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$tableau_reservation[$num_logement_en_cours][$date_index]);

          if ( $tri_locataire_ss_bdd == 0 || $tri_locataire_ss_bdd == $tri_locataire_temp ) {
            list($annee_bdd,$mois_bdd,$jour_bdd) = explode ("-",$date_index );
            $temp_couleur_texte = $couleur_texte_temp ;
            $logement_reserve[$date_index]  = ( $num_logement_en_cours <> 0 ) ? $nom_logement[$num_logement_en_cours] : '';
            if ( !$couleur_invisible[$temp_couleur_texte]) { //controle de date en doublon pour ne garder que les couleures transparentes
                $jour_reserve[$date_index] = (bool)true ;
                $couleur_reserve_cellule[$date_index] = $couleur_temp;
                $class_reserve_cellule[$date_index] = "jour_reserve_".$couleur_texte_temp;
                $couleur_police_reserve_bdd[$date_index] = $couleur_texte_temp;
                $texte_type_reservation[$date_index] = $intitule_couleur_reserve[$couleur_texte_temp];
                $locataire_reserve[$date_index] =  ( $tri_locataire_temp <> 0 ) ? $nom_locataire[$tri_locataire_temp]." ".$prenom_locataire[$tri_locataire_temp] : '';
                $tarif_reservation[$date_index] = ( isset($format_calendrier_logement[$num_logement_en_cours]) && $format_calendrier_logement[$num_logement_en_cours] == 'calendrier_periode' ) ? (($tarif_temp)*$periode_location)." euros" : $tarif_temp ;
                $contenu_texte_infobulle[$date_index] =  $commentaire_temp;
                $contenu_infobulle[$date_index]  =  ( $avec_infobulle_visiteur && $avec_logement_infobulle_visiteur ) ? stripslashes($logement_reserve[$date_index])."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur && $commentaire_temp <> '' ) ? stripslashes($commentaire_temp)."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur && $avec_couleur_infobulle_visiteur ) ? $texte_type_reservation[$date_index]."<br>": '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur && $avec_locataire_infobulle_visiteur && $locataire_reserve[$date_index] <> '') ? addslashes($locataire_reserve[$date_index])."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur && $avec_tarif_infobulle_visiteur ) ? $tarif_reservation[$date_index]."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur) ? $texte_jour_fr[date("w",mktime(6, 0, 0, $mois_bdd, $jour_bdd, $annee_bdd))]." ".$jour_bdd." ".$mois_texte[(int)$mois_bdd]." ".$annee_bdd: '' ;
                } // fin traitement couleur ***
            $memoire_jour_precedent = $date_index;
          } // fin traitement locataire ***      
         } // fin traitement date ***
       $date_index = ajout_jour_date ($date_index,1,"JMA","-","eng");
     }
   }
}

    
//initialisation de variables************************************************************************

$date_aujourd_hui = ajout_supprime_zero (date("Y-m-d"),"Ajout","-","eng");

//affichage des tableaux des mois desirés***********************************************************
for ( $compteur_mois = 1; $compteur_mois <= $nombre_mois_afficher; $compteur_mois++ )
 {
   $compteur_mois_ligne = $compteur_mois_ligne + 1 ;

//creation du tableau des mois**********************************************************************
echo '<table cellPadding="',$espace_dans_cellule,'" cellSpacing="',$espace_entre_cellule,'" style = "width:',$largeur_tableau,'px;border :',$couleur_bordure_tableau,' ',$bordure_du_tableau,'px solid " align="left">';
//affichage du mois*********************************************************************************
echo '<tr><td class = "cellule_mois" colspan = "8" ><b>',$mois_texte[$mois_en_cours],' ',$annee_en_cours,'</b></td></tr>';

//affichage nom des jours et numéro de semaine******************************************************
echo '<tr>';

//nombre de colonne dans un calendrier un mois , dépend si choix avec ou sans numéro de semaine****
$nombre_colonne_calendrier = ( $avec_affichage_numero_semaine ) ? 9 : 8;

//temporaire pour initailisation variable globales
for ($j=1; $j<9; $j++)
     $tempor = $jour_texte[correction_debut_semaine ($texte_jour_debut_semaine,$j)];
for ($j=1; $j<$nombre_colonne_calendrier; $j++)
     {
       if  ($j == $index_jour_samedi || $j == $index_jour_dimanche)
          $style = "lettre_jour_week_end";
       elseif ( $j == 8)
          $style = "lettre_jour_num_semaine";
        else
          $style = "lettre_jour_semaine" ;
       echo '<td class = "',$style,'" >',$jour_texte[correction_debut_semaine ($texte_jour_debut_semaine,$j)],'</td>';
     }
echo '</tr>';

//initialisation des calendriers*******************************************************************
$fin_tableau              = false ;
$premier_jour_depasse     = false ;
$numero_premier_jour_mois = jour_debut_semaine ($texte_jour_debut_semaine,$mois_en_cours ,$annee_en_cours) ;
$temp_annee_mois_suivant  = $annee_en_cours ;
$temp_mois_suivant        = $mois_en_cours + 1 ;
if ( $temp_mois_suivant > 12 )  {
    $temp_mois_suivant = 1;
    $temp_annee_mois_suivant++;
    }
$numero_dernier_jour_mois = strftime("%d",mktime ( 6,0,0,$temp_mois_suivant ,0,$temp_annee_mois_suivant)) ;
$compteur_jour            = 1 ;
//variable pour uniformiser la taille des tableau mois en nombre de ligne pour tous les mois *******
$compteur_ligne           = 0 ;
$lundi_trouve = false;

//creation du tableau avec numero des jours*********************************************************
while ( !($fin_tableau) )
      {
        echo '<tr>';
        $compteur_ligne++;
        $au_moins_une_date_sur_la_ligne = false;
        //creation des cases par semaine************************************************************
        for ($j=1; $j<$nombre_colonne_calendrier; $j++)
             {
              $couleur_disponibilite = "lettre_num_jour_libre" ;
              //Test pour debut tableau pour premier jour du mois***********************************
              if ( $numero_premier_jour_mois == $j  )
                  $premier_jour_depasse = true ;
              if ( $premier_jour_depasse && ($compteur_jour <= $numero_dernier_jour_mois) && $j < 8)
                  {
                   $date_en_cours_fr  = ajout_supprime_zero ($compteur_jour."/".$mois_en_cours."/".$annee_en_cours,"Ajout","/","fr") ;
                   $date_en_cours_eng = ajout_supprime_zero ($annee_en_cours."-".$mois_en_cours."-".$compteur_jour,"Ajout","-","eng") ;

                    if ( $j == $index_jour_samedi || $j == $index_jour_dimanche)
                        $couleur_disponibilite = "lettre_num_jour_libre_week_end" ;
                    // test si le jour affiché correspond au jour d'aujourd'hui *******************
                    if ( $avec_marquage_du_jour_d_aujourd_hui ) {
                        if ( $date_aujourd_hui ==  $date_en_cours_eng )
                            $couleur_disponibilite = "lettre_num_jour_aujourdhui" ;
                        }
                    //test si jour est reservé******************************************************
                    $index_couleur_texte_police_jour_reserve = $couleur_police_reserve_bdd[$date_en_cours_eng] ;
                    $date_reserve_cliquable = true;
                    if ( $jour_reserve[$date_en_cours_eng] )  {
                        $coul_police_jour = $couleur_texte_jour_reserve[$index_couleur_texte_police_jour_reserve] ;
                        $couleur_disponibilite = $class_reserve_cellule[$date_en_cours_eng];
                        $class_date_lien = $couleur_police_reserve_bdd[$date_en_cours_eng] ;
                        //test si date réservé est cliquable
                        $date_reserve_cliquable = $couleur_date_clic[$index_couleur_texte_police_jour_reserve];
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
                       if ( $jour_reserve[$date_en_cours_eng] && !$jour_reserve[$temp_jour_precedent_reserve])
                           $couleur_disponibilite = 'jour_reserve_triangle_'.$memoire_bckgrd_jour[$date_en_cours_eng].'-'.$couleur_police_reserve_bdd[$date_en_cours_eng];
                       // front descendant **********************************************************
                       else if ( !$jour_reserve[$date_en_cours_eng] && $jour_reserve[$temp_jour_precedent_reserve] )  // jour actuel est marqué et si on n'est pas le premier jour du calendrier ********
                           $couleur_disponibilite = 'jour_reserve_triangle_'.$couleur_police_reserve_bdd[$temp_jour_precedent_reserve].'-'.$memoire_bckgrd_jour[$date_en_cours_eng];
                       // jour précédent et actuel reservé ********************************************
                       else if ( $jour_reserve[$date_en_cours_eng] && $jour_reserve[$temp_jour_precedent_reserve] ) // test si le jour précédent été marqué et donc le jour actuel ne l'est pas********
                           $couleur_disponibilite = 'jour_reserve_triangle_'.$couleur_police_reserve_bdd[$temp_jour_precedent_reserve].'-'.$couleur_police_reserve_bdd[$date_en_cours_eng];
                       
                       //test si jour est cliquable en fonction des couleurs **********************
                       $index_clic_couleur_j_prec   = ( isset ($couleur_police_reserve_bdd[$temp_jour_precedent_reserve]) && $couleur_police_reserve_bdd[$temp_jour_precedent_reserve] <> '' ) ? $couleur_police_reserve_bdd[$temp_jour_precedent_reserve] : '' ;
                       $index_clic_couleur_j_actuel = ( isset ($couleur_police_reserve_bdd[$date_en_cours_eng]) && $couleur_police_reserve_bdd[$date_en_cours_eng] <> '' ) ? $couleur_police_reserve_bdd[$date_en_cours_eng] : '' ;
                       $autor_clic_couleur_j_prec   = ( $index_clic_couleur_j_prec   <> '' ) ? $couleur_date_clic[$index_clic_couleur_j_prec]  : true ;
                       $autor_clic_couleur_j_actuel = ( $index_clic_couleur_j_actuel <> '' ) ? $couleur_date_clic[$index_clic_couleur_j_actuel]  : true ;
                       $date_reserve_cliquable = ( $autor_clic_couleur_j_prec || $autor_clic_couleur_j_actuel ) ? true : false ;
                    }
                    //controle si date actuelle est libre et peut être cliquable *****************************
                    $difference_date_actuel = round (( mktime(0,0,0,date ("m"),date ("d"),date ("Y")) - mktime(0,0,0,$mois_en_cours,$compteur_jour,$annee_en_cours) ) / $jour_en_seconde) ;
                    $date_jour_libre = ($date_reserve_cliquable || !($jour_reserve[$date_en_cours_eng]) ) ? true : false ;
                    //*******************************************************************************
                    echo '<td class ="',$couleur_disponibilite,'">';
                    if ( $date_lien == 0 && $format_date_fr && $date_jour_libre && ( $difference_date_actuel <= 0 || !$jour_barre_date_picker) )
                        echo '<a href="javascript:window.opener.document.getElementById(\'',$nom_champs_selecteur,'\').value=\'',ajout_supprime_zero ($compteur_jour.$format_separateur_date.$mois_en_cours.$format_separateur_date.$annee_en_cours,"Ajout",$format_separateur_date,"fr"),'\';window.close();" class = date',$class_date_lien,' title = "',$compteur_jour,' ',$mois_texte[$mois_en_cours],' ',$annee_en_cours,'" >';
                    if ( $date_lien == 0 && (!($format_date_fr))  && $date_jour_libre && ( $difference_date_actuel <= 0 || !$jour_barre_date_picker) )
                        echo '<a href="javascript:window.opener.document.getElementById(\'',$nom_champs_selecteur,'\').value=\'',ajout_supprime_zero ($annee_en_cours.$format_separateur_date.$mois_en_cours.$format_separateur_date.$compteur_jour,"Ajout",$format_separateur_date,"fr"),'\';window.close();" class = date',$class_date_lien,' title = "',$compteur_jour,' ',$mois_texte[$mois_en_cours],' ',$annee_en_cours,'">';
                    //recherche de la date du lundi de la semaine
                    if ( $j == $index_jour_lundi )  {
                        $memoire_numero_premier_jour_sem_en_cours =  $compteur_jour;
                        $memoire_numero_mois_premier_jour_sem_en_cours =  $mois_en_cours;
                        $memoire_numero_annee_premier_jour_sem_en_cours =  $annee_en_cours;
                        $lundi_trouve = true;
                        }
                    if ( ($difference_date_actuel > 0 && $jour_barre_date_picker) || ( isset($date_couleur_barre[$index_couleur_texte_police_jour_reserve]) && $date_couleur_barre[$index_couleur_texte_police_jour_reserve]) )
                        echo '<strike>';
                    echo $compteur_jour;
                    if ( ($difference_date_actuel > 0 && $jour_barre_date_picker) || ( isset($date_couleur_barre[$index_couleur_texte_police_jour_reserve]) && $date_couleur_barre[$index_couleur_texte_police_jour_reserve]) )
                        echo '</strike>';
                    if ( $date_lien == 0 && ( $difference_date_actuel <= 0 || !$jour_barre_date_picker) )
                        echo '</a>';
                    echo '</td>';
                    $compteur_jour++ ;
                    $au_moins_une_date_sur_la_ligne = true ;
                  }
              elseif  ( $j == 8  && $au_moins_une_date_sur_la_ligne)  {
                    //indique numéro de semaine*************************************************************************************************
                    if ( !$lundi_trouve && $compteur_ligne == 1) {  // si aucun lundi dans premier ligne, calcul numéro semaine sur dernier lundi du mois précédent****
                    $temp_mois_precedent = $mois_en_cours -1 ;
                    $temp_annee_precedent = $annee_en_cours ;
                    if  ( $temp_mois_precedent <= 0 ) {
                      $temp_mois_precedent = 12;
                      $temp_annee_precedent = $annee_en_cours - 1 ;
                      }
                    $numero_dernier_jour_calcul_semaine = strftime("%d",mktime ( 0,0,0,$mois_en_cours,0,$temp_annee_precedent)) ;
                    $premiere_boucle_recherche_lundi = true;
                    while ( !$lundi_trouve) {
                        if ( !$premiere_boucle_recherche_lundi )
                           $numero_dernier_jour_calcul_semaine = $numero_dernier_jour_calcul_semaine - 1 ;
                        $premiere_boucle_recherche_lundi = false;
                        $nom_jour_temp_calcul_semaine = strftime("%a",mktime ( 0,0,0,$temp_mois_precedent,$numero_dernier_jour_calcul_semaine,$temp_annee_precedent)) ;
                        if ( $nom_jour_temp_calcul_semaine == "Mon" ) {
                        $memoire_numero_premier_jour_sem_en_cours =  $numero_dernier_jour_calcul_semaine;
                        $memoire_numero_mois_premier_jour_sem_en_cours =  $temp_mois_precedent;
                        $memoire_numero_annee_premier_jour_sem_en_cours =  $temp_annee_precedent;
                        $lundi_trouve = true;
                           }
                        }
                      }
                    $temp_semaine_en_cours = date("W",mktime ( 0,0,0,$memoire_numero_mois_premier_jour_sem_en_cours ,$memoire_numero_premier_jour_sem_en_cours ,$memoire_numero_annee_premier_jour_sem_en_cours ));
                    echo '<td class ="chiffre_num_semaine">';
                    $lundi_trouve = false;
                    echo $temp_semaine_en_cours;
                    echo '</td>';
                    }
              else  {
                    if ( ( $j == $index_jour_samedi || $j == $index_jour_dimanche)  && $avec_continuite_couleur )
                        $couleur_disponibilite  = "lettre_num_jour_libre_week_end" ;
                    else
                        $couleur_disponibilite  = "lettre_num_jour_libre" ;
                    if ( $j == 8 && $avec_continuite_couleur )
                        $couleur_disponibilite  = "chiffre_num_semaine" ;
                    if ( !$avec_bordure_cellules_vides )
                          $couleur_disponibilite .= "_cellule_vide" ;
                    echo '<td class ="',$couleur_disponibilite,'" >&nbsp;</td>';
                    }
             }
        echo '</tr>';
        if ( $compteur_jour > $numero_dernier_jour_mois && $compteur_ligne >= 6)
                        $fin_tableau = true ;
      }
//fin de la table du mois
echo '</table></td><td>';

//incrementation du mois et annee en cours********************************************************
$mois_en_cours = $mois_en_cours + 1;
if ( $mois_en_cours > 12 )
    {
     $mois_en_cours = 1;
     $annee_en_cours = $annee_en_cours + 1 ;
    }
 if ( $compteur_mois_ligne > $nombre_mois_afficher_ligne )
    {
     echo '</tr><tr><td nowrap>';
     $compteur_mois_ligne = 1;
    }
 }
//fin de paragraphe du tableau*********************************************************************
echo '</td>
      </tr>
      </table>';

//affichage date mise à jour **********************************************************************
if ( $avec_date_mise_jour_calendrier )
  echo '<font style="font-size:10px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >',$texte_label[4],' ',$date_maj_calendrier[$langue],'</font>';


 if ( $avec_compression_page )
    ob_end_flush();

?>

</body>

</html>

