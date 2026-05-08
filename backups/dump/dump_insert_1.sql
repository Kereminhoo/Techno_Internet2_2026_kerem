INSERT INTO categorie (nom_cat) VALUES 
('Berline'), 
('Break Sportif'), 
('SUV');

INSERT INTO voiture (marque, modele, annee, prix, km, description, image, status, cat_id) 
VALUES 
('BMW', 'Série 3', 2021, 45000.00, 35000, 'Magnifique berline avec finitions sport.', 'https://via.placeholder.com/300x150/444444/FFFFFF?text=Photo+BMW', TRUE, 1),

('Audi', 'RS6', 2022, 80000.00, 15000, 'Break ultra puissant, idéal pour les passionnés.', 'https://via.placeholder.com/300x150/444444/FFFFFF?text=Photo+Audi', TRUE, 2),

('Mercedes', 'GLC', 2023, 65000.00, 10000, 'SUV luxueux, toutes options incluses.', 'https://via.placeholder.com/300x150/444444/FFFFFF?text=Photo+Mercedes', TRUE, 3);