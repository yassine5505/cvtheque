<nav class="navbar navbar-expand navbar-dark bg-dark static-top d-flex justify-content-between">
  <div class="navbar-brand-and-bars">
    <a class="navbar-brand mr-1" href="">CVthèque</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
  </div>

  <!-- Navbar -->
  <ul class="navbar-nav ml-auto ml-md-0">

    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle fa-fw"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <?php
        if (isset($_SESSION['connected']) && isset($_SESSION['type'])){
          if ($_SESSION['type'] == 'admin'){
        ?>
          <a class="dropdown-item" href="profil.php"><i class="fa fa-file"></i>   Profil</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../index.php"><i class="fa fa-power-off"></i>   Se déconnecter</a>
        <?php

        }
        else if($_SESSION['type'] == 'entreprise'){
        ?>
        <a class="dropdown-item" href="index.php"><i class="fa fa-file"></i>    Profil</a>
        <a class="dropdown-item" href="listerCvs.php"><i class="fa fa-list"></i>    Liste CVs</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="../index.php"><i class="fa fa-power-off"></i>   Se déconnecter</a>
        <?php
        }
        else if($_SESSION['type']=='student'){ ?>
          <a class="dropdown-item" href="CV.php"><i class="fa fa-file"></i>    CV</a>
          <a class="dropdown-item" href="modifierCV.php"><i class="fa fa-pen"></i>    Modifier CV</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../index.php"><i class="fa fa-power-off"></i>   Se déconnecter</a>
        <?php }
      } ?>
      </div>
    </li>
  </ul>

</nav>
