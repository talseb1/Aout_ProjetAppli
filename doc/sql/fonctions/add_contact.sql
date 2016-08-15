create or replace function add_contact (text,text,text,text,text) returns integer
as
'
  declare f_sexe alias for $1;
  declare f_nom alias for $2;
  declare f_prenom alias for $3;
  declare f_comm alias for $4;
  declare f_email alias for $5;
  declare retour integer;
  declare id integer;
begin
 	insert into contact(sexe,nom,prenom,comm,email) 
	values (f_sexe,f_nom,f_prenom,f_comm,f_email);
        select into id idcontact from contact where sexe=f_sexe and nom=f_nom 
        and prenom=f_prenom and comm=f_comm and email=f_email;
        if not found	then
		retour=0;
	else 
		retour=1;
	end if;
        return retour;
end;
'
language 'plpgsql';