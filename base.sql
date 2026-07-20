CREATE DATABASE site_communautaire;

USE site_communautaire;

-- Tables
CREATE TABLE membre(
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    numero_etu INT,
    image_profil VARCHAR(100)
);

CREATE TABLE categorie(
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100)
);

CREATE TABLE produit(
    id_produit INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    id_categorie INT,
    prix_reference INT
);

CREATE TABLE produit_membre(
    id_produit_membre INT AUTO_INCREMENT PRIMARY KEY,
    id_produit INT,
    id_membre INT, 
    prix_vente INT,
    quantite_dispo INT, 
    date_dispo DATE
);

CREATE TABLE vente(
    id_vente INT AUTO_INCREMENT PRIMARY KEY,
    date DATE, 
    heure TIME, 
    id_produit_membre INT, 
    quantite INT
);

-- Table categorie
INSERT INTO categorie ( nom_categorie) VALUES
('plat'),
('boisson'),
('snack'),
('dessert');

-- Table membre
INSERT INTO membre (nom , numero_etu) VALUES
('Martin', 4029),
('Jean', 4020),
('Dupont', 4013),
('Marie', 4134),
('Durand', 3452),
('Paul', 4665),
('Morel', 4807),
('Sophie', 3959),
('Legrand', 3014),
('Luc', 3171);

-- Table produit
INSERT INTO produit (nom , id_categorie, prix_reference) VALUES
('Burger Cheese', 1, 3500),
('Pizza Margherita', 1, 2000),
('Pâtes Carbonara', 1, 2500),
('Poulet Rôti & Frites', 1, 3000),
('Coca-Cola Mini', 2, 1500),
('Eau Minérale 50cl', 2, 1000),
('Jus d''Orange Pressé', 2, 2500),
('Thé Glacé Pêche', 2, 2000),
('Frites Maison', 3, 2000),
('Chips Nature', 3, 1000),
('Nuggets de Poulet (x6)', 3, 3500),
('Tiramisu Café', 4, 3000),
('Tarte aux Pommes', 4, 2500),
('Mousse au Chocolat', 4, 2000),
('Boule de Glace Vanille', 4, 1500);

-- Table produit_membre
INSERT INTO produit_membre (id_produit_membre, id_produit, id_membre, prix_vente, quantite_dispo, date_dispo) VALUES
(1, 1, 1, 3500, 10, '2026-07-20'),
(2, 2, 1, 2000, 15, '2026-07-20'),
(3, 3, 2, 2500, 8, '2026-07-20'),
(4, 4, 2, 3000, 12, '2026-07-20'),
(5, 5, 5, 2500, 10, '2026-07-20'),
(6, 6, 3, 1500, 20, '2026-07-20'),
(7, 7, 3, 1000, 30, '2026-07-20'),
(8, 8, 5, 2500, 15, '2026-07-20'),
(9, 9, 4, 2000, 12, '2026-07-20'),
(10, 10, 4, 1000, 25, '2026-07-20'),
(11, 11, 7, 2000, 10, '2026-07-20'),
(12, 12, 7, 3000, 15, '2026-07-20'),
(13, 13, 6, 3500, 8, '2026-07-20'),
(14, 14, 6, 2500, 10, '2026-07-20'),
(15, 15, 8, 2000, 14, '2026-07-20'),
(16, 8, 3, 2500, 15, '2026-07-20'),
(17, 9, 10, 2000, 12, '2026-07-20'),
(18, 10, 9, 1000, 25, '2026-07-20'),
(19, 11, 10, 2000, 10, '2026-07-20'),
(20, 12, 9, 1000, 5, '2026-07-20');

--  Table vente
INSERT INTO vente (id_vente, date , heure , id_produit_membre, quantite) VALUES
(1, '2026-07-20', '08:15:00', 1, 1),
(2, '2026-07-20', '08:30:00', 2, 2),
(3, '2026-07-20', '09:00:00', 3, 1),
(4, '2026-07-20', '09:45:00', 4, 3),
(5, '2026-07-20', '10:10:00', 5, 1),
(6, '2026-07-20', '10:30:00', 6, 2),
(7, '2026-07-20', '11:15:00', 7, 1),
(8, '2026-07-20', '11:50:00', 8, 4),
(9, '2026-07-20', '12:00:00', 9, 1),
(10, '2026-07-20', '12:15:00', 10, 2),
(11, '2026-07-20', '12:30:00', 11, 1),
(12, '2026-07-20', '12:45:00', 12, 2),
(13, '2026-07-20', '13:10:00', 13, 1),
(14, '2026-07-20', '13:30:00', 14, 3),
(15, '2026-07-20', '14:00:00', 15, 1),
(16, '2026-07-20', '14:30:00', 16, 2),
(17, '2026-07-20', '15:00:00', 17, 1),
(18, '2026-07-20', '15:45:00', 18, 2),
(19, '2026-07-20', '16:15:00', 19, 1),
(20, '2026-07-20', '16:40:00', 20, 5);

ALTER TABLE produit ADD imagePlat VARCHAR(100);