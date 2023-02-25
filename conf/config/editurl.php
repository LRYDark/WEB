<?php
    require('../../verif_session.php');
    require('../bdd.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    //--------------------------------------------------------------------------------------
    $user = $_SESSION['username'];

    $sql = $bdd->query("SELECT * FROM users WHERE username = '$user'");
    $donnees = $sql->fetch();

    $sql2 = $bdd->query("SELECT * FROM dashboard WHERE id = '$id'");
    $donnees2 = $sql2->fetch();
    
    if(isset($_POST['valider'])){
        $champsvide = 0;

        if(!empty($_POST['urlimg'])){
            $urlimg = $_POST['urlimg'];
        }else{
            $erreur = "Erreur !! Les champs ne peuvent pas être vide !";
            $champsvide = 1;
        }

        if(!empty($_POST['urlredirect'])){
            $urlredirect = $_POST['urlredirect'];
        }else{
            $erreur = "Erreur !! Les champs ne peuvent pas être vide !";
            $champsvide = 1;
        }
        
        if(!empty($_POST['urlname'])){
            $urlname = $_POST['urlname'];
        }else{
            $erreur = "Erreur !! Les champs ne peuvent pas être vide !";
            $champsvide = 1;
        }

        if($champsvide != 1){
            $sql = "UPDATE dashboard SET urlimg='$urlimg', urlredirect='$urlredirect', urlname='$urlname' WHERE id = '$id'";

            // Exécuter la requête sur la base de données
            if ($bdd->query($sql) == TRUE) {
                $message = "Modifications avec succes";
            } else {
                $erreur ="erreur";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        <link rel="icon" href="images/pnghut_plex-media-server-player-symbol-tv-icon.png"/>
        
        <link rel="stylesheet" href="../css/style.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
    <body>
        <div class="modal-dialog modal-login">
            <div class="modal-content">

                <div class="modal-header">		

                    <a href="../settings.php" class="close"><img src="https://img.icons8.com/plumpy/48/000000/undo.png"/></a>

                    <h3 class="modal-title"><img src="https://img.icons8.com/plumpy/48/000000/edit.png"/></h3>
                </div>

                <?php if (! empty($erreur)) { ?>
                        <div class="alert alert-danger text-center" style="padding:10px;" role="alert">
                            <p class="errorMessage"><?= $erreur; ?></p>
                        </div>
                    <?php } ?>

                    <?php if (! empty($message)) { ?>
                        <div class="alert alert-success text-center" style="padding:10px;" role="alert">
                            <p class="errorMessage"><?= $message; ?></p>
                        </div>
                    <?php } ?>

                <div class="modal-body">
                    <form class="box" action="" method="post" name="edit">
                    
                        <label for="color">URL Image</label>
                            <div class="form-group">
                                <i class="fa fa-image"></i>
                                <input name="urlimg" type="text" class="form-control" value="<?= $donnees2['urlimg'] ?>" >
                            </div>

                        <label for="color">URL Redirection</label>
                            <div class="form-group">
                                <i class="fa fa-link"></i>
                                <input name="urlredirect" type="text" class="form-control" value="<?= $donnees2['urlredirect'] ?>" >
                            </div>

                        <label for="color">Nom</label>
                            <div class="form-group">
                                <i class="fa fa-user"></i>
                                <input name="urlname" type="text" class="form-control" value="<?= $donnees2['urlname'] ?>" >
                            </div>

                        <button name="valider" type="submit" class="btn btncolor">Modifié</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>