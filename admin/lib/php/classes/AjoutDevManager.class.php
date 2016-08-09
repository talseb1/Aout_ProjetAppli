<?php

class AjoutDevManager extends AjoutDev {
    private $_db;
    private $_contactArray = array();
    
    public function __construct($db) {
        $this->_db = $db;
    }
    
    public function addDev(array $data) {
        //var_dump($data);
        $query="select add_dev(:Nom_dev,:Pays_dev) as retour" ;
        try {
            $id=null;
            $statement = $this->_db->prepare($query);		
            $statement->bindValue(1, $data['Nom_dev'], PDO::PARAM_STR);
            $statement->bindValue(2, $data['Pays_dev'], PDO::PARAM_STR);

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
