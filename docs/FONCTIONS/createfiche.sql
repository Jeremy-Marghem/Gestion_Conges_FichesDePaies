-- Function: createfiche(date, integer, date, real, real, integer)

-- DROP FUNCTION createfiche(date, integer, date, real, real, integer);

CREATE OR REPLACE FUNCTION createfiche(
    date,
    integer,
    date,
    real,
    real,
    integer)
  RETURNS integer AS
$BODY$
declare
  retour integer;
begin
  INSERT INTO FICHE_DE_PAIE (date_debut,id_individu,date_fin,brut_fiche,net_fiche,heures_fiche) VALUES ($1,$2,$3,$4,$5,$6);
  retour=1;
  return retour;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION createfiche(date, integer, date, real, real, integer)
  OWNER TO "jeremy.marghem";
