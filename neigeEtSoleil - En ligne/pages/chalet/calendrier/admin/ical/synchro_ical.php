<?php
//**************************************************************************************************
//
//				Fonction automatisation synchronisation
//
//
//**************************************************************************************************

//**************************************************************************************************
// fonction de synchronisation de calendrier pour 1 ou plusieurs ressources
// $id_logement : num�ro id de la location a synchroniser , si = 0 synchronise toutes les locations
// $chemin_admin: chemin SERVEUR depuis la racine du site jusqu'au r�pertoire admin sans slash de fin
//      ce chemin est disponible en bas de la page "codes" de l'espace admin
// La fonction retourne TRUE si la synchro a r�ussie
//**************************************************************************************************

//  ###################### Param�tres � �diter #####################################

	$chemin_admin 		= ''; 		// chemin SERVEUR depuis la racine du site jusqu'au r�pertoire admin sans slash de fin, ce chemin est disponible en bas de la page "codes" de l'espace admin
	$id_logement		= 0;		// $id_logement : num�ro id de la location a synchroniser , si = 0 synchronise toutes les locations ## ATTENTION ## dans ce cas il faut toutes les locations aient une url ical valide !!!
	$notifier_succes	= false ;	// si = true, un email est envoi si la synchronisation r�ussi�, mettre = flase pour ne pas envoyer d'email
	$notifier_echec		= false ;	// si = true, un email est envoi si la synchronisation a �chous�e, mettre = flase pour ne pas envoyer d'email
	$destinataire_email	= ''; 		// adresse email de destinataire pour les notifications email si elles sont activ�es
	$emetteur_email		= ''; 		// adresse email emetteur, id�alement elle doit �tre diff�rente du destinataire est �tre li�e au nom de domaine utilis�

	//  ###################### ne plus rien modifier apr�s cette ligne #####################################
	
	require ($chemin_admin."/admin/fonction.php");
	$etat 			= synchronisation_ical($chemin_admin,$id_logement);

	message_info ($affiche_info);  // permet de r�cup�rer les id d'�tat de la fonction synchronisation_ical
//**************************************************************************************************
// envoi un email
// parametres :
	$_POST['emetteur']      	= $emetteur_email;
	$_POST['destinataire']  	= $destinataire_email ;
	$_POST['titre']   	   		= 'Rapport de synchronisation calendrier ical';
	$_POST['message']   	   	= "Rapport de synchronisation des calendriers :<br>";
	if ( isset($tableau_affiche_info['id']) )
		$_POST['message']      .= "l'�tat de la synchro est  : ".$tableau_affiche_info['id']." ";
	if ( isset($tableau_affiche_info['texte']) )
		$_POST['message']      .= $tableau_affiche_info['texte'];
	$_POST['message']   	   .= "<br>Ceci est un message automatique veuillez ne pas r�pondre";
	$_POST['nom_emetteur']  	= $destinataire_email ;
	$tableau_champs_ignorer 	= '';
	$url_redirect_ok		   	= '';
	$url_redirect_erreur    	= '';
//**************************************************************************************************   
   
   if ( ($notifier_succes && $etat) || ($notifier_echec && !$etat) )    
	$etat_email	= envoi_email ();


?>
