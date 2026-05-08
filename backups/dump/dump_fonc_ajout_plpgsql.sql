CREATE OR REPLACE FUNCTION ajout_voiture(
    p_marque VARCHAR, 
    p_modele VARCHAR, 
    p_annee INT, 
    p_prix DECIMAL, 
    p_km INT, 
    p_description TEXT, 
    p_image VARCHAR, 
    p_status BOOLEAN, 
    p_cat_id INT
) 
RETURNS INT AS $$
DECLARE
    retour INT;
BEGIN
    
    INSERT INTO voiture (marque, modele, annee, prix, km, description, image, status, cat_id) 
    VALUES (p_marque, p_modele, p_annee, p_prix, p_km, p_description, p_image, p_status, p_cat_id)
    RETURNING voiture_id INTO retour; 

    
    RETURN retour;
END;
$$ LANGUAGE plpgsql;