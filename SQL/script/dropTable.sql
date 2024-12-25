
-- Supprimer les connexions des utilisateurs
DROP TABLE Connexions;

-- Supprimer les réponses des utilisateurs
DROP TABLE Réponses;

-- Supprimer les statistiques
DROP TABLE Statistiques;


-- Supprimer les dons
DROP TABLE Donateurs;

-- Supprimer les questions
DROP TABLE Questions;

-- Supprimer les questionnaires
DROP TABLE Questionnaires;

-- Supprimer les utilisateurs
DROP TABLE Utilisateurs;

DROP TABLE ville;


-- Réinitialiser les compteurs AUTO_INCREMENT
ALTER TABLE Utilisateurs AUTO_INCREMENT = 1;
ALTER TABLE Donateurs AUTO_INCREMENT = 1;
ALTER TABLE Questionnaires AUTO_INCREMENT = 1;
ALTER TABLE Questions AUTO_INCREMENT = 1;
ALTER TABLE Réponses AUTO_INCREMENT = 1;
ALTER TABLE Statistiques AUTO_INCREMENT = 1;
ALTER TABLE Connexions AUTO_INCREMENT = 1;
ALTER TABLE ville AUTO_INCREMENT = 1;

