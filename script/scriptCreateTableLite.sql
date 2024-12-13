CREATE TABLE Questionnaires (
                                id_questionnaire INTEGER PRIMARY KEY AUTOINCREMENT,
                                titre_ TEXT NOT NULL,
                                date_creation DATE NOT NULL,
                                est__Actif INTEGER NOT NULL -- BOOLEAN est remplacé par INTEGER (0 ou 1)
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

CREATE TABLE pays (
                      IdPays INTEGER PRIMARY KEY AUTOINCREMENT,
                      nom TEXT NOT NULL
);

CREATE TABLE ville (
                       idVille INTEGER PRIMARY KEY AUTOINCREMENT,
                       nomVille TEXT NOT NULL,
                       codePostal INTEGER NOT NULL
);

CREATE TABLE Utilisateurs (
                              id_utilisateur INTEGER PRIMARY KEY AUTOINCREMENT,
                              nom TEXT NOT NULL,
                              prenom TEXT NOT NULL,
                              email TEXT NOT NULL UNIQUE,
                              mot_de_passe TEXT NOT NULL,
                              adresse TEXT,
                              telephone TEXT,
                              est_adherent INTEGER, -- BOOLEAN remplacé par INTEGER
                              date_inscription DATE,
                              est_admin INTEGER NOT NULL, -- BOOLEAN remplacé par INTEGER
                              mot_de_passe_admin TEXT,
                              IdPays INTEGER NOT NULL,
                              idVille INTEGER NOT NULL,
                              FOREIGN KEY (IdPays) REFERENCES pays(IdPays),
                              FOREIGN KEY (idVille) REFERENCES ville(idVille)
);

CREATE TABLE Donateurs (
                           id_donnateur INTEGER PRIMARY KEY AUTOINCREMENT,
                           date_don DATE NOT NULL,
                           methode_paiement TEXT NOT NULL,
                           montant REAL, -- DECIMAL remplacé par REAL
                           id_utilisateur INTEGER NOT NULL,
                           FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);

CREATE TABLE Réponses (
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

CREATE TABLE options (
                         id_option INTEGER PRIMARY KEY AUTOINCREMENT,
                         id_question INTEGER,
                         option_text TEXT,
                         FOREIGN KEY (id_question) REFERENCES Questions(id_question)
);
