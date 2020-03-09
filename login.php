<?php
    session_start();
    if(isset($_SESSION['id'])){
        header('Location: index.php');
    }
    require('db.php');
    if(isset($_COOKIE['user']) && isset($_COOKIE['pass'])){
        $search = $bdd->prepare('SELECT * FROM users WHERE user = :user');
        $search->execute(array(
            'user' => $_COOKIE['user']
        ));
        $result = $search->fetch();

        $_SESSION = array();

        $_SESSION['id'] = $result['id'];
        $_SESSION['user'] = $result['user'];
        $_SESSION['rank'] = $result['rank'];

        header('Location: index.php');
    }

    if(isset($_POST['signin'])){


        $search = $bdd->prepare('SELECT * FROM users WHERE user = :user');
        $search->execute(array(
            'user' => $_POST['user']
        ));
        $result = $search->fetch();

        if(!$result){
            echo "Mauvais identifiants.";
        }else{
            $isPasswordCorrect = password_verify($_POST['pass'], $result['pass']);
            if($isPasswordCorrect){
                $_SESSION['id'] = $result['id'];
                $_SESSION['user'] = $result['user'];
                $_SESSION['rank'] = $result['rank'];

                if(isset($_POST['remember'])){
                    setcookie('user', $_SESSION['user'], time()+365*24*3600,null,null,false,true);
                    setcookie('pass', $_POST['pass'], time()+365*24*3600,null,null,false,true);
                }

                header('Location: index.php');
            }else{
                echo "Mauvais identifiants.";
            }
        }
    }
?>

<html>
    <head>
        <title>EMS - Connection</title>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>

        <div class="container-fluid">
          <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
              <div class="login d-flex align-items-center py-5">
                <div class="container">
                  <div class="row">
                    <div class="col-md-9 col-lg-8 mx-auto">
                      <h3 class="login-heading mb-4">Espace EMS - Los Santos</h3>
                      <form method="post">
                        <div class="form-label-group">
                          <input name="user" type="text" id="inputEmail" class="form-control" placeholder="Identifiant" required autofocus>
                          <label for="inputEmail">Identifiant</label>
                        </div>

                        <div class="form-label-group">
                          <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
                          <label for="inputPassword">Mot de passe</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember" checked>
                  <label class="custom-control-label" for="customCheck1">Se souvenir </label>
                </div>
                        <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" name="signin">Connection</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
