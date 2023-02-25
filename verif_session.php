<?php
    // Initialiser la session
    session_start();
    
    // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
    if(!isset($_SESSION["username"])){
        header("Location: ../conf/login.php");
        exit(); 
        session_destroy();
    }

//-------------------------------------------------------------------------------------------------------------------------------------------------
        
    // vérification de l'url
    /*function URL($URL){

    $lien = curl_init($URL);

    //curl_setopt($lien, CURLOPT_FAILONERROR, true);
    curl_setopt($lien, CURLOPT_NOBODY, true);

        if (curl_exec($lien) === false) {
            //echo 'Lien invalide: ' . $URL . curl_error($lien);
            $_SESSION["url"] = "https://185.55.246.177";
        }
        else
        {
            //echo 'Lien valide: ' . $URL;
            $_SESSION["url"] = "https://plex.zerobug-57.fr";    
        }
        curl_close($lien);
    }              
    URL("https://plex.zerobug-57.fr:32400");*/
?>