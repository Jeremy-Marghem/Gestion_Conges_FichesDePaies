<?php

class InfoCongesDB extends InfoConges{
    private $_db;
    private $_infoArray = array();
    
    public function __construct($db){
        $this->_db=$db;
    }
    
    public function getInfoConges($id){
        try{
            $query = "SELECT co.date_debut AS debut, co.date_fin AS fin, co.nb_jours AS jours,"
                        . " co.validite FROM conges co"
                        . " WHERE co.id_individu = :id_individu";         
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1,$id);
            $resultset->execute();	
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $_infoArray[0]=0;
        while($data=$resultset->fetch()){
            $_infoArray[]=new InfoConges($data);
        }
        
        return $_infoArray;
    }
    
    public function createConge($debut,$fin,$nbJours,$individu){
        try{
            $query = "INSERT INTO conges (date_debut,date_fin,nb_jours,id_individu,validite) VALUES ('$debut','$fin',$nbJours,$individu,0)";
            $resultset=$this->_db->prepare($query);
            $resultset->execute();
            return 1;
        }catch(PDOException $ex){
            echo $ex->getMessage();
            return 0;
        }
    }
}