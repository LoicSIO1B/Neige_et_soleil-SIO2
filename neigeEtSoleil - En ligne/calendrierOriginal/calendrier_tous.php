<?php
//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
//demarrage des sessions****************************************************************************
//----  si cette page est affcihée en dehors de la page index_calendrier.php il faut absolument ----
//----  mettre l'instruction suivante en début du fichier                                       ----
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
$adresse_page         = "calendrier_tous.php";
//nom de la page a ouvrir lorsqu'on clic sur une date***********************************************
$adresse_destination  = "calendrier_tous.php";

//--------------------------------------------------------------------------------------------------
// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     include("admin/genere/connexion.php");

//chemin vers le fichier paramètres du calendrier****************************************************
     include("admin/fichier_calendrier/parametres_calendrier.php");
     $avec_selection_logement_visteur  = false;
     $avec_selection_locataire_visteur = false;

//chemin vers le fichier liste des logements couleur et locataires*******************************************
     include("admin/fichier_calendrier/calendrier_liste_couleur.php");
     include("admin/fichier_calendrier/calendrier_liste_logement.php");
     include("admin/fichier_calendrier/calendrier_liste_locataire.php");

//chemin vers le fichier convertisseur date**********************************************************
     include("admin/fonction.php");

//chemin vers le fichier date mise à jour **********************************************************
     include("admin/fichier_calendrier/calendrier_date_mise_a_jour.php");

//format de date sur le lien des jours dans le calendrier--------------------------------------------
// si true alors selection format francais, si false alors format date anglais-----------------------
$format_date_fr    = true ;

//insertion des langues ************************************************
     include("admin/fichier_calendrier/langue.php");

// initialisation de variables *********************************************************************
header( 'content-type: text/html; charset=ISO-8859-1' );
$header_iso	= true ;	 
	 
//choix du logement*********************************************************************************
$tri_logement = ' ';
$tri_logement2 = ", ' '";
$tri_logement3 = ' ';
$lien_logement = 0 ;

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
   $lien_logement = $_SESSION['sel_tri_logement'];
   }

//choix du locataire********************************************************************************
   $tri_locataire = ' ';
   $tri_locataire2 = ", ' '";
   $num_locataire_en_cours = '';
   $lien_locataire = 0 ;
   $tri_locataire_ss_bdd = 0 ;
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
      $num_locataire_en_cours = $_SESSION['sel_tri_locataire'];
      $lien_locataire =  $_SESSION['sel_tri_locataire'];
      $tri_locataire_ss_bdd = $_SESSION['sel_tri_locataire'] ;
    }

//choix date avec lien******************************************************************************
// si $date_lien = 0 alors chaque jour du calendrier aura lien , celien peut servir à marquer les jours
// ou peut renvoyer la date vers une autre page
// si $date_lien =1 alors les jours n'ont aucun lien
$date_lien = 0;
//controle si choix san lien pour les dates dans l'url**********************************************
//if ( (isset($_GET['date_lien']))  )
//    $_SESSION['date_lien'] = $_GET['date_lien'] ;
//si session sans lien sur les dates existe alors la session devient prioritaire********************
//if ( (isset($_SESSION['date_lien'])) && (!(empty($_SESSION['date_lien']))) )
//   $date_lien = $_SESSION['date_lien'] ;

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

//controle si choix du nombre de mois dans l'url**************************************************************
$nombre_semaine_calendrier_tous_parametre	=	$nombre_semaine_calendrier_tous;
$_SESSION['nombre_semaine'] ='';
if ( (isset($_GET['nombre_semaine'])) && (empty($_GET['nombre_semaine'])) )
    $_SESSION['nombre_semaine'] = '' ;
if ( (isset($_GET['nombre_semaine'])) && (!(empty($_GET['nombre_semaine']))) )  {
    $_SESSION['nombre_semaine'] = (int)$_GET['nombre_semaine'] ;
    //fixe les limites de valeur ***
    if ( $_SESSION['nombre_semaine'] < 1 )
         $_SESSION['nombre_semaine'] = 1 ;
;
    }
//si session mois existe alors la session devient prioritaire***************************************
if ( (isset($_SESSION['nombre_semaine'])) && (!(empty($_SESSION['nombre_semaine']))) )
   $nombre_semaine_calendrier_tous = $_SESSION['nombre_semaine'] ;   
   
//*************************************************************************************************
// fond de page 
//*************************************************************************************************
$attribut_fond_page = ($avec_transparence_calendrier) ? 'style="background-color:transparent"' :  'bgcolor="'.$couleur_fond_page_visiteur.'"';


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
<meta name="description" content="Calendrier des disponibilités hébergé votre calendrier des disponibilités sur http://www.mathieuweb.fr/calendrier/calendrier.php, calendrier php avec gestion logement et locataire">
<meta name="generator" content="Mathieuweb - http://www.mathieuweb.fr/calendrier/calendrier.php">
<meta http-equiv="Pragma" content="no-cache" >
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" >
<meta http-equiv="Expires" content="0" >
<link href="admin/fichier_calendrier/styles.css?version=<?php echo filemtime('admin/fichier_calendrier/styles.css');?>" rel="stylesheet" type="text/css" media="all">

<script type="text/javascript">
//fonction pour affichage responsive
<?php
	// adresse du script (- sans reprendre le paramètre nombre_mois_ligne )
    $page_en_cours_sans_get 		= explode('?',$_SERVER["SCRIPT_NAME"]) ;
	$mode_http						= ($_SERVER['HTTPS'] != 'on' ) ? 'http://' : 'https://' ;
	$adresse_page_script_responsive = $mode_http.$_SERVER["HTTP_HOST"].$page_en_cours_sans_get[0].'?an='.$annee_premier_mois.'&mois='.$premier_mois.'&locataire='.$lien_locataire.'&logement='.$lien_logement; //echo $adresse_page_script_responsive;
?>	
// permet de recharger la page pour avoir un affichage responsive du calendrier
// modifie uniquement le nombre de mois par ligne , ne modifie pas le nombre de mois total affiché
function redimensionne_calendrier(nombre_semaine_parametre,nombre_semaine_actuel,dimension_1_jour,dimension_mois) {
	offset 						= 10 ; //offset en pixel pour garder la marge de sécurité lors du calcul du redimensionnement du calendrier
	largeur_fenetre 			= window.innerWidth; // alert(largeur_fenetre);
	nombre_de_semaine_possible	= largeur_fenetre - dimension_mois - offset; 
	nombre_de_semaine_possible 	= Math.floor(nombre_de_semaine_possible/(dimension_1_jour*7+2*dimension_1_jour)); // alert(nombre_de_semaine_possible);
	longueur_calendrier			= dimension_mois + nombre_de_semaine_possible * dimension_1_jour*7 ;
	//alert("largeur fenetre : "+largeur_fenetre+" // dimension 1 jour "+ dimension_1_jour +" // nombre de semaine " + nombre_de_semaine_possible+ " // longeur calendrier "+longueur_calendrier);
	if ( nombre_de_semaine_possible > nombre_semaine_parametre )
		nombre_de_semaine_possible	= nombre_semaine_parametre ;
	// rechargement de la page si le nombre de mois possible est différent de celui affiché et inférieur au nombre de mois par ligne des paramètres
	if ( nombre_semaine_actuel != nombre_de_semaine_possible  ) {
		window.location			 = '<?php echo $adresse_page_script_responsive;?>'+'&nombre_semaine='+nombre_de_semaine_possible;
		}
	}

var timer;
// si la page est redimensionnée ....
window.onresize = function(){
    clearInterval( timer );
    timer = setTimeout( function(){
        redimensionne_calendrier(<?php if (isset($nombre_semaine_calendrier_tous_parametre)) echo $nombre_semaine_calendrier_tous_parametre; else echo '100';?>,<?php echo $nombre_semaine_calendrier_tous?>,<?php echo $largeur_mini_cellule_date?>,<?php echo $largeur_tableau?>);
    }, 500 );
}

// au chargement de la page ... 
window.onload = function(){
    clearInterval( timer );
    timer = setTimeout( function(){
        redimensionne_calendrier(<?php if (isset($nombre_semaine_calendrier_tous_parametre)) echo $nombre_semaine_calendrier_tous_parametre; else echo '100';?>,<?php echo $nombre_semaine_calendrier_tous?>,<?php echo $largeur_mini_cellule_date?>,<?php echo $largeur_tableau?>);
    }, 100 );
}
</script>

</head>

<body <?php echo $attribut_fond_page; ?> text="#000000" >


<?php

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
$date_offset = ajout_jour_date ($date_premier_jour_calendrier,abs($offset_depart_calendrier_tous),"JMA","-","eng");
$date_aujourd_hui = ajout_supprime_zero (date("Y-m-d"),"Ajout","-","eng");

//************************************************************************
// creation des tableaux dates ************************************
//************************************************************************

$date_premier_jour_tableau = ajout_jour_date (ajout_supprime_zero ($date_premier_jour_calendrier,"Ajout","-","eng"),-7,"JMA","-","eng");
$date_dernier_jour_tableau = ajout_jour_date (ajout_supprime_zero ($date_dernier_jour_calendrier,"Ajout","-","eng"),7,"JMA","-","eng");

if ( isset ($nom_logement) ) {
foreach ($nom_logement as $cle => $libelle_logement ) {
$date_boucle = $date_premier_jour_tableau;
//initialisation du tableau des jours reservés dans le mois en cours*****************************
   for ( $i=0; $i < $nombre_jour_pour_periode+abs($offset_depart_calendrier_tous)+28; $i++ )   {
        list($annee_index,$mois_index,$jour_index) = explode ( "-", $date_boucle ) ;
        $jour_reserve[$cle][$date_boucle] = (bool)false ;
        $couleur_reserve_cellule[$cle][$date_boucle] = '' ;
        $class_reserve_cellule[$cle][$date_boucle] = '' ;
        $couleur_police_reserve_bdd[$cle][$date_boucle] = '' ;
        $couleur_reserve_cellule[$cle][$date_boucle] = '' ;
        $contenu_infobulle[$cle][$date_boucle] = '';
        $contenu_texte_infobulle[$date_boucle] = '';
        $locataire_reserve[$cle][$date_boucle] = '';
        $texte_type_reservation[$cle][$date_boucle] = '';
        $index_valeur_jour_semaine = date("w",mktime(6, 0, 0, $mois_index, $jour_index, $annee_index));
        $memoire_bckgrd_jour[$cle][$date_boucle] =( $index_valeur_jour_semaine == 0 || $index_valeur_jour_semaine == 6 ) ? 'weekend' : 'libre';
        $date_boucle = ajout_jour_date ($date_boucle,1,"JMA","-","eng") ;
        }
    }
}
else   //aucun logement ne corrspond aux critères****
  $avec_bdd = false;

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
   $valeur_select = "SELECT * FROM ".Decrypte(nom_table_cal,$Cle)." WHERE date_reservation >= '$date_premier_jour_tableau' AND date_reservation <= '$date_dernier_jour_tableau' $tri_locataire  order by id_logement , date_reservation, id ";
   $requete = @mysql_query ($valeur_select);
   while ( $data = mysql_fetch_object($requete) )
          {
            if (!isset($memoire_du_logement) )
                 $memoire_du_logement = $data->id_logement ;
             if ( $memoire_du_logement <> $data->id_logement ) //réinitialisation des variables si on traite un autre logement
                 $memoire_jour_precedent = '' ;
            $date_index =  $data->date_reservation;
            list($annee_bdd,$mois_bdd,$jour_bdd) = explode ("-",$date_index );
            $temp_couleur_texte = $data->couleur_texte ;
            if ($memoire_jour_precedent <> $date_index && !$couleur_invisible[$temp_couleur_texte]) { //controle de date en doublon pour ne garder que les couleures transparentes
                $jour_reserve[$data->id_logement][$date_index] = (bool)true ;
                $couleur_reserve_cellule[$data->id_logement][$date_index] = $data->couleur;
                $class_reserve_cellule[$data->id_logement][$date_index] = "jour_reserve_".$data->couleur_texte;
                $couleur_police_reserve_bdd[$data->id_logement][$date_index] = $data->couleur_texte;
                $texte_type_reservation[$data->id_logement][$date_index] = $intitule_couleur_reserve[$data->couleur_texte];
                $affiche_tarif = $data->tarif;
                if ( $format_calendrier_logement[$data->id_logement]== 'calendrier_periode' ) {
                     $affiche_tarif = $affiche_tarif * 7;
                     list($annee_bdd2,$mois_bdd2,$jour_bdd2) = explode ("-",ajout_jour_date ($date_index,6,"JMA","-","eng") );
                     $date_affiche = $jour_bdd." ".$mois_texte[(int)$mois_bdd]." ".$annee_bdd." ".$texte_label[2]." ".$jour_bdd2." ".$mois_texte[(int)$mois_bdd2]." ".$annee_bdd2;
                }
                else
                     $date_affiche = $jour_bdd." ".$mois_texte[(int)$mois_bdd]." ".$annee_bdd;
                $locataire_reserve[$data->id_logement][$date_index] =  ( $data->id_locataire <> 0 ) ? $nom_locataire[$data->id_locataire]." ".$prenom_locataire[$data->id_locataire] : '';
                $contenu_texte_infobulle[$data->id_logement][$date_index] =  $data->commentaires;
                $contenu_infobulle[$data->id_logement][$date_index]  =  ( $avec_infobulle_visiteur && $avec_logement_infobulle_visiteur ) ? stripslashes($nom_logement[$memoire_du_logement])."<br>" : '';
                $contenu_infobulle[$data->id_logement][$date_index] .=  ( $avec_infobulle_visiteur && $data->commentaires <> '' ) ? stripslashes($data->commentaires)."<br>" : '';
                $contenu_infobulle[$data->id_logement][$date_index] .=  ( $avec_infobulle_visiteur && $avec_couleur_infobulle_visiteur ) ? $texte_type_reservation[$data->id_logement][$date_index]."<br>": '';
                $contenu_infobulle[$data->id_logement][$date_index] .=  ( $avec_infobulle_visiteur && $avec_locataire_infobulle_visiteur && $locataire_reserve[$data->id_logement][$date_index] <> '') ? addslashes($locataire_reserve[$data->id_logement][$date_index])."<br>" : '';
                $contenu_infobulle[$data->id_logement][$date_index] .=  ( $avec_infobulle_visiteur && $avec_tarif_infobulle_visiteur ) ? $affiche_tarif." euros<br>" : '';
                $contenu_infobulle[$data->id_logement][$date_index] .=  ( $avec_infobulle_visiteur) ? $date_affiche : '' ;
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
   if ( isset ($nom_logement) ) {
   foreach ($nom_logement as $cle => $libelle_logement ) {

   //recupération des dates pour le logement en cours de traitement *********
   unset($tableau_reservation); // réinitialisation des variables tableau ***
   $memoire_jour_precedent = '' ;
   $chemin_fichier_logement = "admin/fichier_calendrier/dates_sans_bdd/".$cle."_calendrier.php";

   if ( file_exists($chemin_fichier_logement)) {
      include($chemin_fichier_logement);

   if ( isset($tableau_reservation[$cle]) && $cle <> 0) {
   //mise en forme des dates premier et dernier jours **********************************************
   $nombre_jour_periode =  (int) nb_jour_date ($date_premier_jour_calendrier,$date_dernier_jour_tableau,"-","eng") + 1;
   $date_index = $date_premier_jour_tableau ;
   for ( $i = 1 ; $i <= $nombre_jour_periode ; $i++ ) {
     if (array_key_exists($date_index, $tableau_reservation[$cle]))  {
          list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$tableau_reservation[$cle][$date_index]);
            list($annee_bdd,$mois_bdd,$jour_bdd) = explode ("-",$date_index );
          if ( $tri_locataire_ss_bdd == 0 || $tri_locataire_ss_bdd == $tri_locataire_temp ) {
            $temp_couleur_texte = $couleur_texte_temp ;
            if ($memoire_jour_precedent <> $date_index && !$couleur_invisible[$temp_couleur_texte] ) { //controle de date en doublon pour ne garder que les couleures transparentes
                $jour_reserve[$cle][$date_index] = (bool)true ;
                $couleur_reserve_cellule[$cle][$date_index] = $couleur_temp;
                $class_reserve_cellule[$cle][$date_index] = "jour_reserve_".$couleur_texte_temp;
                $couleur_police_reserve_bdd[$cle][$date_index] = $couleur_texte_temp;
                if ( $format_calendrier_logement[$cle]== 'calendrier_periode' ) {
                     $tarif_temp = $tarif_temp * 7;
                     list($annee_bdd2,$mois_bdd2,$jour_bdd2) = explode ("-",ajout_jour_date ($date_index,6,"JMA","-","eng") );
                     $date_affiche = $jour_bdd." ".$mois_texte[(int)$mois_bdd]." ".$annee_bdd." ".$texte_label[2]." ".$jour_bdd2." ".$mois_texte[(int)$mois_bdd2]." ".$annee_bdd2;
                }
                else
                     $date_affiche = $jour_bdd." ".$mois_texte[(int)$mois_bdd]." ".$annee_bdd;
                $texte_type_reservation[$cle][$date_index] = $intitule_couleur_reserve[$couleur_texte_temp];
                $locataire_reserve[$cle][$date_index] =  ( $tri_locataire_temp <> 0 ) ? $nom_locataire[$tri_locataire_temp]." ".$prenom_locataire[$tri_locataire_temp] : '';
                $contenu_texte_infobulle[$cle][$date_index] =  $commentaire_temp;
                $contenu_infobulle[$cle][$date_index]  =  ( $avec_infobulle_visiteur && $avec_logement_infobulle_visiteur ) ? stripslashes($libelle_logement)."<br>" : '';
                $contenu_infobulle[$cle][$date_index] .=  ( $avec_infobulle_visiteur && $commentaire_temp <> '' ) ? stripslashes($commentaire_temp)."<br>" : '';
                $contenu_infobulle[$cle][$date_index] .=  ( $avec_infobulle_visiteur && $avec_couleur_infobulle_visiteur ) ? $texte_type_reservation[$cle][$date_index]."<br>": '';
                $contenu_infobulle[$cle][$date_index] .=  ( $avec_infobulle_visiteur && $avec_locataire_infobulle_visiteur && $locataire_reserve[$cle][$date_index] <> '') ? addslashes($locataire_reserve[$cle][$date_index])."<br>" : '';
                $contenu_infobulle[$cle][$date_index] .=  ( $avec_infobulle_visiteur && $avec_tarif_infobulle_visiteur ) ? $tarif_temp." euros<br>" : '';
                $contenu_infobulle[$cle][$date_index] .=  ( $avec_infobulle_visiteur) ? $date_affiche : '' ;
                } // fin traitement couleur ***
             $memoire_jour_precedent = $date_index;
          } // fin traitement locataire ***      
         } // fin traitement date ***
       $date_index = ajout_jour_date ($date_index,1,"JMA","-","eng");
     }
     }
   }
   }
   }
}

//creation du tableau des mois**********************************************************************
echo '<table cellPadding="0" cellSpacing="0" align="left">
      <tr>
      <td nowrap width="100px">
      <table cellPadding="',$espace_dans_cellule,'" cellSpacing="',$espace_entre_cellule,'" style = "border :',$couleur_bordure_tableau,' ',$bordure_du_tableau,'px solid " align="left">';

//ligne des mois, années et noms des jours**************************************

$index_jour_ligne_liste_jour = date("w",mktime ( 0,0,0,$date_premier_jour_explode[1] ,$date_premier_jour_explode[2],$date_premier_jour_explode[0])) ;  //numero du jour dans le semaine
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
      <b>< </b><a href="',$adresse_page,'?go_date=',$date_recule,'&amp;locataire=',$lien_locataire,'&amp;logement=',$lien_logement,'" class ="offset"> ',$offset_recul_date/7,' ',$texte_label[0],'</a>
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
     <b>> </b><a href="',$adresse_page,'?go_date=',$date_avance,'&amp;locataire=',$lien_locataire,'&amp;logement=',$lien_logement,'" class ="offset"> +',$offset_avance_date/7,' ',$texte_label[0],'</a>
      </td>
     ',$code_html_ligne_texte_jour,'</tr>
     <tr>
     <td class ="cellule_separateur_horizontal" colspan = "',$nombre_jour_pour_periode+5,'" >
     </td>
     </tr>';

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

//variable pour uniformiser la taille des tableau mois en nombre de ligne pour tous les mois *******
$compteur_cellule         = 1 ; // cellule 1 = première cellule lundi
$index_jour_ligne_liste_jour = date("w",mktime ( 6,0,0,$date_premier_jour_explode[1] ,$date_premier_jour_explode[2],$date_premier_jour_explode[0])) ; ; // index pour couleur de fond suivant jour semaine ou week end

echo '<tr>
      <td class ="cellule_plus_moins_mois" nowrap><b>',stripslashes($libelle_logement),'</b>
      </td>';
//creation du tableau avec numero des jours*********************************************************
while ( !($fin_tableau) )
      {

        $couleur_disponibilite = "lettre_num_jour_libre" ;
        $index_couleur_texte_police_jour_reserve = 0;
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
                    if ( $jour_reserve[$cle][$date_en_cours_eng] )  {
                        $index_couleur_texte_police_jour_reserve = $couleur_police_reserve_bdd[$cle][$date_en_cours_eng] ;
                        $coul_police_jour = $couleur_texte_jour_reserve[$index_couleur_texte_police_jour_reserve] ;
                        $couleur_disponibilite = $class_reserve_cellule[$cle][$date_en_cours_eng];
                        $class_date_lien = $couleur_police_reserve_bdd[$cle][$date_en_cours_eng] ;
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
                       else if ( $jour_reserve[$cle][$date_en_cours_eng] && $jour_reserve[$cle][$temp_jour_precedent_reserve] ) // test si le jour précédent été marqué et donc le jour actuel ne l'est pas********
                           $couleur_disponibilite = 'jour_reserve_triangle_'.$couleur_police_reserve_bdd[$cle][$temp_jour_precedent_reserve].'-'.$couleur_police_reserve_bdd[$cle][$date_en_cours_eng];

                    }
                    //*******************************************************************************
                    // recherche si separateur vertical pour fin de mois *********************************
                    //*******************************************************************************
                    if ( $bordure_gauche_colonne[$compteur_jour] )
                      echo '<td class ="cellule_separateur_vertical" ></td>';
                    //*******************************************************************************
                    echo '<td class ="',$couleur_disponibilite,'" >';
                    //*******************************************************************************
                    //jour barré en fonction de la couleur ******************************************
                    //*******************************************************************************
                    $difference_date_actuel = nb_jour_date (date ("d-m-Y"),$jour_en_cours."-".$mois_en_cours."-".$annee_en_cours,"-","fr") ;
                    if ( ($difference_date_actuel < 0 && $jour_barre_calendrier_visiteur) || ( isset($date_couleur_barre[$index_couleur_texte_police_jour_reserve]) && $date_couleur_barre[$index_couleur_texte_police_jour_reserve]) ) {
                       $attribut_debut_strike = "<strike>";
                       $attribut_fin_strike  = "</strike>";
                       }
                    else {
                       $attribut_debut_strike = "";
                       $attribut_fin_strike  = "";
                       }
                    //*******************************************************************************
                    // date et liens pour les calendriers journaliers *******************************
                    //*******************************************************************************
                    if( $format_calendrier_logement[$cle] <> 'calendrier_periode' ) {
                    if ( $format_date_fr && ( $difference_date_actuel >= 0 || !$jour_barre_calendrier_visiteur) && ($avec_lien_autre_page_visiteur || ( $avec_infobulle_visiteur &&  $jour_reserve[$cle][$date_en_cours_eng] )) ) {
                        $date_envoi_autre_page = Str_replace ( "xxxx",$date_en_cours_fr , stripslashes($lien_autre_page_visiteur)) ;
                        echo '<a ',$date_envoi_autre_page,' class = "date',$class_date_lien,'" >';
                    }
                    if ( !$format_date_fr  && ( $difference_date_actuel >= 0 || !$jour_barre_calendrier_visiteur) && ($avec_lien_autre_page_visiteur || ( $avec_infobulle_visiteur &&  $jour_reserve[$cle][$date_en_cours_eng] )) ) {
                        $date_envoi_autre_page = Str_replace ( "xxxx",$date_en_cours_eng , stripslashes($lien_autre_page_visiteur));
                        echo '<a ',$date_envoi_autre_page,' class = "date',$class_date_lien,'" >';
                    }

                    if ( !$avec_lien_autre_page_visiteur && $avec_infobulle_visiteur &&  $jour_reserve[$cle][$date_en_cours_eng] && ( $difference_date_actuel >= 0 || !$jour_barre_calendrier_visiteur) )
                        echo '<a href="#" class = "date',$class_date_lien,'" >';

                    echo $attribut_debut_strike.$jour_en_cours.$attribut_fin_strike;

                    if ( ( $difference_date_actuel >= 0 || !$jour_barre_calendrier_visiteur) && ($avec_lien_autre_page_visiteur || ( $avec_infobulle_visiteur &&  $jour_reserve[$cle][$date_en_cours_eng])) ) {
                      $contenu_affiche_infobulle =  $index_num_jour_de_la_semaine[$compteur_cellule]." ".$jour_en_cours." ".$mois_texte[(int)$mois_en_cours]." ".$annee_en_cours ;
                        if  ( $contenu_infobulle[$cle][$date_en_cours_eng] <> '' )
                             echo '<em><span></span>',$contenu_infobulle[$cle][$date_en_cours_eng],'</em>';
                    echo '</a>';
                     }
                    }
                    //*******************************************************************************
                    // date et liens pour les calendriers période ***********************************
                    //*******************************************************************************
                    else { 
                    if ( $format_date_fr && $index_num_jour_de_la_semaine[$compteur_cellule] == $texte_jour_debut_semaine_logement[$cle] && ( $difference_date_actuel >= 0 || !$jour_barre_calendrier_visiteur) && ($avec_lien_autre_page_visiteur || ( $avec_infobulle_visiteur &&  $jour_reserve[$cle][$date_en_cours_eng] )) ) {
                        $date_envoi_autre_page = Str_replace ( "xxxx",$date_en_cours_fr , stripslashes($lien_autre_page_visiteur)) ;
                        echo '<a ',$date_envoi_autre_page,' class = "date',$class_date_lien,'" >';
                    }
                    if ( !$format_date_fr && $index_num_jour_de_la_semaine[$compteur_cellule] == $texte_jour_debut_semaine_logement[$cle] && ( $difference_date_actuel >= 0 || !$jour_barre_calendrier_visiteur) && ($avec_lien_autre_page_visiteur || ( $avec_infobulle_visiteur &&  $jour_reserve[$cle][$date_en_cours_eng] )) ) {
                        $date_envoi_autre_page = Str_replace ( "xxxx",$date_en_cours_eng , stripslashes($lien_autre_page_visiteur));
                        echo '<a ',$date_envoi_autre_page,' class = "date',$class_date_lien,'" >';
                    }
                    if ( $index_num_jour_de_la_semaine[$compteur_cellule] == $texte_jour_debut_semaine_logement[$cle] && !$avec_lien_autre_page_visiteur && $avec_infobulle_visiteur &&  $jour_reserve[$cle][$date_en_cours_eng] && ( $difference_date_actuel >= 0 || !$jour_barre_calendrier_visiteur) )
                        echo '<a href="#" class = "date',$class_date_lien,'" >';
                        
                    echo $attribut_debut_strike.$jour_en_cours.$attribut_fin_strike;

                    if ( $index_num_jour_de_la_semaine[$compteur_cellule] == $texte_jour_debut_semaine_logement[$cle] && ( $difference_date_actuel >= 0 || !$jour_barre_calendrier_visiteur) && ($avec_lien_autre_page_visiteur || ( $avec_infobulle_visiteur &&  $jour_reserve[$cle][$date_en_cours_eng])) ) {
                        list($temp_fin_periode_an,$temp_fin_periode_mois,$temp_fin_periode_jour) = explode ("-",ajout_jour_date ($date_en_cours_colonne,$periode_location-1,"JMA","-","eng"));
                        $contenu_affiche_infobulle =  ( $avec_affichage_infobulle_complete ) ? $jour_en_cours." ".$mois_texte[(int)$mois_en_cours]." ".$annee_en_cours." ".$texte_label[2]." ".$temp_fin_periode_jour." ".$mois_texte[(int)$temp_fin_periode_mois]." ".$temp_fin_periode_an : '';
                        if  ( $contenu_infobulle[$cle][$date_en_cours_eng] <> '' )
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
        if ( $compteur_cellule > $nombre_jour_pour_periode +2 ) {   // +2 a cause des seprateur vertical entre les mois
                        $fin_tableau = true ;
                        echo '</tr>';
                    }
      }
//fin de la table du mois
echo '<tr>
      <td class ="cellule_separateur_horizontal" colspan = "',$nombre_jour_pour_periode+5,'" >
      </td>
      </tr>';

    }
  }
}
//fin de paragraphe du tableau*********************************************************************

echo '</table>
      </td>
      </tr>
      <tr>
      <td>';

//affichage date mise à jour **********************************************************************
if ( $avec_date_mise_jour_calendrier )
  echo '<font style="font-size:10px" color="',$couleur_sel_mois_annee,'" face="',$police,'" >',$texte_label[4],' ',$date_maj_calendrier[$langue],'</font>';
  echo '<br>';

echo '</td>
      </tr>
      </table>';

 if ( $avec_compression_page )
    ob_end_flush();
?>

</body>

</html>

