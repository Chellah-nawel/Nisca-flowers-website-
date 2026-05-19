-- ============================================================
--  À exécuter dans phpMyAdmin sur la base flower_shop
--  après avoir importé WEB.sql
--  Ajoute la table messages pour le formulaire de contact
-- ============================================================

USE flower_shop;

CREATE TABLE IF NOT EXISTS messages (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    first_name  VARCHAR(100) NOT NULL,
    family_name VARCHAR(100) NOT NULL,
    email       VARCHAR(150) NOT NULL,
    message     TEXT NOT NULL,
    sent_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
