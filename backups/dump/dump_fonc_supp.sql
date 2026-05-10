CREATE OR REPLACE FUNCTION supprimer_voiture(p_voiture_id INT) 
RETURNS BOOLEAN AS $$
BEGIN
    DELETE FROM reserver WHERE voiture_id = p_voiture_id;
    DELETE FROM voiture WHERE voiture_id = p_voiture_id;
    RETURN TRUE;
END;
$$ LANGUAGE plpgsql;