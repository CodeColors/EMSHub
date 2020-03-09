<?php
    session_start();
    if(!(isset($_SESSION['id']))){
        header('Location: login.php');
    }

    require('db.php');

    if($_GET['type'] == "1"){
        if($_SESSION['rank'] == "1"){
            if(!empty($_GET['id'])){
                $dossier = $bdd->query('SELECT * FROM dossiers WHERE id='.$_GET['id']);
                $info = $dossier->fetch();

                if(isset($_POST['submit'])){
                    $req = $bdd->prepare('UPDATE dossiers SET patient = :patient, tel = :tel, cause = :cause, itt = :itt, facture = :facture, charge = :charge WHERE id = :id');
                    $req->execute(array(
                        'patient' => $_POST['victimem'],
                        'tel' => $_POST['telm'],
                        'cause' => $_POST['causem'],
                        'itt' => $_POST['ittm'],
                        'facture' => $_POST['facturem'],
                        'charge' => $_POST['chargem'],
                        'id' => $_GET['id']
                    ));
                    header('Location: dossiers.php');
                }
            }
        }else{
            header('Location: index.php');
        }
    }elseif($_GET['type'] == "2"){
        if($_SESSION['rank'] == "1"){
            if(!empty($_GET['id'])){
                $bdd->query("DELETE FROM dossiers WHERE id=".$_GET['id']);
                header('Location: dossiers.php');
            }
        }else{
            header('Location: index.php');
        }
    }else{
        if(isset($_POST['dossiers'])){
            $req = $bdd->prepare('INSERT INTO dossiers(date, patient, tel, cause, itt, facture, charge) VALUES(CURDATE(), :patient, :tel, :cause, :itt, :facture, :charge)');
            $req->execute(array(
                'patient' => $_POST['victime'],
                'tel' => $_POST['tel'],
                'cause' => $_POST['cause'],
                'itt' => $_POST['itt'],
                'facture' => $_POST['facture'],
                'charge' => $_POST['charge']
            ));
            header('Location: dossiers.php');
        }
    }


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
        <div class="container">
            <br />
        <?php if(isset($_GET['type'])) { ?>
            <form method="post" class="form-signin">
            <h1>Modifier un dossier</h1>
            <label>Prénom et NOM :</label><input type="text" class="form-control" name="victimem" value="<?php echo $info['patient']; ?>" required autofocus/>
            <label>Numéro de téléphone :</label><input type="text"  class="form-control" name="telm" value="<?php echo $info['tel']; ?>" required/>
            <label>Cause</label><input type="text"  class="form-control" name="causem" value="<?php echo $info['cause']; ?>" required/>
            <label>ITT + Prescription</label><input type="text"  class="form-control" name="ittm" value="<?php echo $info['itt']; ?>" required/>
            <label>Facture</label><input type="text"  class="form-control" name="facturem" value="<?php echo $info['facture']; ?>" required/>
            <label>Personnel en chage</label><input type="text"  class="form-control" name="chargem" value="<?php echo $info['charge']; ?>" required/>
            <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="Valider" />
        </form>
        <?php }else{ ?>

        <form method="post" class="form-signin">
            <h1>Enregistrer un nouveau dossier</h1>
            <label>Prénom et NOM :</label><input type="text" class="form-control" name="victime" required autofocus/>
            <label>Numéro de téléphone :</label><input type="text"  class="form-control" name="tel" required/>
            <label>Cause</label><input type="text"  class="form-control" name="cause" required/>
            <label>ITT + Prescription</label><input type="text"  class="form-control" name="itt" required/>
            <label>Facture</label><input type="text"  class="form-control" name="facture" required/>
            <label>Personnel en chage</label><input type="text"  class="form-control" name="charge" required/>
            <input type="submit" class="btn btn-lg btn-primary btn-block" name="dossiers" value="Valider" />
        </form>
        <?php } ?>
        </div>


    </body>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

</html>
