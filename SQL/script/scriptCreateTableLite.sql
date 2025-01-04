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
                          id_option INTEGER NOT NULL,
                          id_question INTEGER NOT NULL,
                          emailUser TEXT NOT NULL,
                          FOREIGN KEY (id_question) REFERENCES Questions(id_question),
                          FOREIGN KEY (emailUser) REFERENCES Utilisateurs(email),
                          FOREIGN KEY (id_option) REFERENCES Options(id_option),
                          UNIQUE (id_question, emailUser)
);

CREATE TABLE Connexions (
                            id_connexion INTEGER PRIMARY KEY AUTOINCREMENT,
                            date_connexion_ DATE NOT NULL,
                            statut_connexion INTEGER, -- BOOLEAN remplacé par INTEGER
                            id_utilisateur INTEGER NOT NULL,
                            FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(email)
);

CREATE TABLE Options (
                         id_option INTEGER PRIMARY KEY AUTOINCREMENT,
                         id_question INTEGER,
                         option_text TEXT,
                         FOREIGN KEY (id_question) REFERENCES Questions(id_question)
);

CREATE TABLE Admin (
                       email TEXT NOT NULL UNIQUE PRIMARY KEY,
                       password TEXT NOT NULL
);

-- Trigger qui va vérifier si ma réponse existe déjà alors je l'update sinon je l'ajoute (Pour le dashboard)
CREATE TRIGGER Before_insert_reponse
    BEFORE INSERT ON Reponses
    FOR EACH ROW
BEGIN
    -- Vérifier si une mise à jour est nécessaire
    UPDATE Reponses
    SET id_option = NEW.id_option
    WHERE id_question = NEW.id_question
      AND emailUser = NEW.emailUser;

    -- Insérer uniquement si aucune ligne n'a été mise à jour
    INSERT INTO Reponses (id_option, id_question, emailUser)
    SELECT NEW.id_option, NEW.id_question, NEW.emailUser
    WHERE NOT EXISTS (
        SELECT 1
        FROM Reponses
        WHERE id_question = NEW.id_question
          AND emailUser = NEW.emailUser
    );
END;