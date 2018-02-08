<?php
// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
    if (!defined("INSTALLATION"))
        require($chemin_repertoire."secure_genere.php");

$chemin_fichier = $chemin_repertoire."fichier_calendrier/parametres_calendrier.php";
$chemin_fichier_sauvegarde = $chemin_repertoire."fichier_calendrier/sauvegarde_parametres_calendrier.php";

//sauvegarde ancien fichier*********************************
@copy($chemin_fichier,$chemin_fichier_sauvegarde);

$entete = "//***************************************************************************************************
// fichier contenant la liste des paramètres du calendrier
//***************************************************************************************************
";

$file= @fopen($chemin_fichier, "w");

  @fputs($file, "<?php");
  @fputs($file, "\n");

  @fputs($file, ''.$entete.' ' );
  @fputs($file, "\n");
// inscription des paramètres********************************************************

//************************************************
// zone texte ************************************
//************************************************

  @fputs($file, '$taille_police_mois  = "'.$taille_police_mois.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_police_mois = "'.$couleur_police_mois.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$taille_police_nom_jour = "'.$taille_police_nom_jour.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_police_nom_jour = "'.$couleur_police_nom_jour.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$taille_police_jour = "'.$taille_police_jour.'" ;' );
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

  @fputs($file, '$nombre_mois_afficher = "'.$nombre_mois_afficher.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$nombre_mois_afficher_ligne = "'.$nombre_mois_afficher_ligne.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$nombre_mois_afficher_admin = "'.$nombre_mois_afficher_admin.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$nombre_mois_afficher_ligne_admin = "'.$nombre_mois_afficher_ligne_admin.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$bordure_du_tableau = "'.$bordure_du_tableau.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_bordure_tableau = "'.$couleur_bordure_tableau.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$hauteur_mini_cellule_date = "'.$hauteur_mini_cellule_date.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$largeur_mini_cellule_date = "'.$largeur_mini_cellule_date.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$largeur_tableau = "'.$largeur_tableau.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$locataire_defaut_cal_admin = "'.$locataire_defaut_cal_admin.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$logement_defaut_cal_admin = "'.$logement_defaut_cal_admin.'" ;' );
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
  @fputs($file, '$bordure_ligne_fin_semaine = "'.$bordure_ligne_fin_semaine.'" ;' );
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
  @fputs($file, '$url_image_fond_mois = "'.$url_image_fond_mois.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$alignement_horizontal_image_fond = "'.$alignement_horizontal_image_fond.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$alignement_vertical_image_fond = "'.$alignement_vertical_image_fond.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_libre = "'.$couleur_libre.'" ;' );
  @fputs($file, "\n");
  if ( isset($avec_marquage_du_jour_d_aujourd_hui) && $avec_marquage_du_jour_d_aujourd_hui == "on" )
      @fputs($file, '$avec_marquage_du_jour_d_aujourd_hui = true ;' );
  else
      @fputs($file, '$avec_marquage_du_jour_d_aujourd_hui = false ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_jour_aujourd_hui = "'.$couleur_jour_aujourd_hui.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$url_image_fond_cellule = "'.$url_image_fond_cellule.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$url_image_fond_cellule_week_end = "'.$url_image_fond_cellule_week_end.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$url_image_fond_cellule_nom_jour = "'.$url_image_fond_cellule_nom_jour.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$url_image_fond_cellule_numero_semaine = "'.$url_image_fond_cellule_numero_semaine.'" ;' );
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
  @fputs($file, '$url_image_fond_cellule_aujourd_hui = "'.$url_image_fond_cellule_aujourd_hui.'" ;' );
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

  if ( isset($selection_mois_visteur) &&  $selection_mois_visteur == "on" )
      @fputs($file, '$selection_mois_visteur = true ;' );
  else
      @fputs($file, '$selection_mois_visteur = false ;' );
  @fputs($file, "\n");
  if ( isset($selection_an_visteur) &&  $selection_an_visteur == "on" )
      @fputs($file, '$selection_an_visteur = true ;' );
  else
      @fputs($file, '$selection_an_visteur = false ;' );
  @fputs($file, "\n");
  if ( isset($avec_selection_couleur_visteur) &&  $avec_selection_couleur_visteur == "on" )
      @fputs($file, '$avec_selection_couleur_visteur = true ;' );
  else
      @fputs($file, '$avec_selection_couleur_visteur = false ;' );
  @fputs($file, "\n");
  if ( isset($avec_selection_logement_visteur) &&  $avec_selection_logement_visteur == "on" )
      @fputs($file, '$avec_selection_logement_visteur = true ;' );
  else
      @fputs($file, '$avec_selection_logement_visteur = false ;' );
  @fputs($file, "\n");
  if ( isset($avec_selection_locataire_visteur) &&  $avec_selection_locataire_visteur == "on" )
      @fputs($file, '$avec_selection_locataire_visteur = true ;' );
  else
      @fputs($file, '$avec_selection_locataire_visteur = false ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_fond_page_visiteur  = "'.$couleur_fond_page_visiteur.'" ;' );
  @fputs($file, "\n");
  if ( isset($avec_transparence_calendrier) &&  $avec_transparence_calendrier == "on" )
      @fputs($file, '$avec_transparence_calendrier = true ;' );
  else
      @fputs($file, '$avec_transparence_calendrier = false ;' );
  @fputs($file, "\n");
  if ( isset($avec_diagonale_cellule) &&  $avec_diagonale_cellule == "on" )
      @fputs($file, '$avec_diagonale_cellule = true ;' );
  else
      @fputs($file, '$avec_diagonale_cellule = false ;' );
  @fputs($file, "\n");
  if ( isset($avec_infobulle_visiteur) &&  $avec_infobulle_visiteur == "on" )
      @fputs($file, '$avec_infobulle_visiteur = true ;' );
  else
      @fputs($file, '$avec_infobulle_visiteur = false ;' );
  @fputs($file, "\n");
  if ( isset($avec_lien_autre_page_visiteur) &&  $avec_lien_autre_page_visiteur == "on" )
      @fputs($file, '$avec_lien_autre_page_visiteur = true ;' );
  else
      @fputs($file, '$avec_lien_autre_page_visiteur = false ;' );
  @fputs($file, "\n");
  @fputs($file, '$lien_autre_page_visiteur = "'.guillet_var ($lien_autre_page_visiteur).'"  ;' );
  @fputs($file, "\n");
  if ( isset($format_date_fr) &&  $format_date_fr == "on" )
      @fputs($file, '$format_date_fr = true ;' );
  else
      @fputs($file, '$format_date_fr = false ;' );
  @fputs($file, "\n");
  if ( isset($jour_barre_calendrier_visiteur) &&  $jour_barre_calendrier_visiteur == "on" )
      @fputs($file, '$jour_barre_calendrier_visiteur = true ;' );
  else
      @fputs($file, '$jour_barre_calendrier_visiteur = false ;' );
  @fputs($file, "\n");
  if ( isset($avec_date_mise_jour_calendrier) &&  $avec_date_mise_jour_calendrier == "on" )
      @fputs($file, '$avec_date_mise_jour_calendrier = true ;' );
  else
      @fputs($file, '$avec_date_mise_jour_calendrier = false ;' );
  @fputs($file, "\n");
  @fputs($file, '$espace_entre_cellule = "'.$espace_entre_cellule.'"  ;' );
  @fputs($file, "\n");
  @fputs($file, '$espace_entre_les_mois = "'.$espace_entre_les_mois.'"  ;' );
  @fputs($file, "\n");
  if ( isset($avec_affichage_infobulle_complete) &&  $avec_affichage_infobulle_complete == "on" )
      @fputs($file, '$avec_affichage_infobulle_complete = true ;' );
  else
      @fputs($file, '$avec_affichage_infobulle_complete = false ;' );
  @fputs($file, "\n");
  if ( isset($avec_locataire_infobulle_visiteur) &&  $avec_locataire_infobulle_visiteur == "on" )
      @fputs($file, '$avec_locataire_infobulle_visiteur = true ;' );
  else
      @fputs($file, '$avec_locataire_infobulle_visiteur = false ;' );
  @fputs($file, "\n"); 
  if ( isset($avec_couleur_infobulle_visiteur) &&  $avec_couleur_infobulle_visiteur == "on" )
      @fputs($file, '$avec_couleur_infobulle_visiteur = true ;' );
  else
      @fputs($file, '$avec_couleur_infobulle_visiteur = false ;' );
  @fputs($file, "\n");
  if ( isset($avec_logement_infobulle_visiteur) &&  $avec_logement_infobulle_visiteur == "on" )
      @fputs($file, '$avec_logement_infobulle_visiteur = true ;' );
  else
      @fputs($file, '$avec_logement_infobulle_visiteur = false ;' );
  @fputs($file, "\n");
  if ( isset($avec_tarif_infobulle_visiteur) &&  $avec_tarif_infobulle_visiteur == "on" )
      @fputs($file, '$avec_tarif_infobulle_visiteur = true ;' );
  else
      @fputs($file, '$avec_tarif_infobulle_visiteur = false ;' );
  @fputs($file, "\n");
  @fputs($file, "\n");

//************************************************
// calendrier tous *******************************
//************************************************

  @fputs($file, '$texte_jour_debut_calendrier_tous = "'.$texte_jour_debut_calendrier_tous.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$nombre_semaine_calendrier_tous = "'.$nombre_semaine_calendrier_tous.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$offset_depart_calendrier_tous = "'.$offset_depart_calendrier_tous.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$nombre_jour_avance_recul_calendrier_tous = "'.$nombre_jour_avance_recul_calendrier_tous.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$couleur_separateur_calendrier_tous = "'.$couleur_separateur_calendrier_tous.'" ;' );
  @fputs($file, "\n");
  @fputs($file, "\n");

//************************************************
// calendrier 1 mois *****************************
//************************************************

  @fputs($file, '$hysteresis_plus = "'.$hysteresis_plus.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$hysteresis_moins = "'.$hysteresis_moins.'" ;' );
  @fputs($file, "\n");
  @fputs($file, "\n");

//************************************************
// date picker ***********************************
//************************************************

  if ( isset($jour_barre_date_picker) &&  $jour_barre_date_picker == "on" )
      @fputs($file, '$jour_barre_date_picker = true ;' );
  else
      @fputs($file, '$jour_barre_date_picker = false ;' );
  @fputs($file, "\n");
  @fputs($file, "\n");

//************************************************
// général ***************************************
//************************************************

  @fputs($file, '$item1 = "'.$item1.'" ;' );
  @fputs($file, "\n");
  @fputs($file, '$repertoire_installation = "'.$repertoire_installation.'" ;' );
  @fputs($file, "\n");
  @fputs($file, "\n");

//************************************************
// modele calendrier *****************************
//************************************************

  @fputs($file, '$choix_modele = "'.$choix_modele.'" ;' );
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
  @fputs($file, '$fin_tableau_parametres = true;');
  @fputs($file, "\n");
  @fputs($file, "\n");

  @fputs($file, "?>");

//fermeture du fichier
$creation_reussi = @fclose($file);

    if (!defined("INSTALLATION"))
       include ($chemin_repertoire."genere/genere_style.php");
?>