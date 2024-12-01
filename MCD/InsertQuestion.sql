-- Questionnaire 1 (Qui a répondu à l’enquête ?)
INSERT INTO questions (texte_question_, type_question, id_questionnaire) VALUES
                                                                             ('Quel est votre âge ?', 'select', 1),
                                                                             ('Quel est votre sexe ?', 'button', 1),
                                                                             ('Quel est votre lien avec l\'autisme ?', 'button', 1),
                                                                             ('Depuis combien de temps êtes-vous adhérent(e) de l\'association ?', 'button', 1),
                                                                             ('Dans quelle région habitez-vous ?', 'select', 1);

-- Questionnaire 2 (Lieu de vie)
INSERT INTO questions (texte_question_, type_question, id_questionnaire) VALUES
                                                                             ('Votre lieu de vie est-il adapté à vos besoins spécifiques ou à ceux de votre proche autiste ?', 'button', 2),
                                                                             ('Avez-vous un accès facile aux structures spécialisées (hôpital, centre de diagnostic, etc.) ?', 'button', 2),
                                                                             ('Combien de temps devez-vous parcourir pour accéder à une structure spécialisée ?', 'select', 2);

-- Questionnaire 3 (Insertion professionnelle et sociale)
INSERT INTO questions (texte_question_, type_question, id_questionnaire) VALUES
                                                                             ('Avez-vous des activités scolaires ou professionnelles ?', 'select', 3),
                                                                             ('Recevez-vous un accompagnement professionnel pour l’insertion sociale ?', 'button', 3);

-- Questionnaire 4 (Qualité de vie)
INSERT INTO questions (texte_question_, type_question, id_questionnaire) VALUES
                                                                             ('Comment évaluez-vous votre qualité de vie globale ?', 'select', 4),
                                                                             ('Quelles sont vos principales sources de stress ?', 'button', 4),
                                                                             ('Sur une échelle de 1 à 5, dans quelle mesure pensez-vous que l\'association contribue à améliorer votre qualité de vie ?', 'button', 4);

-- Questionnaire 5 (Besoins de soutien)
INSERT INTO questions (texte_question_, type_question, id_questionnaire) VALUES
                                                                             ('De quel type de soutien avez-vous principalement besoin ?', 'button', 5),
                                                                             ('Avez-vous besoin de formations spécifiques (ex. : gérer les crises, comprendre l\'autisme, etc.) ?', 'button', 5),
                                                                             ('Pensez-vous que l\'association devrait élargir ses services ?', 'button-textarea', 5),
                                                                             ('Avez-vous des suggestions pour améliorer le soutien proposé par l\'association ?', 'textarea', 5);

-- Questionnaire 6 (Questions libres)
INSERT INTO questions (texte_question_, type_question, id_questionnaire) VALUES
                                                                             ('Quels sont les principaux défis auxquels vous êtes confronté(e) en tant qu’adhérent(e) ou proche d’une personne autiste ?', 'textarea', 6),
                                                                             ('Que pensez-vous des actions et services actuels de l\'association ?', 'textarea', 6),
                                                                             ('Recommanderiez-vous l\'association à d\'autres personnes concernées par l\'autisme ?', 'button', 6);

-- Questionnaire 7 (Conclusion)
INSERT INTO questions (texte_question_, type_question, id_questionnaire) VALUES
    ('Souhaitez-vous être recontacté(e) par l\'association pour discuter de vos réponses ?', 'button', 7);
