<?php
    /*try
    {
        $bdd = new PDO('mysql:host=172.30.80.1:3306;dbname=applications', 'root', 'Passw0rdchaussette');
    }
    catch(Exception $e)
    {
        die('Erreur : Impossible de se connecter.'.$e->getMessage());
    }*/

    try
    {
        $bdd = new PDO('mysql:host=192.168.12.1;dbname=applications', 'root', 'Handy!joris57');
    }
    catch(Exception $e)
    {
        die('Erreur : Impossible de se connecter.'.$e->getMessage());
    }

    //---------------------------------------------------------------------------

    $server     = '192.168.12.1';
    $domain     = '@JR.local';
    $base_dn    = "DC=JR,DC=local";
    $port       = 389;

    $Admin = "administrateur";
    $PwdAdmin = "Handy!joris57";

    $ldap_connection = ldap_connect($server, $port);    
    
    if ($ldap_connection){
        ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0);
    }else{
        echo '<p>Erreur de connexion au serveur LDAP</p>';
        exit;
    }
?>
