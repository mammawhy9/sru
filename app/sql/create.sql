--
-- PostgreSQL database dump
--

SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

ALTER TABLE ONLY public.users_tokens DROP CONSTRAINT users_tokens_user_id_fkey;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_modified_by_fkey;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_location_id_fkey;
ALTER TABLE ONLY public.users_history DROP CONSTRAINT users_history_user_id_fkey;
ALTER TABLE ONLY public.users_history DROP CONSTRAINT users_history_modified_by_fkey;
ALTER TABLE ONLY public.users_history DROP CONSTRAINT users_history_location_id_fkey;
ALTER TABLE ONLY public.users_history DROP CONSTRAINT users_history_faculty_id_fkey;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_faculty_id_fkey;
ALTER TABLE ONLY public.services DROP CONSTRAINT services_user_id_fkey;
ALTER TABLE ONLY public.services DROP CONSTRAINT services_serv_type_id_fkey;
ALTER TABLE ONLY public.services_history DROP CONSTRAINT services_history_user_id_fkey;
ALTER TABLE ONLY public.services_history DROP CONSTRAINT services_history_serv_type_id_fkey;
ALTER TABLE ONLY public.services_history DROP CONSTRAINT services_history_serv_id_fkey;
ALTER TABLE ONLY public.services_history DROP CONSTRAINT services_history_modified_by_fkey;
ALTER TABLE ONLY public.penalties DROP CONSTRAINT penalties_user_id_fkey;
ALTER TABLE ONLY public.penalties DROP CONSTRAINT penalties_modified_by_fkey;
ALTER TABLE ONLY public.penalties DROP CONSTRAINT penalties_created_by_fkey;
ALTER TABLE ONLY public.penalties DROP CONSTRAINT penalties_amnesty_by_fkey;
ALTER TABLE ONLY public.locations DROP CONSTRAINT locations_dormitory_id_fkey;
ALTER TABLE ONLY public.ipv4s DROP CONSTRAINT ipv4s_dormitory_id_fkey;
ALTER TABLE ONLY public.computers DROP CONSTRAINT computers_user_id_fkey;
ALTER TABLE ONLY public.computers DROP CONSTRAINT computers_modified_by_fkey;
ALTER TABLE ONLY public.computers DROP CONSTRAINT computers_location_id_fkey;
ALTER TABLE ONLY public.computers DROP CONSTRAINT computers_ipv4_fkey;
ALTER TABLE ONLY public.computers_history DROP CONSTRAINT computers_history_user_id_fkey;
ALTER TABLE ONLY public.computers_history DROP CONSTRAINT computers_history_modified_by_fkey;
ALTER TABLE ONLY public.computers_history DROP CONSTRAINT computers_history_location_id_fkey;
ALTER TABLE ONLY public.computers_history DROP CONSTRAINT computers_history_computer_id_fkey;
ALTER TABLE ONLY public.computers_bans DROP CONSTRAINT computers_bans_penalty_id_fkey;
ALTER TABLE ONLY public.computers_bans DROP CONSTRAINT computers_bans_computer_id_fkey;
ALTER TABLE ONLY public.admins DROP CONSTRAINT admins_dormitory_id_fkey;
DROP TRIGGER users_update ON public.users;
DROP TRIGGER users_counters ON public.users;
DROP TRIGGER users_computers ON public.users;
DROP TRIGGER user_service_update ON public.services;
DROP TRIGGER user_service_create ON public.services;
DROP TRIGGER penalties_users ON public.penalties;
DROP TRIGGER penalties_computers_bans ON public.penalties;
DROP TRIGGER locations_counters ON public.locations;
DROP TRIGGER ipv4s_counters ON public.ipv4s;
DROP TRIGGER computers_update ON public.computers;
DROP TRIGGER computers_counters ON public.computers;
DROP TRIGGER computer_ban_computers ON public.computers_bans;
DROP INDEX public.users_walet_all_key;
DROP INDEX public.users_surname_key;
DROP INDEX public.user_id;
DROP INDEX public.fki_penalties_user_id;
DROP INDEX public.fki_penalties_modified_by;
DROP INDEX public.fki_penalties_created_by;
DROP INDEX public.fki_penalties_amnesty_by;
DROP INDEX public.fki_computers_bans_penalty_id;
DROP INDEX public.fki_computers_bans_computer_id;
DROP INDEX public.computers_mac_key;
DROP INDEX public.computers_ipv4_key;
DROP INDEX public.computers_host_key;
ALTER TABLE ONLY public.users_tokens DROP CONSTRAINT users_tokens_pkey;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
ALTER TABLE ONLY public.users_old DROP CONSTRAINT users_old_pkey;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_login_key;
ALTER TABLE ONLY public.users_history DROP CONSTRAINT users_history_pkey;
ALTER TABLE ONLY public.text DROP CONSTRAINT text_pkey;
ALTER TABLE ONLY public.text DROP CONSTRAINT text_alias_key;
ALTER TABLE ONLY public.services DROP CONSTRAINT services_user_id_key;
ALTER TABLE ONLY public.services_type DROP CONSTRAINT services_type_pkey;
ALTER TABLE ONLY public.services DROP CONSTRAINT services_pkey;
ALTER TABLE ONLY public.services_history DROP CONSTRAINT services_history_pkey;
ALTER TABLE ONLY public.penalty_templates DROP CONSTRAINT penalty_templates_title_key;
ALTER TABLE ONLY public.penalty_templates DROP CONSTRAINT penalty_templates_pkey;
ALTER TABLE ONLY public.penalties DROP CONSTRAINT penalties_pkey;
ALTER TABLE ONLY public.locations DROP CONSTRAINT locations_pkey;
ALTER TABLE ONLY public.locations DROP CONSTRAINT locations_alias_key;
ALTER TABLE ONLY public.ipv4s DROP CONSTRAINT ipv4s_pkey;
ALTER TABLE ONLY public.faculties DROP CONSTRAINT faulties_pkey;
ALTER TABLE ONLY public.faculties DROP CONSTRAINT faulties_alias_key;
ALTER TABLE ONLY public.dormitories DROP CONSTRAINT dormitories_pkey;
ALTER TABLE ONLY public.dormitories DROP CONSTRAINT dormitories_alias_key;
ALTER TABLE ONLY public.computers DROP CONSTRAINT computers_pkey;
ALTER TABLE ONLY public.computers_history DROP CONSTRAINT computers_history_pkey;
ALTER TABLE ONLY public.computers_bans DROP CONSTRAINT computers_bans_pkey;
ALTER TABLE ONLY public.admins DROP CONSTRAINT admins_pkey;
ALTER TABLE ONLY public.admins DROP CONSTRAINT admins_login_key;
ALTER TABLE public.services_type ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.services_history ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.services ALTER COLUMN id DROP DEFAULT;
DROP TABLE public.users_walet;
DROP TABLE public.users_tokens;
DROP SEQUENCE public.users_tokens_id_seq;
DROP TABLE public.users_old;
DROP TABLE public.users_history;
DROP SEQUENCE public.users_history_id_seq;
DROP TABLE public.users;
DROP SEQUENCE public.users_id_seq;
DROP TABLE public.text;
DROP SEQUENCE public.text_id_seq;
DROP SEQUENCE public.services_type_id_seq;
DROP SEQUENCE public.services_id_seq;
DROP VIEW public.services_history_view;
DROP TABLE public.services_type;
DROP SEQUENCE public.services_history_id_seq;
DROP TABLE public.services_history;
DROP TABLE public.services;
DROP TABLE public.penalty_templates;
DROP SEQUENCE public.penalty_templates_id;
DROP TABLE public.penalties;
DROP TABLE public.locations;
DROP SEQUENCE public.locations_id_seq;
DROP TABLE public.ipv4s;
DROP TABLE public.faculties;
DROP SEQUENCE public.faulties_id_seq;
DROP TABLE public.dormitories;
DROP SEQUENCE public.dormitories_id_seq;
DROP TABLE public.computers_history;
DROP SEQUENCE public.computers_history_id_seq;
DROP SEQUENCE public.computers_history_computer_id_seq;
DROP TABLE public.computers_bans;
DROP SEQUENCE public.computers_ban_id;
DROP TABLE public.computers;
DROP SEQUENCE public.computers_id_seq;
DROP SEQUENCE public.bans_id_seq;
DROP TABLE public.admins;
DROP SEQUENCE public.admins_id_seq;
DROP FUNCTION public.user_update();
DROP FUNCTION public.user_service_update();
DROP FUNCTION public.user_service_create();
DROP FUNCTION public.user_counters();
DROP FUNCTION public.user_computers();
DROP FUNCTION public.remove_bans();
DROP FUNCTION public.penalty_users();
DROP FUNCTION public.penalty_computers_bans();
DROP FUNCTION public.location_counters();
DROP FUNCTION public.ipv4_counters();
DROP FUNCTION public.computer_update();
DROP FUNCTION public.computer_counters();
DROP FUNCTION public.computer_ban_computers();
DROP PROCEDURAL LANGUAGE plpgsql;
DROP SCHEMA public;
--
-- Name: public; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA public;


--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- Name: plpgsql; Type: PROCEDURAL LANGUAGE; Schema: -; Owner: -
--

CREATE PROCEDURAL LANGUAGE plpgsql;


SET search_path = public, pg_catalog;

--
-- Name: computer_ban_computers(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION computer_ban_computers() RETURNS trigger
    AS $$BEGIN
IF ('INSERT' = TG_OP) THEN
	UPDATE computers
		SET banned = true, bans = bans + 1
		WHERE id = NEW.computer_id;
ELSIF ('UPDATE' = TG_OP AND OLD.active = true AND NEW.active = false AND
(SELECT count(id) AS count FROM computers_bans WHERE active AND computer_id = OLD.computer_id) < 1) THEN
	UPDATE computers
		SET banned = false
		WHERE id = OLD.computer_id;
END IF;
RETURN NEW;
END;$$
    LANGUAGE plpgsql;


--
-- Name: FUNCTION computer_ban_computers(); Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON FUNCTION computer_ban_computers() IS 'modyfikuje komputery, ktorych dotyczy kara';


--
-- Name: computer_counters(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION computer_counters() RETURNS trigger
    AS $$
DECLARE
	change INT := 0; -- 2 = dodaj w nowym, 1 = usun w starym, 3 = usun w starym i dodaj w nowym
BEGIN
IF ('INSERT' = TG_OP AND NEW.active) THEN
	change := 2;
ELSIF ('UPDATE' = TG_OP) THEN
	IF (OLD.location_id <> NEW.location_id) THEN
		change := 3;
	END IF;
	IF (OLD.active = false AND NEW.active = true) THEN
		change := 2;
	ELSIF (OLD.active = true AND NEW.active = false) THEN
		change := 1;
	ELSIF (OLD.active = false AND NEW.active = false) THEN
		change := 0;
	END IF;
ELSIF ('DELETE' = TG_OP AND OLD.active) THEN
	change := 1;
END IF;
IF (1 = change OR 3 = change) THEN
	UPDATE locations
		SET computers_count = computers_count - 1
		WHERE id = OLD.location_id;
END IF;
IF (2 = change OR 3 = change) THEN
	UPDATE locations
		SET computers_count = computers_count + 1
		WHERE id = NEW.location_id;
END IF;
RETURN NEW;
END;$$
    LANGUAGE plpgsql;


--
-- Name: FUNCTION computer_counters(); Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON FUNCTION computer_counters() IS 'modyfikuje liczniki liczace komputery';


--
-- Name: computer_update(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION computer_update() RETURNS trigger
    AS $$BEGIN
if
	OLD.host!=NEW.host OR
	OLD.mac!=NEW.mac OR
	OLD.ipv4!=NEW.ipv4 OR
	OLD.user_id!=NEW.user_id OR
	OLD.location_id!=NEW.location_id OR
	OLD.avail_to!=NEW.avail_to OR
	OLD.avail_max_to!=NEW.avail_max_to OR
	OLD.comment!=NEW.comment OR
	OLD.can_admin!=NEW.can_admin OR
	OLD.active!=NEW.active
then
	INSERT INTO computers_history (
		computer_id,
		host,
		mac,
		ipv4,
		user_id,
		location_id,
		avail_to,
		avail_max_to,
		modified_by,
		modified_at,
		comment,
		can_admin,
		active
	) VALUES (
		OLD.id,
		OLD.host,
		OLD.mac,
		OLD.ipv4,
		OLD.user_id,
		OLD.location_id,
		OLD.avail_to,
		OLD.avail_max_to,
		OLD.modified_by,
		OLD.modified_at,
		OLD.comment,
		OLD.can_admin,
		OLD.active
	);
end if;
return NEW;
END;$$
    LANGUAGE plpgsql;


--
-- Name: FUNCTION computer_update(); Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON FUNCTION computer_update() IS 'archiwizacja danych komputera';


--
-- Name: ipv4_counters(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION ipv4_counters() RETURNS trigger
    AS $$BEGIN
IF ('INSERT' = TG_OP) THEN
	IF (NEW.dormitory_id IS NOT NULL) THEN
		UPDATE dormitories
			SET computers_max = computers_max + 1
			WHERE id = NEW.dormitory_id;
	END IF;
ELSIF ('UPDATE' = TG_OP) THEN
	IF (NEW.dormitory_id<>OLD.dormitory_id) THEN
		IF (OLD.dormitory_id IS NOT NULL) THEN
			UPDATE dormitories
				SET computers_max = computers_max - 1
				WHERE id = OLD.dormitory_id;
		END IF;
		IF (NEW.dormitory_id IS NOT NULL) THEN
			UPDATE dormitories
				SET computers_max = computers_max + 1
				WHERE id = NEW.dormitory_id;
		END IF;
	END IF;
ELSIF ('DELETE' = TG_OP) THEN
	IF (OLD.dormitory_id IS NOT NULL) THEN
		UPDATE dormitories
			SET computers_max = computers_max - 1
			WHERE id = OLD.dormitory_id;
	END IF;
END IF;
RETURN NEW;
END;$$
    LANGUAGE plpgsql;


--
-- Name: FUNCTION ipv4_counters(); Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON FUNCTION ipv4_counters() IS 'modyfikuje liczniki ip-kow';


--
-- Name: location_counters(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION location_counters() RETURNS trigger
    AS $$BEGIN
IF ('UPDATE' = TG_OP) THEN
	IF (OLD.computers_count <> NEW.computers_count) THEN
		UPDATE dormitories
			SET computers_count = computers_count + NEW.computers_count - OLD.computers_count
			WHERE id = NEW.dormitory_id;
	END IF;
	IF (OLD.users_count <> NEW.users_count) THEN
		UPDATE dormitories
			SET users_count = users_count + NEW.users_count - OLD.users_count
			WHERE id = NEW.dormitory_id;
	END IF;
	IF (OLD.users_max <> NEW.users_max) THEN
		UPDATE dormitories
			SET users_max = users_max + NEW.users_max - OLD.users_max
			WHERE id = NEW.dormitory_id;
	END IF;
	IF (OLD.dormitory_id <> NEW.dormitory_id) THEN
		UPDATE dormitories
			SET users_max = users_max - NEW.users_max -- new.users_max, bo nieco wyzej juz zmodyfikowalismy users_max dla danego akademika
			WHERE id = OLD.dormitory_id;
		UPDATE dormitories
			SET users_max = users_max + NEW.users_max
			WHERE id = NEW.dormitory_id;
	END IF;
ELSIF ('INSERT' = TG_OP) THEN
	IF (NEW.users_max<>0) THEN
		UPDATE dormitories
			SET users_max = users_max + NEW.users_max
			WHERE id = NEW.dormitory_id;
	END IF;
ELSIF ('DELETE' = TG_OP) THEN
	IF (OLD.users_max<>0) THEN
		UPDATE dormitories
			SET users_max = users_max - OLD.users_max
			WHERE id = OLD.dormitory_id;
	END IF;
END IF;
RETURN NEW;
END;$$
    LANGUAGE plpgsql;


--
-- Name: FUNCTION location_counters(); Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON FUNCTION location_counters() IS 'modyfikuje liczniki uzytkownikow i komputerow';


--
-- Name: penalty_computers_bans(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION penalty_computers_bans() RETURNS trigger
    AS $$BEGIN
IF ('UPDATE' = TG_OP) THEN
IF (OLD.active = true AND NEW.active = false) THEN
	 UPDATE computers_bans
		SET active = false
		WHERE penalty_id = OLD.id;
END IF;
END IF;
RETURN NEW;
END;$$
    LANGUAGE plpgsql;


--
-- Name: FUNCTION penalty_computers_bans(); Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON FUNCTION penalty_computers_bans() IS 'modyfikuje bany na komputery';


--
-- Name: penalty_users(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION penalty_users() RETURNS trigger
    AS $$BEGIN
IF ('INSERT' = TG_OP) THEN
	IF NEW.type_id<>1 THEN	-- nie ostrzezenie
		UPDATE users
			SET banned = true, bans = bans + 1
			WHERE id = NEW.user_id;
	ELSE
		UPDATE users
			SET bans = bans + 1
			WHERE id = NEW.user_id;
	END IF;
ELSIF ('UPDATE' = TG_OP) THEN
	IF (OLD.active=true AND NEW.active = false) THEN
		UPDATE users
			SET banned = false
			WHERE users.id = old.user_id;
	END IF;
END IF;
RETURN NEW;
END;$$
    LANGUAGE plpgsql;


--
-- Name: FUNCTION penalty_users(); Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON FUNCTION penalty_users() IS 'modyfikuje dane uzytkownika';


--
-- Name: remove_bans(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION remove_bans() RETURNS integer
    AS $$
DECLARE
        updated INT;
BEGIN
        UPDATE penalties SET active = 'false' WHERE active = 'true' and end_at < now();

        GET DIAGNOSTICS updated = ROW_COUNT;
        RETURN updated;
END;
$$
    LANGUAGE plpgsql;


--
-- Name: user_computers(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION user_computers() RETURNS trigger
    AS $$BEGIN
IF ('UPDATE' = TG_OP) THEN
IF (OLD.active=true AND NEW.active=false) THEN
	UPDATE computers
		SET	active = false,
			modified_by = new.modified_by,
			modified_at = new.modified_at,
			avail_to = new.modified_at
		WHERE user_id = NEW.id AND active = true;

END IF;
END IF;
RETURN NEW;
END;$$
    LANGUAGE plpgsql;


--
-- Name: FUNCTION user_computers(); Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON FUNCTION user_computers() IS 'zmienia dane komputerow';


--
-- Name: user_counters(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION user_counters() RETURNS trigger
    AS $$
DECLARE
	change INT := 0; -- 1 = usun ze starego, 2 = dodaj do nowego, 3 = obie akcje
BEGIN
IF ('INSERT' = TG_OP) THEN
	IF (NEW.active) THEN
		change := 2;
	END IF;
ELSIF ('UPDATE' = TG_OP) THEN
	IF (OLD.location_id <> NEW.location_id) THEN
		change := 3;
	END IF;
	IF (OLD.active = false AND NEW.active = true) THEN
		change := 2;
	ELSIF (OLD.active = true AND NEW.active = false) THEN
		change := 1;
	ELSIF (OLD.active = false AND NEW.active = false) THEN
		change := 0;
	END IF;
ELSIF ('DELETE' = TG_OP) THEN
	IF (OLD.active) THEN
		UPDATE locations
			SET users_count = users_count - 1
			WHERE id = OLD.location_id;
	END IF;
END IF;
IF (1 = change OR 3 = change) THEN
	UPDATE locations
		SET users_count = users_count - 1
		WHERE id = OLD.location_id;
END IF;
IF (2 = change OR 3 = change) THEN
	UPDATE locations
		SET users_count = users_count + 1
		WHERE id = NEW.location_id;
END IF;
RETURN NEW;
END;$$
    LANGUAGE plpgsql;


--
-- Name: FUNCTION user_counters(); Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON FUNCTION user_counters() IS 'modyfikuje liczniki liczace uzytkownikow';


--
-- Name: user_service_create(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION user_service_create() RETURNS trigger
    AS $$BEGIN
	INSERT INTO services_history (
		user_id,
		serv_id,
		serv_type_id,
		modified_by,
		active
	) VALUES (
		NEW.user_id,
		NEW.id,
		NEW.serv_type_id,
		NEW.modified_by,
		'1'
	);
return NEW;
END;$$
    LANGUAGE plpgsql;


--
-- Name: user_service_update(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION user_service_update() RETURNS trigger
    AS $$DECLARE
	state INT; -- 2 = usluga aktywna, 3 = usluga czeka na deaktywacje, 4 = usluga usunieta

BEGIN
IF (NEW.active = true) THEN
	state := 2;
ELSIF (NEW.active is NULL) THEN
	state := 3;
ELSE state := 4;
END IF;
INSERT INTO services_history (
	user_id,
	serv_id,
	serv_type_id,
	modified_by,
	active
) VALUES (
	NEW.user_id,
	NEW.id,
	NEW.serv_type_id,
	NEW.modified_by,
	state
);

IF (state = 4) THEN 
	DELETE FROM services WHERE id = NEW.id;
END IF;
RETURN NEW;
END;$$
    LANGUAGE plpgsql;


--
-- Name: user_update(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION user_update() RETURNS trigger
    AS $$BEGIN
if
	NEW.name!=OLD.name OR
	NEW.surname!=OLD.surname OR
	NEW.login!=OLD.login OR
	NEW.email!=OLD.email OR
	NEW.gg!=OLD.gg OR
	NEW.faculty_id!=OLD.faculty_id OR
	NEW.study_year_id!=OLD.study_year_id OR
	NEW.location_id!=OLD.location_id OR
	NEW.comment!=OLD.comment OR
	NEW.active!=OLD.active
then
	INSERT INTO users_history (
		user_id,
		name,
		surname,
		login,
		email,
		gg,
		faculty_id,
		study_year_id,
		location_id,
		modified_by,
		modified_at,
		comment,
		active
	) VALUES (
		OLD.id,
		OLD.name,
		OLD.surname,
		OLD.login,
		OLD.email,
		OLD.gg,
		OLD.faculty_id,
		OLD.study_year_id,
		OLD.location_id,
		OLD.modified_by,
		OLD.modified_at,
		OLD.comment,
		OLD.active
	);
end if;
return NEW;
END;$$
    LANGUAGE plpgsql;


--
-- Name: FUNCTION user_update(); Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON FUNCTION user_update() IS 'archiwizacja danych uzytkownika';


--
-- Name: admins_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE admins_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: admins; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE admins (
    id bigint DEFAULT nextval('admins_id_seq'::regclass) NOT NULL,
    login character varying NOT NULL,
    password character(32) NOT NULL,
    last_login_at timestamp without time zone,
    last_login_ip inet,
    name character varying(255) NOT NULL,
    type_id smallint DEFAULT 1 NOT NULL,
    phone character varying(50) DEFAULT ''::character varying NOT NULL,
    gg character varying(20) DEFAULT ''::character varying NOT NULL,
    jid character varying(100) DEFAULT ''::character varying NOT NULL,
    email character varying(100) NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    dormitory_id bigint,
    address character varying(255) DEFAULT ''::character varying NOT NULL,
    active boolean DEFAULT true NOT NULL
);


--
-- Name: TABLE admins; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE admins IS 'administratorzy';


--
-- Name: COLUMN admins.login; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN admins.login IS 'login';


--
-- Name: COLUMN admins.password; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN admins.password IS 'haslo zakodowane md5';


--
-- Name: COLUMN admins.last_login_at; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN admins.last_login_at IS 'czas ostatniego logowania';


--
-- Name: COLUMN admins.last_login_ip; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN admins.last_login_ip IS 'ip, z ktorego ostatnio sie logowal';


--
-- Name: COLUMN admins.name; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN admins.name IS 'nazwa ekranowa - imie-ksywka-nazwisko albo nazwa bota itp.';


--
-- Name: COLUMN admins.type_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN admins.type_id IS 'typ administratora: lokalny, osiedlowy, centralny, bot';


--
-- Name: COLUMN admins.phone; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN admins.phone IS 'telefon prywatny';


--
-- Name: COLUMN admins.gg; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN admins.gg IS 'numer gadu-gadu';


--
-- Name: COLUMN admins.jid; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN admins.jid IS 'jabber id';


--
-- Name: COLUMN admins.email; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN admins.email IS '"oficjalny" email do administratora';


--
-- Name: COLUMN admins.created_at; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN admins.created_at IS 'czas utworzenia konta';


--
-- Name: COLUMN admins.dormitory_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN admins.dormitory_id IS 'akademik, nie dotyczy botow i centralnych';


--
-- Name: COLUMN admins.address; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN admins.address IS 'gdzie mieszka administrator';


--
-- Name: COLUMN admins.active; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN admins.active IS 'czy konto jest aktywne?';


--
-- Name: bans_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE bans_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: computers_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE computers_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: computers; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE computers (
    id bigint DEFAULT nextval('computers_id_seq'::regclass) NOT NULL,
    host character varying(50) NOT NULL,
    mac macaddr NOT NULL,
    ipv4 inet NOT NULL,
    user_id bigint,
    location_id bigint,
    avail_to timestamp without time zone NOT NULL,
    avail_max_to timestamp without time zone NOT NULL,
    modified_by bigint,
    modified_at timestamp without time zone DEFAULT now() NOT NULL,
    comment pg_catalog.text DEFAULT ''::pg_catalog.text NOT NULL,
    active boolean DEFAULT true NOT NULL,
    type_id smallint DEFAULT 1 NOT NULL,
    bans integer DEFAULT 0 NOT NULL,
    can_admin boolean DEFAULT false NOT NULL,
    banned boolean DEFAULT false NOT NULL
);


--
-- Name: TABLE computers; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE computers IS 'komputery';


--
-- Name: COLUMN computers.host; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers.host IS 'nazwa hosta';


--
-- Name: COLUMN computers.mac; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers.mac IS 'adres mac karty sieciowej';


--
-- Name: COLUMN computers.ipv4; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers.ipv4 IS 'adres ip';


--
-- Name: COLUMN computers.user_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers.user_id IS 'uzytkownik, do ktorego nalezy ten komputer';


--
-- Name: COLUMN computers.location_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers.location_id IS 'pokoj';


--
-- Name: COLUMN computers.avail_to; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers.avail_to IS 'do kiedy jest wazna rejestracja';


--
-- Name: COLUMN computers.avail_max_to; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers.avail_max_to IS 'do kiedy mozna sobie przedluzyc rejestracje';


--
-- Name: COLUMN computers.modified_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers.modified_by IS 'kto wprowadzil te dane';


--
-- Name: COLUMN computers.modified_at; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers.modified_at IS 'czas powstania tej wersji';


--
-- Name: COLUMN computers.comment; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers.comment IS 'komentarz';


--
-- Name: COLUMN computers.active; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers.active IS 'czy komputer ma wazna rejestracje';


--
-- Name: COLUMN computers.type_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers.type_id IS 'typ komputera: student, administracja, organizacja, serwer itd.';


--
-- Name: COLUMN computers.bans; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers.bans IS 'licznik banow';


--
-- Name: COLUMN computers.can_admin; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers.can_admin IS 'komputer nalezy do administratora';


--
-- Name: COLUMN computers.banned; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers.banned IS 'czy komputer jest aktualnie zabanowany?';


--
-- Name: computers_ban_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE computers_ban_id
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: computers_bans; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE computers_bans (
    id bigint DEFAULT nextval('computers_ban_id'::regclass) NOT NULL,
    computer_id bigint NOT NULL,
    penalty_id bigint NOT NULL,
    active boolean DEFAULT true NOT NULL
);


--
-- Name: TABLE computers_bans; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE computers_bans IS 'zbanowane komputery';


--
-- Name: COLUMN computers_bans.computer_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers_bans.computer_id IS 'ktory komputer';


--
-- Name: COLUMN computers_bans.penalty_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers_bans.penalty_id IS 'ktora kara';


--
-- Name: computers_history_computer_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE computers_history_computer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: computers_history_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE computers_history_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: computers_history; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE computers_history (
    computer_id bigint DEFAULT nextval('computers_history_computer_id_seq'::regclass) NOT NULL,
    host character varying(50) NOT NULL,
    mac macaddr NOT NULL,
    ipv4 inet NOT NULL,
    user_id bigint,
    location_id bigint,
    avail_to timestamp without time zone NOT NULL,
    modified_by bigint,
    modified_at timestamp without time zone DEFAULT now() NOT NULL,
    comment pg_catalog.text NOT NULL,
    can_admin boolean DEFAULT false NOT NULL,
    id bigint DEFAULT nextval('computers_history_id_seq'::regclass) NOT NULL,
    avail_max_to timestamp without time zone NOT NULL,
    active boolean NOT NULL
);


--
-- Name: TABLE computers_history; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE computers_history IS 'historia zmian danych komputerow';


--
-- Name: COLUMN computers_history.host; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers_history.host IS 'nazwa hosta';


--
-- Name: COLUMN computers_history.mac; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers_history.mac IS 'adres mac karty sieciowej';


--
-- Name: COLUMN computers_history.ipv4; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers_history.ipv4 IS 'adres ip';


--
-- Name: COLUMN computers_history.user_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers_history.user_id IS 'uzytkownik, do ktorego nalezy ten komputer';


--
-- Name: COLUMN computers_history.location_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers_history.location_id IS 'pokoj';


--
-- Name: COLUMN computers_history.avail_to; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers_history.avail_to IS 'do kiedy jest wazna rejestracja';


--
-- Name: COLUMN computers_history.modified_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers_history.modified_by IS 'kto wprowadzil te dane';


--
-- Name: COLUMN computers_history.modified_at; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers_history.modified_at IS 'czas powstania tej wersji';


--
-- Name: COLUMN computers_history.comment; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers_history.comment IS 'komentarz';


--
-- Name: COLUMN computers_history.can_admin; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN computers_history.can_admin IS 'komputer nalezy do administratora';


--
-- Name: dormitories_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE dormitories_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: dormitories; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE dormitories (
    id bigint DEFAULT nextval('dormitories_id_seq'::regclass) NOT NULL,
    name character varying(255) NOT NULL,
    alias character varying(10) NOT NULL,
    users_count integer DEFAULT 0 NOT NULL,
    computers_count integer DEFAULT 0 NOT NULL,
    users_max integer DEFAULT 0 NOT NULL,
    computers_max integer DEFAULT 0 NOT NULL
);


--
-- Name: TABLE dormitories; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE dormitories IS 'akademiki';


--
-- Name: COLUMN dormitories.name; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN dormitories.name IS 'pelna nazwa';


--
-- Name: COLUMN dormitories.alias; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN dormitories.alias IS 'skrot, uzywany do budowy url-i';


--
-- Name: COLUMN dormitories.users_count; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN dormitories.users_count IS 'ilosc zarejestrowanych uzytkownikow';


--
-- Name: COLUMN dormitories.computers_count; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN dormitories.computers_count IS 'ilosc zarejestrowanych komputerow';


--
-- Name: faulties_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE faulties_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: faculties; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE faculties (
    id bigint DEFAULT nextval('faulties_id_seq'::regclass) NOT NULL,
    name character varying(255) NOT NULL,
    alias character varying(10) NOT NULL,
    users_count integer DEFAULT 0 NOT NULL,
    computers_count integer DEFAULT 0 NOT NULL
);


--
-- Name: TABLE faculties; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE faculties IS 'wydzialy';


--
-- Name: COLUMN faculties.name; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN faculties.name IS 'nazwa wydzialu';


--
-- Name: COLUMN faculties.alias; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN faculties.alias IS 'skrot nazwy, uzywany do budowy url-i';


--
-- Name: COLUMN faculties.users_count; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN faculties.users_count IS 'ilosc zarejestrowanych uzytkownikow';


--
-- Name: COLUMN faculties.computers_count; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN faculties.computers_count IS 'ilosc zarejestrowanych komputerow';


--
-- Name: ipv4s; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE ipv4s (
    ip inet NOT NULL,
    dormitory_id bigint
);


--
-- Name: TABLE ipv4s; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE ipv4s IS 'dostepne adresy ip';


--
-- Name: COLUMN ipv4s.ip; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN ipv4s.ip IS 'adres ip';


--
-- Name: COLUMN ipv4s.dormitory_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN ipv4s.dormitory_id IS 'akademik';


--
-- Name: locations_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE locations_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: locations; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE locations (
    id bigint DEFAULT nextval('locations_id_seq'::regclass) NOT NULL,
    alias character varying(10) NOT NULL,
    comment pg_catalog.text DEFAULT ''::pg_catalog.text NOT NULL,
    users_count integer DEFAULT 0 NOT NULL,
    computers_count integer DEFAULT 0 NOT NULL,
    dormitory_id bigint NOT NULL,
    users_max smallint
);


--
-- Name: TABLE locations; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE locations IS 'pokoje';


--
-- Name: COLUMN locations.alias; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN locations.alias IS 'unikalna nazwa pokoju, uzywana do budowy url-i';


--
-- Name: COLUMN locations.comment; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN locations.comment IS 'komentarz do pokoju';


--
-- Name: COLUMN locations.users_count; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN locations.users_count IS 'ilosc zarejestrowanych uzytkownikow';


--
-- Name: COLUMN locations.computers_count; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN locations.computers_count IS 'ilosc zarejestrowanych komputerow';


--
-- Name: COLUMN locations.dormitory_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN locations.dormitory_id IS 'akademik, w ktorym znajduje sie pokoj';


--
-- Name: COLUMN locations.users_max; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN locations.users_max IS 'maksymalna ilosc osob w pokoju';


--
-- Name: penalties; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE penalties (
    id bigint DEFAULT nextval('bans_id_seq'::regclass) NOT NULL,
    created_by bigint NOT NULL,
    user_id bigint,
    type_id smallint DEFAULT 1 NOT NULL,
    start_at timestamp without time zone DEFAULT now() NOT NULL,
    end_at timestamp without time zone NOT NULL,
    comment pg_catalog.text,
    modified_by bigint,
    reason pg_catalog.text NOT NULL,
    modified_at timestamp without time zone,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    amnesty_at timestamp without time zone,
    amnesty_after timestamp without time zone,
    amnesty_by bigint,
    active boolean DEFAULT true NOT NULL,
    template_id smallint
);


--
-- Name: TABLE penalties; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE penalties IS 'kary nalozone na uzytkownikow';


--
-- Name: COLUMN penalties.created_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalties.created_by IS 'tworca kary';


--
-- Name: COLUMN penalties.user_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalties.user_id IS 'ukarany uzytkownik';


--
-- Name: COLUMN penalties.type_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalties.type_id IS 'typ kary: ostrzezenie, wszystko, komputer itp';


--
-- Name: COLUMN penalties.start_at; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalties.start_at IS 'od kiedy kara obowiazuje';


--
-- Name: COLUMN penalties.end_at; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalties.end_at IS 'do kiedy kara obowiazuje';


--
-- Name: COLUMN penalties.comment; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalties.comment IS 'komentarze administratorow';


--
-- Name: COLUMN penalties.modified_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalties.modified_by IS 'kto modyfikowal ostanio';


--
-- Name: COLUMN penalties.reason; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalties.reason IS 'powod(dla uzytkownika)';


--
-- Name: COLUMN penalties.modified_at; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalties.modified_at IS 'kiedy ostanio modyfikowano';


--
-- Name: COLUMN penalties.created_at; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalties.created_at IS 'kiedy utworzono kare';


--
-- Name: COLUMN penalties.amnesty_at; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalties.amnesty_at IS 'kiedy udzielono amnesti';


--
-- Name: COLUMN penalties.amnesty_after; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalties.amnesty_after IS 'od kiedy dopuszcza sie mozliwosc amnesti';


--
-- Name: COLUMN penalties.amnesty_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalties.amnesty_by IS 'kto udzielil amnesti';


--
-- Name: COLUMN penalties.template_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalties.template_id IS 'id szablonu, na podstawie ktorego zostala utworzona kara';


--
-- Name: penalty_templates_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE penalty_templates_id
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: penalty_templates; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE penalty_templates (
    id bigint DEFAULT nextval('penalty_templates_id'::regclass) NOT NULL,
    title character varying(100) NOT NULL,
    description pg_catalog.text,
    penalty_type_id smallint NOT NULL,
    duration integer NOT NULL,
    amnesty_after integer DEFAULT 0 NOT NULL,
    reason pg_catalog.text DEFAULT ''::pg_catalog.text NOT NULL
);


--
-- Name: TABLE penalty_templates; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE penalty_templates IS 'szablony kar';


--
-- Name: COLUMN penalty_templates.title; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalty_templates.title IS 'tytul';


--
-- Name: COLUMN penalty_templates.description; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalty_templates.description IS 'opis dla administratora';


--
-- Name: COLUMN penalty_templates.penalty_type_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalty_templates.penalty_type_id IS 'typ kary: ostrzezenie, wszystko, komputer it';


--
-- Name: COLUMN penalty_templates.duration; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalty_templates.duration IS 'czas trwania kary';


--
-- Name: COLUMN penalty_templates.amnesty_after; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN penalty_templates.amnesty_after IS 'czas po ktorym mozna udzielic amnesti';


--
-- Name: services; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE services (
    id bigint NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    user_id bigint NOT NULL,
    serv_type_id bigint NOT NULL,
    active boolean DEFAULT false,
    modified_by bigint
);


--
-- Name: TABLE services; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE services IS 'uslugi uzytkownikow';


--
-- Name: COLUMN services.created_at; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN services.created_at IS 'czas utworzenia uslugi';


--
-- Name: COLUMN services.user_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN services.user_id IS 'id uzytkownika';


--
-- Name: COLUMN services.serv_type_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN services.serv_type_id IS 'id typu/rodzaju uslugi';


--
-- Name: COLUMN services.active; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN services.active IS 'stan uslugi, false-nieaktywna/czeka na aktywacje, true-aktywna, null-do usuniecia';


--
-- Name: services_history; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE services_history (
    id bigint NOT NULL,
    modified_at timestamp without time zone DEFAULT now() NOT NULL,
    user_id bigint NOT NULL,
    serv_id bigint,
    serv_type_id bigint NOT NULL,
    modified_by bigint,
    active smallint NOT NULL
);


--
-- Name: TABLE services_history; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE services_history IS 'historia zmian w uslugach uzytkownika';


--
-- Name: COLUMN services_history.modified_at; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN services_history.modified_at IS 'czas powstania tej wersji';


--
-- Name: COLUMN services_history.user_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN services_history.user_id IS 'id uzytkownika';


--
-- Name: COLUMN services_history.serv_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN services_history.serv_id IS 'id uslugi';


--
-- Name: COLUMN services_history.serv_type_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN services_history.serv_type_id IS 'id typu/rodzaju uslugi';


--
-- Name: COLUMN services_history.modified_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN services_history.modified_by IS 'kto przydzielil usluge';


--
-- Name: COLUMN services_history.active; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN services_history.active IS 'stan uslugi';


--
-- Name: services_history_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE services_history_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: services_history_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE services_history_id_seq OWNED BY services_history.id;


--
-- Name: services_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE services_type (
    id bigint NOT NULL,
    name character varying(255) NOT NULL
);


--
-- Name: TABLE services_type; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE services_type IS 'dostepne uslugi';


--
-- Name: COLUMN services_type.name; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN services_type.name IS 'nazwa uslugi';


--
-- Name: services_history_view; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW services_history_view AS
    SELECT h.modified_at, h.user_id, h.active, t.name AS serv_name, a.id AS admin_id, a.name AS admin FROM ((services_history h LEFT JOIN services_type t ON ((t.id = h.serv_type_id))) LEFT JOIN admins a ON ((h.modified_by = a.id))) ORDER BY h.modified_at DESC;


--
-- Name: VIEW services_history_view; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON VIEW services_history_view IS 'widok historii uslug uzytkownika';


--
-- Name: services_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE services_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: services_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE services_id_seq OWNED BY services.id;


--
-- Name: services_type_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE services_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: services_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE services_type_id_seq OWNED BY services_type.id;


--
-- Name: text_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE text_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: text; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE text (
    id bigint DEFAULT nextval('text_id_seq'::regclass) NOT NULL,
    alias pg_catalog.text NOT NULL,
    title pg_catalog.text NOT NULL,
    content pg_catalog.text NOT NULL,
    modified_at timestamp without time zone DEFAULT now() NOT NULL,
    modified_by bigint
);


--
-- Name: TABLE text; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE text IS 'statyczne strony tekstowe';


--
-- Name: COLUMN text.alias; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN text.alias IS '"url"';


--
-- Name: COLUMN text.title; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN text.title IS 'tytul';


--
-- Name: COLUMN text.content; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN text.content IS 'tresc glowna';


--
-- Name: COLUMN text.modified_at; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN text.modified_at IS 'data ostatniej modyfikacji';


--
-- Name: COLUMN text.modified_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN text.modified_by IS 'kto dokonal modyfikacji';


--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE users_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: users; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE users (
    id bigint DEFAULT nextval('users_id_seq'::regclass) NOT NULL,
    login character varying NOT NULL,
    password character(32) NOT NULL,
    surname character varying(100) NOT NULL,
    email character varying(100) NOT NULL,
    faculty_id bigint,
    study_year_id smallint,
    location_id bigint NOT NULL,
    bans smallint DEFAULT 0 NOT NULL,
    modified_by bigint,
    modified_at timestamp without time zone DEFAULT now() NOT NULL,
    comment pg_catalog.text DEFAULT ''::pg_catalog.text NOT NULL,
    name character varying(100) NOT NULL,
    active boolean DEFAULT true NOT NULL,
    banned boolean DEFAULT false NOT NULL,
    gg pg_catalog.text NOT NULL
);


--
-- Name: TABLE users; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE users IS 'uzytkownicy sieci';


--
-- Name: COLUMN users.login; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users.login IS 'login';


--
-- Name: COLUMN users.password; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users.password IS 'haslo zakodowane md5';


--
-- Name: COLUMN users.surname; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users.surname IS 'nazwisko';


--
-- Name: COLUMN users.email; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users.email IS 'email';


--
-- Name: COLUMN users.faculty_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users.faculty_id IS 'wydzial ,jezeli dotyczy';


--
-- Name: COLUMN users.study_year_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users.study_year_id IS 'identyfikator roku studiow, jezeli dotyczy';


--
-- Name: COLUMN users.location_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users.location_id IS 'miejsce zamieszkania';


--
-- Name: COLUMN users.bans; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users.bans IS 'ilosc otrzymanych banow';


--
-- Name: COLUMN users.modified_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users.modified_by IS 'kto wprowadzil te dane';


--
-- Name: COLUMN users.modified_at; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users.modified_at IS 'czas powstania tej wersji';


--
-- Name: COLUMN users.comment; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users.comment IS 'komentarze dotyczace uzytkownika';


--
-- Name: COLUMN users.name; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users.name IS 'imie';


--
-- Name: COLUMN users.active; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users.active IS 'czy uzytkownik moze logowac sie do systemu?';


--
-- Name: COLUMN users.banned; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users.banned IS 'czy uzytkownik jest w tej chwili zabanowany?';


--
-- Name: users_history_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE users_history_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: users_history; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE users_history (
    user_id bigint NOT NULL,
    name character varying(50) NOT NULL,
    surname character varying(100) NOT NULL,
    email character varying(100) NOT NULL,
    faculty_id bigint,
    study_year_id smallint,
    location_id bigint NOT NULL,
    modified_by bigint,
    modified_at timestamp without time zone NOT NULL,
    comment pg_catalog.text NOT NULL,
    id bigint DEFAULT nextval('users_history_id_seq'::regclass) NOT NULL,
    login character varying NOT NULL,
    active boolean NOT NULL,
    gg pg_catalog.text DEFAULT ''::pg_catalog.text NOT NULL
);


--
-- Name: TABLE users_history; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE users_history IS 'historia zmian danych uzytkownikow';


--
-- Name: COLUMN users_history.user_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users_history.user_id IS 'id uzytkownika';


--
-- Name: COLUMN users_history.name; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users_history.name IS 'imie';


--
-- Name: COLUMN users_history.surname; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users_history.surname IS 'nazwisko';


--
-- Name: COLUMN users_history.email; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users_history.email IS 'email';


--
-- Name: COLUMN users_history.faculty_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users_history.faculty_id IS 'wydzial';


--
-- Name: COLUMN users_history.study_year_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users_history.study_year_id IS 'identyfikator roku studiow';


--
-- Name: COLUMN users_history.location_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users_history.location_id IS 'miejsce zamieszkania';


--
-- Name: COLUMN users_history.modified_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users_history.modified_by IS 'kto wprowadzil te dane';


--
-- Name: COLUMN users_history.modified_at; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users_history.modified_at IS 'czas powstania tej wersji';


--
-- Name: COLUMN users_history.comment; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users_history.comment IS 'komentarz';


--
-- Name: COLUMN users_history.login; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users_history.login IS 'login';


--
-- Name: COLUMN users_history.gg; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users_history.gg IS 'gadu-gadu';


--
-- Name: users_old; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE users_old (
    email pg_catalog.text NOT NULL
);


--
-- Name: users_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE users_tokens_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: users_tokens; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE users_tokens (
    id integer DEFAULT nextval('users_tokens_id_seq'::regclass) NOT NULL,
    user_id integer NOT NULL,
    token pg_catalog.text NOT NULL,
    valid_to timestamp without time zone DEFAULT (now() + '7 days'::interval) NOT NULL,
    type smallint DEFAULT 0 NOT NULL
);


--
-- Name: COLUMN users_tokens.valid_to; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users_tokens.valid_to IS 'do kiedy token jest wazny';


--
-- Name: COLUMN users_tokens.type; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN users_tokens.type IS 'do czego moze byc ten token wykorzystany
0 - aktywacja konta';


--
-- Name: users_walet; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE users_walet (
    hash pg_catalog.text NOT NULL,
    room pg_catalog.text NOT NULL,
    dorm integer NOT NULL
);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE services ALTER COLUMN id SET DEFAULT nextval('services_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE services_history ALTER COLUMN id SET DEFAULT nextval('services_history_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE services_type ALTER COLUMN id SET DEFAULT nextval('services_type_id_seq'::regclass);


--
-- Name: admins_login_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY admins
    ADD CONSTRAINT admins_login_key UNIQUE (login, active);


--
-- Name: admins_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY admins
    ADD CONSTRAINT admins_pkey PRIMARY KEY (id);


--
-- Name: computers_bans_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY computers_bans
    ADD CONSTRAINT computers_bans_pkey PRIMARY KEY (id);


--
-- Name: computers_history_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY computers_history
    ADD CONSTRAINT computers_history_pkey PRIMARY KEY (id);


--
-- Name: computers_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY computers
    ADD CONSTRAINT computers_pkey PRIMARY KEY (id);


--
-- Name: dormitories_alias_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY dormitories
    ADD CONSTRAINT dormitories_alias_key UNIQUE (alias);


--
-- Name: dormitories_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY dormitories
    ADD CONSTRAINT dormitories_pkey PRIMARY KEY (id);


--
-- Name: faulties_alias_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY faculties
    ADD CONSTRAINT faulties_alias_key UNIQUE (alias);


--
-- Name: faulties_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY faculties
    ADD CONSTRAINT faulties_pkey PRIMARY KEY (id);


--
-- Name: ipv4s_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY ipv4s
    ADD CONSTRAINT ipv4s_pkey PRIMARY KEY (ip);


--
-- Name: locations_alias_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY locations
    ADD CONSTRAINT locations_alias_key UNIQUE (alias, dormitory_id);


--
-- Name: locations_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY locations
    ADD CONSTRAINT locations_pkey PRIMARY KEY (id);


--
-- Name: penalties_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY penalties
    ADD CONSTRAINT penalties_pkey PRIMARY KEY (id);


--
-- Name: penalty_templates_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY penalty_templates
    ADD CONSTRAINT penalty_templates_pkey PRIMARY KEY (id);


--
-- Name: penalty_templates_title_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY penalty_templates
    ADD CONSTRAINT penalty_templates_title_key UNIQUE (title);


--
-- Name: services_history_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY services_history
    ADD CONSTRAINT services_history_pkey PRIMARY KEY (id);


--
-- Name: services_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY services
    ADD CONSTRAINT services_pkey PRIMARY KEY (id);


--
-- Name: services_type_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY services_type
    ADD CONSTRAINT services_type_pkey PRIMARY KEY (id);


--
-- Name: services_user_id_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY services
    ADD CONSTRAINT services_user_id_key UNIQUE (user_id, serv_type_id);


--
-- Name: text_alias_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY text
    ADD CONSTRAINT text_alias_key UNIQUE (alias);


--
-- Name: text_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY text
    ADD CONSTRAINT text_pkey PRIMARY KEY (id);


--
-- Name: users_history_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY users_history
    ADD CONSTRAINT users_history_pkey PRIMARY KEY (id);


--
-- Name: users_login_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_login_key UNIQUE (login);


--
-- Name: users_old_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY users_old
    ADD CONSTRAINT users_old_pkey PRIMARY KEY (email);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: users_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY users_tokens
    ADD CONSTRAINT users_tokens_pkey PRIMARY KEY (id);


--
-- Name: computers_host_key; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX computers_host_key ON computers USING btree (host, active) WHERE (active = true);


--
-- Name: computers_ipv4_key; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX computers_ipv4_key ON computers USING btree (ipv4, active) WHERE ((active = true) AND (type_id <> 4));


--
-- Name: computers_mac_key; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX computers_mac_key ON computers USING btree (mac, active) WHERE ((active = true) AND (type_id <> 4));


--
-- Name: fki_computers_bans_computer_id; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX fki_computers_bans_computer_id ON computers_bans USING btree (computer_id);


--
-- Name: fki_computers_bans_penalty_id; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX fki_computers_bans_penalty_id ON computers_bans USING btree (penalty_id);


--
-- Name: fki_penalties_amnesty_by; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX fki_penalties_amnesty_by ON penalties USING btree (amnesty_by);


--
-- Name: fki_penalties_created_by; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX fki_penalties_created_by ON penalties USING btree (created_by);


--
-- Name: fki_penalties_modified_by; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX fki_penalties_modified_by ON penalties USING btree (modified_by);


--
-- Name: fki_penalties_user_id; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX fki_penalties_user_id ON penalties USING btree (user_id);


--
-- Name: user_id; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX user_id ON services_history USING btree (user_id);


--
-- Name: users_surname_key; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX users_surname_key ON users USING btree (surname);


--
-- Name: users_walet_all_key; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX users_walet_all_key ON users_walet USING btree (hash, room, dorm);


--
-- Name: computer_ban_computers; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER computer_ban_computers
    AFTER INSERT OR DELETE OR UPDATE ON computers_bans
    FOR EACH ROW
    EXECUTE PROCEDURE computer_ban_computers();


--
-- Name: computers_counters; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER computers_counters
    AFTER INSERT OR DELETE OR UPDATE ON computers
    FOR EACH ROW
    EXECUTE PROCEDURE computer_counters();


--
-- Name: computers_update; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER computers_update
    AFTER UPDATE ON computers
    FOR EACH ROW
    EXECUTE PROCEDURE computer_update();


--
-- Name: TRIGGER computers_update ON computers; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TRIGGER computers_update ON computers IS 'zapisuje historie zmian';


--
-- Name: ipv4s_counters; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER ipv4s_counters
    AFTER INSERT OR DELETE OR UPDATE ON ipv4s
    FOR EACH ROW
    EXECUTE PROCEDURE ipv4_counters();


--
-- Name: locations_counters; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER locations_counters
    AFTER INSERT OR DELETE OR UPDATE ON locations
    FOR EACH ROW
    EXECUTE PROCEDURE location_counters();


--
-- Name: penalties_computers_bans; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER penalties_computers_bans
    AFTER INSERT OR DELETE OR UPDATE ON penalties
    FOR EACH ROW
    EXECUTE PROCEDURE penalty_computers_bans();


--
-- Name: penalties_users; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER penalties_users
    AFTER INSERT OR DELETE OR UPDATE ON penalties
    FOR EACH ROW
    EXECUTE PROCEDURE penalty_users();


--
-- Name: user_service_create; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER user_service_create
    AFTER INSERT ON services
    FOR EACH ROW
    EXECUTE PROCEDURE user_service_create();


--
-- Name: TRIGGER user_service_create ON services; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TRIGGER user_service_create ON services IS 'dodaje usluge w historii uslug';


--
-- Name: user_service_update; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER user_service_update
    AFTER UPDATE ON services
    FOR EACH ROW
    EXECUTE PROCEDURE user_service_update();


--
-- Name: TRIGGER user_service_update ON services; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TRIGGER user_service_update ON services IS 'zapisuje zmiany w historii uslug';


--
-- Name: users_computers; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER users_computers
    AFTER INSERT OR DELETE OR UPDATE ON users
    FOR EACH ROW
    EXECUTE PROCEDURE user_computers();


--
-- Name: users_counters; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER users_counters
    AFTER INSERT OR DELETE OR UPDATE ON users
    FOR EACH ROW
    EXECUTE PROCEDURE user_counters();


--
-- Name: users_update; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER users_update
    AFTER UPDATE ON users
    FOR EACH ROW
    EXECUTE PROCEDURE user_update();


--
-- Name: TRIGGER users_update ON users; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TRIGGER users_update ON users IS 'kopiuje dane do historii';


--
-- Name: admins_dormitory_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY admins
    ADD CONSTRAINT admins_dormitory_id_fkey FOREIGN KEY (dormitory_id) REFERENCES dormitories(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: computers_bans_computer_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY computers_bans
    ADD CONSTRAINT computers_bans_computer_id_fkey FOREIGN KEY (computer_id) REFERENCES computers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: computers_bans_penalty_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY computers_bans
    ADD CONSTRAINT computers_bans_penalty_id_fkey FOREIGN KEY (penalty_id) REFERENCES penalties(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: computers_history_computer_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY computers_history
    ADD CONSTRAINT computers_history_computer_id_fkey FOREIGN KEY (computer_id) REFERENCES computers(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: computers_history_location_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY computers_history
    ADD CONSTRAINT computers_history_location_id_fkey FOREIGN KEY (location_id) REFERENCES locations(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: computers_history_modified_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY computers_history
    ADD CONSTRAINT computers_history_modified_by_fkey FOREIGN KEY (modified_by) REFERENCES admins(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: computers_history_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY computers_history
    ADD CONSTRAINT computers_history_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: computers_ipv4_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY computers
    ADD CONSTRAINT computers_ipv4_fkey FOREIGN KEY (ipv4) REFERENCES ipv4s(ip) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: computers_location_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY computers
    ADD CONSTRAINT computers_location_id_fkey FOREIGN KEY (location_id) REFERENCES locations(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: computers_modified_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY computers
    ADD CONSTRAINT computers_modified_by_fkey FOREIGN KEY (modified_by) REFERENCES admins(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: computers_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY computers
    ADD CONSTRAINT computers_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: ipv4s_dormitory_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY ipv4s
    ADD CONSTRAINT ipv4s_dormitory_id_fkey FOREIGN KEY (dormitory_id) REFERENCES dormitories(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: locations_dormitory_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY locations
    ADD CONSTRAINT locations_dormitory_id_fkey FOREIGN KEY (dormitory_id) REFERENCES dormitories(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: penalties_amnesty_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY penalties
    ADD CONSTRAINT penalties_amnesty_by_fkey FOREIGN KEY (amnesty_by) REFERENCES admins(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: penalties_created_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY penalties
    ADD CONSTRAINT penalties_created_by_fkey FOREIGN KEY (created_by) REFERENCES admins(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: penalties_modified_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY penalties
    ADD CONSTRAINT penalties_modified_by_fkey FOREIGN KEY (modified_by) REFERENCES admins(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: penalties_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY penalties
    ADD CONSTRAINT penalties_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: services_history_modified_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY services_history
    ADD CONSTRAINT services_history_modified_by_fkey FOREIGN KEY (modified_by) REFERENCES admins(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: services_history_serv_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY services_history
    ADD CONSTRAINT services_history_serv_id_fkey FOREIGN KEY (serv_id) REFERENCES services(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: services_history_serv_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY services_history
    ADD CONSTRAINT services_history_serv_type_id_fkey FOREIGN KEY (serv_type_id) REFERENCES services_type(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: services_history_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY services_history
    ADD CONSTRAINT services_history_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: services_serv_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY services
    ADD CONSTRAINT services_serv_type_id_fkey FOREIGN KEY (serv_type_id) REFERENCES services_type(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: services_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY services
    ADD CONSTRAINT services_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_faculty_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_faculty_id_fkey FOREIGN KEY (faculty_id) REFERENCES faculties(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_history_faculty_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY users_history
    ADD CONSTRAINT users_history_faculty_id_fkey FOREIGN KEY (faculty_id) REFERENCES faculties(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_history_location_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY users_history
    ADD CONSTRAINT users_history_location_id_fkey FOREIGN KEY (location_id) REFERENCES locations(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_history_modified_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY users_history
    ADD CONSTRAINT users_history_modified_by_fkey FOREIGN KEY (modified_by) REFERENCES admins(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_history_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY users_history
    ADD CONSTRAINT users_history_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_location_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_location_id_fkey FOREIGN KEY (location_id) REFERENCES locations(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_modified_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_modified_by_fkey FOREIGN KEY (modified_by) REFERENCES admins(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_tokens_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY users_tokens
    ADD CONSTRAINT users_tokens_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

