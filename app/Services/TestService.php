<?php

namespace App\Services;

use App\Models\Test;
use App\ToClient\TestToClient;
use App\Models\TakedTest;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;

class TestService
{

    public function getAllTests()
    {
        $tests = Test::all();

        $testsToClient = [];

        foreach ($tests as $test) {
            $testsToClient[] = new TestToClient($test);
        }

        return $testsToClient;
    }

    public function getById($id)
    {
        return new TestToClient(Test::find($id));
    }

    public function getTakedTest($testId, $userId)
    {
        return TakedTest::where([
                    ['test_id', $testId],
                    ['user_id', $userId]
                ])->first();
    }

    public function createNewTest($test)
    {
        $newTest = new Test();

        $newTest->title = $test->title;
        $newTest->max_scores = $this->computeMaxScores($test);
        $newTest->save();

        $questionNumber = 1;
        foreach ($test->questions as $question) {
            $newQuestion = new Question();
            $newQuestion->number = $questionNumber;

            $newQuestion->test_id = $newTest->id;
            $newQuestion->question_kind = $question->questionKind;
            $newQuestion->text = $question->text;
            $answerNumber = 1;
            foreach ($question->answers as $answer) {
                $newAnswer = new Answer();
                $newAnswer->number = $answerNumber++;
                $newAnswer->test_id = $newTest->id;
                $newAnswer->question_number = $questionNumber;
                $newAnswer->is_correct = $answer->isCorrect;
                $newAnswer->text = $answer->text;

                $newAnswer->save();
            }

            $newQuestion->save();
            $questionNumber++;
        }

        $newTest->save();
    }

    public function takeTest($takedTest, $testId, $userId)
    {
        $test = Test::find($testId);
        $score = 0;
        
        $findTakedTestQuestion = function ($questions, $number) {
            foreach ($questions as $question) {
                if (intval($question->number) === $number) {
                    return $question;
                }
            }
            return null;
        };

        foreach ($test->questions as $question) {
            $takedTestQuestion = $findTakedTestQuestion($takedTest->questions, $question->number);
            foreach (Answer::where([['test_id', $testId], ['question_number', $question->number]])->get() as $answer) {
                if ($answer->is_correct && (array_search($answer->number, $takedTestQuestion->answers) ===  false) ||
                        (!$answer->is_correct) && array_search($answer->number, $takedTestQuestion->answers) !== false ) {
                    continue 2;
                }
            }
            $score += $question->question_kind === 'SINGLE_CHOICE' ? 1 : 3;
        }
        
        $newTakedTest = new TakedTest();
        $newTakedTest->test_id = $testId;
        $newTakedTest->user_id = $userId;
        $newTakedTest->score = $score;
        $newTakedTest->save();
        
        $user = User::find($userId);
        $user->test_passed_number++;
        $user->score_sum += $score;
        $user->score_max_sum += $test->max_scores;
        $user->save();
    }

    private function checkAnswers()
    {
        
    }

    private function computeMaxScores($test)
    {
        $maxScore = 0;

        foreach ($test->questions as $question) {
            $maxScore += $question->questionKind === 'SINGLE_CHOICE' ? 1 : 3;
        }

        return $maxScore;
    }

}
