<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\PasswordIsWrongException;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    private UserService $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function getSettingsPage()
    {
        return view('settings');
    }
    
    public function changePassword(Request $request)
    {
        $oldPassword = $request->input('oldPassword');
        $newPassword = $request->input('newPassword');
        
        try {
            $this->userService->changePassword(Auth::user()->id, $oldPassword, $newPassword);
            return view('settings', ['passwordChanged' => true]);
        } catch (PasswordIsWrongException $e) {
            return view('settings', ['passwordIsWrong' => true]);
        }
    }
}
