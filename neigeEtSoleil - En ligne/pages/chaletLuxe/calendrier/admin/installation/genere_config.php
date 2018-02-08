<?php
unset($tableau_erreur);

$texte_tableau_erreur[1] = "Chmod 777 fichier admin/genere/connexion.php impossible";
$texte_tableau_erreur[2] = "Ouverture fichier admin/genere/connexion.php impossible";
$texte_tableau_erreur[3] = "Ecriture dans le fichier admin/genere/connexion.php impossible";
$texte_tableau_erreur[4] = "Fermeture du fichier admin/genere/connexion.php impossible";
$texte_tableau_erreur[5] = 'Chmod 777 des fichiers listes dans répertoire fichier_calendrier impossible, (<a href="http://www.mathieuweb.fr/calendrier/faq.php" target="_blank" class ="style3" >faire un chmod avec filezilla</a>)';
$texte_tableau_erreur[6] = 'Chmod répertoire 777 "template" impossible, (<a href="http://www.mathieuweb.fr/calendrier/faq.php" target="_blank"  class ="style3">faire un chmod avec filezilla</a>)';
$texte_tableau_erreur[7] = 'Chmod répertoire 777 "fichier_calendrier" impossible, (<a href="http://www.mathieuweb.fr/calendrier/faq.php" target="_blank" class ="style3" >faire un chmod avec filezilla</a>)';
$texte_tableau_erreur[8] = 'Chmod répertoire 777 "img_cal" impossible, (<a href="http://www.mathieuweb.fr/calendrier/faq.php" target="_blank"  class ="style3">faire un chmod avec filezilla</a>)';
$texte_tableau_erreur[9] = "Connexion au serveur sql impossible";
$texte_tableau_erreur[10] = "Connexion à la base de données impossible";
$texte_tableau_erreur[11] = "Création de la table de données impossible";
$texte_tableau_erreur[12] = "Création parametres_calendrier.php impossible";
$texte_tableau_erreur[13] = "Chmod 777 répertoire 'dates_sans_bdd' impossible";
$texte_tableau_erreur[14] = 'Chmod 777 fichier calendrier_commentaire_locataire, (<a href="http://www.mathieuweb.fr/calendrier/faq.php" target="_blank"  class ="style3">faire un chmod avec filezilla</a>)';

//***********************************************************************************
// creation fichier connexion.php 
//***********************************************************************************

$chemin_fichier = "../genere/connexion.php";

$tableau_erreur[1] =  ( @chmod ($chemin_fichier,0777) || substr(sprintf('%o', fileperms($chemin_fichier)), -4) == '0777' ) ;

$entete = "//***************************************************************************************************
// Identifiants de connection à la base de données
//*************************************************************************************************** ";

$file= @fopen($chemin_fichier, "w");

 @fputs($file, "<?php");
 @fputs($file, "\n");

 @fputs($file, ''.$entete.' ' );
 @fputs($file, "\n");

if ($_SESSION['format_donnees'] == 'avec')  {

 @fputs($file, '@define ("hote_cal", \''.apos_var (Crypte(stripslashes($_SESSION['hote_cal']),$Cle)).'\') ;' );
 @fputs($file, "\n");
 @fputs($file, '@define ("user_cal", \''.apos_var (Crypte(stripslashes($_SESSION['user_cal']),$Cle)).'\' );' );
 @fputs($file, "\n");
 @fputs($file, '@define ("password_cal", \''.apos_var (Crypte(stripslashes($_SESSION['password_cal']),$Cle)).'\') ;' );
 @fputs($file, "\n");
 @fputs($file, '@define ("base_cal", \''.apos_var (Crypte(stripslashes($_SESSION['base_cal']),$Cle)).'\') ;' );
 @fputs($file, "\n");
 @fputs($file, '@define ("nom_table_cal", \''.apos_var (Crypte(stripslashes($_SESSION['nom_table_cal']),$Cle)).'\' );' );
 @fputs($file, "\n");
 @fputs($file, "\n");
}

 @fputs($file, '@define ("identifiant", \''.apos_var (stripslashes($_SESSION['identifiant'])).'\') ;' );
 @fputs($file, "\n");
 @fputs($file, '@define ("mot_de_passe" , \''.apos_var (Crypte(stripslashes($_SESSION['mot_de_passe']),$Cle)).'\') ;' );
 @fputs($file, "\n");
 @fputs($file, "\n");
 @fputs($file, "\n");
 @fputs($file, '@define ("MODE_DEMO", false) ; ' );
 @fputs($file, "\n");
 if ( $_SESSION['format_donnees'] == 'avec' )
  @fputs($file, '@define ("AVEC_BDD", true) ;' );
 else
  @fputs($file, '@define ("AVEC_BDD", false) ; ' );
 @fputs($file, "\n");
 if ( $_SESSION['securise'] )
  @fputs($file, '@define ("MODE_SECURE", true);' );
 else
  @fputs($file, '@define ("MODE_SECURE", false); ' );
 @fputs($file, "\n");
 @fputs($file, '@define ("TOUJOURS_FALSE", false); ' );
 @fputs($file, "\n");
 @fputs($file, "\n");
 @fputs($file, '$numero_transaction = \''.apos_var (stripslashes($_SESSION['numero_transaction'])).'\' ;' );
 @fputs($file, "\n");
 @fputs($file, '$email_transaction = \''.apos_var (stripslashes($_SESSION['email'])).'\' ;' );
 @fputs($file, "\n");
 @fputs($file, '$avec_compression_page = false ;' );
 @fputs($file, "\n");

  @fputs($file, "\n");

  @fputs($file, "?>");

//fermeture du fichier
$tableau_erreur[4] = @fclose($file);
@chmod ($chemin_fichier,0644);

//***********************************************************************************
// creation fichier connexion.php 
//***********************************************************************************

if ($_SESSION['format_donnees'] == 'avec')  {

  $tableau_erreur[9] = @mysql_connect(stripslashes($_SESSION['hote_cal']), stripslashes($_SESSION['user_cal']), stripslashes($_SESSION['password_cal'])) ;

  // on choisit la bonne base
  $tableau_erreur[10] = @mysql_select_db(stripslashes($_SESSION['base_cal']), $tableau_erreur[9]) ;

  $query = "CREATE TABLE IF NOT EXISTS `".stripslashes($_SESSION['nom_table_cal'])."` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_reservation` date NOT NULL,
  `couleur` text NOT NULL,
  `couleur_texte` text NOT NULL,
  `id_logement` int(11) NOT NULL,
  `id_locataire` bigint(20) NOT NULL,
  `tarif` tinytext NOT NULL,
  `commentaires` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

 $tableau_erreur[11] = @mysql_query($query)  ;

// on ferme la base
@mysql_close();
}

//*********************************************************************************************
// chmod des fichiers *********************************************************************************
//*********************************************************************************************

if ( file_exists("fichier_calendrier/calendrier_liste_couleur.php"))  @chmod ("fichier_calendrier/calendrier_liste_couleur.php",0777);
if ( file_exists("fichier_calendrier/calendrier_liste_locataire.php"))  @chmod ("fichier_calendrier/calendrier_liste_locataire.php",0777);
if ( file_exists("fichier_calendrier/calendrier_commentaire_locataire.php"))  @chmod ("fichier_calendrier/calendrier_commentaire_locataire.php",0777);
if ( file_exists("fichier_calendrier/calendrier_liste_logement.php"))  @chmod ("fichier_calendrier/calendrier_liste_logement.php",0777);
if ( file_exists("fichier_calendrier/parametres_calendrier.php"))  @chmod ("fichier_calendrier/parametres_calendrier.php",0777);
if ( file_exists("fichier_calendrier/langue.php"))  @chmod ("fichier_calendrier/langue.php",0777);
if ( file_exists("fichier_calendrier/calendrier_liste_langue.php"))  @chmod ("fichier_calendrier/calendrier_liste_langue.php",0777);
if ( file_exists("fichier_calendrier/sauvegarde_calendrier_liste_langue.php"))  @chmod ("fichier_calendrier/sauvegarde_calendrier_liste_langue.php",0777);
if ( file_exists("fichier_calendrier/sauvegarde_calendrier_liste_couleur.php"))  @chmod ("fichier_calendrier/sauvegarde_calendrier_liste_couleur.php",0777);
if ( file_exists("fichier_calendrier/sauvegarde_calendrier_liste_locataire.php"))  @chmod ("fichier_calendrier/sauvegarde_calendrier_liste_locataire.php",0777);
if ( file_exists("fichier_calendrier/sauvegarde_calendrier_commentaire_locataire.php"))  @chmod ("fichier_calendrier/sauvegarde_calendrier_commentaire_locataire.php",0777);
if ( file_exists("fichier_calendrier/sauvegarde_calendrier_liste_logement.php"))  @chmod ("fichier_calendrier/sauvegarde_calendrier_liste_logement.php",0777);
if ( file_exists("fichier_calendrier/sauvegarde_calendrier_liste_logement_locataire.php"))  @chmod ("fichier_calendrier/sauvegarde_calendrier_liste_logement_locataire.php",0777);
if ( file_exists("fichier_calendrier/sauvegarde_liste_logement_locataire.php"))  @chmod ("fichier_calendrier/sauvegarde_liste_logement_locataire.php",0777);
if ( file_exists("fichier_calendrier/sauvegarde_parametres_calendrier.php"))  @chmod ("fichier_calendrier/sauvegarde_parametres_calendrier.php",0777);
if ( file_exists("fichier_calendrier/calendrier_date_mise_a_jour.php"))  @chmod ("fichier_calendrier/calendrier_date_mise_a_jour.php",0777);
if ( file_exists("fichier_calendrier/style.css"))  @chmod ("fichier_calendrier/style.css",0777);
if ( file_exists("fichier_calendrier/sauvegarde_style.css"))  @chmod ("fichier_calendrier/sauvegarde_style.css",0777);
if ( file_exists("fichier_calendrier/calendrier_selection_utilisateur.php"))  @chmod ("fichier_calendrier/calendrier_selection_utilisateur.php",0777);
if ( file_exists("fichier_calendrier/colle.html"))  @chmod ("fichier_calendrier/colle.html",0777);
if ( file_exists("fichier_calendrier/calendrier_selection_utilisateur.php"))  @chmod ("fichier_calendrier/calendrier_selection_utilisateur.php",0777);
if ( file_exists("fichier_calendrier/calendrier_export_stat.csv"))  @chmod ("fichier_calendrier/calendrier_export_stat.csv",0777);
if ( file_exists("fichier_calendrier/calendrier_export_locataire.csv"))  @chmod ("fichier_calendrier/calendrier_export_locataire.csv",0777);
if ( file_exists("fichier_calendrier/colle_memo.html"))  @chmod ("fichier_calendrier/colle_memo.html",0777);
if ( file_exists("fichier_calendrier/sauvegarde.zip"))  @chmod ("fichier_calendrier/sauvegarde.zip",0777);
if ( file_exists("fichier_calendrier/sauvegarde_sql.sql"))  @chmod ("fichier_calendrier/sauvegarde_sql.sql",0777);

//********************************************************************************************
//chmod répertoire template pour sauvegarde des templates
//********************************************************************************************

$chemin_fichier = "../template_cal/";
$tableau_erreur[6] = ( @chmod ($chemin_fichier,0777) || substr(sprintf('%o', fileperms($chemin_fichier)), -4) == '0777' ) ;

$chemin_fichier = "../fichier_calendrier/";
$tableau_erreur[7] = ( @chmod ($chemin_fichier,0777) || substr(sprintf('%o', fileperms($chemin_fichier)), -4) == '0777' ) ;

$chemin_fichier = "../img_cal/";
$tableau_erreur[8] = ( @chmod ($chemin_fichier,0777) || substr(sprintf('%o', fileperms($chemin_fichier)), -4) == '0777' ) ;

$chemin_fichier = "../fichier_calendrier/dates_sans_bdd/";
$tableau_erreur[13] = ( @chmod ($chemin_fichier,0777) || substr(sprintf('%o', fileperms($chemin_fichier)), -4) == '0777' ) ;

$chemin_fichier = "../fichier_calendrier/ical/";
$tableau_erreur[13] = ( @chmod ($chemin_fichier,0777) || substr(sprintf('%o', fileperms($chemin_fichier)), -4) == '0777' ) ;

//***********************************************************************************
// creation fichier parametres_calendrier.php
//***********************************************************************************

  include("../fichier_calendrier/parametres_calendrier.php");
  $repertoire_installation = $_SESSION['cfg_repertoire_installation'];
  $item1 = guillet_var (stripslashes($_SESSION['cfg_item1']));
  $chemin_repertoire = "../";
  @define ("INSTALLATION", true) ;
  include($chemin_repertoire."genere/genere_para_calendrier.php");

?>