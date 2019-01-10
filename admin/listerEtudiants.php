
  <?php
  require '../config/dbConnection.php';
  require '../sources/lib.php';

  $etudiants = listerEtudiants($conn);

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
          <h1 class="">Liste des etudiants</h1>
        </div>
        <?php   require('../includes/footer.php'); ?>
        <!--ADD CONTENT HERE-->
        <div class="col-12  ml-1">
          <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" >
            <thead>
              <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">N° Apogée</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Nom</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Prénom</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Téléphone</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Actions</th>

              </tr>
            </thead>
                  <tfoot>
                    <tr>
                      <th rowspan="1" colspan="1">Image</th>
                      <th rowspan="1" colspan="1">N° Agopée</th>
                      <th rowspan="1" colspan="1">Nom</th>
                      <th rowspan="1" colspan="1">Prenom</th>
                      <th rowspan="1" colspan="1">Téléphone</th>
                      <th rowspan="1" colspan="1">Actions</th>
                    </tr>                  </tfoot>
                  <tbody>
                  <?php while($o = $etudiants->fetch()){ ?>
                    <tr role="row" class="odd">
                      <td class="sorting_1"><?= $o['id'] ?></td>
                      <td><?= $o['numero_apogee'] ?></td>
                      <td><?= $o['nom'] ?></td>
                      <td><?= $o['prenom'] ?></td>
                      <td><?= $o['phone'] ?></td>
                      <td>
                        <a class="btn btn-sm btn-primary fa fa-pen" href="modifierEtudiant.php?idEtudiant=<?= $o['id'] ?>"></a>
                        <a class="btn btn-sm btn-danger fa fa-times" href=""></a>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
        </div>
        <!--END CONTENT-->
      </div>
    </div>

  </div>

  <?php require('../includes/scripts.php'); ?>
</body>
</html>
