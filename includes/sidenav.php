<ul class="sidebar navbar-nav">
  <?php if (isset($_SESSION['connected']) && isset($_SESSION['type']) && $_SESSION['type'] == 'admin'){
    ?>
    <li class="nav-item active">
      <a class="nav-link" href="ajouterEntreprise.php">
        <i class="fas fa-industry"></i>
        <span>Nouvelle Entreprise</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="ajouterEtudiant.php">
        <i class="fas fa-graduation-cap"></i>
        <span>Nouvel Etudiant</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="listerEntreprises.php">
        <i class="fas fa-th-list"></i>
        <span>Afficher les entreprises</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="listerEtudiants.php">
        <i class="fas fa-address-book"></i>
        <span>Liste des étudiants</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="listerOffres.php">
        <i class="fas fa-bell"></i>
        <span>Liste des offres</span>
      </a>
    </li>
    <?php } ?>
  <?php if(isset($_SESSION['connected']) && isset($_SESSION['type']) && $_SESSION['type'] == 'entreprise'){ ?>
    <li class="nav-item active">
      <a class="nav-link" href="ajouterOffre.php">
        <i class="fas fa-bell"></i>
        <span>Ajouter une offre</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="listerCvs.php">
        <i class="fas fa-list"></i>
        <span>Candidatures</span>
      </a>
    </li>
  <?php } ?>
  <?php if(isset($_SESSION['connected']) && isset($_SESSION['type']) && $_SESSION['type'] == 'student'){ ?>
    <li class="nav-item active">
      <a class="nav-link" href="CV.php">
        <i class="fas fa-file"></i>
        <span>Consulter mon CV</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="modifierCV.php">
        <i class="fas fa-pen"></i>
        <span>Modifier mon CV</span>
      </a>
    </li>
  <?php } ?>
</ul>
