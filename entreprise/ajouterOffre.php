<?php

session_start();

require '../config/dbConnection.php';
require '../sources/lib.php';
/*********/
$e ;
$b1 = false;$b2 = false;
if(isset($_SESSION['username'])){
//info entreprise
  $e = infoEntreprise($_SESSION['username'],$conn);
  $entrepriseId = $e->fetch()['id'];

}
else{
  //not connected as entreprise
  //destroy session and redirect
  session_destory();
  header("Location: ../index.php");
}
/********/
if(isset($_POST['submit'])){
  if(isset($_POST['intitule']) && isset($_POST['duree'])){
    $b1=ajouterOffre(clean($_POST['intitule']),clean($_POST['duree']),$entrepriseId,$conn);
  }
  for ($i=1; $i < 6; $i++) {
    if(isset($_POST['competence'.$i]) && "" != trim($_POST['competence'.$i])){
      $o = infoOffre($_POST['intitule'],$_POST['duree'],$conn);
      $idOffre = $o->fetch()['id'];
    $b2=ajouterCompetenceRequise(clean($_POST['competence'.$i]),$idOffre,$conn);
    }
  }
  if($b1 && $b2){
    echo "
      <script>
        alert('Offre ajoutée avec succès !');
      </script>
    ";
  }
  else{
    echo "
      <script>
        alert('L'offre n'a pas été ajoutée. Veuillez réessayer !');
      </script>
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
                  <input type="number" min="1"  name="duree" id="duree" class="form-control" placeholder="Durée du stage (en mois)" required="required" autofocus="autofocus">
                  <label for="duree">Durée en mois</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" id="compContainer1">
            <div class="form-row ">
              <div class="col-md-12">
                <div class="form-label-group">
                  <input type="text" name="competence1" class="form-control comp" id="competence1" placeholder="Exemple: développment web">
                  <label for="competence1">Compétence 1</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" hidden="true" id="compContainer2">
            <div class="form-row ">
              <div class="col-md-12">
                <div class="form-label-group">
                    <input type="text" name="competence2" class="form-control comp" id="competence2" placeholder="Exemple: développment web">
                    <label for="competence2">Compétence 2</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" hidden="true" id="compContainer3">
            <div class="form-row ">
              <div class="col-md-12">
                <div class="form-label-group">
                    <input type="text" name="competence3" class="form-control comp" id="competence3" placeholder="Exemple: développment web">
                    <label for="competence3">Compétence 3</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" hidden="true" id="compContainer4">
            <div class="form-row ">
              <div class="col-md-12">
                <div class="form-label-group">
                    <input type="text" name="competence4" class="form-control comp" id="competence4" placeholder="Exemple: développment web">
                    <label for="competence4">Compétence 4</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" hidden="true" id="compContainer5">
            <div class="form-row ">
              <div class="col-md-12">
                <div class="form-label-group">
                    <input type="text" name="competence5" class="form-control comp" id="competence5" placeholder="Exemple: développment web">
                    <label for="competence5">Compétence 5</label>
                </div>
              </div>
            </div>
          </div>
          <button type="button" id="addCompetence" class="btn btn-primary" ><i class="fa fa-plus"></i></button>

          <button type="submit" name="submit" class="btn btn-primary" id="submit">Ajouter offre</button>
        </form>
      </div>
        <!--END CONTENT-->
      </div>
    </div>

  </div>

  <?php require('../includes/scripts.php'); ?>

  <script type="text/javascript">
  var i=1;

    document.getElementById('addCompetence').onclick= function(){
      if(i<6){
        var j = ++i;
        var compI = "compContainer"+j;
        //console.log(compI);
        var compContainer = document.getElementById(compI);
        //console.log(compContainer.getAttribute('hidden'));
        if(compContainer.getAttribute('hidden') == "true"){
          compContainer.removeAttribute('hidden');
        }
      }
      if(i>=5){
        document.getElementById('addCompetence').setAttribute('hidden','true');
      }
    }
  </script>
  <script type="text/javascript">
    // $('#addCompetence').click(function(){
    //       $('.comp').each(function(){
    //     console.log($(this).val());  // Or this.innerHT$(this).val()ML, this.innerText
    //     });
    //
    // })


  </script>
</body>
</html>
