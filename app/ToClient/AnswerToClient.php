<?php

namespace App\ToClient;

use App\Models\Answer;

class AnswerToClient
{
    public $number;
    public $text;
    
    public function __construct(Answer $answer)
    {
        $this->number = $answer->number;
        $this->text = $answer->text;
    }
}
