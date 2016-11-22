<?php

class InfoIndividuDB extends InfoIndividu{

    private $_db;
    public $_infoArray = array();
    
    public function __construct($db){
        $this->_db = $db;
    }
    
    public function getVerifIndividu($login,$password){
        try{
            $query = "SELECT * FROM individu WHERE login = :login AND password = :password";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1,$login);
            $resultset->bindValue(2,$password);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        
        while($data=$resultset->fetch()){
            $_infoArray[]=new InfoIndividu($data);
        }

        return $_infoArray;
    }
    
   /* public function getAllIndividu($id){
        try{
            $query ="SELECT * FROM individu WHERE id_individu = :id";
            $resultset=$this->_db->prepare($query);
            $resultset->bindValue(1,$id);
            $resultset->execute();
        }catch(PDOException $ex) {
            print $e->getMessage();
        }
        
        $_infoArray[]=new InfoIndividu
    }*/
}