<?php
require '../config/dbConnection.php';
require '../sources/lib.php';

/**offre
*intitule
*competences
*duree
**/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CVtheque - Ajouter offre stage</title>
  <?php require('../includes/styles.php'); ?>
</head>
<body id="page-top">
  <?php   require('../includes/topnav.php'); ?>
  <div id="wrapper">

    <?php   require('../includes/sidenav.php'); ?>
    <div id="content-wrapper">
      <div id="container-fluid">
        <div class="col-12 ml-2">
          <h1>Ajouter offre de stage</h1>
        </div>
        <?php   require('../includes/footer.php'); ?>
        <!--ADD CONTENT HERE-->
        <div class="card-body">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text"  name="intitule" id="intitule" class="form-control" placeholder="Intitulé du stage" required="required" autofocus="autofocus">
                  <label for="intitule">Intitulé de l'offre</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="number" min="0" max="20" name="duree" id="duree" class="form-control" placeholder="Durée du stage (en mois)" required="required" autofocus="autofocus">
                  <label for="duree">Durée en mois</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="competence">Compétences</label>

          </div>

          <button type="submit" name="submit" class="btn btn-primary">Ajouter offre</button>
        </form>
      </div>
        <!--END CONTENT-->
      </div>
    </div>

  </div>

  <?php require('../includes/scripts.php'); ?>
</body>
</html>
