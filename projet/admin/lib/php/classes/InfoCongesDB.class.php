<?php

class InfoCongesDB extends InfoConges{
    private $_db;
    private $_infoArray = array();
    
    public function __construct($db){
        $this->_db=$db;
    }
    
    public function getInfoConges($id){
        try{
            $query = "SELECT c1.jour_calendrier AS debut, c2.jour_calendrier AS fin, "
                        . "c2.jour_calendrier-c1.jour_calendrier AS jours, co.validite FROM conges co, calendrier c1, "
                        . "calendrier c2 WHERE co.id_individu = :id_individu AND co.id_calendrier=c1.id_calendrier AND "
                        . "co.id_calendrier_conges_fin=c2.id_calendrier";
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
}