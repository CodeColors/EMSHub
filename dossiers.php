<?php
    session_start();
    if(!(isset($_SESSION['id']))){
        header('Location: login.php');
    }

require('db.php');

$dossierslist = $bdd->query('SELECT * FROM dossiers');
?>
<html>
    <head>
        <title>EMS - Dossiers</title>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>


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
        <hr />
        <div class="container">
        <h1>Liste des dossiers</h1>
        <a href="dossiers_write.php" class="btn btn-primary">Ecrire un dossier</a>
        <table id="list" class="table table-striped datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Date</th>
                  <th scope="col">Patient</th>
                  <th scope="col">Téléphone</th>
                  <th scope="col">Intitulé</th>
                  <th scope="col">ITT+prescription</th>
                  <th scope="col">Facture</th>
                  <th scope="col">Personnel en charge</th>
                  <?php if($_SESSION['rank'] == "1"){ ?>
                  <th scope="col">Actions</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
        <?php
            while($data = $dossierslist->fetch()){
        ?>
                <tr>
                  <th scope="row"><?php echo $data['id']; ?></th>
                  <th><?php echo $data['date']; ?></th>
                  <td><?php echo $data['patient']; ?></td>
                  <td><?php echo $data['tel']; ?></td>
                  <th><?php echo $data['cause']; ?></th>
                  <th><?php echo $data['itt']; ?></th>
                  <th><?php echo $data['facture']; ?></th>
                  <th><?php echo $data['charge']; ?></th>
                    <?php if($_SESSION['rank'] == "1"){ ?>
                <th><a href="dossiers_write.php?type=1&id=<?php echo $data['id']; ?>">Modifier</a>   <a href="dossiers_write.php?type=2&id=<?php echo $data['id']; ?>">Supprimer</a></th>
                  <?php } ?>
                </tr>

        <?php
            }
        ?>
                  </tbody>
            </table>
        </div>


    </body>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jqc-1.12.4/dt-1.10.18/datatables.min.js"></script>

        <script type="text/javascript">
            $('#list').dataTable({

            });
        </script>
</html>
<?php
    $dossierslist->closeCursor();
?>
