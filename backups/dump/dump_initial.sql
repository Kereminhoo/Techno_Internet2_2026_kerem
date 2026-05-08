CREATE TABLE categorie (
    cat_id SERIAL PRIMARY KEY,
    nom_cat VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE utilisateur (
    user_id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'client'
);

CREATE TABLE voiture (
    voiture_id SERIAL PRIMARY KEY,
    marque VARCHAR(50) NOT NULL,
    modele VARCHAR(50) NOT NULL,
    annee INT,
    prix DECIMAL(15,2) NOT NULL,
    km INT,
    description TEXT, 
    image VARCHAR(100),
    status BOOLEAN DEFAULT TRUE, 
    cat_id INT REFERENCES categorie(cat_id)
);


CREATE TABLE reserver (
    id_res SERIAL PRIMARY KEY,
    voiture_id INT REFERENCES voiture(voiture_id),
    user_id INT REFERENCES utilisateur(user_id),
    date_res TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    type_res VARCHAR(50), 
    status_paiement VARCHAR(50)
);