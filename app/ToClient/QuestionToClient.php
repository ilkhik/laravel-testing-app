<?php

namespace App\ToClient;

use App\Models\Question;
use App\Models\Answer;

class QuestionToClient
{
    public $number;
    public $questionKind;
    public $text;
    public $answers;
    
    public function __construct(Question $question)
    {
        $this->number = $question->number;
        $this->questionKind = $question->question_kind;
        $this->text = $question->text;
        
        $this->answers = [];
        
        $answersFromDb = Answer::where([
            ['test_id', $question->test_id],
            ['question_number', $question->number]
        ])->get();
        
        foreach ($answersFromDb as $answer) {
            $this->answers[] = new AnswerToClient($answer);
        }
        shuffle($this->answers);
    }
}
