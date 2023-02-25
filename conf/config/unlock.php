<?php
    require('../../verif_session.php');
    require('../bdd.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        $sql = "UPDATE users SET lockuser = '1' WHERE id = '$id'";
            // Exécuter la requête sur la base de données
            $bdd->query($sql);
            header("Location: ../settings.php");
            exit;
    }
?>
