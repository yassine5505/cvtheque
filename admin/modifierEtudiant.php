
  <?php
  require '../config/dbConnection.php';
  require '../sources/lib.php';
  if (isset($_GET['idEtudiant'])){
    $e = infoEtudiant((int)$_GET['idEtudiant'],$conn)->fetch();
    // print_r($_POST)['submit'];

    if(isset($_POST['submit']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['phone']) && isset($_POST['description']) ){
    //submit form
    if(modifierEtudiant((int)$_GET['idEtudiant'],clean($_POST['nom']),clean($_POST['prenom']),clean($_POST['phone']),clean($_POST['description']),$conn)){
      echo "
        <script>alert('".$_POST['nom']." modifié avec succès.');
        location.href = 'listerEtudiants.php';
        </script>
      ";

    }
    else{
      echo "
        <script>alert('".$_POST['nom']." n'a pas été modifié.Veuillez réessayer.')</script>
      ";
    }
  }
}

  else{
    // redirect
    header("Location: listerEtudiants.php");
  }

   ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CVtheque - Modifer étudiant</title>
  <?php require('../includes/styles.php'); ?>
</head>
<body id="page-top">
  <?php   require('../includes/topnav.php'); ?>
  <div id="wrapper">

    <?php   require('../includes/sidenav.php'); ?>
    <div id="content-wrapper">
      <div id="container-fluid">
        <div class="col-12 ml-2">
          <h2>Modifier étudiant: <i><?= strtoupper($e['nom'] . " " . $e['prenom'])?></i></h2>
        </div>
        <?php   require('../includes/footer.php'); ?>
        <!--ADD CONTENT HERE-->
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text"  name="nom" id="nom" class="form-control" value="<?= $e['nom'] ?>" required="required" autofocus="autofocus">
                  <label for="nom">Nom </label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text"  name="prenom" id="prenom" class="form-control" value="<?= $e['prenom'] ?>" required="required" autofocus="autofocus">
                  <label for="prenom">Prénom</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-6">
                <div class="form-label-group">
                  <input type="text" id="apogee" name="apogee" class="form-control"  value="<?= $e['numero_apogee'] ?>" disabled></textarea>
                  <label for="apogee">Apogée</label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-label-group">
                  <input  type="text" id="phone" name="phone" class="form-control"  value="<?= $e['phone'] ?>" required="required"></textarea>
                  <label for="phone">Téléphone</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-12">
                <div class="form-label-group">
                  <textarea  name="description" id="description" class="form-control"><?= $e['description'] ?></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" class="form-control-file" id="photo" name="photo">
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
