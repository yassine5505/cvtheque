<?php
    session_start();
    if(isset($_SESSION['connected'])){
        $numero_apogee = $_SESSION['apogee'];
        require('../config/dbConnection.php');

        $query = "SELECT * FROM etudiants where numero_apogee='".$numero_apogee."'";
        $students = $conn->query($query);
        if($students->rowCount() == 1){
            $student = $students->fetch();

            $nom = $student['nom'];
            $prenom = $student['prenom'];
            $description = $student['description'];
            $imgPath = "../assets/imageprofil/".$student['image'];
            if(!file_exists($imgPath)){
                $imgPath = "../assets/imageprofil/man.svg";
            }
            $apogee = $numero_apogee;
            $tele = $student['phone'];
        }
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
            <div class="col-sm-2">
            </div>
            <div class="profile col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="name"><?= $nom ?> <?= $prenom ?><h5>
                        <img class="tof" width="100" src="<?=$imgPath?>" alt="">
                        <p class="desc"><?= $description ?><p>
                    </div>
                    <div class="card-footer">
                        <p align="center" class="apogee">Apogée : <?= $apogee ?><p>
                        <p align="center" class="phone">Téléphone : <?= $tele ?><p>
                    </div>
                    <a class="modify" href=""><button type="button" class="btn btn-primary"><i class="fas fa-pen"></i></button></a>
                </div>
            </div>
            <style>
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
                .profile .card-body{
                    background-image: url("../assets/backgrounds/profileBack.jpeg");
                    border-radius: 25px 25px 0px 0px!important;
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
            </style>
        </div>
        <?php   require('../includes/footer.php'); ?>
      </div>
    </div>

  </div>

  <?php require('../includes/scripts.php'); ?>
</body>
</html>
