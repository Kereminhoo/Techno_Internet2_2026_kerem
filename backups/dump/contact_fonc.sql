CREATE TABLE contact (
    id_msg SERIAL PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(100),
    sujet VARCHAR(200),
    message TEXT,
    date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INTEGER 
);

CREATE OR REPLACE FUNCTION ajout_contact(p_nom VARCHAR, p_email VARCHAR, p_sujet VARCHAR, p_message TEXT, p_user_id INTEGER)
RETURNS BOOLEAN AS $$
BEGIN
    INSERT INTO contact (nom, email, sujet, message, user_id)
    VALUES (p_nom, p_email, p_sujet, p_message, p_user_id);
    RETURN TRUE;
END;
$$ LANGUAGE plpgsql;