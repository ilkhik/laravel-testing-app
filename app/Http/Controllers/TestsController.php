<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TestService;
use Illuminate\Support\Facades\Auth;

class TestsController extends Controller
{

    private TestService $testService;

    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    public function findAll()
    {
        $testsToClient = $this->testService->getAllTests();

        return view('tests', [
            'tests' => $testsToClient,
        ]);
    }

    public function getById($stringId)
    {
        $id = intval($stringId);
        $takedTest = $this->testService->getTakedTest($id, Auth::user()->id);

        if ($takedTest !== null) {
            return view('taked_test', [
                'takedTest' => $takedTest,
            ]);
        }

        $test = $this->testService->getById($id);

        return view('test', [
            'test' => $test,
        ]);
    }
    
    public function takeTest(Request $request, $id)
    {
        $takedTest = json_decode($request->getContent());
        $this->testService->takeTest($takedTest, intval($id), Auth::user()->id);
    }
    
    public function createNewTest(Request $request)
    {
        $test = json_decode($request->getContent());
        $this->testService->createNewTest($test);
    }
    
    public function getCreateTestPage()
    {
        return view('create_test');
    }
}
