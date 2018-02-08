<?php

// recupération des identifiants **********************************************
   require_once("genere/connexion.php");
   require_once("fonction.php");
   $mot_de_passe_decrypt = Decrypte(mot_de_passe,$Cle);

// controle si sessions avec indentifiants existe ***************************************************

 if ( ( !isset($_SESSION['id_connexion']) || !isset($_SESSION['mdp']) || $_SESSION['id_connexion'] <> identifiant || $_SESSION['mdp'] <> $mot_de_passe_decrypt )  && ( !defined('MODE_SECURE') || MODE_SECURE )  ) {
    header('Location: identification.php');
    exit;
 }
?>