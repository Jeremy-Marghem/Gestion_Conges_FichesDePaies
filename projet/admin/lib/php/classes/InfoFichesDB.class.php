<?php

class InfoFichesDB extends InfoFiches{
    private $_db;
    private $_infoArray = array();
    
    public function __construct($db){
        $this->_db=$db;
    }
    
    public function getInfoFiches($id){
        try{
            $query="SELECT c.jour_calendrier AS debut, c2.jour_calendrier AS fin,f.brut_fiche AS brut,f.net_fiche AS net,f.heures_fiche AS heures, f.id_fiche AS id_fiche 
                    FROM fiche_de_paie f, calendrier c, calendrier c2, individu i 
                    WHERE f.id_calendrier=c.id_calendrier AND f.id_calendrier_paie_fin=c2.id_calendrier AND f.id_individu = i.id_individu AND i.id_individu = :id_individu";
            $resultset=$this->_db->prepare($query);
            $resultset->bindValue(1,$id);
            $resultset->execute();
        }catch(PDOException $ex) {
            print $ex->getMessage();
        }
        $_infoArray[0]=0;
        while($data=$resultset->fetch()){
            $_infoArray[]=new InfoFiches($data);
        }
        
        return $_infoArray;
    }
}