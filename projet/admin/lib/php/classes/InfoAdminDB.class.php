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
    
    public function getVerifMdp($id,$mdp){
        try{
            $query = "SELECT * FROM administrateur WHERE id_admin = :id AND password = :mdp";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1,$id);
            $resultset->bindValue(2,$mdp);
            $resultset->execute();
            
            $_infoArray[0]=0;
            while($data=$resultset->fetch()){
                $_infoArray[]=new InfoIndividu($data);
            }

            if(count($_infoArray)==2){
                return 1;
            }else{
                return 0;
            }
          
        }catch(PDOException $ex) {
        }
    }
    public function getMajMdp($id,$password,$newpassword){
        try{
            $query = "UPDATE administrateur SET password = :newpassword WHERE id_admin = :id AND password = :password";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1,$newpassword);           
            $resultset->bindValue(2,$id);
            $resultset->bindValue(3,$password);
            $resultset->execute();
            
            $retour = $resultset -> fetchColumn(0);

            if($retour == 1){
                return 1;
            }else{
                return 0;
            }
          
        }catch(PDOException $ex) {
        }
    }    
}