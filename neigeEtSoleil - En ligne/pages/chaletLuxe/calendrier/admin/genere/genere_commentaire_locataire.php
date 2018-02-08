<?php
// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
if (!defined('AUTOR_FCT_GEN_LOCATAIRE') )
     require("secure_genere.php");

//***************************************************************************************************
// création fichier des locataires ******************************************************************
//***************************************************************************************************


//***************************************************************************************************
// suppression commentaire d'un locataire  **********************************************************
//***************************************************************************************************

if ( isset($fonction) && $fonction == 'supprimer'  && !MODE_DEMO ) {

  //recherche du numéro d'index le plus élevé************
  if ( isset($commentaire_locataire[$num_supprime]))
       unset($commentaire_locataire[$num_supprime]);

} // fin suppresion d'un locataire ******************************************************************

//***************************************************************************************************
// modification d'un commentaire*********************************************************************
//***************************************************************************************************

if ( isset($fonction) && $fonction == 'Modifier' && !MODE_DEMO) {

       $commentaire_locataire[$val_id] = guillet_var ($commentaire);

}

$entete = '//***************************************************************************************************
// fichier contenant la liste des commentaires locataires
//***************************************************************************************************
// la variable $fin_tableau_commentaire_locataire = true;  doit toujours être placé en fin de fichier
//***************************************************************************************************';

  @fputs($file, "<?php");
  @fputs($file, "\n");

  @fputs($file, ''.$entete.' ' );
  @fputs($file, "\n");

 if (isset($commentaire_locataire)) {
 $nb_result = count ($commentaire_locataire);
 if ( $nb_result > 0 ) {
 foreach ($commentaire_locataire as $cle => $val_commentaire )  {
       @fputs($file, '$commentaire_locataire['.$cle.']= "'.guillet_var ($val_commentaire).'" ;' );
       @fputs($file, "\n");
       @fputs($file, "\n");

     }
   }
 }
  @fputs($file, '$derniere_cle_tableau_commentaire = "'.$cle.'";');
  @fputs($file, "\n");
  @fputs($file, '$fin_tableau_commentaire_locataire = true;');
  @fputs($file, "\n");
  @fputs($file, "\n");

  @fputs($file, "?>");

//fermeture du fichier
$creation_reussi = @fclose($file);
 

?>