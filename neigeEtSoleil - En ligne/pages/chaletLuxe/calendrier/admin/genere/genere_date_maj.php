<?php

// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_genere.php");

//***************************************************************************************************
// création fichier date mise a jour ******************************************************************
//***************************************************************************************************

$chemin_fichier = "fichier_calendrier/calendrier_date_mise_a_jour.php";

$date_maj_calendrier = '';

$file= @fopen($chemin_fichier, "w");

  @fputs($file, "<?php");
  @fputs($file, "\n");

  $mois_maj =  (int)date("m") ;
  $jour_maj =  date("d") ;
  $annee_maj =  date("Y") ;
  
  $date_maj_calendrier["fr"] = $jour_maj." ".$mois_fr[$mois_maj]." ".$annee_maj ;
  $date_maj_calendrier["all"] = $jour_maj." ".$mois_all[$mois_maj]." ".$annee_maj ;
  $date_maj_calendrier["eng"] = $jour_maj." ".$mois_eng[$mois_maj]." ".$annee_maj ;
  $date_maj_calendrier["it"] = $jour_maj." ".$mois_it[$mois_maj]." ".$annee_maj ;
  $date_maj_calendrier["esp"] = $jour_maj." ".$mois_esp[$mois_maj]." ".$annee_maj ;

       @fputs($file, '$date_maj_calendrier["fr"]= "'.$date_maj_calendrier["fr"].'" ;' );
       @fputs($file, "\n");
       @fputs($file, '$date_maj_calendrier["all"]= "'.$date_maj_calendrier["all"].'" ;' );
       @fputs($file, "\n");
       @fputs($file, '$date_maj_calendrier["eng"]= "'.$date_maj_calendrier["eng"].'" ;' );
       @fputs($file, "\n");
       @fputs($file, '$date_maj_calendrier["it"]= "'.$date_maj_calendrier["it"].'" ;' );
       @fputs($file, "\n");
       @fputs($file, '$date_maj_calendrier["esp"]= "'.$date_maj_calendrier["esp"].'" ;' );
       @fputs($file, "\n");
       @fputs($file, "\n");


  @fputs($file, "\n");

  @fputs($file, "?>");

//fermeture du fichier
$creation_reussi = @fclose($file);
 

?>