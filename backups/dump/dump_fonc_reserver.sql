CREATE OR REPLACE FUNCTION ajout_reservation(p_voiture_id INT, p_user_id INT, p_type_res VARCHAR) 
RETURNS INT AS $$
DECLARE
    retour INT;
BEGIN
    
    INSERT INTO reserver (voiture_id, user_id, type_res, status_paiement) 
    VALUES (p_voiture_id, p_user_id, p_type_res, 'En attente')
    RETURNING id_res INTO retour;

    
    UPDATE voiture 
    SET status = FALSE 
    WHERE voiture_id = p_voiture_id;

    
    RETURN retour;
END;
$$ LANGUAGE plpgsql;