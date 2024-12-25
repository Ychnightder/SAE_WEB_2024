CREATE TABLE Questionnaires (
                                id_questionnaire INTEGER PRIMARY KEY AUTOINCREMENT,
                                titre_ TEXT NOT NULL,
                                date_creation DATE NOT NULL,
                                est__Actif INTEGER NOT NULL, -- BOOLEAN est remplacé par INTEGER (0 ou 1)
                                ordre INTEGER NOT NULL
);

CREATE TABLE Questions (
                           id_question INTEGER PRIMARY KEY AUTOINCREMENT,
                           texte_question_ TEXT NOT NULL,
                           type_question TEXT NOT NULL,
                           id_questionnaire INTEGER NOT NULL,
                           FOREIGN KEY (id_questionnaire) REFERENCES Questionnaires(id_questionnaire)
);

CREATE TABLE Statistiques (
                              id_statistique INTEGER PRIMARY KEY AUTOINCREMENT,
                              valeur TEXT,
                              id_questionnaire INTEGER NOT NULL,
                              FOREIGN KEY (id_questionnaire) REFERENCES Questionnaires(id_questionnaire)
);


CREATE TABLE Ville (
                       idVille INTEGER PRIMARY KEY AUTOINCREMENT,
                       nomVille TEXT NOT NULL,
                       codePostal INTEGER NOT NULL
);

CREATE TABLE Utilisateurs (
                              email TEXT NOT NULL UNIQUE PRIMARY KEY,
                              nom TEXT NOT NULL,
                              prenom TEXT NOT NULL,
                              password TEXT NOT NULL,
                              adresse TEXT,
                              telephone TEXT,
                              est_adherent INTEGER, -- BOOLEAN remplacé par INTEGER
                              date_inscription DATE,
                              idVille INTEGER NOT NULL,
                              FOREIGN KEY (idVille) REFERENCES ville(idVille)
);

CREATE TABLE Donateurs (
                           id_donnateur INTEGER PRIMARY KEY AUTOINCREMENT,
                           date_don DATE NOT NULL,
                           methode_paiement TEXT NOT NULL,
                           montant REAL, -- DECIMAL remplacé par REAL
                           email_utilisateur INTEGER NOT NULL,
                           FOREIGN KEY (email_utilisateur) REFERENCES Utilisateurs(email)
);

CREATE TABLE Reponses (
                          id_reponse_ INTEGER PRIMARY KEY AUTOINCREMENT,
                          reponse TEXT NOT NULL,
                          id_question INTEGER NOT NULL,
                          id_utilisateur INTEGER NOT NULL,
                          FOREIGN KEY (id_question) REFERENCES Questions(id_question),
                          FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur),
                          UNIQUE (id_utilisateur, id_reponse_)
);

CREATE TABLE Connexions (
                            id_connexion INTEGER PRIMARY KEY AUTOINCREMENT,
                            date_connexion_ DATE NOT NULL,
                            statut_connexion INTEGER, -- BOOLEAN remplacé par INTEGER
                            id_utilisateur INTEGER NOT NULL,
                            FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);

CREATE TABLE Options (
                         id_option INTEGER PRIMARY KEY AUTOINCREMENT,
                         id_question INTEGER,
                         option_text TEXT,
                         FOREIGN KEY (id_question) REFERENCES Questions(id_question)
);
