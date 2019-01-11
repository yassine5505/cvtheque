
  <?php
  session_start();

  require '../config/dbConnection.php';
  require '../sources/lib.php';
  checkSession();
  $offres = listerOffres($conn);
  // while($o = $offres->fetch()){
  //     // print_r($o);
  // }

   ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CVtheque - Offres de stage</title>
  <?php require('../includes/styles.php'); ?>
</head>
<body id="page-top">
  <?php   require('../includes/topnav.php'); ?>
  <div id="wrapper">

    <?php   require('../includes/sidenav.php'); ?>
    <div id="content-wrapper">
      <div id="container-fluid">
        <div class="col-12 ml-2">
          <h1 class="">Liste des offres de stage</h1>
        </div>
        <?php   require('../includes/footer.php'); ?>
        <!--ADD CONTENT HERE-->
        <div class="col-12 row ml-1">
        <?php
          while($o = $offres->fetch()){
         ?>
          <div class="card col-lg-4 col-sm-12"  style="width: 18rem;">
            <img class="card-img-top" src="../assets/logos/<?= $o['logo']?>" alt="Card image cap">
            <div class="card-body">
              <div class="row">
                <div class="col-12" style="display:inline;">
                  <strong><?= strtoupper( $o['nom']) ?></strong>
                </div>

              </div>
              <h5 class="card-title" style="display: inline;"></h5></a>
              <p class="card-text"><i class="fa fa-comments" style="color: grey;"></i>   <strong><?= $o['intitule']?></strong></p>
              <p class="card-text"><i class="fa fa-calendar" style="color: grey;"></i>   <?= $o['duree']?></p>
              <p class="card-text"><i class="fa fa-phone" style="color: grey;"></i>   <?= $o['phone']?></p>
              <p class="card-text"><i class="fa fa-home" style="color: grey;"></i>   <?= $o['adresse']?></p>
            </div>
          </div>
        <?php } ?>
        </div>
        <!--END CONTENT-->
      </div>
    </div>

  </div>

  <?php require('../includes/scripts.php'); ?>
</body>
</html>
