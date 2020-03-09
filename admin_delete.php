<?php
    session_start();
    if(!(isset($_SESSION['id']))){
        header('Location: login.php');
    }
    if(!(isset($_GET['id']))){
        echo 'Erreur. Clique <a href="admin_membre.php">ici</a> pour retourner sur la page des comptes.';
    }else{
        require('db.php');
        $bdd->query("DELETE FROM users WHERE id=".$_GET['id']);

        header('Location: admin_membre.php');
    }
?>
