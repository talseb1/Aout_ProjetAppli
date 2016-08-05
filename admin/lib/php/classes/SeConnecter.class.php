<?php

class SeConnecter {

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    function estAdmin($login, $password) {
        $ret = array();
        try {
            $query = "select verifier_connexion(:nomadmin,:mpadmin) as ret";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':nomadmin', $_POST['login']);
            $sql->bindValue(':mpadmin', ($_POST['password']));
            $sql->execute();
            $ret = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec " . $e;
        }
        return $ret;
    }

}

?>
