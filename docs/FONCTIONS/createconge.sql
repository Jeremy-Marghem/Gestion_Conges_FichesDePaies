-- Function: createconge(date, date, integer, integer, integer)

-- DROP FUNCTION createconge(date, date, integer, integer, integer);

CREATE OR REPLACE FUNCTION createconge(
    date,
    date,
    integer,
    integer,
    integer)
  RETURNS integer AS
$BODY$
declare
  id integer;
  retour integer;
begin
  INSERT INTO conges (date_debut,date_fin,nb_jours,id_individu,validite) VALUES ($1,$2,$3,$4,$5);
  retour=1;
  return retour;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION createconge(date, date, integer, integer, integer)
  OWNER TO "jeremy.marghem";
