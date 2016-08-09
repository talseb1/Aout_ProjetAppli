<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AjoutDev
 *
 * @author ametau
 */
class AjoutDev{
     private $_attributs = array();
  
  public function __construct(array $data) {
      $this->hydrate($data);
     // print_r($data);
      /*
      Array ( [texte_accueil] => * Activités conçues par des ..., etc.
       *        */
  }
  
  //hydrate
  public function hydrate(array $data) {
     foreach ($data as $key => $value) {
    	$this->$key = $value;       
    //on affecte à la clé sa valeur; le tableau $data est le resultset, tableau associatif
     }
  }

 //getters
  public function __get ($nom) { 
      if (isset ($this->_attributs[$nom])){  
         // print_r($this->_attributs);
        return $this->_attributs[$nom];
      }
  }
  
 
  //setters
  public function __set ($nom, $valeur) {
     $this->_attributs[$nom] = $valeur;    
  }
  
}
