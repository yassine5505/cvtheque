
  <?php
  require '../config/dbConnection.php';
  require '../sources/lib.php';
  if (isset($_GET['nomEntreprise'])){
    $e = infoEntreprise($_GET['nomEntreprise'],$conn)->fetch();
    // print_r($_POST)['submit'];
    if(isset($_POST['submit']) && isset($_POST['nom']) && isset($_POST['phone']) && isset($_POST['adresse']) && isset($_POST['description'])){

    //submit form
    if(modifierEntreprise(clean($_POST['nom']),clean($_POST['phone']),clean($_POST['adresse']),clean($_POST['description']),(int)$e['id'],$conn)){
      echo "
        <script>alert('".$_POST['nom']." modifié avec succès.');
        location.href = 'listerEntreprises.php';
        </script>
      ";

    }
    else{
      echo "
        <script>alert('".$_POST['nom']." n'a pas été ajouté.Veuillez réessayer.')</script>
      ";
    }
  }
}

  else{
    // redirect
    header("Location: listerEntreprises.php");
  }





   ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CVtheque - Modifier entreprise</title>
  <?php require('../includes/styles.php'); ?>
</head>
<body id="page-top">
  <?php   require('../includes/topnav.php'); ?>
  <div id="wrapper">

    <?php   require('../includes/sidenav.php'); ?>
    <div id="content-wrapper">
      <div id="container-fluid">
        <div class="col-12 ml-2">
          <h2>Modifier <i><?php echo $_GET['nomEntreprise']; ?></i></h2>
        </div>
        <?php   require('../includes/footer.php'); ?>
        <!--ADD CONTENT HERE-->
        <div class="card-body">
        <form  method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text"  name="nom" id="nom" class="form-control" value="<?= $e['nom']?>" required="required" autofocus="autofocus">
                  <label for="nom">Nom </label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text"  name="phone" id="phone" class="form-control" value="<?= $e['phone']?>" required="required" autofocus="autofocus">
                  <label for="phone">Telephone</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col">
                <div class="form-label-group">
                  <textarea  name="adresse" id="adresse" class="form-control"  required="required"><?= $e['adresse']?></textarea>
                </div>
              </div>
              <div class="col">
                <div class="form-label-group">
                  <textarea  name="description" id="description" class="form-control"><?= $e['description']?></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="logo">Logo de l'entreprise</label>
            <input type="file" class="form-control-file" id="logo" name="logo">
          </div>

          <button type="submit" name="submit" class="btn btn-primary">Modifier</button>
        </form>
      </div>
        <!--END CONTENT-->
      </div>
    </div>

  </div>

  <?php require('../includes/scripts.php'); ?>
</body>
</html>
