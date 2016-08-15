<?php
header('Content-Type: application/json');
//indique que le retour doit $etre traité en json
require './liste_include_ajax.php';
require '../classes/connexion.class.php';
require '../classes/achat.class.php';
require '../classes/achatManager.class.php';

$db = Connexion::getInstance($dsn,$user,$pass);

try{
    $mg = new achatManager($db);
    $retour=$mg->getAchat($_GET);
    print json_encode(array('retour' => $retour)); 
}
catch(PDOException $e){}
?>
