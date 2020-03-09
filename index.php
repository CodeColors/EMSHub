<?php 
    session_start();
    if(!(isset($_SESSION['id']))){
        header('Location: login.php');
    }else{
?>
<html>
    <head>
        <title>EMS - Accueil</title>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css">    
    </head>
    <body>
    
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container">
            <a class="navbar-brand" href="index.php"><img src="img/emshub.png" width="150" height="48"></img></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Pages
                </a>
                  <!-- Here's the magic. Add the .animate and .slide-in classes to your .dropdown-menu and you're all set! -->
                  <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="dossiers.php">Dossiers Médicaux</a>
                    <a class="dropdown-item" href="facture.php">Facturation</a>
                    <a class="dropdown-item" href="logout.php">Deconnexion</a>
                    <?php if($_SESSION['rank'] == "1"){ ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="admin_membre.php">Patron - membres</a>
                    <?php } ?>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        
        <header class="bg-primary text-center py-5 mb-4">
          <div class="container">
            <h1 class="font-weight-light text-white">Liens utiles</h1>
          </div>
        </header>

        <!-- Page Content -->
        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-0 shadow">
                <img src="img/dossierimg.jpg" class="card-img-top" alt="...">
                <div class="card-body text-center">
                  <h5 class="card-title mb-0">Dossiers Médicaux</h5>
                  <a target="_blank" href="dossiers_write.php"><div class="card-text text-black-50">Ecrire un dossiers</div></a>
                  <a target="_blank" href="dossiers.php"><div class="card-text text-black-50">Consulter les dossiers</div></a>
                </div>
              </div>
            </div>
            <!-- Team Member 4 -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-0 shadow">
                <img src="img/factureimg.png" class="card-img-top" alt="...">
                <div class="card-body text-center">
                  <h5 class="card-title mb-0">Facturation</h5>
                  <a target="_blank" href="facture.php"><div class="card-text text-black-50">Générer une facture PDF</div></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
<?php
    }
?>