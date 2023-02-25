<?php

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
$ldap_bind = @ldap_bind($ldap_connection, $Admin.$domain, $PwdAdmin);



if($ldap_bind){

    $filter = ("sAMAccountName=test.test");
    $search = @ldap_search($ldap_connection, $base_dn, $filter);
    $entry = ldap_first_entry($ldap_connection, $search);
    $dnreset = ldap_get_dn($ldap_connection, $entry);

    $password = "MyPasswordjoris!57600";
    $password = "\"".$password."\""; 

    $userdata["description"] = $password;
    //$userdata["unicodePwd"] = $password;
    //$userdata['unicodePwd'] = mb_convert_encoding($password, "UTF-16LE"); 

    $result = ldap_modify($ldap_connection, $dnreset,$userdata); 


    /*// replacing the value of a single attribute 
        $attr["mail"] = "jdoenew@foo.com"; 

        $result = ldap_modify($ldap_connection, "uid=test1,DC=JR,DC=local",$attr); 

        if (TRUE === $result) {
        echo "The attribute was replaced."; 
        } else {
        echo "The attribute could not be replaced."; 
        } */

    /*$password = "MyPasswordjoris!57";
    $password = "\"".$password."\""; 

    // On ajoute les double-quotes autour du password
    $entry['unicodePwd'] = mb_convert_encoding($password, "UTF-16LE"); 

    $change = ldap_mod_replace($ldap_connection, "uid=test.test,dc=JR,dc=local", $entry);
    // On modifie le mot de passe
    ldap_close($ldap_connection);
    return $change;*/
}