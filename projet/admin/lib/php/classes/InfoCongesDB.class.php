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
        $_infoArray=null;
        while($data=$resultset->fetch()){
            $_infoArray[]=new InfoConges($data);
        }
        
        return $_infoArray;
    }
    public function getDemandes(){
        try{
            $query = "SELECT c.id_conges, i.nom_individu, i.prenom_individu, c.date_debut, c.date_fin, c.nb_jours "
                    . "FROM conges c, individu i "
                    . "WHERE c.validite = 0 AND c.id_individu = i.id_individu";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        $_infoArray=null;
        while($data=$resultset->fetch()){
            $_infoArray[]=new InfoConges($data);
        }
        
        return $_infoArray;    
    }
    public function updateConge($id, $val){
        try{
            $query = "UPDATE conges SET validite = '$val' WHERE id_conges='$id'";
            $resultset=$this->_db->prepare($query);
            $resultset->execute();
            return 1;
        }catch(PDOException $ex){
            echo $ex->getMessage();
            return 0;
        }    
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