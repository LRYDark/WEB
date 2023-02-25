<?php
    require('../verif_session.php');
    require('bdd.php');

    $user = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Web</title>

    <link rel="icon" href="images/jr.png"/>
    <link rel="stylesheet" href="css/NavBar.css">
    <html lang="fr"><head>

    <body>
        <header class="site-navbar" role="banner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-11 col-xl-2">
                        <h1 class="site-logo"><a href="index.php" style="text-decoration: none;" class="text-white"><img style="width: 60px;" src="images/jr.png"></a></h1>
                    </div>
                        <div class="col-12 col-md-10 d-none d-xl-block">
                            <nav class="site-navigation position-relative text-right" role="navigation">
                                <ul class="site-menu d-none d-lg-block">
                                    <li class="active"><a href="index.php"><span>Home</span></a></li>
                                    <li><a href="racourcis.php"><span>Mes Raccourcis</span></a></li>
                                        <li class="has-children">
                                            <a><span><?= $user;?><img style="margin-bottom: 3px;" src="https://img.icons8.com/material-rounded/24/FFFFFF/expand-arrow--v1.png"/></span></a>
                                                <ul class="dropdown arrow-top">
                                                    <li><a href="settings.php"><img src="https://img.icons8.com/plumpy/24/000000/settings.png"/> Paramètres</a></li>
                                                    <li><a href="logout.php"><img src="https://img.icons8.com/plumpy/24/000000/export.png"/> Déconnexion</a></li>
                                                </ul>
                                        </li>    
                                    </li>
                                </ul>
                            </nav>
                        </div>
                </div>
            </div>
        </header>
    </body>
</html>
<br><br><br><br><br><br><br><br><br>