<?php

/*
* PROFIL ADMIN
* Ajouter entreprise
* Ajouter etudiant
* Afficher entreprises (id	nom	adresse	phone	logo)
* Afficher etudiants
* Afficher liste offres
**/
require('../config/dbConnection.php');
// Prepared statements
  //Entreprise
  $selectEntrepriseByNom = $conn->prepare("SELECT nom FROM entreprises where nom=:nom");
  $insertEntreprise = $conn->prepare("INSERT INTO logo(url,entreprise_id) values(:url,:entreprise)");
  $insertEntreprise = $conn->prepare("INSERT INTO entreprises(nom,adresse,phone) values (:nom,:adresse,:phone)");
  
  //End prepared statemtns


// Admin functions
function ajouterEntreprise($nom,$adresse,$phone){
  $selectEntrepriseByNom->bindParam(':nom',$nom);
  $selectEntrepriseByNom->execute();
  $rows = $selectEntrepriseByNom->rowCount();

  if($rows != 0){ // une entreprise a deja ce nom
    //first, insert logo in
    return false;
  }
  else{ //aucune entreprise n'a ce nom
    //inserer le nom, adresse,phone dans entreprises
    $insertEntreprise->bindParam(':nom',$nom);
    $insertEntreprise->bindParam(':adresse',$adresse);
    $insertEntreprise->bindParam(':phone',$phone);
    $insertEntreprise->execute();
    //insert logo
    return true;
  }

}

//General functions
function uploadLogo($targetDir){
  $target_dir = "logos/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
  }
}


 ?>
