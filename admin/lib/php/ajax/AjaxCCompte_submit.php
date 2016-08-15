<?php
header('Content-Type: application/json');
//indique que le retour doit $etre traité en json
require './liste_include_ajax.php';
require '../classes/connexion.class.php';
require '../classes/compte.class.php';
require '../classes/compteManager.class.php';

$db = Connexion::getInstance($dsn,$user,$pass);

try{
    $mg = new compteManager($db);
    $retour=$mg->addClient($_GET);
    print json_encode(array('retour' => $retour)); 
    
}
catch(PDOException $e){}
?>
