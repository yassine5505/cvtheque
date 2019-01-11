<?php
session_start();
require '../config/dbConnection.php';
require '../sources/lib.php';
checkSession("student");

if(isset($_POST['submit'])){
  // $o = filterOffres($)
  if(isset($_POST['competence']) && isset($_POST['duree']) && isset($_POST['entreprise']))#
  {
    // $intitule, $duree, $nomEntreprise,$conn
    $v = filterOffres(clean($_POST['competence']),clean($_POST['duree']),clean($_POST['entreprise']),$conn);
  }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CVtheque - Liste des offres de stage </title>
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
                    <input type="text" name="entreprise" id="entreprise" class="form-control" placeholder="Nom de l'entreprise" autofocus="autofocus">
                    <label for="entreprise">Nom entreprise</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-label-group">
                    <input type="text" id="competence" name="competence" class="form-control" placeholder="Compétence">
                    <label for="competence">Compétence recherchée</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-label-group">
                    <input type="number" mi="0" id="duree" name="duree" class="form-control" placeholder="Durée du stage" autofocus="autofocus">
                    <label for="duree">Durée</label>
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
              if(isset($v)){
                $i =0;
                while($a = $v->fetch()){ if($i%3==0){?>
                  <div class="row">
                    <div class="col-4">
                      <div class="card mb-3 mx-3">
                        <h3 class="card-header"><?= $a['nom']?></h3>
                        <div class="card-body">
                          <h5 class="card-title"><?= $a['intitule'] ?></h5>
                        </div>
                        <img style="height: 200px; width: 100%; display: block;" src="../assets/logos/<?= $a['logo'] ?>" alt="Card image">
                        <div class="card-body">
                          <p class="card-text"></p>
                        </div>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item"><i class="fa fa-calendar"></i>       <?= $a['duree'] . " mois"?></li>
                          <li class="list-group-item"><i class="fa fa-map"></i>       <?= $a['adresse']?></li>
                          <li class="list-group-item">
                          <?php $co = listerCompetences($a['offre_id'],$conn);while($c=$co->fetch()){ ?>
                            <span class="badge badge-pill badge-dark"><?= "#".strtoupper($c['competence'])?></span>
                          <?php }//end while competece ?>
                          </li>
                        </ul>
                        <div class="card-footer text-muted">
                          <a href="postulerOffre.php?idOffre=<?= $a['offre_id'] ?>" class="btn btn-block btn-primary"><i class="fa fa-play"></i>         Postuler</a>
                        </div>
                      </div>
                  </div>
                </div>
            <?php  } else{ ?>
              <div class="col-4">
                <div class="card mb-3 mx-3">
                  <h3 class="card-header"><?= $a['nom']?></h3>
                  <div class="card-body">
                    <h5 class="card-title"><?= $a['intitule'] ?></h5>
                  </div>
                  <img style="height: 200px; width: 100%; display: block;" src="../assets/logos/<?= $a['logo'] ?>" alt="Card image">
                  <div class="card-body">
                    <p class="card-text"></p>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fa fa-calendar"></i>       <?= $a['duree'] . " mois"?></li>
                    <li class="list-group-item"><i class="fa fa-map"></i>       <?= $a['adresse']?></li>
                    <li class="list-group-item">
                    <?php $co = listerCompetences($a['offre_id'],$conn);while($c=$co->fetch()){ ?>
                      <span class="badge badge-pill badge-dark"><?= "#".strtoupper($c['competence'])?></span>
                    <?php }//end while competece ?>
                    </li>
                  </ul>
                  <div class="card-footer text-muted">
                    <a href="postulerOffre.php?idOffre=<?= $a['offre_id'] ?>" class="btn btn-block btn-primary"><i class="fa fa-play"></i>         Postuler</a>
                  </div>
                </div>
            </div>
          <?php }$i++;}  }else{ ?>
            <div class="row ">
              <h5>Pas de résultats à afficher.</h5>
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
