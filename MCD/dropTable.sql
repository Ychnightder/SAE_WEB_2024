-- Supprimer les affichages des indicateurs
DELETE FROM Affichages_Indicateurs;

-- Supprimer les connexions des utilisateurs
DELETE FROM Connexions;

-- Supprimer les réponses des utilisateurs
DELETE FROM Réponses;

-- Supprimer les statistiques
DELETE FROM Statistiques;

-- Supprimer les administrateurs
DELETE FROM Admins;

-- Supprimer les dons
DELETE FROM Donateurs;

-- Supprimer les questions
DELETE FROM Questions;

-- Supprimer les questionnaires
DELETE FROM Questionnaires;

-- Supprimer les utilisateurs
DELETE FROM Utilisateurs;




-- Réinitialiser les compteurs AUTO_INCREMENT
ALTER TABLE Utilisateurs AUTO_INCREMENT = 1;
ALTER TABLE Donnateurs AUTO_INCREMENT = 1;
ALTER TABLE Questionnaires AUTO_INCREMENT = 1;
ALTER TABLE Questions AUTO_INCREMENT = 1;
ALTER TABLE Réponses AUTO_INCREMENT = 1;
ALTER TABLE Statistiques AUTO_INCREMENT = 1;
ALTER TABLE Admins AUTO_INCREMENT = 1;
ALTER TABLE Connexions AUTO_INCREMENT = 1;
ALTER TABLE Affichages_Indicateurs AUTO_INCREMENT = 1;
