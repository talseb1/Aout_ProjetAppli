<?php

class achatManager extends achat {
    private $_db;
    private $_accueilArray=array();
    
    public function __construct($db) {
        $this->_db = $db;
    }
    
    public function getAchat(array $data) {
           
	    $query="SELECT addachat(:id_client,:achat) as retour";
            try
            {
            $id=null;
            $statement = $this->_db->prepare($query);		
            $statement->bindValue(1, $data['id_client'], PDO::PARAM_INT);
            $statement->bindValue(2, (integer)$data['achat'], PDO::PARAM_INT);
            $statement->execute();
            $retour = $statement->fetchColumn(0);
            return $retour;
        } 
        catch(PDOException $e) {
            print "Echec de l'insertion : ".$e;
            $retour=0;
            return $retour;
        }   
        
        
        while($data = $resultset->fetch()){     
            try
            {
                $_accueilArray[] = new Accueil($data);

            } 
            catch(PDOException $e)
            {
                
                print $e->getMessage();
            }            
        }
        return $_accueilArray;        
    }
 }

?>
