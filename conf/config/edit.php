<?php
    require('../../verif_session.php');
    require('../bdd.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    //--------------------------------------------------------------------------------------
    $user = $_SESSION['username'];

    $sql2 = $bdd->query("SELECT * FROM users WHERE username = '$user'");
    $donnees2 = $sql2->fetch();
    $admin = $donnees2['admin'];

    if($donnees2['edituser'] == 2){
        header("Location: ../conf/login.php");
        exit(); 
    }

    //--------------------------------------------------------------------------------------
    $sql = $bdd->query("SELECT * FROM users WHERE id = '$id'");
    $donnees = $sql->fetch();

    //_________________________________________________________________________________________________________________
    //_________________________________________________________________________________________________________________
    if(isset($_POST['valider'])){
        //----------------------------
        if(isset($_POST['edit'])){
            $edituser = 1;
        }else{
            $edituser = 2;
        }
        //----------------------------
        if(isset($_POST['delete'])){
            $deleteuser = 1;
        }else{
            $deleteuser = 2;
        }
        //----------------------------
        if(isset($_POST['add'])){
            $adduser = 1;
        }else{
            $adduser = 2;
        }
        //----------------------------
        if(isset($_POST['readinguser'])){
            $readinguser = 1;
        }else{
            $readinguser = 2;
        }
    //_________________________________________________________________________________________________________________
    //_________________________________________________________________________________________________________________

        $champsvide = 0;
        $champspassword = 0;

        if(!empty($_POST['username'])){
            $username = $_POST['username'];
        }else{
            $erreur = "Erreur !! Les champs Nom d'utilisateur, mail, nom et prénom ne peuvent pas être vide !";
            $champsvide = 1;
        }

        if(!empty($_POST['mail'])){
            $mail = $_POST['mail'];
        }else{
            $erreur = "Erreur !! Les champs Nom d'utilisateur, mail, nom et prénom ne peuvent pas être vide !";
            $champsvide = 1;
        }
        
        if(!empty($_POST['firstname'])){
            $firstname = $_POST['firstname'];
        }else{
            $erreur = "Erreur !! Les champs Nom d'utilisateur, mail, nom et prénom ne peuvent pas être vide !";
            $champsvide = 1;
        }

        if(!empty($_POST['lastname'])){
            $lastname = $_POST['lastname'];
        }else{
            $erreur = "Erreur !! Les champs Nom d'utilisateur, mail, nom et prénom ne peuvent pas être vide !";
            $champsvide = 1;
        }

        if(!empty($_POST['password'])){
            $password = $_POST['password'];
        }else{
            $champspassword = 1;
        }

        $choix = $_POST['navbar'];
  
        if($champsvide != 1 && $champspassword != 1){
            $sql = "UPDATE users SET admin='$choix', edituser ='$edituser', deleteuser='$deleteuser', adduser='$adduser', readinguser='$readinguser', username='$username' , mail='$mail', firstname='$firstname', lastname='$lastname', password='".hash('sha256', $password)."' WHERE id = '$id'";

            // Exécuter la requête sur la base de données
            if ($bdd->query($sql) == TRUE) {
                $message = "Modifications avec succes";
            } else {
                $erreur ="erreur";
            }
        }
        if($champsvide != 1 && $champspassword == 1){
            $sql = "UPDATE users SET admin='$choix', edituser ='$edituser', deleteuser='$deleteuser', adduser='$adduser', readinguser='$readinguser', username='$username' , mail='$mail', firstname='$firstname', lastname='$lastname' WHERE id = '$id'";

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

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nom d'utilisateur</label>
                            <input type="text" name="username" class="form-control"  value="<?= $donnees['username'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Mail</label>
                            <input type="mail" name="mail" class="form-control"  value="<?= $donnees['mail'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nom</label>
                            <input type="text" name="lastname" class="form-control"  value="<?= $donnees['lastname'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Prénom</label>
                            <input type="text" name="firstname" class="form-control" value="<?= $donnees['firstname'] ?>">
                        </div>

                        <?php
                        if($donnees['ldap_connection'] == 'false'){
                        ?>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Mot de passe</label>
                                <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                            </div>
                        <?php
                        }
                        ?>

                    <?php if($admin == 1 || $admin == 0){
                        ?>
                        <table class="table">

                        <div class="modal-footer"></div>

                        <label for="color"><img src="https://img.icons8.com/plumpy/48/000000/user-credentials.png"/> Droits de l'utilisateur :</label>
                                <thead>
                                    <tr>
                                        <th>Modification</th>
                                        <th>Suppression</th>
                                        <th>Ajout</th>
                                        <th>Lecture</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><div class="form-check"><input <?php if($donnees['edituser'] == 1){ ?> checked <?php } ?> class="form-check-input" type="checkbox" name="edit" value="edit" id="edit"></div></td>
                                        <td><div class="form-check"><input <?php if($donnees['deleteuser'] == 1){ ?> checked <?php } ?> class="form-check-input" type="checkbox" name="delete" value="delete" id="delete"></div></td>
                                        <td><div class="form-check"><input <?php if($donnees['adduser'] == 1){ ?> checked <?php } ?> class="form-check-input" type="checkbox" name="add" value="add" id="add"></div></td>
                                        <td><div class="form-check"><input <?php if($donnees['readinguser'] == 1){ ?> checked <?php } ?> class="form-check-input" type="checkbox" name="readinguser" value="readinguser" id="readinguser"></div></td>
                                    </tr>
                                </tbody>
                            </table>
                    
                        <label for="color"><img src="https://img.icons8.com/plumpy/48/000000/microsoft-admin.png"/> Profile utilisateur :</label>
                            <select name="navbar" data-show-content="true" class="form-control">
                                <option <?php if ($donnees['admin']==1){ ?> selected="selected" <?php } ?> value="1">Super admin</option>
                                <option <?php if ($donnees['admin']==2){ ?> selected="selected" <?php } ?> value="2">Admin</option>
                                <option <?php if ($donnees['admin']==3){ ?> selected="selected" <?php } ?> value="3">Utilisateur</option>
                            </select><br>
                    <?php
                    }
                    ?>
                        <button name="valider" type="submit" class="btn btncolor">Modifié</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>