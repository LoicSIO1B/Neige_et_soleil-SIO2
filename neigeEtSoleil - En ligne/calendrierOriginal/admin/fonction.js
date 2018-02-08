
function copier(champ,sel_couleur) {
   val_copie_texte = document.getElementById(champ).value;
  }

function coller(champ,sel_couleur) {
   document.getElementById(champ).value = val_copie_texte ;
  }

function DateAnglaise(LeParam1,LeParam2){
  LaDate = new Array(3);
  LaDate = DecomposeDate(LeParam1);
  LeRetour = LaDate[2]+LeParam2+LaDate[1]+LeParam2+LaDate[0];
  return LeRetour;
}

function DecomposeDate(LeParam1){
  LeRetour = new Array(3);
  LeJour="";
  LeMois="";
  LeAnnee="";
  i=0;
  while((LeParam1.charAt(i)!="/")&&(i<10)){
    LeJour+=LeParam1.charAt(i);
    i++;
  }
  if(LeJour.charAt(0)=="0"){
  LeJour=LeJour.charAt(1);
  }
  LeParam1=LeParam1.substring(i+1,LeParam1.length);
  i=0;
  while((LeParam1.charAt(i)!="/")&&(i<10)){
    LeMois+=LeParam1.charAt(i);
    i++;
    }
  if(LeMois.charAt(0)=="0"){
   LeMois=LeMois.charAt(1);
  }
  LeParam1=LeParam1.substring(i+1,LeParam1.length);
  LeAnnee=LeParam1;
  LeRetour[0]=LeJour;
  LeRetour[1]=LeMois;
  LeRetour[2]=LeAnnee;
  return LeRetour;
}

function ComparerDates(LeParam1,LeParam2){
  // Renvoye 0 si égalité, 1 si la première est supérieure, si 2 date fin supérieur date debut
  var LeParam1 = DateAnglaise(LeParam1,"/");
  var LeParam2 = DateAnglaise(LeParam2,"/");
  LeParam1 = Date.parse(LeParam1);
  LeParam2 = Date.parse(LeParam2);
  if (LeParam1 == LeParam2) {
  compar_date = 0;
  }
  if (LeParam1 > LeParam2){
  compar_date = 1;
  }else{
  compar_date = 2;
  }
  }

function ajout_date(date, nb_jour)
{
   // Date plus plus quelques jours
   var split_date = date.split('/');
   // Les mois vont de 0 a 11 donc on enleve 1, cast avec *1
   var new_date = new Date(split_date[2], split_date[1]*1 - 1, split_date[0]*1 + nb_jour);
   var new_day = new_date.getDate();
       new_day = ((new_day < 10) ? '0' : '') + new_day; // ajoute un zéro devant pour la forme  
   var new_month = new_date.getMonth() + 1;
       new_month = ((new_month < 10) ? '0' : '') + new_month; // ajoute un zéro devant pour la forme  
   var new_year = new_date.getYear();
       new_year = ((new_year < 200) ? 1900 : 0) + new_year; // necessaire car IE et FF retourne pas la meme chose  
   var new_date_text = new_day + '/' + new_month + '/' + new_year;
   return new_date_text;
}

 function bordure_formulaire(id,actif) {
  if ( actif == 'oui' ) {
     bordure_modifie = "2px #C0E37B solid";
     document.getElementById(id).style.border=bordure_modifie;
    }
  else {
     bordure_modifie = "2px #51B4FD solid";
     document.getElementById(id).style.border=bordure_modifie;
    }
  }

 function bordure_comm () {
       if ( (document.getElementById('date_debut').value.length > 7) && (document.getElementById('date_debut').value != 'JJ/MM/AAAA') && (document.getElementById('date_fin').value.length > 7) && (document.getElementById('date_fin').value != 'JJ/MM/AAAA') ) {
        document.getElementById('commentaire').style.border=bordure_commentaire_modifie;
        document.getElementById('commentaire').style.backgroundColor=couleur_fond_commentaire_modifie;
       }
     else  {
        document.getElementById('commentaire').style.border=bordure_commentaire_initial;
        document.getElementById('commentaire').style.backgroundColor=couleur_fond_commentaire_initial;
       }
 }
 
 function message_alerte (champ) {
   // zone pour champs marquer toutes les locations ****
   if  ( champ == 'marquer_tous') {
      ctrl_coche = document.getElementById(champ).checked ;
      if ( ctrl_coche ) {
         document.getElementById('cellule_marquer_tous').style.backgroundColor=couleur_fond_champs_selectionne;
      }
      else  {
         document.getElementById('cellule_marquer_tous').style.backgroundColor="#FFFFFF";
      }
   }
   // fin de zone **************************************

   // zone pour champs non securisation ****************
   if  ( champ == 'securise') {
      ctrl_coche = document.getElementById(champ).checked ;
      if ( ctrl_coche ) {
         alert ("ATTENTION !!!!\n***********************************\nUN FONCTIONNEMENT NON SECURISE EST\n A VOS RISQUES ET PERILS !\n*********************************** ");
      }
   }

   // fin de zone **************************************
   
   // zone pour champs marquer des dates deja reservées ****
   if  ( champ == 'avertissement_marquer_affiche') {
         document.getElementById('marquer_effacer').style.backgroundColor=couleur_fond_champs_avertissement;
         document.getElementById('aide_avertissement_marquage').style.visibility = 'visible';
      }

   // fin de zone **************************************

   // zone pour champs marquer des dates deja reservées ****
   if  ( champ == 'avertissement_marquer_init') {
         document.getElementById('marquer_effacer').style.backgroundColor="#FFFFFF";
         document.getElementById('aide_avertissement_marquage').style.visibility = 'hidden';
      }
   // fin de zone **************************************

 }

 function swap_date(date_select,id_logement,format_cal,avertissement) {

 if ( choix_selecteur_debut ) {   // champs de date début

    document.getElementById('date_debut').value=date_select;
    document.getElementById('date_debut').style.backgroundColor=couleur_fond_champs_selectionne;
    document.getElementById('date_debut').style.color=couleur_texte_champs_selectionne;
    document.getElementById('date_debut').style.border=bordure_champs_initial;
    date1 = date_select;
    choix_selecteur_debut =  false ;
    document.getElementById('tarif').value=tarif_logement[id_logement];
    document.getElementById('format_cal').value=format_cal;

    coller_infobulle('commentaire',date_select,id_logement);  //récupération ajax infobulle de la date de debut

    if  ( format_cal == 'calendrier_periode') { // calcul date de fin de période pour remplissage auto
         document.getElementById('date_fin').value=ajout_date(date_select, 6);
    }
    else if ( document.getElementById('date_fin').value == 'JJ/MM/AAAA' )  { // remplissage auto date fin= date début pour marquage "rapide" d'un jour seul
          document.getElementById('date_fin').value=date_select;
    }

    document.getElementById('date_fin').style.border=bordure_champs_initial;
    document.getElementById('date_fin').style.backgroundColor=couleur_fond_champs_selectionne;
    document.getElementById('date_fin').style.color=couleur_texte_champs_selectionne;

    val_date_fin = document.getElementById('date_fin').value;

    document.getElementById('date_fin').style.border=bordure_champs_modifie;
    document.getElementById('date_fin').style.backgroundColor=couleur_fond_champs_initial;
    document.getElementById('date_fin').style.color=couleur_texte_champs_initial;

    bordure_comm ();
    avertissement_date_debut = avertissement ;
    
  }
 else {           // champs date de fin

    if  ( format_cal == 'calendrier_periode') {
    document.getElementById('date_fin').value=ajout_date(date_select, 6);
    }
    else {
    document.getElementById('date_fin').value=date_select;
    }
    document.getElementById('date_fin').style.color=couleur_texte_champs_selectionne;
    document.getElementById('date_fin').style.border=bordure_champs_initial;
    ComparerDates(date1,date_select);
    if ( compar_date ==  2 ) {     //si date fin est supérieur a date debut
        document.getElementById('date_fin').style.backgroundColor=couleur_fond_champs_selectionne;
        document.getElementById('date_debut').style.border=bordure_champs_modifie;
        document.getElementById('date_debut').style.backgroundColor=couleur_fond_champs_initial;
        document.getElementById('date_debut').style.color=couleur_texte_champs_initial;
        choix_selecteur_debut =  true ;
        }
    else {                       // si date fin est inférieur date debut
        document.getElementById('date_fin').style.backgroundColor=couleur_fond_champs_erreur;
        document.getElementById('date_fin').style.border=bordure_champs_modifie;
        choix_selecteur_debut =  false ;
        }

    val_date_debut = document.getElementById('date_debut').value;

    bordure_comm ();
    avertissement_date_fin = avertissement ;
 }

 // avertissement pour date deja marquées ***********************
 if ( avertissement_date_debut || avertissement_date_fin ) {
        message_alerte ('avertissement_marquer_affiche');
        }
 else  {
        message_alerte ('avertissement_marquer_init');
        }
// *************************************************************

}

function bordure(champ) {
  if (champ == 'debut'){
    document.getElementById('date_debut').style.backgroundColor=couleur_fond_champs_initial;
    document.getElementById('date_debut').style.color=couleur_texte_champs_initial;
    document.getElementById('date_debut').style.border=bordure_champs_modifie;
    document.getElementById('date_fin').style.border=bordure_champs_initial;
    document.getElementById('tarif').style.border=bordure_champs_initial;
    choix_selecteur_debut =  true ;
    date1 = '00/00/0000';
    val_actuel = document.getElementById('date_debut').value;
    if  ( val_actuel == 'JJ/MM/AAAA') {
      document.getElementById('date_debut').value = '';
      }
    bordure_comm ();
    }
  else if (champ == 'fin') {
    document.getElementById('tarif').style.border=bordure_champs_initial;
    choix_selecteur_debut =  false ;
    date1 = '00/00/0000';
    val_actuel = document.getElementById('date_fin').value;

    document.getElementById('date_fin').style.backgroundColor=couleur_fond_champs_initial;
    document.getElementById('date_fin').style.color=couleur_texte_champs_initial;
    document.getElementById('date_fin').style.border=bordure_champs_modifie;
    document.getElementById('date_debut').style.border=bordure_champs_initial;
    bordure_comm ();
  }
  else if (champ == 'tarif') {
    document.getElementById('tarif').style.backgroundColor=couleur_fond_champs_initial;
    document.getElementById('tarif').style.color=couleur_texte_champs_initial;
    document.getElementById('tarif').style.border=bordure_champs_modifie;
    choix_selecteur_debut =  false ;
  }
  else {
    document.getElementById('commentaire').style.color=couleur_texte_champs_commentaire;
    val_actuel = document.getElementById('commentaire').value;
    if  ( val_actuel == "Message de l'infobulle") {
      document.getElementById('commentaire').value = '';
      }
    }
}

function validation_marquage(theForm)
{                       //controle la chonologie des dates choisies

var strValue = theForm.date_debut.value;
var strFilter = new  RegExp("^[0-9]{1,2}[/]{1}[0-9]{1,2}[/]{1}[0-9]{4}$","g");
if ( (theForm.date_debut.value.length < 8) || (theForm.date_debut.value =='JJ/MM/AAAA') || !strFilter.test(strValue) )  {
   alert("Vous n'avez pas ou mal renseigné la date de début!");
   return false;
  }

var strValue = theForm.date_fin.value;
var strFilter = new  RegExp("^[0-9]{1,2}[/]{1}[0-9]{1,2}[/]{1}[0-9]{4}$","g");
if ( (theForm.date_fin.value.length < 8) || (theForm.date_fin.value =='JJ/MM/AAAA') || !strFilter.test(strValue) )  {
   alert("Vous n'avez pas ou mal renseigné la date de fin!");
   return false;
  }

 temp_date_debut = theForm.date_debut.value;
 temp_date_fin   = theForm.date_fin.value;
 ComparerDates(temp_date_debut,temp_date_fin);
 if ( compar_date !=  2 ) {     //si date fin est inférieur a date debut
     alert("La date de fin doit être supérieure à la date de début!");
     return false;
     }
return true;
}

/**
* calculatrice
**/

var un= '1'
var deux = '2'
var trois = '3'
var quatre = '4'
var cinq = '5'
var six = '6'
var sept = '7'
var huit = '8'
var neuf = '9'
var zero = '0'
var additionner = '+'
var soustraire = '-'
var multiplier = '*'
var diviser = '/'
var virgule = '.'

function calculer(obj) {
obj.expr.value = eval(obj.expr.value) ;
}

function calculatrice_expression(obj, string) {
obj.expr.value += string  ;
}
function calculatrice_effacer(obj) {
obj.expr.value = '';
}
/**
* fin calculatrice
**/

function getXhr(){
var xhr = null;
if(window.XMLHttpRequest) // Firefox et autres
   xhr = new XMLHttpRequest();
else if(window.ActiveXObject){ // Internet Explorer
   try {
   xhr = new ActiveXObject("Msxml2.XMLHTTP");
   } catch (e) {
xhr = new ActiveXObject("Microsoft.XMLHTTP");
}
}
else { // XMLHttpRequest non supporté par le navigateur
     alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
     xhr = false;
}
return xhr
}
			
/**
* récupération du texte qui a été copié pour être collé dans le champs cible
*/
function coller_ajax(champ,page){
  var xhr = getXhr()
  // On défini ce qu'on va faire quand on aura la réponse
  xhr.onreadystatechange = function(){
  // On ne fait quelque chose que si on a tout reçu et que le serveur est ok
  if(xhr.readyState == 4 && xhr.status == 200){
   reponse_fichier = xhr.responseText ;
   document.getElementById(champ).value = xhr.responseText;
 }
}
var dattmp = new Date();
lien ="fichier_calendrier/"+page+"?dattmp="+dattmp;
xhr.open("GET",lien,true);
xhr.send(null);
if ( page != 'colle_memo.html') {
  bordure();
  }
}
/**
* récupération infobulle date debut pour être collé dans le champs cible
*/
function coller_infobulle(champ,date,logement){
  var xhr = getXhr()
  // On défini ce qu'on va faire quand on aura la réponse
  xhr.onreadystatechange = function(){
  // On ne fait quelque chose que si on a tout reçu et que le serveur est ok
  if(xhr.readyState == 4 && xhr.status == 200){
   reponse_fichier = xhr.responseText ;
   document.getElementById(champ).value = xhr.responseText;
 }
}
var dattmp = new Date();
lien ="recupe_infobulle.php?date_recup="+date+"&log="+logement+"&dattmp="+dattmp;
xhr.open("GET",lien,true);
xhr.send(null);
bordure();
}
/**
* copie le contenu du champs dans un fichier page_cible
*/
function copier_ajax(champ,page_cible){
  var xhr = getXhr();
  // On défini ce qu'on va faire quand on aura la réponse
  xhr.onreadystatechange = function(){
  // On ne fait quelque chose que si on a tout reçu et que le serveur est ok
  if(xhr.readyState == 4 && xhr.status == 200){

 }
}
  xhr.open("POST","copie.php",true);
  // ne pas oublier ça pour le post
  xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
  // ne pas oublier de poster les arguments
  // ici, l'id de l'auteur
  texte = document.getElementById(champ).value;
  info_post = "page_cible="+page_cible+"&texte="+texte ;
  xhr.send(info_post);

}


function insertion(repdeb, repfin, champ) {
  var input = document.forms['marquage'].elements[champ];
  input.focus();
  /* pour l'Explorer Internet */
  if(typeof document.selection != 'undefined') {
    /* Insertion du code de formatage */
    var range = document.selection.createRange();
    var insText = range.text;
    range.text = repdeb + insText + repfin;
    /* Ajustement de la position du curseur */
    range = document.selection.createRange();
    if (insText.length == 0) {
      range.move('character', -repfin.length);
    } else {
      range.moveStart('character', repdeb.length + insText.length + repfin.length);
    }
    range.select();
  }
  /* pour navigateurs plus récents basés sur Gecko*/
  else if(typeof input.selectionStart != 'undefined')
  {
    /* Insertion du code de formatage */
    var start = input.selectionStart;
    var end = input.selectionEnd;
    var insText = input.value.substring(start, end);
    input.value = input.value.substr(0, start) + repdeb + insText + repfin + input.value.substr(end);
    /* Ajustement de la position du curseur */
    var pos;
    if (insText.length == 0) {
      pos = start + repdeb.length;
    } else {
      pos = start + repdeb.length + insText.length + repfin.length;
    }
    input.selectionStart = pos;
    input.selectionEnd = pos;
  }
  /* pour les autres navigateurs */
  else
  {
    /* requête de la position d'insertion */
    var pos;
    var re = new RegExp('^[0-9]{0,3}$');
    while(!re.test(pos)) {
      pos = prompt("Insertion à la position (0.." + input.value.length + "):", "0");
    }
    if(pos > input.value.length) {
      pos = input.value.length;
    }
    /* Insertion du code de formatage */
    var insText = prompt("Veuillez entrer le texte à formater:");
    input.value = input.value.substr(0, pos) + repdeb + insText + repfin + input.value.substr(pos);
  }
}

function horloge()
{ 
   var digital = new Date();
   var hours = digital.getHours();
   var minutes = digital.getMinutes();
   var seconds = digital.getSeconds();
   if (minutes <= 9) minutes = "0" + minutes;
   if (seconds <= 9) seconds = "0" + seconds;
   dispTime = hours + ":" + minutes ;
   return dispTime;
}
function affiche_date_jour() 
{ 
   var now = new Date();
   var days = new Array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');
   var months = new Array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre');
   var date = ((now.getDate() < 10) ? "0" : "") + now.getDate();
   var year = (now.getYear() < 1000) ? now.getYear() + 1900 : now.getYear();
   today = days[now.getDay()] + " " + date + " " + months[now.getMonth()] + " " + year + " " + horloge();
   var basicdate = document.getElementById('date_heure_jour');
   basicdate.innerHTML = today ;
   setTimeout("affiche_date_jour()", 15000);
}