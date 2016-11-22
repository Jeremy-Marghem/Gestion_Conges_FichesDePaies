INSERT INTO pays (nom_pays) VALUES ('Belgique');
INSERT INTO pays (nom_pays) VALUES ('France');
INSERT INTO pays (nom_pays) VALUES ('Suisse');
INSERT INTO pays (nom_pays) VALUES ('Luxembourg');

INSERT INTO statut (nom_statut,taux_statut) VALUES ('Employé',13.08);
INSERT INTO statut (nom_statut,taux_statut) VALUES ('Ouvrier',12.1);

INSERT INTO individu (id_pays,id_statut,num_individu,nom_individu,prenom_individu,adresse_individu,cp_individu,localite_individu,tel_individu,nb_conges_individu,login,password,anciennete) VALUES (1,1,'A1','Marghem','Jeremy','Rue des paturages, 50','7500','Tournai','0474/013565',10,'jeremy.marghem@entreprise.com','jeremy',5);
INSERT INTO individu (id_pays,id_statut,num_individu,nom_individu,prenom_individu,adresse_individu,cp_individu,localite_individu,tel_individu,nb_conges_individu,login,password,anciennete) VALUES (1,1,'A2','Dumoulin','Mathias','Rue Guillaume Charlier, 158','7500','Tournai','0411/015865',10,'mathias.dumoulin@entreprise.com','mathias',6);
INSERT INTO individu (id_pays,id_statut,num_individu,nom_individu,prenom_individu,adresse_individu,cp_individu,localite_individu,tel_individu,nb_conges_individu,login,password,anciennete) VALUES (1,2,'A3','Militello','Vincent','Rue de l''Italie','7100','La Louviere','0476/128495',5,'vincent.militello@entreprise.com','vincent',4);

INSERT INTO administrateur (login,password,nom_admin,prenom_admin) VALUES ('jeremy.admin@entreprise.com','jeremy','Marghem','Jeremy');

INSERT INTO fiche_de_paie (id_calendrier,id_individu,id_calendrier_paie_fin,brut_fiche,net_fiche,heures_fiche) VALUES (1,1,2,1955.99,1450.99,135);


