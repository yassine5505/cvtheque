<ul class="sidebar navbar-nav">
  <?php if (isset($_SESSION['connected']) && isset($_SESSION['type']) && $_SESSION['type'] == 'admin'){
    ?>
    <li class="nav-item active">
      <a class="nav-link" href="ajouterEntreprise.php">
        <i class="fas fa-industry"></i>
        <span class="menu-label">Nouvelle Entreprise</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="ajouterEtudiant.php">
        <i class="fas fa-graduation-cap"></i>
        <span class="menu-label"> Nouvel Etudiant</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="listerEntreprises.php">
        <i class="fas fa-th-list"></i>
        <span class="menu-label"> Afficher les entreprises</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="listerEtudiants.php">
        <i class="fas fa-address-book"></i>
        <span class="menu-label"> Liste des étudiants</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="listerOffres.php">
        <i class="fas fa-bell"></i>
        <span class="menu-label"> Liste des offres</span>
      </a>
    </li>
    <?php } ?>
  <?php if(isset($_SESSION['connected']) && isset($_SESSION['type']) && $_SESSION['type'] == 'entreprise'){ ?>
    <li class="nav-item active">
      <a class="nav-link" href="index.php">
        <i class="fas fa-user-circle"></i>
        <span class="menu-label"> Voir mon profil</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="modifierProfil.php">
        <i class="fas fa-edit"></i>
        <span class="menu-label"> Modifier mon profil</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="ajouterOffre.php">
        <i class="fas fa-bell"></i>
        <span class="menu-label"> Ajouter une offre</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="listerCvs.php">
        <i class="fas fa-search"></i>
        <span class="menu-label"> Rechercher les CV</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="listerCandidatures.php">
        <i class="fas fa-list"></i>
        <span class="menu-label"> Voir les candidatures</span>
      </a>
    </li>
  <?php } ?>
  <?php if(isset($_SESSION['connected']) && isset($_SESSION['type']) && $_SESSION['type'] == 'student'){ ?>
    <li class="nav-item active">
      <a class="nav-link" href="CV.php">
        <i class="fas fa-file"></i>
        <span class="menu-label"> Consulter mon CV</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="modifierCV.php">
        <i class="fas fa-pen"></i>
        <span class="menu-label"> Modifier mon CV</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="index.php">
        <i class="fas fa-list"></i>
        <span class="menu-label"> Liste des offres</span>
      </a>
    </li>
  <?php } ?>
</ul>

<style>
.menu-label{
    margin-left: 5px;
}
</style>
