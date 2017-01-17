<?php

class InfoIndividuDB extends InfoIndividu{

    private $_db;
    public $_infoArray = array();

    public function __construct($db) {
        $this->_db = $db;
    }

    public function getAllIndividu() {
        try {
            $query = "SELECT * FROM individu ORDER BY nom_individu";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        
        $_infoArray = null;
        
        while ($data = $resultset->fetch()) {
            $_infoArray[] = new InfoIndividu($data);
        }

        return $_infoArray;
    }
    
    public function getVerifIndividu($login, $password) {
        try {
            $query = "SELECT * FROM individu WHERE login = :login AND password = :password";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1, $login);
            $resultset->bindValue(2, $password);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        $_infoArray = null;
        while ($data = $resultset->fetch()) {
            $_infoArray[] = new InfoIndividu($data);
        }

        return $_infoArray;
    }

    public function getVerifMdp($id, $mdp) {
        try {
            $query = "SELECT * FROM individu WHERE id_individu = :id AND password = :mdp";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1, $id);
            $resultset->bindValue(2, $mdp);
            $resultset->execute();

            $_infoArray[0] = 0;
            while ($data = $resultset->fetch()) {
                $_infoArray[] = new InfoIndividu($data);
            }
            if (count($_infoArray) == 2) {
                return 1;
            } else {
                return 0;
            }
        } catch (PDOException $ex) {
            
        }
    }

    public function getMajMdp($id,$newpassword) {
        try {
            $query = "UPDATE individu SET password='$newpassword' WHERE id_individu='$id'";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            return 1;
        } catch (PDOException $ex) { 
            return 0;
        }
    }
    
    public function create($id_pays,$id_statut,$matricule,$nom,$prenom,$adresse,$cp,$localite,$tel,$conges,$mdp){
        try{
          $login = $prenom.".".$nom."@entreprise.com";
          $query="SELECT createindividu('$id_pays','$id_statut','$matricule','$nom','$prenom','$adresse','$cp','$localite','$tel','$conges','$login','$mdp',0)"; 
            $resultset=$this->_db->prepare($query);
            $resultset->execute();
            return 1; 
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return 0;
        }
    }
       public function augmenteNb($id,$n){
        try{
            $query="UPDATE individu SET nb_conges_individu = nb_conges_individu + ".intval($n)." WHERE id_individu = ".$id;
            $resultset=$this->_db->prepare($query);
            $resultset->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    public function diminueNb($id,$n){
        try{
            $query="UPDATE individu SET nb_conges_individu = nb_conges_individu - ".intval($n)." WHERE id_individu = ".$id;
            $resultset=$this->_db->prepare($query);
            $resultset->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }     
}
