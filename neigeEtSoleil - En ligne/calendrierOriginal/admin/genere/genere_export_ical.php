<?php
// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
if (!defined('AUTOR_FCT_SAUVEGARDE') ) 
	require("secure_genere.php");

if ( isset($chemin_admin) )
	$chemin_admin_temp	= $chemin_admin."/admin/";
else
	$chemin_admin_temp	= "";

//chemin vers le fichier liste des logements couleur et locataires*******************************************
     include($chemin_admin_temp."fichier_calendrier/calendrier_liste_couleur.php");
	 include($chemin_admin_temp."fichier_calendrier/calendrier_liste_logement.php");

//========================================================================================
//			choix date de départ
//========================================================================================

$date_debut_ical       	= date ("Y-m-d") ;
$date_fin_ical	      	= ajout_jour_date ($date_debut_ical,730,'JMA','-','eng') ;

// initialisation 
unset($tableau_reservation); // réinitialisation des variables tableau *** 

// infos des réservations déjà existante ******

//************************************************************************
// fonctionnement avec base de données
//************************************************************************
if ( AVEC_BDD ) {
	
    //connection a la base de donnees*******************************************************************
    $connect = @mysql_connect(Decrypte(hote_cal,'calendrier'), Decrypte(user_cal,'calendrier'), Decrypte(password_cal,'calendrier'));
    if (!$connect )
       echo '<font style="font-size:16px" color="#FF0000" face="Arial"><b>** Erreur de connexion au serveur sql **</b></font>' ;
    else {
    // on choisit la bonne base
    $connect_base = @mysql_select_db(Decrypte(base_cal,'calendrier'), $connect) ;
    if (!$connect_base )
       echo '<font style="font-size:16px" color="#FF0000" face="Arial"><b>** Erreur de connexion à la base sql **</b></font>' ;
    else {
   //recherche des jours reservés mis au format sans base de données
   $valeur_select = "SELECT * FROM ".Decrypte(nom_table_cal,'calendrier')." WHERE date_reservation >= '$date_debut_ical' and id_logement = '$vecteur_index_logement' order by date_reservation, id_locataire ";
   $requete = @mysql_query ($valeur_select); // echo $valeur_select;
   while ( $data = mysql_fetch_object($requete) )  {
			$tableau_reservation[$data->id_logement][$data->date_reservation] = $data->couleur.'%&%'.$data->couleur_texte.'%&%'.$data->id_locataire.'%&%'.$data->tarif.'%&%'.guillet_var ($data->commentaires);

          }  //afficher_tableau($tableau_reservation);
	  //if ( !isset($connection_sql_active) || !$connection_sql_active) 	  
		//	@mysql_close();
      }
   }
} // fin de recupération avec base de données ***************************

//************************************************************************
// fonctionnement avec base de données
//************************************************************************

elseif ( !AVEC_BDD ) {
   if ( isset ($vecteur_index_logement) ) {
   //recupération des dates pour le logement en cours de traitement *********
   $chemin_fichier_logement = $chemin_admin_temp."fichier_calendrier/dates_sans_bdd/".$vecteur_index_logement."_calendrier.php";
   if ( file_exists($chemin_fichier_logement)) {
        include($chemin_fichier_logement);
   }
   }
}

//afficher_tableau($nom_logement);
// traitement des réservations par locations  

if ( isset($tableau_reservation,$vecteur_index_logement,$date_couleur_disponible) && is_array($tableau_reservation) ) {
	
	$locataire_mem	= '';
	$couleur_mem	= '';
	$date_mem		= '';
	$tableau_ical	= array();
	$index_tab		= 0;
	$file1			= '';
	$file2			= '';
   
   
	foreach ( $tableau_reservation[$vecteur_index_logement] as $date_temp => $val_temp1 ) {
		
		$lendemain	= ajout_jour_date ($date_temp,1,'JMA','-','eng');
		list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) 	= 	explode('%&%',$val_temp1);
		list($annee_explode,$mois_explode,$jour_explode)   											= 	explode('-',$date_temp);
		list($annee_explode_2,$mois_explode_2,$jour_explode_2)   									= 	explode('-',$lendemain);
		
		// creation d'un tableau avec fusion des réservations par locataire ou par couleur
		if ( !$date_couleur_disponible[$couleur_texte_temp] && comparaison_date ($date_debut_ical,$date_temp,'superieur','-','eng') ) { // si couleur indisponible et si la date est supérieure à la date de début
			
			if ( $locataire_mem <> $tri_locataire_temp || $couleur_mem <> $couleur_texte_temp || $date_temp <> $date_mem ) {
				$index_tab++;
				$tableau_ical[$index_tab]['date_debut'] 	= dateToCal(mktime('15', '00', '00', $mois_explode, $jour_explode, $annee_explode));
				$tableau_ical[$index_tab]['date_debut2'] 	= dateToCal2(mktime('15', '00', '00', $mois_explode, $jour_explode, $annee_explode));
				}
			$tableau_ical[$index_tab]['date_fin'] 		= dateToCal(mktime('11', '00', '00', $mois_explode_2, $jour_explode_2, $annee_explode_2));
			$tableau_ical[$index_tab]['date_fin2'] 		= dateToCal2(mktime('11', '00', '00', $mois_explode_2, $jour_explode_2, $annee_explode_2));
			$locataire_mem	= $tri_locataire_temp;
			$couleur_mem	= $couleur_texte_temp;
			$date_mem		= $lendemain;
			}
				
		}
	
	// creation des données ical
	if (isset($tableau_ical) && is_array($tableau_ical)) {
		foreach ( $tableau_ical as $index_temp => $temp ) {
		
			// format ical version 1
			$file1	.='BEGIN:VEVENT';
			$file1	.="\n";
			$file1	.='UID:'.uniqid() ;
			$file1	.="\n";
			$file1	.='DTSTART:'.$tableau_ical[$index_temp]['date_debut'] ;
			$file1	.="\n";
			$file1	.='DTEND:'.$tableau_ical[$index_temp]['date_fin'] ;
			$file1	.="\n";
			$file1	.='DTSTAMP:'.dateToCal(time()) ;
			$file1	.="\n";
			$file1	.='SUMMARY:' ;
			$file1	.="\n";
			$file1	.='END:VEVENT';
			$file1	.="\n";
			
			// format ical version 2
			$file2	.='BEGIN:VEVENT';
			$file2	.="\n";
			$file2	.='UID:'.uniqid() ;
			$file2	.="\n";
			$file2	.='DTEND;VALUE=DATE:'.$tableau_ical[$index_temp]['date_fin2'] ;
			$file2	.="\n";
			$file2	.='DTSTART;VALUE=DATE:'.$tableau_ical[$index_temp]['date_debut2'] ;
			$file2	.="\n";
			$file2	.='SUMMARY:' ;
			$file2	.="\n";
			$file2	.='END:VEVENT';
			$file2	.="\n";

		
		}
	
	}

		
	$file_header	 = '';

	$file_header	.= 'BEGIN:VCALENDAR';
	$file_header	.="\n";
	$file_header	.='VERSION:2.0';
	$file_header	.="\n";
	$file_header	.='PRODID:-//hacksw/handcal//NONSGML v1.0//EN';
	$file_header	.="\n";
	$file_header	.='CALSCALE:GREGORIAN';
	$file_header	.="\n"; 
	
	$file_footer	 = '';
	$file_footer	.='END:VCALENDAR';
	$file_footer	.="\n";
	
	//creation fichier version 1
	$chemin_fichier = $chemin_admin_temp."fichier_calendrier/ical/".$vecteur_index_logement.".ics"; 
	$file_f  = @fopen($chemin_fichier, "w");
	@fputs($file_f, $file_header.$file1.$file_footer );
	$creation_reussi = @fclose($file_f);
	
	//creation fichier version 2
	$chemin_fichier = $chemin_admin_temp."fichier_calendrier/ical/".$vecteur_index_logement.".ical";
	$file_f  = @fopen($chemin_fichier, "w");
	@fputs($file_f, $file_header.$file2.$file_footer );
	$creation_reussi = @fclose($file_f);
	
	}  // fin de cette location
	
  
	
	
if ( isset($creation_reussi) && !$creation_reussi )
      $affiche_info = "erreur_execution"; 


?>