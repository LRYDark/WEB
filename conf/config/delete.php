<?php
    require('../../verif_session.php');
    require('../bdd.php');
  
    if(isset($_POST['bookId'])){
        $id = $_POST['bookId'];

        $sql = "DELETE FROM users WHERE id = '$id'";
            // Exécuter la requête sur la base de données
            $bdd->query($sql);
            header("Location: ../settings.php");
            exit;

    }
?>
