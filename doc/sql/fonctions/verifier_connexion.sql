CREATE OR REPLACE FUNCTION verifier_connexion(text, text) RETURNS integer AS
'	
declare f_login alias for $1;
	declare f_password alias for $2;
	declare id integer;
	declare retour integer;
begin
	select into id idadmin from admin where nomadmin=f_login and mpadmin=f_password;
	if not found
	then
	  retour=0;
	else
	  retour=1;
	end if;
	return retour;
end;
'
LANGUAGE plpgsql;