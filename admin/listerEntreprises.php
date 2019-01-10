
  <?php
  require '../config/dbConnection.php';
  require '../sources/lib.php';

  $entreprises = listerEntreprises($conn);

   ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CVtheque - Lister entreprises</title>
  <?php require('../includes/styles.php'); ?>
</head>
<body id="page-top">
  <?php   require('../includes/topnav.php'); ?>
  <div id="wrapper">

    <?php   require('../includes/sidenav.php'); ?>
    <div id="content-wrapper">
      <div id="container-fluid">
        <div class="col-12 ml-2">
          <h1 class="">Liste des entreprises</h1>
        </div>
        <?php   require('../includes/footer.php'); ?>
        <!--ADD CONTENT HERE-->
        <div class="col-12 row ml-1">
        <?php
          while($e = $entreprises->fetch()){
         ?>
          <div class="card col-lg-4 col-sm-12"  style="width: 18rem;">
            <img class="card-img-top" src="../assets/logos/<?= $e['logo']?>" alt="Card image cap">
            <div class="card-body">
              <div class="row">
                <div class="col-6" style="display:inline;">
                  <?= strtoupper( $e['nom']) ?>
                </div>
                <div class="col-6" style="display:inline;">
                  <a href="modifierEntreprise.php?nomEntreprise=<?= $e['nom'] ?>" class=" ml-4 btn btn-primary btn-sm fa fa-pen"></a>
                </div>
              </div>
              <h5 class="card-title" style="display: inline;"></h5></a>
              <p class="card-text"><i class="fa fa-phone" style="color: grey;"></i>   <?= $e['phone']?></p>
              <p class="card-text"><i class="fa fa-home" style="color: grey;"></i>   <?= $e['adresse']?></p>
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
