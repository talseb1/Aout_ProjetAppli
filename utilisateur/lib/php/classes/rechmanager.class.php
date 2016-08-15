<?php
class catManager extends cat {
    private $_db;
    private $_accueilArray=array();
    
    public function __construct($db) {
        $this->_db = $db;
    }
    
   
    public function getjeuxt($titre) {
        try
        {
            $query="SELECT * FROM jeuxcat where titre={$titre} order by (titre and cat)";
            //select * from jeu where avec categorie...
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } 
        catch(PDOException $e){
            print $e->getMessage();
        }
        
        while($data = $resultset->fetch()){     
            try
            {
                $_accueilArray[] = new cat($data);
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
