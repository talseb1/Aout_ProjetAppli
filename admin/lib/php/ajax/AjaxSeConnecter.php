<?php

session_start();
header('Content-Type: application/json');
//indique que le retour doit $etre traité en json
require './liste_include_ajax.php';
require '../classes/connexion.class.php';
require '../classes/SeConnecter.class.php';

$db = Connexion::getInstance($dsn, $user, $pass);

try {
    $mg = new SeConnecter($db);
    $ret = $mg->estAdmin($_POST['login'], $_POST['password']);
    if ($ret == 1) {
        $_SESSION['admin'] = 1;
        $_SESSION['page'] = "accueil";
    }
    print json_encode(array('ret' => $ret));
} catch (PDOException $e) {
    
}
?>