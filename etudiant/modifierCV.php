<?php
    session_start();
    if(isset($_SESSION['connected'])){
        $numero_apogee = $_SESSION['apogee'];
        require('../config/dbConnection.php');

        // selection des informations
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
                <form class="form-modifier" id="form-modifier" action="CV.php" method="post">
                    <div class="card">
                        <div class="card-body profile-header">
                            <h5 class="name"><?= $nom ?> <?= $prenom ?></h5>
                            <img class="tof" width="130" src="<?=$imgPath?>" alt="">
                            <div class="form-label-group desc-group">
                                <input type="text"  name="desc" id="desc" value="<?= $description ?>" class="form-control" placeholder="description" required="required">
                                <label id="desc-label" for="desc">description </label>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-5">
                                    <i class="fas fa-info-circle cv-icon"></i> <span class="cv-label">Informations :</span>
                                    <hr class="hr">
                                    <p class="apogee"><i class="fas fa-th-list"></i>  <?= $apogee ?><p>

                                    <div class="form-group phone-group">
                                        <i class="fas fa-phone cv-icon-small"></i><input type="text"  name="phone" id="phone" value="<?= $tele ?>" class="form-control" placeholder="phone" required="required">
                                    </div>

                                    <div class="form-group email-group">
                                        <i class="fas fa-at"></i><input type="text"  name="email" id="email" value="<?= $email ?>" class="form-control" placeholder="email" required="required">
                                    </div>
                                    
                                    <br>
                                    <i class="fas fa-language cv-icon-lang"></i> <span class="cv-label">Langues :</span>
                                    <hr class="hr">
                                    <?php
                                        $langExists=false;
                                        while($language = $languages->fetch()){
                                            $langExists=true;
                                    ?>

                                        <div class="form-group langue-group">
                                            <input type="text"  name="langue[]" id="langue" value="<?= $language['langue'] ?>" class="form-control" placeholder="langue" required="required">
                                            <input type="text"  name="langue-niveau[]" id="langue-niveau" value="<?= $language['niveau'] ?>" class="form-control" placeholder="niveau" required="required">
                                        </div>
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

                                        <div class="form-group competence-group">
                                            <input type="text"  name="competence[]" id="competence" value="<?= $competence['competence'] ?>" class="form-control" placeholder="competence" required="required">
                                            <input type="text"  name="competence-niveau[]" id="competence-niveau" value="<?= $competence['niveau'] ?>" class="form-control" placeholder="niveau" required="required">
                                        </div>
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
                                            <div class="form-group ">
                                                <input type="text"  name="diplome-annee[]" id="diplome-annee" value="<?= $diplome['annee'] ?>" class="form-control" placeholder="Annee" required="required">
                                                <input type="text"  name="diplome-titre[]" id="diplome-titre" value="<?= $diplome['titre'] ?>" class="form-control" placeholder="Titre" required="required">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group ">
                                                <input type="text"  name="diplome-ville[]" id="diplome-ville" value="<?= $diplome['ville'] ?>" class="form-control" placeholder="Ville" required="required">
                                                <input type="text"  name="diplome-description[]" id="diplome-description" value="<?= $diplome['description'] ?>" class="form-control" placeholder="Description" required="required">
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
                                            <div class="form-group ">
                                                <input type="text"  name="experience-annee[]" id="experience-annee" value="<?= $experience['annee'] ?>" class="form-control" placeholder="Annee" required="required">
                                                <input type="text"  name="experience-titre[]" id="experience-titre" value="<?= $experience['titre'] ?>" class="form-control" placeholder="Titre" required="required">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group ">
                                                <input type="text"  name="experience-sous-domaine[]" id="experience-sous-domaine" value="<?= $experience['sous_domaine'] ?>" class="form-control" placeholder="Sous domaine" required="required">
                                                <input type="text"  name="experience-description[]" id="experience-description" value="<?= $experience['description'] ?>" class="form-control" placeholder="Description" required="required">
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
                    </div>
                    <a href="CV.php"><button name="cancel" class="btn btn-secondary cancel "> Annuler</button></a>
                    <button name="modifier" type="submit" class="btn btn-primary modifier"> Confirmer les modifications </button>
                </form>
                
            </div>
            <style>
                .modifier{
                    margin-bottom: 50px;
                    margin-right: 10px;
                    float: right;
                }
                .cancel{
                    margin-bottom: 50px;
                    float: right;
                }
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
                    margin-bottom : 50px;
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
                
                .tof{
                    margin-bottom: 30px;
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




                #desc{
                    width: 80%;
                    background-color: rgba(0, 0, 0, 0);
                    color: white;
                }
                #desc-label{
                    color: rgba(255, 255, 255, 0.651);
                }
                .desc-group{
                    margin-left: 20%;
                    margin-bottom: 20px;
                }
                #phone{
                    display: inline;
                    margin-left: 10px;
                    width: 70%;
                    background-color: rgba(0, 0, 0, 0);
                    color: rgb(0, 0, 0);
                }
                #phone-label{
                    color: rgba(255, 255, 255, 0.651);
                }
                #email{
                    display: inline;
                    margin-left: 10px;
                    width: 70%;
                    background-color: rgba(0, 0, 0, 0);
                    color: rgb(0, 0, 0);
                }
                #email-label{
                    color: rgba(255, 255, 255, 0.651);
                }
                #langue{
                    display: inline;
                    font-weight: bold;
                    width: 50%;
                    background-color: rgba(0, 0, 0, 0);
                    color: rgb(0, 0, 0);
                }
                #langue-label{
                    color: rgba(255, 255, 255, 0.651);
                }

                #langue-niveau{
                    display: inline;
                    width: 40%;
                    background-color: rgba(0, 0, 0, 0);
                    color: rgb(0, 0, 0);
                }
                #langue-niveau-label{
                    color: rgba(255, 255, 255, 0.651);
                }

                #competence{
                    display: inline;
                    font-weight: bold;
                    width: 50%;
                    background-color: rgba(0, 0, 0, 0);
                    color: rgb(0, 0, 0);
                }
                #competence-label{
                    color: rgba(255, 255, 255, 0.651);
                }

                #competence-niveau{
                    display: inline;
                    width: 40%;
                    background-color: rgba(0, 0, 0, 0);
                    color: rgb(0, 0, 0);
                }
                #competence-niveau-label{
                    color: rgba(255, 255, 255, 0.651);
                }

                #diplome-annee{
                    display: inline;
                    width: 30%;
                    background-color: rgba(0, 0, 0, 0);
                    text-align: right;
                    color: rgba(0, 0, 0, 0.575);
                }

                #diplome-titre{
                    display: inline;
                    font-weight: bold;
                    width: 40%;
                    background-color: rgba(0, 0, 0, 0);
                    color: rgb(0, 0, 0);
                }


                #diplome-ville{
                    display: inline;
                    width: 31%;
                    background-color: rgba(0, 0, 0, 0);
                    text-align: right;
                    color: rgb(15, 64, 156);
                }

                #diplome-description{
                    display: inline;
                    width: 60%;
                    background-color: rgba(0, 0, 0, 0);
                    color: rgb(0, 0, 0);
                }


                #experience-annee{
                    display: inline;
                    width: 30%;
                    background-color: rgba(0, 0, 0, 0);
                    text-align: right;
                    color: rgba(0, 0, 0, 0.575);
                }

                #experience-titre{
                    display: inline;
                    font-weight: bold;
                    width: 60%;
                    height: 40px;
                    background-color: rgba(0, 0, 0, 0);
                    color: rgb(0, 0, 0);
                }


                #experience-sous-domaine{
                    display: inline;
                    width: 31%;
                    background-color: rgba(0, 0, 0, 0);
                    text-align: right;
                    color: rgb(15, 64, 156);
                }

                #experience-description{
                    display: inline;
                    width: 60%;
                    height: 40px;
                    background-color: rgba(0, 0, 0, 0);
                    color: rgb(0, 0, 0);
                }

            </style>
        </div>
        <?php   require('../includes/footer.php'); ?>
      </div>
    </div>

  </div>

  <?php require('../includes/scripts.php'); ?>
  <script>
    $('body').keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
        {
            $("#form-modifier").submit();
        }
    }); 
  </script>
</body>
</html>
