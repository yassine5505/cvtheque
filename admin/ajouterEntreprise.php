<?php
require('../config/dbConnection.php');
require('../config/lib.php');
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CVtheque - Ajouter entreprise</title>
  <?php require('../includes/styles.php'); ?>
</head>
<body id="page-top">
  <?php   require('../includes/topnav.php'); ?>
  <div id="wrapper">

    <?php   require('../includes/sidenav.php'); ?>
    <div id="content-wrapper">
      <div id="container-fluid">
        <div class="col-12 ml-2">
          <h1>Ajouter entreprise</h1>
        </div>
        <?php   require('../includes/footer.php'); ?>
        <!--ADD CONTENT HERE-->
        <div class="card-body">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text"  name="nom" id="nom" class="form-control" placeholder="Nom de l'entreprise" required="required" autofocus="autofocus">
                  <label for="nom">Nom </label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text"  name="phone" id="phone" class="form-control" placeholder="Telephone entreprise" required="required" autofocus="autofocus">
                  <label for="phone">Telephone</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <textarea  name="adresse" id="adresse" class="form-control"  required="required"></textarea>
                  <label for="adresse">Adresse</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="logo">Logo de l'entreprise</label>
            <input type="file" class="form-control-file" id="logo" name="logo">
          </div>

          <button type="submit" name="submit" class="btn btn-primary btn-block">Ajouter entreprise</button>
        </form>
      </div>
        <!--END CONTENT-->
      </div>
    </div>

  </div>

  <?php require('../includes/scripts.php'); ?>
</body>
</html>
