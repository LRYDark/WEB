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

            if(isset($_POST['submit'])){

                $mail = $_POST['mail'];
                $_SESSION['mail'] = $mail;
                
                $sql = $bdd->query("SELECT * FROM users WHERE mail = '$mail'");
                $donnees = $sql->fetch();

                if(!empty($donnees['mail'])){
                    if($donnees['mail'] == $mail){

                        $mail = $_SESSION['mail'];
                        $code = rand(10000, 99999);

                        $sql = "UPDATE users SET code='$code' WHERE mail = '$mail'";

                        // Exécuter la requête sur la base de données
                        if ($bdd->query($sql) == TRUE) {
                            header("location: forgot.php");
                        } else {
                            $error ="Erreur !!";
                        }
                        //----------------------------------------------------------------

                        //----------------------------------------------------------------
                    }
                }
                else{
                    $error ="Aucun utilisateur n'est associé à cette adresse mail.";
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

                        <?php if (! empty($error)) { ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <p class="errorMessage"><?php echo $error; ?></p>
                            </div>
                        <?php } ?>

                        <label for="text">Adresse mail : </label>
                        <div class="form-group">
                            <i class="fa fa-envelope"></i>
                            <input name="mail" type="mail" class="form-control" placeholder="Adresse mail" required="required">					
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-warning color btn-block btn-lg" value="Confirmer" name="submit">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="../login.php">Retour</a>
                </div>
            </div>
        </div>
    </body>
</html>