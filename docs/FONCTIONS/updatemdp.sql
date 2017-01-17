-- Function: updatemdp(integer, text, text)

-- DROP FUNCTION updatemdp(integer, text, text);

CREATE OR REPLACE FUNCTION updatemdp(
    integer,
    text,
    text)
  RETURNS integer AS
$BODY$
DECLARE 
	retour integer;
BEGIN
	UPDATE individu SET password=$2 WHERE id_individu=$1 AND password=$3;
	retour = 1;
	return retour;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION updatemdp(integer, text, text)
  OWNER TO "jeremy.marghem";
