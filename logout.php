<?php
    session_start();
    if(!(isset($_SESSION['id']))){
        header('Location: index.php');
    }
    setcookie('user','',time()-3600);
    setcookie('pass','',time()-3600);
    $_SESSION = array();
    session_destroy();
    header('Location: login.php');
?>
    
