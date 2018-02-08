<?php
// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
if (!defined('AUTOR_FCT_GEN_LOCATAIRE') )
     require("secure_genere.php");

//***************************************************************************************************
// création fichier des locataires ******************************************************************
//***************************************************************************************************


//***************************************************************************************************
// suppression d'un locataire  **********************************************************************
// (seconde partie en fin de fichier ) **************************************************************
//***************************************************************************************************

if ( isset($fonction) && $fonction == 'supprimer'  && !MODE_DEMO ) {

  //recherche du numéro d'index le plus élevé************
  $nb_result = count ($nom_locataire);  
  if ( $nb_result > 0 ) {
      unset($nom_locataire[$num_supprime]);
      unset($prenom_locataire[$num_supprime]);
      unset($telephone_locataire[$num_supprime]);
      unset($email_locataire[$num_supprime]);
      unset($adresse_locataire[$num_supprime]);
      unset($code_locataire[$num_supprime]);
      unset($commune_locataire[$num_supprime]);
      unset($pays_locataire[$num_supprime]);
      unset($mailing_list_ok[$num_supprime]);
  }

} // fin suppresion d'un locataire ******************************************************************


//***************************************************************************************************
// ajout d'un locataire par administrateur **********************************************************
//***************************************************************************************************

if ( isset($fonction) && $fonction == 'Ajouter' && !MODE_DEMO) {

  $nom_locataire[0]= 'Tous' ;
  $prenom_locataire[0]= '' ;
  $nom_locataire[0] = '' ;
  $prenom_locataire[0] = '' ;
  $telephone_locataire[0] = '' ;
  $email_locataire[0] = '' ;
  $adresse_locataire[0] = '' ;
  $code_locataire[0] = '' ;
  $commune_locataire[0] = '' ;
  $pays_locataire[0] = '' ;
  $mailing_list_ok[0] = false;

  $nom_locataire[] = guillet_var (ucfirst($nom)) ;
  $prenom_locataire[] = guillet_var (ucfirst($prenom)) ;
  $telephone_locataire[] = guillet_var ($telephone) ;
  $email_locataire[] = guillet_var ($email) ;
  $adresse_locataire[] = guillet_var ($adresse) ;
  $code_locataire[] = guillet_var ($code) ;
  $commune_locataire[] = guillet_var ($commune) ;
  $pays_locataire[] = guillet_var ($pays) ;
  if ( isset($mailing_list) &&  $mailing_list  == 'oui' )
      $mailing_list_ok[] = true;
  else
      $mailing_list_ok[] = false;

}

//***************************************************************************************************
// ajout d'un locataire par formulaire **************************************************************
//***************************************************************************************************

if ( isset($fonction) && $fonction == 'Ajout_formulaire' && !MODE_DEMO) {

      $num_pointeur_max =  $derniere_cle_tableau_locataire + 1;
      while ( array_key_exists($num_pointeur_max,$nom_locataire ) ) {
          $num_pointeur_max++;
      }
      // creation des informations du locataire *********************************
      $nom_locataire[$num_pointeur_max] = guillet_var (ucfirst($tableau_locataire[0])) ;
      $prenom_locataire[$num_pointeur_max] = guillet_var (ucfirst($tableau_locataire[1])) ;
      $telephone_locataire[$num_pointeur_max] = guillet_var ($tableau_locataire[2]) ;
      $email_locataire[$num_pointeur_max] = guillet_var ($tableau_locataire[3]) ;
      $adresse_locataire[$num_pointeur_max] = guillet_var ($tableau_locataire[4]) ;
      $code_locataire[$num_pointeur_max] = guillet_var ($tableau_locataire[5]) ;
      $commune_locataire[$num_pointeur_max] = guillet_var ($tableau_locataire[6]) ;
      $pays_locataire[$num_pointeur_max] = guillet_var ($tableau_locataire[7]) ;
	  $commentaire_locataire[$num_pointeur_max] = guillet_var ($tableau_locataire[8]);
      $mailing_list_ok[$num_pointeur_max] = $tableau_locataire[9];
}

//***************************************************************************************************
// modification d'un locataire  *********************************************************************
//***************************************************************************************************

if ( isset($fonction) && $fonction == 'Modifier' && !MODE_DEMO) {

  $nom_locataire[$cle_modif] = guillet_var ($nom) ;
  $prenom_locataire[$cle_modif] = guillet_var ($prenom) ; 
  $telephone_locataire[$cle_modif] = guillet_var ($telephone) ; 
  $email_locataire[$cle_modif] = guillet_var ($email) ; 
  $adresse_locataire[$cle_modif] = guillet_var ($adresse) ;
  $code_locataire[$cle_modif] = guillet_var ($code) ;
  $commune_locataire[$cle_modif] = guillet_var ($commune) ; 
  $pays_locataire[$cle_modif] = guillet_var ($pays) ;
  if ( isset($mailing_list) &&  $mailing_list  == "oui" )
      $mailing_list_ok[$cle_modif] = true;
  else
      $mailing_list_ok[$cle_modif] = false;
      
}

$entete = '//***************************************************************************************************
// fichier contenant la liste des logements et des locataires
//***************************************************************************************************
// la variable $fin_tableau_locataire = true;  doit toujours être placé en fin de fichier
//***************************************************************************************************';

  @fputs($file, "<?php");
  @fputs($file, "\n");

  @fputs($file, ''.$entete.' ' );
  @fputs($file, "\n");

// inscription des locataires********************************************************
 @fputs($file, '$nom_locataire[0]= "Tous" ;' );
 @fputs($file, "\n");
 @fputs($file, '$prenom_locataire[0]= "" ;' );
 @fputs($file, "\n");
 @fputs($file, "\n");

 if (isset($nom_locataire)) {
 $nb_result = count ($nom_locataire);
 if ( $nb_result > 0 ) {
 foreach ($nom_locataire as $cle => $val_locataire )  {
   if ( $cle <> 0 ) {
       @fputs($file, '$nom_locataire['.$cle.']= "'.guillet_var ($val_locataire).'" ;' );
       @fputs($file, "\n");
       @fputs($file, '$prenom_locataire['.$cle.']= "'.guillet_var ($prenom_locataire[$cle]).'" ;' );
       @fputs($file, "\n");
       @fputs($file, '$telephone_locataire['.$cle.']= "'.guillet_var ($telephone_locataire[$cle]).'" ;' );
       @fputs($file, "\n");
       @fputs($file, '$email_locataire['.$cle.']= "'.guillet_var ($email_locataire[$cle]).'" ;' );
       @fputs($file, "\n");
       @fputs($file, '$adresse_locataire['.$cle.']= "'.guillet_var ($adresse_locataire[$cle]).'" ;' );
       @fputs($file, "\n");
       @fputs($file, '$code_locataire['.$cle.']= "'.guillet_var ($code_locataire[$cle]).'" ;' );
       @fputs($file, "\n");
       @fputs($file, '$commune_locataire['.$cle.']= "'.guillet_var ($commune_locataire[$cle]).'" ;' );
       @fputs($file, "\n");
       @fputs($file, '$pays_locataire['.$cle.']= "'.guillet_var ($pays_locataire[$cle]).'" ;' );
       @fputs($file, "\n");
       if ( $mailing_list_ok[$cle] )
           @fputs($file, '$mailing_list_ok['.$cle.'] = true ;' );
       else
           @fputs($file, '$mailing_list_ok['.$cle.'] = false ;' );
       @fputs($file, "\n");
       @fputs($file, "\n");

      }
     }
   }
 }
  @fputs($file, '$derniere_cle_tableau_locataire = "'.$cle.'";');
  @fputs($file, "\n");
  @fputs($file, '$fin_tableau_locataire = true;');
  @fputs($file, "\n");
  @fputs($file, "\n");

  @fputs($file, "?>");

//fermeture du fichier
$creation_reussi = @fclose($file);
 
//***************************************************************************************************
// suppression des dates du locataire  **************************************************************
//***************************************************************************************************

if ( isset($fonction) && $fonction == 'supprimer'  && !MODE_DEMO ) {
  
   if ( AVEC_BDD) {
  //connection a la base de donnees*******************************************************************
  include("connexion.php");
  $connect = @mysql_connect(Decrypte(hote_cal,$Cle), Decrypte(user_cal,$Cle), Decrypte(password_cal,$Cle));
  $connect_base = @mysql_select_db(Decrypte(base_cal,$Cle), $connect) ;

  $valeur_select = "delete from ".Decrypte(nom_table_cal,$Cle)." where id_locataire= '$num_supprime' ";

  $etat_req = @mysql_query($valeur_select);
  }

  //fonctionnement sans base de données **************************************************************
  else {
    require("supprime_date_locataire.php");
  }

  if ( $locataire_defaut_cal_admin == $num_supprime ) {
  $locataire_defaut_cal_admin = 0;
  $chemin_fichier = '' ;
  include("genere/genere_para_calendrier.php");
  }

  $_SESSION['sel_tri_locataire'] = '' ;
  
  //***************************************************************************************************
  // suppression commentaire du locataire  **************************************************************
  //***************************************************************************************************

  $chemin_fichier = "fichier_calendrier/calendrier_commentaire_locataire.php";
  $chemin_fichier_sauvegarde = "fichier_calendrier/sauvegarde_calendrier_commentaire_locataire.php";

  while (!isset($fin_tableau_commentaire_locataire) || !$fin_tableau_commentaire_locataire) {
  include ($chemin_fichier);
  if ( isset($fin_tableau_commentaire_locataire) && $fin_tableau_commentaire_locataire) {
     //sauvegarde ancien fichier*********************************
     @copy($chemin_fichier,$chemin_fichier_sauvegarde);
     $file= @fopen($chemin_fichier, "w");
     $fichier_libre = true;
     $fonction = 'supprimer';
     }
  }

   if ( $fichier_libre )
    //chemin vers le fichier de création liste des locataires/logements**********************************************************
    require("genere/genere_commentaire_locataire.php");
}
    

?>