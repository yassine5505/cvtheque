<?php
session_start();
require '../config/dbConnection.php';
require '../sources/lib.php';
checkSession("entreprise");
$selected;
if(isset($_POST['submit']) && isset($_POST['experience']) && isset($_POST['diplome']) && isset($_POST['competence'])){
  $selected = filterCv(clean($_POST['competence']),clean($_POST['experience']),clean($_POST['diplome']),$conn);
  // var_dump($selected);

}
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
          <!--form-->
            <!--recherche offre par: intitule, duree, nom entreprise-->
          <div class="card-body">
          <form method="POST">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-label-group">
                    <input type="text" name="experience" id="experience" class="form-control" placeholder="Exeprience" autofocus="autofocus">
                    <label for="experience">Expérience</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-label-group">
                    <input type="text" id="competence" name="competence" class="form-control" placeholder="Compétence">
                    <label for="competence">Compétence</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-label-group">
                    <input type="text" min="0" id="diplome" name="diplome" class="form-control" placeholder="Diplome" autofocus="autofocus">
                    <label for="diplome">Diplôme</label>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-label-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-md" id="submit" href=""><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>

          </form>

        </div>
          <!--form end-->

          <!--RESULTS START -->
            <?php
              if(isset($selected)){
                ?>
                <div class="card-deck">
                <?php
                while($a = $selected->fetch()){?>
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
                          <a href="cvetudiant.php?apogee=<?= $a['apogee'] ?>" class="btn btn-block btn-primary"><i class="fa fa-play"></i>         Voir CV</a>
                        </div>
                      </div>
                  </div>
              <?php } ?>
              </div>
            <?php }else{ ?>
            <div class="row mx-5 my-5">
              <p>Pas de résultats à afficher.</p>
            </div>
          <?php } ?>
          <!-- RESULTS END-->
        <!--CONTENT END-->
      </div>
    </div>

  </div>

  <?php require('../includes/scripts.php'); ?>
</body>
</html>
