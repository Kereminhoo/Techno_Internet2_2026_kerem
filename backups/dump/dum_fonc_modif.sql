CREATE OR REPLACE FUNCTION modifier_voiture(
    p_voiture_id INT, p_marque VARCHAR, p_modele VARCHAR, 
    p_annee INT, p_prix DECIMAL, p_km INT, 
    p_description TEXT, p_image VARCHAR, p_status BOOLEAN, p_cat_id INT
) 
RETURNS BOOLEAN AS $$
BEGIN
    UPDATE voiture 
    SET marque = p_marque, modele = p_modele, annee = p_annee, 
        prix = p_prix, km = p_km, description = p_description, 
        image = p_image, status = p_status, cat_id = p_cat_id
    WHERE voiture_id = p_voiture_id;
    RETURN TRUE;
END;
$$ LANGUAGE plpgsql;