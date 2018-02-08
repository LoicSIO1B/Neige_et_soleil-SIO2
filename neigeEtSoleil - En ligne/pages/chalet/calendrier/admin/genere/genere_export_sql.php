<?php

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_genere.php");

//***************************************************************************************************
// création fichier sauvegarde sql ******************************************************************
//***************************************************************************************************

$chemin_fichier = "fichier_calendrier/sauvegarde_sql.sql";
$memoire_annee  = '';
$memoire_logement = '';
$tableau_requetes = '';
$premiere_ligne_active = false;

$file= @fopen($chemin_fichier, "w");

$entete = '--*requete***

CREATE TABLE IF NOT EXISTS `'.Decrypte(nom_table_cal,$Cle).'` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_reservation` date NOT NULL,
  `couleur` text NOT NULL,
  `couleur_texte` text NOT NULL,
  `id_logement` int(11) NOT NULL,
  `id_locataire` bigint(20) NOT NULL,
  `tarif` tinytext NOT NULL,
  `commentaires` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
';


  @fputs($file, $entete);
  @fputs($file, "\n");
  @fputs($file, "\n");
  
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
   $valeur_select = "SELECT * FROM ".Decrypte(nom_table_cal,$Cle)." order by id_logement, date_reservation ";
   $requete = @mysql_query ($valeur_select);

   while ( $data = mysql_fetch_object($requete) ) {

      list($annee_en_cours,$mois_en_cours,$jour_en_cours) = explode('-',$data->date_reservation);

      if ( $premiere_ligne_active ) {
      if ( $memoire_logement <> $data->id_logement || $memoire_annee <> $annee_en_cours)  {
          @fputs($file, ";");
          @fputs($file, "\n");
          }
      else {// meme année ou meme logement *********
         @fputs($file, ",");
         @fputs($file, "\n");
         }
      }

      $premiere_ligne_active = true;

      // test si nouveau logement ********************
      if ( $memoire_logement <> $data->id_logement || $memoire_annee <> $annee_en_cours)  {
            @fputs($file, "--*requete***");
            @fputs($file, "\n");
            @fputs($file, 'INSERT INTO `'.Decrypte(nom_table_cal,$Cle).'` (`id`, `date_reservation`, `couleur`, `couleur_texte`, `id_logement`, `id_locataire`, `tarif`, `commentaires`) VALUES  ');
            @fputs($file, "\n");
            }

      //insertion des dates **************************
      @fputs($file, '('.$data->id.', \''.$data->date_reservation.'\', \''.$data->couleur.'\', \''.$data->couleur_texte.'\', '.$data->id_logement.', '.$data->id_locataire.', \''.$data->tarif.'\', \''.addslashes($data->commentaires).'\')');


      $memoire_logement = $data->id_logement ;
      $memoire_annee    = $annee_en_cours ;

      } // fin traitement requetes
      
      if ( $premiere_ligne_active ) {
          @fputs($file, ";");
          @fputs($file, "\n");
          }
     }
   }


//fermeture du fichier
$creation_reussi = @fclose($file);
 

?>