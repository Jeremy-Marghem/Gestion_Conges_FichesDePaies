<?php

class InfoAdminDB extends InfoIndividu{

    private $_db;
    public $_infoArray = array();
    
    public function __construct($db){
        $this->_db = $db;
    }
    
    public function getVerifAdmin($login,$password){
        try{
            $query = "SELECT * FROM administrateur WHERE login = :login AND password = :password";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1,$login);
            $resultset->bindValue(2,$password);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $_infoArray=null;
        while($data=$resultset->fetch()){
            $_infoArray[]=new InfoIndividu($data);
        }

        return $_infoArray;
    }
}