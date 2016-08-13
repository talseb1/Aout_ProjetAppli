<?php

class compteManager extends compte {
    private $_db;
    private $_contactArray = array();
    
    public function __construct($db) {
        $this->_db = $db;
    }
    
    public function addClient(array $data) {
        //var_dump($data);
        $query="select addclient(:nom_cc,:pren_cc,:adresse_cc,:ville_cc,:cp_cc, :pays_cc, :num_cc) as retour" ;
        try {
            $id=null;
            $statement = $this->_db->prepare($query);
            
            $statement->bindValue(1, $data['nom_cc'], PDO::PARAM_STR);
            $statement->bindValue(2, $data['pren_cc'], PDO::PARAM_STR);
            $statement->bindValue(3, $data['adresse_cc'], PDO::PARAM_STR);
            $statement->bindValue(4, $data['ville_cc'], PDO::PARAM_STR);
            $statement->bindValue(5, $data['cp_cc'], PDO::PARAM_INT);
            $statement->bindValue(6, $data['pays_cc'], PDO::PARAM_STR);
            $statement->bindValue(7, $data['num_cc'], PDO::PARAM_STR);

            $statement->execute();
            $retour = $statement->fetchColumn(0);
            return $retour;
        } 
        catch(PDOException $e) {
            print "Echec de l'insertion : ".$e;
            $retour=0;
            return $retour;
        }   
    }
    
    private function checkEmpty($data) {
        
        return true;
    }
    
}
