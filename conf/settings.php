<?php
    require('../verif_session.php');
    require('bdd.php');

    $user = $_SESSION['username'];

    $sql = $bdd->query("SELECT * FROM users WHERE username = '$user'");
    $donnees = $sql->fetch();
    $idsession = $donnees['id'];
    $_SESSION['idsession'] = $idsession;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Paramètres</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        <link rel="icon" href="images/pnghut_plex-media-server-player-symbol-tv-icon.png"/>
        
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/loader.scss">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
    <body background="https://preview.colorlib.com/theme/bootstrap/website-menu-03/images/xhero_1.jpg.pagespeed.ic.IGCCr8gcb6.webp">

    <?php if($donnees['admin'] == 1){ ?>
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">		

                    <a href="index.php" class="close"><img src="https://img.icons8.com/plumpy/48/000000/undo.png"/></a>

                     <h4 class="modal-title"><img src="https://img.icons8.com/plumpy/48/000000/settings.png"/> Maintenance</h4>
                </div>
                <?php
                    if (isset($_POST['validerMTN'])){
                        $text = $_POST['TXT'];

                        if(isset($_POST['check']) == 'on'){
                            $check = 'true';
                        }else{
                            $check = 'false';
                        }

                        $sql = "UPDATE maintenance SET maintenance='$check', text = '$text';";
                        // Exécuter la requête sur la base de données
                        $bdd->query($sql);    
                    }

                    $sql = $bdd->query("SELECT * FROM maintenance");
                    $MTNcheck = $sql->fetch();
                ?>
                <div class="modal-body">
                    <form class="box" action="" method="post" name="login">

                    <style>
                        .switch {
                        position: relative;
                        display: inline-block;
                        width: 40px;
                        height: 24px;
                        }

                        .switch input { 
                        opacity: 0;
                        width: 0;
                        height: 0;
                        }

                        .slider {
                        position: absolute;
                        cursor: pointer;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background-color: #ccc;
                        -webkit-transition: .4s;
                        transition: .4s;
                        }

                        .slider:before {
                        position: absolute;
                        content: "";
                        height: 16px;
                        width: 16px;
                        left: 4px;
                        bottom: 4px;
                        background-color: white;
                        -webkit-transition: .4s;
                        transition: .4s;
                        }

                        input:checked + .slider {
                        background-color: #2196F3;
                        }

                        input:focus + .slider {
                        box-shadow: 0 0 1px #2196F3;
                        }

                        input:checked + .slider:before {
                        -webkit-transform: translateX(16px);
                        -ms-transform: translateX(16px);
                        transform: translateX(16px);
                        }

                        /* Rounded sliders */
                        .slider.round {
                        border-radius: 34px;
                        }

                        .slider.round:before {
                        border-radius: 50%;
                        }
                    </style>

                        <?php 
                            if($MTNcheck['maintenance'] == 'true'){ 
                                ?>
                                    <div class="alert alert-info text-center" style="padding:10px;" role="alert">
                                        <p class="errorMessage"><?= "Maintenance en cours"; ?></p>
                                    </div>
                                <?php
                            }
                        ?>

                        <label class="switch">
                        <input type="checkbox" name="check" <?php if($MTNcheck['maintenance'] == 'true'){ ?> checked <?php } ?>>
                        <span class="slider round"></span>
                        </label><br>
                        
                        <textarea style="overflow:auto;resize:none" name="TXT" rows="5" cols="60" ><?= $MTNcheck['text'] ?></textarea><br><br>

                        <button name="validerMTN" type="submit" class="btn btncolor">Validé</button>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
        <div class="modal-dialog modal-login">
            <div class="modal-content">                
                <div class="modal-header">		

                    <a href="index.php" class="close"><img src="https://img.icons8.com/plumpy/48/000000/undo.png"/></a>

                     <h4 class="modal-title"><img src="https://img.icons8.com/plumpy/48/000000/settings.png"/> Paramètres</h4>
                </div>
               
                <?php
                    $user = $_SESSION['username'];

                    if (isset($_POST['valider'])){

                        if($_POST['pwd1'] == "" || $_POST['pwd2'] == ""){
                            ?>
                                <div class="alert alert-danger text-center" style="padding:10px;" role="alert">
                                    <p class="errorMessage"><?= "Les champs ne peuvent pas être vide."; ?></p>
                                </div>
                            <?php
                        }else{
                            if($_POST['pwd1'] != $_POST['pwd2']){
                                ?>
                                    <div class="alert alert-danger text-center" style="padding:10px;" role="alert">
                                        <p class="errorMessage"><?= "Les mots de passe ne sont pas identiques."; ?></p>
                                    </div>
                                <?php
                            }else{
                                // récupérer le mot de passe du formulaire
                                $password = $_POST['pwd1'];

                                if($donnees['ldap_connection'] == 'false'){ // ldap connexion false
                                    //requéte SQL + mot de passe crypté
                                    $sql = "UPDATE users SET password ='".hash('sha256', $password)."' WHERE username = '$user'";
                                    // Exécuter la requête sur la base de données
                                    if ($bdd->query($sql) == TRUE) {
                                        ?>
                                            <div class="alert alert-success text-center" style="padding:10px;" role="alert">
                                                <p class="errorMessage"><?= "Mot de passe modifié."; ?></p>
                                            </div>
                                        <?php
                                    } else {
                                        ?>
                                            <div class="alert alert-danger text-center" style="padding:10px;" role="alert">
                                                <p class="errorMessage"><?= "Erreur !! Le mot de passe n'a pas été modifié."; ?></p>
                                            </div>
                                        <?php
                                    }
                                }
                                if($donnees['ldap_connection'] == 'true'){ // ldap connexion true

                                }
                            } 
                        }           
                    }
                ?>
                <div class="modal-body">
                    <form class="box" action="" method="post" name="login">

                        <label for="exampleInputPassword1">Nouveau mot de passe </label>
                            <div class="form-group">
                                <i class="fa fa-lock"></i>
                                <input name="pwd1" type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe" required>
                            </div>

                        <label for="exampleInputPassword2">Confirmation du mot de passe </label>
                            <div class="form-group">
                                <i class="fa fa-lock"></i>
                                <input name="pwd2" type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe" required>
                            </div>
                        <button name="valider" type="submit" class="btn btncolor">Modifié</button>
                    </form>
                </div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
            </div>
        </div>
<!--_________________________________________________________________________________________________________________________________________________________________________________-->
<!--_________________________________________________________________________________________________________________________________________________________________________________-->
<!-- Modal add -->
<form class="box" action="" method="post" name="inscription">
            <div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>

                    <h3 class="modal-title" id="exampleModalLabel"><img src="https://img.icons8.com/plumpy/48/000000/edit-user-male.png"/></h3>
                </div>
                <div class="modal-body">
                    <div class="modal-dialog modal-login modaladduser">
                        <?php

                            $sql = $bdd->query("SELECT admin FROM users WHERE username = '$user'");
                            $donnees = $sql->fetch();
                            ?>
                                <label for="color">Nom d'utilisateur :</label>
                                <div class="form-group">
                                    <i class="fa fa-user"></i>
                                    <input name="username" type="text" class="form-control" placeholder="Nom d'utilisateur" required="required">
                                </div>

                                <label for="color">Mail :</label>
                                <div class="form-group">
                                    <i class="fa fa-envelope"></i>
                                    <input name="mail" type="email" class="form-control" placeholder="Mail" required="required">
                                </div>

                                <label for="color">Nom :</label>
                                <div class="form-group">
                                    <i class="fa fa-user"></i>
                                    <input name="lastname" type="text" class="form-control" placeholder="Nom" required="required">
                                </div>

                                <label for="color">Prénom :</label>
                                <div class="form-group">
                                    <i class="fa fa-user"></i>
                                    <input name="firstname" type="text" class="form-control" placeholder="Prénom" required="required">
                                </div>

                                <label for="color">Mot de passe :</label>
                                <div class="form-group">
                                    <i class="fa fa-lock"></i>
                                    <input name="password" type="password" class="form-control" placeholder="Mot de passe" required="required">
                                </div>
                            <?php 
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
                    <input type="submit" name="inscription" value="Ajouter" class="btn btncolor" />
                </div>
                </div>
            </div>
            </div>
        </form>
<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------->        
        <?php

            $sql = $bdd->query("SELECT * FROM users WHERE username = '$user'");
            $donnees = $sql->fetch();

        if($donnees['readinguser'] != 1 && $donnees['adduser'] != 1){ 
            
        }else{
            ?>
                <div class="modal-dialog modal-login">
                    <div class="modal-content">

                        <!-------- Appel au modale ajout utilisateur + message --------->
                            <?php
                                if (isset($_POST['inscription'])){

                                    $username = $_POST['username'];
                                    $firstname = $_POST['firstname'];
                                    $lastname = $_POST['lastname'];
                                    $password = $_POST['password'];
                                    $mail = $_POST['mail'];

                                    if($username == "" || $firstname =="" || $lastname == "" || $password =="" || $mail ==""){                                        
                                        ?>
                                            <div class="alert alert-danger text-center" style="padding:10px;" role="alert">
                                                <p class="errorMessage"><?= "Les champs ne peuvent pas être vide."; ?></p>
                                            </div>
                                        <?php
                                    }else{
                                        $sql = "INSERT into `users` (username, firstname, lastname, mail, password) VALUES ('$username','$firstname','$lastname','$mail', '".hash('sha256', $password)."')";
                                        // Exécuter la requête sur la base de données
                                        if ($bdd->query($sql) == TRUE) {
                                            ?>
                                                <div class="alert alert-success text-center" style="padding:10px;" role="alert">
                                                    <p class="errorMessage"><?= "Utilisateur ajouté."; ?></p>
                                                </div>
                                            <?php
                                        } else {
                                            ?>
                                                <div class="alert alert-danger text-center" style="padding:10px;" role="alert">
                                                    <p class="errorMessage"><?= "Echec de l'ajout de l'utilisateur."; ?></p>
                                                </div>
                                            <?php
                                        }
                                    }
                                }
                            ?>

                            <!-- Button trigger modal ajout utilisateur -->
                            <div class="modal-header">				
                                <h4 class="modal-title">
                                    <img src="https://img.icons8.com/plumpy/48/000000/edit-user-male.png"/> Utilisateurs
                                    <?php 
                                        if($donnees['adduser'] == 1){
                                            ?>
                                                <a href='#AddUser' data-toggle='modal'><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAApklEQVRIie2UQQrCMBBFX5yKtEfwHvZIvYSbnC/XqOANAiJDXFi17SZDKIKYv5oJ+fMT8ghUZeTMOz1HgR5H0obAmavFtrPOF8dJHK1AJzd6q88eAN27lk+9WUCpakBWS0wnFMXRlgxTiGuEFzd4oVh0VJ6krRH+7htoQ1CIpcNUiXogzNfMX8Xek+b93du8v4/pHwUkuMzacfsAxzCFjAkGq68qqwcpGCIcr616AwAAAABJRU5ErkJggg=="></a>
                                            <?php
                                        }
                                    ?>
                                </h4>
                            </div>                       
                            <!------------------------------------------------------------------------------------------------------------------>
                            <form class="box" action="" method="post" name="verif">

                                <?php 
                                if($donnees['readinguser'] == 1){ 
                                    ?>
                                    
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nom d'utilisateur</th>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Prénom</th>
                                                <?php if($donnees['edituser'] != 2 || $donnees['deleteuser'] != 2){
                                                    ?><th style="text-align:center;" scope="col">Actions</th><?php
                                                } ?>
                                                <th scope="col">Profil</th>
                                                <th scope="col">Connexion LDAP</th>
                                            </tr>
                                        </thead>

                                        <?php
                                            $sql = $bdd->query("SELECT * FROM users");
                                            
                                                foreach($sql as $row){
                                                    $id = $row['id'];
                                                    $userrow =  $row['username'];
                                                    ?>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row"><?= $id ?></th>
                                                                <td><?= $row['username']; ?></td>
                                                                <td><?= $row['lastname']; ?></td>
                                                                <td><?= $row['firstname']; ?></td>
                                                                <?php if($donnees['edituser'] != 2 || $donnees['deleteuser'] != 2){ ?>
                                                                <td style="text-align:center;">
                                                                    <?php                                                  
                                                                        if($donnees['edituser'] == 1){
                                                                            if($row['admin'] == 0 || $user == $userrow){
                                                                                ?>
                                                                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAACW0lEQVRIidWVz2sTURDHv995K2KtB3uRJlts0UM9JcVbCUGPLWgP/QP8KzxYEYLgD/Cf8C8QRLHgoZQYvQVbD+qhUqQbexDaQ9tUze6MB2V3X5LG1FvfaXfevO9nZnZnHnDSFwdtWg2y26yEhyqhwM4DNvL3WFvBXYpG41cbEWvQYwNaC9UJl2gZxOigIBLDPn7JWvF1fWsogAH8drNadqbTg4R7QLF8LizX1whY3i7djv8jDgAu0OnW/Gyp2+5l0FqoTjjVSreTKUogF0EtmNGR3ILiLWgrJDp53zgO3oTLq1FPBlaDINFyv+go3ADMwThC4DTMLoN2C8D9xDCW9w1cPGO1TDd92G1WQnfkB7UDkg8BbHZtXBTgthlO5Woyut2shD2AjkqYP2mKEsCzQ0Fo1/MGZ67YAzBRL1WQi2a2NAxETSr+e6aVARRnfIAWAExB9S6oudLZAU0egPYlM5mXfdaQfX7TLAwKABg5iYRLHkS0TXWPUgjN72Qy7YUUQMGh5yTWSuMhJ03ljlcu0TYhjwFsGhh5Zy3TSgGJyo6fgTS6cpoa8E2eebExSbVyGagfBW0FwNdhIEJ8yDsFLuhttPEXjQjAXqpPdBR4Mhwktwz7YzP1tLxZBoAmP2U97+uIHSPuCe0pwA0YfgDWNqCjZpf66cdJ8D4/vnumaWuuOuOC4w87AKDh44WXDS/IvuP6+/xsSZ1cOY54nOin4qt3693j+sgLJ5q7FgZBXAZw7h/ae3EcrOUn6FAAADBAtm9UQmeu+Kf9sytTKDuBs2jseb1FHH1lnvz1GxsCBK4t9uKUAAAAAElFTkSuQmCC">
                                                                                <?php
                                                                            }else{
                                                                                if($donnees['admin'] == 0 || $donnees['admin'] == 1){
                                                                                    if($row['lockuser'] == 1){
                                                                                    ?>
                                                                                        <a href="config/lock.php?id=<?= $id; ?>"><img src="https://img.icons8.com/plumpy/24/000000/unlock.png"></a>
                                                                                    <?php 
                                                                                    }else{
                                                                                        ?>
                                                                                            <a href="config/unlock.php?id=<?= $id; ?>"><img src="https://img.icons8.com/plumpy/24/000000/lock.png"></a>
                                                                                        <?php
                                                                                    }
                                                                                
                                                                                    //bouton modal editer un utilisateur
                                                                                    ?>
                                                                                        <a href="config/edit.php?id=<?= $id; ?>"><img src="https://img.icons8.com/plumpy/24/000000/edit.png"/></a>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        }
                                                                        if($row['admin'] != 0){                                                
                                                                            if($donnees['deleteuser'] == 1){
                                                                                //bouton modal suppression d'utilisateur
                                                                                ?>
                                                                                    <a href='#DeleteUser' data-toggle='modal' data-id="<?= $id;?>" class='open-DeleteUser'><img src="https://img.icons8.com/plumpy/24/000000/delete-forever.png"></a>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <?php
                                                                } 
                                                                ?>
                                                                <td>
                                                                <?php 
                                                                if($row['admin']==0){echo "Super admin";}
                                                                if($row['admin']==1){echo "Super admin";}
                                                                if($row['admin']==2){echo "Admin";}
                                                                if($row['admin']==3){echo "Utilisateur";}
                                                                ?>
                                                                
                                                                </td>
                                                                <td>
                                                                <?php 
                                                                if($row['ldap_connection']=='true'){echo "Oui";}
                                                                if($row['ldap_connection']=='false'){echo "Non";}
                                                                ?>
                                                                
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    <?php
                                                }
                                            ?>
                                    </table>
                                <?php 
                                } 
                                ?>
                            </form>
                        
                    </div>
                </div>
            <?php
        }
        ?>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
        <!-- Modal delete -->
        <form class="box" action="config/delete.php" method="post" name="delete">     
            <div class="modal fade" id="DeleteUser">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title"><img src="https://img.icons8.com/plumpy/48/000000/delete-user-male.png"/></h3>
                </div>
                <div class="modal-body">

                    <script> 
                        $(document).on("click", ".open-DeleteUser", function () {
                            var myBookId = $(this).data('id');
                            $(".modal-body #bookId").val( myBookId );
                            });
                    </script>

                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAADyElEQVRoge2Zy08bZxTFz7ljYxMIKWnCQ1EJRAEllELBC2ThRlZbqaVA1I27q9RV/g7+i7ZS1eybXaUuImUR9bFrFiy6yoJGiIeNYJOWYuOZ00WaFjQzeF5pNv5JXvj77nfPPZ7H9zDQpUuXLq8TvoqkAthYqUyA3jAAHMvqYz/8vElAWWtlbuC7Ws2589deFdTQmQ6x8WPvyOPPHjxws9SzLJMBQOV4b85XPABQQ5Xjvbms9TI1cLC8OGDiZFi/PEwd1kqXstTM1EDLyS+AXmhOx8Rms7iQpWZmBrZWy9dIjHaKoziytVq+lpVuJga0DsvTmY8u6ixofT0T7UySHDwpTwG4GDXeIfp3nzycykI7tYHNarV4otxM3HFUbkbVajGtfmoDxX53llQ+7jhS+b1+dzatfioDz1YqgxRuJB1P4cbWR+XLaWpIZaBALsAUOJtLWJLw9T+fpWB10QpWSlNDYgOHa5WxwBkXgAxFEvfw4sG+SOKegYWgWEe8srNWGUtaRyIDqtWclqd3wwNwWcK/z4WEvEu9GVqE682rVnOS1JLIQP1o+zaMfaEBMv9tFdT2Escu1I+2byepJbaBrVq5V7BEYuchcXpnrXQh7rjYBuwoP09DLu64TtCh46g/9mo1loGdteoVmHc9rkhU2nTHd5ffuxpnTGQDAuigtZDoSYuIA0BUSTE2WpENNFYqE4KFvkmywhwMNlYqE5HjowT9WirlYUw97UfFJeZUKkVankQy8NZo77Sg3sgV0PNv3oPawooiio3R3ulIsZ0CGtVqv6BbUcUBwBEPALT+a2ET8g7i5BDs1v7dpY5L9I4G2n0n8yBjva08qEngSwKHBA4FfUVYM04O0LMTF+Gz/cuw8zrrdz8YlprvxxLOmOMWH48//Gk3rD/0lxVAT8eZbsCTUMh78+e9VkMNbH9SmST4Rip1A2HpDs9IXtpfvXMzXCKA32pv9xgVe5t4Ggkfy8V9ufwWwodpcrWp2afLNwOX44EGBo8G3zELXr9HwtMwhM8B9AAqCPrCDLGWCGeLVE+fjQT+oD4DB8uLA0YLvWTRFO06ePrWoXltjadKCU5uflr13dI+A20rzJx3uhYFB94znD6JFmQ5/p4mJ0zsOfF8k5uvUNfU8XStEy5YJ3Af4B8AnpP8xvOwnzZvDhgJaDsLdfbiJ4Z4ROjRiy8Z/S0QcIDguwKSV89GLXsI+WrzGfjTa29IPPl/SooOwRapDX97AE+XFwf6LDfnmA0J6nn15YVDsEWoTmrj6ve/PH+dtXTp0qWLn78B9KoYYdTKaTQAAAAASUVORK5CYII=">                        
                        Voulez-vous supprimer l'utilisateur ?
                        <input type="hidden" name="bookId" id="bookId">
                        
                </div>
                <div class="modal-footer">
                    <input type="submit" name="delete" value="Supprimer" class="btn btn-danger"/>
                </div>
                </div>
            </div>
            </div>
        </form>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
        <?php
            if(isset($_POST['favori'])){
                
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
                    $sql = "INSERT into `dashboard` (iduser, urlimg, urlredirect, urlname) VALUES ('$idsession', '$urlimg', '$urlredirect', '$urlname')";
                        // Exécuter la requête sur la base de données
                        if ($bdd->query($sql) == TRUE) {
                            $message = "Ajouter avec succes";
                        } else {
                            $erreur ="erreur";
                        }
                }
            }
        ?>
        
        <!-- Modal add url-->
        <form class="box" action="" method="post" name="favoris">
            <div class="modal fade" id="Addurl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>

                    <h3 class="modal-title" id="exampleModalLabel"><img src="https://img.icons8.com/plumpy/48/000000/add-image.png"/></h3>
                </div>

                <div class="modal-body">
                    <div class="modal-dialog modal-login modaladduser">

                        <label for="color">URL Image</label>
                            <div class="form-group">
                                <i class="fa fa-user"></i>
                                <input name="urlimg" type="text" class="form-control" placeholder="URL Image" >
                            </div>

                        <label for="color">URL Redirection</label>
                            <div class="form-group">
                                <i class="fa fa-user"></i>
                                <input name="urlredirect" type="text" class="form-control" placeholder="URL Redirection" >
                            </div>
                        
                        <label for="color">Titre</label>
                            <div class="form-group">
                                <i class="fa fa-user"></i>
                                <input name="urlname" type="text" class="form-control" placeholder="Titre" >
                            </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
                    <input type="submit" name="favori" value="Ajouter" class="btn btncolor"/>
                </div>
                </div>
            </div>
            </div>
        </form>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">				
                    <h4 class="modal-title">
                        <img src="https://img.icons8.com/plumpy/48/000000/speedometer.png"/> Tableau de bord
                        <a href='#Addurl' data-toggle='modal'><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAApklEQVRIie2UQQrCMBBFX5yKtEfwHvZIvYSbnC/XqOANAiJDXFi17SZDKIKYv5oJ+fMT8ghUZeTMOz1HgR5H0obAmavFtrPOF8dJHK1AJzd6q88eAN27lk+9WUCpakBWS0wnFMXRlgxTiGuEFzd4oVh0VJ6krRH+7htoQ1CIpcNUiXogzNfMX8Xek+b93du8v4/pHwUkuMzacfsAxzCFjAkGq68qqwcpGCIcr616AwAAAABJRU5ErkJggg=="></a>
                    </h4><br>

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

                        <form class="box" action="" method="post" name="verif">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">URL Image</th>
                                            <th scope="col">Titre</th> 
                                            <th style="text-align:center;"scope="col">Actions</th>
                                        </tr> 
                                    </thead>

                                    <?php
                                        $sql = $bdd->query("SELECT * FROM dashboard WHERE iduser='$idsession'");

                                            foreach($sql as $row){
                                            $id = $row['id'];
                                                ?>
                                                    <tbody>
                                                        <tr>
                                                            <th style="vertical-align: middle;" scope="row"><?= $id ?></th>

                                                                <td><img style="width: 60px;" src=<?= $row['urlimg']; ?>></td>
                                                                <td style="vertical-align: middle; "><a target="_blank" href="<?= $row['urlredirect']; ?>"><?= $row['urlname']; ?></a></td>
                                                                <td style="vertical-align: middle; text-align:center;">
                                                                    <a href="config/editurl.php?id=<?= $id;?>" class='open-deleteurl'><img src="https://img.icons8.com/plumpy/24/000000/edit.png"/></a>
                                                                    <a href='#deleteurl' data-toggle='modal' data-id="<?= $id;?>" class='open-deleteurl'><img src="https://img.icons8.com/plumpy/24/000000/delete-forever.png"></a>
                                                                </td>
                                                        </tr>
                                                
                                                    </tbody>
                                                <?php
                                            }
                                        ?>
                                </table>
                            <?php 
                                $sql2 = $bdd->query("SELECT * FROM dashboard WHERE iduser='$idsession'");
                                $donnees2 = $sql2->fetch();  
                        
                                if(empty($donnees2)){
                                    ?>
                                    <div style="text-align:center;">Aucun lien ajouté</div>
                                    <?php
                                }
                            ?>
                        </form>
                </div>        
            </div>
        </div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
        <!-- Modal delete -->
        <form class="box" action="config/deleteurl.php" method="post" name="deleteurl">     
            <div class="modal fade" id="deleteurl">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title"><img src="https://img.icons8.com/plumpy/48/000000/delete-user-male.png"/></h3>
                </div>
                <div class="modal-body">

                    <script> 
                        $(document).on("click", ".open-deleteurl", function () {
                            var myBookId = $(this).data('id');
                            $(".modal-body #bookId").val( myBookId );
                            });
                    </script>

                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAADyElEQVRoge2Zy08bZxTFz7ljYxMIKWnCQ1EJRAEllELBC2ThRlZbqaVA1I27q9RV/g7+i7ZS1eybXaUuImUR9bFrFiy6yoJGiIeNYJOWYuOZ00WaFjQzeF5pNv5JXvj77nfPPZ7H9zDQpUuXLq8TvoqkAthYqUyA3jAAHMvqYz/8vElAWWtlbuC7Ws2589deFdTQmQ6x8WPvyOPPHjxws9SzLJMBQOV4b85XPABQQ5Xjvbms9TI1cLC8OGDiZFi/PEwd1kqXstTM1EDLyS+AXmhOx8Rms7iQpWZmBrZWy9dIjHaKoziytVq+lpVuJga0DsvTmY8u6ixofT0T7UySHDwpTwG4GDXeIfp3nzycykI7tYHNarV4otxM3HFUbkbVajGtfmoDxX53llQ+7jhS+b1+dzatfioDz1YqgxRuJB1P4cbWR+XLaWpIZaBALsAUOJtLWJLw9T+fpWB10QpWSlNDYgOHa5WxwBkXgAxFEvfw4sG+SOKegYWgWEe8srNWGUtaRyIDqtWclqd3wwNwWcK/z4WEvEu9GVqE682rVnOS1JLIQP1o+zaMfaEBMv9tFdT2Escu1I+2byepJbaBrVq5V7BEYuchcXpnrXQh7rjYBuwoP09DLu64TtCh46g/9mo1loGdteoVmHc9rkhU2nTHd5ffuxpnTGQDAuigtZDoSYuIA0BUSTE2WpENNFYqE4KFvkmywhwMNlYqE5HjowT9WirlYUw97UfFJeZUKkVankQy8NZo77Sg3sgV0PNv3oPawooiio3R3ulIsZ0CGtVqv6BbUcUBwBEPALT+a2ET8g7i5BDs1v7dpY5L9I4G2n0n8yBjva08qEngSwKHBA4FfUVYM04O0LMTF+Gz/cuw8zrrdz8YlprvxxLOmOMWH48//Gk3rD/0lxVAT8eZbsCTUMh78+e9VkMNbH9SmST4Rip1A2HpDs9IXtpfvXMzXCKA32pv9xgVe5t4Ggkfy8V9ufwWwodpcrWp2afLNwOX44EGBo8G3zELXr9HwtMwhM8B9AAqCPrCDLGWCGeLVE+fjQT+oD4DB8uLA0YLvWTRFO06ePrWoXltjadKCU5uflr13dI+A20rzJx3uhYFB94znD6JFmQ5/p4mJ0zsOfF8k5uvUNfU8XStEy5YJ3Af4B8AnpP8xvOwnzZvDhgJaDsLdfbiJ4Z4ROjRiy8Z/S0QcIDguwKSV89GLXsI+WrzGfjTa29IPPl/SooOwRapDX97AE+XFwf6LDfnmA0J6nn15YVDsEWoTmrj6ve/PH+dtXTp0qWLn78B9KoYYdTKaTQAAAAASUVORK5CYII=">                        
                        Voulez-vous supprimer le lien ?
                        <input type="hidden" name="bookId" id="bookId">
                        
                </div>
                <div class="modal-footer">
                    <input type="submit" name="deleteurl" value="Supprimer" class="btn btn-danger"/>
                </div>
                </div>
            </div>
            </div>
        </form>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
    </body>
</html>

