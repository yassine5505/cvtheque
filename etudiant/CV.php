<?php
    session_start();

    function clean($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = str_replace("'", '', $data);
        return $data;
    }



    if(isset($_SESSION['connected'])){
        $numero_apogee = $_SESSION['apogee'];
        require('../config/dbConnection.php');




        /*
        * selection des anciens informations
        */
        $query = "SELECT * FROM etudiants where numero_apogee='".$numero_apogee."'";
        $students = $conn->query($query);
        if($students->rowCount() == 1){
            $student = $students->fetch();

            $nom = $student['nom'];
            $prenom = $student['prenom'];
            $description = $student['description'];

            $imgPath = "../assets/imageprofil/".$student['image'];
            if(!file_exists($imgPath) || $student['image']==null || $student['image']==""){
                $imgPath = "../assets/imageprofil/man.svg";
            }

            $vidPath = "../assets/cvVideo/".$student['video'];
            if(!file_exists($vidPath)){
                $vidPath = "";
            }
            $apogee = $numero_apogee;
            $tele = $student['phone'];
            $email = $student['email'];
        }

        // selection des langues
        $query = "SELECT * FROM langues_etudiant where lower(numero_apogee)='".$numero_apogee."'";
        $oldLangues1 = $conn->query($query);

        // selection des langues
        $query = "SELECT * FROM langues_etudiant where lower(numero_apogee)='".$numero_apogee."'";
        $oldLangues2 = $conn->query($query);


        // selection des competences
        $query = "SELECT * FROM competences where lower(apogee_etudiant)='".$numero_apogee."'";
        $oldCompetences = $conn->query($query);

        // selection des diplomes
        $query = "SELECT * FROM Diplomes_etudiant where lower(etudiant_apogee)='".$numero_apogee."'";
        $oldDiplomes = $conn->query($query);

        // selection des experiences
        $query = "SELECT * FROM experiences_etudiant where lower(etudiant_apogee)='".$numero_apogee."'";
        $oldExperiences = $conn->query($query);




        /*
        * modification (from modifierCV.php)
        */
        if (isset($_POST['modifier'])) {
            // information personnel
            $desc = clean($_POST['desc']);
            $phone = clean($_POST['phone']);
            $email = clean($_POST['email']);

            $query = "UPDATE etudiants set description = '$desc', phone = '$phone', email = '$email' where lower(numero_apogee)='$numero_apogee' ";
            //echo $query."<br>";
            $conn->query($query);
            


            // Langues
            $i=0;
            while(isset($_POST['langue'][$i])){
                $oldLangue = $oldLangues1->fetch();
                $oldLang = $oldLangue['langue'];

                $langue = clean($_POST['langue'][$i]);
                $query = "UPDATE langues_etudiant set langue = '$langue' where langue ='$oldLang' and lower(numero_apogee)='$numero_apogee' ";
                //echo $query."<br>";
                $conn->query($query);
                $i++;
            }

            // langues niveau
            $i=0;
            while(isset($_POST['langue-niveau'][$i])){
                $oldLangue = $oldLangues2->fetch();
                $oldLang = $oldLangue['langue'];

                $langueniveau = clean($_POST['langue-niveau'][$i]);
                $query = "UPDATE langues_etudiant set niveau = '$langueniveau' where langue ='$oldLang' and lower(numero_apogee)='$numero_apogee' ";
                //echo $query."<br>";
                $conn->query($query);
                $i++;
            }




            // Compétence et niveau
            $i=0;
            while(isset($_POST['competence'][$i]) && isset($_POST['competence-niveau'][$i])){
                $oldCompetence = $oldCompetences->fetch();
                $oldComp = $oldCompetence['competence'];
                $oldNiveau = $oldCompetence['niveau'];

                $competence = clean($_POST['competence'][$i]);
                $competenceniveau = clean($_POST['competence-niveau'][$i]);
                $query = "UPDATE competences set competence = '$competence', niveau = '$competenceniveau' where competence = '$oldComp' and niveau = '$oldNiveau' and lower(apogee_etudiant)='$numero_apogee' ";
                //echo $query."<br>";
                $conn->query($query);
                $i++;
            }



            // Diplomas
            $i=0;
            while(isset($_POST['diplome-annee'][$i]) && isset( $_POST['diplome-titre'][$i]) and isset($_POST['diplome-ville'][$i]) && isset($_POST['diplome-description'][$i])){
                $oldDiplome = $oldDiplomes->fetch();
                $oldAnnee = $oldDiplome['annee'];
                $oldTitre = $oldDiplome['titre'];
                $oldVille = $oldDiplome['ville'];
                $oldDescription = $oldDiplome['description'];

                $annee = clean($_POST['diplome-annee'][$i]);
                $titre = clean($_POST['diplome-titre'][$i]);
                $ville = clean($_POST['diplome-ville'][$i]);
                $description = clean($_POST['diplome-description'][$i]);
                $query = "UPDATE diplomes_etudiant set annee = '$annee', titre = '$titre', ville = '$ville', description = '$description' where lower(etudiant_apogee)='$numero_apogee' and annee = '$oldAnnee' and titre = '$oldTitre' and ville = '$oldVille' and description = '$oldDescription' ";
                //echo $query."<br>";
                $conn->query($query);
                $i++;
            }



            // Experiences
            $i=0;
            while(isset($_POST['experience-annee'][$i]) && isset($_POST['experience-titre'][$i]) && isset($_POST['experience-sous-domaine'][$i]) && isset($_POST['experience-description'][$i])){
                
                $oldExperience = $oldExperiences->fetch();
                $oldAnnee = $oldExperience['annee'];
                $oldTitre = $oldExperience['titre'];
                $oldSousDomaine = $oldExperience['sous_domaine'];
                $oldDescription = $oldExperience['description'];

                $annee = clean($_POST['experience-annee'][$i]);
                $titre = clean($_POST['experience-titre'][$i]);
                $sous_domaine = clean($_POST['experience-sous-domaine'][$i]);
                $description = clean($_POST['experience-description'][$i]);
                $query = "UPDATE experiences_etudiant set annee = '$annee', titre = '$titre', sous_domaine = '$sous_domaine', description = '$description' where lower(etudiant_apogee)='$numero_apogee' and annee = '$oldAnnee' and titre = '$oldTitre' and sous_domaine = '$oldSousDomaine' and description = '$oldDescription' ";
                //echo $query."<br>";
                $conn->query($query);
                $i++;
            }

        }




        /*
        * selection des nouvelles informations
        */
        $query = "SELECT * FROM etudiants where numero_apogee='".$numero_apogee."'";
        $students = $conn->query($query);
        if($students->rowCount() == 1){
            $student = $students->fetch();

            $nom = $student['nom'];
            $prenom = $student['prenom'];
            $description = $student['description'];

            $imgPath = "../assets/imageprofil/".$student['image'];
            if(!file_exists($imgPath) || $student['image']==null || $student['image']==""){
                $imgPath = "../assets/imageprofil/man.svg";
            }

            $vidPath = "../assets/cvVideo/".$student['video'];
            if(!file_exists($vidPath)){
                $vidPath = "";
            }
            $apogee = $numero_apogee;
            $tele = $student['phone'];
            $email = $student['email'];
        }

        // selection des langues
        $query = "SELECT * FROM langues_etudiant where lower(numero_apogee)='".$numero_apogee."'";
        $languages = $conn->query($query);


        // selection des competences
        $query = "SELECT * FROM competences where lower(apogee_etudiant)='".$numero_apogee."'";
        $competences = $conn->query($query);

        // selection des diplomes
        $query = "SELECT * FROM Diplomes_etudiant where lower(etudiant_apogee)='".$numero_apogee."'";
        $diplomes = $conn->query($query);

        // selection des experiences
        $query = "SELECT * FROM experiences_etudiant where lower(etudiant_apogee)='".$numero_apogee."'";
        $experiences = $conn->query($query);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CVthèque - profile </title>
  <?php require('../includes/styles.php'); ?>
</head>
<body id="page-top">
  <?php   require('../includes/topnav.php'); ?>
  <div id="wrapper">
    <?php   require('../includes/sidenav.php'); ?>
    <div id="content-wrapper">
      <div id="container-fluid">
        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="profile col-sm-10">
                <div class="card">
                    <div class="card-body profile-header">
                        <h5 class="name"><?= $nom ?> <?= $prenom ?></h5>
                        <img class="tof" width="130" src="<?=$imgPath?>" alt="">
                        <p class="desc"><?= $description ?><p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-5">
                                <i class="fas fa-info-circle cv-icon"></i> <span class="cv-label">Informations :</span>
                                <hr class="hr">
                                <p class="apogee"><i class="fas fa-th-list"></i>  <?= $apogee ?><p>
                                <p class="phone"><i class="fas fa-phone cv-icon-small"></i> <?= $tele ?><p>
                                <p class="phone"><i class="fas fa-at"></i> <?= $email ?><p>
                                
                                <br>
                                <i class="fas fa-language cv-icon-lang"></i> <span class="cv-label">Langues :</span>
                                <hr class="hr">
                                <?php
                                    $langExists=false;
                                    while($language = $languages->fetch()){
                                        $langExists=true;
                                ?>
                                    <p><strong><?= $language['langue'] ?> : </strong>  <?= $language['niveau'] ?></p>
                                <?php        
                                    }
                                    if(!$langExists) {
                                ?>
                                    <p>Y'a pas de langues</p>
                                <?php 
                                    }
                                ?>
           
                                <br>
                                <i class="fas fa-cogs cv-icon"></i> <span class="cv-label">Compétences :</span>
                                <hr class="hr">
                                <?php
                                    $compExists=false;
                                    while($competence = $competences->fetch()){
                                        $compExists=true;
                                ?>
                                    <p><strong><?= $competence['competence'] ?> :</strong> <?= $competence['niveau'] ?></p>
                                <?php        
                                    }
                                    if(!$compExists) {
                                ?>
                                    <p>Y'a pas de compétences</p>
                                <?php 
                                    }
                                ?>

                            </div>
                            <div class="col-sm-7">
                                <i class="fas fa-graduation-cap cv-icon"></i> <span class="cv-label">Diplômes :</span>
                                <hr class="hr">
                                <?php
                                    $dipExists=false;
                                    while($diplome = $diplomes->fetch()){
                                        $dipExists=true;
                                ?>
                                    <div class="row">
                                        <div class="col-sm-3 diplome-annee">
                                            <?= $diplome['annee'] ?>
                                        </div>
                                        <div class="col-sm-9 diplome-titre">
                                            <?= $diplome['titre'] ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 diplome-ville">
                                            <?= $diplome['ville'] ?>
                                        </div>
                                        <div class="col-sm-9 diplome-description">
                                            <?= $diplome['description'] ?>
                                        </div>
                                    </div>
                                    <br>
                                <?php        
                                    }
                                    if(!$dipExists) {
                                ?>
                                    <p>Y'a pas de diplômes</p>
                                <?php 
                                    }
                                ?>

                                <i class="fas fa-suitcase cv-icon"></i> <span class="cv-label"> Experiences :</span>
                                <hr class="hr">
                                <?php
                                    $expExists=false;
                                    while($experience = $experiences->fetch()){
                                        $expExists=true;
                                ?>
                                    <div class="row">
                                        <div class="col-sm-3 experience-annee">
                                            <?= $experience['annee'] ?>
                                        </div>
                                        <div class="col-sm-9 experience-titre">
                                            <?= $experience['titre'] ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 experience-sous_domaine">
                                            <?= $experience['sous_domaine'] ?>
                                        </div>
                                        <div class="col-sm-9 experience-description">
                                            <?= $experience['description'] ?>
                                        </div>
                                    </div>
                                    <br>
                                <?php
                                    }
                                    if(!$expExists) {
                                ?>
                                    <p>Y'a pas de experiences</p>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="card-body profile-footer">
                            <h5 class="cv-video-name">CV Video</h5>
                    <?php
                        if($vidPath==""){
                    ?>
                        <p class="errorVideo">Video non lue!</p>
                    <?php
                        }
                        else{
                    ?>
                        <video class="video" width="380" controls>
                            <source src="<?=$vidPath?>" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>
                    <?php
                        }
                    ?>
                    </div>
                    <a class="modify" href="modifierCV.php"><button type="button" class="btn btn-primary"><i class="fas fa-pen"></i></button></a>
                </div>
            </div>
            <style>
                .errorVideo{
                    padding-top: 5px;
                    padding-bottom: 5px;
                    color: red;
                    text-align: center;
                }
                .video{   
                    margin-left: auto;
                    margin-right: auto;
                    display: block;
                }
                .diplome-annee{
                    text-align: right;
                    color: rgba(0, 0, 0, 0.575);
                }
                .diplome-ville{
                    text-align: right;
                    color: rgb(15, 64, 156);
                }
                .diplome-titre{
                    font-weight: bold;
                }
                .diplome-description{
                }

                .experience-annee{
                    text-align: right;
                    color: rgba(0, 0, 0, 0.575);
                }
                .experience-sous_domaine{
                    text-align: right;
                    color: rgb(15, 64, 156);
                }
                .experience-titre{
                    font-weight: bold;
                }
                .experience-description{
                }
                .profile{
                    margin-top: 80px;
                }
                .modify{
                    position: absolute;
                    margin-top: 0px;
                    margin-left: 98%;
                    padding-left: 30px;
                }
                .card{
                    border-style: none;
                    margin-bottom : 100px;
                }
                .profile-header{
                    background-image: url("../assets/backgrounds/profileBack.jpeg");
                    border-radius: 25px 25px 0px 0px!important;
                    border-style: none;
                }
                .profile-footer{
                    margin-top: 100px;
                    background-image: url("../assets/backgrounds/profileBack.jpeg");
                    border-radius: 25px 25px 25px 25px !important;
                    border-style: none;
                }
                .card-footer{
                    background: rgba(200,207,215,0.43);
                    border-style: none;
                    border-radius: 0px 0px 25px 25px!important;
                }
                .name{
                    padding-top: 40px;
                    padding-bottom: 20px;
                    color: white;
                    text-align: center;
                }
                .cv-video-name{
                    padding-top: 10px;
                    padding-bottom: 10px;
                    color: white;
                    text-align: center;
                }
                .desc{
                    padding-top: 20px;
                    padding-bottom: 40px;
                    color: white;
                    text-align: center;
                }
                .tof{
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                    border-radius: 10%;
                }
                .cv-icon{
                    font-size: 24px;
                }
                .cv-icon-lang{
                    font-size: 28px;
                }
                .cv-icon-small{
                    font-size: 18px;
                }
                .cv-label{
                    font-size: 23px;
                    font-weight: bold;
                }
                .hr{
                    border-top: 2px solid rgb(68, 68, 64);
                }
            </style>
        </div>
        <?php   require('../includes/footer.php'); ?>
      </div>
    </div>

  </div>

  <?php require('../includes/scripts.php'); ?>
</body>
</html>
