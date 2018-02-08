<?php

// version du programme ***********************
$version 		= "V4.21" ;
$version_php	= phpversion(); 

//**********************************************************
// fonction test si format date francaise est ok
// date_fr : date au format francais JJ/MM/AAAA
//**********************************************************

function test_date_fr ($date_fr) {
   $erreur_format_date = 1 ;
// test si il y a 2 barres de slash
  $nb_slash = substr_count($date_fr, '/');
  if ( $nb_slash == 2) {
    $date_explosee = explode("/", $date_fr);
    $jour_fr = $date_explosee[0];
    $mois_fr = $date_explosee[1];
    $an_fr = $date_explosee[2];
    if ( is_numeric($jour_fr) && is_numeric($mois_fr) && is_numeric($an_fr) ) {
      if ( $jour_fr > 0 && $jour_fr < 32 && $mois_fr > 0 && $mois_fr < 13 && $an_fr > 2000 && $an_fr < 2030 ) {
        $erreur_format_date = 0 ;
      }
    }
  }
  return ($erreur_format_date);
}
//**********************************************************


function html_ent ($texte) {
   
  return (stripslashes(htmlentities($texte,ENT_COMPAT,'ISO-8859-1')));
}
//**********************************************************

//**********************************************************
// fonction test si format date francaise est ok
// date_eng : date au format anglais AAAA/MM/JJ
//**********************************************************

function test_date_eng ($date_eng) {
   $erreur_format_date = 1 ;
// test si il y a 2 tirets
  $nb_tiret = substr_count($date_eng, '-');
  if ( $nb_tiret == 2) {
    $date_explosee = explode("-", $date_eng);
    $jour_eng = $date_explosee[2];
    $mois_eng = $date_explosee[1];
    $an_eng = $date_explosee[0];
    if ( is_numeric($jour_eng) && is_numeric($mois_eng) && is_numeric($an_eng) ) {
      if ( $jour_eng > 0 && $jour_eng < 32 && $mois_eng > 0 && $mois_eng < 13 && $an_eng > 2000 && $an_eng < 2030 ) {
        $erreur_format_date = 0 ;
      }
    }
  }
  return ($erreur_format_date);
}
//**********************************************************

//**********************************************************************
// conversion format de date francais vers anglais
// $date_fr           : date au format francais JJ MM AAAA
// $separateur_source      : texte séparateur de champs de la date francaise
// $separateur_destination : texte séparateur de champs date de sortie
//**********************************************************************

function date_fr_eng ($date_fr,$separateur_source,$separateur_destination) {
  list($jour_fr,$mois_fr,$an_fr) = explode($separateur_source, $date_fr);
  $date_eng = $an_fr.$separateur_destination.$mois_fr.$separateur_destination.$jour_fr;
  return ($date_eng);
  }
//**********************************************************************

//**********************************************************************
// conversion format de date anglais vers francais
// $date_eng           : date au format francais AAAA MM JJ
// $separateur_source      : texte séparateur de champs de la date francaise
// $separateur_destination : texte séparateur de champs date de sortie
//**********************************************************************

function date_eng_fr ($date_eng,$separateur_source,$separateur_destination) {
  list($an_eng,$mois_eng,$jour_eng) = explode($separateur_source, $date_eng);
  $date_fr = $jour_eng.$separateur_destination.$mois_eng.$separateur_destination.$an_eng;
  return ($date_fr);
  }
//**********************************************************************

// fonction pour afficher les valeur d'un tableau sur l'écran
function afficher_tableau($tableau)     {
    // traitement du tableau
    foreach ($tableau as $cle=>$valeur)    {
        // si tableau alors appel récursif
        if(is_array($valeur))   {
            echo '['.$cle.'] : <ul>'; 
            afficher_tableau($valeur); 
            echo '</ul>'; 
            }
        
        // sinon affiche valeur
        else
            {
            echo '['.$cle.'] = '.$valeur.' <br>';  
            }
        } 
    }  

//**********************************************************************
// retourne le jour precedent de la date d'entrée au meme format
// $date       : date par rapport a laquelle le jour precedent sera calulée
// $separateur      : texte séparateur de champs de la date
// $langue          : format de la langue eng ou fr
//**********************************************************************

function jour_precedent ($date,$separateur,$langue) {
  if ( $langue == "eng") {
  list($an,$mois,$jour) = explode($separateur, $date);

  $jour = $jour - 1;
  if ( $jour <= 0) {
      $mois = $mois - 1;
      if ( $mois <= 0 ) {
           $mois = 12;
           $an = $an - 1;
           }
      $jour = strftime("%d",mktime ( 6,0,0,$mois+1 ,0,$an)) ;
  }
  $date_jour_precedent  = $an.$separateur.$mois.$separateur.$jour;
  }
  else {
  list($jour,$mois,$an) = explode($separateur, $date);

  $jour = $jour - 1;

  if ( $jour <= 0) {
      $mois = $mois - 1 ;
      if ( $mois <= 0 ) {
           $mois = 12;
           $an = $an - 1;
           }
      $jour = strftime("%d",mktime ( 6,0,0,$mois+1,0,$an)) ;
  }
  $date_jour_precedent  = $jour.$separateur.$mois.$separateur.$an;
  }

  return ($date_jour_precedent);
  }
//**********************************************************************

//**********************************************************************
//fonction pour récupérer le nom de domaine
//**********************************************************************

function nom_domaine($url) {
	
	$url 		= str_replace('www.','',$url);
	$domaine 	= parse_url($url);
	if(!empty($domaine["host"]))
		{
		 return $domaine["host"];
		 } else
		 {
		 return $domaine["path"];
		 }
}
//**********************************************************************

//**********************************************************************
//fonction ajout de \ devant les guillemets pour eciture dans fichier
//**********************************************************************

function guillet_var ($texte) {
  $texte_guillemet = str_replace('\\','',$texte);
  $texte_guillemet = str_replace('"','\"',$texte_guillemet) ;
  return ($texte_guillemet);
  }
//**********************************************************************

//**********************************************************************
//fonction ajout de \ devant les apostrophes pour eciture dans fichier
//**********************************************************************

function apos_var ($texte) {
  $texte_guillemet = str_replace('\\','',$texte);
  $texte_guillemet = str_replace("'","\'",$texte_guillemet) ;
  return ($texte_guillemet);
  }
//**********************************************************************

//**********************************************************************
// En fonction du jour de debut de semaine paramétré, retourne l'index
// du numéro de jour de la semaine pour le premier jour du mois
//**********************************************************************

function jour_debut_semaine ($jour,$mois ,$annee) {
  $premier_jour_mois = date("w",mktime ( 6,0,0,$mois ,1,$annee)) ;
  switch ($jour) {
    case "lundi":
    if ( $premier_jour_mois == 0)
       $premier_jour_mois = 7;
    break;
    case "mardi":
     $premier_jour_mois = $premier_jour_mois + 6;
     if ( $premier_jour_mois > 7)
     $premier_jour_mois = $premier_jour_mois - 7;
    break;
    case "mercredi":
     $premier_jour_mois = $premier_jour_mois + 5;
     if ( $premier_jour_mois > 7)
     $premier_jour_mois = $premier_jour_mois - 7 ;
    break;
    case "jeudi":
     $premier_jour_mois = $premier_jour_mois + 4;
     if ( $premier_jour_mois > 7)
     $premier_jour_mois = $premier_jour_mois - 7 ;
    break;
    case "vendredi":
     $premier_jour_mois = $premier_jour_mois + 3;
     if ( $premier_jour_mois > 7)
     $premier_jour_mois = $premier_jour_mois - 7 ;
    break;
    case "samedi":
     $premier_jour_mois = $premier_jour_mois + 2;
     if ( $premier_jour_mois > 7)
     $premier_jour_mois = $premier_jour_mois - 7 ;
    break;
    case "dimanche":
     $premier_jour_mois  = $premier_jour_mois + 1;
     if ( $premier_jour_mois > 7)
     $premier_jour_mois = $premier_jour_mois - 7 ;
    break;
    }
  return ($premier_jour_mois);
  }
//**********************************************************************

//**********************************************************************
// retourne le nouvel index de numero jour de semaine en fonction
// du paramétrage du jour de debut de semaine voulu
//**********************************************************************

function correction_debut_semaine ($jour,$cle) {
  global $index_jour_lundi;
  global $index_jour_samedi;
  global $index_jour_dimanche;
  $nouvelle_cle = $cle ;
  switch ($jour) {
    case "lundi":
      $nouvelle_cle = $cle ;
    break;
    case "mardi":
      if ( $cle < 8)
      $nouvelle_cle = $cle + 1;
      if ( $nouvelle_cle >= 7)
         $nouvelle_cle = $nouvelle_cle - 7;
      if ( $cle > 7)
      $nouvelle_cle = $cle ;
    break;
    case "mercredi":
      if ( $cle < 8)
      $nouvelle_cle = $cle + 2;
      if ( $nouvelle_cle >= 7)
         $nouvelle_cle = $nouvelle_cle - 7;
      if ( $cle > 7)
      $nouvelle_cle = $cle ;
    break;
    case "jeudi":
      if ( $cle < 8)
      $nouvelle_cle = $cle + 3;
      if ( $nouvelle_cle >= 7)
         $nouvelle_cle = $nouvelle_cle - 7;
      if ( $cle > 7)
      $nouvelle_cle = $cle ;
    break;
    case "vendredi":
      if ( $cle < 8)
      $nouvelle_cle = $cle + 4;
      if ( $nouvelle_cle >= 7)
         $nouvelle_cle = $nouvelle_cle - 7;
      if ( $cle > 7)
      $nouvelle_cle = $cle ;
    break;
    case "samedi":
      if ( $cle < 8)
      $nouvelle_cle = $cle + 5;
      if ( $nouvelle_cle >= 7)
         $nouvelle_cle = $nouvelle_cle - 7;
      if ( $cle > 7)
      $nouvelle_cle = $cle ;
    break;
    case "dimanche":
      if ( $cle < 8)
      $nouvelle_cle = $cle + 6;
      if ( $nouvelle_cle >= 7)
         $nouvelle_cle = $nouvelle_cle - 7;
      if ( $cle > 7)
      $nouvelle_cle = $cle ;
    break;
    }
  //recherche index du lundi 
  if ( $nouvelle_cle == 1 )
      $index_jour_lundi = $cle;  
    //recherche index du samedi
  if ( $nouvelle_cle == 6 )
      $index_jour_samedi = $cle;
    //recherche index du dimanche
  if ( $nouvelle_cle == 0 || $nouvelle_cle == 7)
      $index_jour_dimanche = $cle;
  return ($nouvelle_cle);
  }
//**********************************************************************

//*******************************************************************************************
// cryptage d'une chaine de caractère en fonction d'une clé
//*******************************************************************************************

function GenerationCle($Texte,$CleDEncryptage)
  {
  $CleDEncryptage = md5($CleDEncryptage);
  $Compteur=0;
  $VariableTemp = "";
  for ($Ctr=0;$Ctr<strlen($Texte);$Ctr++)
    {
    if ($Compteur==strlen($CleDEncryptage))
      $Compteur=0;
    $VariableTemp.= substr($Texte,$Ctr,1) ^ substr($CleDEncryptage,$Compteur,1);
    $Compteur++;
    }
  return $VariableTemp;
  }

function Crypte($Texte,$Cle)
  {
  srand((double)microtime()*1000000);
  $CleDEncryptage = md5(rand(0,32000) );
  $Compteur=0;
  $VariableTemp = "";
  for ($Ctr=0;$Ctr<strlen($Texte);$Ctr++)
    {
    if ($Compteur==strlen($CleDEncryptage))
      $Compteur=0;
    $VariableTemp.= substr($CleDEncryptage,$Compteur,1).(substr($Texte,$Ctr,1) ^ substr($CleDEncryptage,$Compteur,1) );
    $Compteur++;
    }
  return base64_encode(GenerationCle($VariableTemp,$Cle) );
  }

function Decrypte($Texte,$Cle)
  {
  $Texte = GenerationCle(base64_decode($Texte),$Cle);
  $VariableTemp = "";
  for ($Ctr=0;$Ctr<strlen($Texte);$Ctr++)
    {
    $md5 = substr($Texte,$Ctr,1);
    $Ctr++;
    $VariableTemp.= (substr($Texte,$Ctr,1) ^ $md5);
    }
  return $VariableTemp;
  }


//cle de cryptage :

$Cle = "calendrier";
//**********************************************************************

//**********************************************************************
// conversion format de date francais vers anglais
function dateToCal($timestamp) {
	return date('Ymd\THis\Z', $timestamp);
	}
 //**********************************************************
 
 //**********************************************************************
// conversion format de date francais vers anglais
function dateToCal2($timestamp) {
	return date('Ymd', $timestamp);
	}
 //**********************************************************

//**************************************************************************************************
//recuperation date a determiner = date de depart + x jours
// parametres :
// $date : date de depart
// $nb_jour_ajout : nombre de jour a ajouter
// $type_donne_recuperation : type de donnée à retourner 
//      J-> que le jour, M-> que le mois, A-> que l'année , 
//      Num_semaine -> numéro du jour de la semaine
//     JMA-> jour mois et année dans le meme format que la date d'entrée
// $separateur : caractere séprateur entre jour mois et année
// $format_date : format de la date fr ou eng
//**************************************************************************************************
 function ajout_jour_date ($date,$nb_jour_ajout,$type_donne_recuperation,$separateur,$format_date) {

 if ( $format_date == "eng" )
    list($annee,$mois,$jour) = explode ( $separateur, $date);
 else
    list($jour,$mois,$annee) = explode ( $separateur, $date);

 $nb_jour_ajouter = $nb_jour_ajout * 3601 * 24 ;
 $nouvelle_date   = mktime(6,0,0,$mois,$jour,$annee) +  $nb_jour_ajouter ;

 if ( $type_donne_recuperation == "J" )
      $nouvelle_date = date("d", $nouvelle_date);
 else if ( $type_donne_recuperation == "M" )
      $nouvelle_date = date("m", $nouvelle_date);
 else if ( $type_donne_recuperation == "A" )
      $nouvelle_date = date("Y", $nouvelle_date);
 else if ( $type_donne_recuperation == "Num_semaine" )
      $nouvelle_date = date("N", $nouvelle_date);
 else  {
   if ( $format_date == "eng" )
       $nouvelle_date = date("Y".$separateur."m".$separateur."d", $nouvelle_date);
   else
       $nouvelle_date = date("d".$separateur."m".$separateur."Y", $nouvelle_date);
 }
 return ($nouvelle_date);

  }
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************


//**************************************************************************************************
//recuperation numero de semaine du lundi
// parametres :
// $date : date de depart
// $separateur : caractere séprateur entre jour mois et année
// $format_date : format de la date fr ou eng
// $sens_recherche : 
//    avant -> rechercher avant la date 
//    apres -> rechercher apres la date
//**************************************************************************************************
 function cherche_num_semaine ($date,$sens,$separateur,$format_date) {
 $lundi_trouve = false ;

 if ( $format_date == "eng" )
    list($annee,$mois,$jour) = explode ( $separateur, $date);
 else
    list($jour,$mois,$annee) = explode ( $separateur, $date);

 $jour_en_seconde = 3600 * 24 ;
 $date_unix   = mktime(6,0,0,$mois,$jour,$annee) ;

 while ( !($lundi_trouve) ) {
     $test_nom_jour =  date("w", $date_unix);
     if ( $test_nom_jour == 1 )
         $lundi_trouve = true ;
     else   {
       if ( $sens == "avant" ) 
         $date_unix   = $date_unix + $jour_en_seconde ;
       else
         $date_unix   = $date_unix - $jour_en_seconde ;
      }

 }
 $numero_semaine = date("W",$date_unix);

 return ($numero_semaine);

 }
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************



//**************************************************************************************************
//ajout / supprime 0 dans les dates
// parametres :
// $date : date de depart
// $fonction : fonction à réaliser 
//            "Supprime" -> supprime tous les zéros inutiles
//            "Ajout"    -> ajout les zéros aux chiffres inférieurs à 10
// $separateur : caractere séprateur entre jour mois et année
// $format_date : format de la date fr ou eng
//**************************************************************************************************
 function ajout_supprime_zero ($date,$fonction,$separateur,$format_date) {

 if ( $format_date == "eng" )
    list($annee,$mois,$jour) = explode ( $separateur, $date);
 else
    list($jour,$mois,$annee) = explode ( $separateur, $date);

 if ( $fonction == "Supprime" ) {
    $jour = (int)$jour;
    $mois = (int)$mois;
 }
 else {
    if ( $jour < 10 )
        $jour = "0".(int)$jour;
    if ( $mois < 10 )
        $mois = "0".(int)$mois;
 }
 if ( $format_date == "eng" ) {
    $nouvelle_date = $annee.$separateur.$mois.$separateur.$jour;
 }
 else {
    $nouvelle_date = $jour.$separateur.$mois.$separateur.$annee;
 }

 return ($nouvelle_date);

 }
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************


//**************************************************************************************************
//calcul nombre de jours entre 2 dates
// parametres :
// $date_debut : date de depart
// $date_fin : date de fin
// $separateur : caractere séprateur entre jour mois et année
// $format_date : format de la date fr ou eng
//**************************************************************************************************
 function nb_jour_date ($date_debut,$date_fin,$separateur,$format_date) {

 if ( $format_date == "eng" ) {
    list($annee_debut,$mois_debut,$jour_debut) = explode ( $separateur, $date_debut);
    list($annee_fin,$mois_fin,$jour_fin) = explode ( $separateur, $date_fin);
 }
 else {
    list($jour_debut,$mois_debut,$annee_debut) = explode ( $separateur, $date_debut);
    list($jour_fin,$mois_fin,$annee_fin) = explode ( $separateur, $date_fin);
 }
 $jour_en_seconde = 3600 * 24 ;
 $nb_jour = (int)round (( mktime(6,0,0,$mois_fin,$jour_fin,$annee_fin) - mktime(6,0,0,$mois_debut,$jour_debut,$annee_debut) ) / $jour_en_seconde);

 return ($nb_jour);

 }
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

   function ValidateEmail($email)
   {
      $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
      return preg_match($pattern, trim($email));
   }

//**************************************************************************************************
// envoi un email
// parametres :
// $_POST['emetteur']      : email emmetteur
// $_POST['destinataire']  : email destinataire
// $_POST['titre']   	   : titre du message
// $_POST['message']   	   : contenu du message
// $_POST['nom_emetteur']  : nom de l'emetteur du message
// $tableau_champs_ignorer : tableau contenant une liste de nom de champs à ignorer
// $url_redirect_ok		   : url de redirection si le message a été correctement envoyé ( si vide pas de redirection)
// $url_redirect_erreur    : url de redirection si le message n'a pas été correctement envoyé ( si vide pas de redirection)
//**************************************************************************************************   
   
   function envoi_email ()    {
   
      global $replyto, $mailto,$subject,$_POST, $url_redirect_ok	,$url_redirect_erreur ;
	  
      $mailfrom 		= (isset($_POST['emetteur'])) ? $_POST['emetteur'] : $mailto;
	  $replyto		    = (isset($_POST['reponse_a']) && $_POST['reponse_a'] <> '' ) ? $_POST['reponse_a'] : $mailto;
	  $mailto			= (isset($_POST['destinataire'])) ? $_POST['destinataire'] : $mailto;
	  $nom_emetteur   	= (isset($_POST['nom_emetteur']) ) ? $_POST['nom_emetteur'] : $_POST['emetteur'];
	  $subject			= (isset($_POST['titre'])) ? $_POST['titre'] : $subject;
      $success_url = '';
      $error_url = '';
      $error = '';
      $eol = "\n";
	  $format_html = true ;
	  $fin_ligne      = ( $format_html) ? "<br>" : "\n";
      $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
      $boundary = md5(uniqid(time()));

      $header  = 'From: "'.$nom_emetteur.'" <'.$mailfrom.'>'.$eol;
      $header .= 'Reply-To: "'.$nom_emetteur.'" <'.$replyto.'>'.$eol;
      $header .= 'MIME-Version: 1.0'.$eol;
      $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
      $header .= 'X-Mailer: PHP v'.phpversion().$eol;
      if (!ValidateEmail($mailfrom))       {
         $error .= "The specified email address is invalid!\n<br>";
		 $erreur_email		= true;
      }


      $internalfields = array ("submit", "reset", "send", "captcha_code","Envoyer","envoyer","email_verif","emetteur","destinataire","titre","mode_rapide","Effacer","Marquer","nom_emetteur");
	  if ( isset($tableau_champs_ignorer) && is_array($tableau_champs_ignorer) ) array_merge($internalfields, $tableau_champs_ignorer);
	  
      $message = $fin_ligne;
      //$message .= "IP Address : ";
      //$message .= $_SERVER['REMOTE_ADDR'];
      //$message .= $fin_ligne;
	  
      foreach ($_POST as $key => $value)       {
         if (!in_array(strtolower($key), $internalfields))          {
            if (!is_array($value))     {
               if ( $key == 'message' && $format_html && ( !isset($tableau_parametre['ignore_nl2br']) || (isset($tableau_parametre['ignore_nl2br']) && !$tableau_parametre['ignore_nl2br']) )  )
			        $value = nl2br($value);
               $message                  .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $fin_ligne. $fin_ligne;
			   //echo "Texte post : ".$message;
            }
            else
            {
               $message                  .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $fin_ligne. $fin_ligne;
            }
         }
      }

      $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
      $body .= '--'.$boundary.$eol;
      $body .= ( $format_html) ? 'Content-Type: text/html; charset="iso-8859-1"'.$eol : 'Content-Type: text/plain; charset=ISO-8859-1'.$eol;
      $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
      $body .= $eol.stripslashes($message).$eol;
      if (!empty($_FILES))
      {
          foreach ($_FILES as $key => $value)
          {
             if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
             {
                $body .= '--'.$boundary.$eol;
                $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
                $body .= 'Content-Transfer-Encoding: base64'.$eol;
                $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
                $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
             }
         }
      }
      $body .= '--'.$boundary.'--'.$eol;   echo $body;
      $etat_email = mail($mailto, $subject, $body, $header);
	  //echo $header.'<br>'.$mailto.'<br>'.$subject.'<br>'.$body.'<br>';
		
	  if ( $etat_email && isset($url_redirect_ok) && $url_redirect_ok <> '' ) {
		 header('Location: '.$url_redirect_ok);
		 exit;
		 }
		 
	  else if ( $etat_email && isset($url_redirect_erreur) && $url_redirect_erreur <> '' ) {
		 header('Location: '.$url_redirect_erreur);
		 exit;
		 }

	  return($etat_email);
   }
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

//**************************************************************************************************
// archive des données dans le fichier log
//**************************************************************************************************
 function log_info () {
	
	global $tableau_parametre, $affiche_info, $affiche_info_bulle, $conf_api_ajout_locataire, $Cle, $conf_api_global, $texte_jour_fr, $conf_api_reservation, $recurence, $conf_api_restauration_calendrier, $_SESSION, $conf_api_ajout_membre;

	// test activation du log
	if ( isset($conf_api_global['conf_donnees']['activer_log'],$conf_api_global['conf_donnees']['activer_log'],$conf_api_restauration_calendrier['conf_donnees']['repertoire_donnees']) && $conf_api_global['conf_donnees']['activer_log'] ) {
	
		// test taille maximale du fichier
		if ( @filesize ($conf_api_restauration_calendrier['conf_donnees']['repertoire_donnees'].$conf_api_global['conf_donnees']['fichier_log']) >= $conf_api_global['conf_donnees']['taille_log'] ) {
			$chemin_fichier 			= $conf_api_restauration_calendrier['conf_donnees']['repertoire_donnees'].$conf_api_global['conf_donnees']['fichier_log'];
			$chemin_fichier_sauvegarde 	= $conf_api_restauration_calendrier['conf_donnees']['repertoire_donnees'].date("Y-m-d").'-'.$conf_api_global['conf_donnees']['fichier_log'];
			//sauvegarde ancien fichier*********************************
			@copy($chemin_fichier,$chemin_fichier_sauvegarde);
			@unlink($chemin_fichier);
			}
			
		// données de bases à loger
		error_log(date('[Y-m-d H:i e] '). 'IP adresse :'.$_SERVER["REMOTE_ADDR"]. ' Adresse page :'.$_SERVER["REQUEST_URI"] . PHP_EOL, 3, $conf_api_restauration_calendrier['conf_donnees']['repertoire_donnees'].$conf_api_global['conf_donnees']['fichier_log']);
		error_log(date('[Y-m-d H:i e] '). 'Fonction :'.((isset($tableau_parametre['fonction_appelante']))?$tableau_parametre['fonction_appelante']:'inconnue'). ' ID membre :'.((isset($_SESSION[$conf_api_ajout_membre['conf_donnees']['sesion_identification']]['identifiant_membre']))?$_SESSION[$conf_api_ajout_membre['conf_donnees']['sesion_identification']]['identifiant_membre']:'inconnu') . ' ID client :'.((isset($_SESSION[$conf_api_ajout_membre['conf_donnees']['sesion_identification']]['connexion_client']['id_locataire']))?$_SESSION[$conf_api_ajout_membre['conf_donnees']['sesion_identification']]['connexion_client']['id_locataire'].' '.$_SESSION[$conf_api_ajout_membre['conf_donnees']['sesion_identification']]['connexion_client']['nom'].' '.$_SESSION[$conf_api_ajout_membre['conf_donnees']['sesion_identification']]['connexion_client']['prenom']:'inconnu') . PHP_EOL, 3, $conf_api_restauration_calendrier['conf_donnees']['repertoire_donnees'].$conf_api_global['conf_donnees']['fichier_log']);
		error_log(date('[Y-m-d H:i e] '). 'Requete :'.((isset($tableau_parametre['requete_log']))?$tableau_parametre['requete_log']:'inconnue').  PHP_EOL, 3, $conf_api_restauration_calendrier['conf_donnees']['repertoire_donnees'].$conf_api_global['conf_donnees']['fichier_log']);
		}
		
	
}
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************


//**************************************************************************************************
// affiche les messages suite action sur formulaire
//**************************************************************************************************
 function message_info ($message) {

 global $tableau_affiche_info;
 
 $afffiche       = false ;
 $bckg_couleur   = "#DBF5A3";
 $border_couleur = "#32CD32";
 $texte_couleur  = "#000000";
 $duree          = 4000;
 $largeur        = 500;
 $hauteur        = 35;
 $opacity        = 0.90;
 $opacity2       = 90;
 $image          = '';
 $texte          = '';

 if ( $message == 'modif_ok') {
     $texte    = 'Modification enregistrée !' ;
     $afffiche = true ;
     $image    = '<img src="images/check.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'ajout_ok') {
     $texte    = 'Ajout enregistré !' ;
     $afffiche = true ;
     $image    = '<img src="images/check.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'supprime_ok') {
     $texte    = "Suppression réussie !" ;
     $afffiche = true ;
     $image    = '<img src="images/check.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'efface_date_ok') {
     $texte    = 'Les dates ont étaient éffacées !' ;
     $afffiche = true ;
     $image    = '<img src="images/check.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'restaure_ok') {
     $texte    = 'Restauration réussie !' ;
     $afffiche = true ;
     $image    = '<img src="images/check.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'restaure_calendrier_ok') {
     $texte    = 'Restauration des paramétres du calendrier réussie !' ;
     $afffiche = true ;
     $image    = '<img src="images/check.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'mode_demo') {
     $texte    = 'Mode de démonstration activé!<br>&nbsp;&nbsp;Les fonctionnalitées sont limitées' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 70;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 } 
 
 if ( $message == 'erreur_couleur_defaut_existe') {
     $texte    = 'Impossible d\'ajouter cette couleur car il existe déjà une couleur par défaut pour la sycnhronisation' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 70;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 } 
 
  if ( $message == 'erreur_sycnhro_fichier_vide') {
     $texte    = 'La synchronisation a était éffectuée mais il semble que le fichier ical ne contient aucune données!' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 70;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }
 
  if ( $message == 'erreur_couleur_defaut_ical') {
     $texte    = 'Impossible de synchroniser vous devez définir une couleur par défaut pour la synchronisation' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 70;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }
 
 if ( $message == 'erreur_format_ical') {
     $texte    = 'Le fichier indiquée dans l\'adresse ical de synchronisation ne semble pas être de type calendrier - text/calendar' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 70;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }
 
  if ( $message == 'erreur_ouverture_ical') {
     $texte    = 'L\'adresse web du calendrier ical semble ne pas être correcte ou sont accès est bloqué, veuillez contrôler l\'adresse indiquée' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 70;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 } 
 
   if ( $message == 'erreur_manque_url_sycnhro') {
     $texte    = 'La synchronisation n\'a pas pu être réalisée car il semble que cette ressource n\'a pas d\'adresse web de synchronisation renseignée' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 70;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }
 
   if ( $message == 'erreur_liste_logement') {
     $texte    = 'La liste de ressources à synchronisée n\'est pas correcte' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 70;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }
 
    if ( $message == 'synchronisation_ok') {
     $texte    = 'La synchronisation a été réalisée avec succès !' ;
     $afffiche = true ;
     $duree          = 10000;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }
 
 if ( $message == 'modele_ok') {
     $texte    = 'Le nouveau modèle a été chargé !' ;
     $afffiche = true ;
     $image    = '<img src="images/check.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'erreur_execution') {
     $texte    = 'Erreur d\'éxecution ! veuillez recommencer' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $opacity        = 1;
     $opacity2       = 100; 
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'erreur_langue') {
     $texte    = 'Le symbole ou le nom de la langue existe déjà!' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'erreur_connexion') {
     $texte    = 'Erreur de connexion!<br>L\'identifiant et/ou le mot de passe sont incorrects!<br>(attention aux minuscules ou majuscules)' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 90;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'erreur_sessions') {
     $texte    = 'Les sessions ne sont pas activées sur votre serveur<br>ou elles ont étés perdues!' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 50;
     $opacity        = 1;
     $opacity2       = 100;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'erreur_connecte_sql') {
     $texte    = 'Impossible de se connecter au serveur sql!<br>Veuillez vérifier les paramètres de connexion.<br>- adresse serveur - nom utilisateur - mot de passe -' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 90;
     $opacity        = 1;
     $opacity2       = 100;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'erreur_connecte_base') {
     $texte    = 'Impossible de se connecter à la base de données !<br>Veuillez vérifier les paramètres de connexion.<br>- nom de votre base -' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 90;
     $opacity        = 1;
     $opacity2       = 100;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'erreur_fichier_locataire') {
     $texte    = 'Le fichier locataire semble être incorrect!<br> <a href="base.php" >Cliquez ici</a> pour restaurer le fichier<br>' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 90;
     $opacity        = 1;
     $opacity2       = 100;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'erreur_fichier_com_locataire') {
     $texte    = 'Le fichier commentaires locataire semble être incorrect!<br> <a href="base.php" >Cliquez ici</a> pour restaurer le fichier<br>' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 90;
     $opacity        = 1;
     $opacity2       = 100;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'erreur_fichier_logement') {
     $texte    = 'Le fichier liste location semble être incorrect!<br> <a href="base.php" >Cliquez ici</a> pour restaurer le fichier<br>' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 90;
     $opacity        = 1;
     $opacity2       = 100;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'erreur_fichier_couleur') {
     $texte    = 'Le fichier couleur semble être incorrect!<br> <a href="base.php" >Cliquez ici</a> pour restaurer le fichier<br>' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 90;
     $opacity        = 1;
     $opacity2       = 100;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'erreur_fichier_parametres') {
     $texte    = 'Le fichier paramètres du calendrier semble être incorrect!<br> <a href="base.php" >Cliquez ici</a> pour restaurer le fichier<br>' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 90;
     $opacity        = 1;
     $opacity2       = 100;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }

 if ( $message == 'erreur_fichier_dates') {
     $texte    = 'Les fichiers contenant les dates semblent être incorrect!<br> <a href="restaure_fichier_date.php" >Cliquez ici</a> pour restaurer les fichiers<br>' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 90;
     $opacity        = 1;
     $opacity2       = 100;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }
 
 if ( $message == 'erreur_upload_zip') {
     $texte    = 'La restauration n\'as pas été réalisée!<br>Le fichier à transférer doit s\'appeller sauvegarde.zip (Max = 8MB )<br>Si le problème persiste, transférer le fichier sauvegarde via FTP, répertoire admin/fichier_calendrier<br>puis cliquer pour faire une restauration à partir de la sauvegarde serveur' ;
     $afffiche = true ;
     $bckg_couleur   = "#FF6262";
     $border_couleur = "#FF0000";
     $texte_couleur  = "#FFFFFF";
     $duree          = 10000;
     $hauteur        = 120;
     $largeur        = 600;
     $opacity        = 1;
     $opacity2       = 100;
     $image    = '<img src="images/alerte.png" id="Image15" border="0" style="width:20px;">';
 }

 $tableau_affiche_info['id']	= $message;
 $tableau_affiche_info['texte']	= $texte;
 
 if ( $afffiche )
    echo '<div id="info" style="position:absolute;overflow:visible;background-color:',$bckg_couleur,';border:1px ',$border_couleur,' solid;visibility:hidden;opacity:',$opacity,';-moz-opacity:',$opacity,';-khtml-opacity:',$opacity,';filter:alpha(opacity=',$opacity2,');width:',$largeur,'px;height:',$hauteur,'px;z-index:17" title="message info">
          <div id="wb_Text2" style="margin:0;padding:0;position:absolute;left:10px;top:5px;text-align:center;z-index:12;">
          ',$image,'&nbsp;<font style="font-size:16px" color="',$texte_couleur,'" face="Arial"><b>',$texte,'</b></font>
          </div>
          </div>

          <script type="text/javascript">
          document.getElementById(\'info\').style.visibility = \'visible\' ;
          setTimeout("document.getElementById(\'info\').style.visibility = \'hidden\' ;",',$duree,');
          </SCRIPT>

          ';


 }

//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************


//**************************************************************************************************
//ajout / supprime 0 dans les dates
// parametres :
// $id      : nom et id de la liste
// $largeur : largeur en px de la liste
// $tableau : tableau a transformer en liste
// $tableau_2 : second tableau pour les prenoms
// $zero_exclus   : exclure de la liste l'index zéro du tableau
// $valeur_defaut : valeur a preselectionnée dans la liste
// $afficher_groupe : si true affiche des groupes par la premiere lettre
// $formulaire : id du formulaire a soumettre en cas de selection
//**************************************************************************************************
 function liste_box ($id,$largeur,$tableau,$tableau2,$zero_exclus,$valeur_defaut,$afficher_groupe,$formulaire) {
       $destination_formulaire = ( $formulaire <> '') ? 'onchange="document.'.$formulaire.'.submit();return false;"' : '';
       $largeur                = ( is_numeric($largeur) ) ? 'width:'.$largeur.'px;': '' ;
       echo '<select name="',$id,'" size="1" id="',$id,'" style="',$largeur,'border-width:1px;font-family:Courier New;font-size:16px;" ',$destination_formulaire,'>';
       if ( !$zero_exclus && isset($tableau[0]) )
           echo '<option selected value="0" >',stripslashes($tableau[0]),'</option>' ;
       $memoire = '';
       $cle_fichier ='';
       $memoire_tab_tri = '';
       $nb_result = count ($tableau);
       if ( $nb_result > 0 ) {
        asort($tableau);  //tri alphabétique ********
        foreach ($tableau as $cle_fichier => $val_tab)  {

            $premiere_lettre = ( !is_numeric($cle_fichier) || ( is_numeric($cle_fichier) && $cle_fichier <> 0) ) ? ucfirst(substr(stripslashes($val_tab), 0, 1)): '';
            if ( $premiere_lettre <> $memoire_tab_tri && $afficher_groupe)
                echo '<optgroup label="',ucfirst($premiere_lettre),'" style="background-color:#CEDCF2;">';
            if ( ($cle_fichier <> 0 || !is_numeric($cle_fichier) ) && $val_tab <> '') { // test si contenu différent de "tous"**********
               $val_tableau_2 = ( isset($tableau2[$cle_fichier]) ) ? $tableau2[$cle_fichier] : ''; 
               if ( $valeur_defaut == $cle_fichier )
                echo '<option selected value="',$cle_fichier,'" style="background-color:#FFFFFF;">',$val_tab,' ',$val_tableau_2,'</option>' ;
               else
                echo '<option value="',$cle_fichier,'" style="background-color:#FFFFFF;">',$val_tab,' ',$val_tableau_2,'</option>' ;
               $memoire_tab_tri = $premiere_lettre;
             }
           }
        }
        echo '</select>';

 }
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************


//**************************************************************************************************
//convertit les br vers \n
// parametres :
// $string : chaine à convertir
//**************************************************************************************************
function br2nl($text)
{
    return  preg_replace('/<br\\s*?\/??>/i', '', $text);
}
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

//**************************************************************************************************
//convertit les \n en array
// parametres :
// $string : chaine à convertir
//**************************************************************************************************
function nl2array($string) {
	$string = str_replace(array("\r\n", "\r", "\n"), "%&%", $string);
	$array	= explode ('%&%',$string);
	$array2	= '';
	if ( is_array($array) ) {
		foreach ( $array as $cle => $valeur ) {
			$array2[$cle]	= $valeur;
		}
	}
	return $array2;
} 
//**************************************************************************************************
//**************************************************************************************************

//**************************************************************************************************
//affiche les array en \n 
// parametres :
// $array : chaine à convertir
//**************************************************************************************************
function array2nl($array) {
	if ( is_array($array) ) {
		$string	= implode ('<br />',$array);
		$string	= str_replace('<br />',"\n",$string);  // Attention à bien utiliser des guillemets doubles pour interpréter ces caractères
		$string	= str_replace('"',"",$string);
	}
	else 
		$string = '';
	return $string;
} 
//**************************************************************************************************
//**************************************************************************************************

//**************************************************************************************************
//convertit les caractères spéciaux dans les fichiers
// parametres :
// $string : chaine à convertir
//**************************************************************************************************
function suppr_char_spec($texte)
{
    return  preg_replace("(\r\n|\n|\r)",' ',$texte);
}
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

//**************************************************************************************************
//Téléchargement d'un fichier
// parametres :
// $fichier_a_telecharger : nom du fichier
// $chemin                : chemin relatif jusqu'au répertoire du fichier
//**************************************************************************************************
function telecharge ($fichier_a_telecharger,$chemin) {
switch(strrchr(basename($fichier_a_telecharger), ".")) {

case ".gz": $type = "application/x-gzip"; break;
case ".tgz": $type = "application/x-gzip"; break;
case ".zip": $type = "application/zip"; break;
case ".pdf": $type = "application/pdf"; break;
case ".png": $type = "image/png"; break;
case ".gif": $type = "image/gif"; break;
case ".jpg": $type = "image/jpeg"; break;
case ".txt": $type = "text/plain"; break;
case ".htm": $type = "text/html"; break;
case ".html": $type = "text/html"; break;
default: $type = "application/octet-stream"; break;

}

header("Content-disposition: attachment; filename=$fichier_a_telecharger");
header("Content-Type: application/force-download");
header("Content-Transfer-Encoding: $type\n"); // Surtout ne pas enlever le \n
header("Content-Length: ".filesize($chemin . $fichier_a_telecharger));
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
header("Expires: 0");
readfile($chemin . $fichier_a_telecharger);
}
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

//**************************************************************************************************
// réecriture url des images pour les modeles
// parametres :
// $url             : url absolu du fichier a copier
// $adresse_script  : chemin absolu installation du script
// $chemin_modele   : chemin relatif vers le répertoire du modele
//**************************************************************************************************

function image_modele ($url,$adresse_script,$chemin_modele) {
  if ( $url <> '' ) {
   $nom_fichier    = basename($url);
   // nouvelle adresse de l'image ****************
   $adresse = $chemin_modele."/".$nom_fichier ;
   //calcul des chemins relatif ******************
   $chemin_script = parse_url($adresse_script, PHP_URL_PATH);
   $chemin_image  = parse_url($url, PHP_URL_PATH);
   
   $script_nb_sl = substr_count($chemin_script, '/');;
   $image_nb_sl  = substr_count($chemin_image, '/');;

   $back = '';

   for ( $i = 1; $i <= $script_nb_sl; $i++) {
       $back .= "../";
   }

   $url_relatif_image = $back.substr_replace($chemin_image, '', 0, 1);
   // copy de l'image dans le répertoire du modele******
   @copy($url_relatif_image,$adresse);
   @chmod ($adresse,0644);

   //$adresse = $adresse_script."admin/".$adresse;
  }
  else
    $adresse = '' ;
   return ($adresse);
}
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

//**************************************************************************************************
// calcul date supérieur / inférieur
// parametres :
// $date_debut       : date de depart
// $date_fin         : date de fin
// $type_recherche ->
//   superieur       : retourne true si la date de fin est superieur à la date de fin
//   inferieur       : retourne true si la date de fin est inferieur à la date de fin
//   inferieur_egale : retourne true si la date de fin est inferieur ou égale à la date de fin
//   egale           : retourne true si la date de fin est égale à la date de fin
//   superieur_egale : retourne true si la date de fin est superieur ou égale à la date de fin
// $separateur       : caractere séprateur entre jour mois et année
// $format_date     : format de la date fr ou eng
//**************************************************************************************************
 function comparaison_date ($date_debut,$date_fin,$type_recherche,$separateur,$format_date) {
 $resultat = false ;

 if ( $format_date == "eng" ) {
    list($annee_debut,$mois_debut,$jour_debut) = explode ( $separateur, $date_debut);
    list($annee_fin,$mois_fin,$jour_fin) = explode ( $separateur, $date_fin);
 }
 else {
    list($jour_debut,$mois_debut,$annee_debut) = explode ( $separateur, $date_debut);
    list($jour_fin,$mois_fin,$annee_fin) = explode ( $separateur, $date_fin);
 }

 $jour_en_seconde = 3600 * 24 ;
 $nb_jour = (int)round (( mktime(6,0,0,$mois_fin,$jour_fin,$annee_fin) - mktime(6,0,0,$mois_debut,$jour_debut,$annee_debut) ) / $jour_en_seconde);

 if ( $type_recherche == 'egale' && $nb_jour == 0 )
    $resultat = true ;
 if ( $type_recherche == 'superieur' && $nb_jour > 0 )
    $resultat = true ;
 if ( $type_recherche == 'superieur_egale' &&  ( $nb_jour > 0 ||  $nb_jour == 0 ) )
    $resultat = true ;
 if ( $type_recherche == 'inferieur' && $nb_jour < 0  )
    $resultat = true ;
 if ( $type_recherche == 'inferieur_egale' && ( $nb_jour < 0 ||  $nb_jour == 0 ) )
    $resultat = true ;

 return ($resultat);

 }
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

//*******************************************************************************************
// suppression des accents
//*******************************************************************************************

function suppr_accents($chaine) {
   $accents = array("À","Á","Â","Ã","Ä","Å","Ç","È","É","Ê","Ë","Ì","Í","Î","Ï","Ò","Ó","Ô","Õ","Ö","Ù","Ú","Û","Ü","Ý","à","á","â","ã","ä","å","ç","è","é","ê","ë","ì","í","î","ï","ð","ò","ó","ô","õ","ö","ù","ú","û","ü","ý","ÿ","'");
   $sans = array("A","A","A","A","A","A","C","E","E","E","E","I","I","I","I","O","O","O","O","O","U","U","U","U","Y","a","a","a","a","a","a","c","e","e","e","e","i","i","i","i","o","o","o","o","o","o","u","u","u","u","y","y","");
   return str_replace($accents, $sans, $chaine);
}

//**************************************************************************************************
// module recherche de disponibilités par mi toutes les locations entre 2 dates choisies
// la fonction retourne un tableau avec la liste des locations disponibles
// parametres :
// $chemin_admin     : chemin relatif depuis l'endroit d'appel de la fonction jusqu'au répertoire admin du calendrier
// $date_debut       : date de debut de recherche format JJ/MM/AAAA
// $date_fin         : date de fin de recherche format JJ/MM/AAAA
// $capacite         : capacité minimale de la location en nombre de personnes
//                     si = 0 alors ne tient pas compte de la capacité
// $affiche_erreurs  : affiche les erreurs eventuelles ( format date, date fin anterieur date debut)
// tableau retourn fonction : liste id des locations disponibles pour la période
// + $tarif_logement_periode_journee[$id_location] = tableau contenant le térif par location disponibles pour la période inclus le jour de début et le jour de fin 
// + $tarif_logement_periode_nuitee[$id_location]  = tableau contenant le térif par location disponibles pour la période inclus le jour de début mais pas le jour de fin
//**************************************************************************************************

 function recherche_dispo($chemin_admin,$date_debut,$date_fin,$capacite,$affiche_erreurs ) {

 global $tarif_logement_periode_journee, $tarif_logement_periode_nuitee ;
 
 //inclusion du fichier connexion ***************************
  require_once ($chemin_admin."genere/connexion.php");
 //inclusion liste des couleurs ****************************
  require_once ($chemin_admin."fichier_calendrier/calendrier_liste_couleur.php");
 //inclusion liste des locations ****************************
  require_once ($chemin_admin."fichier_calendrier/calendrier_liste_logement.php");

   $erreur_compare_date = false;
   // test format des dates ********************************
   $test_post_debut = test_date_fr ($date_debut);
   $test_post_fin = test_date_fr ($date_fin);

   if ( $test_post_debut <> 0 && $affiche_erreurs )
       echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> *** Le format de la date de début n\'est pas conforme, il doit être JJ/MM/AAAAA</font><br><br>';
   if ( $test_post_fin <> 0 && $affiche_erreurs )
       echo '<font style="font-size:16px;" color="#FF0000" face="Arial">*** Le format de la date de fin n\'est pas conforme, il doit être JJ/MM/AAAAA</font><br><br>';
   if ( $test_post_debut == 0 && $test_post_fin == 0 && comparaison_date ($date_fin,$date_debut,"superieur","/","fr") )  {
       $erreur_compare_date = true;
       if ( $affiche_erreurs)
           echo '<font style="font-size:16px;" color="#FF0000" face="Arial">*** La date de fin doit être postérieur à la date de début</font><br><br>';
   }

   // conversion des dates au format anglais ***************
   $date_debut_eng   = ajout_supprime_zero (date_fr_eng($date_debut,"/","-"),"Ajout","-","eng");
   $date_fin_eng     = ajout_supprime_zero (date_fr_eng($date_fin,"/","-"),"Ajout","-","eng");
   
   // nombre de jours pour la réservation
   $nb_jours = nb_jour_date ($date_debut_eng,$date_fin_eng,"-","eng");

   //**************************************************************************
   // recherche des disponibilités *************************
   //**************************************************************************

   if ( $test_post_debut == 0 && $test_post_fin == 0 && !$erreur_compare_date ) {

      //initialisation tableau des logements disponibles **********************
      $tableau_logement_dispo = $nom_logement ; // hypothese de départ, tous les locations sont disponibles
      unset ($tableau_logement_dispo[0]);  // suppression logement tous *******
	  $tableau_logement_tarif = '' ; //initialisation tarif pour la période

      //***********************************************************************
      // fonctionnement avec base de données
      //***********************************************************************

      if ( AVEC_BDD ) {
         //connection a la base de donnees*******************************************************************
         $connect = @mysql_connect(Decrypte(hote_cal,"calendrier"), Decrypte(user_cal,"calendrier"), Decrypte(password_cal,"calendrier"));
         if (!$connect )
           echo '<font style="font-size:16px" color="#FF0000" face="Arial"><b>** Erreur de connexion au serveur sql **</b><br></font>' ;
         else {
         // on choisit la bonne base
         $connect_base = @mysql_select_db(Decrypte(base_cal,"calendrier"), $connect) ;
         if (!$connect_base )
           echo '<font style="font-size:16px" color="#FF0000" face="Arial"><b>** Erreur de connexion à la base sql **</b><br></font>' ;
         else {
            //recherche des jours reservés dans le mois en cours*********************************************
            $valeur_select = "SELECT * FROM ".Decrypte(nom_table_cal,"calendrier")." WHERE date_reservation >= '$date_debut_eng' AND date_reservation <= '$date_fin_eng' order by date_reservation, id ";
            $requete = @mysql_query ($valeur_select);  //echo $valeur_select;
            while ( $data = mysql_fetch_object($requete) ) {
               if ( !$date_couleur_disponible[$data->couleur_texte] ) // la couleur n'est pas une couleur dispo
                   unset ($tableau_logement_dispo[$data->id_logement]); //efface ce logement ***
			   $tableau_logement_tarif[$data->id_logement][$data->date_reservation]  = $data->tarif ; // somme tarif de location
            }// fin donnes de la bse de données ***

         }// fin select base ****

        } // fin connect sql ****

       } // fin avec bdd ***

      //***********************************************************************
      // fonctionnement sans base de données
      //***********************************************************************

       elseif ( !AVEC_BDD ) {
         if ( isset ($nom_logement) ) {
         foreach ($nom_logement as $cle => $libelle_logement ) {
         //recupération des dates pour le logement en cours de traitement *********
         unset($tableau_reservation); // réinitialisation des variables tableau ***
         $chemin_fichier_logement = $chemin_admin."fichier_calendrier/dates_sans_bdd/".$cle."_calendrier.php";
         if ( file_exists($chemin_fichier_logement)) {
              include($chemin_fichier_logement);
         if ( isset($tableau_reservation[$cle]) && $cle <> 0) {
           foreach ($tableau_reservation[$cle] as $date_index => $val_reservation ) {
             // contenu des reservations du logement ***************************
             list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$tableau_reservation[$cle][$date_index]);

             if ( comparaison_date ($date_debut_eng,$date_index,"superieur_egale","-","eng") && comparaison_date ($date_fin_eng,$date_index,"inferieur_egale","-","eng") ) { // la couleur n'est pas une couleur dispo
                if ( !$date_couleur_disponible[$couleur_texte_temp] )
					unset ($tableau_logement_dispo[$cle]); //efface ce logement ***
				$tableau_logement_tarif[$cle][$date_index]  = $tarif_temp ; // somme tarif de location
			 }

           }// fin pour toutes les reservations ******************************

         } // fin listage des réservations pour le logement ******************
           
         }// fin si fichier du logement existe *******************************
           
         }// fin boucle pour tous les logements ******************************

         }// fin test si des logements existent ******************************

       } // fin traitement sans base de données ******************************

   // le tableau php tableau_logement_dispo contient la liste des logements disponibles
   //print_r($tableau_logement_dispo);
   //echo "<br>";
   } // fin test ok pour recherche dispo ***

 // controle de la capacité maximale d'accueil , si le parametre $capacité de la fonction est supérieur à 0
 // si  $capacité = 0 , alors on ne doit pas tenir compte de la capacité dans les recherches de dispo
 if ( isset ($tableau_logement_dispo) && (int)$capacite >= 0 ) {
      foreach ($tableau_logement_dispo as $cle => $libelle_logement ) {
         if ( $capacite_logement[$cle] < (int)$capacite  ) //le logement est disponible mais sa capacité est trop faible
            unset ($tableau_logement_dispo[$cle]); //efface ce logement ***
      }
 }

 // calcul tarif pour la période
 $date_index = $date_debut_eng ;
 while ( comparaison_date ($date_fin_eng,$date_index,"inferieur_egale","-","eng") )  {
	 if ( isset ($tableau_logement_dispo) ) {
		  foreach ($tableau_logement_dispo as $cle => $libelle_logement ) {
			  // initialisation des variables
			  if ( !isset($tarif_logement_periode_journee[$cle]) ) $tarif_logement_periode_journee[$cle] = 0;
			  if ( !isset($tarif_logement_periode_nuitee[$cle]) ) $tarif_logement_periode_nuitee[$cle] = 0;
			  // calcul total tarif 
			  $tarif_logement_periode_journee[$cle] += ( isset($tableau_logement_tarif[$cle][$date_index]) && is_numeric($tableau_logement_tarif[$cle][$date_index]) )? $tableau_logement_tarif[$cle][$date_index] : $tarif_logement[$cle];
			  $tarif_logement_periode_nuitee[$cle] += ( !comparaison_date ($date_fin_eng,$date_index,"egale","-","eng") )? ( (isset($tableau_logement_tarif[$cle][$date_index]) && is_numeric($tableau_logement_tarif[$cle][$date_index]) ) ? $tableau_logement_tarif[$cle][$date_index] : $tarif_logement[$cle] ) : 0;

		  }
	    } 
	 $date_index = ajout_jour_date ($date_index,1,"JMA","-","eng");
	 }
 
 if ( isset($tableau_logement_dispo) )
      return ($tableau_logement_dispo);

 }
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

//**************************************************************************************************
// module insertion date et locataire depuis formulaire visiteur
// la fonction retourne un tableau avec la liste des locations disponibles
// parametres :
// $chemin_admin     : chemin relatif depuis l'endroit d'appel de la fonction jusqu'au répertoire admin du calendrier
// $id_logement_marquer: numéro id de la location a marquer
// $date_debut       : date de debut de recherche format JJ/MM/AAAA
// $date_fin         : date de fin de recherche format JJ/MM/AAAA
// $tableau_locataire: nom du locataire tableau contenant les informations du locataires
// ajout_locataire   : si le locataire n'existe pas , il sera rajouté
// couleur           : numéro id de la couleur du marqueur pour la période a marquer
// nb_max_jour       : nombre maximum de jours successifs pouvant être marqués
// ctrl_date_existe  : si true alors, si dans l'intervalle date debut/date fin , il y a au moins une date de couleur dites
//                     non disponible alors les dates indiquées ne sont pas enregistrées dans le calendrier
// $affiche_erreurs  : affiche les erreurs eventuelles ( format date, date fin anterieur date debut)
// La fonction retourne TRUE si les dates ont étaient marquées
//**************************************************************************************************
 function insertion_date($chemin_admin,$id_logement_marquer,$date_debut,$date_fin,$tableau_locataire,$ajout_locataire,$couleur,$nb_max_jour,$ctrl_date_existe,$affiche_erreurs ) {
	 
  //intialisation de variables ******************************
  $creation_reussi_date      = false;
  $creation_reussi_locataire = false;
  $couleur_indisponible_existe = false ;
 //inclusion du fichier connexion ***************************
  require ($chemin_admin."genere/connexion.php");
 //inclusion liste des couleurs ****************************
  require ($chemin_admin."fichier_calendrier/calendrier_liste_couleur.php");
 //inclusion liste des locations ****************************
  require ($chemin_admin."fichier_calendrier/calendrier_liste_logement.php");
 //inclusion liste des locations ****************************
  require ($chemin_admin."fichier_calendrier/calendrier_liste_locataire.php");
 //inclusion liste des locations ****************************
  require ($chemin_admin."fichier_calendrier/parametres_calendrier.php");

  //***************************************************************
  //traitement du locataire ***************************************
  //***************************************************************
  
  if ( $ajout_locataire && !MODE_DEMO ) {
  //controle si le locataire existe deja **************************
  $locataire_existe = false;
  $num_pointeur_max = 0;
  $nom_minuscule    = strtolower(suppr_accents($tableau_locataire[0]));
  $prenom_minuscule = strtolower(suppr_accents($tableau_locataire[1]));
  foreach ( $nom_locataire as $cle => $val_nom_locataire ) {
    if ( $cle <> 0 && $ajout_locataire) {
      $nom_minuscule_fichier    = strtolower(suppr_accents($nom_locataire[$cle]));
      $prenom_minuscule_fichier = strtolower(suppr_accents($prenom_locataire[$cle]));
      //controle si le locataire est deja dans la base de données ***************
      if ($nom_minuscule_fichier == $nom_minuscule && $prenom_minuscule_fichier == $prenom_minuscule )  {
        $locataire_existe = true ;
        $creation_reussi_locataire = true ;
        $num_pointeur_max = $cle;
      }
     }
  }// fin foreach locataire
  }
  
  // si le locataire n'existe pas dans le fichier il sera ajouté ****
  if ( !$locataire_existe && $ajout_locataire && $tableau_locataire[0] <> '' && !MODE_DEMO) {
      $fichier_libre  = false;
      $fin_tableau_locataire = false ;
      $chemin_fichier = $chemin_admin."fichier_calendrier/calendrier_liste_locataire.php";
      $chemin_fichier_sauvegarde = $chemin_admin."fichier_calendrier/sauvegarde_calendrier_liste_locataire.php";

      while (!isset($fin_tableau_locataire)  || !$fin_tableau_locataire) {  // controle que le fichier est disponible
        include ($chemin_fichier);
        if ( isset($fin_tableau_locataire)  && $fin_tableau_locataire ) {
        //sauvegarde ancien fichier*********************************
        @copy($chemin_fichier,$chemin_fichier_sauvegarde);
        $file= @fopen($chemin_fichier, "w");
        $fichier_libre = true;
        $fonction = 'Ajout_formulaire';
        }
       }

      // mise a jour du fichier locataire **************************************
      define ("AUTOR_FCT_GEN_LOCATAIRE", true);
      if ( $fichier_libre )
         //chemin vers le fichier de création liste des locataires/logements**********************************************************
         require($chemin_admin."genere/genere_listes_locataire.php");
      $creation_reussi_locataire = $creation_reussi ;
  }
    else
      $creation_reussi_locataire = true ;   // il ne faut aps ajouter le locataire***

  //*******************************************************************************
  //gestion des dates *************************************************************
  //*******************************************************************************

  if ( $avec_diagonale_cellule )
       $date_fin = jour_precedent ($date_fin,"/","fr");

   $test_post_debut = test_date_fr ($date_debut);
   $test_post_fin = test_date_fr ($date_fin);

  if (  $test_post_debut==0 && $test_post_fin==0 )
    //test pour eviter de marquer un nombre de jour reservé trop important > nb_max_jour jours
    $compare_date = nb_jour_date ($date_debut,$date_fin,"/","fr");
  elseif ( $affiche_erreurs)
    echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> *** Le format des dates ne sont pas conforme, ils doivent être JJ/MM/AAAAA</font><br><br>';
  // controle nombre maximum de jours a marquer ******************
  if ( $compare_date > $nb_max_jour && $affiche_erreurs )
    echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> Les dates n\'ont pas pu être enregistrée car l\'intervalle est trop grand !</font><br><br> ';
  if ( $compare_date < 0 && $affiche_erreurs )
    echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> Les dates n\'ont pas pu être enregistrée car la date de fin est antérieure à la date de début!</font><br><br> ';

  if (  $test_post_debut==0 && $test_post_fin==0 && $compare_date >= 0  && $compare_date <= $nb_max_jour && !MODE_DEMO) {

      $date_debut_eng   = ajout_supprime_zero (date_fr_eng($date_debut,"/","-"),"Ajout","-","eng");
      $date_fin_eng     = ajout_supprime_zero (date_fr_eng($date_fin,"/","-"),"Ajout","-","eng");

      $tarif = str_replace(",",".",$tarif_logement[$id_logement_marquer]);  // transformation des virgules en . pour les chiffres

      // initialisation de variables ******************************************
      unset($tableau_requete);  // initialisation du tableau des logements a marqués***

      //***********************************************************************
      // liste des locations  marquer *****************************************
      //***********************************************************************
      // attention marquage tous est forcé a false !!! ************************
      if ( isset($marquer_tous) && $marquer_tous == 'oui' && TOUJOURS_FALSE ) {// si marquage de toutes les locations
          $tableau_requete = $nom_logement ;   // tableau des locations = toutes les locations
          unset($tableau_requete[0]); // suppression index logement tous ******
          }
      else
          $tableau_requete[$id_logement_marquer] = $nom_logement[$id_logement_marquer];  // tableau des locations = toutes les locations

      //***********************************************************************
      // fonctionnement avec base de données
      //***********************************************************************
      
      if ( AVEC_BDD ) {
      //connection a la base de donnees*******************************************************************
      $connect = @mysql_connect(Decrypte(hote_cal,"calendrier"), Decrypte(user_cal,"calendrier"), Decrypte(password_cal,"calendrier")) ;
      if ( !$connect && $affiche_erreurs )
         echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> *** Erreur de connexion au serveur sql<br><br>';
      $connect_base = @mysql_select_db(Decrypte(base_cal,"calendrier"), $connect);
      if ( !$connect_base && $affiche_erreurs )
         echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> *** Erreur de connexion à la base sql<br><br>';
      // boucle de marquage des dates pour le ou les locations selectionnées 1 par 1 ****
      foreach ( $tableau_requete as $cle => $nom_logement_requete ) {

      //initialisation liste requete*****************************************
	  $connection_sql_active	= true;
      $date_boucle      = $date_debut_eng ;
      $tri_logement_req = ", '".$cle."'" ;
      $tri_logement_req2 = " and id_logement = '".$cle."'" ;
      $tri_locataire2   = ", '".$num_pointeur_max."'";
      $liste_couleur_req = '';
      $liste_query = '';
      $compare_date = nb_jour_date ($date_debut,$date_fin,"/","fr");
      $commentaire = ( isset($tableau_locataire[8]) ) ?  addslashes(nl2br($tableau_locataire[8])) : '' ;

      //***********************************************************************************************
      // controle si date de couleur indisponible existe dans le calendrier pour la période voulue ****
      //***********************************************************************************************
      
      //liste des couleurs dites dates indisponibles **********************
      if ( isset($date_couleur_disponible) && $ctrl_date_existe ) {
          foreach ($date_couleur_disponible as $cle => $disponible ) {
              if ( !$disponible ) {
                if ( $liste_couleur_req == '' ) 
                     $liste_couleur_req .= ' and ( ';
                else
                     $liste_couleur_req .= ' OR ';
                 $liste_couleur_req .= " couleur_texte = '$cle' ";
              }
          }
         if ( $liste_couleur_req <> '' )
              $liste_couleur_req .= ' ) ';
      }

      // recherche si des dates avec couleurs indisponible sont deja marquées dans la base *************
      $req_ctrl = "SELECT * from ".Decrypte(nom_table_cal,"calendrier")." where date_reservation >= '$date_debut_eng' and date_reservation <= '$date_fin_eng' $tri_logement_req2 $liste_couleur_req" ;
      $requete = @mysql_query($req_ctrl );
      $nj_jour = mysql_num_rows($requete);

      if ( $nj_jour == 0 || !$ctrl_date_existe ) {  // marquage des jours si le controle date est hors service ou si controle date ok

      //effacement des dates eventuellement déjà marquées si la couleur en cours n'est pas une couleur invisible******
      $req_sql = "delete from ".Decrypte(nom_table_cal,"calendrier")." where date_reservation >= '$date_debut_eng' and date_reservation <= '$date_fin_eng' $tri_logement_req2 ";
      if ( !$couleur_invisible[$couleur] )
            @mysql_query($req_sql);

      //ajout dans la liste du premier jour **************************************************************************
      $liste_query .= "(NULL, '".$date_boucle."', '".$couleur_reserve[$couleur]."', '".$couleur."' $tri_logement_req  $tri_locataire2 , '".$tarif."', '".$commentaire."')";

      while ( $compare_date > 0 ) {
      $date_boucle  =  ajout_jour_date ($date_boucle,1,"JMA","-","eng");
      if ( $liste_query <> '')   // controle si premiere insertion
        $liste_query .= ' ,';
      // on ajoute les marqueurs dans la semaine*******************************
      $liste_query .= "(NULL, '".$date_boucle."', '".$couleur_reserve[$couleur]."', '".$couleur."' $tri_logement_req  $tri_locataire2 , '".$tarif."', '".$commentaire."')";
      $compare_date = nb_jour_date ($date_boucle,$date_fin_eng,"-","eng");
      }
     $liste_query .= " ;";

     $query = "INSERT INTO `".Decrypte(nom_table_cal,"calendrier")."` (`id`, `date_reservation`, `couleur`, `couleur_texte`, `id_logement`, `id_locataire`, `tarif`, `commentaires`) VALUES
              $liste_query";
     $creation_reussi_date = @mysql_query($query)  ;
	 // mise à jour ical
     if ( $creation_reussi_date ) {
			$vecteur_index_logement = $cle;
			@define ("AUTOR_FCT_SAUVEGARDE", true);
			include($chemin_admin."genere/genere_export_ical.php");
		}
			
         }  // fin boucle marquage si controle date ok *************************
            //******************************************************************
      else {
          if ( $affiche_erreurs )
          echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> Les dates n\'ont pas pu être enregistrée car il y a déjà des jours indisponibles dans cette periode! </font><br><br>';
          $creation_reussi_date = true ; // pas de prise en compte de la requete mais pas d'erreur de fonctionnment
         }
       }  // fin boucle foreach insertion des dates dans la base de données*****
          //********************************************************************
     }    // fin fonctionnement avec base de données ***************************
          //********************************************************************


      //***********************************************************************
      // fonctionnement sans base de données  - ajout
      //***********************************************************************
      
      else {
      // boucle de marquage des dates pour le ou les locations selectionnées 1 par 1 ****
      foreach ( $tableau_requete as $cle => $nom_logement_requete ) {
      //recupération des dates pour le logement en cours de traitement *********
      unset($tableau_reservation); // réinitialisation des variables tableau ***
      require($chemin_admin."fichier_calendrier/dates_sans_bdd/".$cle."_calendrier.php");
      
      //initialisation liste requete*****************************************
      $nb_jour_a_marquer = nb_jour_date ($date_debut,$date_fin,"/","fr") + 1;
      $commentaire = ( isset($tableau_locataire[8]) ) ?  guillet_var ($tableau_locataire[8]) : '' ;

      //***********************************************************************************************
      // controle si date de couleur indisponible existe dans le calendrier pour la période voulue ****
      //***********************************************************************************************
      
      $date_boucle      = $date_debut_eng ;

      for ( $i = 1; $i <= $nb_jour_a_marquer; $i++ ) {
          if ( isset($tableau_reservation[$cle][$date_boucle]) ) {
               list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$tableau_reservation[$cle][$date_boucle]);
               if ( !$date_couleur_disponible[$couleur_texte_temp] )
                     $couleur_indisponible_existe = true ;
          }
          $date_boucle = ajout_jour_date ($date_boucle,1,"JMA","-","eng") ;
     }

     if ( !$couleur_indisponible_existe || !$ctrl_date_existe ) { // s'il n'y pas de couleur indisponible ****
      $date_boucle      = $date_debut_eng ;

      //controle si le fichier est disponible pour écriture *****************
      $fichier_libre = false;
      $chemin_fichier = $chemin_admin.'fichier_calendrier/dates_sans_bdd/'.$cle.'_calendrier.php';
      $chemin_fichier_sauvegarde = $chemin_admin.'fichier_calendrier/dates_sans_bdd/'.$cle.'_sauvegarde_calendrier.php';
      $pointeur_variable_fin_fichier_ok = 'fin_tableau_reservation_'.$cle;
      unset($$pointeur_variable_fin_fichier_ok);

      while (!isset($$pointeur_variable_fin_fichier_ok)  || !$$pointeur_variable_fin_fichier_ok) {
        include ($chemin_fichier);
        if ( isset($$pointeur_variable_fin_fichier_ok)  && $$pointeur_variable_fin_fichier_ok ) {
        //sauvegarde ancien fichier*********************************
        @copy($chemin_fichier,$chemin_fichier_sauvegarde);
        $file= @fopen($chemin_fichier, "w");
        $fichier_libre = true;
        }
      }

      if ( !$couleur_invisible[$couleur] ) {
        //effacement des dates eventuellement déjà marquées ********************
        for ( $i = 1; $i <= $nb_jour_a_marquer; $i++ ) {
          if ( isset($tableau_reservation[$cle][$date_boucle]) ) {
               unset($tableau_reservation[$cle][$date_boucle]);
          }
           $date_boucle = ajout_jour_date ($date_boucle,1,"JMA","-","eng") ;
          }
       }// fon ctrl couleur invisible ***
       $date_boucle      =  $date_debut_eng ;

       for ( $i = 1; $i <= $nb_jour_a_marquer; $i++ ) {
         $tableau_reservation[$cle][$date_boucle] = $couleur_reserve[$couleur]."%&%".$couleur."%&%".$num_pointeur_max."%&%".$tarif."%&%".guillet_var ($commentaire);
         $date_boucle = ajout_jour_date ($date_boucle,1,"JMA","-","eng") ;
       }
       // mise a jour du fichier *********************************************
       $vecteur_index_logement = $cle;
       $chemin_vers_fichier = $chemin_admin;
       define ("AUTOR_FCT_GEN_CALENDRIER", true);
       if ( $fichier_libre)
           require($chemin_admin."genere/genere_tableau_calendrier.php");
       $creation_reussi_date = ( isset($creation_reussi) ) ? $creation_reussi: false ;
	   // mise à jour ical
		 if ( $creation_reussi_date ) {
				$vecteur_index_logement = $cle;
				@define ("AUTOR_FCT_SAUVEGARDE", true);
				include($chemin_admin."genere/genere_export_ical.php");
			}
       
       }  // fin traitement controle si couleur indisponible existe dans la période
          //********************************************************************
      
       else {
          if ( $affiche_erreurs )
           echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> Les dates n\'ont pas pu être enregistrée car il y a déjà des jours indisponibles dans cette periode!</font><br><br> ';
          $creation_reussi_date = false ; // pas de prise en compte de la requete mais pas d'erreur de fonctionnment
          }
        } // fin boucle foreach insertion des dates sans la base de données*****
          //********************************************************************

     }    // fin fonctionnement avec base de données ***************************
          //********************************************************************

     if ( !$creation_reussi_date && $affiche_erreurs )
         echo  "Erreur d'execution pour l'insertion des dates<br><br><br>";
     if ( !$creation_reussi_locataire && $affiche_erreurs )
         echo  "Erreur d'execution pour l'insertion du locataire<br><br><br>";

    }
    $creation_reussi = ( ($creation_reussi_date && $creation_reussi_locataire) || MODE_DEMO) ? true : false ;
    if ( MODE_DEMO )
      echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> Mode de démonstration activée, fonctionnalitées limittés</font><br><br> ';

return ($creation_reussi);

 }
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

//**************************************************************************************************
// compression zip de répertoire
// la fonction comprime le répertoire donnée en parametres
// parametres :
// $path      : chemin relatif jusqu'au répertoire à compresser
//**************************************************************************************************

function zipDir($path,&$zip)
{
   
   if (!is_dir($path)) return;
   
   if (!($dh = @opendir($path))) {
      echo("<b>ERREUR: Une erreur s'est produite sur ".$path."</b><br />");
      return;
   }
   while ($file = readdir($dh)) {
     
      if ($file == "." || $file == ".." || $file == "sauvegarde.zip" ) continue; // Throw the . and .. folders
      if (is_dir($path."/".$file)) { // Recursive call
         zipDir($path."/".$file,$zip,$i);   
      } elseif (is_file($path."/".$file)) { // If this is a file then add to the zip file
         
         $zip->addFile(file_get_contents($path."/".$file),$path."/".$file);
         //echo('fichier '.$path.'/'.$file.' ajouté<br>');
      }
      }
}

//**************************************************************************************************
// controle de disponibilité dans la date
// parametres :
// $chemin_admin     : chemin relatif depuis l'endroit d'appel de la fonction jusqu'au répertoire admin du calendrier
// $id_logement_marquer: numéro id de la location a marquer
// $date_debut       : date de debut de recherche format JJ/MM/AAAA
// $date_fin         : date de fin de recherche format JJ/MM/AAAA
// nb_max_jour       : nombre maximum de jours successifs pouvant être marqués
//                     non disponible alors les dates indiquées ne sont pas enregistrées dans le calendrier
// $affiche_erreurs  : affiche les erreurs eventuelles ( format date, date fin anterieur date debut)
// La fonction retourne TRUE s'il tous les jours de l'interval sont libres
//**************************************************************************************************
 function controle_dispo_date($chemin_admin,$id_logement_marquer,$date_debut,$date_fin,$nb_max_jour,$affiche_erreurs ) {
  //intialisation de variables ******************************
  $creation_reussi_date      = true;
  $creation_reussi_locataire = false;
  $couleur_indisponible_existe = false ;
  $ctrl_date_existe			= true ;
  
 //inclusion du fichier connexion ***************************
  require ($chemin_admin."genere/connexion.php");
 //inclusion liste des couleurs ****************************
  require ($chemin_admin."fichier_calendrier/calendrier_liste_couleur.php");
 //inclusion liste des locations ****************************
  require ($chemin_admin."fichier_calendrier/calendrier_liste_logement.php");
 //inclusion liste des locations ****************************
  require ($chemin_admin."fichier_calendrier/calendrier_liste_locataire.php");
 //inclusion liste des locations ****************************
  require ($chemin_admin."fichier_calendrier/parametres_calendrier.php");


  //*******************************************************************************
  //gestion des dates *************************************************************
  //*******************************************************************************

  if ( $avec_diagonale_cellule )
       $date_fin = jour_precedent ($date_fin,"/","fr");

   $test_post_debut = test_date_fr ($date_debut);
   $test_post_fin = test_date_fr ($date_fin);

  if (  $test_post_debut==0 && $test_post_fin==0 )
    //test pour eviter de marquer un nombre de jour reservé trop important > nb_max_jour jours
    $compare_date = nb_jour_date ($date_debut,$date_fin,"/","fr");
  elseif ( $affiche_erreurs)
    echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> *** Le format des dates ne sont pas conforme, ils doivent être JJ/MM/AAAAA</font><br><br>';
  // controle nombre maximum de jours a marquer ******************
  if ( $compare_date > $nb_max_jour && $affiche_erreurs )
    echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> Les dates n\'ont pas pu être enregistrée car l\'intervalle est trop grand !</font><br><br> ';
  if ( $compare_date < 0 && $affiche_erreurs )
    echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> Les dates n\'ont pas pu être enregistrée car la date de fin est antérieure à la date de début!</font><br><br> ';

  if (  $test_post_debut==0 && $test_post_fin==0 && $compare_date >= 0  && $compare_date <= $nb_max_jour && !MODE_DEMO) {

      $date_debut_eng   = ajout_supprime_zero (date_fr_eng($date_debut,"/","-"),"Ajout","-","eng");
      $date_fin_eng     = ajout_supprime_zero (date_fr_eng($date_fin,"/","-"),"Ajout","-","eng");

      $tarif = str_replace(",",".",$tarif_logement[$id_logement_marquer]);  // transformation des virgules en . pour les chiffres

      // initialisation de variables ******************************************
      unset($tableau_requete);  // initialisation du tableau des logements a marqués***

      //***********************************************************************
      // liste des locations  marquer *****************************************
      //***********************************************************************
      // attention marquage tous est forcé a false !!! ************************
      if ( isset($marquer_tous) && $marquer_tous == 'oui' && TOUJOURS_FALSE ) {// si marquage de toutes les locations
          $tableau_requete = $nom_logement ;   // tableau des locations = toutes les locations
          unset($tableau_requete[0]); // suppression index logement tous ******
          }
      else
          $tableau_requete[$id_logement_marquer] = $nom_logement[$id_logement_marquer];  // tableau des locations = toutes les locations

      //***********************************************************************
      // fonctionnement avec base de données
      //***********************************************************************
      
      if ( AVEC_BDD ) {
      //connection a la base de donnees*******************************************************************
      $connect = @mysql_connect(Decrypte(hote_cal,"calendrier"), Decrypte(user_cal,"calendrier"), Decrypte(password_cal,"calendrier")) ;
      if ( !$connect && $affiche_erreurs )
         echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> *** Erreur de connexion au serveur sql<br><br>';
      $connect_base = @mysql_select_db(Decrypte(base_cal,"calendrier"), $connect);
      if ( !$connect_base && $affiche_erreurs )
         echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> *** Erreur de connexion à la base sql<br><br>';
      // boucle de marquage des dates pour le ou les locations selectionnées 1 par 1 ****
      foreach ( $tableau_requete as $cle => $nom_logement_requete ) {

      //initialisation liste requete*****************************************
      $date_boucle      = $date_debut_eng ;
      $tri_logement_req = ", '".$cle."'" ;
      $tri_logement_req2 = " and id_logement = '".$cle."'" ;
      $tri_locataire2   = ", '".$num_pointeur_max."'";
      $liste_couleur_req = '';
      $liste_query = '';
      $compare_date = nb_jour_date ($date_debut,$date_fin,"/","fr");
      $commentaire = ( isset($tableau_locataire[8]) ) ?  addslashes(nl2br($tableau_locataire[8])) : '' ;

      //***********************************************************************************************
      // controle si date de couleur indisponible existe dans le calendrier pour la période voulue ****
      //***********************************************************************************************
      
      //liste des couleurs dites dates indisponibles **********************
      if ( isset($date_couleur_disponible) && $ctrl_date_existe ) {
          foreach ($date_couleur_disponible as $cle => $disponible ) {
              if ( !$disponible ) {
                if ( $liste_couleur_req == '' ) 
                     $liste_couleur_req .= ' and ( ';
                else
                     $liste_couleur_req .= ' OR ';
                 $liste_couleur_req .= " couleur_texte = '$cle' ";
              }
          }
         if ( $liste_couleur_req <> '' )
              $liste_couleur_req .= ' ) ';
      }

      // recherche si des dates avec couleurs indisponible sont deja marquées dans la base *************
      $req_ctrl = "SELECT * from ".Decrypte(nom_table_cal,"calendrier")." where date_reservation >= '$date_debut_eng' and date_reservation <= '$date_fin_eng' $tri_logement_req2 $liste_couleur_req" ;
      $requete = @mysql_query($req_ctrl );  // echo $req_ctrl;
      $nj_jour = mysql_num_rows($requete);

      if ( $nj_jour == 0 || !$ctrl_date_existe ) {  // marquage des jours si le controle date est hors service ou si controle date ok

         }  // fin boucle marquage si controle date ok *************************
            //******************************************************************
      else {
          if ( $affiche_erreurs )
          echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> Les dates n\'ont pas pu être enregistrée car il y a déjà des jours indisponibles dans cette periode! </font><br><br>';
          $creation_reussi_date = false ; // pas de prise en compte de la requete mais pas d'erreur de fonctionnment
         }
       }  // fin boucle foreach insertion des dates dans la base de données*****
          //********************************************************************
     }    // fin fonctionnement avec base de données ***************************
          //********************************************************************


      //***********************************************************************
      // fonctionnement sans base de données  - ajout
      //***********************************************************************
      
      else {
      // boucle de marquage des dates pour le ou les locations selectionnées 1 par 1 ****
      foreach ( $tableau_requete as $cle => $nom_logement_requete ) {
      //recupération des dates pour le logement en cours de traitement *********
      unset($tableau_reservation); // réinitialisation des variables tableau ***
      require($chemin_admin."fichier_calendrier/dates_sans_bdd/".$cle."_calendrier.php");
      
      //initialisation liste requete*****************************************
      $nb_jour_a_marquer = nb_jour_date ($date_debut,$date_fin,"/","fr") + 1;
      $commentaire = ( isset($tableau_locataire[8]) ) ?  guillet_var ($tableau_locataire[8]) : '' ;

      //***********************************************************************************************
      // controle si date de couleur indisponible existe dans le calendrier pour la période voulue ****
      //***********************************************************************************************
      
      $date_boucle      = $date_debut_eng ;

      for ( $i = 1; $i <= $nb_jour_a_marquer; $i++ ) {
          if ( isset($tableau_reservation[$cle][$date_boucle]) ) {
               list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$tableau_reservation[$cle][$date_boucle]);
               if ( !$date_couleur_disponible[$couleur_texte_temp] )
                     $couleur_indisponible_existe = true ;
          }
          $date_boucle = ajout_jour_date ($date_boucle,1,"JMA","-","eng") ;
     }

     if ( !$couleur_indisponible_existe || !$ctrl_date_existe ) { // s'il n'y pas de couleur indisponible ****
      
       
       }  // fin traitement controle si couleur indisponible existe dans la période
          //********************************************************************
      
       else {
          if ( $affiche_erreurs )
           echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> Les dates n\'ont pas pu être enregistrée car il y a déjà des jours indisponibles dans cette periode!</font><br><br> ';
          $creation_reussi_date = false ; // pas de prise en compte de la requete mais pas d'erreur de fonctionnment
          }
        } // fin boucle foreach insertion des dates sans la base de données*****
          //********************************************************************

     }    // fin fonctionnement avec base de données ***************************
          //********************************************************************

     if ( !$creation_reussi_date && $affiche_erreurs )
         echo  "Erreur d'execution pour l'insertion des dates<br><br><br>";
     if ( !$creation_reussi_locataire && $affiche_erreurs )
         echo  "Erreur d'execution pour l'insertion du locataire<br><br><br>";

    }
    $creation_reussi = ( ($creation_reussi_date && $creation_reussi_locataire) || MODE_DEMO) ? true : false ;
    if ( MODE_DEMO )
      echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> Mode de démonstration activée, fonctionnalitées limittés</font><br><br> ';

return ($creation_reussi_date);

 }
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************


//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************
// import ical
// paramètres :
// $url 	: url du flux ical
// valeur retour :
// return : valeur du fichier ical au format tableau 
//			$tableau[1][BEGIN] = VCALENDAR
//						[VERSION] = 2.0
//						[CALSCALE] = GREGORIAN
//						[PRODID] = -fournisseur
//			$tableau[$id][BEGIN] = VEVENT
//						[UID] = xxxxxxxx
//						[DTSTAMP] = 20170507T124557Z 
//						['date_debut'] = AAAA/MM/JJ
//						['heure_debut'] = 'hh:mm:ss'
//						[DTSTART] = 20160727T160000Z
//						[DTEND] = 20160731T110000Z
//						['date_fin'] = AAAA/MM/JJ
//						['heure_fin'] = 'hh:mm:ss'
//						[SUMMARY] = xxxxx
//						[END] = VEVENT 
// tableau global avec les dates de début et fin agrégé entre plusieurs appel de la fonction
//$tableau_ics_global[AAAA/MM/JJ]['nb_jours']	: nombre jours de la réservation
//$tableau_ics_global[AAAA/MM/JJ]['date_fin']	: date de fin de la réservation
//$tableau_ics_global[AAAA/MM/JJ]['site']       : nom du site originaire du cal ical
//$ics_url										: nom du site originaire du cal ical

function recupere_ics($url) {
	
	global $affiche_info,$tableau_ics_global, $ics_url,$erreur_fonction,$tableau_affiche_info;
	
	$erreur_fonction 		= false ;
	$tableau_ics_global		= '';
	$affiche_info			= '';
	$ics_url				= nom_domaine($url); // la fonction insertion ajoute entre parenthèse l'id de l'ical propre à la ressource
	
	//contrôle adresse ics 
	$url_explode 			= explode ('?',$url);  
	/*if ( substr(trim($url_explode[0]),-4) <> '.ics' && substr(trim($url[0]),-5) <> '.ical' ) {  // attention certains sites n'ont pas toujours un fichier extension ical
		$affiche_info 		= "erreur_format_ical";
        $erreur_fonction 	= true ;
	}*/
	 
	if ( !$erreur_fonction ) {
	
		//$contenu = @file_get_contents($url); // echo $contenu; // utilisation unique de curl pour avoir le header
		$contenu = false ;
		// test récupération du contenu du fichier ical
		if ( $contenu === false ) {
		//if ( $contenu  ) {
			
			//test avec Curl
			$contenu_curl = '';
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);//
			@curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // rajout option pour les sites en https 
			@curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // rajout option pour les sites en https 

			$user_agent = 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0';
			curl_setopt($curl, CURLOPT_HEADER, 1);
			curl_setopt($curl, CURLOPT_TIMEOUT, 15);
			curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($curl, CURLOPT_COOKIESESSION, true);
			curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
			curl_setopt($curl, CURLOPT_HTTPHEADER,array('Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
														'Accept-Encoding: identity',
														'Accept-Language: fr-FR,fr;q=0.8,en-US;q=0.6,en;q=0.4',
														'Cache-Control: max-age=0',
														'Connection: keep-alive',
														'Keep-Alive: 300'
													));
			  			  
			$contenu_curl 	= @curl_exec($curl); 
			$httpStatus 	= @curl_getinfo($curl, CURLINFO_HTTP_CODE);
			$url_type		= @curl_getinfo($curl, CURLINFO_CONTENT_TYPE); // echo $url_curl; // text/calendar  $nb_liens = substr_count($contenu_curl, 'href="'.$lien)
			//$url_header		= @curl_getinfo($curl, CURLINFO_HEADER_OUT);  echo $url_header; //filename="listing-7847676.ics"
			$errno 			= @curl_errno($curl);
			curl_close($curl);
			
			// test si données de type calendrier
			$test_type 		= substr_count($url_type, 'text/calendar'); 
			if ( $test_type == 0 ) {  // attention certains sites n'ont pas toujours un fichier extension ical - ce test ne passe pas pour booking
				$affiche_info 		= "erreur_format_ical";
				$erreur_fonction 	= true ; 
				return;
				}
			
			if ( $httpStatus === 200 ) {
				$contenu		= $contenu_curl;
				}
			else {
				$affiche_info 		= "erreur_ouverture_ical";
				$erreur_fonction 	= true ;
				}
				
		}
		
		// extraction contenu 
		if ( !$erreur_fonction ) { // récupération réussie
			
			//création tableau pour chaque délimiteur begin - $tableau_evenement[0]-header http | $tableau_evenement[1]-header ical | $tableau_evenement[x]-evenements ical
			$tableau_evenement = explode("BEGIN:", $contenu); // afficher_tableau($tableau_evenement); exit;

			//suppression header http
			if ( isset($tableau_evenement[0]))
				unset($tableau_evenement[0]);  
			
			// test header ical
			$test_type 		= substr_count(strtoupper($tableau_evenement[1]), 'VCALENDAR'); 
			if ( $test_type == 0 ) {  // attention certains sites n'ont pas toujours un fichier extension ical
				$affiche_info 		= "erreur_format_ical";
				$erreur_fonction 	= true ;
				return;
				}   
			
			//suppression header ical
			if ( isset($tableau_evenement[1]))
				unset($tableau_evenement[1]);  
			
			// boucle pour chaque evenement on cree un sous tableau avec le contenu de chaques lignes ( détail de l'événement)
			foreach($tableau_evenement as $cle => $value) {   // cle = id evement 
				$tableau_lignes[$cle] = explode("\n", $value);
			}   //afficher_tableau($tableau_lignes);

			foreach($tableau_lignes as $cle => $value) {   // $tableau_lignes[id_evenement][lignes_evenement]
				foreach($value as $cle2 => $valeur) {
				if ($valeur != "") {
					if ($cle != 0 && $cle2 == 0) {
					$icsDates[$cle]["BEGIN"] = $valeur;
					} 
					else {
					$item_index 	= explode(":", $valeur, 2);
					$item_principal	= explode(";", $item_index[0]);
					if ( isset($item_index[1])) {
					$icsDates[$cle][$item_principal[0]] = $item_index[1];
					$temp			= explode ('t',strtolower($item_index[1]));
					if ( $item_principal[0]== 'DTSTART') {
						$icsDates[$cle]['date_debut'] 	= substr($temp[0],0,4).'-'.substr($temp[0],4,2).'-'.substr($temp[0],6,2);
						if ( isset($temp[1]) )
							$icsDates[$cle]['heure_debut'] 	= substr($temp[1],0,2).':'.substr($temp[1],2,2).':'.substr($temp[1],4,2);
						}
					else if ( $item_principal[0] == 'DTEND') {
						$icsDates[$cle]['date_fin'] 	= substr($temp[0],0,4).'-'.substr($temp[0],4,2).'-'.substr($temp[0],6,2);
						if ( isset($temp[1]) )
							$icsDates[$cle]['heure_fin'] 	= substr($temp[1],0,2).':'.substr($temp[1],2,2).':'.substr($temp[1],4,2);
						}
					}
					}
				}
				}
			// comparaison pour filtrer et conserver que les dates postérieurs à aujourd'hui
			if ( isset($icsDates[$cle]['date_fin'],$icsDates[$cle]['date_debut']) 
				 && ( comparaison_date($icsDates[$cle]['date_fin'],date('Y-m-d'),'superieur','-','eng')  // suppression des dates antérieurs
				 || $icsDates[$cle]['date_debut'] == date('Y-m-d') && $icsDates[$cle]['date_fin'] ==  ajout_jour_date (date('Y-m-d'),1,'JMA','-','eng') )  // suppression dates avec date début aujourd'hui et de fin demain ( dates bloquées par défaut car il est trop tard pour réserver)
				 || ( isset($icsDates[$cle]['BEGIN']) && (strtoupper($icsDates[$cle]['BEGIN'])) == 'VCALENDAR') ) // suppression entete
				unset ($icsDates[$cle]);
				
			else if (isset($icsDates[$cle]['date_fin'],$icsDates[$cle]['date_debut']))  {
				// creation du tableau global agrégateur
				$test_date_debut	= test_date_eng ($icsDates[$cle]['date_debut']);  //echo $valeur['date_debut'];
				$test_date_fin		= test_date_eng ($icsDates[$cle]['date_fin']);  //echo $valeur['date_debut'];
				if ( $test_date_debut == 0 && $test_date_fin == 0 ) {
					$date_boucle 	= $icsDates[$cle]['date_debut'];
					//$compare_date 	= nb_jour_date ($icsDates[$cle]['date_debut'],ajout_jour_date ($icsDates[$cle]['date_fin'],-1,"JMA","-","eng"),"-","eng"); //echo $compare_date;
					$compare_date 	= 1; //echo $compare_date;
					while ( $compare_date > 0 ) {
					  //$tableau_ics_global[$date_boucle] 		= $compare_date.'%&%'.$icsDates[$cle]['date_fin'].'%&%'.$ics_url;
					  $tableau_ics_global[$date_boucle]['nb_jours']	= $compare_date;
					  $tableau_ics_global[$date_boucle]['date_fin']	= $icsDates[$cle]['date_fin'];
					  $tableau_ics_global[$date_boucle]['site']		= $ics_url;
					  $date_boucle  = ajout_jour_date ($date_boucle,1,"JMA","-","eng");
					  $compare_date = nb_jour_date ($date_boucle,$icsDates[$cle]['date_fin'],"-","eng");
					  }
					}
			}
			} //	afficher_tableau($icsDates);
			return $icsDates;
			}
		}
    return false;
}


//**************************************************************************************************
// module insertion date et locataire depuis formulaire visiteur
// la fonction retourne un tableau avec la liste des locations disponibles
// parametres :
// $chemin_admin     : chemin relatif depuis l'endroit d'appel de la fonction jusqu'au répertoire admin du calendrier
// $id_logement_marquer: numéro id de la location a marquer
// couleur           : numéro id de la couleur du marqueur pour la période a marquer
// nb_max_jour       : nombre maximum de jours successifs pouvant être marqués
// ctrl_date_existe  : si true alors, si dans l'intervalle date debut/date fin , il y a au moins une date de couleur dites
//                     non disponible alors les dates indiquées ne sont pas enregistrées dans le calendrier
// $affiche_erreurs  : affiche les erreurs eventuelles ( format date, date fin anterieur date debut)
// $tableau_date_ical: tableau avec les dates au format ical selon la fonction recupere_ics($url)
// La fonction retourne TRUE si les dates ont étaient marquées
//**************************************************************************************************
 function insertion_date_ical2($chemin_admin,$id_logement_marquer,$couleur,$nb_max_jour,$ctrl_date_existe,$affiche_erreurs,$tableau_date_ical ) {

	$creation_reussi	= false;
	// test tableau ical
	if ( isset($tableau_date_ical) && is_array($tableau_date_ical) ) {
		
		// liste de toutes les réservations
		foreach ( $tableau_date_ical as $cle => $valeur) {
			// test des dates
			$test_date_debut	= test_date_eng ($valeur['date_debut']);  //echo $valeur['date_debut'];
			$test_date_fin		= test_date_eng ($valeur['date_fin']);  //echo $valeur['date_debut'];
			$tableau_locataire[0] = $_POST['nom'] ;          // nom de famille du locataire
			$tableau_locataire[1] = $_POST['prenom'] ;       // prénom du locataire
			$tableau_locataire[2] = '' ;                     // téléphone locataire
			$tableau_locataire[3] = '' ;                     // email locataire
			$tableau_locataire[4] = '' ;                     // adresse locataire
			$tableau_locataire[5] = '' ;                     // code postal locataire
			$tableau_locataire[6] = '' ;                     // commune locataire
			$tableau_locataire[7] = '' ;                     // pays locataire
			$tableau_locataire[8] = $_POST['commentaire'] ;  // infobulle dates,
			$tableau_locataire[9] = false ;                  // inscription mailing liste locataire
			if ( $test_date_debut == 0 && $test_date_fin == 0 ) {
				$creation_reussi 	= insertion_date($chemin_admin,$id_logement_marquer,date_eng_fr ($valeur['date_debut'],'-','/'),date_eng_fr ($valeur['date_fin'],'-','/'),'',false,$couleur,$nb_max_jour,$ctrl_date_existe,$affiche_erreurs);
			}
		}
		
	return ($creation_reussi);	
	}
	else {
		$affiche_info 		= "erreur_ouverture_ical";
		$erreur_fonction 	= true ;
		}
	return false;
 }
 
 //**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

//**************************************************************************************************
// fonction de synchronisation de calendrier pour 1 ou plusieurs ressources
// $id_logement : numéro id de la location a synchroniser , si = 0 synchronise toutes les locations ## ATTENTION ## dans ce cas il faut toutes les locations aient une url ical valide !!!
// $chemin_admin: chemin depuis la racine du site jusqu'au répertoire admin sans slash de fin ex : le répertoire admin est dans httpp://www.xxx.fr/logiciels/calendrier/admin/ -> /logiciels/calendrier
// La fonction retourne TRUE si la synchro a réussie
// Principe :
// 1. il télécharge les ical et fait le scontrôles de base ( header http / header ical)
// 2. il crée (si cela n'est pas encore le cas) un nouveau locataire avec le nom de domaine du fichier ical
// 3. il va supprimer toutes les réservations de ce locataire et donc la date est postérieur à aujourd'hui
// 4. il faut scanner toutes les dates du fichier ical, vérifie si la date est disponible dans le script ( pas marquées ou d'une couleur disponible)
// 5. si la dates est disponible il l'ajoute et la lie au locataire ical
//**************************************************************************************************
 function synchronisation_ical($chemin_admin,$id_logement) {

	global $tableau_ics_global,$ics_url,$affiche_info,$_SERVER,$erreur_fonction,$tableau_affiche_info;
		
	// initialisation de variables
	$tableau_ressources	= '';
	$chemin_admin		= $_SERVER['DOCUMENT_ROOT'].$chemin_admin;  
	
	if (is_numeric($id_logement)) {
		//echo $_SERVER['DOCUMENT_ROOT']; 
		//récupération du fichier avec la liste des ressources
		require ($chemin_admin."/admin/fichier_calendrier/calendrier_liste_logement.php");
		require ($chemin_admin."/admin/fichier_calendrier/calendrier_liste_couleur.php");
		
		//contrôle si couleur par defaut ical existe déjà ou pas
		$couleur_defaut_ical = 0;
		if ( isset($date_couleur_synchro) && is_array($date_couleur_synchro) ) {
			foreach ( $date_couleur_synchro as $id_couleur => $etat_couleur ) {
			  if ( $etat_couleur) $couleur_defaut_ical = $id_couleur;
				}
		   }
		if ( $couleur_defaut_ical == 0 ) {
			$affiche_info 		= "erreur_couleur_defaut_ical";
			$erreur_fonction 	= true ;
			return false;
			}
		
		if (!isset($nom_logement) || !is_array($nom_logement)) {  // test si la liste est correcte
			$affiche_info 		= "erreur_liste_logement";
			$erreur_fonction 	= true ;
			return false;
			}
		else if ( $id_logement == 0 )	// récupération de toutes les ressources
			foreach ( $nom_logement as $cle_id => $nom_ressource) {
				$tableau_ressources[]	= $cle_id; 
				if( isset($tableau_ressources[0]) )
					unset($tableau_ressources[0]);
				}
		else 
			$tableau_ressources[]	= $id_logement;  
		
		//traitement synchro pour la liste de ressources
		if ( isset($tableau_ressources,$url_synchro_logement) && is_array($tableau_ressources)  ) {
		$insert = false;	
			foreach ( $tableau_ressources as $cle_id => $id_ressource) {
				if ( is_array($url_synchro_logement[$id_ressource])  ) {
				foreach ( $url_synchro_logement[$id_ressource] as $cle => $url) {
						
						$tab_ical 	= recupere_ics($url); 
						
						$ics_url	.= '(ress:'.$cle_id.'-ical:'.$cle.')';
						
						// test si erreur sur fonction recupere_ics
						if ( isset($affiche_info) && $affiche_info <> '' ) {
							$erreur_fonction 	= true ;
							return false;
							}
							
						if (is_array($tab_ical)) {
							//afficher_tableau($tab_ical);
							//afficher_tableau($tableau_ics_global);
							// ################  renseigner les paramètres de la location ###############################
							// insertion_date_ical($chemin_admin,$id_logement_marquer,$couleur,$nb_max_jour,$ctrl_date_existe,$affiche_erreurs,$tableau_date_ical )
							$insert =  insertion_date_ical($chemin_admin,$id_ressource,$couleur_defaut_ical,true,$tableau_ics_global,$ics_url );
							}
						else {
							$affiche_info 		= "erreur_sycnhro_fichier_vide";
							$erreur_fonction 	= true ;
							return false;
							}
						}
					}
					else {
						$affiche_info 		= "erreur_manque_url_sycnhro";
						$erreur_fonction 	= true ;
						return false;
						}

				}
			//modification ok
			$affiche_info 		= "synchronisation_ok";
			$erreur_fonction 	= false ;
			return ($insert);
			}
	}
	else {
		$affiche_info 		= "erreur_liste_logement";
		$erreur_fonction 	= true ;
		return false;
		}
 }
 
 //**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

//**************************************************************************************************
// module insertion date et locataire depuis formulaire visiteur
// la fonction retourne un tableau avec la liste des locations disponibles
// parametres :
// $chemin_admin     : chemin relatif depuis l'endroit d'appel de la fonction jusqu'au répertoire admin du calendrier
// $id_logement_marquer: numéro id de la location a marquer
// couleur           : numéro id de la couleur du marqueur pour la période a marquer
//                     non disponible alors les dates indiquées ne sont pas enregistrées dans le calendrier
// $affiche_erreurs  : affiche les erreurs eventuelles ( format date, date fin anterieur date debut)
// $tableau_date_ical: tableau avec les dates au format ical selon la fonction recupere_ics($url), variable global $tableau_ics_global
// $tableau_date_ical: tableau avec les dates au format ical selon la fonction recupere_ics($url), variable global $ics_url
// La fonction retourne TRUE si les dates ont étaient marquées
//**************************************************************************************************
 function insertion_date_ical($chemin_admin,$id_logement_marquer,$couleur,$affiche_erreurs,$tableau_date_ical,$ics_url) {
  
	global $affiche_info,$tableau_affiche_info;
  
  //intialisation de variables ******************************
  $creation_reussi_date      = false;
  $creation_reussi_locataire = false;
  $couleur_indisponible_existe = false ;
 //inclusion du fichier connexion ***************************
  require ($chemin_admin."/admin/genere/connexion.php");
 //inclusion liste des couleurs ****************************
  require ($chemin_admin."/admin/fichier_calendrier/calendrier_liste_couleur.php");
 //inclusion liste des locations ****************************
  require ($chemin_admin."/admin/fichier_calendrier/calendrier_liste_logement.php");
 //inclusion liste des locations ****************************
  require ($chemin_admin."/admin/fichier_calendrier/calendrier_liste_locataire.php");
  //inclusion liste des langues ****************************
  require ($chemin_admin."/admin/fichier_calendrier/langue.php");
 //inclusion liste des locations ****************************
  require ($chemin_admin."/admin/fichier_calendrier/parametres_calendrier.php");
  $avec_diagonale_cellule 	= true ;   // force à 1 car icla fonctionne avec cette méthode

  // fonction locataire - l'import ical crée un locataire/client qui s'appel ical 
  $ajout_locataire 			= true;
  $tableau_locataire[0]		= $ics_url;
  $tableau_locataire[1]		= "Ical";
  $tableau_locataire[2] 	= '' ;                     // téléphone locataire
  $tableau_locataire[3] 	= '' ;                     // email locataire
  $tableau_locataire[4] 	= 'Client synchronisation ical ' ;                     // adresse locataire
  $tableau_locataire[5] 	= '' ;                     // code postal locataire
  $tableau_locataire[6] 	= '' ;                     // commune locataire
  $tableau_locataire[7] 	= '' ;                     // pays locataire
  $tableau_locataire[8] 	= 'Client synchronisation ical' ;  // infobulle dates,
  $tableau_locataire[9] 	= false ;                  // inscription mailing liste locataire
  
  
  if ( $ajout_locataire && !MODE_DEMO ) {
  //controle si le locataire existe deja **************************
  $locataire_existe = false;
  $num_pointeur_max = 0;
  $nom_minuscule    = strtolower(suppr_accents($tableau_locataire[0]));
  $prenom_minuscule = strtolower(suppr_accents($tableau_locataire[1]));
  foreach ( $nom_locataire as $cle => $val_nom_locataire ) {
    if ( $cle <> 0 && $ajout_locataire) {
      $nom_minuscule_fichier    = strtolower(suppr_accents($nom_locataire[$cle]));
      $prenom_minuscule_fichier = strtolower(suppr_accents($prenom_locataire[$cle]));
      //controle si le locataire est deja dans la base de données ***************
      if ($nom_minuscule_fichier == $nom_minuscule && $prenom_minuscule_fichier == $prenom_minuscule )  {
        $locataire_existe = true ;
        $creation_reussi_locataire = true ;
        $num_pointeur_max = $cle;
      }
     }
  }// fin foreach locataire
  }
  
  // si le locataire n'existe pas dans le fichier il sera ajouté ****
  if ( !$locataire_existe && $ajout_locataire && $tableau_locataire[0] <> '' && !MODE_DEMO) {
      $fichier_libre  = false;
      $fin_tableau_locataire = false ;
      $chemin_fichier = $chemin_admin."/admin/fichier_calendrier/calendrier_liste_locataire.php";
      $chemin_fichier_sauvegarde = $chemin_admin."/admin/fichier_calendrier/sauvegarde_calendrier_liste_locataire.php";

      while (!isset($fin_tableau_locataire)  || !$fin_tableau_locataire) {  // controle que le fichier est disponible
        include ($chemin_fichier);
        if ( isset($fin_tableau_locataire)  && $fin_tableau_locataire ) {
        //sauvegarde ancien fichier*********************************
        @copy($chemin_fichier,$chemin_fichier_sauvegarde);
        $file= @fopen($chemin_fichier, "w");
        $fichier_libre = true;
        $fonction = 'Ajout_formulaire';
        }
       }

      // mise a jour du fichier locataire **************************************
      @define ("AUTOR_FCT_GEN_LOCATAIRE", true);
      if ( $fichier_libre )
         //chemin vers le fichier de création liste des locataires/logements**********************************************************
         require($chemin_admin."/admin/genere/genere_listes_locataire.php");
      $creation_reussi_locataire = $creation_reussi ;
  }
    else
      $creation_reussi_locataire = true ;   // il ne faut aps ajouter le locataire***
  
  //*******************************************************************************
  //gestion des dates *************************************************************
  //*******************************************************************************
  
  // test tableau ical
	if ( isset($tableau_date_ical) && is_array($tableau_date_ical) && $creation_reussi_locataire) {
  
    //***********************************************************************
    // fonctionnement avec base de données
    //***********************************************************************
    
	$creation_reussi_date = true;
	
    if ( AVEC_BDD ) {
    //connection a la base de donnees*******************************************************************
    $connect = @mysql_connect(Decrypte(hote_cal,"calendrier"), Decrypte(user_cal,"calendrier"), Decrypte(password_cal,"calendrier")) ;
    if ( !$connect && $affiche_erreurs )
        echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> *** Erreur de connexion au serveur sql<br><br>';
    $connect_base = @mysql_select_db(Decrypte(base_cal,"calendrier"), $connect);
    if ( !$connect_base && $affiche_erreurs )
        echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> *** Erreur de connexion à la base sql<br><br>';
	
    //***********************************************************************
    // liste des locations  marquer *****************************************
    //***********************************************************************
    $tableau_requete[$id_logement_marquer] = $nom_logement[$id_logement_marquer];  // tableau des locations = toutes les locations
	 
    // boucle de marquage des dates pour le ou les locations selectionnées 1 par 1 ****
    foreach ( $tableau_requete as $cle => $nom_logement_requete ) {
		  
		// suppression des dates déjà existante des précédentes importations ical
	    $req_sql2 = "delete from ".Decrypte(nom_table_cal,"calendrier")." where date_reservation >= '".date('Y-m-d')."'  and id_logement = '".$cle."' and id_locataire = '".$num_pointeur_max."'  "; // dates étant de la même couleur que celles à marquer pour supprimer les annulations possible n'étant pas dans le fichier ical
		@mysql_query($req_sql2); //echo $req_sql2;
		
				
		// compteur de requetes
		$compteur_requetes		= 0;
		$nb_max_rerequetes		= 20;
		$tableau_requete_ajout	= '';
		$tableau_requete_delete	= '';
		$liste_query_ajout_t	= '';
		$liste_query_ajout	   	= '';
		$liste_query_delete_t	= '';
		$liste_query_delete  	= '';
		$connection_sql_active	= true;

		// liste de toutes les réservations
		foreach ( $tableau_date_ical as $date_index => $valeur) { //echo $date_index;
			
			// test des dates
			$test_post_debut 	= test_date_eng ($date_index);  //echo $date_index;
			// date est valide
			if (  $test_post_debut == 0 ) {
	   
				// calcul des dates 
				$date_debut_eng   = ajout_supprime_zero ($date_index,"Ajout","-","eng"); //echo $date_debut_eng;
				//récupération tarif
				$tarif = str_replace(",",".",$tarif_logement[$cle]);  // transformation des virgules en . pour les chiffres
				
				//initialisation liste requete*****************************************
				$tableau_locataire[8]	= $valeur['site'];
				$commentaire 			= '' ;
				
				//création liste **************************************************************************
						
				//recupération contenu date du jour dans la base de données		
				$date_disponible= true;
				$req_ctrl 		= "SELECT * from ".Decrypte(nom_table_cal,"calendrier")." where date_reservation = '$date_index'  and id_logement = '".$cle."' " ;
				$requete 		= @mysql_query($req_ctrl );
				$nj_jour 		= mysql_num_rows($requete);
				if ( $nj_jour > 0 ) {
					$data_jour 		= mysql_fetch_object($requete);
					if( !$date_couleur_disponible[$data_jour->couleur_texte] ) 
						$date_disponible= false;	
					}
				
				// si la date est disponible
				if( $date_disponible) {
					$compteur_requetes++;
					$liste_query_delete[]= "'".$date_debut_eng."'";
					if ( $liste_query_ajout <> '')   // controle si premiere insertion
						$liste_query_ajout .= ' ,';
					$liste_query_ajout 	.= "(NULL, '".$date_debut_eng."', '".$couleur_reserve[$couleur]."', '".$couleur."', '".$cle."' , '".$num_pointeur_max."' , '".$tarif."', '".$commentaire."')";
					}
				
				// rebouclage requettes pour éviter d'avoir des requetes trop longues
				if ( $compteur_requetes > $nb_max_rerequetes ) {
					$liste_query_ajout 	   .= " ;";
					$query 					= "INSERT INTO `".Decrypte(nom_table_cal,"calendrier")."` (`id`, `date_reservation`, `couleur`, `couleur_texte`, `id_logement`, `id_locataire`, `tarif`, `commentaires`) VALUES  $liste_query_ajout";
					$liste_query_ajout_t[]	= $query;
					$liste_query_ajout	   	= '';
					$liste_query_delete_t[]	= "Delete from ".Decrypte(nom_table_cal,"calendrier")." where date_reservation IN (".implode(' ,',$liste_query_delete).") and id_logement = '".$cle."'  "; // 
					$liste_query_delete	   	= '';
					$compteur_requetes		= 0;
					}
					
			}
		
		}
		//terminaison tableau requêtes
		if ( $compteur_requetes <> 0 ) {
			$liste_query_ajout 	   .= " ;";
			$query 					= "INSERT INTO `".Decrypte(nom_table_cal,"calendrier")."` (`id`, `date_reservation`, `couleur`, `couleur_texte`, `id_logement`, `id_locataire`, `tarif`, `commentaires`) VALUES  $liste_query_ajout";
			$liste_query_ajout_t[]	= $query;
			$liste_query_ajout	   	= '';
			$liste_query_delete_t[]	= "Delete from ".Decrypte(nom_table_cal,"calendrier")." where date_reservation IN (".implode(' ,',$liste_query_delete).") and id_logement = '".$cle."'  "; // 
			$liste_query_delete	   	= '';
			}
		// requetes sql effacement
		if ( isset($liste_query_delete_t) && is_array($liste_query_delete_t) ) {
			foreach ( $liste_query_delete_t as $index => $req) {
				$creation_reussi_date = @mysql_query($req)  ;  // echo $req;
				}
			}
		// requetes sql ajout	
		if ( isset($liste_query_ajout_t) && is_array($liste_query_ajout_t) ) {
			foreach ( $liste_query_ajout_t as $index => $req) {
				$creation_reussi_date = @mysql_query($req)  ; // echo $req;
				}
			}	
					

	   }  // fin boucle période ical
	   // mise à jour ical
       if ( $creation_reussi_date ) {
		   
			$vecteur_index_logement = $cle;  
			@define ("AUTOR_FCT_SAUVEGARDE", true);
			include($chemin_admin."/admin/genere/genere_export_ical.php"); 
			include($chemin_admin."/admin/genere/genere_date_maj_ical.php");
			}
			
     }    // fin fonctionnement avec base de données ***************************
          //********************************************************************


      //***********************************************************************
      // fonctionnement sans base de données  - ajout
      //***********************************************************************
      
      else {
		  
	  //***********************************************************************
      // liste des locations  marquer *****************************************
      //***********************************************************************
      $tableau_requete[$id_logement_marquer] = $nom_logement[$id_logement_marquer];  // tableau des locations = toutes les locations  
		  
      // boucle de marquage des dates pour le ou les locations selectionnées 1 par 1 ****
      foreach ( $tableau_requete as $cle => $nom_logement_requete ) {
		  
      //recupération des dates pour le logement en cours de traitement *********
      unset($tableau_reservation); // réinitialisation des variables tableau ***
      require($chemin_admin."/admin/fichier_calendrier/dates_sans_bdd/".$cle."_calendrier.php"); 
      
	  // traitement des dates  pour suppression par défaut des réservations lié au client ical ( ex si annulation)
		if ( isset($tableau_reservation[$cle]) ) {
			foreach ( $tableau_reservation[$cle] as $date_index => $valeur) {
				
				// contrôle si date en cours est postérieure à aujourd'hui
				if ( comparaison_date($date_index,date('Y-m-d'),'inferieur','-','eng') ) {
					// récupération détail réservation
					list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$valeur); 
					// si la réservation concerne le client ical, alors on l'efface
					if ( $tri_locataire_temp == $num_pointeur_max )
						unset($tableau_reservation[$cle][$date_index]);
					
					}
				} 
			}
			
		foreach ( $tableau_date_ical as $date_index => $valeur) {
			$tarif 			= str_replace(",",".",$tarif_logement[$cle]);  // transformation des virgules en . pour les chiffres
			$commentaire	= '';
			// controle si la date est disponible
			$date_disponible	= true;
			if ( isset($tableau_reservation[$cle][$date_index]) ) {
				list($couleur_temp,$couleur_texte_temp,$tri_locataire_temp,$tarif_temp,$commentaire_temp ) = explode('%&%',$tableau_reservation[$cle][$date_index]);
				if( !$date_couleur_disponible[$couleur_texte_temp] ) 
						$date_disponible= false;	
				}
			// si la date est disponible alors on l'ajoute	
			if ( $date_disponible )	
				$tableau_reservation[$cle][$date_index]	= $couleur_reserve[$couleur].'%&%'.$couleur.'%&%'.$num_pointeur_max.'%&%'.$tarif.'%&%'.guillet_var ($commentaire);
			}
	  
	  // copie des données dans un tableau temporaire car le fichier va être inclus à nouveau
	  $tableau_reservation_temp	=	$tableau_reservation;  
	  
      //controle si le fichier est disponible pour écriture *****************
      $fichier_libre = false;
      $chemin_fichier = $chemin_admin.'/admin/fichier_calendrier/dates_sans_bdd/'.$cle.'_calendrier.php';
      $chemin_fichier_sauvegarde = $chemin_admin.'/admin/fichier_calendrier/dates_sans_bdd/'.$cle.'_sauvegarde_calendrier.php';
      $pointeur_variable_fin_fichier_ok = 'fin_tableau_reservation_'.$cle;
      unset($$pointeur_variable_fin_fichier_ok);

      while (!isset($$pointeur_variable_fin_fichier_ok)  || !$$pointeur_variable_fin_fichier_ok) {
        include ($chemin_fichier);
        if ( isset($$pointeur_variable_fin_fichier_ok)  && $$pointeur_variable_fin_fichier_ok ) {
        //sauvegarde ancien fichier*********************************
        @copy($chemin_fichier,$chemin_fichier_sauvegarde);
        $file= @fopen($chemin_fichier, "w");
        $fichier_libre = true;
        }
      }

       // mise a jour du fichier *********************************************
       $vecteur_index_logement 	= $cle;
       $chemin_vers_fichier 	= $chemin_admin;
	   
	   // restitution des réservations calculée avant l'include
	   if (isset($tableau_reservation) ) 			unset($tableau_reservation);
	   if (isset($tableau_reservation_temp) ) 	{
			$tableau_reservation		=	$tableau_reservation_temp; 
			unset($tableau_reservation_temp);
			}		   
	   
       @define ("AUTOR_FCT_GEN_CALENDRIER", true);
	   $Cle	= 'calendrier';
       if ( $fichier_libre)
           require($chemin_admin."/admin/genere/genere_tableau_calendrier.php");
	   
       $creation_reussi_date = ( isset($creation_reussi) ) ? $creation_reussi: false ;
	   // mise à jour ical
       if ( $creation_reussi_date ) {
			$vecteur_index_logement = $cle;
			@define ("AUTOR_FCT_SAUVEGARDE", true);
			include($chemin_admin."/admin/genere/genere_export_ical.php");
			include($chemin_admin."/admin/genere/genere_date_maj_ical.php");
			}
			
          }
        } // fin boucle foreach insertion des dates sans la base de données*****
          //********************************************************************

     }    // fin condition tableau réservation existe
          //********************************************************************

     if ( !$creation_reussi_date && $affiche_erreurs )
         echo  "Erreur d'execution pour l'insertion des dates<br><br><br>";

    $creation_reussi = ( ($creation_reussi_date ) || MODE_DEMO) ? true : false ;
			
    if ( MODE_DEMO )
      echo '<font style="font-size:16px;" color="#FF0000" face="Arial"> Mode de démonstration activée, fonctionnalitées limittés</font><br><br> ';

return ($creation_reussi);

 }
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************
?>