--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6beta1
-- Dumped by pg_dump version 9.6beta1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: SCHEMA "public"; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA "public" IS 'standard public schema';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS "plpgsql" WITH SCHEMA "pg_catalog";


--
-- Name: EXTENSION "plpgsql"; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION "plpgsql" IS 'PL/pgSQL procedural language';


SET search_path = "public", pg_catalog;

--
-- Name: add_contact("text", "text", "text", "text", "text"); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION "add_contact"("text", "text", "text", "text", "text") RETURNS integer
    LANGUAGE "plpgsql"
    AS '
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
';


ALTER FUNCTION "public"."add_contact"("text", "text", "text", "text", "text") OWNER TO "postgres";

--
-- Name: add_dev("text", "text"); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION "add_dev"("text", "text") RETURNS integer
    LANGUAGE "plpgsql"
    AS '
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
';


ALTER FUNCTION "public"."add_dev"("text", "text") OWNER TO "postgres";

--
-- Name: addachat(integer, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION "addachat"(integer, integer) RETURNS integer
    LANGUAGE "plpgsql"
    AS '
    declare f_client alias for $1;
    declare f_jeu alias for $2;
    declare id integer;
    declare idc integer;
    declare retour integer;
    begin
	select into idc idclient from client where idclient=f_client;
	if not found then
	    retour=2;
	else
	    insert into achat(idclient, idjeux, dateachat) values (f_client, f_jeu, current_date);
	    select into id idachat from achat where idclient=f_client and
						  idjeux=f_jeu and
						  dateachat=current_date;
	    if not found then
		retour=0;
	    else
	        retour=1;
	    end if;
    end if;
    return retour;
end;
';


ALTER FUNCTION "public"."addachat"(integer, integer) OWNER TO "postgres";

--
-- Name: addclient("text", "text", "text", "text", integer, "text", "text"); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION "addclient"("text", "text", "text", "text", integer, "text", "text") RETURNS integer
    LANGUAGE "plpgsql"
    AS '
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
';


ALTER FUNCTION "public"."addclient"("text", "text", "text", "text", integer, "text", "text") OWNER TO "postgres";

--
-- Name: addjeu("text", real, integer, integer, integer, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION "addjeu"("text", real, integer, integer, integer, integer) RETURNS integer
    LANGUAGE "plpgsql"
    AS '
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
';


ALTER FUNCTION "public"."addjeu"("text", real, integer, integer, integer, integer) OWNER TO "postgres";

--
-- Name: verifier_connexion("text", "text"); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION "verifier_connexion"("text", "text") RETURNS integer
    LANGUAGE "plpgsql"
    AS '	
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
';


ALTER FUNCTION "public"."verifier_connexion"("text", "text") OWNER TO "postgres";

--
-- Name: Possede_idpossede_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Possede_idpossede_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "Possede_idpossede_seq" OWNER TO "postgres";

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: accueil; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "accueil" (
    "idacc" integer NOT NULL,
    "texte" "text" NOT NULL
);


ALTER TABLE "accueil" OWNER TO "postgres";

--
-- Name: accueil_idacc_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "accueil_idacc_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "accueil_idacc_seq" OWNER TO "postgres";

--
-- Name: accueil_idacc_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "accueil_idacc_seq" OWNED BY "accueil"."idacc";


--
-- Name: achat_a_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "achat_a_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "achat_a_seq" OWNER TO "postgres";

--
-- Name: achat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "achat" (
    "idachat" integer DEFAULT "nextval"('"achat_a_seq"'::"regclass") NOT NULL,
    "idclient" integer NOT NULL,
    "idjeux" integer NOT NULL,
    "dateachat" "date"
);


ALTER TABLE "achat" OWNER TO "postgres";

--
-- Name: achat_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "achat_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "achat_seq" OWNER TO "postgres";

--
-- Name: admin_a_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "admin_a_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "admin_a_seq" OWNER TO "postgres";

--
-- Name: admin; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "admin" (
    "idadmin" integer DEFAULT "nextval"('"admin_a_seq"'::"regclass") NOT NULL,
    "nomadmin" "text" NOT NULL,
    "mpadmin" "text" NOT NULL
);


ALTER TABLE "admin" OWNER TO "postgres";

--
-- Name: cat_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "cat_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "cat_seq" OWNER TO "postgres";

--
-- Name: categorie_a_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "categorie_a_seq"
    START WITH 7
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "categorie_a_seq" OWNER TO "postgres";

--
-- Name: categorie; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "categorie" (
    "idcat" integer DEFAULT "nextval"('"categorie_a_seq"'::"regclass") NOT NULL,
    "genre" "text" NOT NULL
);


ALTER TABLE "categorie" OWNER TO "postgres";

--
-- Name: client_a_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "client_a_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "client_a_seq" OWNER TO "postgres";

--
-- Name: client; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "client" (
    "idclient" integer DEFAULT "nextval"('"client_a_seq"'::"regclass") NOT NULL,
    "nom" "text" NOT NULL,
    "prenom" "text" NOT NULL,
    "adresse" "text",
    "ville" "text",
    "cp" integer,
    "pays" "text",
    "numdetel" "text" NOT NULL
);


ALTER TABLE "client" OWNER TO "postgres";

--
-- Name: client_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "client_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "client_seq" OWNER TO "postgres";

--
-- Name: contact; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "contact" (
    "idcontact" integer NOT NULL,
    "sexe" "text" NOT NULL,
    "nom" "text" NOT NULL,
    "prenom" "text" NOT NULL,
    "comm" "text" NOT NULL,
    "email" "text" NOT NULL
);


ALTER TABLE "contact" OWNER TO "postgres";

--
-- Name: contact_idcontact_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "contact_idcontact_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "contact_idcontact_seq" OWNER TO "postgres";

--
-- Name: contact_idcontact_seq1; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "contact_idcontact_seq1"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "contact_idcontact_seq1" OWNER TO "postgres";

--
-- Name: contact_idcontact_seq1; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "contact_idcontact_seq1" OWNED BY "contact"."idcontact";


--
-- Name: dev_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "dev_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "dev_seq" OWNER TO "postgres";

--
-- Name: developpeur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "developpeur" (
    "iddev" integer NOT NULL,
    "nomdev" "text" NOT NULL,
    "paysdev" "text"
);


ALTER TABLE "developpeur" OWNER TO "postgres";

--
-- Name: developpeur_iddev_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "developpeur_iddev_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "developpeur_iddev_seq" OWNER TO "postgres";

--
-- Name: developpeur_iddev_seq1; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "developpeur_iddev_seq1"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "developpeur_iddev_seq1" OWNER TO "postgres";

--
-- Name: developpeur_iddev_seq1; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "developpeur_iddev_seq1" OWNED BY "developpeur"."iddev";


--
-- Name: fournisseur_idfourn_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "fournisseur_idfourn_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "fournisseur_idfourn_seq" OWNER TO "postgres";

--
-- Name: jeu; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "jeu" (
    "idjeux" integer NOT NULL,
    "titre" "text" NOT NULL,
    "prix" real NOT NULL,
    "nombredejoueurs" integer,
    "idcat" integer,
    "iddev" integer,
    "idplateforme" integer
);


ALTER TABLE "jeu" OWNER TO "postgres";

--
-- Name: jeu_idjeux_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "jeu_idjeux_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "jeu_idjeux_seq" OWNER TO "postgres";

--
-- Name: jeu_idjeux_seq1; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "jeu_idjeux_seq1"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "jeu_idjeux_seq1" OWNER TO "postgres";

--
-- Name: jeu_idjeux_seq1; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "jeu_idjeux_seq1" OWNED BY "jeu"."idjeux";


--
-- Name: jeu_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "jeu_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "jeu_seq" OWNER TO "postgres";

--
-- Name: jeux_a_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "jeux_a_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "jeux_a_seq" OWNER TO "postgres";

--
-- Name: plateforme_a_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "plateforme_a_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "plateforme_a_seq" OWNER TO "postgres";

--
-- Name: plateforme; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "plateforme" (
    "idplateforme" integer DEFAULT "nextval"('"plateforme_a_seq"'::"regclass") NOT NULL,
    "nomplateforme" "text" NOT NULL
);


ALTER TABLE "plateforme" OWNER TO "postgres";

--
-- Name: jeuxcat; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW "jeuxcat" AS
 SELECT "j"."idjeux",
    "j"."titre",
    "j"."prix",
    "j"."nombredejoueurs" AS "nj",
    "c"."genre" AS "cat",
    "d"."nomdev" AS "dev",
    "p"."nomplateforme" AS "pl"
   FROM "jeu" "j",
    "plateforme" "p",
    "categorie" "c",
    "developpeur" "d"
  WHERE (("j"."idcat" = "c"."idcat") AND ("j"."idplateforme" = "p"."idplateforme") AND ("j"."iddev" = "d"."iddev"));


ALTER TABLE "jeuxcat" OWNER TO "postgres";

--
-- Name: mag_stock_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "mag_stock_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "mag_stock_seq" OWNER TO "postgres";

--
-- Name: magasinstock_a_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "magasinstock_a_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "magasinstock_a_seq" OWNER TO "postgres";

--
-- Name: plateforme_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "plateforme_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "plateforme_seq" OWNER TO "postgres";

--
-- Name: public_a_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "public_a_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;


ALTER TABLE "public_a_seq" OWNER TO "postgres";

--
-- Name: accueil idacc; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "accueil" ALTER COLUMN "idacc" SET DEFAULT "nextval"('"accueil_idacc_seq"'::"regclass");


--
-- Name: contact idcontact; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "contact" ALTER COLUMN "idcontact" SET DEFAULT "nextval"('"contact_idcontact_seq1"'::"regclass");


--
-- Name: developpeur iddev; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "developpeur" ALTER COLUMN "iddev" SET DEFAULT "nextval"('"developpeur_iddev_seq1"'::"regclass");


--
-- Name: jeu idjeux; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "jeu" ALTER COLUMN "idjeux" SET DEFAULT "nextval"('"jeu_idjeux_seq1"'::"regclass");


--
-- Name: developpeur Dev_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "developpeur"
    ADD CONSTRAINT "Dev_pk" PRIMARY KEY ("iddev");


--
-- Name: achat achat_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "achat"
    ADD CONSTRAINT "achat_pk" PRIMARY KEY ("idachat");


--
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "admin"
    ADD CONSTRAINT "admin_pkey" PRIMARY KEY ("idadmin");


--
-- Name: categorie cat_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "categorie"
    ADD CONSTRAINT "cat_pk" PRIMARY KEY ("idcat");


--
-- Name: client client_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "client"
    ADD CONSTRAINT "client_pk" PRIMARY KEY ("idclient");


--
-- Name: contact contact_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "contact"
    ADD CONSTRAINT "contact_pkey" PRIMARY KEY ("idcontact");


--
-- Name: jeu jeu_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "jeu"
    ADD CONSTRAINT "jeu_pk" PRIMARY KEY ("idjeux");


--
-- Name: plateforme plateforme_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "plateforme"
    ADD CONSTRAINT "plateforme_pk" PRIMARY KEY ("idplateforme");


--
-- Name: achat achat_idclient_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "achat"
    ADD CONSTRAINT "achat_idclient_fkey" FOREIGN KEY ("idclient") REFERENCES "client"("idclient");


--
-- Name: jeu cat_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "jeu"
    ADD CONSTRAINT "cat_fk" FOREIGN KEY ("idcat") REFERENCES "categorie"("idcat");


--
-- Name: jeu dev_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "jeu"
    ADD CONSTRAINT "dev_fk" FOREIGN KEY ("iddev") REFERENCES "developpeur"("iddev");


--
-- Name: achat jeu_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "achat"
    ADD CONSTRAINT "jeu_fk" FOREIGN KEY ("idjeux") REFERENCES "jeu"("idjeux");


--
-- Name: jeu plateforme_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "jeu"
    ADD CONSTRAINT "plateforme_fk" FOREIGN KEY ("idplateforme") REFERENCES "plateforme"("idplateforme");


--
-- PostgreSQL database dump complete
--

