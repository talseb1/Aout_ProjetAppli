create or replace function add_dev (text,text) returns integer
as
'
  declare f_nom alias for $1;
  declare f_pays alias for $2;
  declare retour integer;
  declare id integer;
begin
 	insert into developpeur(nomdev,paysdev) 
	values (f_nom,f_pays);
        select into id iddev from developpeur where nomdev=f_nom and paysdev=f_pays;

        if not found	then
		retour=0;
	else 
		retour=1;
	end if;
        return retour;
end;
'
language 'plpgsql';
