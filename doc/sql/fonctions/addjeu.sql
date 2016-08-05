create or replace function addjeu(text, real, integer, integer, integer, integer)
returns integer as
'
    declare f_titre alias for $1;
    declare f_prix alias for $2;
    declare f_nbj alias for $3;
    declare f_cat alias for $4;
    declare f_dev alias for $5;
    declare f_pl alias for $6;
    declare retour integer;
    declare id integer;
BEGIN
    insert into jeu(titre, prix, nombredejoueurs, idcat, iddev, idplateforme) values (f_titre, f_prix, f_nbj, f_cat, f_dev, f_pl);
    select into id idjeux from jeu where titre=f_titre and prix=f_prix and nombredejoueurs=f_nbj and idcat=f_cat and iddev=f_dev and idplateforme=f_pl;
    if not found then
	retour=0;
    else
	retour=1;
    end if;
    return retour;
end;
'
  Language plpgsql
