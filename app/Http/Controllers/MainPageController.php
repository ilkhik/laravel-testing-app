<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\TakedTest;

class MainPageController extends Controller
{
    public function getMainPage()
    {
        $takedTests = Auth::user()->takedTests;
        $signupDate = \DateTime::createFromFormat('Y-m-d', Auth::user()->signup_date)->format('d.m.Y');
        return view('main', [
            'user' => Auth::user(),
            'signupDate' => $signupDate,
            'takedTests' => $takedTests,
        ]);
    }
}
