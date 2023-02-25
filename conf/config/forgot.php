<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>login</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/login.css">

        <link rel="icon" href="images/pnghut_plex-media-server-player-symbol-tv-icon.png"/>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php
            session_start();
            require('../bdd.php');

            $mail = $_SESSION['mail'];

            $sql = $bdd->query("SELECT * FROM users WHERE mail = '$mail'");
            $donnees = $sql->fetch();
            $code = $donnees['code'];

            if(isset($_POST['submit'])){
                if($_POST['code'] == $code){
                    if($_POST['newpassword'] == $_POST['newpassword2']){
                        // récupérer le mot de passe du formulaire
                        $password = $_POST['newpassword'];
                        //requéte SQL + mot de passe crypté
                        $sql = "UPDATE users SET password ='".hash('sha256', $password)."' WHERE mail = '$mail'";
                            // Exécuter la requête sur la base de données
                            if($bdd->query($sql) == TRUE) {
                                $message = "Mot de passe modifié.";
                                //header("location: ../login.php");
                            }else {
                                $error = "erreur !!";
                            }
                    }else{
                        $error = "Les mots de passe ne sont pas identiques.";
                    }
                }else{
                    $error = "Code incorrect.";
                }
            }
        ?>
        <div class="modal-dialog modal-login">
            <div class="modal-content">

                <div class="modal-header">				
                     <h4 class="modal-title">Mot de passe oublié</h4>
                </div>

                <div class="modal-body">

                    <form class="box" action="" method="post" name="login">

                        <?php if (! empty($message)) { ?>
                            <div class="alert alert-success text-center" role="alert">
                                <p class="errorMessage"><?php echo $message; ?></p>
                            </div>
                        <?php } ?>

                        <?php if (! empty($error)) { ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <p class="errorMessage"><?php echo $error; ?></p>
                            </div>
                        <?php } ?>

                        <label for="text">Code de verification reçu par mail : </label>
                        <div class="form-group">
                            <i><img src="https://img.icons8.com/plumpy/24/000000/keypad.png" style="margin-top:-8px; margin-left:-5px;"/></i>
                            <input name="code" type="text" class="form-control" placeholder="Code de vérification" required="required">
                        </div>
                        <label for="text">Nouveau mot de passe : </label>
                        <div class="form-group">
                            <i class="fa fa-lock"></i>
                            <input name="newpassword" type="password" class="form-control" placeholder="Nouveau mot de passe" required="required">					
                        </div>
                        <div class="form-group">
                            <i class="fa fa-lock"></i>
                            <input name="newpassword2" type="password" class="form-control" placeholder="Valider mot de passe" required="required">					
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-warning color btn-block btn-lg" value="Modifier" name="submit">
                        </div>
                        <p class="box-register">Page de <a href="../login.php">connexion</a></p>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="forgot_mail.php">Retour</a>
                </div>
            </div>
        </div>
    </body>
</html>