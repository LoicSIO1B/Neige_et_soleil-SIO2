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
//--------------------------------------------------------------------------------------------------
//----     Paramètres de configurations générales et modifiables                               -----
//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     include("admin/genere/connexion.php");

//chemin vers le fichier paramètres du calendrier****************************************************
     include("admin/fichier_calendrier/parametres_calendrier.php");
     $selection_an_visteur = false;
     $selection_mois_visteur = false;
//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
     //correctif nombre de mois à afficher***********************************************************
     $nombre_mois_afficher = "1" ;
//--------------------------------------------------------------------------------------------------
     
//chemin vers le fichier liste des logements et locataires*******************************************
     include("admin/fichier_calendrier/calendrier_liste_couleur.php");
     include("admin/fichier_calendrier/calendrier_liste_logement.php");
     include("admin/fichier_calendrier/calendrier_liste_locataire.php");
     include("admin/fichier_calendrier/calendrier_date_mise_a_jour.php");

//chemin vers le fichier convertisseur date**********************************************************
     include("admin/fonction.php");

//nom de la page ou se trouve le script*************************************************************
$adresse_page         = "calendrier_1mois.php";

$avec_bdd            = true ;

//insertion des langues ************************************************
     include("admin/fichier_calendrier/langue.php");

// initialisation de variables *********************************************************************
header( 'content-type: text/html; charset=ISO-8859-1' );
$header_iso	= true ;	 
	 
//choix du logement*********************************************************************************
$tri_logement = ' ';
$tri_logement2 = '';
$lien_logement = 0 ;
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
// controle si un logement est selectionné **********************************************************
if ( !isset($_SESSION['sel_tri_logement']) || empty($_SESSION['sel_tri_logement']) || $_SESSION['sel_tri_logement'] == '' || !array_key_exists($_SESSION['sel_tri_logement'], $nom_logement)) {
    echo " Aucune location n'est sélectionnée, adresse du calendrier invalide !" ;
    exit;
    }

// selection du format du calendrier ***************************************************************
   $format_calendrier_visiteur = $format_calendrier_logement[$num_logement_en_cours];
// selection jour début de semaine *****************************************************************
   $texte_jour_debut_semaine = $texte_jour_debut_semaine_logement[$num_logement_en_cours];

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

// compression code de la page ********************************************************************
 if ( $avec_compression_page )
    ob_start( 'ob_gzhandler' );

//*************************************************************************************************
// fond de page 
//*************************************************************************************************
$attribut_fond_page = ($avec_transparence_calendrier) ? 'style="background-color:transparent"' :  'bgcolor="'.$couleur_fond_page_visiteur.'"';


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

<title>Calendrier des disponibilités ou événement</title>
<meta name="description" content="Calendrier des disponibilités ou événement, calendrier php avec gestion logement et locataire">
<meta name="generator" content="Mathieuweb - http://www.mathieuweb.fr/calendrier/calendrier.php">
<meta http-equiv="Pragma" content="no-cache" >
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" >
<meta http-equiv="Expires" content="0" >
<link rel="stylesheet" href="admin/fichier_calendrier/styles.css?version=<?php echo filemtime('admin/fichier_calendrier/styles.css');?>" type="text/css" media="ALL" >

</head>

<body <?php echo $attribut_fond_page; ?> text="#000000">

<?php

$largeur_div = $largeur_tableau * $nombre_mois_afficher_ligne ;

//selection du mois et année en cours***************************************************************
$mois_en_cours  = (int)$premier_mois ;
$annee_en_cours = $annee_premier_mois ;
if ( (isset($_GET['code'])) && (!(empty($_GET['code']))) ) 
   echo 'code : '.$numero_transaction.'<br>';
if ( (isset($_GET['version'])) && (!(empty($_GET['version']))) )
   echo 'version : '.$version.' mode avec bdd :'.AVEC_BDD.'<br>';
if ( (isset($_GET['email_transaction'])) && (!(empty($_GET['email_transaction']))) )
   echo 'Email transaction : '.$email_transaction.'<br>';

// affichage sélection mois, année, couleur et champs de réservations ********************************
if ( $selection_an_visteur || $selection_mois_visteur)  {
echo '<Table border = "0" >
      <tr>
      <td align="left" valign="middle" >';
   // si nécessaire affichage du sélecteur d'année **************************************************
   if ( $selection_an_visteur ) {
        echo '<a href="',$adresse_page,'?an=',$annee_en_cours - 1,'&amp;mois=',$premier_mois,'&amp;locataire=',$lien_locataire,'&amp;logement=',$lien_logement,'" class = "selection"><font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >&nbsp;<< </font></a>
              <b><font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >&nbsp;',$annee_en_cours,'&nbsp;</font></b>
              <a href="',$adresse_page,'?an=',$annee_en_cours + 1,'&amp;mois=',$premier_mois,'&amp;locataire=',$lien_locataire,'&amp;logement=',$lien_logement,'" class = "selection"><font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >&nbsp;>> </font></a>';
        }
   // si nécessaire affichage du sélecteur de mois **********************************************
   echo '</td>';
   if ( $selection_mois_visteur ) {
        echo '<form name="sel_mois" method="get" action="',$adresse_page,'" id="Form1">
              <td align="left" valign="middle" >
              <select name="mois" size="1" id="Combobox1" onchange="document.sel_mois.submit();return false;" style="font-family:',$police,';font-size:',$taille_police_sel_mois_annee,'px;z-index:2">';
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
              </td>
              </form>';
     } 
  echo '</tr></table>';
}
//*************************************************************************************************

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
               echo '<td class = "jour_reserve_',$cle,'" ><font style="font-size:',$taille_police_sel_mois_annee,'px" face="',$police,'" >',$intitule_couleur_reserve[$cle],'</font></td>';
             }
           }
        }
        echo '</tr>
              </table>';
   }

   // si nécessaire affichange du sélecteur de logement **********************************************
   if ( $avec_selection_logement_visteur  ) {
        echo '<Table border = "0" > <tr><td>
              <form name="logement" method="get" action="',$adresse_page,'" id="Form1">
              <font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >Choix ',$item1,':<br>
              <input type="hidden" id="locataire" name="locataire" value="',$_SESSION['sel_tri_locataire'],'">';
        liste_box ("logement",'',$nom_logement,"",true,$_SESSION['sel_tri_logement'],false,"logement");
        echo '</form>
              </td>
              </tr>
              </table>';
        }
//*************************************************************************************************

   // si nécessaire affichage du sélecteur de Locataire **********************************************
   if ( $avec_selection_locataire_visteur  ) {
        echo '<Table border = "0" > <tr><td><form name="locataire" method="get" action="',$adresse_page,'" id="Form1">
              <font style="font-size:',$taille_police_sel_mois_annee,'px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >Choix Locataire:<br>';
        liste_box ("locataire",'',$nom_locataire,$prenom_locataire,false,$_SESSION['sel_tri_locataire'],true,"");
        echo '</form>
              </td>
              </tr>
              </table>';
        }
//*************************************************************************************************


//initailisation compteur de mois par ligne*********************************************************
$compteur_mois_ligne = 1 ;

echo '<table cellSpacing="',$espace_entre_les_mois,'" >
      <tr>
      <td nowrap>';
//calcul pour récupération des dates dans la période voulue **************************************
$poub_mois_dernier_mois = $premier_mois ;
$poub_annee_dernier_mois = $annee_premier_mois;
$jour_en_seconde = 3600 * 24 ;
$periode_location = 7;

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
$date_premier_jour_calendrier = $annee_premier_mois."-".$premier_mois."-01";
$date_premier_jour_tableau = ajout_jour_date (ajout_supprime_zero ($date_premier_jour_calendrier,"Ajout","-","eng"),-7,"JMA","-","eng");
$date_dernier_jour_tableau = ajout_jour_date (ajout_supprime_zero ($poub_date_dernier_jour,"Ajout","-","eng"),7,"JMA","-","eng");
$nombre_jour_pour_periode = (int) nb_jour_date ($date_premier_jour_tableau,$date_dernier_jour_tableau,"-","eng");

$date_boucle = ajout_supprime_zero ($date_premier_jour_tableau,"Ajout","-","eng");

//initialisation du tableau des jours reservés dans le mois en cours*****************************
   for ( $i=0; $i < $nombre_jour_pour_periode+2; $i++ )  {
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
                $couleur_reserve_cellule[$date_index] = "$data->couleur";
                $couleur_police_reserve_bdd[$date_index] = "$data->couleur_texte";
                $texte_type_reservation[$date_index] = $intitule_couleur_reserve[$data->couleur_texte];
                $locataire_reserve[$date_index] =  ( $data->id_locataire <> 0 ) ? $nom_locataire[$data->id_locataire]." ".$prenom_locataire[$data->id_locataire] : '';
                $tarif_reservation[$date_index] = ( isset($format_calendrier_logement[$data->id_logement]) && $format_calendrier_logement[$data->id_logement] == 'calendrier_periode' ) ? (($data->tarif)*$periode_location)." euros" : $data->tarif." euros" ;
                $contenu_texte_infobulle[$date_index] =  $data->commentaires;
                $contenu_infobulle[$date_index]  =  ( $avec_infobulle_visiteur && $avec_logement_infobulle_visiteur ) ? stripslashes($logement_reserve[$date_index])."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur && $data->commentaires <> '' ) ? stripslashes($data->commentaires)."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur && $avec_couleur_infobulle_visiteur ) ? $texte_type_reservation[$date_index]."<br>": '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur && $avec_locataire_infobulle_visiteur && $locataire_reserve[$date_index] <> '') ? addslashes($locataire_reserve[$date_index])."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur && $avec_tarif_infobulle_visiteur ) ? $tarif_reservation[$date_index]."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur ) ? $jour_texte[date("w",mktime(6, 0, 0, $mois_bdd, $jour_bdd, $annee_bdd))]." ".$jour_bdd." ".$mois_texte[(int)$mois_bdd]." ".$annee_bdd: '' ;
                }

          }
      @mysql_close();
      }
   }
} // fin de recupération avec base de données ***************************

//************************************************************************
// fonctionnement avec base de données
//************************************************************************
elseif ( !AVEC_BDD ) {
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
                $tarif_reservation[$date_index] = ( isset($format_calendrier_logement[$num_logement_en_cours]) && $format_calendrier_logement[$num_logement_en_cours] == 'calendrier_periode' ) ? (($tarif_temp)*$periode_location)." euros" : $tarif_temp." euros" ;
                $contenu_texte_infobulle[$date_index] =  $commentaire_temp;
                $contenu_infobulle[$date_index]  =  ( $avec_infobulle_visiteur && $avec_logement_infobulle_visiteur ) ? stripslashes($logement_reserve[$date_index])."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur && $commentaire_temp <> '' ) ? stripslashes($commentaire_temp)."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur && $avec_couleur_infobulle_visiteur ) ? $texte_type_reservation[$date_index]."<br>": '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur && $avec_locataire_infobulle_visiteur && $locataire_reserve[$date_index] <> '') ? addslashes($locataire_reserve[$date_index])."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur && $avec_tarif_infobulle_visiteur ) ? $tarif_reservation[$date_index]."<br>" : '';
                $contenu_infobulle[$date_index] .=  ( $avec_infobulle_visiteur ) ? $jour_texte[date("w",mktime(6, 0, 0, $mois_bdd, $jour_bdd, $annee_bdd))]." ".$jour_bdd." ".$mois_texte[(int)$mois_bdd]." ".$annee_bdd: '' ;
                } // fin traitement couleur ***
            $memoire_jour_precedent = $date_index;
          } // fin traitement locataire ***      
         } // fin traitement date ***
       $date_index = ajout_jour_date ($date_index,1,"JMA","-","eng");
     }
   }
}

//initialisation de variables************************************************************************

$date_aujourd_hui = date("Y-m-d");

// chemin vers le fichier calendrier selon le format désiré *************
  
  $var_page = "admin/".$format_calendrier_visiteur."_1mois.php";
  if ( file_exists($var_page) )
     include($var_page);
  else
     include("admin/calendrier_journalier_1mois.php");
     


?>