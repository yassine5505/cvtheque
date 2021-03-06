<?php
/*
* PROFIL ADMIN
* Ajouter entreprise
* Ajouter etudiant
* Afficher entreprises (id	nom	adresse	phone	logo)
* Afficher etudiants
* Afficher liste offres
**/
DEFINE('DS',DIRECTORY_SEPARATOR);
require('../config/dbConnection.php');
// Prepared statements
  //Entreprise
  // $selectEntrepriseByNom = $conn->prepare("SELECT nom FROM entreprises where nom=:nom");
  // $insertEntreprise = $conn->prepare("INSERT INTO logo(url,entreprise_id) values(:url,:entreprise)");
  // $insertEntreprise = $conn->prepare("INSERT INTO entreprises(nom,adresse,phone) values (:nom,:adresse,:phone)");

  //End prepared statemtns
//End prepared statemtns


// Admin functions

//Ajouter entreprise global function
function ajouterEntreprise($nom,$adresse,$phone,$description,$conn){
  $selectEntrepriseByNom = $conn->prepare("SELECT nom FROM entreprises where nom=:nom");
  $insertEntreprise = $conn->prepare("INSERT INTO entreprises(nom,adresse,phone,description) values (:nom,:adresse,:phone,:description)");
  $updateEntreprise = $conn->prepare("update entreprises set logo = :logo where nom=:nom");


  $selectEntrepriseByNom->bindParam(':nom',$nom);
  $selectEntrepriseByNom->execute();
  $rows = $selectEntrepriseByNom->rowCount();

  if($rows != 0){ // une entreprise a deja ce nom
    //first, insert logo in
    return false;
  }
  else{
    //inserer logo dans la table logos
    $logo = uploadLogo();
    //inserer dans entreprises
    $insertEntreprise->bindParam(':nom',$nom);
    $insertEntreprise->bindParam(':adresse',$adresse);
    $insertEntreprise->bindParam(':phone',$phone);
    $insertEntreprise->bindParam(':description',$description);
    $insertEntreprise->execute();
    //update entreprise avec le path logo
    $updateEntreprise->bindParam(':logo',$logo);
    $updateEntreprise->bindParam(':nom',$nom);

    $updateEntreprise->execute();

    //insert logo
    return true;
  }
}

//function that modifies entreprise based on nom
function modifierEntreprise($nom,$phone,$adresse,$description,$id,$conn){

  $updateEntreprise = $conn->prepare("UPDATE entreprises set nom=:nom,phone=:phone,adresse=:adresse,description=:description where id=:id");

  $updateEntreprise->bindParam(':nom',$nom,PDO::PARAM_STR);
  $updateEntreprise->bindParam(':phone',$phone,PDO::PARAM_STR);
  $updateEntreprise->bindParam(':adresse',$adresse,PDO::PARAM_STR);
  $updateEntreprise->bindParam(':description',$description,PDO::PARAM_STR);
  $updateEntreprise->bindParam(':id',$id,PDO::PARAM_INT);
  $updateEntreprise->execute();
  if($updateEntreprise){
    return true ;
  }
  return false;
}

//function that add etudiant to db
function ajouterEtudiant($apogee,$nom,$prenom,$phone,$email,$description,$conn){
  $selectEtudiantByApogee = $conn->prepare("SELECT numero_apogee FROM etudiants where numero_apogee=:apogee");
  $insertEtudiant = $conn->prepare("INSERT INTO etudiants(numero_apogee,nom,prenom,phone,email,description) values (:apogee,:nom,:prenom,:phone,:email,:description)");
  $updateEtudiant = $conn->prepare("update etudiants set image = :image where numero_apogee=:apogee");


  $selectEtudiantByApogee->bindParam(':apogee',$apogee);
  $selectEtudiantByApogee->execute();
  $rows = $selectEtudiantByApogee->rowCount();

  if($rows != 0){ // une entreprise a deja ce nom
    //first, insert image in assets/imageprofil
    return false;
  }
  else{
    //inserer logo dans la table logos
    $image = uploadImage();
    //inserer dans entreprises
    $insertEtudiant->bindParam(':apogee',$apogee);
    $insertEtudiant->bindParam(':nom',$nom);
    $insertEtudiant->bindParam(':prenom',$prenom);
    $insertEtudiant->bindParam(':phone',$phone);
    $insertEtudiant->bindParam(':email',$email);
    $insertEtudiant->bindParam(':description',$description);
    $insertEtudiant->execute();
    //update entreprise avec le path logo
    $updateEtudiant->bindParam(':image',$image);
    $updateEtudiant->bindParam(':apogee',$apogee);

    $updateEtudiant->execute();

    return true;
  }
}

function ajouterOffre($intitule,$duree,$entreprise_id,$conn){
  //inserer offre sans competences
  $insertOffre = $conn->prepare("INSERT INTO offres (intitule,duree,entreprise_id) VALUES(:intitule,:duree,:entreprise_id)");
  $insertOffre->bindParam(':intitule',$intitule);
  $insertOffre->bindParam(':duree',$duree);
  $insertOffre->bindParam(':entreprise_id',$entreprise_id);
  $insertOffre->execute();
  if($insertOffre) return true;
  return false;
}

//function that inserts competence
function ajouterCompetenceRequise($competence,$offre_id,$conn){
  $insertCompetence = $conn->prepare("INSERT INTO competences_requises(competence,offre_id) VALUES(:competence,:offre_id);");
  $insertCompetence->bindParam(':competence',$competence);
  $insertCompetence->bindParam(':offre_id',$offre_id);
  $insertCompetence->execute();
  if($insertCompetence){
    return true;
  }
  return false;
}
//function that modifies entreprise based on nom
function modifierEtudiant($id,$nom,$prenom,$phone,$description,$conn){
  $updateEtudiant = $conn->prepare("UPDATE etudiants set nom=:nom,prenom=:prenom,phone=:phone,description=:description where id=:id");
  $updateEtudiant->bindValue(':id',$id,PDO::PARAM_INT);
  $updateEtudiant->bindValue(':nom',$nom,PDO::PARAM_STR);
  $updateEtudiant->bindValue(':prenom',$prenom,PDO::PARAM_STR);
  $updateEtudiant->bindValue(':phone',$phone,PDO::PARAM_STR);
  $updateEtudiant->bindValue(':description',$description,PDO::PARAM_STR);
  $updateEtudiant->execute();
  if($updateEtudiant){
    return true ;
  }
  return false;
}


//function that returns all entreprises in array
function listerEntreprises($conn){
  $selectEntreprises = $conn->query("SELECT * FROM entreprises");

  if($selectEntreprises){
    return $selectEntreprises;
  }

}

// function that returns entreprise info based on nom
function infoEntreprise($nom,$conn){
  $selectEntreprise = $conn->prepare("SELECT * FROM entreprises WHERE nom=:nom limit 1");
  $selectEntreprise->bindParam(':nom',$nom);
  $selectEntreprise->execute();
  if($selectEntreprise && $selectEntreprise->rowCount() > 0){

    return $selectEntreprise;
  }
}
//function that returns offres  de stage in array
function listerOffres($conn){
  $selectOffres = $conn->query("SELECT * FROM offres inner join entreprises on offres.entreprise_id = entreprises.id");

  if($selectOffres){
    return $selectOffres;
  }
}
//function that returns offres  de stage in array
function listerOffresById($id,$conn){
  $selectOffres = $conn->prepare("SELECT * FROM offres inner join entreprises on offres.entreprise_id = entreprises.id where offres.id=:id");
  $selectOffres->bindParam(':id',$id);
  $selectOffres->execute();
  if($selectOffres){
    return $selectOffres;
  }
}

//function that filters offres
function filterOffres($competence, $duree, $nomEntreprise,$conn){
  $competence = strtolower($competence);
  $duree = strtolower($duree);
  $nomEntreprise = strtolower($nomEntreprise);

  // $selectOffres = $conn->prepare("SELECT * FROM offres inner JOIN entreprises on offres.entreprise_id=entreprise.id where entreprise.nom like :nomEntreprise or offres.initule like :intitule or offres.duree like :duree");
  $query ="SELECT *,offres.id as offre_id FROM offres,entreprises,competences_requises where offres.entreprise_id=entreprises.id and offres.id=competences_requises.offre_id ";
  if("" != $nomEntreprise){
    $query.= " and lower(entreprises.nom) LIKE '%$nomEntreprise%' ";
  }
  else if("" != $competence){
    $query .= " and lower(competences_requises.competence) like '%$competence%' ";
  }
  else if("" != $duree){
    $query .= " and offres.duree like '%$duree%' ";
  }
  $query.= " group by offres.id";
  $selectOffres = $conn->query($query);
  if($selectOffres) return $selectOffres;
  else if($selectOffres->rowCount() == 0){
    return false;
  }
}

//function to filter cvs
function filterCv($competence,$experience,$diplome,$conn){
  $competence = strtolower($competence);
  $experience = strtolower($experience);
  $diplome = strtolower($diplome);

  // $selectOffres = $conn->prepare("SELECT * FROM offres inner JOIN entreprises on offres.entreprise_id=entreprise.id where entreprise.nom like :nomEntreprise or offres.initule like :intitule or offres.duree like :duree");
  $query ="select distinct etudiants.nom,etudiants.prenom,etudiants.phone,etudiants.image,etudiants.numero_apogee as apogee,etudiants.email,competences.competence,experiences_etudiant.titre as etitre,Diplomes_etudiant.titre as dtitre from etudiants inner join competences on etudiants.numero_apogee=competences.apogee_etudiant inner join experiences_etudiant on etudiants.numero_apogee=experiences_etudiant.etudiant_apogee inner join Diplomes_etudiant on etudiants.numero_apogee=Diplomes_etudiant.etudiant_apogee where 1=1 
  ";
  if("" != $competence){
    $query.= " and lower(competences.competence) LIKE '%$competence%' ";
  }
  else if("" != $experience){
    $query .= " and lower(experiences_etudiant.titre) like '%$experience%' ";
  }
  else if("" != $diplome){
    $query .= " and Diplomes_etudiant.titre like '%$diplome%' ";
  }
   $query.=" group by etudiants.numero_apogee";
  $selectOffres = $conn->query($query);

  if($selectOffres) return $selectOffres;
  else if($selectOffres->rowCount() == 0){
    return false;
  }
}
// function that lists competences from a given offres
function listerCompetences($id,$conn){
  $selectCompetences = $conn->prepare("SELECT * FROM competences_requises WHERE offre_id = :id");
  $selectCompetences -> bindParam(':id',$id);
  $selectCompetences->execute();
  if($selectCompetences){
    return $selectCompetences;
  }
  return false;
}

//function that returns competences of a student

// function that lists competences from a given offres
function listerCompetencesEtudiant($id,$conn){
  $selectCompetences = $conn->prepare("SELECT * FROM competences WHERE apogee_etudiant = :id");
  $selectCompetences -> bindParam(':id',$id);
  $selectCompetences->execute();
  if($selectCompetences){
    return $selectCompetences;
  }
  return false;
}

//function that returns offres  de stage in array
function listerEtudiants($conn){
  $selectEtudiants = $conn->query("SELECT * FROM etudiants;");
  if($selectEtudiants){
    return $selectEtudiants;
  }

}

//function that checks if etudiant has already applied to offre
function etudiantPeutPostuler($idEtudiant,$idOffre,$conn){
  $selectCandidature = $conn->prepare("SELECT * FROM candidatures where etudiant_id=:etudiant_id and offre_id=:offre_id;");
  $selectCandidature->bindParam(':etudiant_id',$idEtudiant);
  $selectCandidature->bindParam(':offre_id',$idOffre);
  if($selectCandidature && $selectCandidature->rowCount() == 0){
    return true;
  }
  else{
    return false;
  }

}
//function that adds candidature
function ajouterCandidature($idEtudiant,$idOffre,$conn){
  if(etudiantPeutPostuler($idEtudiant,$idOffre,$conn)){
    $insertCandidature = $conn->prepare("INSERT INTO candidatures(etudiant_id,offre_id) VALUES(:idEtudiant,:idOffre)");
    $insertCandidature->bindParam(':idEtudiant',$idEtudiant);
    $insertCandidature->bindParam(':idOffre',$idOffre);
    $insertCandidature->execute();

  }
  else{
    return false;
  }

}

//function that returns candidatures to every offer by an etudiant
function listerCandidatures($idEntreprise,$conn ){
  $select = $conn->prepare("
  select distinct etudiants.numero_apogee as apogee,etudiants.image,etudiants.nom,etudiants.prenom,etudiants.phone, etudiants.email from etudiants
  	inner join candidatures on etudiants.id = candidatures.etudiant_id
      inner join offres on offres.id=candidatures.offre_id
      where offres.entreprise_id=:idEntreprise");
      $select->bindParam(':idEntreprise',$idEntreprise);
      $select->execute();
      if($select ) return $select;
      return false;
}
// function that returns etudiant info based on numero_apgogee
function infoEtudiant($id,$conn){
  $selectEtudiant = $conn->prepare("SELECT * FROM etudiants WHERE id=:id limit 1");
  $selectEtudiant->bindParam(':id',$id);
  $selectEtudiant->execute();
  if($selectEtudiant && $selectEtudiant->rowCount() > 0){

    return $selectEtudiant;
  }
}

//function that returns info etudiant from apogee
function infoEtudiantByApogee($numero_apogee,$conn){
  $selectEtudiant = $conn->prepare("SELECT * FROM etudiants WHERE numero_apogee=:numero_apogee limit 1");
  $selectEtudiant->bindParam(':numero_apogee',$numero_apogee);
  $selectEtudiant->execute();
  if($selectEtudiant && $selectEtudiant->rowCount() > 0){

    return $selectEtudiant;
  }
}
//function that returns info about offre de stage
function infoOffre($intitule,$duree,$conn){
  $selectOffre = $conn->prepare("SELECT * FROM offres where intitule=:intitule and duree=:duree limit 1");
  $selectOffre->bindValue(':intitule',$intitule,PDO::PARAM_STR);
  $selectOffre->bindValue(':duree',$duree,PDO::PARAM_STR);
  $selectOffre->execute();
  return $selectOffre;
}
  //General functions
//function that updates logo. called in ajouter entreprise
function uploadLogo(){
  $fileName = $_FILES['logo']['name'];
  $root = realpath($_SERVER["DOCUMENT_ROOT"]);
  //echo $root;
   $fullFileName = $root.DS."cvtheque".DS."assets".DS."logos".DS.$fileName;
   move_uploaded_file($_FILES['logo']['tmp_name'],$fullFileName);
   return $fileName;
}

//function that image etudiant. called in ajouter etudiant
function uploadImage(){
  $fileName = $_FILES['photo']['name'];
  $root = realpath($_SERVER["DOCUMENT_ROOT"]);
  //echo $root;
   $fullFileName = $root.DS."cvtheque".DS."assets".DS."imageprofil".DS.$fileName;
   move_uploaded_file($_FILES['photo']['tmp_name'],$fullFileName);
   return $fileName;
}

//function that cleans user input
function clean($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//function that starts session and starts session and checks if the user has the privileges
//this function should always be called first
function checkSession($type){
  //$type = user type : admin | entreprise | student
  if(!isset($_SESSION['connected']) || $type != $_SESSION['type']){
    session_destroy();
    header("Location: ../index.php");
  }
}
 ?>
