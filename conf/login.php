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
        <link rel="stylesheet" href="css/login.css">

        <link rel="icon" href="images/pnghut_plex-media-server-player-symbol-tv-icon.png"/>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php
            require('bdd.php');
            
            if (isset($_POST['submit'])){
                
                session_start();
                
                $username   = $_POST['username'];
                $password   = $_POST['password'];

                //--------------------------------------------------------------------------------------

                $ldap_bind = @ldap_bind($ldap_connection, $username.$domain, $password);

                if($ldap_bind){
                    $sql = $bdd->query("SELECT * FROM users WHERE username='$username'");
                    $donnees = $sql->fetch();

                    if(empty($donnees['username'])){
                        $sql = "INSERT INTO `users` (username, lockuser, ldap_connection) VALUES ('$username', 1, 'true')";

                        if ($bdd->query($sql) == TRUE) {
                            $_SESSION['username'] = $username;
                            header("Location: index.php");
                        } else {
                            $message ="Erreur lors de la connexion (veuillez contacter votre administrateur)";
                            exit;
                        }
                    }else{
                        if($donnees['lockuser'] == 1 && $donnees['ldap_connection'] == 'true'){
                            $_SESSION['username'] = $username;
                            header("Location: index.php");
                        }else{
                            $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                            exit;
                        }
                    }

                    function Acces($ldap_connection, $base_dn, $filter){
                        //access groupe LDAP
                        $recherchegroupe = ldap_search($ldap_connection, $base_dn, $filter);
                        $resultatgroupe = ldap_get_entries($ldap_connection,$recherchegroupe);
                        return $resultatgroupe['count'];
                    }

                        //Filtrage qui permet de vérifier si l'utilisateur est bien dans le groupe
                        $SEC_EMBY_ACCESS = "(&(|(memberof=CN=SEC-EMBY-ACCESS,OU=Groupes de sécurité,DC=JR,DC=local))(|(sAMAccountName=$username)))";
                        $SEC_CLOUD_ACCESS = "(&(|(memberof=CN=SEC-CLOUD-ACCESS,OU=Groupes de sécurité,DC=JR,DC=local))(|(sAMAccountName=$username)))";
                        $SEC_FORTIGATE_ACCESS = "(&(|(memberof=CN=SEC-FORTIGATE-ACCESS,OU=Groupes de sécurité,DC=JR,DC=local))(|(sAMAccountName=$username)))";
                        $SEC_VPN_ACCESS = "(&(|(memberof=CN=SEC-VPN-ACCESS,OU=Groupes de sécurité,DC=JR,DC=local))(|(sAMAccountName=$username)))";
                
                        if (Acces($ldap_connection, $base_dn, $SEC_EMBY_ACCESS) == 1){
                            $_SESSION['SEC_EMBY_ACCESS'] = 'true';
                        }
                        else{
                            $_SESSION['SEC_EMBY_ACCESS'] = 'false';
                        }

                        if (Acces($ldap_connection, $base_dn, $SEC_CLOUD_ACCESS) == 1){
                            $_SESSION['SEC_CLOUD_ACCESS'] = 'true';
                        }
                        else{
                            $_SESSION['SEC_CLOUD_ACCESS'] = 'false';
                        }

                        if (Acces($ldap_connection, $base_dn, $SEC_FORTIGATE_ACCESS) == 1){
                            $_SESSION['SEC_FORTIGATE_ACCESS'] = 'true';
                        }
                        else{
                            $_SESSION['SEC_FORTIGATE_ACCESS'] = 'false';
                        }

                        if (Acces($ldap_connection, $base_dn, $SEC_VPN_ACCESS) == 1){
                            $_SESSION['SEC_VPN_ACCESS'] = 'true';
                        }
                        else{
                            $_SESSION['SEC_VPN_ACCESS'] = 'false';
                        }

                }else{
                    $passwordhash = hash('sha256', $password);

                    $sql = $bdd->query("SELECT * FROM users WHERE username='$username' and password='$passwordhash'");
                    $donnees = $sql->fetch();

                        if($donnees['username'] == $username && $donnees['password'] == $passwordhash && $donnees['lockuser'] == 1 && $donnees['ldap_connection'] != 'true'){
                            $_SESSION['username'] = $username;
                            header("Location: index.php");
                        }else{
                            $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                            exit;
                        }
                    
                     $sql->closeCursor();
                }
                ldap_close($ldap_connection);
                //--------------------------------------------------------------------------------------
            }

        ?>
        <div class="modal-dialog modal-login">
            <div class="modal-content">

                <div class="modal-header">				
                     <h4 class="modal-title">Connexion</h4>
                </div>

                <div class="modal-body">

                    <form class="box" action="" method="post" name="login">

                        <?php if (! empty($message)) { ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <p class="errorMessage"><?php echo $message; ?></p>
                            </div>
                        <?php } ?>

                        <div class="form-group">
                            <i class="fa fa-user"></i>
                            <input name="username" type="text" class="form-control" placeholder="Nom d'utilisateur" required="required">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-lock"></i>
                            <input name="password" type="password" class="form-control" placeholder="Mot de passe" required="required">					
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-warning color btn-block btn-lg" value="connexion" name="submit">
                        </div>

                        <!--<p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p>-->
                        <p class="box-register">Mot de passe oublié ? <a href="config/forgot_mail.php">Cliquer ici</a></p>

                    </form>

                </div>
            </div>
        </div>
    </body>
</html>