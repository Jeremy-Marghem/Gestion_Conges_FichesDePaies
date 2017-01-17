-- Function: updateconge(integer, integer)

-- DROP FUNCTION updateconge(integer, integer);

CREATE OR REPLACE FUNCTION updateconge(
    integer,
    integer)
  RETURNS integer AS
$BODY$
DECLARE 
	declare f_id alias for $1;
	declare f_val alias for $2;
    declare retour integer;
    declare id integer;
BEGIN
	SELECT INTO id id_conges FROM conges WHERE id_conges=f_id;
	IF NOT FOUND
	THEN 
		retour = 0;
	ELSE
		 UPDATE conges SET validite=f_val WHERE id_conges=f_id;
		 retour = 1;
	END IF;
	return retour;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION updateconge(integer, integer)
  OWNER TO "jeremy.marghem";
