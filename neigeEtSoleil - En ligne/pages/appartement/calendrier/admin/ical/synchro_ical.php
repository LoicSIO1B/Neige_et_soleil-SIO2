<?php
//**************************************************************************************************
//
//				Fonction automatisation synchronisation
//
//
//**************************************************************************************************

//**************************************************************************************************
// fonction de synchronisation de calendrier pour 1 ou plusieurs ressources
// $id_logement : numéro id de la location a synchroniser , si = 0 synchronise toutes les locations
// $chemin_admin: chemin SERVEUR depuis la racine du site jusqu'au répertoire admin sans slash de fin
//      ce chemin est disponible en bas de la page "codes" de l'espace admin
// La fonction retourne TRUE si la synchro a réussie
//**************************************************************************************************

//  ###################### Paramètres à éditer #####################################

	$chemin_admin 		= ''; 		// chemin SERVEUR depuis la racine du site jusqu'au répertoire admin sans slash de fin, ce chemin est disponible en bas de la page "codes" de l'espace admin
	$id_logement		= 0;		// $id_logement : numéro id de la location a synchroniser , si = 0 synchronise toutes les locations ## ATTENTION ## dans ce cas il faut toutes les locations aient une url ical valide !!!
	$notifier_succes	= false ;	// si = true, un email est envoi si la synchronisation réussié, mettre = flase pour ne pas envoyer d'email
	$notifier_echec		= false ;	// si = true, un email est envoi si la synchronisation a échousée, mettre = flase pour ne pas envoyer d'email
	$destinataire_email	= ''; 		// adresse email de destinataire pour les notifications email si elles sont activées
	$emetteur_email		= ''; 		// adresse email emetteur, idéalement elle doit être différente du destinataire est être liée au nom de domaine utilisé

	//  ###################### ne plus rien modifier après cette ligne #####################################
	
	require ($chemin_admin."/admin/fonction.php");
	$etat 			= synchronisation_ical($chemin_admin,$id_logement);

	message_info ($affiche_info);  // permet de récupérer les id d'état de la fonction synchronisation_ical
//**************************************************************************************************
// envoi un email
// parametres :
	$_POST['emetteur']      	= $emetteur_email;
	$_POST['destinataire']  	= $destinataire_email ;
	$_POST['titre']   	   		= 'Rapport de synchronisation calendrier ical';
	$_POST['message']   	   	= "Rapport de synchronisation des calendriers :<br>";
	if ( isset($tableau_affiche_info['id']) )
		$_POST['message']      .= "l'état de la synchro est  : ".$tableau_affiche_info['id']." ";
	if ( isset($tableau_affiche_info['texte']) )
		$_POST['message']      .= $tableau_affiche_info['texte'];
	$_POST['message']   	   .= "<br>Ceci est un message automatique veuillez ne pas répondre";
	$_POST['nom_emetteur']  	= $destinataire_email ;
	$tableau_champs_ignorer 	= '';
	$url_redirect_ok		   	= '';
	$url_redirect_erreur    	= '';
//**************************************************************************************************   
   
   if ( ($notifier_succes && $etat) || ($notifier_echec && !$etat) )    
	$etat_email	= envoi_email ();


?>
