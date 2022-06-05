<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SignUpService;
use App\Forms\UserForm;

class SignUpController extends Controller
{

    private SignUpService $signUpService;

    public function __construct(SignUpService $signUpService)
    {
        $this->signUpService = $signUpService;
    }

    public function getSignupPage()
    {
        return view('signup');
    }

    public function signUp(Request $request)
    {
        try {
            $userForm = new UserForm();
            $userForm->login = $request->input('login');
            $userForm->password = $request->input('password');
            $this->signUpService->signUp($userForm);
            return redirect('/login');
        } catch (\Exception $e) {
            return back()->with('error', true);
        }
    }

}
