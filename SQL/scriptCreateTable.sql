CREATE TABLE Questionnaires(
                               id_questionnaire INT AUTO_INCREMENT,
                               titre_ VARCHAR(255)  NOT NULL,
                               date_creation DATE NOT NULL,
                               est__Actif BOOLEAN NOT NULL,
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

CREATE TABLE Statistiques(
                             id_statistique INT AUTO_INCREMENT,
                             valeur VARCHAR(50) ,
                             id_questionnaire INT NOT NULL,
                             PRIMARY KEY(id_statistique),
                             FOREIGN KEY(id_questionnaire) REFERENCES Questionnaires(id_questionnaire)
);

CREATE TABLE pays(
                     IdPays INT AUTO_INCREMENT,
                     nom VARCHAR(50)  NOT NULL,
                     PRIMARY KEY(IdPays)
);

CREATE TABLE ville(
                      idVille INT AUTO_INCREMENT,
                      nomVille VARCHAR(50)  NOT NULL,
                      codePostal INT NOT NULL,
                      PRIMARY KEY(idVille)
);

CREATE TABLE Utilisateurs(
                             id_utilisateur INT AUTO_INCREMENT,
                             nom VARCHAR(50)  NOT NULL,
                             prenom VARCHAR(50)  NOT NULL,
                             email VARCHAR(255)  NOT NULL,
                             mot_de_passe VARCHAR(255)  NOT NULL,
                             adresse VARCHAR(255) ,
                             telephone VARCHAR(50) ,
                             est_adherent BOOLEAN,
                             date_inscription DATE,
                             est_admin BOOLEAN NOT NULL,
                             mot_de_passe_admin varchar(255) NULL,
                             IdPays INT NOT NULL,
                             idVille INT NOT NULL,
                             PRIMARY KEY(id_utilisateur),
                             UNIQUE(email),
                             FOREIGN KEY(IdPays) REFERENCES pays(IdPays),
                             FOREIGN KEY(idVille) REFERENCES ville(idVille)
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

CREATE TABLE Réponses(
                         id_reponse_ INT AUTO_INCREMENT,
                         reponse VARCHAR(225)  NOT NULL,
                         id_question INT NOT NULL,
                         id_utilisateur INT NOT NULL,
                         PRIMARY KEY(id_reponse_),
                         FOREIGN KEY(id_question) REFERENCES Questions(id_question),
                         FOREIGN KEY(id_utilisateur) REFERENCES Utilisateurs(id_utilisateur),
                         UNIQUE (id_utilisateur,id_reponse_)
);

CREATE TABLE Connexions(
                           id_connexion INT AUTO_INCREMENT,
                           date_connexion_ DATE NOT NULL,
                           statut_connexion BOOLEAN,
                           id_utilisateur INT NOT NULL,
                           PRIMARY KEY(id_connexion),
                           FOREIGN KEY(id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);
create table options
(
    id_option   int auto_increment primary key,
    id_question int          null,
    option_text varchar(255) null,
    foreign key (id_question) references questions (id_question)
);