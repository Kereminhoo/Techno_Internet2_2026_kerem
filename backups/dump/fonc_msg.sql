CREATE OR REPLACE FUNCTION liste_messages()
RETURNS TABLE(id_msg integer, nom varchar, email varchar, sujet varchar, message text, date_envoi timestamp, user_id integer) AS $$
BEGIN
    RETURN QUERY SELECT * FROM contact ORDER BY contact.date_envoi DESC;
END;
$$ LANGUAGE plpgsql;