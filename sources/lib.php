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
  $selectEntrepriseByNom = $conn->prepare("SELECT nom FROM entreprises where nom=:nom");
  $insertEntreprise = $conn->prepare("INSERT INTO logo(url,entreprise_id) values(:url,:entreprise)");
  $insertEntreprise = $conn->prepare("INSERT INTO entreprises(nom,adresse,phone) values (:nom,:adresse,:phone)");

  //End prepared statemtns
//End prepared statemtns


// Admin functions
function ajouterEntreprise($nom,$adresse,$phone,$description,$conn){
  $selectEntrepriseByNom = $conn->prepare("SELECT nom FROM entreprises where nom=:nom");
  $insertLogo = $conn->prepare("INSERT INTO logo(url,entreprise_id) values(:url,:entreprise)");
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

//function that returns all entreprises in array
function listerEntreprises($conn){
  $selectEntreprises = $conn->query("SELECT * FROM entreprises");

  if($selectEntreprises){
    return $selectEntreprises;
  }

}

//function that returns offres  de stage in array
function listerOffres($conn){
  $selectOffres = $conn->query("SELECT * FROM offres inner join entreprises on offres.entreprise_id = entreprises.id");

  if($selectOffres){
    return $selectOffres;
  }

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
//function that cleans user input
function clean($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

 ?>
