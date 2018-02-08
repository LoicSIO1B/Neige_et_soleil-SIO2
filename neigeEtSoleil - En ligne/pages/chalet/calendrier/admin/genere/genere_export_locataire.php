<?php
// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************

if ( isset($chemin_admin) )
	$chemin_admin	= $chemin_admin."/admin/";
else
	$chemin_admin	= "";

     require($chemin_admin."secure_genere.php");

     require($chemin_admin."fichier_calendrier/liste_pays.php");

if ( isset($commentaire) && $commentaire == 'oui' )
     require($chemin_admin."fichier_calendrier/calendrier_commentaire_locataire.php");

//***************************************************************************************************
// création fichier des locataires ******************************************************************
//***************************************************************************************************

$chemin_fichier = "fichier_calendrier/calendrier_export_locataire.csv";

$file = @fopen($chemin_fichier, "w");

      if ( isset($nom) && $nom == 'oui' ) {
         @fputs($file, 'Nom'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($prenom) && $prenom == 'oui' ) {
         @fputs($file, 'Prénom'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($telephone) && $telephone == 'oui' ) {
         @fputs($file, 'Téléphone'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($email) && $email == 'oui' ) {
         @fputs($file, 'Email'.$separateur);
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($adresse) && $adresse == 'oui' ) {
         @fputs($file, 'Adresse'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($code_postal) && $code_postal == 'oui' ) {
         @fputs($file, 'Code postal'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($commune) && $commune == 'oui' ) {
         @fputs($file, 'Commune'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($pays) && $pays == 'oui' ) {
         @fputs($file, 'Pays'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($mailing) && $mailing == 'oui' ) {
         @fputs($file, 'Inscription liste email'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($commentaire) && $commentaire == 'oui' ) {
         @fputs($file, 'Commentaire'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }

       @fputs($file, "\n");

 $nb_result = count ($nom_locataire);
 if ( $nb_result > 0 ) {
 foreach ($nom_locataire as $cle => $val_locataire )  {
   if ( $cle <> 0 ) {
      if ( isset($nom) && $nom == 'oui' ) {
         @fputs($file, $val_locataire.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($prenom) && $prenom == 'oui' ) {
         @fputs($file, $prenom_locataire[$cle].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($telephone) && $telephone == 'oui' ) {
         @fputs($file, $telephone_locataire[$cle].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($email) && $email == 'oui' ) {
         @fputs($file, $email_locataire[$cle].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($adresse) && $adresse == 'oui' ) {
         @fputs($file, $adresse_locataire[$cle].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($code_postal) && $code_postal == 'oui' ) {
         @fputs($file, $code_locataire[$cle].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($commune) && $commune == 'oui' ) {
         @fputs($file, $commune_locataire[$cle].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($pays) && $pays == 'oui' ) {
         $pays_temp = $pays_locataire[$cle];
         @fputs($file, $tableau_pays[$pays_temp].$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($mailing) && $mailing == 'oui' ) {
        if ( $mailing_list_ok[$cle])
         @fputs($file, 'oui'.$separateur  );
        else
         @fputs($file, 'non'.$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }
      if ( isset($commentaire) && $commentaire == 'oui'  && isset($commentaire_locataire[$cle]) ) {
         @fputs($file, suppr_char_spec($commentaire_locataire[$cle]).$separateur  );
       if ( isset($tabulation) && $tabulation == 'oui' )
         @fputs($file, "\t");
      }

       @fputs($file, "\n");

      }
   }
 }


 @fputs($file, "\n");


//fermeture du fichier
$creation_reussi = @fclose($file);

if ( $creation_reussi )
    telecharge ("calendrier_export_locataire.csv","fichier_calendrier/");
else
   $affiche_info = "erreur_execution";      
 


?>