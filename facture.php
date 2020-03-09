<?php 
    session_start();
    if(!(isset($_SESSION['id']))){
        header('Location: login.php');
    }
?>

<html>
    <head>
        <title>EMS - Facturation</title>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css">    
    </head>
    <body>
    
        
        <div class="container">
            <h1>Generation de facture</h1>
            <form method="post" action="facture_write.php">
                <input type="text" name="nom" placeholder="Patient" required autofocus>
                <input type="text" name="tel" placeholder="Numéro de téléphone" required>
                <input type="text" name="facture" placeholder="N* de facture" required><br>
                <hr>
                <input type='checkbox' name='ope' value='ope'>Opération<hr>
                
                <input type='checkbox' name='sca' value='sca'>Scanner
                <input type='checkbox' name='dia' value='dia'>Diagnostic<hr>
                
                <input type='checkbox' name='gro' value='gro'>Gros Soins
                <input type='checkbox' name='pet' value='pet'>Petit Soins<hr>
                
                <input type='checkbox' name='a' value='a'>Transport A
                <input type='checkbox' name='b' value='b'>Transport B
                <input type='checkbox' name='c' value='c'>Transport C<br>
                <input type='checkbox' name='cha' value='cha'>Charge Hélico<hr>
                
                <input type="submit" name="submit" class="btn btn-primary">
            </form>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    </body>
</html>