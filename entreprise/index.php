<?php
session_start();
require '../config/dbConnection.php';
require '../sources/lib.php';
checkSession("entreprise");
$nom = $_SESSION['username'];
$e = infoEntreprise($nom,$conn)->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CVtheque - Postuler offre </title>
  <?php require('../includes/styles.php'); ?>
</head>
<body id="page-top">
  <?php   require('../includes/topnav.php'); ?>
  <div id="wrapper">
    <?php   require('../includes/sidenav.php'); ?>
    <div id="content-wrapper">
      <div id="container-fluid">

        <?php   require('../includes/footer.php'); ?>
        <!-- CONTENT START-->
        <div class=" mx-5 my-5 card">
                    <div class="card-body profile-header">
                        <img class="tof" width="130" src="../assets/logos/<?= $e['logo'] ?>" alt="">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <i class="fas fa-industry cv-icon"></i> <span class="cv-label"> <?= strtoupper($e['nom'])  ?></span>
                                <hr class="hr">

                                <p>
                                </p><p class="phone" style="letter-spacing:.6em;"><i class="fas fa-comment"></i> <?= $e['description'] ?></p><p>
                                <br>

                            </div>
                            <div class="col-sm-12">
                                <i class="fas fa-info-circle cv-icon"></i> <span class="cv-label">Informations</span>
                                <hr class="hr">
                                  <p class="apogee"><i class="fas fa-map"></i>  <?= $e['adresse'] ?></p><p>
                                    <p class="apogee"><i class="fas fa-phone"></i> <?=$e['phone'] ?></p><p>
                                      <br>

                                    <div class="my-5 col-12">
                                      <a href="modifierProfil.php" class="btn btn-block btn-primary"><i class="fa fa-edit"></i>     Modifier profil</a>
                                    </div>
                            </div>

                        </div>
                    </div>

                </div>
        <!-- CONTENT END-->
      </div>
    </div>

  </div>

  <?php require('../includes/scripts.php'); ?>
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
        filter: grayscale(5);
          background-image: url("../assets/backgrounds/blue.png");
          /*border-radius: 25px 25px 0px 0px!important;*/
          border-style: none;
      }
      .profile-footer{
          margin-top: 100px;
          background-image: url("../assets/backgrounds/profileBack.jpeg");
          /*border-radius: 25px 25px 25px 25px !important;*/
          border-style: none;
      }
      .card-footer{
          background: rgba(200,207,215,0.43);
          border-style: none;
          /*border-radius: 0px 0px 25px 25px!important;*/
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
</body>
</html>
