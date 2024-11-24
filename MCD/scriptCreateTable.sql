CREATE TABLE Utilisateurs(
                             id_utilisateur INT AUTO_INCREMENT,
                             nom VARCHAR(50)  NOT NULL,
                             prenom VARCHAR(50)  NOT NULL,
                             email VARCHAR(255)  NOT NULL,
                             mot_de_passe VARCHAR(255)  NOT NULL,
                             adresse VARCHAR(255) ,
                             code_postal VARCHAR(10) ,
                             ville VARCHAR(255) ,
                             telephone VARCHAR(50) ,
                             est_adherent BOOLEAN,
                             date_inscription DATE,
                             PRIMARY KEY(id_utilisateur),
                             UNIQUE(email)
);

CREATE TABLE Donateurs(
                          id_donnateur INT AUTO_INCREMENT,
                          date_don DATE NOT NULL,
                          methode_paiement VARCHAR(50)  NOT NULL,
                          montant DECIMAL(19,4),
                          id_utilisateur INT NOT NULL,
                          PRIMARY KEY(id_donnateur),
                          FOREIGN KEY(id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);

CREATE TABLE Questionnaires(
                               id_questionnaire INT AUTO_INCREMENT,
                               titre_ VARCHAR(255)  NOT NULL,
                               date_creation DATE NOT NULL,
                               version INT NOT NULL,
                               est_Actif BOOLEAN,
                               PRIMARY KEY(id_questionnaire)
);

CREATE TABLE Questions(
                          id_question INT AUTO_INCREMENT,
                          texte_question_ VARCHAR(255)  NOT NULL,
                          type_question VARCHAR(50)  NOT NULL,
                          id_questionnaire INT NOT NULL,
                          PRIMARY KEY(id_question),
                          FOREIGN KEY(id_questionnaire) REFERENCES Questionnaires(id_questionnaire)
);

CREATE TABLE Réponses(
                         id_reponse_ INT AUTO_INCREMENT,
                         reponse VARCHAR(225) ,
                         id_question INT NOT NULL,
                         id_utilisateur INT NOT NULL,
                         PRIMARY KEY(id_reponse_),
                         FOREIGN KEY(id_question) REFERENCES Questions(id_question),
                         FOREIGN KEY(id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);

CREATE TABLE Statistiques(
                             id_statistique INT AUTO_INCREMENT,
                             type_statistique__ VARCHAR(50) ,
                             valeur VARCHAR(50) ,
                             id_questionnaire INT NOT NULL,
                             PRIMARY KEY(id_statistique),
                             FOREIGN KEY(id_questionnaire) REFERENCES Questionnaires(id_questionnaire)
);

CREATE TABLE Admins(
                       id_admin INT AUTO_INCREMENT,
                        login INT ,
                        password VARCHAR(250),
                       role VARCHAR(50)  NOT NULL,
                       id_utilisateur INT NOT NULL,
                       PRIMARY KEY(id_admin),
                       FOREIGN KEY(id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);

CREATE TABLE Connexions(
                           id_connexion INT AUTO_INCREMENT,
                           date_connexion_ DATE NOT NULL,
                           statut_connexion BOOLEAN,
                           id_utilisateur INT NOT NULL,
                           PRIMARY KEY(id_connexion),
                           FOREIGN KEY(id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);

CREATE TABLE Affichages_Indicateurs(
                                       id_affichage INT AUTO_INCREMENT,
                                       date_consultation DATE,
                                       id_admin INT NOT NULL,
                                       id_statistique INT NOT NULL,
                                       PRIMARY KEY(id_affichage),
                                       FOREIGN KEY(id_admin) REFERENCES Admins(id_admin),
                                       FOREIGN KEY(id_statistique) REFERENCES Statistiques(id_statistique)
);
