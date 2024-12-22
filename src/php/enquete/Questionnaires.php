<?php

class Questionnaires
{
    private int $idQuestionnaire;
    private string $titre;
    private string $ordre;

    /**
     * @param int $idQuestionnaire
     * @param string $titre
     * @param string $ordre
     */
    public function __construct(int $idQuestionnaire, string $titre, string $ordre)
    {
        $this->idQuestionnaire = $idQuestionnaire;
        $this->titre = $titre;
        $this->ordre = $ordre;
    }
    public function getIdQuestionnaire(): int
    {
        return $this->idQuestionnaire;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getOrdre(): string
    {
        return $this->ordre;
    }

}