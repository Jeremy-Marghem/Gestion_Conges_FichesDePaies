-- Function: createindividu(integer, integer, text, text, text, text, text, text, text, integer, text, text, integer)

-- DROP FUNCTION createindividu(integer, integer, text, text, text, text, text, text, text, integer, text, text, integer);

CREATE OR REPLACE FUNCTION createindividu(
    integer,
    integer,
    text,
    text,
    text,
    text,
    text,
    text,
    text,
    integer,
    text,
    text,
    integer)
  RETURNS integer AS
$BODY$
declare
  id integer;
  retour integer;
begin
  INSERT INTO INDIVIDU (id_pays,id_statut,num_individu,nom_individu,prenom_individu,adresse_individu,cp_individu,localite_individu,tel_individu,nb_conges_individu,login,password,anciennete) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13);
  retour=1;
  return retour;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION createindividu(integer, integer, text, text, text, text, text, text, text, integer, text, text, integer)
  OWNER TO "jeremy.marghem";
