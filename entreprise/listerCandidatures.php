<?php
session_start();
require '../config/dbConnection.php';
require '../sources/lib.php';
checkSession("entreprise");
$idEntreprise = infoEntreprise($_SESSION['username'],$conn)->fetch()['id'];
$coo = listerCandidatures($idEntreprise,$conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CVtheque - Liste des CV </title>
  <?php require('../includes/styles.php'); ?>
</head>
<body id="page-top">
  <?php   require('../includes/topnav.php'); ?>
  <div id="wrapper">
    <?php   require('../includes/sidenav.php'); ?>
    <div id="content-wrapper">
      <div id="container-fluid">
        <?php   require('../includes/footer.php'); ?>
        <!--CONTENT START-->
          <h3 class="mx-4 my-4">Candidatures actives</h3>
          <div class="card-deck">
          <?php while($a=$coo->fetch()){ ?>
            <div class="col-4">
              <div class="card mb-3 mx-3">
                <h5 class="card-header"><?= $a['nom'] ."  ". $a['prenom']?></h5>

                <img style="height: 200px; width: 100%; display: block;"  src="../assets/imageprofil/<?= $a['image'] ?>" alt="Card image">
                <div class="card-body">
                  <p class="card-text"></p>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><i class="fa fa-phone"></i>       <?= $a['phone']?></li>
                  <li class="list-group-item"><i class="fa fa-envelope-open"></i>       <?= $a['email']?></li>
                  <li class="list-group-item">
                  <?php $co = listerCompetencesEtudiant($a['apogee'],$conn);while($c=$co->fetch()){ ?>
                    <span class="badge badge-pill badge-dark"><?= "#".strtoupper($c['competence'])?></span>
                  <?php }//end while competece ?>
                  </li>
                </ul>
                <div class="card-footer text-muted">
                  <a href="cvetudiant.php?apogee=<?= $a['apogee'] ?>" class="btn btn-block btn-primary"><i class="fa fa-file"></i>         Voir CV</a>
                </div>
              </div>
          </div>
          <?php } ?>
        </div>
        <!--CONTENT END-->
      </div>
    </div>

  </div>

  <?php require('../includes/scripts.php'); ?>
</body>
</html>
