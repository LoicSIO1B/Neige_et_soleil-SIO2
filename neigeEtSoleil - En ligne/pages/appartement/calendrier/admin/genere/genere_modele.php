<?php
// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_genere.php");

// création du répertoire modele***************************************************

$chemin_repertoire = "template_cal/".$nom_enregistrement_modele;
@mkdir($chemin_repertoire, 0777);
$chemin_fichier = "template_cal/".$nom_enregistrement_modele."/template.php";

$entete = "//***************************************************************************************************
// fichier contenant la liste des paramètres d'un modele
//***************************************************************************************************";

$file= @fopen($chemin_fichier, "w");

  @fputs($file, "<?php");
  @fputs($file, "\n");

  @fputs($file, ''.$entete.' ' );
  @fputs($file, "\n");
// inscription des paramètres********************************************************

//************************************************
// zone texte ************************************
//************************************************

  @fputs($file, '$taille_police_mois  = '.$taille_police_mois.' ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_police_mois = "'.$couleur_police_mois.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$taille_police_nom_jour = '.$taille_police_nom_jour.' ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_police_nom_jour = "'.$couleur_police_nom_jour.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$taille_police_jour = '.$taille_police_jour.' ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_police_jour = "'.$couleur_police_jour.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_police_numero_semaine = "'.$couleur_police_numero_semaine.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$police = "'.$police.'" ;' );
  @fputs($file, "\n");
  @fputs($file, "\n");

//************************************************
// zone format calendrier ************************
//************************************************

  @fputs($file, '$bordure_du_tableau = '.$bordure_du_tableau.' ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_bordure_tableau = "'.$couleur_bordure_tableau.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$hauteur_mini_cellule_date = '.$hauteur_mini_cellule_date.' ;' );
  @fputs($file, "\n");
  @fputs($file, '$largeur_tableau = '.$largeur_tableau.' ;' );
  @fputs($file, "\n");
  if ( isset($avec_affichage_numero_semaine) &&  $avec_affichage_numero_semaine == "on" )
      @fputs($file, '$avec_affichage_numero_semaine = true ;' );
  else
      @fputs($file, '$avec_affichage_numero_semaine = false ;' );
  @fputs($file, "\n");
  @fputs($file, "\n");

//************************************************
// couleur cellules ******************************
//************************************************

  @fputs($file, '$couleur_nom_numero_semaine = "'.$couleur_nom_numero_semaine.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_numero_semaine = "'.$couleur_numero_semaine.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_jour_semaine = "'.$couleur_jour_semaine.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_nom_jour_week_end = "'.$couleur_nom_jour_week_end.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_jour_week_end = "'.$couleur_jour_week_end.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$bordure_ligne_fin_semaine = '.$bordure_ligne_fin_semaine.' ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_ligne_fin_semaine = "'.$couleur_ligne_fin_semaine.'" ;' );
  @fputs($file, "\n");
  if ( isset($avec_continuite_couleur) &&  $avec_continuite_couleur == "on" )
      @fputs($file, '$avec_continuite_couleur = true ;' );
  else
      @fputs($file, '$avec_continuite_couleur = false ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_fond_mois = "'.$couleur_fond_mois.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$url_image_fond_mois = "'.image_modele ($url_image_fond_mois,$repertoire_installation,$chemin_repertoire).'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$alignement_horizontal_image_fond = "'.$alignement_horizontal_image_fond.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$alignement_vertical_image_fond = "'.$alignement_vertical_image_fond.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_libre = "'.$couleur_libre.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_jour_aujourd_hui = "'.$couleur_jour_aujourd_hui.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$url_image_fond_cellule = "'.image_modele ($url_image_fond_cellule,$repertoire_installation,$chemin_repertoire).'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$url_image_fond_cellule_week_end = "'.image_modele ($url_image_fond_cellule_week_end,$repertoire_installation,$chemin_repertoire).'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$url_image_fond_cellule_nom_jour = "'.image_modele ($url_image_fond_cellule_nom_jour,$repertoire_installation,$chemin_repertoire).'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$url_image_fond_cellule_numero_semaine = "'.image_modele ($url_image_fond_cellule_numero_semaine,$repertoire_installation,$chemin_repertoire).'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_bordure_cellule_non_vide = "'.$couleur_bordure_cellule_non_vide.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$largeur_bordure_superieur = "'.$largeur_bordure_superieur.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$largeur_bordure_inferieur = "'.$largeur_bordure_inferieur.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$largeur_bordure_gauche = "'.$largeur_bordure_gauche.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$largeur_bordure_droite = "'.$largeur_bordure_droite.'" ;' );
  @fputs($file, "\n");
  if ( isset($avec_bordure_cellule_num_jour) && $avec_bordure_cellule_num_jour == "on" )
      @fputs($file, '$avec_bordure_cellule_num_jour = true ;' );
  else
      @fputs($file, '$avec_bordure_cellule_num_jour = false ;' );
  @fputs($file, "\n");
  if ( isset($avec_bordure_cellule_texte_jour) && $avec_bordure_cellule_texte_jour == "on" )
      @fputs($file, '$avec_bordure_cellule_texte_jour = true ;' );
  else
      @fputs($file, '$avec_bordure_cellule_texte_jour = false ;' );
  @fputs($file, "\n");
  if ( isset($avec_bordure_cellule_numero_semaine) && $avec_bordure_cellule_numero_semaine == "on" )
      @fputs($file, '$avec_bordure_cellule_numero_semaine = true ;' );
  else
      @fputs($file, '$avec_bordure_cellule_numero_semaine = false ;' );
  @fputs($file, "\n");
  if ( isset($avec_bordure_cellule_nom_mois) && $avec_bordure_cellule_nom_mois == "on" )
      @fputs($file, '$avec_bordure_cellule_nom_mois = true ;' );
  else
      @fputs($file, '$avec_bordure_cellule_nom_mois = false ;' );
  @fputs($file, "\n");
  if ( isset($avec_bordure_cellules_vides) && $avec_bordure_cellules_vides == "on" )
      @fputs($file, '$avec_bordure_cellules_vides = true ;' );
  else
      @fputs($file, '$avec_bordure_cellules_vides = false ;' );
  @fputs($file, "\n");
  @fputs($file, '$url_image_fond_cellule_aujourd_hui = "'.image_modele ($url_image_fond_cellule_aujourd_hui,$repertoire_installation,$chemin_repertoire).'" ;' );
  @fputs($file, "\n");
  @fputs($file, "\n");
  
//************************************************
// selecteur mois année **************************
//************************************************

  @fputs($file, '$largeur_sel_mois_annee = "'.$largeur_sel_mois_annee.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$taille_police_sel_mois_annee = "'.$taille_police_sel_mois_annee.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_sel_mois_annee = "'.$couleur_sel_mois_annee.'" ;' );
  @fputs($file, "\n");
  @fputs($file, "\n");

//************************************************
// module calendrier *****************************
//************************************************

  @fputs($file, '$couleur_fond_page_visiteur  = "'.$couleur_fond_page_visiteur.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$espace_entre_cellule = '.$espace_entre_cellule.'  ;' );
  @fputs($file, "\n");
  @fputs($file, '$espace_entre_les_mois = '.$espace_entre_les_mois.'  ;' );
  @fputs($file, "\n");
  @fputs($file, "\n");

//************************************************
// calendrier tous *******************************
//************************************************

  @fputs($file, '$texte_jour_debut_calendrier_tous = "'.$texte_jour_debut_calendrier_tous.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$nombre_semaine_calendrier_tous = '.$nombre_semaine_calendrier_tous.' ;' );
  @fputs($file, "\n");
  @fputs($file, '$offset_depart_calendrier_tous = '.$offset_depart_calendrier_tous.' ;' );
  @fputs($file, "\n");
  @fputs($file, '$nombre_jour_avance_recul_calendrier_tous = '.$nombre_jour_avance_recul_calendrier_tous.' ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_separateur_calendrier_tous = "'.$couleur_separateur_calendrier_tous.'" ;' );
  @fputs($file, "\n");
  @fputs($file, "\n");

//************************************************
// calendrier 1 mois *****************************
//************************************************

  @fputs($file, "\n");

//************************************************
// date picker ***********************************
//************************************************

  @fputs($file, "\n");

//************************************************
// général ***************************************
//************************************************

  @fputs($file, "\n");

//************************************************
// modele calendrier *****************************
//************************************************

  @fputs($file, '$choix_modele = "'.$nom_enregistrement_modele.'" ;' );
  @fputs($file, "\n");
  @fputs($file, "\n");

//************************************************
// constantes ************************************
//************************************************

  @fputs($file, '$espace_dans_cellule = 1 ;' );
  @fputs($file, "\n");
  @fputs($file, '$decalage_ligne = "0" ;' );
  @fputs($file, "\n");
  @fputs($file, '$avec_selection_champs_date_visteur = false ;' );
  @fputs($file, "\n");

  @fputs($file, "\n");

  @fputs($file, "\n");

  @fputs($file, "?>");

//fermeture du fichier
$creation_reussi = @fclose($file);
 
?>