<?php
header ("content-type: text/xml");

echo '<?xml version="1.0" encoding="iso-8859-1"?>';

include("fichier_calendrier/calendrier_liste_locataire.php");

$liste_des_elements = '';

if ( isset($_GET['type']) && ($_GET['type'] )=='nom' )  {

   $nb_result = count ($nom_locataire);
   if ( $nb_result > 0 ) {

     foreach ($nom_locataire as $cle => $val_locataire )  {
     if ( $cle <> 0  && $val_locataire <> '')
	$liste_des_elements .= "<element>".str_replace("&","",$val_locataire)."</element>";
      }

   }
}


if ( isset($_GET['type']) && ($_GET['type'] )=='prenom' )  {
   $liste_des_elements = '';
   $nb_result = count ($prenom_locataire);
   if ( $nb_result > 0 ) {

     foreach ($prenom_locataire as $cle => $val_locataire )  {
     if ( $cle <> 0 && $val_locataire <> '')
	$liste_des_elements .= "<element>".str_replace("&","",$val_locataire)."</element>";
      }

   }
}


if ( isset($_GET['type']) && ($_GET['type'] )=='tous' )  {
   $liste_des_elements = '';
   
   $nb_result = count ($nom_locataire);
   if ( $nb_result > 0 ) {

     foreach ($nom_locataire as $cle => $val_locataire )  {
     if ( $cle <> 0 && $val_locataire <> '')
	$liste_des_elements .= "<element>".str_replace("&","",$val_locataire)."</element>";
      }

   }

   $nb_result = count ($prenom_locataire);
   if ( $nb_result > 0 ) {

     foreach ($prenom_locataire as $cle => $val_locataire )  {
     if ( $cle <> 0 && $val_locataire <> '')
	$liste_des_elements .= "<element>".str_replace("&","",$val_locataire)."</element>";
      }

   }

   $nb_result = count ($email_locataire);
   if ( $nb_result > 0 ) {

     foreach ($email_locataire as $cle => $val_email )  {
     if ( $cle <> 0 && $val_email <> '')
	$liste_des_elements .= "<element>".str_replace("&","",$val_email)."</element>";
      }

   }
   
   $nb_result = count ($commune_locataire);
   if ( $nb_result > 0 ) {

     foreach ($commune_locataire as $cle => $val_commune )  {
     if ( $cle <> 0 && $val_commune <> '')
	$liste_des_elements .= "<element>".str_replace("&","",$val_commune)."</element>";
      }

   }

   include ("fichier_calendrier/liste_pays.php");
   $nb_result = count ($tableau_pays);
   if ( $nb_result > 0 ) {

     foreach ($tableau_pays as $cle => $val_locataire )  {
     if (  $val_locataire <> '')
	$liste_des_elements .= "<element>".str_replace("&","",$val_locataire)."</element>";
      }

   }

}

echo " <root>".
       $liste_des_elements ;

    echo  "</root>";
?>