CREATE OR REPLACE FUNCTION addclient(text,text,text,text,integer,text,text)
  RETURNS integer AS
'
    declare f_nom alias for $1;
    declare f_pr alias for $2;
    declare f_a alias for $3;
    declare f_v alias for $4;
    declare f_c alias for $5;
    declare f_pa alias for $6;
    declare f_tel alias for $7;
    declare id integer;
    begin
        insert into client(nom, prenom, adresse, ville, cp, pays, numdetel) values (f_nom, f_pr, f_a, f_v, f_c, f_pa, f_tel);
        select into id idclient from client where nom=f_nom and prenom=f_pr and adresse=f_a and ville=f_v and cp=f_c and pays=f_pa and numdetel=f_tel;
	if not found then
	    id=0;
	end if;
	return id;
end;
'
LANGUAGE plpgsql 

