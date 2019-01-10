
  <?php
  require '../config/dbConnection.php';
  require '../sources/lib.php';
    if(isset($_POST['submit']) && isset($_POST['nom']) && isset($_POST['phone']) && isset($_POST['adresse'])){
    //submit form

    if(ajouterEntreprise(clean($_POST['nom']),clean($_POST['adresse']),clean($_POST['phone']),clean($_POST['description']),$conn)){
      echo "
        <script>alert('".$_POST['nom']." ajouté avec succès.')</script>
      ";
    }
    else{
      echo "
        <script>alert('".$_POST['nom']." n'a pas été ajouté.Veuillez réessayer.')</script>
      ";
    }


  }

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
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
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
              <div class="col-6">
                <div class="form-label-group">
                  <textarea  name="adresse" id="adresse" class="form-control"  placeholder="Adresse de l'entreprise" required="required"></textarea>
                </div>
              </div>
              <div class="col-6">
                <div class="form-label-group">
                  <textarea  name="description" id="description" class="form-control"  placeholder="Description de l'entreprise"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="logo">Logo de l'entreprise</label>
            <input type="file" class="form-control-file" id="logo" name="logo">
          </div>

          <button type="submit" name="submit" class="btn btn-primary">Ajouter entreprise</button>
        </form>
      </div>
        <!--END CONTENT-->
      </div>
    </div>

  </div>

  <?php require('../includes/scripts.php'); ?>
</body>
</html>
