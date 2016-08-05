<?php

class AjoutJeuManager extends AjoutJeu
{
    private $_db;
    private $_IdDeveloppeur=array();
    private $_IdCategorie=array();
    private $_Categorie=array();

    private $_Developpeur=array();
    private $_IdPlateforme=array();
    private $_Plateforme=array();
    
    public function __construct($db) {
        $this->_db = $db;
    }
    
    //Renvoie les id des categories
    public function getCategId() {
        try
        {
            
	    $query="SELECT idcat FROM categorie";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } 
        catch(PDOException $e){
            print $e->getMessage();
        }
        
        while($data = $resultset->fetch()){     
            try
            {
                $_IdCategorie[] = new ajoutjeu($data);

            } 
            catch(PDOException $e)
            {
                
                print $e->getMessage();
            }            
        }
        return $_IdCategorie;        
    }
    public function getCateg() {
        try
        {
            
	    $query="SELECT genre FROM categorie";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } 
        catch(PDOException $e){
            print $e->getMessage();
        }
        
        while($data = $resultset->fetch()){     
            try
            {
                $_Categorie[] = new ajoutjeu($data);

            } 
            catch(PDOException $e)
            {
                
                print $e->getMessage();
            }            
        }
        return $_Categorie;        
    }
    
    public function getDevId() {
        try
        {
            
	    $query="SELECT iddev FROM developpeur";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } 
        catch(PDOException $e){
            print $e->getMessage();
        }
        
        while($data = $resultset->fetch()){     
            try
            {
                $_IdDeveloppeur[] = new ajoutjeu($data);

            } 
            catch(PDOException $e)
            {
                
                print $e->getMessage();
            }            
        }
        return $_IdDeveloppeur;        
    }
    public function getDeveloppeur() {
     try
     {

         $query="SELECT nomdev FROM developpeur";
         $resultset = $this->_db->prepare($query);
         $resultset->execute();
     } 
     catch(PDOException $e){
         print $e->getMessage();
     }

     while($data = $resultset->fetch()){     
         try
         {
             $_Developpeur[] = new ajoutjeu($data);

         } 
         catch(PDOException $e)
         {

             print $e->getMessage();
         }            
     }
     return $_Developpeur;        
 }
    public function getPlateformeId() {
     try
     {

         $query="SELECT idplateforme FROM plateforme";
         $resultset = $this->_db->prepare($query);
         $resultset->execute();
     } 
     catch(PDOException $e){
         print $e->getMessage();
     }

     while($data = $resultset->fetch()){     
         try
         {
             $_IdPlateforme[] = new ajoutjeu($data);

         } 
         catch(PDOException $e)
         {

             print $e->getMessage();
         }            
     }
     return $_IdPlateforme;        
 }
    public function getPLateform() {
        try
        {
            
	    $query="SELECT nomplateForme FROM plateforme";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } 
        catch(PDOException $e){
            print $e->getMessage();
        }
        
        while($data = $resultset->fetch()){     
            try
            {
                $_Plateforme[] = new ajoutjeu($data);

            } 
            catch(PDOException $e)
            {
                
                print $e->getMessage();
            }            
        }
        return $_Plateforme;        
    }
 
 
 public function addjeu(array $data)
    {
        
        //var_dump($data);
        $query="select addjeu(:Titre_jeu, :Prix_jeu, :Joueur_jeu, :Categorie_jeu, :Developpeur_jeu, :Plateforme_jeu) as retour" ;
        try {
            $id=null;
            $statement = $this->_db->prepare($query);		
            $statement->bindValue(1, $data['Titre_jeu'], PDO::PARAM_STR);
            $statement->bindValue(2, $data['Prix_jeu'], PDO::PARAM_STR);
            $statement->bindValue(3, $data['Joueur_jeu'], PDO::PARAM_INT);
            $statement->bindValue(4, $data['Categorie_jeu'], PDO::PARAM_INT);
            $statement->bindValue(5, $data['Developpeur_jeu'], PDO::PARAM_INT);
            $statement->bindValue(6, $data['Plateforme_jeu'], PDO::PARAM_INT);

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
}
?>

