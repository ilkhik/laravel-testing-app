<?php

namespace App\ToClient;

use App\Models\Test;
use App\Models\Question;

class TestToClient
{
    public $id;
    public $title;
    public $questions;
    
    public function __construct(Test $test)
    {
        $this->id = $test->id;
        $this->title = $test->title;
        
        $this->questions = [];
        
        $questionsFromDb = Question::where('test_id', $test->id)->get();
        
        foreach ($questionsFromDb as $question) {
            $this->questions[] = new QuestionToClient($question);
        }
        shuffle($this->questions);
    }
}
