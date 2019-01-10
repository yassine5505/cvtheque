<pre>
<?php
  print_r($_POST);
  if (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['pwd'])) {
    if($_POST['username'] == $_POST['pwd']){
      
    }
    session_start();
    $_SESSION['apogee'] = $_POST['apogee'];

  }
?>
</pre>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CVthèque - Login</title>
  
  <!-- Bootstrap core CSS-->
  <link href="sources/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="sources/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="sources/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="sources/css/sb-admin.css" rel="stylesheet">

</head>
<body id="page-top">
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top d-flex justify-content-between">
    <div class="navbar-brand-and-bars">
      <a class="navbar-brand mr-1" href="index.php">CVthèque</a>
    </div>
  </nav>

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login (par numéro Apogée)</div>
      <div class="card-body">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
          <div class="form-group">
            <div class="form-label-group">
              <input name="username" type="text" id="username" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
              <label for="username">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input name="pwd" type="password" id="pwd" class="form-control" placeholder="Password" required="required">
              <label for="pwd">Password</label>
            </div>
          </div>
          <input class="btn btn-primary btn-block" type="submit" name="login" value="login">
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="sources/vendor/jquery/jquery.min.js"></script>
  <script src="sources/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="sources/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="sources/vendor/chart.js/Chart.min.js"></script>
  <script src="sources/vendor/datatables/jquery.dataTables.js"></script>
  <script src="sources/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="sources/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="sources/js/demo/datatables-demo.js"></script>
  <script src="sources/js/demo/chart-area-demo.js"></script>

</body>
</html>
