<?php

use Questionnaires;

class Question
{
    private int $IdQuestion ;
    private  string $questionText ;
    private  Questionnaires $questionnaires ;
    private string $type;

    /**
     * @param int $IdQuestion
     * @param string $questionText
     * @param Questionnaires $questionnaires
     * @param string $type
     */
    public function __construct(int $IdQuestion, string $questionText, Questionnaires $questionnaires, string $type)
    {
        $this->IdQuestion = $IdQuestion;
        $this->questionText = $questionText;
        $this->questionnaires = $questionnaires;
        $this->type = $type;
    }


    public function getQuestionText(): string
    {
        return $this->questionText;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getIdQuestion(): int
    {
        return $this->IdQuestion;
    }
}